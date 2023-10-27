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
                <a href="{{route('admin.add_service_category')}}" class="btn btn-primary">Create Category</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th style="width: 9%;">SL No.</th>
                        <th>Name</th>
                        <th>Descriptions</th>
                        <th>Image</th>
                        <th>Created By</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $count =1;?>
                    @foreach($categories as $list)
                      <tr>
                          <td>{{ $count }}</td>
                          <td>{{ ucfirst($list->category_name) }}</td>
                          <td>{{ substr_replace($list->descriptions,'...',25); }}</td>
                          @if(!empty($list->category_image))
                          <td><img src="{{ url('/public/category_images/'.$list->category_image) }}" alt="" height="100px"></td>
                          @else
                          <td> - </td>
                          @endif
                          <td>{{ Helper::get_field('users','id',$list->created_by,'name') }}</td>
                          <td sort-data="{{ strtotime($list->created_at) }}">{{ date('d-m-Y',strtotime($list->created_at)) }}</td>
                        
                          <td>
                            <a href="{{route('admin.edit_service_category',$list->id)}}"><i class="fas fa-edit"></i></a>
                              &nbsp;&nbsp;
                            <a href="javascript:void(0)" class="delete_category" data="{{ $list->id }}"><i class="fas fa-trash"></i></a>
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
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('public/assets/js/view/admin/service_category/common.js') }} "></script>
@endsection