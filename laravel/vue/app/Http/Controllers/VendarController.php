<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Voucher;
use App\Models\Countries;
use App\Models\States;
use App\Models\Categories;
use App\Models\VoucherCategory;
use App\Models\ServiceCategory;
use App\Models\VendorImageDetail;
use App\Models\Task;
use App\Models\CountryCode;
use App\Models\Vendorapplytaskmapping;
use App\Models\VendorServiceCategoryMapping;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;
use URL;
use Session;
use Helper;
use DB;

class VendarController extends Controller
{
    public function index(){
        return view('vendar.index');
    }

    public function profile(){
        return view('vendar.vendor_profile');
    }

    public function setting(){
        return view('vendar.setting');
    }

    public function create_register(){
        
       $categoriesDp=ServiceCategory::where('parent_category_id',0)->whereNull('deleted_at')->orderBy('category_name','asc')->pluck('category_name','id')->toArray();
       $countryCodes=CountryCode::orderBy('nicename','asc')->get();
       $countryCodesDp=[];
       if(!empty($countryCodes)){
           foreach($countryCodes as $code){
               $countryCodesDp['+'.$code->phonecode]=$code->nicename.'(+'.$code->phonecode.')';
           }
       }

        $data['categoriesDp']=$categoriesDp;
        $data['countryCodesDp']=$countryCodesDp;
        return view('frontend.vendor_register',$data);
    }

