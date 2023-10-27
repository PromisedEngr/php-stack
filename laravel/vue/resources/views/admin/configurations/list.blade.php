@extends('admin.master')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-12">
                @include('admin.notification')
                <div class="col-sm-6">
                    <h1>{{ $page_title }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">{{ $page_title }}  </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- card start -->
                    <div class="card"> 
                        <div class="card-header card-header-form">
                            Twillio Settings
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if(session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            {{ Form::open(array('url' => '#','method'=>'POST','name'=>'twillio_settings_submit_form')) }}
                            <div class="form-group">
                                <label for="twillio_sid">Twillio SID <span class="is-required">*</span></label>
                                {{ Form::text('twillio_sid',Helper::getConfiguration('twillio_sid'),['class'=>'form-control','id'=>'twillio_sid','placeholder'=>'Enter Twillio SID','aria-describedby'=>'twillio_sidHelp']) }}
                                <small id="twillio_sidHelp" class="form-text text-muted">You'll get this from Twillio developer dashboard.</small>
                            </div>
                            <div class="form-group">
                                <label for="twillio_token">Twillio Token <span class="is-required">*</span></label>
                                {{ Form::text('twillio_token',Helper::getConfiguration('twillio_token'),['class'=>'form-control','id'=>'twillio_token','placeholder'=>'Enter Twillio Token','aria-describedby'=>'twillio_tokenHelp']) }}
                                <small id="twillio_tokenHelp" class="form-text text-muted">You'll get this from Twillio developer dashboard.</small>
                            </div>
                            <div class="form-group">
                                <label for="twillio_phone">Twillio Phone <span class="is-required">*</span></label>
                                {{ Form::text('twillio_phone',Helper::getConfiguration('twillio_phone'),['class'=>'form-control','id'=>'twillio_phone','placeholder'=>'Enter Twillio Phone','aria-describedby'=>'twillio_phoneHelp']) }}
                                <small id="twillio_phoneHelp" class="form-text text-muted">You'll get this from Twillio developer dashboard.</small>
                            </div>
                            <div class="form-group">
                                <label for="otp_expired_time">OTP Expire Time <span class="is-required">*</span></label>
                                {{ Form::text('otp_expired_time',Helper::getConfiguration('otp_expired_time'),['class'=>'form-control isNumericField','id'=>'otp_expired_time','placeholder'=>'Enter OTP expire time as seconds','aria-describedby'=>'otp_expired_timeHelp']) }}
                                <small id="otp_expired_timeHelp" class="form-text text-muted">Please enter numeric value as seconds. like 120</small>
                            </div>
                            
                            <button type="submit" class="btn btn-sm btn-success submit">Save</button>
                            <a class="btn btn-sm btn-warning twillio_clear">Clear</a>
                            {{ Form::close() }}
                            <p id="twillio_msg"></p>
                        </div>
                        <!-- /.card-body -->
                    </div>  
                    <!-- card start end-->

                     <!-- card start -->
                     <div class="card"> 
                        <div class="card-header card-header-form">
                            Points Settings
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if(session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            {{ Form::open(array('url' => '#','method'=>'POST','name'=>'point_settings_submit_form')) }}
                            <div class="form-group">
                                <label for="vendor_maximum_point">Maximum Points for Vendors </label>
                                {{ Form::text('vendor_maximum_point',Helper::getConfiguration('vendor_maximum_point'),['class'=>'form-control isNumericField','id'=>'vendor_maximum_point','placeholder'=>'Enter all vendors maximum points','aria-describedby'=>'vendor_maximum_pointHelp']) }}
                                <small id="vendor_maximum_pointHelp" class="form-text text-muted">Maximum points get in each transaction for all vendors.</small>
                            </div>
                            <div class="form-group">
                                <label for="customer_maximum_point">Maximum Points for Customers</label>
                                {{ Form::text('customer_maximum_point',Helper::getConfiguration('customer_maximum_point'),['class'=>'form-control isNumericField','id'=>'customer_maximum_point','placeholder'=>'Enter all customers maximum points','aria-describedby'=>'customer_maximum_pointHelp']) }}
                                <small id="customer_maximum_pointHelp" class="form-text text-muted">Maximum points get in each invoice scan for all customers.</small>
                            </div>
                            <div class="form-group">
                                <label for="">Point Slabs <span class="is-required">*</span> <small id="one_starHelp" class="form-text text-muted">Only numeric value can be added.</small></label>
                                <div class="row">
                                    <div class="col-md-1">From</div>
                                    <div class="col-md-4">
                                        {{ Form::text('one_star_from',Helper::getConfiguration('one_star_from'),['class'=>'form-control isNumericField','id'=>'one_star_from']) }}
                                        
                                    </div>
                                    <div class="col-md-1" style="text-align:right;">To</div>
                                    <div class="col-md-4">
                                        {{ Form::text('one_star_to',Helper::getConfiguration('one_star_to'),['class'=>'form-control isNumericField','id'=>'one_star_to']) }}
                                        
                                    </div>
                                    <div class="col-md-2">
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-1">From</div>
                                    <div class="col-md-4">
                                        {{ Form::text('two_star_from',Helper::getConfiguration('two_star_from'),['class'=>'form-control isNumericField','id'=>'two_star_from']) }}
                                        
                                    </div>
                                    <div class="col-md-1" style="text-align:right;">To</div>
                                    <div class="col-md-4">
                                        {{ Form::text('two_star_to',Helper::getConfiguration('two_star_to'),['class'=>'form-control isNumericField','id'=>'two_star_to']) }}
                                        
                                    </div>
                                    <div class="col-md-2">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-1">From</div>
                                    <div class="col-md-4">
                                        {{ Form::text('three_star_from',Helper::getConfiguration('three_star_from'),['class'=>'form-control isNumericField','id'=>'three_star_from']) }}
                                        
                                    </div>
                                    <div class="col-md-1" style="text-align:right;">To</div>
                                    <div class="col-md-4">
                                        {{ Form::text('three_star_to',Helper::getConfiguration('three_star_to'),['class'=>'form-control isNumericField','id'=>'three_star_to']) }}
                                        
                                    </div>
                                    <div class="col-md-2">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-1">From</div>
                                    <div class="col-md-4">
                                        {{ Form::text('four_star_from',Helper::getConfiguration('four_star_from'),['class'=>'form-control isNumericField','id'=>'four_star_from']) }}
                                        
                                    </div>
                                    <div class="col-md-1" style="text-align:right;">To</div>
                                    <div class="col-md-4">
                                        {{ Form::text('four_star_to',Helper::getConfiguration('four_star_to'),['class'=>'form-control isNumericField','id'=>'four_star_to']) }}
                                        
                                    </div>
                                    <div class="col-md-2">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-1">From</div>
                                    <div class="col-md-4">
                                        {{ Form::text('five_star_from',Helper::getConfiguration('five_star_from'),['class'=>'form-control isNumericField','id'=>'five_star_from']) }}
                                        
                                    </div>
                                    <div class="col-md-1" style="text-align:right;">To</div>
                                    <div class="col-md-4">
                                        {{ Form::text('five_star_to',Helper::getConfiguration('five_star_to'),['class'=>'form-control isNumericField','id'=>'five_star_to']) }}
                                        
                                    </div>
                                    <div class="col-md-2">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-sm btn-success point_submit">Save</button>
                            <!-- <a class="btn btn-sm btn-warning point_clear">Clear</a> -->
                            {{ Form::close() }}
                            <p id="point_msg"></p>
                        </div>
                        <!-- /.card-body -->
                    </div>  
                    <!-- card start end-->
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('public/assets/js/view/admin/configuration.js') }} "></script>
@endsection