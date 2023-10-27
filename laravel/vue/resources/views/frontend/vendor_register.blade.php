@extends('frontend.master')

@section('content')


 <!-----------inner-banner----------->

    <div class="inner-banner">

    <img src="{{asset('public/front/images/inner-banner.png')}}" alt="">

    <div class="container inner-caption-container">

        <div class="row">

            <div class="col-md-12">

                <div class="inner-banner-caption wow animate__fadeInUp" data-wow-duration="1500ms">
                    <h2>Vendor Registration</h2>
                </div>

            </div>

        </div>

</div>

</div>

<!-----------inner-banner----------->

<!-----------vendor registartion----------->
        <div class="container py-5">

            <form action="javascript:void(0)" id="registerFormVendor" name="registerFormVendor" method="POST">
               
                <div class="form-row">
                    <div class="form-group col-md-6">
                    <label for="inputEmail4">Name <b class="req">*</b></label>
                    <input type="text" id="vendor_name" name="name" value="{{old('name')}}" class="form-control validfield" placeholder="Enter Name">
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Email <b class="req">*</b></label>
                        <input type="email" name="email" value="{{old('email')}}" class="form-control" id="inputEmail4" placeholder="Enter Email">
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
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
                    
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Company Name <b class="req">*</b></label>
                        <input type="text" name="company_name" value="{{old('company_name')}}" class="form-control validfield" placeholder="Enter Company Name">
                        @if ($errors->has('company_name'))
                            <span class="text-danger">{{ $errors->first('company_name') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputAddress">Company Address</label>
                    <textarea name="address" value="{{old('address')}}" class="form-control" cols="5" rows="5"></textarea>
                    @if ($errors->has('address'))
                        <span class="text-danger">{{ $errors->first('address') }}</span>
                    @endif
                </div>

                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                    <label for="inputPassword4">Password <b class="req">*</b></label>
                    <input type="password" name="password" value="{{old('password')}}" class="form-password form-control" id="form-password"  placeholder="Enter Password">
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                    </div>

                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Confirm Password <b class="req">*</b></label>
                        <input type="password" name="password_confirmation" value="{{old('password')}}" placeholder="Confirm Password" class="form-email form-control" id="form-email">
                    @if ($errors->has('password_confirmation'))
                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                </div>

                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                            <label for="inputPassword4">Services <b class="req">*</b></label>
                            {{ Form::select('category_id[]',$categoriesDp,'',['class'=>'form-control select2 category_id','multiple'=>'multiple']) }}
                    </div>
                </div>
                <input type="hidden" name="role_id" value="3">

                

                <!-- <div class="form-row">
                    <div class="form-group col-md-4">
                    <label for="inputState">Gender</label>
                    <select id="inputState" name="gender" value="{{old('gender')}}" class="form-control">
                        <option>--Select Gender--</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                        @if ($errors->has('gender'))
                            <span class="text-danger">{{ $errors->first('gender') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-md-2">
                    <label for="inputZip">DOB</label>
                    <input type="date" name="dob" value="{{old('dob')}}" class="form-control" >
                    @if ($errors->has('dob'))
                        <span class="text-danger">{{ $errors->first('dob') }}</span>
                    @endif
                    </div>
                </div> -->
                <br>
                <button type="submit" class="btn btn-primary">Sign up</button>
                <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group already_user">
                        <p>Already have an account? <a href="{{ url('/vendor_login') }}" class="txt_color_red">Login here</a></p>
                      </div>
                    </div>
                </div>
            </form>
            <p class="text-center fl-success" id="successregister" style="display:none;"></p>  
            <p class="text-center fl-success" id="errorregister" style="display:none;"></p>  


        </div>
<script type="text/javascript" src="{{ asset('public/assets/js/view/vendors/register.js') }} "></script>
          

<!-----------vendor registartion end----------->


@endsection