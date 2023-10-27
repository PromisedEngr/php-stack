


 <!-----------inner-banner----------->

    <!-- <div class="inner-banner">

        <img src="{{asset('public/front/images/inner-banner.png')}}" alt="">

        <div class="container inner-caption-container">

            <div class="row">

                <div class="col-md-12">

                    <div class="inner-banner-caption wow animate__fadeInUp" data-wow-duration="1500ms">
                        <h2>Vendor Login</h2>
                    </div>

                </div>

            </div>

        </div>

    </div> -->

<!-----------inner-banner----------->

<!-----------vendor registartion----------->
        <!-- <div class="container py-5">

            <form action="javascript:void(0)" id="loginVendor" name="loginVendor" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Mobile no <b class="req">*</b></label>
                        <div class="row">
                            <div class="col-md-2"><input type="text" name="state_code" value="+91" class="form-control" id="state_code" placeholder="+60" value="+60"></div>
                            <div class="col-md-10"><input type="number" name="mobile" value="" class="form-control" id="mobile" placeholder="Enter mobile no"></div>
                        </div>
                        
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Password <b class="req">*</b></label>
                        <input type="password" name="password" value="" id="password" class="form-password form-control" id="form-password"  placeholder="Enter Password">
                    </div>

                </div>
                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                        <div class="entercodediv" style="display: none">
                            <div class="countdown" >OTP will be expire in <span id="timer"></span></div>
                            <label for="inputEmail4">Enter code <b class="req">*</b></label>
                            <input type="text" name="otp" class="form-control" id="otp" placeholder="Enter OTP" >
                            <a class="resend_code" href="#">Resend Code</a><br>
                            <a href="#"  class="btn btn-primary submit_code" >Login</a>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="role" value="3">
                <br>
                <button type="submit" class="btn btn-primary form_submit">Submit</button>
                <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group already_user">
                        <p>Don't have an account? <a href="{{ url('/create_vendor') }}" class="txt_color_green">Register here</a></p>
                        <a class="txt_color_green" href="{{ url('/vendor_forgetpassword') }}">Forgot Password</a>
                        
                      </div>
                    </div>
                </div>
            </form>
            <p class="text-center fl-success" id="successlogin" style="display:none;"></p>  
            <p class="text-center fl-success" id="errorlogin" style="display:none;"></p>  


        </div> -->
 
          

<!-----------vendor registartion end----------->




<!doctype html>
<html lang="en">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{asset('public/assets/images/faviconmook.png')}}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{URL::asset('public/assets/css/new_customer_style_login/bootstrap.min.css')}} ">
    <!-- Style -->
    <link rel="stylesheet" href="{{URL::asset('public/assets/css/new_customer_style_login/style.css')}}">
    <!-- Responsive -->
    <link rel="stylesheet" href="{{URL::asset('public/assets/css/new_customer_style_login/responsive.css')}}">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <script type="text/javascript" src="{{ asset('public/assets/js/jquery.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/jquery-ui.css') }} " />
    <script type="text/javascript" src="<?php echo asset('public/assets/js/jquery-ui.js')?>"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
    <meta name="_token" content="{{ csrf_token() }}" />
    <script type="text/javascript">
        var SITE_URL         = "<?php echo config('constants.SITE_URL');?>";
         $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                }
            });
        });

    </script>
    <style type="text/css">
        i.msg.msg-error.error {
            color: red;
        }
        .req{
            color: #f01d1d;
        }
        
    </style>
    <title>Mook Market Place</title>
    <body>
        <section class="login-sec">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-sm-5">
                        <img src="{{URL::asset('public/assets/images/new_customer_login_image/login-img.png')}}" class="img-fluid w-100" alt="">
                        <img src="{{URL::asset('public/assets/images/new_customer_login_image/offer.png')}}" class="img-fluid w-100 mt-lg-4 mb-lg-4 mt-sm-2 mb-sm-2" alt="">
                        <h3>scan receipt <span>GET Reward NOW!</span></h3>
                    </div>
                    <div class="col-lg-4 offset-lg-3 col-sm-6 offset-sm-1">
                        <div class="login-form">
                            <h4>Log In</h4>
                            <form action="javascript:void(0)" id="loginVendor" name="loginVendor" method="POST">
                                <div class="form-group mobile_tab">
                                    <input type="text" name="state_code" value="+91" class="form-control" id="state_code" placeholder="+60" value="+60">
                                    <input type="number" name="mobile" value="" class="form-control" id="mobile" placeholder="Enter Mobile number">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" value="" id="password" class="form-control" id="form-password"  placeholder="Enter Password">
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="entercodediv" style="display: none">
                                        <div class="countdown" >OTP will be expire in <span id="timer"></span></div>
                                        <label for="inputEmail4">Enter code <b class="req">*</b></label>
                                        <input type="text" name="otp" class="form-control" id="otp" placeholder="Enter OTP" >
                                        <a class="resend_code" href="#">Resend Code</a><br>
                                        <a href="#"  class="btn btn-primary submit_code" >Login</a>
                                    </div>
                                </div>
                                <input type="hidden" name="role" value="3">
                                <button type="submit" class="btn form_submit">LOG IN</button>
                                <a href="{{ url('/vendor_forgetpassword') }}" class="forgot-password">Forgot Password</a>
                                <a href="javascript:void(0)" class="cleaning-expert">New to Cleaning Expert?  </a>
                                <a href="{{ url('/create_vendor') }}" class="signup">Sign Up</a>
                            </form>
                            <p class="text-center fl-success" id="successlogin" style="display:none;"></p>  
                            <p class="text-center fl-success" id="errorlogin" style="display:none;"></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script src="{{URL::asset('public/assets/js/new_customer_js/popper.min.js')}}"></script>
    <script src="{{URL::asset('public/assets/js/new_customer_js/bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('public/assets/js/new_customer_js/main.js')}}"></script>
    <script src="{{asset('public/assets/js/common.js')}}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="{{URL::asset('public/front/js/select2.min.js')}}"></script>
    <script src="{{URL::asset('public/assets/js/jquery.countdown360.min.js')}}"></script>
    <!-- <script type="text/javascript" src="{{ asset('public/assets/js/view/customer/login.js') }} "></script> -->
    <script type="text/javascript" src="{{ asset('public/assets/js/view/vendors/login.js') }} "></script> 
</html>