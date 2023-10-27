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

          <div class="card">
              <div class="card-header">
               
                <a href="javascript:void(0)" class="btn btn-primary float-right" data-toggle="modal" data-target=".bd-example-modal-lg">Add Country</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <table id="blog_table" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th style="width: 9%;">SL No.</th>
                        <th>Country Name</th>
                        <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $count =1;?>
                    @foreach($get_country as $get_countries)
                      <tr>
                          <td>{{ $count }}</td>
                          <td>{{ $get_countries->name}}</td>
                          <td>
                            <a href="javascript:void(0)" class="countryedit" data-countryEdit="{{ $get_countries->id }}" data-toggle="modal" data-target=".bd-example-modal-lg-editcountry"><i class="fas fa-edit"></i></a>
                              &nbsp;&nbsp;
                            <a href="javascript:void(0)" class="delete_country" data-deleteCountry="{{ $get_countries->id }}"><i class="fas fa-trash"></i></a>
                              &nbsp;&nbsp;
                          </td>
                      </tr>
                      @php $count++; @endphp
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

<!-- Add Blog -->

<!-- Add Blog -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Country</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="javascript:void(0)" method="post" name="addcountry" id="addcountry">
            <div class="modal-body">
                
                <div class="form-group">
                    <label class="col-form-label">Country Name <b class="req_red">*</b></label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-primary submit_btn">Submit</button>
            </div>
        </form>
        <p class="text-center fl-success" id="successaddcountry" style="display:none;"></p>  
        <p class="text-center fl-success" id="erroraddcountry" style="display:none;"></p> 
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg-editcountry" tabindex="-1" role="dialog" aria-labelledby="editblog_view" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabelview">Edit Blog</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="javascript:void(0)" method="post" name="edit_countryname" id="edit_countryname">
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-form-label">Country Name <b class="req_red">*</b></label>
                    <input type="text" class="form-control" id="editcountryname" name="name">
                </div>
                <input type="hidden" id="country_id" name="country_id" value="">
                
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-primary submit_btn">Submit</button>
            </div>
        </form>
        <p class="text-center fl-success" id="successeditcountry" style="display:none;"></p>  
        <p class="text-center fl-success" id="erroreditcountry" style="display:none;"></p> 
    </div>
  </div>
</div>

<script type="text/javascript" src="{{ asset('public/assets/js/view/admin/country.js') }} "></script>

@endsection