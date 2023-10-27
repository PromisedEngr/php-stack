<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\ServiceCategory;
use App\Models\Configuration;
use App\Models\OcrSetting;
use App\Models\Country;
use App\Models\State;
use Illuminate\Support\Facades\Validator;
use DB;
use URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Helper;

class AdminController extends Controller
{
    public function index(){
        return view('admin.index');
    }

    public function users(){
        $users = User::where('role','1')->get();
        // echo "<pre>";
        // print_r($users);
        // echo "</pre>";
        // die();
        return view('admin.userdata',compact('users'));
    }

    public function userEdit($id){
        $user = User::find($id);
        if($user){
            return view('admin.edit_user',compact('user'));
        }else{
            return back()->with('error','Data Not Found');
        }
    }


    public function updateUser(Request $request,$id){ 
        $user = User::find($id);

        // $this->validate($request,[
        //     'name'=>'nullable|string',
        //     'mobile'=>'nullable|min:11|numeric',
        //     'email'=>'email|nullable|unique:users,email',
        //     'address'=>'string|nullable',
        //     'gender'=>'nullable',
        //     'dob'=>'nullable|date',
        //     'point'=>'nullable|numeric',
        //     'status'=>'nullable|in:active,inactive',
        // ]);

        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->address = $request->address;
        $user->gender = $request->gender;
        $user->dob = $request->dob;
        $user->point = $request->point;
        if( $user->save()){

            return redirect()->route('admin.users')->with('sucess','updated');

        }else{

            return redirect()->route('admin.users')->with('error',' not updated');
        }
               
    }


    public function destroy($id){
        $data = User::find($id);
        if($data){
        $status = $data->delete();
            if($status){
                return redirect()->route('admin.users')->with('success','Successfully deleted Banner');
            }else{
                return back()->with('error','Somthing went wrong');
            }
        }else{
            return back()->with('error','Data Not Found');
        }
    }

    public function userStatus(Request $request){
       
        if($request->mode=='true'){
            //To activate account

            $fetch_user = DB::table('users')->where('id',$request->id)->first();
            $user_name = $fetch_user->name;
            $user_email = $fetch_user->email;
            $header_url = URL::to('/')."/public/assets/images/email_header.jpg";
            $email_header = "<img src=".$header_url." >";
            
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
                                                                <p style='float:left; width: 610px; font-family: 'verdana'; font-size: 14px; color: #444444; margin:0px; padding:0px;'>Hello ".$user_name.",</p>
                                                                </td>
                                                            </tr>
                                                            <tr style='width:610px; margin:0px; padding:0px;'>
                                                                <td style='width:610px; margin:0px; padding:0px 0px 8px 0px;'>
                                                                <p style='float:left; width: 610px; font-family: 'verdana'; font-size: 13px; color: #444444; margin:0px; padding:0px;'>Thank you for connecting with us. Your account is activated.</p>
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
            $template_subject_user = "Confirmation for account active";

            $values['template_body_user']    = $template_body_user;

            $email_user                         = $fetch_user->email;
            $name_user                          = $fetch_user->name;

            Mail::send('emails.new_register_vendor', $values, function ($message) use ($email_user, $name_user, $template_subject_user){
                            $message->from('mook@elvirainfotech.live', 'Mook');
                            $message->to($email_user,$name_user);
                            $message->subject($template_subject_user);
                        });

            
           

            DB::table('users')->where('id',$request->id)->update(['status'=>'active']);

        }else{
            //To inactivate account
            $fetch_user = DB::table('users')->where('id',$request->id)->first();
            $user_name = $fetch_user->name;
            $user_email = $fetch_user->email;

            $header_url = URL::to('/')."/public/assets/images/email_header.jpg";
            $email_header = "<img src=".$header_url." >";
            
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
                                                                <p style='float:left; width: 610px; font-family: 'verdana'; font-size: 14px; color: #444444; margin:0px; padding:0px;'>Hello ".$user_name.",</p>
                                                                </td>
                                                            </tr>
                                                            <tr style='width:610px; margin:0px; padding:0px;'>
                                                                <td style='width:610px; margin:0px; padding:0px 0px 8px 0px;'>
                                                                <p style='float:left; width: 610px; font-family: 'verdana'; font-size: 13px; color: #444444; margin:0px; padding:0px;'>Your account is suspended.</p>
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
            $template_subject_user = "Confirmation for account suspended";

            $values['template_body_user']    = $template_body_user;

            $email_user                         = $fetch_user->email;
            $name_user                          = $fetch_user->name;

            Mail::send('emails.new_register_vendor', $values, function ($message) use ($email_user, $name_user, $template_subject_user){
                            $message->from('mook@elvirainfotech.live', 'Mook');
                            $message->to($email_user,$name_user);
                            $message->subject($template_subject_user);
                        });

            
            

            DB::table('users')->where('id',$request->id)->update(['status'=>'inactive']);
        }
        return response()->json(['msg'=>'Successfully status updated','status'=>true]);
    }



