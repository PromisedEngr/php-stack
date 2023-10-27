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
                <h3 class="card-title">Edit</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form name="edit_service_category_form" action="javascript:void(0)" method="POST">
                  @csrf
                  <input type="hidden" name="id" value="{{ $edit_data->id }}">
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="category_name">Category Name <span class="is-required">*</span></label>
                            <input type="text" class="form-control" id="category_name" name="category_name" value="{{$edit_data->category_name}}">
                        </div>
                        <div class="col-md-12">
                            <label for="customer_id">Descriptions </label>
                            <textarea name="descriptions" class="form-control" id="description" row="5">{{ $edit_data->descriptions }}</textarea>
                        </div>

                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="amount">Category Image </label>
                            <input type="file" id="category_image" name="category_image" class="form-control">
                            <div class="text-center" id="set_image">
                                @if(!empty($edit_data->category_image))
                                    <img style="width: 50%; padding: 10px" src="{{ url('/public/category_images/'.$edit_data->category_image) }}" alt="Category image">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="priority_order">Priority Order <span class="is-required">*</span></label>
                            <input type="text" class="form-control" id="priority_order" name="priority_order" value="{{$edit_data->priority_order}}">
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