    <!------- header --------->

    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
                <span class="icon-close2 js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div>

    <header class="site-navbar js-sticky-header site-navbar-target" role="banner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-6 col-xl-3">
                    <h1 class="mb-0 site-logo"><a href="{{route('home')}}"> <img src="{{ asset('public/assets/images/new_customer_image/images/new-logo.png')}}" class="img-fluid" alt=""></a></h1>
                </div>

                <div class="col-12 col-md-9 d-none d-xl-block">
                    <nav class="site-navigation position-relative" role="navigation">
                        <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                            <!-- <li><a href="{{url('/about')}}" class="nav-link">ABOUT </a></li>  -->
                            <!-- <li><a href="{{url('/contact')}}" class="nav-link">CONTACT US </a></li> -->
                            <!-- <li><a href="{{url('/blog')}}" class="nav-link">Blog </a></li> -->
                            
                            @if(!empty(Auth::guard('vendor')->user()->id) || !empty(Auth::guard('customer')->user()->id))
                                @if(!empty(Auth::guard('vendor')->user()->id))
                                    <li><a href="{{url('/vendor/jobtask')}}" class="nav-link">TASK </a></li>
                                    <li><a href="javascript:void(0)">{{Auth::guard('vendor')->user()->name}}</a></li>
                                @elseif(!empty(Auth::guard('customer')->user()->id))
                                    <li><a href="{{url('/customer/findvenderservices')}}" class="nav-link"> Find VENDOR Services</a></li>
                                    <li><a href="{{url('/customerdashboard')}}" class="nav-link">Customer Dashboard</a></li>
                                    <li><a href="javascript:void(0)" class="nav-link">{{Auth::guard('customer')->user()->name}}</a></li>
                                    
                                @endif
                            @else
                                <li><a href="{{route('vendor.register')}}" class="nav-link"> SIGN UP AS VENDOR/Login </a></li>
                            @endif

                            @if(!empty(Auth::guard('vendor')->user()->id) || !empty(Auth::guard('customer')->user()->id))
                                @if(!empty(Auth::guard('vendor')->user()->id))
                                   
                                    <li><a href="{{url('/vendordashboard')}}" class="nav-link">Vendor Dashboard</a></li>
                                    <li><a href="{{url('/vendor/logout')}}"> <span>Logout</span></a></li>
                                @elseif(!empty(Auth::guard('customer')->user()->id))
                                    <li><a href="{{url('/customer/logout')}}"> <span>Logout</span></a></li>
                                    
                                @endif
                            @else
                                <li><a href="{{ route('customer.register') }}" class="nav-link">Customer Registration/Login</a></li>
                            @endif
                           
                        </ul>
                    </nav>
                </div>

                <div class="col-6 d-inline-block d-xl-none ml-md-0 py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle float-right"><span class="icon-menu h3"></span></a></div>
            </div>
        </div>
    </header>

    <!------- header --------->



    <!-- modal registration -->







    <!--end  modal registration  -->