    public function vendor_registration(Request $request)
    {   
        
        $this->validate($request,[
            'name'=>'required|string',
            'email'=>'required|email',
            'company_name'=>'required|unique:users,company_name',
            'state_code' => 'required',
            'mobile'=>'required|min:11|numeric',
            'email'=>'email|required|unique:users,email',
            'password'=>'required|string|confirmed|min:4',
            'status'=>'nullable|in:active,inactive',
        ]);
        //dd($request['password']);

        if($request['password'] != $request['password_confirmation']){
            $status['status'] = false;
            $status['message'] = 'Password and Confirm Password are not same.';
            return \Response::json($status);

        }
        $phone_no=$request['state_code'].$request['mobile'];
        //dd($phone_no);
        $twillio_sid = Helper::getConfiguration('twillio_sid');
        $twillio_token = Helper::getConfiguration('twillio_token');
        $twilio = new Client($twillio_sid, $twillio_token);
        
        /*$validation_request = $twilio->validationRequests
                             ->create($phone_no, // phoneNumber
                                [
                                    "friendlyName" => $phone_no,
                                    "statusCallback" => "https://somefunction.twil.io/caller-id-validation-callback"
                                ]
                             );*/

        //print($validation_request);

        $checkMobileNumber = User::where('role', '=', $request['role_id'])->where('mobile','=',$request['mobile'])->get();
        $dublicateCheckMobileNumber = $checkMobileNumber->count();

        if($dublicateCheckMobileNumber > 0 ){
            $status['status'] = false;
            $status['message'] = 'Mobile number already exists';
            //return \Response::json($status);

        }

        $checkEmail= User::where('role', '=', $request['role_id'])->where('email','=',$request['email'])->get();
        $dublicateCheckEmail = $checkEmail->count();

        if($dublicateCheckEmail > 0){
            $status['status'] = false;
            $status['message'] = 'Email address already exists';
            return \Response::json($status);

        }

        $checkCompanyName= User::where('role', '=', $request['role_id'])->where('company_name','=',$request['company_name'])->get();
        $dublicateCheckCompanyName = $checkCompanyName->count();

        if($dublicateCheckCompanyName > 0){
            $status['status'] = false;
            $status['message'] = 'Company Name already exists';
            return \Response::json($status);

        }

        $insertData = $request->all();
        
        $insertData['password'] =Hash::make($request->password);
        $insertData['role'] =3;
        unset($insertData['category_id']);
        unset($insertData['password_confirmation']);
        unset($insertData['role_id']);
        //dd($insertData);
        //DB::enableQueryLog();
        $result = User::insertGetId($insertData);
        //$quesry=DB::getQueryLog();

        $categories=$request->category_id;
        if(!empty($categories)){
            foreach ($categories as $category) {
                if(!empty($category)){
                    $insert_array=array(
                        'vendor_id'=>$result,
                        'category_id'=>$category,
                        'created_at'=>date('Y-m-d H:i:s')
                    );
                    //$exits=VendorServiceCategoryMapping::where('vendor_id',$userId)->where('category_id',$category)->first();
                    //if(empty($exits)){
                        $insert_id[]=VendorServiceCategoryMapping::insertGetId($insert_array);
                    //}
                }
            }
        }


        //Sending Email to admin
        $adminEmail = 'rajdeep.elvirainfotech@gmail.com';
        $adminname  = "Rajdeep Barui";

        $header_url = URL::to('/')."/public/assets/images/email_header.jpg";

       $email_header = "<img src=".$header_url." >";


        $template_body_admin  = "<table border='0' cellpadding='0' cellspacing='0' style='width:650px; background-color:#ffffff; margin:0px; padding:0px;'>".$email_header."
                                    <tbody>
                                        <tr style='width:650px; margin:0px; padding:0px;'>
                                            <td style='width:610px; margin:0px; padding:0px 20px; '>
                                            <table border='0' cellpadding='0' cellspacing='0' style='width:610px; margin:0px; padding:0px;'><!-- hello user -->
                                                <tbody>
                                                    <tr style='width:610px; margin:0px; padding:0px;'>
                                                        <td style='width:610px; margin:0px; padding:0px;'>
                                                        <table style='width:610px; margin:0px; padding:0px; '>
                                                            <tbody>
                                                                <tr style='width:610px; margin:0px; padding:0px;'>
                                                                    <td style='width:610px; margin:0px; padding:0px 0px 12px 0px;'>
                                                                    <p style='float:left; width: 610px; font-family: 'verdana'; font-size: 14px; color: #444444; margin:0px; padding:0px;'>Hello Admin,</p>
                                                                    </td>
                                                                </tr>
                                                                <tr style='width:610px; margin:0px; padding:0px;'>
                                                                    <td style='width:610px; margin:0px; padding:0px 0px 8px 0px;'>
                                                                    <p style='float:left; width: 610px; font-family: 'verdana'; font-size: 13px; color: #444444; margin:0px; padding:0px;'>A new Vendor has just joined our team.</p>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        </td>
                                                    </tr>
                                                    <!-- user details -->
                                                    <tr style='width:610px; margin:0px; padding:0px;'>
                                                        <td align='left' style='width:610px; margin:0px; padding: 0px; background: #ffffff;'>
                                                        <table border='0' cellpadding='0' cellspacing='0' style='width:610px; background-color:#ffffff; margin:0px; padding:0px;'>
                                                            <tbody>
                                                                <tr style='width:610px; margin:0px; padding:0px;'>
                                                                    <td style='width:610px; margin:0px; padding:0px 0px 8px 0px;'>
                                                                    <p style='float:left; width: 610px; font-family: 'verdana'; font-size: 13px; color: #444444; margin:0px; padding:0px;'>Respective details are as follows:</p>
                                                                    </td>
                                                                </tr>
                                                                <tr style='width:610px; margin:0px; padding:0px;'>
                                                                    <td align='left' colspan='2' style='width:610px; margin:0px; padding: 0px; height: 1px; background: #eeeeee;'>&nbsp;</td>
                                                                </tr>
                                                                <tr style='width:610px; margin:0px; padding:0px;'>
                                                                    <td align='left' style='width:188px; margin:0px; padding: 10px; background: #ffffff; border-right: 1px solid #eeeeee; border-left: 1px solid #eeeeee;'>
                                                                    <p style='font-family: 'verdana'; font-size: 13px; color: #444444; margin:0px;'>Name:</p>
                                                                    </td>
                                                                    <td align='right' style='width:378px; margin:0px; padding: 10px; background: #ffffff; border-right: 1px solid #eeeeee;'>
                                                                    <p style='font-family: 'verdana'; font-size: 13px; color: #444444; margin: 0px; text-align: left;'><a href='javascript:void(0);' style='text-decoration:none;  color: #333; '>".$insertData['name']."</a></p>
                                                                    </td>
                                                                </tr>
                                                                <tr style='width:610px; margin:0px; padding:0px;'>
                                                                    <td align='left' colspan='2' style='width:610px; margin:0px; padding: 0px; height: 1px; background: #eeeeee;'>&nbsp;</td>
                                                                </tr>
                                                                <tr style='width:610px; margin:0px; padding:0px;'>
                                                                    <td align='left' style='width:188px; margin:0px; padding: 10px; background: #ffffff; border-right: 1px solid #eeeeee; border-left: 1px solid #eeeeee;'>
                                                                    <p style='font-family: 'verdana'; font-size: 13px; color: #444444; margin:0px;'>Email:</p>
                                                                    </td>
                                                                    <td align='right' style='width:378px; margin:0px; padding: 10px; background: #ffffff; border-right: 1px solid #eeeeee;'>
                                                                    <p style='font-family: 'verdana'; font-size: 13px; color: #444444; margin: 0px; text-align: left;'><a href='javascript:void(0);' style='text-decoration:none;  color: #333; '>".$insertData['email']."</a></p>
                                                                    </td>
                                                                </tr>
                                                                <tr style='width:610px; margin:0px; padding:0px;'>
                                                                    <td align='left' colspan='2' style='width:610px; margin:0px; padding: 0px; height: 1px; background: #eeeeee;'>&nbsp;</td>
                                                                </tr>
                                                                <tr style='width:610px; margin:0px; padding:0px;'>
                                                                    <td align='left' style='width:188px; margin:0px; padding: 10px; background: #ffffff; border-right: 1px solid #eeeeee; border-left: 1px solid #eeeeee;'>
                                                                    <p style='font-family: 'verdana'; font-size: 13px; color: #444444; margin:0px;'>Phone Number:</p>
                                                                    </td>
                                                                    <td align='right' style='width:378px; margin:0px; padding: 10px; background: #ffffff; border-right: 1px solid #eeeeee;'>
                                                                    <p style='font-family: 'verdana'; font-size: 13px; color: #444444; margin: 0px; text-align: left;'>".$insertData['mobile']."</p>
                                                                    </td>
                                                                </tr>
                                                                <tr style='width:610px; margin:0px; padding:0px;'>
                                                                    <td align='left' colspan='2' style='width:610px; margin:0px; padding: 0px; height: 1px; background: #eeeeee;'>&nbsp;</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            </td>
                                        </tr>
                                        <tr>
                                        <td style='background: #f94144;padding: 25px 20px;text-align: center;color: #fff;font-size: 14px;'>© CLEANING EXPERT ". date("Y")." ALL RIGHTS RESERVED</td>
                                    </tr>
                                    </tbody>
                                </table>";
        $template_subject_admin = "Mook Market Place | New Register Vendor";


        $values['template_body_admin']    = $template_body_admin;

        
        
       

        Mail::send('emails.new_register_vendor_admin', $values, function ($message) use ($adminEmail, $adminname, $template_subject_admin){
                        $message->from('mook@elvirainfotech.live', 'Mook');
                        $message->to($adminEmail,$adminname);
                        $message->subject($template_subject_admin);
                    });

        // sending Email to user

        $template_body_user  = "<table border='0' cellpadding='0' cellspacing='0' style='width:650px; background-color:#ffffff; margin:0px; padding:0px;'>".$email_header."
                                    <tbody>
                                        <tr style='width:650px; margin:0px; padding:0px;'>
                                            <td style='width:610px; margin:0px; padding:0px 20px; '>
                                            <table border='0' cellpadding='0' cellspacing='0' style='width:610px; margin:0px; padding:0px;'><!-- hello user -->
                                                <tbody>
                                                    <tr style='width:610px; margin:0px; padding:0px;'>
                                                        <td style='width:610px; margin:0px; padding:0px;'>
                                                        <table style='width:610px; margin:0px; padding:0px; '>
                                                            <tbody>
                                                                <tr style='width:610px; margin:0px; padding:0px;'>
                                                                    <td style='width:610px; margin:0px; padding:0px 0px 12px 0px;'>
                                                                    <p style='float:left; width: 610px; font-family: 'verdana'; font-size: 14px; color: #444444; margin:0px; padding:0px;'>Hello ".$insertData['name'].",</p>
                                                                    </td>
                                                                </tr>
                                                                <tr style='width:610px; margin:0px; padding:0px;'>
                                                                    <td style='width:610px; margin:0px; padding:0px 0px 8px 0px;'>
                                                                    <p style='float:left; width: 610px; font-family: 'verdana'; font-size: 13px; color: #444444; margin:0px; padding:0px;'>Thank you for connecting with us. Your account will be activated soon.</p>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            </td>
                                        </tr>
                                        <tr>
                                        <td style='background: #f94144;padding: 25px 20px;text-align: center;color: #fff;font-size: 14px;'>© CLEANING EXPERT ". date("Y")." ALL RIGHTS RESERVED</td>
                                    </tr>
                                    </tbody>
                                </table>";
        $template_subject_user = "Thank you for your Registration as Vendor";

        $values['template_body_user']    = $template_body_user;

        $email_user                         = $insertData['email'];
        $name_user                          = $insertData['name'];

        Mail::send('emails.new_register_vendor', $values, function ($message) use ($email_user, $name_user, $template_subject_user){
                        $message->from('mook@elvirainfotech.live', 'Mook');
                        $message->to($email_user,$name_user);
                        $message->subject($template_subject_user);
                    });


        if($result){
            $status['status'] = true;
            $status['message'] = "You have successfully registered, please check your Email id"; 
            return \Response::json($status);

        }else{
            $status['status'] = false;
            $status['message'] = "Something went wrong"; 
            return \Response::json($status);

        }  
    }

