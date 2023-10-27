<!------- header --------->

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
                            <a href="{{url('/customer/findvenderservices')}}">FIND VENDOR </a>
                            <a href="{{url('/customer/logout')}}" class="border-btn"> LOGOUT </a>
                        </div>
                        <div class="user">
                            <div class="user-thumb">
                                <?php if(!empty(Auth::guard('customer')->user()->profile_image)){ ?>
                                    <img src="{{ asset('public/profile_images/'.Auth::guard('customer')->user()->profile_image)}}" alt="user" id="customer_image" class="img-fluid"></a>
                                    <?php }else { ?>
                                    <img src="{{ asset('public/assets/images/new_customer_image/images/user-small.png')}}" alt="user" id="customer_image" class="img-fluid"></a>
                                <?php } ?>
                            
                            </div>
                            <span class="user-name">HI, @if(!empty(Auth::guard('customer')->user())) {{Auth::guard('customer')->user()->name}} @endif</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</header>



