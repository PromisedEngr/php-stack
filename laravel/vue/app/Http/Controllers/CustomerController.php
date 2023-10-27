<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\CountryCode;
use App\Models\Vendorapplytaskmapping;
use App\Models\ServiceTask;
use App\Models\Task;
use App\Models\ServiceCategory;
use URL;
use Session;
use Helper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;

use Illuminate\Support\Facades\Validator;


class CustomerController extends Controller
{
    public function index(){
        return view('user.index');
    }

    public function profile(){
        return view('user.profile');
    }

    public function setting(){
        return view('user.setting');
    }

    public function create_register(){
        $countryCodes=CountryCode::orderBy('nicename','asc')->get();
        $countryCodesDp=[];
        if(!empty($countryCodes)){
            foreach($countryCodes as $code){
                $countryCodesDp['+'.$code->phonecode]=$code->nicename.'(+'.$code->phonecode.')';
            }
        }
        $data['countryCodesDp']=$countryCodesDp;
        return view('frontend.customer_register',$data);
    }

    public function customer_registration(Request $request)
    {   

         $this->validate($request,[
             'name'=>'required|string',
             'mobile'=>'required|min:11|numeric|unique:users,email',
             'state_code'=>'required',
             'email'=>'email|required|unique:users,email',
             'password'=>'required|string|confirmed|min:4',
             'address'=>'string|required',
             'gender'=>'required',
             'dob'=>'required|date',
            //'role'=>'required|in:admin,vendor,customer',
             'status'=>'nullable|in:active,inactive',
         ]);

        

        if($request['password'] != $request['password_confirmation']){
            $status['status'] = false;
            $status['message'] = 'Password and Confirm Password are not same.';
            return \Response::json($status);

        }

        $checkMobileNumber = User::where('role', '=', $request['role_id'])->where('mobile','=',$request['mobile'])->get();
        $dublicateCheckMobileNumber = $checkMobileNumber->count();

        if($dublicateCheckMobileNumber > 0 ){
            $status['status'] = false;
            $status['message'] = 'Mobile number already exists';
            return \Response::json($status);

        }
        // add phone no in twillio
        $phone_no=$request['state_code'].$request['mobile'];
        //dd($phone_no);
        $twillio_sid = config('constants.twillio_sid');
        $twillio_token = config('constants.twillio_token');
        $twilio = new Client($twillio_sid, $twillio_token);
        
        /*$validation_request = $twilio->validationRequests
                             ->create($phone_no, // phoneNumber
                                [
                                    "friendlyName" => $phone_no,
                                    "statusCallback" => "https://somefunction.twil.io/caller-id-validation-callback"
                                ]
                             );*/
        // add phone no in twillio end 

        $checkEmail= User::where('role', '=', $request['role_id'])->where('email','=',$request['email'])->get();
        $dublicateCheckEmail = $checkEmail->count();

        if($dublicateCheckEmail > 0){
            $status['status'] = false;
            $status['message'] = 'Email address already exists';
            return \Response::json($status);

        }

        

        $data = $request->all();
        $data['password'] =Hash::make($request->password);
        $data['role'] =1;
        $data['status'] = "active";
        $data['dob'] = date("Y-m-d", strtotime($request->dob));
        
        $result = User::create($data);

        //Sending Email to admin
        $adminEmail = 'rajdeep.elvirainfotech@gmail.com';
        $adminname  = "Rajdeep Barui";

        $header_url = URL::to('/')."/public/assets/images/email_header.jpg";
       // $footer_url = URL::to('/')."/public/assets/images/email_footer.png";
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
                                                                    <p style='float:left; width: 610px; font-family: 'verdana'; font-size: 13px; color: #444444; margin:0px; padding:0px;'>A new Customer has just joined our team.</p>
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
                                                                    <p style='font-family: 'verdana'; font-size: 13px; color: #444444; margin: 0px; text-align: left;'><a href='javascript:void(0);' style='text-decoration:none;  color: #333; '>".$data['name']."</a></p>
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
                                                                    <p style='font-family: 'verdana'; font-size: 13px; color: #444444; margin: 0px; text-align: left;'><a href='javascript:void(0);' style='text-decoration:none;  color: #333; '>".$data['email']."</a></p>
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
                                                                    <p style='font-family: 'verdana'; font-size: 13px; color: #444444; margin: 0px; text-align: left;'>".$data['mobile']."</p>
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
        $template_subject_admin = "Mook Market Place | New Register Customer";


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
                                                                    <p style='float:left; width: 610px; font-family: 'verdana'; font-size: 14px; color: #444444; margin:0px; padding:0px;'>Hello ".$data['name'].",</p>
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
        $template_subject_user = "Thank you for your Registration as Customer";

        $values['template_body_user']    = $template_body_user;

        $email_user                         = $data['email'];
        $name_user                          = $data['name'];

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

    public function customer_login(Request $request){
        return view('frontend.customer_login');
    }

    public function submitCustomerlogin(Request $request){
        
        $data = $request->all();
        $credentials = request(['mobile', 'password','role']);

        if(Auth::guard('customer')->attempt($credentials)){
           $verifycustomer = User::where(['mobile' => $data['mobile'], 'role' => $data['role']])->first();
           if($verifycustomer->status == "inactive" ){
                    $status['status'] = false;
                    $status['message'] = 'Your account has not been activated.'; 
                    return \Response::json($status);

            }
            if($verifycustomer->role != 1){
                $status['status'] = false;
                $status['message'] = 'You are not a customer. Please enter correct mobile number or password'; 
                return \Response::json($status);

            }

             $customer = User::select('users.*')->find(auth()->guard('customer')->user()->id);
                Session::put('customer', $customer);
                $status['status'] = true;
                $status['message'] = 'Successfully LoggedIn'; 
                return \Response::json($status);

        }else {
            $status['status'] = false;
            $status['message'] = "Username or Password doesn't match"; 
            return \Response::json($status);
        }

    }
    public function customerMobileVerify(Request $request){
        $this->validate($request,[
            'mobile'=>'required|numeric',
            'state_code'=>'required',
        ]);
        
        $get_user=User::where('mobile',$request->mobile)->first();
        if(!empty($get_user)){
            
            $password=$request->password;
            if (!Hash::check($password, $get_user->password)) {
                $status['status'] = false;
                $status['message'] = 'Mobile no or password is wrong'; 
                return \Response::json($status);
            }else{
                $mobile=$request->state_code.$request->mobile;
                $otp=mt_rand(100000,999999);
                $update=User::where('id',$get_user->id)->update(['otp'=>$otp,'otp_date'=>date('Y-m-d H:i:s')]);
                $message = Helper::verifyMobile($get_user->id,$mobile);
                if(!empty($message['status']==true)){
                        $status['status'] = true;
                        $status['message'] = 'OTP send to your mobile no'; 
                        $status['mobile'] = $request->mobile; 
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
            $status['message'] = "Mobile no not register in our system"; 
            return \Response::json($status);
        }
    }

    public function customerFinalLoginSubmit(Request $request){
        $this->validate($request,[
            'mobile'=>'required|numeric',
            'otp'=>'required',
            'password'=>'required',
        ]);
        $verify_customer = User::where(['mobile' => $request->mobile, 'role' => 1])->first();
        if(!empty($verify_customer)){
            if($verify_customer->otp== $request->otp){
                if($verify_customer->status == "active" ){
                    $credentials = array('password'=>$request->password,'email'=>$verify_customer->email,'role'=>1);
                    
                    if(Auth::guard('customer')->attempt($credentials)){
                        $customer = User::select('users.*')->find(auth()->guard('customer')->user()->id);
                        Session::put('customer', $customer);
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
        }
    }

    public function customerdashboard(Request $request){
        return view('customer.dashboard');
    }

    public function logout()
    {
        //Session::forget('vendor');
        Session::flush();
        Auth::logout();
        return \Redirect::route('customerloginpage');
    }

    
    public function customerForgetpassword(Request $request){
        return view('frontend.customerForgetpassword');
    }

    public function customerforgetpasswordSubmit(Request $request){
        $data = $request->all();

        $verifyemail = User::where(['email' => $data['email'], 'role' => $data['role']])->first();
        
       
        if(!empty($verifyemail)){
            if($verifyemail->role == 1){
                if($verifyemail->status == "active"){
                    $length = 6;
                    $password = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()', ceil($length/strlen($x)) )),1,$length);
                    $UpdateData['password'] = \Hash::make($password);
                    $Update =  User::where('id', $verifyemail->id)->update(array('password' => $UpdateData['password']));
                    $header_url = URL::to('/')."/public/assets/images/email_header.jpg";

                    $email_header = "<img src=".$header_url." >";
                    $template_body_user  = "<table border='0' cellpadding='0' cellspacing='0' style='width:650px; background-color:#ffffff; margin:0px; padding:0px;'>
                        ".$email_header."
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
                                        <tr>
                                            <td style='background: #f94144;padding: 25px 20px;text-align: center;color: #fff;font-size: 14px;'>© CLEANING EXPERT ". date("Y")." ALL RIGHTS RESERVED</td>
                                            </tr>
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

    public function customerforgetpasswordSubmitNew(Request $request){
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

    public function customer_profile(Request $request){

        $customer_details = User::select('users.*')->find(auth()->guard('customer')->user()->id);
        $details['customer_details'] = $customer_details;
       
        return view('customer.viewProfile',$details);


    }

    public function customerUpdateProfile(Request $request){
       $data = $request->all();
        //    Helper::pr($data); die;
       
        $this->validate($request,[
            'name'=>'required|string',
        ]);
        $update_data['name']= $data['name'];
        $update_data['address']= $data['address'];
        if(!empty($data['dob'])){
            $update_data['dob']=date('Y-m-d', strtotime($data['dob'])) ;
        }
          
        $fileName='';
        if(!empty($request->profile_image)){
            $fileName = time().'.'.$request->profile_image->extension();
            $file_error=$request->profile_image->move(public_path('profile_images'), $fileName);
            //dd($file_error);
            $update_data['profile_image']=$fileName;
        }

        // Helper::pr($update_data); die;

        $update = User::where('id',$data['user_id'])->update($update_data);
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

    public function changePassword(Request $request){
       
        $old_password    = $request->old_password;
        $new_password   = $request->new_password;
        $re_password    = $request->confirm_password;

        if(isset($old_password) && isset($new_password) && isset($re_password) && !empty($old_password) && !empty($new_password) && !empty($re_password)){
                if($new_password == $re_password){
                    $UpdateData['new_password'] = Hash::make($new_password);
                    $UpdateData['user_id']           = Auth::guard('customer')->user()->id;

                    $credentials = array(
                        'email'  => Auth::guard('customer')->user()->email,
                        'password'  => $old_password,
                    );


                    
                    if(Auth::guard('customer')->attempt($credentials)){
                        $result = User::where(array('id' => $UpdateData['user_id']))->update(array('password' => $UpdateData['new_password']));
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

    public function jobnotification(Request $request){
       return view('customer.job_notification');
    }

    public function notificationslisting(Request $request){
      // Helper::pr($request->all()); die;
      $auth_id = Auth::guard('customer')->user()->id;
      $data = $request->all();
      $notification_per_page       = 3;
      $fetchjobmappings = Vendorapplytaskmapping::select(   'users.id as user_id',
                                                            'users.name as user_name',
                                                            'users.profile_image as user_profile_image',
                                                            'users.company_name as vendor_company_name',
                                                            'service_categories.id as service_categories_id',
                                                            'service_categories.category_name as service_category_name',
                                                            'tasks.id as task_id',
                                                            'tasks.task_name',
                                                            'tasks.status',
                                                            'vendorapplytaskmappings.fk_customer_id',
                                                            'vendorapplytaskmappings.fk_vendor_id',
                                                            'vendorapplytaskmappings.fk_category_id',
                                                            'vendorapplytaskmappings.fk_task_id',
                                                    )
                                                ->join('users', 'users.id', '=', 'vendorapplytaskmappings.fk_vendor_id')
                                                ->join('service_categories','service_categories.id','=','vendorapplytaskmappings.fk_category_id')
                                                ->join('tasks', 'tasks.id', '=', 'vendorapplytaskmappings.fk_task_id')
                                                ->where('vendorapplytaskmappings.fk_customer_id','=',$auth_id)
                                                ->orderBy('vendorapplytaskmappings.id','desc');
            $countFetchServices = $fetchjobmappings->count();
            if(isset($conditions['current_page']) && !empty($conditions['current_page'])){
                $page_number            = $conditions['current_page'];
            }else {
                $page_number                = 1; //if there's no page number, set it to 1
            }
            $page_position = (($page_number-1) * $notification_per_page);

            $fetchjobmappings = $fetchjobmappings->skip($page_position)->take($notification_per_page)->get();
            $total_pages = ceil($countFetchServices/$notification_per_page);
        if(!empty($fetchjobmappings)){

            $status['status'] = true;
            $status['fetchjobmappings'] = $fetchjobmappings;
            $status['page_number'] = intval($page_number);
            $status['countFetchServices'] = $countFetchServices;
            $status['total_pages'] = $total_pages;
            $status['message'] = "Successfully fetched"; 
            return \Response::json($status);

        }else {
            $status['status'] = false;
            $status['message'] = "No Vendors applied your jobs"; 
            return \Response::json($status);

        }

    }


}