    public function vendor_login(){
        return view('frontend.vendor_login');
    }

    public function vendorLogin(Request $request)
    {
        $data = $request->all();
        $password= $data['password'];
        //dd($password);
        $get_user=User::where('mobile',$data['mobile'])->first();
        if(!empty($get_user)){
            if (!Hash::check($password, $get_user->password)) {
                $status['status'] = false;
                $status['message'] = 'Mobile no or password is wrong'; 
                return \Response::json($status);
            } else{
                $state_code=$data['state_code'];
                $mobile=$data['mobile'];
                $password=$data['password'];
                $to=$state_code.$mobile;
                $otp=mt_rand(100000,999999);
                $update=User::where('id',$get_user->id)->update(['otp'=>$otp,'otp_date'=>date('Y-m-d H:i:s')]);
                $message = Helper::verifyMobile($get_user->id,$to);
                if(!empty($message['status']==true)){
                        $status['status'] = true;
                        $status['message'] = 'OTP send to your mobile no'; 
                        $status['mobile'] = $mobile; 
                        $status['password'] = $password; 
                        return \Response::json($status);
                
                } else{
                    $status['status'] = false;
                    $status['message'] = 'Code not send from twilio. Please try again later.'; 
                    return \Response::json($status);
                }
            }
            
        } else{
            $status['status'] = false;
            $status['message'] = 'Mobile no or password is wrong'; 
            return \Response::json($status);
        }
        
    }

    public function submitLoginCode(Request $request){

        //////////////////////////////// For Otp ///////////////////////
        /*$this->validate($request,[
            // 'name'=>'required',
            //'email'=>'required|email',
            'mobile'=>'required|numeric',
        ]);
        $data = $request->all();
        //dd($data);
        $verifyvendor = User::where(['mobile' => $data['mobile'], 'role' => 3])->first();
        if(!empty($verifyvendor)){
            if($verifyvendor->otp==$data['otp']){
                if($verifyvendor->status == "active" ){
                    $credentials = array('password'=>$data['password'],'email'=>$verifyvendor->email,'role'=>3);
                    
                    if(Auth::guard('vendor')->attempt($credentials)){
                          $vendor = User::select('users.*')->find(auth()->guard('vendor')->user()->id);
                          $make_online = User::where('id', '=', auth()->guard('vendor')->user()->id)->update(array('is_online_offline' => 1));
                            Session::put('vendor', $vendor);
                            $status['status'] = true;
                            $status['message'] = 'Successfully LoggedIn'; 
                            return \Response::json($status);
                     }else {
                         $status['status'] = false;
                         $status['message'] = "Username or Password doesn't match"; 
                         return \Response::json($status);
                     }
                } else{
                    $status['status'] = false;
                    $status['message'] = 'Your account has not been activated.'; 
                    return \Response::json($status);
                }
            } else{
                $status['status'] = false;
                $status['message'] = 'You enter wrong OTP. Please verify your OTP.'; 
                return \Response::json($status);
            }
        } else{
            $status['status'] = false;
            $status['message'] = "User not present"; 
            return \Response::json($status); 
        }*/

        /////////////////////// For Non Otp ////////////////////////

        $this->validate($request,[
            'mobile'=>'required|numeric',
        ]);

 
        $data = $request->all();
        $credentials = request(['mobile', 'password','role']);
       
        if(Auth::guard('vendor')->attempt($credentials)){
           $verifyvendor = User::where(['mobile' => $data['mobile'], 'role' => $data['role']])->first();
           if($verifyvendor->status == "inactive" ){
                    $status['status'] = false;
                    $status['message'] = 'Your account has not been activated.'; 
                    return \Response::json($status);

            }
            if($verifyvendor->role != 3){
                $status['status'] = false;
                $status['message'] = 'You are not a vendor. Please enter correct email or password'; 
                return \Response::json($status);

            }

             $vendor = User::select('users.*')->find(auth()->guard('vendor')->user()->id);

                Session::put('vendor', $vendor);
                $status['status'] = true;
                $status['message'] = 'Successfully LoggedIn'; 
                return \Response::json($status);


        }else {
            $status['status'] = false;
            $status['message'] = "Username or Password doesn't match"; 
            return \Response::json($status);
        } 
    }

    public function vendordashboard(){
       return view('vendar.dashboard');
    }

    public function logout()
    {
        //Session::forget('vendor');
        $make_online = User::where('id', '=', auth()->guard('vendor')->user()->id)->update(array('is_online_offline' => 0));
        Session::flush();
        Auth::logout();
        return \Redirect::route('vendorloginpage');
    }

