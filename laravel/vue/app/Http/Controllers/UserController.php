<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use URL;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Validator;


class UserController extends Controller
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

        return view('frontend.customer_register');
    }

    public function customer_registration(Request $request)
    {   

        // $this->validate($request,[
        //     'name'=>'required|string',
        //     'mobile'=>'required|min:11|numeric',
        //     'email'=>'email|required|unique:users,email',
        //     'password'=>'required|string|confirmed|min:4',
        //     'address'=>'string|required',
        //     'gender'=>'required',
        //     'dob'=>'required|date',
        //     // 'role'=>'required|in:admin,vendor,customer',
        //     'status'=>'nullable|in:active,inactive',
        // ]);

        

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
        $data['dob'] = date("Y-m-d", strtotime($request->dob));

        $result = User::create($data);

        //Sending Email to admin
        $adminEmail = 'rajdeep.elvirainfotech@gmail.com';
        $adminname  = "Rajdeep Barui";

        $header_url = URL::to('/')."/public/assets/images/email_header.png";
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
                                        <!-- Footer -->
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
                                        <!-- Footer --> 
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
            $status['message'] = "Please check your mail id"; 
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
        $credentials = request(['email', 'password','role']);

        if(Auth::guard('customer')->attempt($credentials)){
           $verifycustomer = User::where(['email' => $data['email'], 'role' => $data['role']])->first();
           if($verifycustomer->status == "inactive" ){
                    $status['status'] = false;
                    $status['message'] = 'Your account has not been activated.'; 
                    return \Response::json($status);

            }
            if($verifycustomer->role != 1){
                $status['status'] = false;
                $status['message'] = 'You are not a customer. Please enter correct email or password'; 
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

    public function customerdashboard(Request $request){
        return view('customer.dashboard');
    }

    public function logout()
    {
        //Session::forget('vendor');
        Session::flush();
        return \Redirect::route('customerloginpage');
    }


}
