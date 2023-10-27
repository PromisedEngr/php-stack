@extends('vendar.layouts.design')
@section('content')
<style type="text/css">
    img#customer_image {
        height: 85%;
    }
    .company_address{
        display:flex;
    }
</style>
<script type="text/javascript">
    var VENDOR_DETAILS = {!! json_encode($user) !!};
</script>
    <section class="user-details-tab">
        <div class="row">
            @include('vendar.sidebar')
            
                <div class="col-lg-9 col-sm-8">
                   
                    <div class="user-details-tab-right">
                        <div class="tab-content" id="v-pills-tabContent">
                           
                            <div class="tab-pane fade show active" id="v-pills-customer-profile" role="tabpanel" aria-labelledby="v-pills-customer-profile-tab">
                                <div class="dashboard-right1">
                                    <h3>VENDOR PROFILE</h3>
                                </div>
                                <div class="dashboard-right2">
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <?php if(!empty(Auth::guard('vendor')->user()->profile_image)){ ?>
                                                <img src="{{ asset('public/profile_images/'.Auth::guard('vendor')->user()->profile_image)}}" alt="user" id="customer_image" class="img-fluid profile_image"></a>
                                                <?php }else { ?>
                                                <img src="{{ asset('public/assets/images/new_customer_image/images/user.png')}}" alt="user" id="customer_image" class="img-fluid profile_image"></a>
                                            <?php } ?>
    
                                        </div>
                                        <div class="col-lg-6 col-sm-12" id="">
                                            <ul>
                                                <li><h5>My Profile</h5></li>
                                                <li>Vendor Name : {{ $user->name }}</li>
                                                <li>Mobile Number : {{ $user->mobile }}</li>
                                                <li>Email : {{ $user->email }}</li>
                                                <li>Company Name : {{ $user->company_name }}</li>
                                                <li class="company_address">Company Address : <div id="show_companyaddress"></div></li>
                                                <li>Rating Level :
                                                    <a href="#"><i class="fas fa-star"></i></a>
                                                    <a href="#"><i class="fas fa-star"></i></a>
                                                    <a href="#"><i class="fas fa-star"></i></a>
                                                    <a href="#"><i class="fas fa-star"></i></a>
                                                    <a href="#"><i class="fas fa-star"></i></a>
                                                </li>
                                                <li>Account Status : {{ ucfirst($user->status) }}</li>
                                            </ul>

                                        </div>
                                        <div class="col-lg-6 col-sm-12" >
                                            
                                            <a href="{{ url('/vendor/changepassword') }}" id="customer_changepassword" class="password-btn">Change Password</a>
                                            <a href="javascript:void(0)" title="Click to edit" class="updateprofile-btn profile_edit">Update Profile</a>

                                        </div>
                                    </div>
                                    <!-- <div class="tab1-bottom">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <form  name="add_service_photo_form" method="POST" action="javascript:void(0)">
                                                    <div class="upload-img blue-color">
                                                        <label for="input" id="label">
                                                            <span id="span">Upload Services Photo</span>
                                                            <img src="{{ asset('public/assets/images/file-upload.png')}}" class="img-fluid" alt="file upload">
                                                            <input id="input" name="service_photo[]" type="file" accept="image/*" multiple="multiple">
                                                        </label>
                                                        <input type="submit" value="upload" class="btn btn-sm btn-success photo_submit" style="float: right;">
                                                    </div>
                                                    <p id="service_image_message"></p>
                                                </form>
                                                <div class="text-center" id="set_service_image">
                                                    @if(!empty($user->vendor_images))
                                                    <ul class="vendor_image_list">
                                                        @foreach($user->vendor_images as $img)
                                                        <li>
                                                            <div class="img-wrap">
                                                              
                                                                <img src="{{ url('/public/profile_images/'.$img->path) }}" alt="Service photo">
                                                                <a href="#" data-id="{{ $img->id }}" title="Delete" class="service_image_delete_icon"><i class="fa fa-trash"></i></a>
                                                            </div>

                                                            
                                                        </li>
                                                        @endforeach
                                                        
                                                    </ul>
                                                    
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="change-password blue-color">
                                                    <a href="{{ url('/vendor/changepassword') }}" class="password-btn">Change Passord</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- <div class="tab1-bottom">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <h3>Service List</h3>
                                                <div class="tab1-upper blue-color">
                                                <form  name="add_vendor_service_category_form" method="POST" action="javascript:void(0)">
                                                    <div class="form-group">
                                                        <label for="">Service <span class="is-required">*</span></label>
                                                        @if(!empty($services))
                                                        {{ Form::select('category_id[]',$categoriesDp,$services,array('class'=>'form-control category_id select2','placeholder'=>'Select a option','multiple' => 'multiple')) }}
                                                        @else
                                                        {{ Form::select('category_id[]',$categoriesDp,'',array('class'=>'form-control category_id','placeholder'=>'Select a option','multiple' => 'multiple')) }}
                                                        @endif
                                                    </div>
                                                    
                                                    <button type="submit" class="btn btn-sm btn-info" >Submit</button>
                                                </form>
                                                </div>
                                                
                                            </div>
                                            
                                        </div>
                                    </div> -->
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
                <form name="edit_profile_form" action="{{ route('vendor.edit_profile') }}" method="POST">
                    <div class="modal-header">
                    <h5 class="modal-title">Edit Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group col-md-12">
                        <label>Vendor Name: <span class="is-required">*</span></label><br>
                        <input type="text" name="vendor_name" id="vendor_name" class="form-control validfield" value="{{  $user->name }}">
                        @if ($errors->has('vendor_name'))
                            <span class="text-danger">{{ $errors->first('vendor_name') }}</span>
                        @endif
                        </div>
                        <div class="form-group col-md-12">
                        <label>Company Address: </label>
                        <textarea class="validatetextarea" name="company_address" id="company_address"></textarea>
                        <!-- <input type="text" name="company_address" id="company_address" class="form-control validatetextarea" > -->
                        @if ($errors->has('company_address'))
                            <span class="text-danger">{{ $errors->first('company_address') }}</span>
                        @endif
                        </div>
                        
                        <div class="form-group col-md-12">
                        <label>Profile Image: <small>(Please upload .jpg, .png, .jpeg types of file)</small></label>
                        <input type="file" name="profile_image" id="profile_image" class="form-control" value="{{  $user->address }}" accept=".jpg,.png,.jpeg">
                            <div class="text-center" id="set_image">
                            @if(!empty($user->profile_image))
                                <img style="width: 50%; padding: 10px" src="{{ url('/public/profile_images/'.$user->profile_image) }}" alt="Profile image">
                            @endif
                            </div>
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <p id="successtext"></p>
                    <button type="submit" class="btn btn-success">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="clone_div" style="display:none">
        <div class="clone_div_container">
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="">Service <span class="is-required">*</span></label>
                    {{ Form::select('category_id[]',$categoriesDp,'',array('class'=>'form-control category_id','placeholder'=>'Select a option','multiple' => 'multiple')) }}
                </div>
                <!-- <div class="col-md-6">
                    <label for="">Sub Category <span class="is-required">*</span></label>
                    {{ Form::select('sub_category_id[]',array(''=>'select'),'',array('class'=>'form-control sub_category_id','multiple' => 'multiple')) }}
                </div> -->
            </div>
        </div>
    </div>
    <script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
   
    <script>
           
            CKEDITOR.replace( 'company_address', {
                toolbar: [
                    { name: 'basicstyles', items : [ 'Bold','Italic' ] },
                    { name: 'document', items : [ 'Source','-','Save' ] },
                    { name: 'paragraph', items : [ 'NumberedList','BulletedList' ] },
                ]
            });
            CKEDITOR.instances.company_address.setData(VENDOR_DETAILS.address);
    </script>
    <script type="text/javascript" src="{{ asset('public/assets/js/view/vendors/voucher.js') }} "></script>
     <script>
        $("#show_companyaddress").html(VENDOR_DETAILS.address);
    </script>
@endsection     