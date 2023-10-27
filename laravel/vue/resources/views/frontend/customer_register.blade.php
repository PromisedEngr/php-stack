@extends('frontend.master')

@section('content')

 <!-----------inner-banner----------->

    <div class="inner-banner">
        <img src="{{asset('public/front/images/inner-banner.png')}}" alt="">
        <div class="container inner-caption-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="inner-banner-caption wow animate__fadeInUp" data-wow-duration="1500ms">
                        <h2>Customer Registration</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-----------inner-banner----------->

<!-----------customer registartion----------->
        <div class="container py-5">

        <form action="javascript:void(0)" method="POST" id="customer_register" name="customer_register">
           
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Name <b class="req">*</b></label>
                    <input type="text" name="name" id="customername" value="" class="form-control" placeholder="Enter Name">
                
                </div>
                 <div class="form-group col-md-6">
                    <label for="inputEmail4">Email <b class="req">*</b></label>
                    <input type="email" name="email" value="" class="form-control" id="inputEmail4" placeholder="Enter Email">
               
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                        <label for="inputPassword4">Mobile Number <b class="req">*</b></label>
                        <div class="row">
                            <div class="col-md-4">
                                {{ Form::select('state_code',$countryCodesDp,'+60',['id'=>'state_code','class'=>'form-control select2single']) }}
                                
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="mobile" value="{{old('mobile')}}" class="form-control validfieldnumber" id="mobile"  placeholder="Enter Mobile Number">
                                @if ($errors->has('mobile'))
                                    <span class="text-danger">{{ $errors->first('mobile') }}</span>
                                @endif
                                <p id="error_otp"></p>
                                <input type="hidden" name="otp_verified" class="otp_verified" id="otp_verified">
                            </div>
                            <div class="col-md-2">
                                <button href="javascript:void(0)" class="btn btn-sm btn-success verify_mobile" disabled>Verify</button>

                            </div>
                        </div>
                        <div class="otp_show_div" style="display:none">
                            <div class="countdown" >OTP will be expire in <span id="timer"></span></div>
                            <label for="inputPassword4">Enter OTP <b class="req">*</b></label>
                            <div class="row">
                                <div class="col-md-10">
                                    <input type="text" name="otp" id="otp" value="{{old('otp')}}" class="form-control validfieldnumber"  placeholder="Enter OTP here">
                                </div>
                                <div class="col-md-2">
                                    <button class="btn bt-sm btn-info otp_submit">Submit</button> 
                                </div>
                            </div>
                        </div>
                        
                    </div>
                
            </div>
            
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="inputState">Gender <b class="req">*</b></label>
                    <select  name="gender"  class="form-control">
                        <option value="">--Select Gender--</option>
                        <option value="0">Male</option>
                        <option value="1">Female</option>
                        <option value="2">Others</option>
                    </select>
                       
                </div>
                <div class="col-md-6">
                    <label for="inputZip">DOB <b class="req">*</b></label>
                    <input type="text" name="dob" id="dob" value="" class="form-control" >
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress">Address <b class="req">*</b></label>
                <textarea name="address" value="" class="form-control" cols="7" rows="5"></textarea>
                
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Password <b class="req">*</b></label>
                    <input type="password" name="password" value="" class="form-password form-control" id="form-password"  placeholder="Enter Password">
               
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Confirm Password <b class="req">*</b></label>
                    <input type="password" name="password_confirmation" value="" placeholder="Confirm Password" class="form-email form-control" id="form-email">
                </div>
            </div>
            <input type="hidden" name="role_id" value="1">

            <br>
            <button type="submit" class="btn btn-primary">Sign up</button>
            <div class="row">
                <div class="col-lg-12">
                  <div class="form-group already_user">
                    <p>Already have an account? <a href="{{ url('/customer_login') }}" class="txt_color_red">Login here</a></p>
                  </div>
                </div>
            </div>
            
        </form>
            
        </div>
        <p class="text-center fl-success" id="successcustomer_register" style="display:none;"></p>  
        <p class="text-center fl-success" id="errorcustomer_register" style="display:none;"></p>  

          
<script type="text/javascript" src="{{ asset('public/assets/js/view/customer/register.js') }} "></script>
<!-----------customer registartion end----------->


@endsection