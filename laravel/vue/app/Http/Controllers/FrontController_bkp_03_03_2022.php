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
        

        $service_per_page       = 3;  //Number of items set it to 3
        $fetch_services = ServiceCategory::Select('id','category_name','descriptions','parent_category_id','category_image','priority_order')->where('parent_category_id','=',0)->orderBy('priority_order','asc');


        if(isset($conditions['search_val']) && !empty($conditions['search_val'])){
            $fetch_services->where('category_name', 'LIKE', '%'.$conditions['search_val'].'%')->orWhere('descriptions', 'LIKE', '%'.$conditions['search_val'].'%');
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
            //Helper::pr($getvendorList); die;

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

    public function chatwithvendor(Request $request){
        return view('frontend.chat');
    }

    public function submitTask(Request $request){
        $data = $request->all();
        $this->validate($request,[
            'category_service_id'=>'required',
            'task_name'=>'required|string',
            'description'=>'required|string',
            'expected_date'=>'required|date',
            'address'=>'required|string',
            'customer_country_id'=>'required',
            'customer_state_id'=>'required',
            'city'=>'required|string',
            'zipcode'=>'required',
        ]);

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


    
    
}
