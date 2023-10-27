@extends('vendar.layouts.design')
@section('content')

<?php // pr(Auth::guard('vendor')->user()->id); die;?>
    <!-----------about-sec----------->
    <section class="user-details-tab">
        <div class="row">
            <!-- SideBar Menu -->
            @include('vendar.sidebar')
            <div class="col-lg-9 col-sm-8">
                <div class="user-details-tab-right">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-dashboard" role="tabpanel" aria-labelledby="v-pills-dashboard-tab">
                            <div class="dashboard-right1">
                                <h3>VENDOR DASHBOARD</h3>
                            </div>

                            <div class="dashboard-right-box">
                                <div class="row">
                                    <div class="col-lg-4 col-sm-6 pr-md-0">
                                        <div class="dashboard-right-box-inner vendor_dashboard-right-box-inner1">
                                            <div>
                                            <h3>MARKETING TOOL</h3>
                                                </div>
                                        </div>
                                        <div class="dashboard-right-box-inner vendor_dashboard-right-box-inner2">
                                                <div>
                                                    <h3>WALLET</h3>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 pr-md-0">
                                        <div class="dashboard-right-box-inner vendor_dashboard-right-box-inner3">
                                            <div>
                                                <h3>REPORT</h3>
                                            </div>
                                        </div>
                                        <div class="dashboard-right-box-inner vendor_dashboard-right-box-inner4">
                                                <div>
                                                    <h3>UPDATE COMPANY PROFILE
                                                    </h3>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="dashboard-right-box-inner vendor_dashboard-right-box-inner5">
                                                <div>
                                                    <h3 class="request_view_job">VIEW JOB / REQUEST JOB</h3>
                                                    <div class="all_job_star">
                                                        <a href="javascript:void(0)" class="job_star"><i class="fas fa-star"></i></a>
                                                        <a href="javascript:void(0)" class="job_star"><i class="fas fa-star"></i></a>
                                                        <a href="javascript:void(0)" class="job_star"><i class="fas fa-star"></i></a>
                                                        <a href="javascript:void(0)" class="job_star"><i class="fas fa-star"></i></a>
                                                        <a href="javascript:void(0)" class="job_star"><i class="fas fa-star"></i></a>
                                                    </div>
                                                </div>
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
    
@endsection


    

    
