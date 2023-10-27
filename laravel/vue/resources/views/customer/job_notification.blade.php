@extends('customer.layouts.design')
@section('content')
<style type="text/css">
	
	.service_provider_directory_container {
	    
	    top: 40px;
	}
	.rounded {
	    border-radius: 4px;
	}
	.ph-m {
	    padding-left: 0.75em;
	    padding-right: 0.75em;
	}
	.pv-m {
	    padding-top: 0.75em;
	    padding-bottom: 0.75em;
	}
	.mt-l {
	    margin-top: 1em;
	}
	.box_background {
	    background-color: #dedede;
        margin: 15px;
	}
	.justify-content-between {
	    -webkit-box-pack: justify !important;
	    -ms-flex-pack: justify !important;
	    justify-content: space-between !important;
	}
	.flex-basis-15 {
	    -ms-flex-preferred-size: 15%;
	    flex-basis: 15%;
	}
	.flex-basis-85 {
	    -ms-flex-preferred-size: 85%;
	    flex-basis: 85%;
	}
	.flex-basis-70 {
	    -ms-flex-preferred-size: 70%;
	    flex-basis: 70%;
	}
	.service_provider_truncate_location {
	    max-width: 300px;
	    text-overflow: ellipsis;
	    overflow: hidden;
	    white-space: nowrap;
	}
	.service_provider_truncate_location {
	    max-width: 300px;
	    text-overflow: ellipsis;
	    overflow: hidden;
	    white-space: nowrap;
	}
	button.btn, .btn {
	    padding: 0.75em 1.75em;
	    display: inline-block;
	    border-radius: 4px;
	    font-size: 16px;
	    font-weight: 600;
	    cursor: pointer;
	    border: 0;
	    color: #fff;
	    background-color: #ed193a;
	    -webkit-transition: all 0.2s ease-in-out;
	    transition: all 0.2s ease-in-out;
	}
	.service_provider_thumb_img {
	    height: 92px;
	    width: 92px;
	    border-radius: 50%;
	}
    .non_clickable{
        pointer-events:none;
    }

</style>
    <section class="user-details-tab">
        <div class="row">
            @include('customer.sidebar')
            <div class="col-lg-9 col-sm-8">
                <div class="user-details-tab-right">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-dashboard" role="tabpanel" aria-labelledby="v-pills-dashboard-tab">
                            <div class="dashboard-right1">
                                <h3>Job Notification</h3>
                            </div>
                            <div class="dashboard-right-box">
                                <div id="applied_vendors">

                                </diV>
                                <div id="job_notifications_paginations">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript" src="{{ asset('public/assets/js/view/customer/jobnotifications.js') }} "></script>

@endsection