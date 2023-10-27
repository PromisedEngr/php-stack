@extends('frontend.master')



@section('content')





    <!-----------banner----------->

    <div class="banner">

        <img src="{{URL::asset('public/front/images/banner.jpg')}}" alt="" class="bannerimg" >

        <div class="container banner-caption">

                <div class="banner-caption-inner wow animate__fadeInLeft" data-wow-duration="1500ms">

                    <h1>GET REWARDED</h1>

                    <img src="{{URL::asset('public/front/images/receipt-img.png')}}" class="img-fluid" alt="">

                    <span>Scan Your Receipts

                        & Get Rewards.</span>

                </div>

        </div>

    </div>

    <!-----------banner----------->



    <!-----------Reward----------->

    <div class="reward">

        <div class="container">

            <div class="reward-inner">

                <div class="reward-inner-info wow animate__fadeInRight" data-wow-duration="1500ms">

                    <img src="{{URL::asset('public/front/images/reward1.png')}}" class="img-fluid" alt="">

                    <h4>Earn points on

                        any receipt</h4>

                </div>

                <div class="reward-inner-info wow animate__fadeInLeft" data-wow-duration="1500ms">

                    <img src="{{URL::asset('public/front/images/reward2.png')}}" class="img-fluid" alt="">

                    <h4>Redeem any voucher

                        and other rewards</h4>

                </div>

            </div>



        </div>

    </div>

    <!-----------Reward----------->



    <!-----------Redeem-points----------->

    <div class="redeem-points">

        <div class="container">

            <div class="main-head wow animate__fadeInUp" data-wow-duration="1500ms">

                <img src="{{URL::asset('public/front/images/head-icon.png')}}" class="img-fluid" alt="">

                <h2>how to redeem points</h2>

            </div>

            <div class="row wow animate__fadeInLeft" data-wow-duration="1500ms">

                <div class="col-md-4">

                    <div class="redeem-points-box">

                        <div class="redeem-img">

                            <img src="{{URL::asset('public/front/images/redeem-img1.png')}}" class="img-fluid" alt="">

                        </div>

                        <p>Hire a

                            Service</p>

                        <img src="{{URL::asset('public/front/images/arrow.png')}}" class="img-fluid" alt="">

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="redeem-points-box">

                        <div class="redeem-img">

                            <img src="{{URL::asset('public/front/images/redeem-img2.png')}}" class="img-fluid" alt="">

                        </div>



                        <p>Scan

                            Receipt</p>

                        <img src="{{URL::asset('public/front/images/arrow.png')}}" class="img-fluid" alt="">

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="redeem-points-box">

                        <div class="redeem-img">

                            <img src="{{URL::asset('public/front/images/redeem-img3.png')}}" class="img-fluid" alt="">

                        </div>

                        <p>Redeem

                            Points</p>



                    </div>

                </div>

            </div>



        </div>

    </div>

    <!-----------Redeem-points----------->



    <!-----------service-form----------->

    <!-- <div class="service-form">

        <div class="container">

            <div class="main-head wow animate__fadeInUp" data-wow-duration="1500ms">

                <h2>Hire our service providers. </h2>

            </div>

            <div class="service-form-inner wow animate__fadeInRight" data-wow-duration="1500ms">

                <form class="form-inline">

                    <div class="form-group">

                        <label for="exampleFormControlSelect1">services</label>

                        <select class="form-control" id="exampleFormControlSelect1">

                            <option selected>Find Our Services</option>

                            <option>Services 1</option>

                            <option>Services 2</option>

                            <option>Services 3</option>

                            <option>Services 4</option>

                        </select>

                    </div>

                    <div class="form-group">

                        <label for="exampleFormControlSelect2">country</label>

                        <select class="form-control" id="exampleFormControlSelect2">

                            <option selected>Malaysia</option>

                            <option>India</option>

                            <option>Germany</option>



                        </select>

                    </div>

                    <button type="submit" class="btn">service provider</button>

                </form>

            </div>



        </div>

    </div> -->

    <!-----------service-form----------->



    <!-----------testimonial----------->

    <div class="testimonial">

        <div class="container">

            <div class="main-head wow animate__fadeInUp" data-wow-duration="1500ms">

                <h2>What Clients Say </h2>

            </div>



            <div class="responsive wow animate__fadeInLeft" data-wow-duration="1500ms">

                <div class="testi-box">

                    <img src="{{URL::asset('public/front/images/quotation-up.png')}}" class="img-fluid" alt="">

                    <p> Lorem ipsum dolor sit amet, onsectetur adipiscing elit, ut

                        labore et dolore magna aliqua. Ut enim ad minim veniam,</p>

                    <span>Joleen Tabarez (Manager)</span>

                    <img src="{{URL::asset('public/front/images/quotation-down.png')}}" class="img-fluid quote-down" alt="">

                </div>

                <div class="testi-box">

                    <img src="{{URL::asset('public/front/images/quotation-up.png')}}" class="img-fluid" alt="">

                    <p> Lorem ipsum dolor sit amet, onsectetur adipiscing elit, ut

                        labore et dolore magna aliqua. Ut enim ad minim veniam,</p>

                    <span>Joleen Tabarez (Manager)</span>

                    <img src="{{URL::asset('public/front/images/quotation-down.png')}}" class="img-fluid quote-down" alt="">

                </div>

                <div class="testi-box">

                    <img src="{{URL::asset('public/front/images/quotation-up.png')}}" class="img-fluid" alt="">

                    <p> Lorem ipsum dolor sit amet, onsectetur adipiscing elit, ut

                        labore et dolore magna aliqua. Ut enim ad minim veniam,</p>

                    <span>Joleen Tabarez (Manager)</span>

                    <img src="{{URL::asset('public/front/images/quotation-down.png')}}" class="img-fluid quote-down" alt="">

                </div>

                <div class="testi-box">

                    <img src="{{URL::asset('public/front/images/quotation-up.png')}}" class="img-fluid" alt="">

                    <p> Lorem ipsum dolor sit amet, onsectetur adipiscing elit, ut

                        labore et dolore magna aliqua. Ut enim ad minim veniam,</p>

                    <span>Joleen Tabarez (Manager)</span>

                    <img src="{{URL::asset('public/front/images/quotation-down.png')}}" class="img-fluid quote-down" alt="">

                </div>



                <div class="testi-box">

                    <img src="{{URL::asset('public/front/images/quotation-up.png')}}" class="img-fluid" alt="">

                    <p> Lorem ipsum dolor sit amet, onsectetur adipiscing elit, ut

                        labore et dolore magna aliqua. Ut enim ad minim veniam,</p>

                    <span>Joleen Tabarez (Manager)</span>

                    <img src="{{URL::asset('public/front/images/quotation-down.png')}}" class="img-fluid quote-down" alt="">

                </div>

                <div class="testi-box">

                    <img src="{{URL::asset('public/front/images/quotation-up.png')}}" class="img-fluid" alt="">

                    <p> Lorem ipsum dolor sit amet, onsectetur adipiscing elit, ut

                        labore et dolore magna aliqua. Ut enim ad minim veniam,</p>

                    <span>Joleen Tabarez (Manager)</span>

                    <img src="{{URL::asset('public/front/images/quotation-down.png')}}" class="img-fluid quote-down" alt="">

                </div>

                <div class="testi-box">

                    <img src="{{URL::asset('public/front/images/quotation-up.png')}}" class="img-fluid" alt="">

                    <p> Lorem ipsum dolor sit amet, onsectetur adipiscing elit, ut

                        labore et dolore magna aliqua. Ut enim ad minim veniam,</p>

                    <span>Joleen Tabarez (Manager)</span>

                    <img src="{{URL::asset('public/front/images/quotation-down.png')}}" class="img-fluid quote-down" alt="">

                </div>

                <div class="testi-box">

                    <img src="{{URL::asset('public/front/images/quotation-up.png')}}" class="img-fluid" alt="">

                    <p> Lorem ipsum dolor sit amet, onsectetur adipiscing elit, ut

                        labore et dolore magna aliqua. Ut enim ad minim veniam,</p>

                    <span>Joleen Tabarez (Manager)</span>

                    <img src="{{URL::asset('public/front/images/quotation-down.png')}}" class="img-fluid quote-down" alt="">

                </div>

            </div>



        </div>

    </div>

    <!-----------testimonial----------->



    <!----------clients----------->

    <div class="clients">

        <div class="container">

            <div class="main-head wow animate__fadeInUp" data-wow-duration="1500ms">

                <h2>More Than 1000+ Trusted Client’s </h2>

            </div>



            <!--<div class="wow animate__fadeInRight" data-wow-duration="1500ms">

                <img src="{{URL::asset('public/front/images/clients-img.png')}}" class="img-fluid" alt="">

            </div>-->

            <div class="clients-box" id="clients-slider">

                <div class="item">

                    <div class="clientimg">

                        <img src="{{URL::asset('public/front/images/client-1.png')}}" alt="">

                    </div>

                </div>

                <div class="item">

                    <div class="clientimg">

                        <img src="{{URL::asset('public/front/images/client-2.png')}}" alt="">

                    </div>

                </div>

                <div class="item">

                    <div class="clientimg">

                        <img src="{{URL::asset('public/front/images/client-3.png')}}" alt="">

                    </div>

                </div>

                <div class="item">

                    <div class="clientimg">

                        <img src="{{URL::asset('public/front/images/client-4.png')}}" alt="">

                    </div>

                </div>

                <div class="item">

                    <div class="clientimg">

                        <img src="{{URL::asset('public/front/images/client-5.png')}}" alt="">

                    </div>

                </div>

                <div class="item">

                    <div class="clientimg">

                        <img src="{{URL::asset('public/front/images/client-6.png')}}" alt="">

                    </div>

                </div>

                <div class="item">

                    <div class="clientimg">

                        <img src="{{URL::asset('public/front/images/client-7.png')}}" alt="">

                    </div>

                </div>

                <div class="item">

                    <div class="clientimg">

                        <img src="{{URL::asset('public/front/images/client-6.png')}}" alt="">

                    </div>

                </div>

                <div class="item">

                    <div class="clientimg">

                        <img src="{{URL::asset('public/front/images/client-7.png')}}" alt="">

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-----------clients----------->



    <!----------vendor----------->

    <div class="vendor">

        <div class="container">

            <div class="row">

                <div class="col-md-7 wow animate__fadeInLeft" data-wow-duration="1500ms">

                    <div class="main-head text-left">

                        <h2>Become a Vendor </h2>

                    </div>

                    <p>Lorem ipsum dolor sit amet, onsectetur adipiscing elit, ut labore et dolore magna aliqua. Ut enim ad minim veniam. Lorem ipsum dolor sit amet, onsectetur adipiscing elit, ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>

                    <div class="vendor-btn">

                        <a href="#">sign up as Vendor</a>

                        <a href="#">find Vendor</a>

                    </div>

                </div>

                <div class="col-md-5 vendor-model">

                    <img src="{{URL::asset('public/front/images/vendor-lady.png')}}" class="img-fluid" alt="">

                </div>



            </div>

        </div>

    </div>

    <!-----------vendor----------->



    <!---------- customer----------->

    <div class="vendor customer">

        <div class="container">

            <div class="row" >

                <div class="col-md-5">

                    <img src="{{URL::asset('public/front/images/customer.png')}}" class="img-fluid" alt="">

                </div>



                <div class="col-md-7 wow animate__fadeInRight" data-wow-duration="1500ms">

                    <div class="main-head text-left">

                        <h2>Become a customer </h2>

                    </div>

                    <p>Lorem ipsum dolor sit amet, onsectetur adipiscing elit, ut labore et dolore magna aliqua. Ut enim ad minim veniam. Lorem ipsum dolor sit amet, onsectetur adipiscing elit, ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>

                    <div class="customer-btn vendor-btn">

                        <a href="#">sign up as customer</a>

                        <a href="javascript:void(0)">customer login</a>

                    </div>

                </div>



            </div>

        </div>

    </div>

    <!----------- customer----------->





<script type="text/javascript" src="{{ asset('public/assets/js/view/index.js') }}"></script>
@endsection