    public function vendorForgetpassword(){
       return view('frontend.vendor_forgetpassword');
    }

    public function vendorforgetpasswordSubmit(Request $request){
        $data = $request->all();
        $verifyemail = User::where(['email' => $data['email'], 'role' => $data['role']])->first();
        if(!empty($verifyemail)){
            if($verifyemail->role == 3){
                if($verifyemail->status == "active"){
                    $length = 6;
                    $password = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()', ceil($length/strlen($x)) )),1,$length);
                    $UpdateData['password'] = \Hash::make($password);
                    $Update =  User::where('id', $verifyemail->id)->update(array('password' => $UpdateData['password']));
                    $header_url = URL::to('/')."/public/assets/images/email_header.png";
                    $footer_url = URL::to('/')."/public/assets/images/email_footer.png";

                    // $email_header = "<img src=".$header_url." >";
                    // $email_footer = "<img src=".$footer_url." >";

                    $template_body_user  = "<table border='0' cellpadding='0' cellspacing='0' style='width:650px; background-color:#ffffff; margin:0px; padding:0px;'><!-- HEADER -->
                                    <tbody>
                                        <tr style='width:650px; margin:0px; padding:0px;'>
                                            <td style='width:610px; margin:0px; padding:0px 20px; '>
                                            <table border='0' cellpadding='0' cellspacing='0' style='width:610px; margin:0px; padding:0px;'><!-- hello user -->
                                                <tbody>
                                                    <tr style='width:610px; margin:0px; padding:0px;'>
                                                        <td style='width:610px; margin:0px; padding:0px;'>
                                                        <table style='width:610px; margin:0px; padding:0px; '>
                                                            <tbody>
                                                                <tr style='width:610px; margin:0px; padding:0px;'>
                                                                    <td style='width:610px; margin:0px; padding:0px 0px 12px 0px;'>
                                                                    <p style='float:left; width: 610px; font-family: 'verdana'; font-size: 14px; color: #444444; margin:0px; padding:0px;'>Hello ".$verifyemail->name.",</p>
                                                                    </td>
                                                                </tr>
                                                                <tr style='width:610px; margin:0px; padding:0px;'>
                                                                    <td style='width:610px; margin:0px; padding:0px 0px 8px 0px;'>
                                                                    <p style='float:left; width: 610px; font-family: 'verdana'; font-size: 13px; color: #444444; margin:0px; padding:0px;'>Your new password is.</p>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        </td>
                                                    </tr>
                                                    <tr style='width:610px; margin:0px; padding:0px;'>
                                                        <td align='left' style='width:610px; margin:0px; padding: 0px; background: #ffffff;'>
                                                        <table border='0' cellpadding='0' cellspacing='0' style='width:610px; background-color:#ffffff; margin:0px; padding:0px;'>
                                                            <tbody>
                                                                <tr style='width:610px; margin:0px; padding:0px;'>
                                                                    <td style='width:610px; margin:0px; padding:0px 0px 8px 0px;'>
                                                                    <p style='float:left; width: 610px; font-family: 'verdana'; font-size: 13px; color: #444444; margin:0px; padding:0px;'>Respective details are as follows:</p>
                                                                    </td>
                                                                </tr>
                                                                <tr style='width:610px; margin:0px; padding:0px;'>
                                                                    <td align='left' colspan='2' style='width:610px; margin:0px; padding: 0px; height: 1px; background: #eeeeee;'>&nbsp;</td>
                                                                </tr>
                                                                
                                                                <tr style='width:610px; margin:0px; padding:0px;'>
                                                                    <td align='left' style='width:188px; margin:0px; padding: 10px; background: #ffffff; border-right: 1px solid #eeeeee; border-left: 1px solid #eeeeee;'>
                                                                    <p style='font-family: 'verdana'; font-size: 13px; color: #444444; margin:0px;'>Password:</p>
                                                                    </td>
                                                                    <td align='right' style='width:378px; margin:0px; padding: 10px; background: #ffffff; border-right: 1px solid #eeeeee;'>
                                                                    <p style='font-family: 'verdana'; font-size: 13px; color: #444444; margin: 0px; text-align: left;'>".$password."</p>
                                                                    </td>
                                                                </tr>
                                                                <tr style='width:610px; margin:0px; padding:0px;'>
                                                                    <td align='left' colspan='2' style='width:610px; margin:0px; padding: 0px; height: 1px; background: #eeeeee;'>&nbsp;</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            </td>
                                        </tr>
                                        <!-- FOOTER -->
                                    </tbody>
                                </table>";
                    $template_body_user                 = str_replace("<!-- HEADER -->","<img src=".$header_url." >",$template_body_user);
                   // $template_body_user                 = str_replace("<!-- FOOTER -->","<img src=".$footer_url." >",$template_body_user);
                    $template_subject_user = "Mook Market Place | Password Change";

                    $values['template_body_user']    = $template_body_user;

                    $email_user                         = $verifyemail->email;
                    $name_user                          = $verifyemail->name;

                    Mail::send('emails.new_register_vendor', $values, function ($message) use ($email_user, $name_user, $template_subject_user){
                        $message->from('mook@elvirainfotech.live', 'Mook');
                        $message->to($email_user,$name_user);
                        $message->subject($template_subject_user);
                    });

                    $status['status'] = true;
                    $status['message'] = "Please check your mail for password."; 
                    return \Response::json($status);




                }else {
                    $status['status'] = false;
                    $status['message'] = "Your account is not active."; 
                    return \Response::json($status);
                }

            }else {

                $status['status'] = false;
                $status['message'] = "This is not a correct email."; 
                return \Response::json($status);
            }

        }else {
            $status['status'] = false;
            $status['message'] = "This email id does not exist!"; 
            return \Response::json($status);
        }
       
    }

