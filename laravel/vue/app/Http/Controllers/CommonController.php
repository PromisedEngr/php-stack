<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Common;
use Twilio\Rest\Client;
use App\Models\User;
use App\Models\VendorServiceCategoryMapping;
use App\Models\ServiceTask;
use App\Models\Task;
use App\Models\ServiceCategory;
use Helper;
use Auth;
use DB;

class CommonController extends Controller
{
    public static function fetchOptionDropDown(Request $request){
        $html = '<option value="">Please Select</option>';
        $param = array(
            'table' => $request->input('table'),
            'field' => $request->input('field'),
            'wherefld' => $request->input('wherefld'),
            'whereval' => $request->input('whereval'),
        );
        $selected = '';
        if(!empty($request->input('selected')))
            $selected = $request->input('selected');
        $result = Common::fetchOptionDropDown($param);  
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

    public static function fetchOptionDropDownService(Request $request){

        $html = '<option value="">Please Select</option>';
        $param = array(
            'table' => $request->input('table'),
            'field' => $request->input('field'),
            'wherefld' => $request->input('wherefld'),
            'whereval' => $request->input('whereval'),
        );

        
        $selected = '';
        if(!empty($request->input('selected')))
            $selected = $request->input('selected');
            $customer_id = auth()->guard('customer')->user()->id;
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

            $fetch_services = DB::table($param['table'])->select('id','category_name')->where('parent_category_id','=',0)->whereIn('id',$catmapping);

            $fetch_services->orderBy('priority_order','asc');

            if(!empty($fetch_customer_task)){
                $fetch_services->whereNotIn('service_categories.id', $ser);
            }
            $result = $fetch_services->get();
            
          
        if(count($result) > 0){
            foreach($result as $val){
                $sel = ($selected == $val->id)?'selected':'';
                $html .= '<option value="'.$val->id.'" '.$sel.'>'.$val->category_name.'</option>';
            }
        }else {
             $html .= '<option value="">Not Found</option>';
        }
        echo $html;
        exit;


        


       
    }

    public function verifyMobileOnly(Request $request){
        //dd($request->all());
        if(!empty($request->mobile_no)){

            // check mobile exits or not
            $phone=trim($request->mobile_no, $request->std_code);
            //dd($phone);
            $user=User::where('mobile',$phone)->first();
            if(!empty($user)){
                $status['status'] = false;
                $status['message'] = "Mobile number already exits. PLease try with another phone no"; 
                return \Response::json($status);
            }
            $rtn=Helper::verifyMobileOnly($request->mobile_no);
            if($rtn['status']==true){
                $status['status'] = true;
                $status['message'] = "OTP send to your register mobile no";
                $status['otp']=$rtn['otp'];
                //localStorage.setItem('otp',$rtn['otp']); 
                return \Response::json($status);
            }
        } else{
            $status['status'] = false;
            $status['message'] = "Mobile no should not be blank!"; 
            return \Response::json($status);
        }
    }

    public function verifyMobile(Request $request){
        //dd($request->all());
        if(!empty($request->mobile)){
            $mobile_no=$request->state_code.$request->mobile;
            //dd($mobile_no);
            $get_user=User::where('mobile',$request->mobile)->first();
            if(!empty($get_user)){
                $userId=$get_user->id;
                $rtn=Helper::verifyMobile($userId,$mobile_no);
                if($rtn['status']==true){
                    $status['status'] = true;
                    $status['message'] = "OTP send to your register mobile no"; 
                    return \Response::json($status);
                }
            } else{
                $status['status'] = false;
                $status['message'] = "Mobile no no register in our system."; 
                return \Response::json($status);
            }
            
            
        } else{
            $status['status'] = false;
            $status['message'] = "Mobile no should not be blank!"; 
            return \Response::json($status);
        }
    }

    public function fetchOptionDropDownAwardCategory(Request $request){
        // Helper::pr($request->all()); die;
        $html = '<option value="">Please Select</option>';
        $param = array(
            'table' => $request->input('table'),
            'field' => $request->input('field'),
            'wherefld' => $request->input('wherefld'),
            'whereval' => $request->input('whereval'),
        );
        //Helper::pr($param); die;

        $fetch_vendor_service_category_mappings = DB::table($param['table'])->select('service_categories.id','service_categories.category_name')->join('service_categories','vendor_service_category_mappings.category_id','=','service_categories.id')->where(['vendor_service_category_mappings.vendor_id'=>$param['whereval']])->get();
        //Helper::pr($fetch_vendor_service_category_mappings); die;

        if(count($fetch_vendor_service_category_mappings) > 0){
            foreach($fetch_vendor_service_category_mappings as $val){
                
                $html .= '<option value="'.$val->id.'">'.$val->category_name.'</option>';
            }

        }else {
            $html .= '<option value="">Not Found</option>';
        }

        echo $html;
        exit;
    }
}
