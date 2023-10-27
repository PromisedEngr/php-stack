<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\ServiceTask;
use App\Models\Task;
use App\Models\ServiceCategory;
use App\Models\Conversation;
use App\Models\Milestone;
use URL;
use Session;
use Helper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;

class CustomerServiceController extends Controller
{
    public function mypostedtask(){
        $customer_id = auth()->guard('customer')->user()->id;
        $get_serviceTask = Task::Select(
                        'tasks.id as task_id',
                        'tasks.fk_category_id',
                        'tasks.task_name',
                        'tasks.task_description',
                        'tasks.accepted_by',
                        'tasks.expected_date',
                        'tasks.address',
                        'tasks.customer_country_id',
                        'tasks.customer_state_id',
                        'tasks.city',
                        'tasks.zipcode',
                        'tasks.amount',
                        'tasks.admin_approved',
                        'tasks.status as task_status',
                        'tasks.fk_customer_id',
                        'service_categories.id as service_categories_id',
                        'service_categories.category_name',
                        'countries.name as country_name',
                        'states.name as state_name',
                        
                    )
                    ->join('service_categories', 'service_categories.id', '=', 'tasks.fk_category_id')
                    ->join('countries', 'countries.id', '=', 'tasks.customer_country_id')
                    ->join('states', 'states.id', '=', 'tasks.customer_state_id')
                    ->where('tasks.fk_customer_id',$customer_id)->orderBy('tasks.id','desc')->get();

        $data['get_serviceTask']=$get_serviceTask;

        //Helper::pr($data['get_serviceTask']); die;
     
        return view('customer.mypostedtask',$data);
    }

    public function viewfulltaskDetails(Request $request){
       $task_id = $request['get_taskId'];

       $get_serviceTask = Task::Select(
                            'tasks.id as task_id',
                            'tasks.fk_category_id',
                            'tasks.task_name',
                            'tasks.task_description',
                            'tasks.expected_date',
                            'tasks.address',
                            'tasks.customer_country_id',
                            'tasks.customer_state_id',
                            'tasks.city',
                            'tasks.amount',
                            'tasks.zipcode',
                            'tasks.admin_approved',
                            'tasks.fk_customer_id',
                            'service_categories.id as service_categories_id',
                            'service_categories.category_name',
                            'countries.name as country_name',
                            'states.name as state_name'
                        )
                        ->join('service_categories', 'service_categories.id', '=', 'tasks.fk_category_id')
                        ->join('countries', 'countries.id', '=', 'tasks.customer_country_id')
                        ->join('states', 'states.id', '=', 'tasks.customer_state_id')
                        ->where('tasks.id',$task_id)
                        ->first();

        if($get_serviceTask){
            $status['status'] = true;
            $status['get_serviceTask'] = $get_serviceTask;
            $status['message'] = 'Service Task fetch Successfully';
            return \Response::json($status);


        }else{
            $status['status'] = false;
            $status['message'] = 'Please try again';
            return \Response::json($status);


       }
     
        


    }

    public function search_service(Request $request){
        $data = $request['data'];
        $search_result = ServiceCategory::select('id','category_name','category_image','priority_order',)->where('category_name', 'LIKE', '%'.$data.'%')->orWhere('descriptions', 'LIKE', '%'.$data.'%')->orderBy('priority_order','asc')->get();
        $search_result_count = $search_result->count();

        if($search_result){
            $status['status'] = true;
            $status['get_search_result'] = $search_result;
            $status['get_search_result_count'] = $search_result_count;
            $status['message'] = 'Search Service Task fetch Successfully';
            return \Response::json($status);
            exit;

        }else {
            $status['status'] = false;
            $status['message'] = 'Please try again';
            return \Response::json($status);
            exit;
        }

    }