    public function vendorforgetpasswordSubmitNew(Request $request){
        $this->validate($request,[
            'mobile'=>'required|numeric',
            'otp'=>'required|numeric',
            'password'=>'required',
        ]);
        $get_user=User::where('mobile',$request->mobile)->first();
        //dd($request->otp);
        if(!empty($get_user)){
            $verifyOtp=Helper::checkOtp($get_user->id,$request->otp);
            if($verifyOtp['status']==true){
                $password=Hash::make($request->password);

                //dd($password);
                $update=User::where('id',$get_user->id)->update(['password'=>$password]);
                if($update){
                    $status['status'] = true;
                    $status['message'] = 'Your password successfully changed.'; 
                    return \Response::json($status); 
                } else{
                    $status['status'] = false;
                    $status['message'] = "Please try again later."; 
                    return \Response::json($status); 
                }
            }else{
                $status['status'] = false;
                $status['message'] = $verifyOtp['message']; 
                return \Response::json($status);    
            }
        } else{
            $status['status'] = false;
            $status['message'] = "User not exist!"; 
            return \Response::json($status);
        }
        

    }

    public function viewProfile(Request $request){
        
        $userId =Auth::guard('vendor')->id();
        $services=VendorServiceCategoryMapping::where('vendor_id',$userId)->pluck('category_id')->toArray();
        $categoriesDp=ServiceCategory::where('parent_category_id',0)->whereNull('deleted_at')->orderBy('category_name','asc')->pluck('category_name','id')->toArray();
        $user=User::where(['id' => $userId])->with('vendor_images')->first();

        //dd($user->vendor_images->path);
        $data['user']=$user;
        $data['categoriesDp']=$categoriesDp;
        $data['services']=$services;
        if($user){
            return view('vendar.vendor_profile',$data);
        }else{
            return back()->with('error','Data Not Found');
        }

    }
    public function editProfile(Request $request){
        $userId = Auth::guard('vendor')->id();
         $this->validate($request,[
            'vendor_name'=>'required|string',
        ]);

        $update_data['name']=$request->vendor_name;
        $update_data['address']=$request->company_address;
        $fileName='';
        //dd($request->all());
        if(!empty($request->profile_image)){
            $fileName = time().'.'.$request->profile_image->extension();
            $file_error=$request->profile_image->move(public_path('profile_images'), $fileName);
            //dd($file_error);
            $update_data['profile_image']=$fileName;
        }
        $update = User::where('id',$userId)->update($update_data);
        if($update){
            $status['status'] = true;
            $status['message'] = 'Profile update successfully.';
            return \Response::json($status);
        }else{
            $status['status'] = false;
            $status['message'] = 'Please try again later.';
            return \Response::json($status);
        }

    }

    public function addServicePhoto(Request $request){
        $userId = Auth::guard('vendor')->id();
         $this->validate($request,[
            'service_photo'=>'required',
        ]);
        $fileName='';
        // check upload image limit
        $image_limit=User::where('id',$userId)->first();
        $limit=!empty($image_limit) ? $image_limit->image_count:10;
        $image_limit_count=VendorImageDetail::where('fk_vendor_id',$userId)->count();
        //dd(count($request->file('service_photo')));
        $uploaded_image_count=count($request->file('service_photo'))+$image_limit_count;

        if($uploaded_image_count<=$limit){ // check upload image limit
            if(!empty($request->file('service_photo'))){
                foreach ($request->file('service_photo') as $file) {
                    $update_data=[];
                    $fileName = time().rand(1,100).'.'.$file->extension();
                    $file_error=$file->move(public_path('profile_images'), $fileName);
                    $update_data['fk_vendor_id']=$userId;
                    $update_data['type']='image';
                    $update_data['path']=$fileName;
                    $update_data['created_at']=date('Y-m-d H:i:s');
                    $update[] = VendorImageDetail::insertGetId($update_data);
                }
                
            }
            
            if($update){
                $status['status'] = true;
                $status['message'] = 'Profile update successfully.';
                return \Response::json($status);
            }else{
                $status['status'] = false;
                $status['message'] = 'Please try again later.';
                return \Response::json($status);
            }
        } else{
            if($image_limit_count<10){
                $extra_message='You can not upload more than '.$limit.' images';
            } else{
                $extra_message='You have already reached your maximum upload limits 10.';
            }
            $status['status'] = false;
            $status['message'] = $extra_message;
            return \Response::json($status);
        }
        

        

    }
    

    public function changePassword(Request $request){
        return view('vendar.vendor_changepassword');
    }

    public function vendorchangepasswordSubmit(Request $request){
        $old_password    = $request->old_password;
        $new_password   = $request->new_password;
        $re_password    = $request->confirm_password;

        if(isset($old_password) && isset($new_password) && isset($re_password) && !empty($old_password) && !empty($new_password) && !empty($re_password)){
                if($new_password == $re_password){
                    $UpdateData['new_password'] = Hash::make($new_password);
                    $UpdateData['id']           = Auth::guard('vendor')->user()->id;

                    $credentials = array(
                        'email'  => Auth::guard('vendor')->user()->email,
                        'password'  => $old_password,
                    );
                    
                    if(Auth::guard('vendor')->attempt($credentials)){


                        $result = User::where(array('id' => $UpdateData['id']))->update(array('password' => $UpdateData['new_password']));
                        if($result){
                            $status['status'] = true;
                            $status['message'] = "Password updated successfully"; 
                            return \Response::json($status);


                        }else{
                            $status['status'] = false;
                            $status['message'] = "Something went wrong"; 
                            return \Response::json($status);

                        }

                    }else{
                        $status['status'] = false;
                        $status['message'] = "Old password doesnot match"; 
                        return \Response::json($status);
                    }

                }else{
                    $status['status'] = false;
                    $status['message'] = "New Password and confirm password should match"; 
                    return \Response::json($status);

                }

            }else{
                $status['status'] = false;
                $status['message'] = "Some fields are missing"; 
                return \Response::json($status);

            }
    }

    public function vouchers(){
        $userId =Auth::guard('vendor')->id();
        $vouchers = Voucher::where('vendor_id',$userId)->orderBy('id','desc')->get();
        $totalVoucher= Voucher::where('vendor_id',$userId)->count();
        $data['vouchers']=$vouchers;
        $data['totalVoucher']=$totalVoucher;
        return view('vendar.vouchers',$data);

    }

