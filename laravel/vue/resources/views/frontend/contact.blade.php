@extends('frontend.master')

@section('content')

    <!-----------inner-banner----------->
    <div class="inner-banner">
        <img src="{{asset('public/front/images/inner-banner.png')}}" alt="">
        <div class="container inner-caption-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="inner-banner-caption wow animate__fadeInUp" data-wow-duration="1500ms">
                        <h2>Contact us</h2>
                        <p>Lorem Ipsum has been the industry's standard dummy text </p>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <!-----------inner-banner----------->

    <!-----------contact-sec----------->
    <div class="inner-sec-bg contact-sec">
        <div class="container">
            <div class="main-head wow animate__fadeInUp" data-wow-duration="1500ms">
                <h2>How To Reach Us
                </h2>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="contact-sec-inner wow animate__fadeInLeft" data-wow-duration="1500ms">
                        <div class="media">
                            <img class="img-fluid" src="{{asset('public/front/images/contact-icon1.png')}}" alt="">
                            <div class="media-body">
                                <h5>For vendors & service provides</h5>
                                <ul>
                                    <li><span>Email</span> <a href="#">: hello@company</a> </li>
                                    <li><span>Whatsapp	     </span> <a href="#">: +000 111 222 32</a> </li>
                                    <li><span>Tel	</span> <a href="#">: +000 111 222 32</a> </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="contact-sec-inner wow animate__fadeInRight" data-wow-duration="1500ms">
                        <div class="media">
                            <img class="img-fluid" src="{{asset('public/front/images/contact-icon2.png')}}" alt="">
                            <div class="media-body">
                                <h5>For customers
</h5>
                                <ul>
                                    <li><span>Email</span> <a href="#">: hello@company</a> </li>
                                    <li><span>Whatsapp	     </span> <a href="#">: +000 111 222 32</a> </li>
                                    <li><span>Tel	</span> <a href="#">: +000 111 222 32</a> </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!-----------contact-sec----------->





@endsection