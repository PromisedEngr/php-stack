<!------- header --------->
    <!-- <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
                <span class="icon-close2 js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body">
            <div class="dashboard-left">
                <ul>
                    <li class="sidebar_menu {{ (Route::getCurrentRoute()->uri=='vendordashboard') ? 'active' : '' }}"><a href="{{ url('/vendordashboard') }}" >Dashboard</a></li>
                    <li class="sidebar_menu {{ (Route::getCurrentRoute()->uri=='vendor/view_profile') ? 'active' : '' }}"><a href="{{ url('/vendor/view_profile') }}">Vendor Profile</a></li>
                    <li class="sidebar_menu {{ (Route::getCurrentRoute()->uri=='vendor/vouchers') ? 'active' : '' }}"><a href="{{ url('/vendor/vouchers') }}" >Voucher</a></li>
                    <li class="sidebar_menu {{ (Route::getCurrentRoute()->uri=='vendor/tasker') ? 'active' : '' }}"><a href="javascript:void(0)" >Your Tasker</a></li>
                    <li class="sidebar_menu {{ (Route::getCurrentRoute()->uri=='vendor/wallets') ? 'active' : '' }}"><a href="javascript:void(0)" >My wallet</a></li>
                    <li class="sidebar_menu {{ (Route::getCurrentRoute()->uri=='vendor/vip-packages') ? 'active' : '' }}"><a href="javascript:void(0)" >VIP Package</a></li>
                    <li class="sidebar_menu {{ (Route::getCurrentRoute()->uri=='vendor/marketing-tools') ? 'active' : '' }}"><a href="javascript:void(0)" >Marketing Tools</a></li>
                    <li class="sidebar_menu {{ (Route::getCurrentRoute()->uri=='vendor/chatwithvendor') ? 'active' : '' }}"><a href="{{ url('/vendor/chatwithvendor') }}" >Chat with Customer</a></li>
                    <li class="sidebar_menu {{ (Route::getCurrentRoute()->uri=='vendor/my-profile') ? 'active' : '' }}"><a href="javascript:void(0)" >My Profile</a></li>
                    <li class="sidebar_menu {{ (Route::getCurrentRoute()->uri=='vendor/reports') ? 'active' : '' }}"><a href="javascript:void(0)" >Report </a></li>
                </ul>
            </div>
        </div>
    </div> -->


    <!-- <header class="inner-header site-navbar js-sticky-header site-navbar-target dashboard-header" role="banner">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-6 col-xl-3">
                    <h1 class="mb-0 site-logo"><a href="{{url('/')}}"> <img src="{{ asset('public/assets/images/logo.png')}}" alt="logo" class=""></a></h1>
                </div>



                <div class="col-12 col-lg-3 col-sm-4 ml-auto">
                    <div class="user-details">
                        <a href="javascript:void(0)"> <span>Hi @if(!empty(Auth::guard('vendor')->user())) {{Auth::guard('vendor')->user()->name}} @endif</span></a>

                        <?php // if(!empty(Auth::guard('vendor')->user()->profile_image)){ ?>
                        <a href="javascript:void(0)"> <img src="{{ asset('public/profile_images/'.Auth::guard('vendor')->user()->profile_image)}}" alt="user" id="customer_image" class="img-fluid"></a>
                        <?php // }else { ?>
                        <a href="javascript:void(0)"> <img src="{{ asset('public/assets/images/user.png')}}" alt="user" id="customer_image" class="img-fluid"></a>
                        <?php // } ?>


                        <ul class="user-login" id="showHide_toggle" style="display:none;">
                            <li><a href="{{url('/vendor/logout')}}">Logout</a> </li>
                            <li><a href="#">Dropdown 2</a> </li>
                        </ul>
                    </div>

                </div>
                <div class="d-inline-block d-xl-none ml-md-0 py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle float-right"><span class="icon-menu h3"></span></a></div>

            </div>
        </div>

    </header> -->
    <!------- header --------->

    <header class="dashboard-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-3 col-sm-4">
                    <div class="dashboard-logoarea">
                        <a href="{{ url('/') }}" >
                            <img src="{{ asset('public/assets/images/new_customer_image/images/new-logo.png')}}" class="img-fluid" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-9 col-sm-8">
                    <div class="dashboard-head-right">
                    
                        <div class="dashboard-head-btn-right">
                            <div class="dashboard-head-btn-area">
                                <!-- <a href="{{url('/customer/findvenderservices')}}">FIND VENDOR </a> -->
                                <a href="{{url('/vendor/logout')}}" class="border-btn"> LOGOUT </a>
                            </div>
                            <div class="user">
                                <div class="user-thumb">
                                    <?php if(!empty(Auth::guard('vendor')->user()->profile_image)){ ?>
                                        <img src="{{ asset('public/profile_images/'.Auth::guard('vendor')->user()->profile_image)}}" alt="user" id="customer_image" class="img-fluid"></a>
                                        <?php }else { ?>
                                        <img src="{{ asset('public/assets/images/new_customer_image/images/user-small.png')}}" alt="user" id="customer_image" class="img-fluid"></a>
                                    <?php } ?>
                                
                                </div>
                                <span class="user-name">HI, @if(!empty(Auth::guard('vendor')->user())) {{Auth::guard('vendor')->user()->name}} @endif</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </header>