    public function vendors(){
        $vendors = User::where('role','3')->get();
        return view('admin.vendor.list',compact('vendors'));
    }
    public function editVendor($id=null){
      
    }

    public function profile(){
        return view('admin.profile');
    }

    public function setting(){
        return view('admin.setting');
    }
    // added by Rana Ghosh 18-02-2022
    public function serviceCategories(){
        $categories=ServiceCategory::whereNull('deleted_at')->get();
        $data['categories']=$categories;
        $data['page_title']='Service Categories';
        return view('admin.service_category.list',$data);

    }
    public function addServiceCategories(){
        $categoriesDp=ServiceCategory::whereNull('deleted_at')->where('parent_category_id',0)->pluck('category_name','id')->toArray();
        $data['categoriesDp']=$categoriesDp;
        $data['page_title']='Add Service Categories';
        return view('admin.service_category.add',$data);
    }
    public function submitServiceCategories(Request $request){
        $userId = Auth::user()->id;
        $this->validate($request,[
            'category_name'=>'required|string',
            'priority_order'=>'required|numeric',
        ]);
        $insert_data=$request->all();
        $insert_data['created_by']=$userId;
        $insert_data['created_at']=date('Y-m-d H:i:s');
        $insert_data['updated_at']=date('Y-m-d H:i:s');
        $fileName='';
        //dd($request->all());
        if(!empty($request->category_image)){
            $fileName = time().'.'.$request->category_image->extension();
            $file_error=$request->category_image->move(public_path('category_images'), $fileName);
            //dd($file_error);
            $insert_data['category_image']=$fileName;
        }
        unset($insert_data['_token']);
        if(empty($insert_data['parent_category_id'])){
            $insert_data['parent_category_id']=0;
        }
        $exits=ServiceCategory::where(['parent_category_id'=>$insert_data['parent_category_id'],'category_name'=>$insert_data['category_name']])->first();
        if(!empty($exits)){
            $status['status'] = false;
            $status['message'] = 'Service Category already present.';
            return \Response::json($status);
        } else{
            $insert_id = ServiceCategory::insertGetId($insert_data);
            if($insert_id){
                $status['status'] = true;
                $status['message'] = 'Service Category successfully added.';
                return \Response::json($status);
            }else{
                $status['status'] = false;
                $status['message'] = 'Please try again later.';
                return \Response::json($status);
            }
        }
        
    }
    public function editServiceCategories($id=null){
        $edit_data=ServiceCategory::where('id',$id)->first();
        $categoriesDp=ServiceCategory::whereNull('deleted_at')->where('parent_category_id',0)->pluck('category_name','id')->toArray();
        $data['edit_data']=$edit_data;
        $data['categoriesDp']=$categoriesDp;
        $data['page_title']='Edit Service Categories';
        return view('admin.service_category.edit',$data);
    }
    public function editServiceCategoriesSubmit(Request $request){
        $userId = Auth::user()->id;
        $this->validate($request,[
            'category_name'=>'required|string',
            'priority_order'=>'required|numeric',
        ]);
        $insert_data=$request->all();
        $insert_data['created_by']=$userId;
        $insert_data['updated_at']=date('Y-m-d H:i:s');
        $fileName='';
        //dd($request->all());
        if(!empty($request->category_image)){
            $fileName = time().'.'.$request->category_image->extension();
            $file_error=$request->category_image->move(public_path('category_images'), $fileName);
            //dd($file_error);
            $insert_data['category_image']=$fileName;
        }
        unset($insert_data['_token']);
        if(empty($insert_data['parent_category_id'])){
            $insert_data['parent_category_id']=0;
        }
        //dd($insert_data);
        $update=ServiceCategory::where('id', $insert_data['id'])->update($insert_data);
        if(!empty($update)){
            $status['status'] = true;
            $status['message'] = 'Service Category updated.';
            return \Response::json($status);
        } else{
            $status['status'] = false;
            $status['message'] = 'Please try again later.';
            return \Response::json($status);
        }
    }
    public function deleteServiceCategoriesSubmit($id=null){
        $delete=ServiceCategory::where('id',$id)->update(array('deleted_at'=>date('Y-m-d H:i:s')));
        if($delete){
            $status['status'] = true;
            $status['message'] = 'Successfully deleted';
            return \Response::json($status);
        } else{
            $status['status'] = true;
            $status['message'] = 'Please try again later.';
            return \Response::json($status);
        }

    }