    public function createVoucher(){
        $userId =Auth::guard('vendor')->id();
        $countryDp=Countries::orderBy('name','asc')->pluck('name','id')->toArray();
        
        $stateDp=States::where('country_id',132)->orderBy('name','asc')->pluck('name','id')->toArray();
        $categoryDp=VoucherCategory::where('vendor_id',$userId)->where('parent_id',0)->orderBy('name','asc')->pluck('name','id')->toArray();
        //array_unshift($stateDp,'Select State');
        //array_unshift($categoryDp,'Select Category');
        //dd($stateDp);
        $data['countryDp']=$countryDp;
        $data['stateDp']=$stateDp;
        $data['categoryDp']=$categoryDp;
        
        return view('vendar.create_voucher',$data);
    }

    public function storeVoucher(Request $request){
        $id = Auth::guard('vendor')->id();
        $this->validate($request,[
            
            'voucher_name'=>'required|string',
            'add_date'=>'required|date',
            'expiry_date'=>'required|date',
            'voucher_point'=>'required',
            'status'=>'nullable|in:active,inactive',
        ]);

        $data = $request->all();
        $data['vendor_id']=$id;
        $data['redemption']=0;
        $data['status']='active';
        $data['add_date'] =  date('Y-m-d', strtotime($data['add_date']));
        $data['expiry_date'] = date('Y-m-d', strtotime($data['expiry_date']));
        $status = Voucher::create($data);
        if($status){
            $status['status'] = true;
            $status['message'] = 'Successfully Created Voucher.';
            return \Response::json($status);
        }else{
            $status['status'] = false;
            $status['message'] = 'Please try again later.';
            return \Response::json($status);
        }

    }
    public function showVoucherDetails($id=null){
        if(!empty($id)){
            $voucher_details=Voucher::where('id',$id)->first();
            if(!empty($voucher_details)){
                $country_name=Helper::get_field('countries', 'id',$voucher_details->fk_country_id,'name');
                $state_name=Helper::get_field('states', 'id',$voucher_details->fk_state_id,'name');
                $admin_approved=($voucher_details->admin_approved==1) ? '<p style="color:green">Approved</p>' : '<p style="color:red">Pending</p>';
                $status_text=($voucher_details->status=='active') ? '<p style="color:green">Active</p>' : '<p style="color:red">Inactive</p>';

               
                $html='<table class="table table-responsive w-100 d-block d-md-table">
                <tbody>
                <tr>
                  <th>Voucher Name</th>
                  <td>'.$voucher_details->voucher_name.'</td>
                </tr>
                <tr>
                  <th>Addded At</th>
                  <td>'. date('d-m-Y', strtotime($voucher_details->add_date)).'</td>
                </tr>
                <tr>
                  <th>Expired At</th>
                  <td>'.date('d-m-Y', strtotime($voucher_details->expiry_date)).'</td>
                </tr>
                <tr>
                  <th>Description</th>
                  <td>'.$voucher_details->description.'</td>
                </tr>
                <tr>
                  <th>Voucher Point</th>
                  <td>'.$voucher_details->voucher_point.'</td>
                </tr>
                <tr>
                  <th>Total Redeemed</th>
                  <td>'.$voucher_details->redemption.'</td>
                </tr>
                <tr>
                  <th>Country</th>
                  <td>'.$country_name.'</td>
                </tr>
                <tr>
                  <th>State</th>
                  <td>'.$state_name.'</td>
                </tr>
                <tr>
                  <th>Admin Approved</th>
                  <td>'.$admin_approved.'</td>
                </tr>
                <tr>
                  <th>Status</th>
                  <td>'.$status_text.'</td>
                </tr>
                <tr>
                  <th>Created At</th>
                  <td>'.date('d-m-Y', strtotime($voucher_details->created_at)).'</td>
                </tr>
                </tbody>
              </table>';
                $status['status'] = true;
                $status['html'] = $html;
                return \Response::json($status);
            } else{
                $status['status'] = false;
                $status['html'] = 'No data found.';
                return \Response::json($status);
            }
            
        } else{
            $status['status'] = false;
            $status['html'] = 'No data found.';
            return \Response::json($status);
        }
        
    }
    public function voucherStatusUpdate(Request $request){
        //dd($request->all()); exit;
        $update=Voucher::where('id',$request->voucher_id)->update(array('status'=>$request->status));
        if($update){
            $status['status'] = true;
            $status['html'] = 'Status successfully updated.';
            return \Response::json($status);
        } else{
            $status['status'] = false;
            $status['html'] = 'Please try again later.';
            return \Response::json($status);
        }
        
    }
    
    public function voucherEdit($id=null){
        $userId = Auth::guard('vendor')->id();
        $edit_data=Voucher::where('id',$id)->first();
        $data['edit_data'] =$edit_data;
        $countryDp=Countries::orderBy('name','asc')->pluck('name','id')->toArray();
        
        $stateDp=States::where('country_id',$edit_data->fk_country_id)->orderBy('name','asc')->pluck('name','id')->toArray();
        $categoryDp=VoucherCategory::where('vendor_id',$userId)->where('parent_id',0)->orderBy('name','asc')->pluck('name','id')->toArray();
        $subcategoryDp=VoucherCategory::where('vendor_id',$userId)->where('parent_id',$edit_data->fk_category_id)->orderBy('name','asc')->pluck('name','id')->toArray();
        $data['countryDp']=$countryDp;
        $data['stateDp']=$stateDp;
        $data['categoryDp']=$categoryDp;
        $data['subcategoryDp']=$subcategoryDp;
        
        return view('vendar.edit_voucher',$data);
    }
    public function voucherEditSubmit(Request $request){
        $userId = Auth::guard('vendor')->id();
        $this->validate($request,[
            
            'voucher_name'=>'required|string',
            'add_date'=>'required|date',
            'expiry_date'=>'required|date',
            'voucher_point'=>'required',
        ]);

        $data = $request->all();
        $data['vendor_id']=$userId;
        $data['updated_at']=date('Y-m-d H:i:s');
        $data['add_date'] =  date('Y-m-d', strtotime($data['add_date']));
        $data['expiry_date'] = date('Y-m-d', strtotime($data['expiry_date']));
        unset($data['_token']);
        unset($data['id']);
        $update = Voucher::where('id',$request->id)->update($data);
        if($update){
            $status['status'] = true;
            $status['message'] = 'Successfully Updated.';
            return \Response::json($status);
        }else{
            $status['status'] = false;
            $status['message'] = 'Please try again later.';
            return \Response::json($status);
        }
    }