    public function updateTask(Request $request){
        //Helper::pr($request->all()); die;
        $validator = Validator::make($request->all(), [
           //'category_service_id'=>'required',
            'task_name'=>'required|string',
            'description'=>'required|string',
            'expected_date'=>'required|date',
            'address'=>'required|string',
            'customer_country_id'=>'required',
            'customer_state_id'=>'required',
            'city'=>'required|string',
            'zipcode'=>'required',
            'amount'=>'required|numeric',
            'hidden_task_id'=>'required|numeric',
        ]);
        if($validator->fails()){
            $status['success'] = false;
            $status['message'] =  $validator->errors();
            exit;
           
        }

        //$updatedata['fk_category_id']=$request->category_service_id;
        $updatedata['task_name']=$request->task_name;
        $updatedata['task_description']=$request->description;
        $updatedata['expected_date']= date('Y-m-d', strtotime($request->expected_date));
        $updatedata['address']=$request->address;
        $updatedata['customer_country_id']=$request->customer_country_id;
        $updatedata['customer_state_id']=$request->customer_state_id;
        $updatedata['city']=$request->city;
        $updatedata['zipcode']=$request->zipcode;
        $updatedata['admin_approved'] = 1;
        $updatedata['status'] = 1;
        $updatedata['amount'] = $request->amount;
        $updatedata['fk_customer_id'] = auth()->guard('customer')->user()->id;
        $updatedata['created_by'] = auth()->guard('customer')->user()->id;
        $updatedata['created_at'] =date('Y-m-d H:i:s');
        $updateresult = Task::where("id", $request->hidden_task_id)->update($updatedata);

        //Update in Chat Milestone

        $fetchmilestoneUpdate = Milestone::Select('milestones.id','milestones.task_id','milestones.vendor_id','milestones.customer_id','milestones.conversation_milestone_id')
                                ->where(['milestones.task_id' =>$request->hidden_task_id ])
                                ->first();
        // Fetch Category Country State 
        $fetchcatcountrystate = Task::Select(
                                    'tasks.fk_category_id',
                                    'tasks.customer_country_id',
                                    'tasks.customer_state_id',
                                    'countries.name as countryname',
                                    'states.name as statename',
                                    'service_categories.category_name'
                                    )
                                    ->join('service_categories', 'service_categories.id', '=', 'tasks.fk_category_id')
                                    ->join('countries', 'countries.id', '=', 'tasks.customer_country_id')
                                    ->join('states', 'states.id', '=', 'tasks.customer_state_id')
                                    ->where(['tasks.id'=> $request->hidden_task_id])
                                    ->first();

        $updatemessage= "";
        $updatemessage .= "<table style='width:100%' class='milestone_table'>
                        <tr>
                            <th>Task name</th>
                            <td>".$request->task_name."</td>
                        </tr>
                        <tr>
                            <th>Task Category</th>
                            <td>".$fetchcatcountrystate->category_name."</td>
                        </tr>
                        <tr>
                            <th>Task Description</th>
                            <td>".$request->description."</td>
                        </tr>
                        <tr>
                            <th>Task Date</th>
                            <td>".date('d-m-Y', strtotime($request->expected_date))."</td>
                        </tr>
                        <tr>
                            <th>Task Price</th>
                            <td>".$request->amount."</td>
                        </tr>
                        <tr>
                            <th>Customer Address</th>
                            <td>".$request->address."</td>
                        </tr>
                        <tr>
                            <th>Customer State</th>
                            <td>".$fetchcatcountrystate->statename."</td>
                        </tr>
                        <tr>
                            <th>Customer Country</th>
                            <td>".$fetchcatcountrystate->countryname."</td>
                        </tr>
                        <tr>
                            <th>Customer City</th>
                            <td>".$request->city."</td>
                        </tr>
                        <tr>
                            <th>Customer Zipcode</th>
                            <td>".$request->zipcode."</td>
                        </tr>
                        
                    </table>
                    ";
        if(!empty($fetchmilestoneUpdate->conversation_milestone_id)){
            $updateconversation = DB::table('conversations')
                                ->where('id', $fetchmilestoneUpdate->conversation_milestone_id)
                                ->update(array('message' => $updatemessage));
        }

        if($updateresult){
            $status['status'] = true;
            $status['message'] = 'Service Task updated Successfully';
            return \Response::json($status);
            exit;
        }else {
            $status['status'] = false;
            $status['message'] = 'Please try again';
            return \Response::json($status);
            exit;
        }
    }