    public function configurations(){
        $get_configurations=Configuration::all();
        $data['configurations']=$get_configurations;
        $data['page_title']='Configurations';
        return view('admin.configurations.list',$data);
    }

    public function configurationTwillioSubmit(Request $request){
        $this->validate($request,[
            'twillio_sid'=>'required',
            'twillio_token'=>'required',
            'twillio_phone'=>'required',
            'otp_expired_time'=>'required|numeric',
        ]);
        $insert_array=[];
        $insert_array['meta_key']='twillio_sid';
        $insert_array['meta_value']=$request->twillio_sid;
        $exits=Configuration::where('meta_key','twillio_sid')->first();
        if(!empty($exits)){
            $insert[]=Configuration::where('id',$exits->id)->update($insert_array);
        } else{
            $insert[]=Configuration::insertGetId($insert_array);
        }
        
        $insert_array=[];
        $insert_array['meta_key']='twillio_token';
        $insert_array['meta_value']=$request->twillio_token;
        $exits=Configuration::where('meta_key','twillio_token')->first();
        if(!empty($exits)){
            $insert[]=Configuration::where('id',$exits->id)->update($insert_array);
        } else{
            $insert[]=Configuration::insertGetId($insert_array);
        }
        $insert_array=[];
        $insert_array['meta_key']='twillio_phone';
        $insert_array['meta_value']=$request->twillio_phone;
        $exits=Configuration::where('meta_key','twillio_phone')->first();
        if(!empty($exits)){
            $insert[]=Configuration::where('id',$exits->id)->update($insert_array);
        } else{
            $insert[]=Configuration::insertGetId($insert_array);
        }
        $insert_array=[];
        $insert_array['meta_key']='otp_expired_time';
        $insert_array['meta_value']=$request->otp_expired_time;
        $exits=Configuration::where('meta_key','otp_expired_time')->first();
        if(!empty($exits)){
            $insert[]=Configuration::where('id',$exits->id)->update($insert_array);
        } else{
            $insert[]=Configuration::insertGetId($insert_array);
        }
        if(!empty($insert)){
            $status['status'] = true;
            $status['message'] = 'Configuration successfully updated.';
            return \Response::json($status);
        } else{
            $status['status'] = false;
            $status['message'] = 'Please try again later.';
            return \Response::json($status);
        }
    }
    