    public function getStateByCountry($country_id=null){
        $states=States::where('country_id',$country_id)->orderBy('name','asc')->get();
        //dd($states);
        $html='<option value="">Select State</option>';
        if(!empty($states)){
            foreach ($states as $state) {
               $html.='<option value="'.$state->id.'">'.$state->name.'</option>';
            }
            $status['status'] = true;
            $status['html'] = $html;
            return \Response::json($status);
        } else{
            $status['status'] = false;
            $status['html'] = $html;
            return \Response::json($status);
        }
        
    }

    public function voucherDelete($voucher_id=null){
        $delete=Voucher::where('id',$voucher_id)->delete();
        if($delete){
            $status['status'] = true;
            $status['message'] ='Successfully deleted.';
            return \Response::json($status);
        } else{
            $status['status'] = false;
            $status['message'] ='Try again later.';
            return \Response::json($status);
        }
    }

    public function voucherCategorySubmit(Request $request){
        $userId = Auth::guard('vendor')->id();
        $this->validate($request,[
            'name'=>'required|string',
        ]);
        $data = $request->all();
        $data['vendor_id']=$userId;
        $data['created_at']=date('Y-m-d H:i:s');
        $data['updated_at']=date('Y-m-d H:i:s');
        if(empty($data['parent_id'])){
            $data['parent_id']=0;
        }
        // check duplicate value
        $exits=VoucherCategory::where(['vendor_id'=>$userId,'name'=>$data['name']])->first();
        if(empty($exits)){
            $insert = VoucherCategory::insertGetId($data);
            if($insert){
                $categories=VoucherCategory::where('vendor_id',$userId)->where('parent_id',0)->orderBy('name','asc')->get();
                //dd($states);
                $html='<option value="">Select Category</option>';
                if(!empty($categories)){
                    foreach ($categories as $category) {
                        $html.='<option value="'.$category->id.'">'.$category->name.'</option>';
                    }
                }
                $status['status'] = true;
                $status['message'] = 'Category successfully added.';
                $status['html'] = $html;
                return \Response::json($status);
            }else{
                $status['status'] = false;
                $status['message'] = 'Please try again later.';
                $status['html'] = '';
                return \Response::json($status);
            }
        } else{
            $status['status'] = true;
                $status['message'] = 'Category already present.';
                $status['html'] = '';
                return \Response::json($status);
        }
        
    }

    public function getVoucherSubCategory(Request $request){
        $userId = Auth::guard('vendor')->id();
        $parent_id=$request->parent_id;
        $sub_categories=VoucherCategory::where(['vendor_id' => $userId,'parent_id'=>$parent_id])->get();
        $html='<option value="">Select Sub Category</option>';
        if(!empty($sub_categories)){
            foreach ($sub_categories as $sub_category) {
                $html.='<option value="'.$sub_category->id.'">'.$sub_category->name.'</option>';
            }
        }
        $status['status'] = true;
        $status['html'] = $html;
        return \Response::json($status);
    }
    // added by Rana ghosh 17-02-2022
    public function getServiceCategory($category_id=null){
        if(!empty($category_id)){
            $categories=ServiceCategory::where('parent_category_id',$category_id)->whereNull('deleted_at')->orderBy('category_name','asc')->get();
        } else{
            $categories=ServiceCategory::where('parent_category_id',0)->whereNull('deleted_at')->orderBy('category_name','asc')->get();
        }
        $html='';
        if(!empty($categories)){
            foreach($categories as $category){
                $html.='<option value="'.$category->id.'">'.$category->category_name.'</option>';
            }
        } 
        $status['status'] = true;
        $status['html'] = $html;
        return \Response::json($status);
    }

    public function addVendorServiceCategory(Request $request){
        $userId = Auth::guard('vendor')->id();
        $categories=$request->category_id;
        if(!empty($categories)){
            foreach($categories as $category){
                if(!empty($category)){
                    $insert_array=array(
                        'vendor_id'=>$userId,
                        'category_id'=>$category,
                        'created_at'=>date('Y-m-d H:i:s')
                    );
                    $exits=VendorServiceCategoryMapping::where('vendor_id',$userId)->where('category_id',$category)->first();
                    if(empty($exits)){
                        $insert_id[]=VendorServiceCategoryMapping::insertGetId($insert_array);
                    }
                }
            }
        }
        $status['status'] = true;
        $status['message'] = 'Service successfully added.';
        return \Response::json($status);
    }
    public function deleteService($id=null){
        $delete=VendorServiceCategoryMapping::where('id',$id)->delete();
        if($delete){
            $status['status'] = true;
            $status['message'] = 'Service successfully added.';
            return \Response::json($status);
        } else{
            $status['status'] = false;
            $status['message'] = 'Please try again later.';
            return \Response::json($status);
        }
    }

    // Added by Rana Ghosh 21-02-2022
    public function generateVoucherCode($id=null){
        if(!empty($id)){
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $code=strtoupper(substr(sha1(time()), 0, 10));
            //echo $code; exit;
            $update=Voucher::where('id',$id)->update(['voucher_code'=>$code]);
            if($update){
                $status['status'] = true;
                $status['message'] = 'Voucher Code generated successfully.';
                return \Response::json($status);
            } else{
                $status['status'] = false;
                $status['message'] = 'Please try again later.';
                return \Response::json($status);
            }
        }
    }
    
    public function getTasks(){
        $userId = Auth::guard('vendor')->id();
        $my_tasks=Task::where('fk_vendor_id',$userId)->orderBy('id','desc')->get();
        $vendor_service_category=VendorServiceCategoryMapping::where('vendor_id',$userId)->pluck('category_id')->toArray();

        $all_tasks=Task::whereIn('fk_category_id',$vendor_service_category)->where('status',1)->orderBy('id','desc')->get();
        $data['my_tasks']=$my_tasks;
        $data['all_tasks']=$all_tasks;
        $data['page_title']='Tasks';
        return view('vendar.task.list',$data);
    }

