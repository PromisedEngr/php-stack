@extends('admin.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $page_title }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">{{ $page_title }}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Create</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form name="add_service_category_form" action="javascript:void(0)" method="POST">
                  @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="category_name">Category Name <span class="is-required">*</span></label>
                            <input type="text" class="form-control" id="category_name" name="category_name" value="{{old('category_name')}}">
                        </div>
                        <div class="col-md-12">
                            <label for="customer_id">Descriptions </label>
                            <textarea name="descriptions" class="form-control" id="description" row="5"></textarea>
                        </div>
                        
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="amount">Category Image </label>
                            <input type="file" id="category_image" name="category_image" class="form-control">
                            <div class="text-center" id="set_image">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="priority_order">Priority Order <span class="is-required">*</span></label>
                            <input type="text" class="form-control validfieldnumber" id="priority_order" name="priority_order" value="{{old('priority_order')}}">
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-success submit">Submit</button>
                  <a href="{{ route('admin.service_category') }}" class="btn btn-danger">Cancel</a>
                </div>
              </form>
              <p id="successtext"></p>

            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    </div>

@endsection
@section('scripts')
<script type="text/javascript" src="{{ asset('public/assets/js/view/admin/service_category/common.js') }} "></script>
@endsection