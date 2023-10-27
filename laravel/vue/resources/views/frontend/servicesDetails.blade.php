@extends('frontend.master')

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
	.bg-white {
	    background-color: #ffffff;
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

</style>

	<div class="inner-banner">
        <img src="<?php echo asset('public/assets/images/inner-banner.png') ?>" alt="">
        <div class="container inner-caption-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="inner-banner-caption wow animate__fadeInUp" data-wow-duration="1500ms">
                        <h2 id="sercice_title"></h2>
                    </div>

                </div>
            </div>

        </div>
    </div>
    	<div class="inner-sec-bg service-sec">
        	<div class="container">
            	
            	<div id="vendor_listing">

            	</div>
        	</div>
    	</div>
    	<script type="text/javascript" src="{{ asset('public/assets/js/view/customer/serviceDetails.js') }} "></script>

@endsection