    public function createNewMilestone(Request $request){
       
        $customer_id = auth()->guard('customer')->user()->id;
        $get_serviceTask = Task::Select(
                        'tasks.id as task_id',
                        'tasks.fk_category_id',
                        'tasks.task_name',
                        'tasks.task_description',
                        'tasks.expected_date',
                        'tasks.address',
                        'tasks.customer_country_id',
                        'tasks.customer_state_id',
                        'tasks.city',
                        'tasks.zipcode',
                        'tasks.amount',
                        'tasks.admin_approved',
                        'tasks.status as task_status',
                        'tasks.fk_customer_id',
                        'service_categories.id as service_categories_id',
                        'service_categories.category_name',
                        'countries.name as country_name',
                        'states.name as state_name'
                    )
                    ->join('service_categories', 'service_categories.id', '=', 'tasks.fk_category_id')
                    ->join('countries', 'countries.id', '=', 'tasks.customer_country_id')
                    ->join('states', 'states.id', '=', 'tasks.customer_state_id')
                    ->where('tasks.fk_customer_id',$customer_id)
                    ->where('tasks.fk_category_id',$request->job_service_cat_id)
                    ->where('tasks.id', $request->job_task_Id)
                    ->orderBy('tasks.id','desc')
                    ->first();

        $fetch_dublicatemilestone = Milestone::select('task_id','vendor_id','customer_id','status')->where(['task_id'=>$get_serviceTask->task_id, 'vendor_id'=>$request->job_vendor_id, 'customer_id'=>$request->job_customer_Id])->first();

        if(!empty($fetch_dublicatemilestone)){
            if($fetch_dublicatemilestone->status == 1){
                $status['status'] = false;
                $status['message'] = "You have already created milestone ";
                return \Response::json($status);
               
            }else if($fetch_dublicatemilestone->status == 2){
                $status['status'] = false;
                $status['message'] = "You have already created milestone ";
                return \Response::json($status);
            }else if($fetch_dublicatemilestone->status == 3){
                $status['status'] = false;
                $status['message'] = "You have already created milestone ";
                return \Response::json($status);
            }
        }
            $message = "";
            $message .= "   <table style='width:100%' class='milestone_table'>
                                <tr>
                                    <th>Task name</th>
                                    <td>".$get_serviceTask->task_name."</td>
                                </tr>
                                <tr>
                                    <th>Task Category</th>
                                    <td>".$get_serviceTask->category_name."</td>
                                </tr>
                                <tr>
                                    <th>Task Description</th>
                                    <td>".$get_serviceTask->task_description."</td>
                                </tr>
                                <tr>
                                    <th>Task Date</th>
                                    <td>".date('d-m-Y', strtotime($get_serviceTask->expected_date))."</td>
                                </tr>
                                <tr>
                                    <th>Task Price</th>
                                    <td>".$get_serviceTask->amount."</td>
                                </tr>
                                <tr>
                                    <th>Customer Address</th>
                                    <td>".$get_serviceTask->address."</td>
                                </tr>
                                <tr>
                                    <th>Customer State</th>
                                    <td>".$get_serviceTask->state_name."</td>
                                </tr>
                                <tr>
                                    <th>Customer Country</th>
                                    <td>".$get_serviceTask->country_name."</td>
                                </tr>
                                <tr>
                                    <th>Customer Zipcode</th>
                                    <td>".$get_serviceTask->zipcode."</td>
                                </tr>
                                
                            </table>
                            

                        ";
            $from_id = $request->job_customer_Id;
            $to_id = $request->job_vendor_id;
            $message = $message;
            $message_data = array(
                            'from_id' => $from_id, 
                            'to_id' => $to_id,
                            'message' => $message, 
                            'status' => 0, 
                            'message_type' => 1, 
                            'created_at' =>  date('Y-m-d H:i:s'), 
                            'updated_at' =>  date('Y-m-d H:i:s'),
                            );

            $insert_table = DB::table('conversations')->insertGetId($message_data);

            $milestone_data = array(
                            'task_id' => $get_serviceTask->task_id, 
                            'vendor_id' => $request->job_vendor_id,
                            'customer_id' => $request->job_customer_Id,
                            'conversation_milestone_id' => $insert_table,
                            'created_at' =>  date('Y-m-d H:i:s'),
                            );
                            
            $insert_milestone = Milestone::insert($milestone_data);

            if(!empty($insert_table)){
                $status['status'] = true;
                $status['message'] = "Successfully";
                return \Response::json($status);
               
            }else {
                $status['status'] = false;
                $status['message'] = "Please try again";
                return \Response::json($status);
               
            }
        
        
    }

    public function checkorcreatemilestone(Request $request){
        $data =$request->all();
        $customer_id = auth()->guard('customer')->user()->id;

            $fetch_dublicatemilestone = Milestone::select('task_id','vendor_id','customer_id','status')->where(['vendor_id'=>$request->all_details_vendor, 'customer_id'=>$customer_id])->orderBy('id','desc')->first();

        if(!empty($fetch_dublicatemilestone)){
            if($fetch_dublicatemilestone->status == 1){
                $status['status'] = false;
                $status['message'] = "You have already created milestone ";
                return \Response::json($status);
               
            }else if($fetch_dublicatemilestone->status == 2){
                $status['status'] = false;
                $status['message'] = "You have already created milestone ";
                return \Response::json($status);
            }else if($fetch_dublicatemilestone->status == 3){
                $status['status'] = false;
                $status['message'] = "You have already created milestone ";
                return \Response::json($status);
            }
        }else {
            $status['status'] = true;
            return \Response::json($status);
        }
    }
}