    public function configurationPointSubmit(Request $request){
        $this->validate($request,[
            'one_star_from'=>'required|numeric',
            'one_star_to'=>'required|numeric',
            'two_star_from'=>'required|numeric',
            'two_star_to'=>'required|numeric',
            'three_star_from'=>'required|numeric',
            'three_star_to'=>'required|numeric',
            'four_star_from'=>'required|numeric',
            'four_star_to'=>'required|numeric',
            'five_star_from'=>'required|numeric',
            'five_star_to'=>'required|numeric',
        ]);
        $insert_array=[];
        $insert_array['meta_key']='vendor_maximum_point';
        $insert_array['meta_value']=$request->vendor_maximum_point;
        $exits=Configuration::where('meta_key','vendor_maximum_point')->first();
        if(!empty($exits)){
            $insert[]=Configuration::where('id',$exits->id)->update($insert_array);
        } else{
            $insert[]=Configuration::insertGetId($insert_array);
        }

        $insert_array=[];
        $insert_array['meta_key']='customer_maximum_point';
        $insert_array['meta_value']=$request->customer_maximum_point;
        $exits=Configuration::where('meta_key','customer_maximum_point')->first();
        if(!empty($exits)){
            $insert[]=Configuration::where('id',$exits->id)->update($insert_array);
        } else{
            $insert[]=Configuration::insertGetId($insert_array);
        }

        $insert_array=[];
        $insert_array['meta_key']='one_star_from';
        $insert_array['meta_value']=$request->one_star_from;
        $exits=Configuration::where('meta_key','one_star_from')->first();
        if(!empty($exits)){
            $insert[]=Configuration::where('id',$exits->id)->update($insert_array);
        } else{
            $insert[]=Configuration::insertGetId($insert_array);
        }

        $insert_array=[];
        $insert_array['meta_key']='one_star_to';
        $insert_array['meta_value']=$request->one_star_to;
        $exits=Configuration::where('meta_key','one_star_to')->first();
        if(!empty($exits)){
            $insert[]=Configuration::where('id',$exits->id)->update($insert_array);
        } else{
            $insert[]=Configuration::insertGetId($insert_array);
        }

        $insert_array=[];
        $insert_array['meta_key']='two_star_from';
        $insert_array['meta_value']=$request->two_star_from;
        $exits=Configuration::where('meta_key','two_star_from')->first();
        if(!empty($exits)){
            $insert[]=Configuration::where('id',$exits->id)->update($insert_array);
        } else{
            $insert[]=Configuration::insertGetId($insert_array);
        }
        $insert_array=[];
        $insert_array['meta_key']='two_star_to';
        $insert_array['meta_value']=$request->two_star_to;
        $exits=Configuration::where('meta_key','two_star_to')->first();
        if(!empty($exits)){
            $insert[]=Configuration::where('id',$exits->id)->update($insert_array);
        } else{
            $insert[]=Configuration::insertGetId($insert_array);
        }

        $insert_array=[];
        $insert_array['meta_key']='three_star_from';
        $insert_array['meta_value']=$request->three_star_from ;
        $exits=Configuration::where('meta_key','three_star_from')->first();
        if(!empty($exits)){
            $insert[]=Configuration::where('id',$exits->id)->update($insert_array);
        } else{
            $insert[]=Configuration::insertGetId($insert_array);
        }

        $insert_array=[];
        $insert_array['meta_key']='three_star_to';
        $insert_array['meta_value']=$request->three_star_to;
        $exits=Configuration::where('meta_key','three_star_to')->first();
        if(!empty($exits)){
            $insert[]=Configuration::where('id',$exits->id)->update($insert_array);
        } else{
            $insert[]=Configuration::insertGetId($insert_array);
        }
        
        $insert_array=[];
        $insert_array['meta_key']='four_star_from';
        $insert_array['meta_value']=$request->four_star_from;
        $exits=Configuration::where('meta_key','four_star_from')->first();
        if(!empty($exits)){
            $insert[]=Configuration::where('id',$exits->id)->update($insert_array);
        } else{
            $insert[]=Configuration::insertGetId($insert_array);
        }
        $insert_array=[];
        $insert_array['meta_key']='four_star_to';
        $insert_array['meta_value']=$request->four_star_to;
        $exits=Configuration::where('meta_key','four_star_to')->first();
        if(!empty($exits)){
            $insert[]=Configuration::where('id',$exits->id)->update($insert_array);
        } else{
            $insert[]=Configuration::insertGetId($insert_array);
        }
        
        $insert_array=[];
        $insert_array['meta_key']='five_star_from';
        $insert_array['meta_value']=$request->five_star_from ;
        $exits=Configuration::where('meta_key','five_star_from')->first();
        if(!empty($exits)){
            $insert[]=Configuration::where('id',$exits->id)->update($insert_array);
        } else{
            $insert[]=Configuration::insertGetId($insert_array);
        }
        $insert_array=[];
        $insert_array['meta_key']='five_star_to';
        $insert_array['meta_value']=$request->five_star_to;
        $exits=Configuration::where('meta_key','five_star_to')->first();
        if(!empty($exits)){
            $insert[]=Configuration::where('id',$exits->id)->update($insert_array);
        } else{
            $insert[]=Configuration::insertGetId($insert_array);
        }

        if(!empty($insert)){
            $status['status'] = true;
            $status['message'] = 'Configuration successfully updated.';
            return \Response::json($status);
        } else{
            $status['status'] = false;
            $status['message'] = 'Please try again later.';
            return \Response::json($status);
        }
    }

