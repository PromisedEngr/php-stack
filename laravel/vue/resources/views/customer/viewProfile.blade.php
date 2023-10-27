@extends('customer.layouts.design')
@section('content')
<script type="text/javascript">
    var CUSTOMER_DETAILS = {!! json_encode($customer_details) !!};
</script>
<!-- <div class="vendor-dashboard inner-sec-bg">
    <div class="container">
        <h3>Customer Profile</h3>
        <div class="dashboard-inner">
            <div class="row">
                <div class="col-lg-3 col-sm-12">
                    <div class="dashboard-left">
                        
                        @include('customer.sidebar')
                    </div>
                </div>
                <div class="col-lg-9 col-sm-12">
                    <div class="dashboard-right">
                        
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1">
                                <div class="tab1-upper blue-color" id="customer_details">
                                    
                                </div>
                                <div class="tab1-bottom">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="upload-img blue-color upload-sec">
                                                <label for="input" id="label">
                                                    <a class="" id="profile_edit" href="javascript:void(0)" title="Click to edit">Edit your details</a>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="change-password blue-color">
                                                <a href="javascript:void(0)" class="password-btn" id="customer_changepassword">Change Password</a>
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
</div> -->



    



    <section class="user-details-tab">
        <div class="row">
            <!-- SideBar Menu -->
            @include('customer.sidebar')

            <div class="col-lg-9 col-sm-8">
                <div class="user-details-tab-right">
                    <div class="tab-content" id="v-pills-tabContent">

                        <div class="tab-pane fade show active" id="v-pills-customer-profile" role="tabpanel" aria-labelledby="v-pills-customer-profile-tab">
                            <div class="dashboard-right1">
                                <h3>CUSTOMER PROFILE</h3>
                            </div>
                            <div class="dashboard-right2">
                                <div class="row">
                                    <div class="col-lg-6 col-sm-12">
                                        <?php if(!empty(Auth::guard('customer')->user()->profile_image)){ ?>
                                            <img src="{{ asset('public/profile_images/'.Auth::guard('customer')->user()->profile_image)}}" alt="user" id="customer_image" class="img-fluid"></a>
                                            <?php }else { ?>
                                            <img src="{{ asset('public/assets/images/new_customer_image/images/user.png')}}" alt="user" id="customer_image" class="img-fluid"></a>
                                        <?php } ?>
 
                                    </div>
                                    <div class="col-lg-6 col-sm-12" id="customer_details_upper">
                                    </div>
                                    <div class="col-lg-6 col-sm-12" >
                                        <div id="customer_details_lower">
                                        </div>
                                        <a href="javascript:void(0)" id="customer_changepassword" class="password-btn">Change Password</a>
                                        <a id="profile_edit" href="javascript:void(0)" title="Click to edit" class="updateprofile-btn">Update Profile</a>

                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="upload-btn">
                                            <label for="input" id="label">
                                                <img src="{{ asset('public/assets/images/new_customer_image/images/upload.png')}}" class="img-fluid" alt="file upload">
                                                <span id="span">Upload Receipt</span>
                                                <input id="input" type="file">
                                            </label>

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

    <div id="edit_profile_modal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <form name="edit_profile_form" id="edit_profile_form" action="javascript:void(0)" method="POST" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title">Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group col-md-12">
                    <label>Customer Name: <b class="is-required">*</b></label>
                    <input type="text " name="name" id="customer_name" class="form-control validfield" >
                    
                </div>
                <div class="form-group col-md-12">
                    <label for="inputZip">DOB <b class="req">*</b></label>
                    <input type="text " name="dob" id="customer_dob" value="" class="form-control validateYear" >
                </div>
                    <div class="form-group col-md-12">
                    <label for="inputAddress">Address <b class="req">*</b></label>
                    <textarea name="address" value="" id="customer_address" class="form-control" cols="7" rows="5"></textarea>
                    
                </div>
                <div class="from-group col-md-12">
                    <label>Profile Image: <small>(Please upload .jpg, .png, .jpeg types of file)</small></label>
                    <input type="file" name="profile_image" id="profile_image" class="form-control"  accept=".jpg,.png,.jpeg">
                    <div class="text-center" id="set_image">
                    
                    </div>
                </div>
                <input type="hidden" name="user_id" id="user_id" value="">
            </div>
            <div class="modal-footer">
                
                <button type="submit" class="btn btn-success">Submit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
            </form>
            <p class="text-center fl-success" id="successUpdate" style="display:none;"></p>  
            <p class="text-center fl-success" id="errorupdate" style="display:none;"></p> 
            </div>
        </div>
    </div>

    <!--     Change Password Modal   -->

    <div id="customerChangePassword" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
          <form name="customerchangepasswordmodal" id="customerchangepasswordmodal" action="javascript:void(0)" method="POST" >
            <div class="modal-header">
              <h5 class="modal-title">Change Password</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group col-md-12">
                  <label>Old Password: <b class="is-required">*</b></label>
                  <input type="password" name="old_password" id="old_password" class="form-control" >
                 
                </div>
                <div class="form-group col-md-12">
                    <label>New Password <b class="req">*</b></label>
                    <input type="password" name="new_password" id="new_password" class="form-control" >
                </div>
                <div class="form-group col-md-12">
                    <label>Confirm Password <b class="req">*</b></label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" >
                </div>
                 
                
                <input type="hidden" name="user_id" id="password_user_id" value="">
            </div>
            <div class="modal-footer">
               
              <button type="submit" class="btn btn-success">Submit</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
            </form>
            <p class="text-center fl-success" id="successUpdatePassword" style="display:none;"></p>  
            <p class="text-center fl-success" id="errorupdatePassword" style="display:none;"></p> 
          </div>
        </div>
    </div>


   <script type="text/javascript" src="{{ asset('public/assets/js/view/customer/view_profile.js') }} "></script>

@endsection