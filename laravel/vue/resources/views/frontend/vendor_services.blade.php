@extends('frontend.master')

@section('content')
    <!------- header --------->


    <!-----------inner-banner----------->
    <div class="inner-banner">
        <img src="<?php echo asset('public/assets/images/inner-banner.png') ?>" alt="">
        <div class="container inner-caption-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="inner-banner-caption wow animate__fadeInUp" data-wow-duration="1500ms">
                        <h2>Our Services</h2>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <!-----------inner-banner----------->

    <!-----------service-sec----------->
    <div class="inner-sec-bg service-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <a href="javascript:void(0)" class="post_task btn btn-sm btn-success">Post a Task</a>
                </div>
                <div class="col-md-6">
                   <div class="search-container">
                        <input type="text"  placeholder="Search.." id="search_name" name="search">
                        <button type="submit" id="servicesearch"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>

            <div class="row" id="fetch_services">
            </div>
            <div class="row" id="page_pagination">
            </div>
        </div>
    </div>
    <!-----------service-sec----------->

     <!----------vendor----------->
    <!-- <div class="vendor service-vendor">
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
                    <img src="<?php // echo asset('public/assets/images/vendor-lady.png') ?>" class="img-fluid" alt="">
                </div>

            </div>
        </div>
    </div> -->
    <!-----------vendor----------->

    <div class="modal" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">
         
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Post a Task</h4>
              <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
           
            <!-- Modal body -->
            <div class="modal-body">
             <form action="javascript:void(0)" method="POST" id="customer_post_task" name="customer_post_task">
                <div class="form-group">
                    <label for="inputEmail4">Category service <b class="req">*</b></label>
                    {{ Form::select('category_service_id',$service_categoriesDP,'',['class'=>'form-control','id'=>'category_service_id']) }}
                    
                
                </div>
                <div class="form-group">
                    <label for="inputEmail4">Task Name <b class="req">*</b></label>
                    <input type="text" name="task_name" id="task_name" value="" class="form-control no_space" placeholder="Task Name">
                
                </div>
                <div class="form-group">
                    <label for="inputEmail4">Description <b class="req">*</b></label>
                   <textarea name="description" id="description" value="" class="form-control no_space" cols="5" rows="5"></textarea>
                
                </div>
                <div class="form-group">
                    <label for="inputEmail4">Expected Date <b class="req">*</b></label>
                    <input type="text" name="expected_date" id="expected_date" value="" class="form-control" placeholder="Enter Expected Date">
                
                </div>
                <div class="form-group">
                    <label for="inputEmail4">Work Amount <b class="req">*</b></label>
                    <input type="text" name="amount" id="amount" value="" class="form-control no_space" placeholder="Task Name">
                
                </div>
                <div class="form-group">
                    <label for="inputEmail4">Address <b class="req">*</b></label>
                    <textarea name="address" id="address" value="" class="form-control no_space" cols="5" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="inputEmail4">Country <b class="req">*</b></label>
                    
                    <!-- {{ Form::select('customer_country_id',$countryDp,'132',['class'=>'form-control select2','id'=>'customer_country_id']) }} -->
                    <select class="form-control" name="customer_country_id" id="customer_country_id">
                       
                    </select>
                </div>
                <div class="form-group">
                    <label for="inputEmail4">State <b class="req">*</b></label>
                    <select name="customer_state_id" id="customer_state_id" class="form-control select2">
                        <option value="">Please Select</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="inputEmail4">City <b class="req">*</b></label>
                    <input type="text" name="city" id="city" value="" class="form-control no_space" placeholder="City">
                
                </div>
                <div class="form-group">
                    <label for="inputEmail4">Zipcode <b class="req">*</b></label>
                    <input type="text" name="zipcode" id="zipcode" value="" class="form-control no_space" placeholder="Zipcode">
                
                </div>
                <div class="form-group">
                   <button type="submit" class="btn btn-primary">Post</button>
                </div>
             </form>
                <p class="text-center fl-success" id="successsubmitTask" style="display:none;"></p>  
                <p class="text-center fl-success" id="errorsubmitTask" style="display:none;"></p>  
            </div>
          </div>
        </div>
    </div>




    <script type="text/javascript" src="{{ asset('public/assets/js/view/customer/view_services.js') }} "></script>
@endsection
    
