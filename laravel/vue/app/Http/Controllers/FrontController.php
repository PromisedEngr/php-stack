<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\VendorServiceCategoryMapping;
use App\Models\ServiceTask;
use App\Models\Task;
use App\Models\ServiceCategory;
use App\Models\Countries;
use App\Models\Conversation;
use App\Models\Milestone;
use App\Models\Blog;
use Illuminate\Support\Facades\Validator;
use DB;
use Helper;

use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function index(){
        return view('frontend.index');
    }

    public function about(){
        return view('frontend.about');
    }

    public function contact(){
        return view('frontend.contact');
    }


    public function findvenderservices(){
        $service_categories=ServiceCategory::whereNull('deleted_at')->orderBy('category_name','asc')->pluck('category_name','id')->toArray();
        $countryDp=Countries::orderBy('name','asc')->pluck('name','id')->toArray();
        $data['service_categoriesDP']=$service_categories;
        $data['countryDp']=$countryDp;
        return view('frontend.vendor_services',$data);
    }

    public function fetch_services(Request $request){

        $conditions = $request->all();
        $customer_id = auth()->guard('customer')->user()->id;

        $service_per_page       = 3;  //Number of items set it to 3

        $ser = [];
        $catmapping = [];

        $fetch_customer_task = Task::Select('fk_category_id')
                                ->where('fk_customer_id',$customer_id)
                                ->whereIn('status',array(1,2,3))
                                ->get();  
        
        foreach ($fetch_customer_task as $key => $value) {
            array_push($ser, $value['fk_category_id']);
        }
        
        $fetchvendorservicemapping = VendorServiceCategoryMapping::distinct()->get(['category_id']);

        foreach ($fetchvendorservicemapping as $key => $fetchvendorservicemappings) {
           array_push($catmapping, $fetchvendorservicemappings['category_id']);
        }
       

        $fetch_services = ServiceCategory::Select('id','category_name','descriptions','parent_category_id','category_image','priority_order')->where('parent_category_id','=',0)->whereIn('id',$catmapping);

        
        
        $fetch_services->orderBy('priority_order','asc');

        if(isset($conditions['search_val']) && !empty($conditions['search_val'])){

            $fetch_services->where('category_name', 'LIKE', '%'.$conditions['search_val'].'%')->orWhere('descriptions', 'LIKE', '%'.$conditions['search_val'].'%');
            
        }
        if(!empty($fetch_customer_task)){
        //     Helper::pr("Here");
        //    die;
            $fetch_services->whereNotIn('service_categories.id', $ser);
        }
        $countFetchServices = $fetch_services->count();

        if(isset($conditions['current_page']) && !empty($conditions['current_page'])){
            if(isset($conditions['current_page']) && !empty($conditions['current_page']) && !empty($conditions['search_val'])){
                $page_number            = $conditions['current_page'];
            }else if(isset($conditions['search_val']) && !empty($conditions['search_val'])){
                $page_number            = 1;
            }else {
                $page_number            = $conditions['current_page'];
            }
            
        }else{
            $page_number                = 1; //if there's no page number, set it to 1
        }
        
        $page_position = (($page_number-1) * $service_per_page);

        $fetch_services = $fetch_services->skip($page_position)->take($service_per_page)->get();

        //    Helper::pr($fetch_services); die;
        
        $total_pages = ceil($countFetchServices/$service_per_page);
       
       if($fetch_services){
            $status['status'] = true;
            $status['fetch_services'] = $fetch_services;
            $status['page_number'] = intval($page_number);
            $status['countFetchServices'] = $countFetchServices;
            $status['total_pages'] = $total_pages;
            $status['message'] = 'Services fetch Successfully';
            return \Response::json($status);

       }else {
            $status['status'] = false;
            $status['message'] = 'Something went wrong';
            return \Response::json($status);
       }
    }

    public function serviceDetails(){
        return view('frontend.servicesDetails');
    }

    public function vendorListing(Request $request){
        $data = $request->all();
        $user_customer_id = auth()->guard('customer')->user()->id;

        $getvendorList = VendorServiceCategoryMapping::join('users', 'users.id', '=', 'vendor_service_category_mappings.vendor_id')
            ->where("vendor_service_category_mappings.category_id", $data['get_service_id'])
            ->get([
                'users.id as user_id', 
                'users.name',
                'users.company_name',
                'users.mobile',
                'users.email',
                'users.address',
                'users.rating',
                'users.profile_image',
                'users.service_photo',
                'vendor_service_category_mappings.id as vendor_service_category_mappings_id',
                'vendor_service_category_mappings.vendor_id',
                'vendor_service_category_mappings.category_id',
            ]);
           

            if(count($getvendorList) > 0){
                $status['status'] = true;
                $status['getvendorList'] = $getvendorList;
                $status['user_customer_id'] = $user_customer_id;
                $status['message'] = 'Vendors fetch Successfully';
                return \Response::json($status);

            }else {
                $status['status'] = true;
                $status['getvendorList'] = $getvendorList;
                $status['message'] = 'No Vendors work for this service';
                return \Response::json($status);

            }


    }

    public function chatview(Request $request){
        return view('frontend.chat');
    }

    public function submitTask(Request $request){
        $data = $request->all();
        //Helper::pr($data); die;

        $dublicate_task = [];
        
        $validator = Validator::make($request->all(), [
           'category_service_id'=>'required',
            'task_name'=>'required|string',
            'description'=>'required|string',
            'expected_date'=>'required|date',
            'address'=>'required|string',
            'customer_country_id'=>'required',
            'customer_state_id'=>'required',
            'city'=>'required|string',
            'zipcode'=>'required',
            'amount'=>'required|numeric',


        ]);
        if($validator->fails()){
            $status['success'] = false;
            $status['message'] =  $validator->errors();
           
        }

        $fetchalltask = Task::where(['fk_category_id'=>$data['category_service_id'],'fk_customer_id'=>auth()->guard('customer')->user()->id])->whereIn('tasks.status',array(1,2,3))->get();

        foreach ($fetchalltask as $key => $value) {
           array_push($dublicate_task,$value);
        }

        if(!empty($dublicate_task)){
            $status['success'] = false;
            $status['message'] =  "Sorry! You can not create task. ";
            return \Response::json($status);
        }

        //Helper::pr($fetchalltask); die;
        
        $insertdata['fk_category_id']=$request->category_service_id;
        $insertdata['task_name']=$request->task_name;
        $insertdata['task_description']=$request->description;
        $insertdata['expected_date']= date('Y-m-d', strtotime($request->expected_date));
        $insertdata['address']=$request->address;
        $insertdata['customer_country_id']=$request->customer_country_id;
        $insertdata['customer_state_id']=$request->customer_state_id;
        $insertdata['city']=$request->city;
        $insertdata['zipcode']=$request->zipcode;
        $insertdata['admin_approved'] = 1;
        $insertdata['status'] = 1;
        $insertdata['amount'] = $request->amount;
        $insertdata['fk_customer_id'] = auth()->guard('customer')->user()->id;
        $insertdata['created_by'] = auth()->guard('customer')->user()->id;
        $insertdata['created_at'] =date('Y-m-d H:i:s');
        //dd($insertdata);
        $insert = Task::insertGetId($insertdata);

        if($insert){
            $status['status'] = true;
            $status['message'] = 'Successfully Created Task.';
            return \Response::json($status);
        }else{
            $status['status'] = false;
            $status['message'] = 'Please try again later.';
            return \Response::json($status);
        }

    }

    // Chat for Customer Details

    public function fetchChatCustomerDetails(Request $request){
       //Helper::pr($request->all()); die;
        
        $data = $request->all();
        $vendor_details_id = $data['vendor_id'];
        $all_user_item = [];
        $all_item = [];
        $conversation_count_unread = [];
        $last_conversation_count ="";
        $customer_with_id = $data['customer_id'];
        $from_conversation =  Conversation::Select('id','to_id','from_id','message','status')
                                ->where('to_id','=', $customer_with_id)
                                ->orWhere('from_id','=', $customer_with_id)
                                ->orderBy('conversations.id', 'desc')
                                ->get();
        if($from_conversation->count() > 0){


        
            $data = [];
            foreach ($from_conversation as $key => $value) {
                $tem = ['id'=>$value->id,'from_id' => $value->from_id, 'to_id' => $value->to_id];
                $tem1 = ['id'=>$value->id,'from_id' => $value->to_id, 'to_id' => $value->from_id];

               if(!$this->checkarray($data,$tem) && !$this->checkarray($data,$tem1)){
                    array_push($data, $tem);
               }

            }

            foreach ($data as $key => $val) {
              
                $last_conversation =  Conversation::Select('id','to_id','from_id','message','status','message_type')
                                    ->where('id','=', $val['id'])
                                    ->get();
                 
                
                foreach ($last_conversation as $key => $values) {
                   
                    if($values['to_id'] == $customer_with_id){
                        $users =   User::Select('id','name','profile_image','role','is_online_offline')->where('id','=', $values['from_id'])->get();
                    }else{
                        $users =   User::Select('id','name','profile_image','role','is_online_offline')->where('id','=', $values['to_id'])->get();

                    }
                   // Helper::pr($values); 
                    if($val['to_id'] == $customer_with_id){
                   
                        $last_conversation_count =  Conversation::Select('id','to_id','from_id','status')
                                            ->where('to_id','=', $customer_with_id)
                                            ->where('from_id','=', $values['from_id'])
                                            ->where('status','=',0)
                                            ->orderBy('conversations.id', 'desc')
                                            ->get();
                        
                       
                        $last_conversation_count = ($last_conversation_count)->count();
                    }else {
                        $last_conversation_count = 0;
                    }
                   array_push($all_item,['all_result'=>$users,'last_conversation_counts' => $last_conversation_count]);
                   
                }
            }
            
            array_push($all_user_item,['all_result' =>$all_item]);

        }else {
           $all_user_item = "";
        }

        if(isset($vendor_details_id) && !empty($vendor_details_id)){
            //Fetch Vendor Chat with details

            $vendor_details = $this->user_details($vendor_details_id);
            if($vendor_details){

                $status['status'] = true;
                $status['all_user_item'] = $all_user_item;
                $status['selected_Type'] = "vendor";
                $status['selected_vendor'] =intval($vendor_details_id);
                $status['vendor_details'] = $vendor_details;
                $status['customerId'] = auth()->guard('customer')->user()->id;
                $status['message'] = 'Successfully fetched.';
               
            }else{
                $status['status'] = false;
                $status['message'] = 'Please try again later.';
            }

        }else {
          
            if($customer_with_id){
                $status['status'] = true;
                $status['selected_Type'] = "open_chat";
                $status['all_user_item'] = $all_user_item;
                $status['message'] = 'Successfully fetched.';

            }else {
                $status['status'] = false;
                $status['message'] = 'Please try again later.';

            }

        }
        return \Response::json($status);

    }

    public function fetchVendor(Request $request){
        $user_details_id = $request['vendor_id'];
        $fetch_vendor_users =   $this->user_details($user_details_id);
       
        if(!empty($fetch_vendor_users)){
            $status['success']= true;
            $status['vendor'] = $fetch_vendor_users;
            $status['customer_id'] = auth()->guard('customer')->user()->id;
            $status['message'] = "Successafully fetched";

        }else {
            $status['success']= false;
            $status['message'] = "Please try again later";
        }
         return \Response::json($status);

    }

    public function send_chatcustomer(Request $request){
        //Helper::pr($request->all()); die;
      
        $from_id = $request->customer_to_id;
        $to_id = $request->vendor_to_id;
        $message = $request->text_message;

        if($message == "award"){
            $message_data = array(
                        'from_id' => $from_id, 
                        'to_id' => $to_id,
                        'message' => " 
                                        <div class='heading_award'>
                                            <div class='heading_title'><b>Congratulation !</b> You have Awarded This Job</div>
                                            <ul class='accept_reward_btn'>
                                                <li><a href='javascript:void(0)' class='accept_award get_accept_reject' data-acceptrejectvalue='1'>Accept</a></li>
                                                <li><a href='javascript:void(0)' class='reject_award get_accept_reject' data-acceptrejectvalue='2'>Cancel</a></li>
                                                <input type='hidden' id='award_servicecat' name='award_servicecat' value='".$request->awardedsevice_id."'>
                                            </ul>
                                        </div>
                                    ", 
                        'status' => 0, 
                        'message_type' => 2, 
                        'created_at' =>  date('Y-m-d H:i:s'), 
                        'updated_at' =>  date('Y-m-d H:i:s'),
                        );


        }else {
            $message_data = array(
                        'from_id' => $from_id, 
                        'to_id' => $to_id,
                        'message' => $message, 
                        'status' => 0, 
                        'message_type' => 0, 
                        'created_at' =>  date('Y-m-d H:i:s'), 
                        'updated_at' =>  date('Y-m-d H:i:s'),
                        );

        }

        

       // Helper::pr($message_data); die;
        $insert_table = DB::table('conversations')->insert($message_data);

        $status['status'] = true;
       
        $status['message'] = 'Chat send successfully.';
       return \Response::json($status);

    }

    public function fetchgetmessage(Request $request){

        $cust_id = auth()->guard('customer')->user()->id;
        $vendor_details_id = $request['vendor_id'];
        $get_message = Conversation::Select('id','to_id','from_id','message','status','message_type','created_at')
                    ->where('to_id','=', $vendor_details_id)
                    ->orWhere('to_id','=', $cust_id)
                    ->where('from_id','=', $cust_id)
                    ->orWhere('from_id','=', $vendor_details_id)
                    ->get();
        if($get_message){
            $status['status'] = true;
            $status['get_message'] = $get_message;
            $status['customer_id'] = $cust_id;
            $status['message'] = 'Successfully fetched.';

        }else {
            $status['status'] = false;
            $status['message'] = 'Please try again later.';

        }
        return \Response::json($status);

    }

    public function submitMilestone(Request $request){
      
        $validator = Validator::make($request->all(), [
            "milestone_work"    => "required|array",
            "milestone_work.*"  => "required|string",
            "milestone_description"    => "required|array",
            "milestone_description.*"  => "required|string",
            "milestone_price"    => "required|array",
            "milestone_price.*"  => "required|numeric",


        ]);
        if($validator->fails()){
            $status['success'] = false;
            $status['message'] =  $validator->errors();
           
        }

        $data = $request->all();
        $fetch_task = Task::Select('fk_category_id','fk_vendor_id','fk_customer_id','status')->where(['fk_category_id'=>$data['service_id'],'fk_vendor_id'=>$data['hidden_vendor_id'],'fk_customer_id'=> auth()->guard('customer')->user()->id])->orderBy('id','desc')->first();

        if(!empty($fetch_task)){
           
            if($fetch_task->status == 1) { // if task is created
                $status['success'] = false;
                $status['message'] = "You can not create Milestone for this Service";
                return \Response::json($status);
            }else if($fetch_task->status == 2){  // if task is  accepted
                $status['success'] = false;
                $status['message'] = "You can not create Milestone for this Service";
                return \Response::json($status);

            }else if($fetch_task->status == 3){ // if task is pending
                $status['success'] = false;
                $status['message'] = "You can not create Milestone for this Service";
                return \Response::json($status);

            }else {
                $insertData['customer_id']  = auth()->guard('customer')->user()->id;
                $insertData['created_at']   = date('Y-m-d H:i:s');
                
                // Insert in Milestone Table
                foreach ($data['milestone_name'] as $key => $value) {

                    $insert_qns['milestone_name'] = $value;
                    $insert_qns['milestone_description'] = $data['milestone_work'][$key];
                    $insert_qns['milestone_price'] = $data['milestone_price'][$key];
                    $insert_qns['task_id'] = $data['service_id'];
                    $insert_qns['vendor_id'] = $data['hidden_vendor_id'];
                    $insert_qns['customer_id'] = $insertData['customer_id'];
                    $insert_qns['created_at'] = $insertData['created_at'];
                    $result = Milestone::insert($insert_qns);
                    
                }

                // Insert in Conversation Table
                $milestone_html = "";
                $fetch_serviceCatname = ServiceCategory::Select('category_name')->where('id','=',$data['service_id'])->first();

                $milestone_html .= "<span>Service Task - ". $fetch_serviceCatname->category_name.'</span>';
                foreach ($data['milestone_name'] as $key => $value) {
                    $milestone_html .= "<span>Service Name - ".$value.'</span>';
                    $milestone_html .= "<span>Service Work - ".$data['milestone_work'][$key].'</span>';
                    $milestone_html .= "<span>Service Price - ".$data['milestone_price'][$key].'</span>';
                }
             
                $message_data = array(
                            'from_id' => $insertData['customer_id'], 
                            'to_id' => $data['hidden_vendor_id'],
                            'message' => $milestone_html, 
                            'status' => 0, 
                            'message_type' => 1, 
                            'created_at' =>  date('Y-m-d H:i:s'), 
                            'updated_at' =>  date('Y-m-d H:i:s'),
                            );
                $insert_table = Conversation::insert($message_data);
               if($result){
                    $status['success'] = true;
                    $status['message'] = "Milestone created successfully";
                     return \Response::json($status);

               }else {
                    $status['success'] = false;
                    $status['message'] = "Something went Wrong";
                     return \Response::json($status);
               }
            }

        }
        else{
            //insert new task
        }


        $insertData['customer_id'] 	= auth()->guard('customer')->user()->id;
		$insertData['created_at'] 	= date('Y-m-d H:i:s');
        
        // Insert in Milestone Table
        foreach ($data['milestone_name'] as $key => $value) {

            $insert_qns['milestone_name'] = $value;
            $insert_qns['milestone_description'] = $data['milestone_work'][$key];
            $insert_qns['milestone_price'] = $data['milestone_price'][$key];
            $insert_qns['task_id'] = $data['service_id'];
            $insert_qns['vendor_id'] = $data['hidden_vendor_id'];
            $insert_qns['customer_id'] = $insertData['customer_id'];
            $insert_qns['created_at'] = $insertData['created_at'];
            $result = Milestone::insert($insert_qns);
            
        }

        // Insert in Conversation Table
        $milestone_html = "";
        $fetch_serviceCatname = ServiceCategory::Select('category_name')->where('id','=',$data['service_id'])->first();

        $milestone_html .= "<span>Service Task - ". $fetch_serviceCatname->category_name.'</span>';
        foreach ($data['milestone_name'] as $key => $value) {
            $milestone_html .= "<span>Service Name - ".$value.'</span>';
            $milestone_html .= "<span>Service Work - ".$data['milestone_work'][$key].'</span>';
            $milestone_html .= "<span>Service Price - ".$data['milestone_price'][$key].'</span>';
        }
     
             $message_data = array(
                        'from_id' => $insertData['customer_id'], 
                        'to_id' => $data['hidden_vendor_id'],
                        'message' => $milestone_html, 
                        'status' => 0, 
                        'message_type' => 1, 
                        'created_at' =>  date('Y-m-d H:i:s'), 
                        'updated_at' =>  date('Y-m-d H:i:s'),
                        );
            $insert_table = Conversation::insert($message_data);

       
       if($result){
            $status['success'] = true;
            $status['message'] = "Milestone created successfully";
             return \Response::json($status);

       }else {
            $status['success'] = false;
            $status['message'] = "Something went Wrong";
             return \Response::json($status);
       }
    }

    public function fetchAllchatsVendor(Request $request){
      
        $vendors = $request['vendor_id'];

        $customers_id = auth()->guard('customer')->user()->id;
        $getmessages = Conversation::Select('id','to_id','from_id','message','status','message_type','created_at')
                    ->where('to_id','=', $customers_id)
                    ->where('from_id','=', $vendors)
                    ->orWhere('from_id','=', $customers_id)
                    ->where('to_id','=', $vendors)
                    ->get();
        //Helper::pr($getmessages); die;
        if($getmessages){
            $status['success'] = true;
            $status['get_message'] = $getmessages;
            $status['customer_id'] = $customers_id;
            $status['message'] = "Successfully fetched";


        }else {
            $status['success'] = false;
            $status['message'] = "Please try again";
        }
        return \Response::json($status);
    }

    public static function user_details($user_details_id){
        $fetch_userdetails = User::Select('id as userId','name','profile_image','is_online_offline')->where(['id' => $user_details_id])->first();
        if($fetch_userdetails){
            return \Response::json($fetch_userdetails);
        }
    }

    

    public function fetchOptionDropDownCreatemilestone(Request $request){
       

        $html = '<option value="">Please Select</option>';
        $param = array(
            'table' => $request->input('table'),
            'field' => $request->input('field'),
            'wherefld' => $request->input('wherefld'),
            'whereval' => $request->input('whereval'),
            'getforcreatemilestone_vendorId' =>  $request->input('getforcreatemilestone_vendorId'),
        );
        $selected = '';
        
         $result = VendorServiceCategoryMapping::join($param['table'], $param['table'].'.id', '=', 'vendor_service_category_mappings.category_id')
                ->where(['vendor_service_category_mappings.vendor_id' => $param['getforcreatemilestone_vendorId']])
                ->get([$param['table'].".".$param["field"].' as name', $param['table'].".id"]);
        if(count($result) > 0){
            foreach($result as $val){
                $sel = ($selected == $val->id)?'selected':'';
                $html .= '<option value="'.$val->id.'" '.$sel.'>'.$val->name.'</option>';
            }
        }else {
             $html .= '<option value="">Not Found</option>';
        }
        echo $html;
        exit;
    

    }

    public function chatviewvendor(Request $request){
       return view('frontend.chatvendor');
    }

    public function blog(Request $request){
        $data['blog_listing'] = Blog::where('status','=','active')->get();
         return view('frontend.blog_listing',$data);
       
    }

    public function blogSinglePage($blog_title){
        $fetchDetailsBlog = Blog::where('blog_slug','=',$blog_title)->first();
        if(!empty($fetchDetailsBlog)){
            $result['blog_title'] = $fetchDetailsBlog->blog_title;
            $result['blog_details'] = htmlspecialchars_decode($fetchDetailsBlog->blog_details);
            $result['blog_file'] = url('/').'/public/blog_file/'.$fetchDetailsBlog->blog_file;
            $result['created_at'] = date_format($fetchDetailsBlog->created_at, "M, Y");
            
            return view('frontend.singleblog',$result);

        }else {
            return view('frontend.index');
        }
       
    }

    //Vendor Chat
    public function chatcustomerDetails(Request $request){
        //Helper::pr($request->all()); die;
        $data = $request->all();
        $vendor_details_id = $data['vendor_id'];
        $all_user_item = [];
        $all_item = [];
        $conversation_count_unread = [];
        $last_conversation_count ="";
        //$customer_with_id = $data['customer_id'];
        $from_conversation =  Conversation::Select('id','to_id','from_id','message','status')
                                ->where('to_id','=', $vendor_details_id)
                                ->orWhere('from_id','=', $vendor_details_id)
                                ->orderBy('conversations.id', 'desc')
                                ->get();
        //Helper::pr($from_conversation); die;

        if($from_conversation->count() > 0){
            $data = [];
            foreach ($from_conversation as $key => $value) {
                $tem = ['id'=>$value->id,'from_id' => $value->from_id, 'to_id' => $value->to_id];
                $tem1 = ['id'=>$value->id,'from_id' => $value->to_id, 'to_id' => $value->from_id];

               if(!$this->checkarray($data,$tem) && !$this->checkarray($data,$tem1)){
                    array_push($data, $tem);
               }

            }
            foreach ($data as $key => $val) {
              
                $last_conversation =  Conversation::Select('id','to_id','from_id','message','status','message_type')
                                    ->where('id','=', $val['id'])
                                    ->get();
                 
                
                foreach ($last_conversation as $key => $values) {
                   
                    if($values['to_id'] == $vendor_details_id){
                        $users =   User::Select('id','name','profile_image','role','is_online_offline')->where('id','=', $values['from_id'])->get();
                    }else{
                        $users =   User::Select('id','name','profile_image','role','is_online_offline')->where('id','=', $values['to_id'])->get();

                    }
                   // Helper::pr($values); 
                    if($val['to_id'] == $vendor_details_id){
                   
                        $last_conversation_count =  Conversation::Select('id','to_id','from_id','status')
                                            ->where('to_id','=', $vendor_details_id)
                                            ->where('from_id','=', $values['from_id'])
                                            ->where('status','=',0)
                                            ->orderBy('conversations.id', 'desc')
                                            ->get();
                        
                       
                        $last_conversation_count = ($last_conversation_count)->count();
                    }else {
                        $last_conversation_count = 0;
                    }
                   array_push($all_item,['all_result'=>$users,'last_conversation_counts' => $last_conversation_count]);
                   
                }
            }
            array_push($all_user_item,['all_result' =>$all_item]);

        }else {
           $all_user_item = "";
        }

        if($vendor_details_id){
            $status['status'] = true;
            $status['selected_Type'] = "open_chat";
            $status['all_user_item'] = $all_user_item;
            $status['message'] = 'Successfully fetched.';

        }else {
            $status['status'] = false;
            $status['message'] = 'Please try again later.';
        }
        return \Response::json($status);

    }

    public function fetchCustomer(Request $request){
        $user_details_id = $request['customer_id'];
        $fetchUsers =   $this->user_details($user_details_id);
        if(!empty($fetchUsers)){
            $status['success']= true;
            $status['customer'] = $fetchUsers;
            $status['vendor_id'] = auth()->guard('vendor')->user()->id;
            $status['message'] = "Successfully fetched";

        }else {
            $status['success']= false;
            $status['message'] = "Please try again later";
        }
        return \Response::json($status);

    }

    public function fetchAllchatsCustomer(Request $request){
        
      
        $customers = $request['customer_id'];

        $vendor_id = auth()->guard('vendor')->user()->id;
        // Helper::pr($vendor_id); // 15
        // Helper::pr($customers); // 16
        //die;
        $getmessages = Conversation::Select('id','to_id','from_id','message','status','message_type','created_at')
                    ->where('to_id','=', $vendor_id)
                    ->where('from_id','=', $customers)
                    ->orWhere('from_id','=', $vendor_id)
                    ->where('to_id','=', $customers)
                    ->get();
        //Helper::pr($getmessages); die;
        if($getmessages){
            $status['success'] = true;
            $status['get_message'] = $getmessages;
            $status['vendor_id'] = $vendor_id;
            $status['message'] = "Successfully fetched";


        }else {
            $status['success'] = false;
            $status['message'] = "Please try again";
        }
        return \Response::json($status);
    }

    public function send_chatVendor(Request $request){
        $to_id= $request->customer_to_id; 
        $from_id = $request->vendor_to_id;
        $message = $request->text_message;

        $message_data = array(
                        'from_id' => $from_id, 
                        'to_id' => $to_id,
                        'message' => $message, 
                        'status' => 0, 
                        'message_type' => 0, 
                        'created_at' =>  date('Y-m-d H:i:s'), 
                        'updated_at' =>  date('Y-m-d H:i:s'),
                        );

            // Helper::pr($from_id); 
            // Helper::pr($to_id); 
            // Helper::pr($message); 
            // die;
        $insert_table = DB::table('conversations')->insert($message_data);
        if($insert_table){
            $status['status'] = true;
            $status['message'] = 'Chat send successfully.';

        }else {
            $status['status'] = false;
            $status['message'] = 'Something went wrong.';
        }
       return \Response::json($status);
    }

    public function checkarray($data, $tem){
        foreach ($data as $key => $value) {
           if(($tem['from_id'] == $value['from_id']) && ($tem['to_id'] == $value['to_id'])){
            return true;
           }
        }
        return false;

    }

    public function checkaward(Request $request){   
        
        $data= $request->all();
        //Check Task Table
        $checktaskTable = DB::table('vendorapplytaskmappings')->select('id')->where(['fk_customer_id'=>$data['customer_to_id'],'fk_category_id'=>$data['awardedsevice_id'],'fk_vendor_id'=>$data['awardedVendor_id']])->orderBy('id','desc')->first();
        //Helper::pr($checktaskTable); die;
        if($checktaskTable){
            $status['status'] = true;
            $status['message'] = 'ok';
        }else {
            $status['status'] = false;
            $status['message'] = 'Please select correct service for award ';

        }
        return \Response::json($status);

    }

    public function awardresponse(Request $request){
       //Helper::pr($request->all()); die;
       $data= $request->all();
       // Check Dublicate
       //Helper::pr($data); die;
       $checkDublicateAward = Task::Select('id')->where(
                            ['fk_category_id'=>$data['awardedTaskService_id'],
                             'fk_customer_id'=>$data['awardedTaskCustomer_id'],
                             'fk_vendor_id'=>$data['awardedTaskVendor_id']
                             ])->whereIn('status', [2,3,4,5])->first();
       if(!empty($checkDublicateAward)){
            $status['status'] = false;
            $status['message'] = 'You have already responded this task';
            return \Response::json($status);
       }
        
       // Fetch Task for award Vendor
        $fetchTask = Task::Select('id')->where(['fk_category_id'=>$data['awardedTaskService_id'], 'fk_customer_id'=>$data['awardedTaskCustomer_id'], 'status'=>1])->first();
        //Helper::pr($fetchTask); die;

        $fetchmilestone = Milestone::Select('id','conversation_milestone_id')->where(['task_id'=>$fetchTask->id, 'customer_id'=>$data['awardedTaskCustomer_id'], 'status'=>1])->first();
        //Helper::pr($fetchmilestone); die;
        $to_id= $data['awardedTaskCustomer_id']; 
        $from_id = $data['awardedTaskVendor_id'];
        
        $message_award = "";
        if($data['get_accept_reject_value'] == 1){
            // Upadate in Task Table
            $updatedataTask = [ 'fk_vendor_id'=>$data['awardedTaskVendor_id'],
                                'accepted_by'=>$data['awardedTaskVendor_id'],
                                'status'=> 2,
                                'accepted_at' =>date('Y-m-d H:i:s'),
                            ];
            $updateTaskTable = Task::where('id', '=', $fetchTask->id)->update($updatedataTask);
            $message_award = "<b>The Vendor has accepted the task</b>";

            //Update in Milestone Table
            $updatedataTask = [ 'status'=> 2 ];
            $updateTaskTable = Milestone::where('id', '=', $fetchmilestone->id)->update($updatedataTask);
            $getaddressDetails = Task::Select(
                                            'tasks.address',
                                            'tasks.customer_country_id',
                                            'tasks.customer_state_id',
                                            'tasks.city',
                                            'tasks.zipcode',
                                            'countries.name as country_name',
                                            'states.name as state_name')
                                            ->join('countries', 'tasks.customer_country_id', '=', 'countries.id')
                                            ->join('states', 'states.id', '=', 'tasks.customer_state_id')
                                            ->where(['fk_category_id'=>$data['awardedTaskService_id'], 'fk_customer_id'=>$data['awardedTaskCustomer_id'], 'fk_vendor_id'=>$data['awardedTaskVendor_id'], 'status'=>2])
                                            ->first();
            $message_address = "<b>Customer Address:-</b>". $getaddressDetails->address." ".$getaddressDetails->city." ".$getaddressDetails->state_name." ".$getaddressDetails->country_name.", ".$getaddressDetails->zipcode ;

            $message_data = [[
                                'from_id' => $from_id, 
                                'to_id' => $to_id,
                                'message' => $message_award, 
                                'status' => 0, 
                                'message_type' => 0, 
                                'created_at' =>  date('Y-m-d H:i:s'), 
                                'updated_at' =>  date('Y-m-d H:i:s')
                            ],[
                                'from_id' => $from_id, 
                                'to_id' => $to_id,
                                'message' => $message_address, 
                                'status' => 0, 
                                'message_type' => 0, 
                                'created_at' =>  date('Y-m-d H:i:s'), 
                                'updated_at' =>  date('Y-m-d H:i:s')
                            ]];

            

            $insert_table = DB::table('conversations')->insert($message_data);
            

        }else if($data['get_accept_reject_value'] == 2){
            $updatedataTask = [ 'fk_vendor_id'=>$data['awardedTaskVendor_id'],
                                'accepted_by'=>$data['awardedTaskVendor_id'],
                                'status'=> 4,
                                'accepted_at' =>date('Y-m-d H:i:s'),
                            ];
            //Update in Milestone Table
            $updatedataTask = [ 'status'=> 4 ];
            $updateTaskTable = Milestone::where('id', '=', $fetchmilestone->id)->update($updatedataTask);
            $message_award = "<b>The Vendor has rejected the task</b>";
            $message_data = array(
                        'from_id' => $from_id, 
                        'to_id' => $to_id,
                        'message' => $message_award, 
                        'status' => 0, 
                        'message_type' => 0, 
                        'created_at' =>  date('Y-m-d H:i:s'), 
                        'updated_at' =>  date('Y-m-d H:i:s'),
                        );
            $insert_table = DB::table('conversations')->insert($message_data);

        }else {
            $status['status'] = false;
            $status['message'] = 'Task cannot be awarded. Please try again';
            return \Response::json($status);
        }
        
        if($insert_table){
            $status['status'] = true;
            $status['message'] = 'Accepted';
            return \Response::json($status);

        }else {
            $status['status'] = false;
            $status['message'] = 'Something went wrong';
            return \Response::json($status);
        }
    }




    
    
}
