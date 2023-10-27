@extends('vendar.layouts.design')
@section('content')
	<div class="vendor-dashboard inner-sec-bg">
        <div class="container">
            <h3>Change Password</h3>
            <div class="dashboard-inner">
                <div class="row">
                    <div class="col-lg-3 col-sm-12">
                        <div class="dashboard-left">
                            <div class="dashboard-logo">
                                <img src="{{ asset('public/assets/images/logo-white.png')}}" class="img-fluid" alt="logo">
                            </div>

                            <!-- Nav tabs -->
                           @include('vendar.sidebar')
                        </div>
                    </div>
                    <div class="col-lg-9 col-sm-12">
                        <div class="dashboard-right">
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab1">
                                    <div class="tab1-upper blue-color">
                                    	<form id="changepasswordsubmit" name="changepasswordsubmit" action="javascript:void(0)" method="post">
											  <div class="form-group">
											    <label for=""><b>Old Password</b> <b class="req">*</b></label>
											    <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Enter your Old Password">
											   
											  </div>
											  <div class="form-group">
											    <label for=""><b>New Password</b> <b class="req">*</b></label>
											    <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter your New Password">
											  </div>
											  <div class="form-group">
											    <label for=""><b>Confirm Password</b> <b class="req">*</b></label>
											    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Enter your Confirm Password">
											  </div>
											  
											  <button type="submit" class="btn btn-primary">Submit</button>
										</form>
										<p class="text-center fl-success" id="successchangepassword" style="display:none;"></p>  
            							<p class="text-center fl-success" id="errorchangepassword" style="display:none;"></p>  
                                        
                                    </div>
                                    
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="{{ asset('public/assets/js/view/vendors/changepassword.js') }} "></script>
@endsection 