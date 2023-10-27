@extends('frontend.master')

@section('content')

    <div class="inner-banner">
        <img src="<?php echo asset('public/assets/images/inner-banner.png') ?>" alt="">
        <div class="container inner-caption-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="inner-banner-caption wow animate__fadeInUp" data-wow-duration="1500ms">
                        <h2>Blog</h2>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <div class="inner-sec-bg service-sec">
        <div class="container">
          

            <div class="row">
                @if(!empty($blog_listing))
                    @foreach($blog_listing as $var_blog_listing)
                        <div class="col-lg-4 col-sm-6">
                            <div class="blog-sec-box wow animate__fadeInLeft" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-name: fadeInLeft;">
                               
                                
                              
                                <a href="{{ url('/').'/blog/'.$var_blog_listing->blog_slug }}" target="_blank">
                                <img src="{{ asset('public/blog_file').'/'.$var_blog_listing->blog_file }}" class="img-fluid" alt="">
                                <h4>{{ (strlen($var_blog_listing->blog_title) > 30) ? substr($var_blog_listing->blog_title,0,30).'...' : $var_blog_listing->blog_title;}}</h4>
                                </a>
                            </div>
                        </div>
                    
                    @endforeach
                @endif
                
                
            </div>
            <!-- <div class="row" id="page_pagination">
            </div> -->
        </div>
    </div>
@endsection