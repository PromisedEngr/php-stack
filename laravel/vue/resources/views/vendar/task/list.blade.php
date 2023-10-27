@extends('vendar.layouts.design')

@section('content')

<section class="user-details-tab">
  <div class="row">
    @include('vendar.sidebar')
    <div class="col-lg-9 col-sm-8">
      <div class="user-details-tab-right">
        <div class="tab-content" id="v-pills-tabContent">
          <div class="tab-pane fade show active" id="v-pills-dashboard" role="tabpanel" aria-labelledby="v-pills-dashboard-tab">
            <div class="dashboard-right1">
                <h3>{{ $page_title }}</h3>
            </div>
            <div class="tab-content">
              <div class="tab-pane active" id="tab1">
                <div class="card-body">
                  <table id="vendorTaskListTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10%;">SL No.</th>
                            <th>Task</th>
                            <th>Customer</th>
                            
                            <th>Amount</th>
                            <th>Status</th>
                            
                        </tr>
                    </thead>
                    <tbody style="font-size: 14px;">
                    <?php $count =1;?>
                    @if(!empty($all_tasks))
                        @foreach($all_tasks as $list)
                        @php 
                          $status_txt='Created';
                          $status_color='blue';
                          if($list->status==1){
                            $status_txt='Created';
                            $status_color='blue';
                          } elseif($list->status==2){
                            $status_txt='Accepted';
                            $status_color='#38a38a';
                          } elseif($list->status==3){
                            $status_txt='Pending';
                            $status_color='gray';
                          } elseif($list->status==4){
                            $status_txt='Cancelled';
                            $status_color='red';
                          } elseif($list->status==5){
                            $status_txt='Completed';
                            $status_color='green';
                          }
                        @endphp
                            <tr>
                                <td>{{ $count++ }}</td>
                                <td>{{ ucfirst($list->task_name) }}</td>
                                <td>{{ Helper::get_field('users','id',$list->fk_customer_id,'name') }}</td>
                                <td style="text-align:right">{{ $list->amount }}</td>
                                <td style="color:{{ $status_color }}">{{ $status_txt }}</td>
                            </tr>
                        @endforeach
                        
                        
                        @endif
                          @if(!empty($my_tasks))
                        @foreach($my_tasks as $list)
                        @php 
                          $status_txt='Created';
                          $status_color='blue';
                          if($list->status==1){
                            $status_txt='Created';
                            $status_color='blue';
                          } elseif($list->status==2){
                            $status_txt='Accepted';
                            $status_color='#38a38a';
                          } elseif($list->status==3){
                            $status_txt='Pending';
                            $status_color='gray';
                          } elseif($list->status==4){
                            $status_txt='Cancelled';
                            $status_color='red';
                          } elseif($list->status==5){
                            $status_txt='Completed';
                            $status_color='green';
                          }
                        @endphp
                            <tr>
                                <td>{{ $count++ }}</td>
                                <td>{{ ucfirst($list->task_name) }}</td>
                                <td>{{ Helper::get_field('users','id',$list->fk_customer_id,'name') }}</td>
                                <td style="text-align:right">{{ $list->amount }}</td>
                                <td style="color:{{ $status_color }}">{{ $status_txt }}</td>
                            </tr>
                        @endforeach
                        @endif
                    </tbody>
                  </table>
                  <p id="successtext"></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

  
<div id="show_modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<script type="text/javascript" src="{{ asset('public/assets/js/view/vendors/tasks.js') }} "></script>
@endsection