@extends('vendar.layouts.design')

@section('content')

  <div class="vendor-dashboard inner-sec-bg">
    <div class="container">
        <h3>Voucher</h3>
        <div class="dashboard-inner">
          <div class="row">
            <div class="col-lg-3 col-sm-12">
                <div class="dashboard-left">
                    

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
                      <table id="voucherTable" class="table table-bordered table-striped table-responsive">
                        <thead>
                        <tr>
                          <th>SL No.</th>
                          <th>Voucher Name</th>
                          <th>Added Date</th>
                          <th>Expired Date</th>
                          <th>Total Redeemed</th>
                          <th>Admin Status</th>
                          <th>Status</th>
                          <th>Voucher Code</th>
                          <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody style="font-size: 14px;">
                        <?php $count =1;?>
                            @foreach($vouchers as $voucher)
                        <tr>
                            
                          <td>{{ $count++ }}</td>
                          <td>{{$voucher->voucher_name}}</td>
                          <td>{{  date('d-m-Y', strtotime($voucher->add_date)) }}</td>
                          <td>{{  date('d-m-Y', strtotime($voucher->expiry_date)) }}</td>

                          <td>{{$voucher->redemption}}</td>
                         
                          @if($voucher->admin_approved == 1)
                          <td style="color:green">Approve</td>
                          @else
                            <td style="color:red">Pending</td>
                          @endif
                          @if($voucher->status == 'active')
                          <td>
                            <label class="switch">
                              <input type="checkbox" class="status_change" data="{{ $voucher->id }}" checked>
                              <span class="slider round" title="Active" ></span>
                            </label>
                          </td>
                          @else
                          <td>
                            <label class="switch">
                              <input type="checkbox" class="status_change" data="{{ $voucher->id }}">
                              <span class="slider round" title="Inactive"></span>
                            </label>
                          </td>
                          @endif
                          <td>
                          @if(empty($voucher->voucher_code))
                            <a class="btn btn-sm btn-info generate_code" href="#" data-id="{{ $voucher->id }}">Generate</a>
                          @else
                            <a href="javascript:void(0)" title="Click to copy" class="coppyClicpboard" onclick="copyToClipboard('{{ $voucher->voucher_code }}')"> {{ $voucher->voucher_code }} </a>
                          @endif
                          </td>
                          <td>
                              <a href="#" title="click to show details" class="show_details" data="{{ $voucher->id }}"><i class="far fa-eye" aria-hidden="true"></i></a>&nbsp;&nbsp;
                              <a href="{{ route('vendor.edit_voucher',$voucher->id) }}"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
                              <a href="#" class="delete_voucher" data="{{ $voucher->id }}"><i class="fas fa-trash-alt"></i></i></a>
                              
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