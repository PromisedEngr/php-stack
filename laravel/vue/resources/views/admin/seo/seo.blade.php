@extends('admin.master')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-12">
        @include('admin.notification')
          <div class="col-sm-6">
            <h1>Seo Tables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Seo : </li>
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
                <a href="{{route('admin.create.seo')}}" class="btn btn-primary">Create Seo</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="width: 6%;">SL No.</th>
                    <th>Meta Title</th>
                    <th>Meta Keyword</th>
                    <th>Post SEO Name</th>
                    <th>Post Title</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $count =1;?>
                   @foreach($seos as $seo)
                  <tr>
                    <td>{{ $count++ }}</td>
                    <td>{{ucfirst($seo->meta_title)}}</td>
                    <td>{{ucfirst($seo->meta_keywords)}}</td>
                    <td>{{ucfirst($seo->post_seo_name)}}</td>
                    <td>{{ucfirst($seo->post_title)}}</td>
                    <td>
                    <a href="{{route('seo.edit',$seo->id)}}"><i class="fas fa-edit"></i></a>
                        &nbsp;&nbsp;
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

@section('scripts')

@endsection