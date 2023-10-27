@extends('frontend.master')

@section('content')


 <!-----------inner-banner----------->

<div class="inner-banner">
    <img src="{{asset('public/front/images/inner-banner.png')}}" alt="">
    <div class="container inner-caption-container">
        <div class="row">
            <div class="col-md-12">
                <div class="inner-banner-caption wow animate__fadeInUp" data-wow-duration="1500ms">
                    <h2>Customer Forget Password</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<!-----------inner-banner----------->

<!-----------Customer registartion----------->
<div class="container py-5">
    <form action="javascript:void(0)" id="forgetpasswordnew" name="forgetpasswordnew" method="POST">
        <div class="form-group">
            <label for="mobile">Mobile No <b class="req">*</b></label>
            <div class="row">
                <div class="col-md-2">
                    <input type="text" name="state_code" class="form-control" id="state_code" placeholder="+91" value="+91">
                </div>
                <div class="col-md-10">
                    <input type="number" name="mobile" value="" class="form-control" id="mobile" placeholder="Enter mobile no">
                </div>
                <div class="col-md-12" style="margin-top:5px;">
                    <button class="btn btn-sm btn-success verify_mobile">Verify</button>
                </div>

            </div>
        </div>
        
        <br>
        <div class="password_div" style="display:none;">
            <div class="form-group">
            <div class="countdown" >OTP will be expire in <span id="timer"></span></div>
            <a class="resend_code" href="#">Resend Code</a><br>
                <label for="mobile">OTP <b class="req">*</b></label>
                <div class="row">
                    <div class="col-md-12">
                        <input type="text" name="otp"  class="form-control" id="otp" placeholder="Enter OTP" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="mobile">Password <b class="req">*</b></label>
                    <input type="password" name="password"  class="form-control" id="password" placeholder="Password" autocomplete="off">
                </div>
                <div class="col-md-6">
                    <label for="mobile">Confirm Password <b class="req">*</b></label>
                    <input type="password" name="confirm_password"  class="form-control" id="confirm_password" placeholder="Confirm Password" autocomplete="off">
                </div>
                    
            </div>
            <input type="hidden" name="role" value="1">
            <br>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
    <p class="text-center fl-success" id="successforgetpassword" style="display:none;"></p>  
    <p class="text-center fl-success" id="errorforgetpassword" style="display:none;"></p>  
</div>
<script type="text/javascript" src="{{ asset('public/assets/js/view/customer/forgetpassword.js') }} "></script>
<!-----------Customer registartion end----------->

@endsection