    public function acceptTasks($id=null){
        $userId = Auth::guard('vendor')->id();
        $update=Task::where('id',$id)->update(['accepted_by'=>$userId,'fk_vandor_id'=>$userId,'accepted_at'=>date('Y-m-d H:i:s'),'status'=>2]);
        if($update){
            $status['status'] = true;
            $status['message'] = 'Task accepted successfully.';
            return \Response::json($status);
        } else{
            $status['status'] = false;
            $status['message'] = 'Please try again later.';
            return \Response::json($status);
        }
    }
    // added by Rana Ghosh 23-02-2022
    public function deleteServiceImage($id=null){
        // delete image first
        $imageDetails=VendorImageDetail::where('id',$id)->first();
        $image_path=$imageDetails->path;
        
        $delete=VendorImageDetail::where('id',$id)->delete();
        unlink(public_path().'/profile_images/'.$image_path);
        if($delete){
            $status['status'] = true;
            $status['message'] = 'Delete Successfully';
            return \Response::json($status);
        } else{
            $status['status'] = false;
            $status['message'] = 'Please try again later.';
            return \Response::json($status);
        }
    }

    public function jobtask(Request $request){
        return view('frontend.vendor_postedTask');
    }
    
    public function fetchCustomerTask(Request $request){
        $conditions = $request->all();
        //
        $vendor_id = auth()->guard('vendor')->user()->id;
        
        $task_per_page       = 1;  //Number of items set it to 3
        $fetch_customer_task = Task::Select('tasks.id',
                                            'tasks.task_name',
                                            'tasks.task_description',
                                            'tasks.fk_category_id',
                                            'tasks.amount',
                                            'tasks.expected_date',
                                            'tasks.address',
                                            'tasks.customer_country_id',
                                            'tasks.customer_state_id',
                                            'tasks.city',
                                            'tasks.zipcode',
                                            'tasks.status',
                                            'tasks.created_at',
                                            'service_categories.category_name',
                                            'countries.name as countryname',
                                            'states.name as statesname'
                                            )
                                ->join('service_categories', 'tasks.fk_category_id', '=', 'service_categories.id')
                                ->join('countries', 'tasks.customer_country_id', '=', 'countries.id')
                                ->join('states', 'tasks.customer_state_id', '=', 'states.id')
                                ->join('vendor_service_category_mappings', 'tasks.fk_category_id', '=', 'vendor_service_category_mappings.category_id')
                                ->where('tasks.status', 1)
                                ->where('vendor_service_category_mappings.vendor_id', $vendor_id)
                                ->where('tasks.admin_approved', 1)
                                ->orderBy('tasks.id','desc');
        
        $countFetchServices = $fetch_customer_task->count();
        if(isset($conditions['current_page']) && !empty($conditions['current_page'])){
            $page_number            = $conditions['current_page'];
        }else{
            $page_number                = 1; //if there's no page number, set it to 1
        }

        $page_position = (($page_number-1) * $task_per_page);

        $fetch_customer_task = $fetch_customer_task->skip($page_position)->take($task_per_page)->get();
        
        $total_pages = ceil($countFetchServices/$task_per_page);

        $fetchCategoryMapping = VendorServiceCategoryMapping::where(["vendor_id" => $vendor_id])->get();


       if($fetch_customer_task){
            $status['status'] = true;
            $status['fetch_customer_task'] = $fetch_customer_task;
            $status['page_number'] = intval($page_number);
            $status['countFetchServices'] = $countFetchServices;
            $status['total_pages'] = $total_pages;
            $status['fetchCategoryMapping'] = $fetchCategoryMapping;
            $status['message'] = 'Customer Task fetch Successfully';
            return \Response::json($status);

       }else {
            $status['status'] = false;
            $status['message'] = 'Something went wrong';
            return \Response::json($status);
       }

    }

    public function applytask(Request $request){
        $fetch_category = Task::select('id','fk_customer_id','fk_category_id')->where('id','=', $request['get_taskid'])->first();
        
        if(!empty($fetch_category)){
            $userId = Auth::guard('vendor')->id();
           
           // Check if the Vendor Work in that Category
           $check_vendor = VendorServiceCategoryMapping::where(['vendor_id'=> $userId, 'category_id'=>$fetch_category->fk_category_id ])->first();
            //
            if(!empty($check_vendor)){
                // Insert Into VendorapplyTaskMapping 
                    // Check Dublicate
                        $dublicateCheck = Vendorapplytaskmapping::where(['fk_customer_id'=>$fetch_category->fk_customer_id, 'fk_vendor_id'=>$check_vendor->vendor_id, 'fk_category_id'=>$check_vendor->category_id, 'fk_task_id'=>$fetch_category->id])->first();
                        
                        //Helper::pr($dublicateCheck); die;
                        if(!empty($dublicateCheck)){
                            $status['status'] = false;
                            $status['message'] = 'You have already applied for this task';
                            return \Response::json($status);

                        }else {
                            $insertData = array('fk_customer_id'=>$fetch_category->fk_customer_id,
                                                'fk_vendor_id'=>$check_vendor->vendor_id,
                                                'fk_category_id'=>$check_vendor->category_id, 
                                                'fk_task_id'=>$fetch_category->id,
                                            );
                            $insert = Vendorapplytaskmapping::insertGetId($insertData);
                        }
                        
                        if(!empty($insert)){
                            $status['status'] = true;
                            $status['message'] = 'Successfully applied for this task';
                            return \Response::json($status);

                        }else {
                            $status['status'] = false;
                            $status['message'] = 'Something went wrong';
                            return \Response::json($status);
                        }
            }else {
                $status['status'] = false;
                $status['message'] = 'Sorry! You cannot apply for this Task';
                return \Response::json($status);
           } 
        }else {
            $status['status'] = false;
            $status['message'] = 'Something went wrong';
            return \Response::json($status);

        }

    }
}