    public function ocrSettings(){
        $ocr_settings=OcrSetting::all();
        $data['ocr_settings']=$ocr_settings;
        $data['page_title']='OCR Settings';
        return view('admin.ocr.list',$data);
    }
    public function ocrWordSubmit(Request $request){
        $this->validate($request,[
            'ocr_word'=>'required',
        ]);
        $ocr_words=explode(',',$request->ocr_word);
        foreach($ocr_words as $ocr_word){
            $exits=OcrSetting::where('ocr_word',trim($ocr_word))->first();
            if(!empty($exits)){
                $present[]=1;
            } else{
                $insert[]=OcrSetting::insertGetId(['ocr_word'=>trim($ocr_word)]);
                
            }
        }
        if(!empty($insert)){
            $status['status'] = true;
            $status['message'] = 'Added successfully.';
            return \Response::json($status);
        } else{
            if(!empty($present)){
                $status['status'] = false;
                $status['message'] = 'Words already exits.';
                return \Response::json($status);
            } else{
                $status['status'] = false;
                $status['message'] = 'Please try again later.';
                return \Response::json($status);
            }
            
        }
        
    }

    public function ocrWordDelete($id){
        $delete=OcrSetting::where('id',$id)->delete();
        if($delete){
            $status['status'] = true;
            $status['message'] = 'Word deleted successfully.';
            return \Response::json($status);
        } else{
            $status['status'] = false;
            $status['message'] = 'Please try again later.';
            return \Response::json($status);
        }
    }

    public function country(Request $request){
        $data['page_title']='Country';
        $get_country=Country::orderBy('id','desc')->get();
        $data['get_country']=$get_country;
        return view('admin.country.country',$data);
      
    }

    public function addcountry(Request $request){
       //Helper::pr($request->all()); die;
       $data = $request->all();
       $validator = Validator::make($request->all(), [
           'name'=>'required',
        ]);
        if($validator->fails()){
            $status['success'] = false;
            $status['message'] =  $validator->errors();
        }

        // check dublicate
        $checkCountry = Country::where('name', $data['name'])->count();

        if($checkCountry > 0 ){
            $status['status'] = false;
            $status['message'] = 'Country already exists';
            return \Response::json($status);

        }

        $insertData = ['name' => $data['name']];
        $insert = DB::table('countries')->insert($insertData);

        if($insert){
            $status['status'] = true;
            $status['message'] = 'Country added successfully.';
            return \Response::json($status);

        }else {
            $status['status'] = false;
            $status['message'] = 'Something went wrong';
            return \Response::json($status);

        }

    }

    public function setdataCountry(Request $request){

        $validator = Validator::make($request->all(), [
           'countryId'=>'required',
        ]);
        if($validator->fails()){
            $status['success'] = false;
            $status['message'] =  $validator->errors();
        }
       $data = $request->all();
       $getSingleCountry = Country::where('id',$data['countryId'])->first();
       if(!empty($getSingleCountry)){
            $status['status'] = true;
            $status['getSingleCountry'] = $getSingleCountry;
            $status['message'] = 'Country fetched successfully.';
            return \Response::json($status); 
       }else {
            $status['status'] = false;
            $status['message'] = 'Something went wrong';
            return \Response::json($status);
       }
    }

    public function editcountry(Request $request){
        $data = $request->all();
        $validator = Validator::make($request->all(), [
           'name'=>'required',
        ]);
        if($validator->fails()){
            $status['success'] = false;
            $status['message'] =  $validator->errors();
        }

        // check dublicate
        $checkCountry = Country::where('name', $data['name'])->where('id','!=',$data['country_id'])->count();
        
        if($checkCountry > 0 ){
            $status['status'] = false;
            $status['message'] = 'Country already exists';
            return \Response::json($status);
        }

        $updateData = ['name' => $data['name']];
        $update = DB::table('countries')->where('id', $data['country_id'])->update($updateData);

        if($update){
            $status['status'] = true;
            $status['message'] = 'Country updated successfully.';
            return \Response::json($status);
        }else {
            $status['status'] = false;
            $status['message'] = 'Something went wrong';
            return \Response::json($status);

        }
    }

