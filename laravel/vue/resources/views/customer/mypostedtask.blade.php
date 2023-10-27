@extends('customer.layouts.design')
@section('content')

<?php //pr(Auth::guard('customer')->user()->id); die;?>

	<!-- <div class="vendor-dashboard inner-sec-bg">
        <div class="container">
            <h3>My Posted Task</h3>
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
                                	<div class="card-body">
				                      	<table id="mytaskTable" class="table table-bordered table-striped table-responsive">
					                        <thead>
						                        <tr>
						                          <th>SL No.</th>
						                          <th>Service Category</th>
						                          <th>Task Name</th>
						                          <th>Task Date</th>
						                          <th>Address</th>
						                          <th>Accepted</th>
						                          <th>Status</th>
						                          <th>Actions</th>
						                        </tr>
					                        </thead>
					                        <tbody style="font-size: 14px;">
						                        <?php // $count =1;?>
						                            @foreach($get_serviceTask as $get_serviceTasks)
						                        <tr>
						                        	@php
														$accepted_text='Not Yet';
														$accepted_color='#7c7a7a';
														if(!empty($get_serviceTasks->accepted_by)){
															$accepted_text=Helper::get_field('users','id',$get_serviceTasks->accepted_by,'name');
															$accepted_color='green';
														} else{
															$accepted_text='Not Yet';
															$accepted_color='#7c7a7a';
														}
														$status_text='';
														$status_color='';
														if($get_serviceTasks->task_status==1){
															$status_text='Created';
															$status_color='blue';
														} elseif($get_serviceTasks->task_status==2){
															$status_text='Accepted';
															 $status_color='#38a38a';
														}elseif($get_serviceTasks->task_status==3){
															$status_text='Pending';
															$status_color='gray';
														}elseif($get_serviceTasks->task_status==4){
															$status_text='Cancelled';
															$status_color='red';
														}elseif($get_serviceTasks->task_status==5){
															$status_text='Completed';
															$status_color='green';
														}
													@endphp
													<td></td>
													<td>{{$get_serviceTasks->category_name}}</td>
													<td>{{$get_serviceTasks->task_name}}</td>
													<td>{{date('d-m-Y', strtotime($get_serviceTasks->expected_date)) }}</td>
													<td>{{$get_serviceTasks->address}}</td>
												 
													<td style="color:{{ $accepted_color }}">{{ $accepted_text }}</td>
													<td style="color:{{ $status_color }}">{{ $status_text }}</td>
													<td>
														<a href="javascript:void(0)" title="click to show details" class="show_details" data-view_details="{{ $get_serviceTasks->task_id }}"><i class="far fa-eye" aria-hidden="true"></i></a>&nbsp;&nbsp;
														<a href="javascript:void(0)" title="click to edit details" data-edit_details="{{ $get_serviceTasks->task_id }}" class="edit_details"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
														<a href="javascript:void(0)" class="delete_voucher" data=""><i class="fas fa-trash-alt"></i></i></a>
														
													</td>
						                        </tr>
						                        @endforeach
					                        </tbody>
					                    </table>
				                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal viewtaskDetails" id="myModal_view">
        <div class="modal-dialog">
          <div class="modal-content">
         
           
            <div class="modal-header">
              <h4 class="modal-title">View Task Details</h4>
              <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
           
            
            <div class="modal-body">
            	<div id="details_view_task">
            		
            	</div>
            </div>
          </div>
        </div>
    </div>

     -->

	<section class="user-details-tab">
        <div class="row">
            <!-- SideBar Menu -->
            @include('customer.sidebar')


            <div class="col-lg-9 col-sm-8">
                <div class="user-details-tab-right">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-dashboard" role="tabpanel" aria-labelledby="v-pills-dashboard-tab">
                            <div class="dashboard-right1">
                                <h3>POST TASK AS CUSTOMER</h3>
                            </div>
							<div class="tab-content">
                                <div class="tab-pane active" id="tab1">
                                	<div class="card-body">
				                      	<table id="mytaskTable" class="table table-bordered table-striped table-responsive">
					                        <thead>
						                        <tr>
						                          <th>SL No.</th>
						                          <th>Service Category</th>
						                          <th>Task Name</th>
						                          <th>Task Date</th>
												  <th>Amount</th>
						                          <th>Address</th>
						                          <th>Accepted</th>
						                          <th>Status</th>
						                          <th>Actions</th>
						                        </tr>
					                        </thead>
					                        <tbody style="font-size: 14px;">
						                        <?php  $count =1;?>
						                            @foreach($get_serviceTask as $get_serviceTasks)
						                        <tr>
						                        	@php
														$accepted_text='Not Yet';
														$accepted_color='#7c7a7a';
														if(!empty($get_serviceTasks->accepted_by)){
															$accepted_text=Helper::get_field('users','id',$get_serviceTasks->accepted_by,'name');
															$accepted_color='green';
														} else{
															$accepted_text='Not Yet';
															$accepted_color='#7c7a7a';
														}
														$status_text='';
														$status_color='';
														if($get_serviceTasks->task_status==1){
															$status_text='Created';
															$status_color='blue';
														} elseif($get_serviceTasks->task_status==2){
															$status_text='Accepted';
															 $status_color='#38a38a';
														}elseif($get_serviceTasks->task_status==3){
															$status_text='Pending';
															$status_color='gray';
														}elseif($get_serviceTasks->task_status==4){
															$status_text='Cancelled';
															$status_color='red';
														}elseif($get_serviceTasks->task_status==5){
															$status_text='Completed';
															$status_color='green';
														}
													@endphp
													<td>{{$count ++}}</td>
													<td>{{$get_serviceTasks->category_name}}</td>
													<td>{{$get_serviceTasks->task_name}}</td>
													<td>{{date('d-m-Y', strtotime($get_serviceTasks->expected_date)) }}</td>
													<td>{{$get_serviceTasks->amount}}</td>
													<td>{{$get_serviceTasks->address}}</td>
												 
													<td style="color:{{ $accepted_color }}">{{ $accepted_text }}</td>
													<td style="color:{{ $status_color }}">{{ $status_text }}</td>
													<td>
														<a href="javascript:void(0)" title="click to show details" class="show_details" data-view_details="{{ $get_serviceTasks->task_id }}">
															<i class="far fa-eye" aria-hidden="true"></i>
														</a>&nbsp;&nbsp;
														@if($get_serviceTasks->task_status==1)
															<a href="javascript:void(0)" title="click to edit details" data-edit_details="{{ $get_serviceTasks->task_id }}" class="edit_details">
																<i class="fas fa-edit"></i>
															</a>&nbsp;&nbsp;

															<a href="javascript:void(0)" class="delete_voucher" data="">
																<i class="fas fa-trash-alt"></i></i>
															</a>
														@endif
													</td>
						                        </tr>
						                        @endforeach
					                        </tbody>
					                    </table>
				                    </div>
                                </div>
                            </div>


                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

	<div class="modal edittaskDetails" id="myModal_edit">
        <div class="modal-dialog">
          <div class="modal-content">
         
            
            <div class="modal-header">
              <h4 class="modal-title">Edit Task</h4>
              <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
           
            
            <div class="modal-body">
            	<form action="javascript:void(0)" method="POST" id="customeredit_post_task" name="customeredit_post_task">
	                <!-- <div class="form-group">
	                    <label for="inputEmail4">Category service <b class="req">*</b></label>
	                    <select name="category_service_id" id="category_service_id" class="form-control">
	                    </select>
	                </div> -->
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
						<input type="text" name="amount" id="amount" value="" class="form-control no_space" placeholder="Work Amount">
					
					</div>
	                <div class="form-group">
	                    <label for="inputEmail4">Address <b class="req">*</b></label>
	                    <textarea name="address" id="address" value="" class="form-control no_space" cols="5" rows="5"></textarea>
	                </div>
	                <div class="form-group">
	                    <label for="inputEmail4">Country <b class="req">*</b></label>
	                    <select name="customer_country_id" id="customer_country_id" class="form-control">
	                       
	                    </select>
	                </div>
	                <div class="form-group">
	                    <label for="inputEmail4">State <b class="req">*</b></label>
	                    <select name="customer_state_id" id="customer_state_id" class="form-control">
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
					<input type="hidden" id="hidden_task_id" name="hidden_task_id" value="">

	                <div class="form-group">
	                   <button type="submit" class="btn btn-primary">Submit</button>
	                </div>
	            </form>
                <p class="text-center fl-success" id="successsubmitTask" style="display:none;"></p>  
                <p class="text-center fl-success" id="errorsubmitTask" style="display:none;"></p> 
            </div>
          </div>
        </div>
    </div>

	<div class="modal viewtaskDetails" id="myModal_view">
        <div class="modal-dialog">
          <div class="modal-content">
         
           
            <div class="modal-header">
              <h4 class="modal-title">View Task Details</h4>
              <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
           
            
            <div class="modal-body">
            	<div id="details_view_task">
            		
            	</div>
            </div>
          </div>
        </div>
    </div>





    <script type="text/javascript" src="{{ asset('public/assets/js/view/customer/mypostedtask.js') }} "></script>

@endsection