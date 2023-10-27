@extends('customer.layouts.design')
@section('content')

<?php //pr(Auth::guard('customer')->user()->id); die;?>

    <section class="user-details-tab">
        <div class="row">
            <!-- SideBar Menu -->
            @include('customer.sidebar')


            <div class="col-lg-9 col-sm-8">
                <div class="user-details-tab-right">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-dashboard" role="tabpanel" aria-labelledby="v-pills-dashboard-tab">
                            <div class="dashboard-right1">
                                <h3>CUSTOMER DASHBOARD</h3>
                            </div>

                            <div class="dashboard-right-box">
                                <div class="row">
                                    <div class="col-lg-4 col-sm-6 pr-md-0">
                                        <div class="dashboard-right-box-inner dashboard-right-box-inner1">
                                            <div>
                                            <h3>@if(!empty(Auth::guard('customer')->user())) {{Auth::guard('customer')->user()->name}} @endif</h3>
                                                </div>
                                        </div>
                                        <div class="dashboard-right-box-inner dashboard-right-box-inner2">
                                                <div>
                                            <h3>connected vendors</h3>
                                                    </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 pr-md-0">
                                        <div class="dashboard-right-box-inner dashboard-right-box-inner3">
                                                <div>
                                            <h3>services</h3>
                                                    </div>
                                        </div>
                                        <div class="dashboard-right-box-inner dashboard-right-box-inner4">
                                                <div>
                                                    <h3>@if(!empty(Auth::guard('customer')->user())) 
                                                            <?php if(Auth::guard('customer')->user()->role == 1){ echo "Customer";    } ?>
                                                        @endif
                                                    </h3>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="dashboard-right-box-inner dashboard-right-box-inner5">
                                                <div>
                                                    <h3>Total points : 0</h3>
                                                    <p>joining date : 
                                                        @if(!empty(Auth::guard('customer')->user())) 
                                                            <?php
                                                                $created = strtotime(Auth::guard('customer')->user()->created_at);
                                                                echo date("d-m-Y", $created);
                                                            ?>
                                                        @endif
                                                    </p>
                                                </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="dashboard-bottom">
                                <div class="row">
                                    <div class="col-lg-3 col-md-6">
                                        <div class="dashboard-bottom-box">
                                            <a href="#" class="active">
                                                <h6>Lorem / ipsum</h6>
                                                <img src="{{ asset('public/assets/images/new_customer_image/images/user-icon.png')}}" class="img-fluid" alt=""> <span>140</span>
                                                <p>Lorem ipsum dolor sitconsectetur</p>
                                                
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="dashboard-bottom-box">
                                            <a href="#" class="active">
                                                <h6>Lorem / ipsum</h6>
                                                <img src="{{ asset('public/assets/images/new_customer_image/images/user-icon.png')}}" class="img-fluid" alt=""> <span>20</span>
                                                <p>Lorem ipsum dolor sitconsectetur</p>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="dashboard-bottom-box">
                                            <a href="#" class="active">
                                                <h6>Lorem / ipsum</h6>
                                                <img src="{{ asset('public/assets/images/new_customer_image/images/user-icon.png')}}" class="img-fluid" alt=""> <span>30</span>
                                                <p>Lorem ipsum dolor sitconsectetur</p>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="dashboard-bottom-box">
                                            <a href="#" class="active">
                                                <h6>Lorem / ipsum</h6>
                                                <img src="{{ asset('public/assets/images/new_customer_image/images/user-icon.png')}}" class="img-fluid" alt=""> <span>214</span>
                                                <p>Lorem ipsum dolor sitconsectetur</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="dashboard-progress">
                                    <div class="progress-box">
                                        <svg class="progress blue noselect" data-progress="65" x="0px" y="0px" viewBox="0 0 80 80">
                                            <path class="track" d="M5,40a35,35 0 1,0 70,0a35,35 0 1,0 -70,0" />
                                            <path class="fill" d="M5,40a35,35 0 1,0 70,0a35,35 0 1,0 -70,0" />

                                            <span>MYR 10408</span>

                                        </svg>
                                        <p>Lorem ipsum dolor sitconsectetur</p>
                                    </div>
                                    <div class="progress-box">
                                        <svg class="progress green noselect" data-progress="33" x="0px" y="0px" viewBox="0 0 80 80">
                                            <path class="track" d="M5,40a35,35 0 1,0 70,0a35,35 0 1,0 -70,0" />
                                            <path class="fill" d="M5,40a35,35 0 1,0 70,0a35,35 0 1,0 -70,0" />
                                            <span>MYR 10408</span>

                                        </svg>
                                        <p>Lorem ipsum dolor sitconsectetur</p>
                                    </div>


                                    <div class="progress-box">
                                        <svg class="progress red noselect" data-progress="33" x="0px" y="0px" viewBox="0 0 80 80">
                                            <path class="track" d="M5,40a35,35 0 1,0 70,0a35,35 0 1,0 -70,0" />
                                            <path class="fill" d="M5,40a35,35 0 1,0 70,0a35,35 0 1,0 -70,0" />
                                            <span>MYR 10408</span>

                                        </svg>
                                        <p>Lorem ipsum dolor sitconsectetur</p>
                                    </div>


                                </div>

                                <div class="dashboard-slider">

                                    <div class="item">
                                        <div class="clientimg">
                                            <img src="{{ asset('public/assets/images/new_customer_image/images/dashboard-slider1.png')}}" alt="">
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="clientimg">
                                            <img src="{{ asset('public/assets/images/new_customer_image/images/dashboard-slider2.png')}}" alt="">
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="clientimg">
                                            <img src="{{ asset('public/assets/images/new_customer_image/images/dashboard-slider3.png')}}" alt="">
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="clientimg">
                                            <img src="{{ asset('public/assets/images/new_customer_image/images/dashboard-slider4.png')}}" alt="">
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="clientimg">
                                            <img src="{{ asset('public/assets/images/new_customer_image/images/dashboard-slider5.png')}}" alt="">
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="clientimg">
                                            <img src="{{ asset('public/assets/images/new_customer_image/images/dashboard-slider6.png')}}" alt="">
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="clientimg">
                                            <img src="{{ asset('public/assets/images/new_customer_image/images/dashboard-slider7.png')}}" alt="">
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="clientimg">
                                            <img src="{{ asset('public/assets/images/new_customer_image/images/dashboard-slider7.png')}}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        

                    </div>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript" src="{{ asset('public/assets/js/view/customer/dashboard.js') }}"></script>

@endsection