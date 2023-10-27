@extends('admin.master')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create Seo</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Create Seo</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Create Seo</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('admin.seo.update',$seos->id)}}" method="POST">
                  @csrf
                <div class="card-body">
                  <div class="form-group col-md-12">
                    <label for="exampleInputEmail1">Meta Title</label>
                    <input type="text" class="form-control" name="meta_title" value="{{$seos->meta_title}}" placeholder="Enter Meta Title">
                    @if ($errors->has('meta_title'))
                    <span class="text-danger">{{ $errors->first('meta_title') }}</span>
                @endif
                  </div>
                  
                  <div class="form-group col-md-12">
                    <label for="exampleInputEmail1">Meta Keywords</label>
                    <input type="text" class="form-control" value="{{$seos->meta_keywords}}" name="meta_keywords" placeholder="Enter Meta Keywords">
                    @if ($errors->has('meta_keywords'))
                    <span class="text-danger">{{ $errors->first('meta_keywords') }}</span>
                @endif
                  </div>

                  <div class="form-group col-md-12">
                    <label for="exampleInputEmail1">Post Seo Name</label>
                    <input type="text" class="form-control" value="{{$seos->post_seo_name}}" name="post_seo_name" placeholder="Enter Post Seo Name">
                    @if ($errors->has('post_seo_name'))
                    <span class="text-danger">{{ $errors->first('post_seo_name') }}</span>
                @endif
                  </div>

                  <div class="form-group col-md-12">
                    <label for="exampleInputEmail1">Post Title</label>
                    <input type="text" class="form-control" value="{{$seos->post_title}}" name="post_title" placeholder="Enter Post Title">
                    @if ($errors->has('post_title'))
                    <span class="text-danger">{{ $errors->first('post_title') }}</span>
                @endif
                  </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


@endsection