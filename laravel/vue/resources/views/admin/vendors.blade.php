@extends('admin.master')



@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Vendor Tables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Vendor Tables</li>
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
                <h3 class="card-title">Vendor Table</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="width: 49px;">SL No.</th>
                    <th>Vendor Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $count=1; ?>
                  @foreach($vendors as $vendor )
                  <tr>
                    <td>{{ $count++ }}</td>
                    <td>{{ $vendor->name }}</td>
                    <td>{{ $vendor->email }}</td>
                    <td>{{ $vendor->mobile }}</td>
                    <td style="color:green;">{{ $vendor->status }}</td>
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