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
               
                <a href="javascript:void(0)" class="btn btn-primary float-right" data-toggle="modal" data-target=".bd-example-modal-lg">Add State</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <table id="blog_table" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th style="width: 9%;">SL No.</th>
                        <th>Country Name</th>
                        <th>State Name</th>
                        <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $count =1;?>
                    @foreach($get_state as $get_states)
                      <tr>
                          <td>{{ $count }}</td>
                          <td>{{ $get_states->name}}</td>
                          <td>{{ $get_states->state_name}}</td>
                          <td>
                            <a href="javascript:void(0)" class="stateEdit" data-stateEdit="{{ $get_states->state_id }}" data-toggle="modal" data-target=".bd-example-modal-lg-editstate"><i class="fas fa-edit"></i></a>
                              &nbsp;&nbsp;
                            <a href="javascript:void(0)" class="delete_state" data-deleteState="{{ $get_states->state_id }}"><i class="fas fa-trash"></i></a>
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
            <h5 class="modal-title" id="exampleModalLabel">Add State</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="javascript:void(0)" method="post" name="addstate" id="addstate">
            <div class="modal-body">
              <div class="form-group">
                  <label class="col-form-label">Select Country <b class="req_red">*</b></label>
                  <select name="country_id" id="country_id" class="form-control" aria-label="Default select example"></select>
              </div>
              <div class="form-group">
                  <label class="col-form-label">State Name <b class="req_red">*</b></label>
                  <input type="text" class="form-control" id="name" name="name">
              </div>
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-primary submit_btn">Submit</button>
            </div>
        </form>
        <p class="text-center fl-success" id="successaddstate" style="display:none;"></p>  
        <p class="text-center fl-success" id="erroraddstate" style="display:none;"></p> 
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg-editstate" tabindex="-1" role="dialog" aria-labelledby="editblog_view" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabelview">Edit State</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="javascript:void(0)" method="post" name="edit_statename" id="edit_statename">
            <div class="modal-body">
                <div class="form-group">
                <label class="col-form-label">Select Country <b class="req_red">*</b></label>
                <select name="editcountry_id" id="editcountry_id" class="form-control" aria-label="Default select example"></select>
              </div>
              <div class="form-group">
                  <label class="col-form-label">State Name <b class="req_red">*</b></label>
                  <input type="text" class="form-control" id="editname" name="name">
              </div>
                <input type="hidden" id="state_id" name="state_id" value="">
                
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-primary submit_btn">Submit</button>
            </div>
        </form>
        <p class="text-center fl-success" id="successeditState" style="display:none;"></p>  
        <p class="text-center fl-success" id="erroreditState" style="display:none;"></p> 
    </div>
  </div>
</div>

<script type="text/javascript" src="{{ asset('public/assets/js/view/admin/state.js') }} "></script>

@endsection