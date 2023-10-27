@extends('frontend.master')

@section('content')


<div class="inner-banner">
    <img src="<?php echo asset('public/assets/images/inner-banner.png') ?>" alt="">
    <div class="container inner-caption-container">
        <div class="row">
            <div class="col-md-12">
                <div class="inner-banner-caption wow animate__fadeInUp" data-wow-duration="1500ms">
                    <h2 id="sercice_title">Posted task by Customer</h2>
                </div>

            </div>
        </div>

    </div>
</div>
<div class="inner-sec-bg service-sec">
    <div class="container">
        <div class="">
            <div id="listingOfTask">

            </div>
            <div class="" id="page_pagination">
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ asset('public/assets/js/view/vendors/js/vendorpostedTask.js') }} "></script>
@endsection