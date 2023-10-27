@extends('admin.master')



@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Voucher Tables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Voucher:  {{\App\Models\Voucher::count()}}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
      
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

          <div class="card">
              <div class="card-header">
                <h3 class="card-title">Voucher Table</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="width: 49px;">SL No.</th>
                    <th>Voucher Name</th>
                    <th>Added Date</th>
                    <th>Expired Date</th>
                    <th>Voucher Details</th>
                    <th>Voucher Required Points</th>
                    <th>Total Redeemed</th>
                    <th>Create By</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $count =1;?>
                      @foreach($vouchers as $voucher)
                  <tr>
                        @php
                        $vouchers=\App\Models\Voucher::where('id',$voucher->id)->first();  
                        @endphp
                    <td>{{ $count++ }}</td>
                    <td>{{$voucher->voucher_name}}</td>
                    <td>{{$voucher->add_date}}</td>
                    <td>{{$voucher->expiry_date}}</td>
                    <td>{{$voucher->description}}</td>
                    <td>{{$voucher->voucher_point}}</td>
                    <td>{{$voucher->redemption}}</td>
                    <td>{{ucfirst(\App\Models\User::where('id',$vouchers->vendor_id)->value('name'))}}</td>
                    <td>
                    <div class="card-body">
                    <input type="checkbox" name="toogle1" value="{{$voucher->id}}" {{$voucher->status=='active' ? 'checked' : ''}} data-toggle="toggle" data-on="active" data-off="inactive" data-onstyle="success" data-offstyle="danger">
                    </div>
                    </td>
                    <td>
                        <a href="#"><i class="fas fa-edit"></i></a>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="#"><i class="fas fa-trash-alt"></i></i></a>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                 
                </table>
              </div>
              <!-- /.card-body -->
            </div>  


          </div>
        </div>
      </div> 
    </section>   

</div>
@endsection