@extends('vendar.layouts.design')

@section('content')

  <div class="vendor-dashboard inner-sec-bg">
    <div class="container">
        <h3>Vendor Profile</h3>
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

                <div class="card">
                    <div class="card-header">
                      <!-- <h3 class="card-title">Voucher Table</h3> -->
                      <a class="btn btn-primary" href="{{route('vendor.create_voucher')}}">Create New Voucher</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="vendorTaskListTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10%;">SL No.</th>
                                <th>Task</th>
                                <th>Customer</th>
                                <th>Created By</th>
                                <th>Accepted</th>
                                <th>Amount</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 14px;">
                        <?php $count =1;?>
                            @foreach($tasks as $list)
                                <tr>
                                    <td>{{ $count++ }}</td>
                                    <td>{{ucfirst($list->task_name)}}</td>
                                    <td>{{ Helper::get_field('users','id',$list->customer_id,'name') }}</td>
                                    <td>{{ Helper::get_field('users','id',$list->created_by,'name') }}</td>
                                    @if(!empty($list->accepted_by))
                                        <td>{{ Helper::get_field('users','id',$list->accepted_by,'name') }}</td>
                                    @else
                                        <td> - </td>
                                    @endif
                                    
                                    <td style="text-align:right">{{ $list->amount }}</td>
                                    <td>
                                        <a href="{{route('admin.get_task_details',$list->id)}}"><i class="fas fa-eye"></i></a>
                                        &nbsp;&nbsp;
                                        <a href="{{route('admin.edit_task',$list->id)}}"><i class="fas fa-edit"></i></a>
                                        &nbsp;&nbsp;
                                        <a href="{{route('admin.delete_task',$list->id)}}"><i class="fas fa-trash"></i></a>
                                        &nbsp;&nbsp;
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                      
                      </table>
                      <p id="successtext"></p>
                    </div>
                    <!-- /.card-body -->
                </div>  

              </div>
          </div>


        </div>
      </div> 
</div>   

</div>
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
<script type="text/javascript" src="{{ asset('public/assets/js/view/vendors/voucher.js') }} "></script>
@endsection