    public function deletedataCountry(Request $request){
       $data = $request->all();
       $deteCountry = Country::where('id','=',$data['deletecountryId'])->delete();
       $deleteSate = State::where('country_id','=',$data['deletecountryId'])->delete();
       if($deteCountry){
            $status['status'] = true;
            $status['message'] = 'Country deleted and related States successfully.';
            return \Response::json($status);

       }else {
            $status['status'] = false;
            $status['message'] = 'Something went wrong';
            return \Response::json($status);

       }
    }

    public function state(Request $request){
        $data['page_title']='State';
        $get_state=State::join('countries', 'countries.id', '=', 'states.country_id')->orderBy('states.id', 'desc')
                ->get(['states.id as state_id', 'states.name as state_name','countries.name']);
        $data['get_state']=$get_state;
        return view('admin.state.state',$data);
      
    }

    public function addstate(Request $request){
       $data = $request->all();
       $validator = Validator::make($request->all(), [
           'name'=>'required',
        ]);
        if($validator->fails()){
            $status['success'] = false;
            $status['message'] =  $validator->errors();
        }

        // check dublicate
        $checkCountry = State::where(['name'=> $data['name'], 'country_id' =>  $data['country_id']])->count();
        
        if($checkCountry > 0 ){
            $status['status'] = false;
            $status['message'] = 'State already exists';
            return \Response::json($status);

        }

        $insertData =   ['name' => $data['name'],
                        'country_id' => $data['country_id']
                        ];
        $insert = State::insert($insertData);

        if($insert){
            $status['status'] = true;
            $status['message'] = 'State added successfully.';
            return \Response::json($status);

        }else {
            $status['status'] = false;
            $status['message'] = 'Something went wrong';
            return \Response::json($status);

        }

    }

    public function setdataState(Request $request){
        //Helper::pr($request->all()); die;
        $validator = Validator::make($request->all(), [
           'editStateId'=>'required',
        ]);
        if($validator->fails()){
            $status['success'] = false;
            $status['message'] =  $validator->errors();
        }
       $data = $request->all();
      // $fetchdublicateState = State::where('id',$data['editStateId'])->first();
       //
       $getSinglestate = State::where(['id'=>$data['editStateId']])->first();
       if(!empty($getSinglestate)){
            $status['status'] = true;
            $status['getSinglestate'] = $getSinglestate;
            $status['message'] = 'Country fetched successfully.';
            return \Response::json($status); 
       }else {
            $status['status'] = false;
            $status['message'] = 'Something went wrong';
            return \Response::json($status);
       }
    }

    public function editState(Request $request){
        
        $data = $request->all();
        $validator = Validator::make($request->all(), [
           'name'=>'required',
           'editcountry_id' => 'required',
           'state_id' => 'required'
        ]);
        if($validator->fails()){
            $status['success'] = false;
            $status['message'] =  $validator->errors();
        }

        // check dublicate
        $checkState = State::where(['name'=> $data['name'],'country_id' =>$data['editcountry_id']])->where('id','!=',$data['state_id'])->count();
        
        if($checkState > 0 ){
            $status['status'] = false;
            $status['message'] = 'State already exists';
            return \Response::json($status);
        }

        $updateData = [ 'name' => $data['name'],
                        'country_id' => $data['editcountry_id']
                        ];
        $update = DB::table('states')->where('id', $data['state_id'])->update($updateData);

        if($update){
            $status['status'] = true;
            $status['message'] = 'State updated successfully.';
            return \Response::json($status);
        }else {
            $status['status'] = false;
            $status['message'] = 'Something went wrong';
            return \Response::json($status);

        }
    }

    public function deletedataState(Request $request){
        $data = $request->all();
        $deteCountry = State::where('id','=',$data['deletestateId'])->delete();
        if($deteCountry){
            $status['status'] = true;
            $status['message'] = 'State deleted successfully.';
            return \Response::json($status);
        }else {
            $status['status'] = false;
            $status['message'] = 'Something went wrong';
            return \Response::json($status);

        }
    }

}
