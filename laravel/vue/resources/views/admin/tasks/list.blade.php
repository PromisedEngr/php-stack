@extends('admin.master')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-12">
        @include('admin.notification')
          <div class="col-sm-6">
            <h1>Tasks</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tasks : </li>
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
                <a href="{{route('admin.add_task')}}" class="btn btn-primary">Create Task</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 6%;">SL No.</th>
                            <th>Task</th>
                            <th>Created By</th>
                            <th>Amount</th>
                            <th>Accepted</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $count =1; @endphp
                        @foreach($tasks as $list)
                            <tr>
                                <td>{{ $count++ }}</td>
                                <td>{{ucfirst($list->task_name)}}</td>
                                <td>{{ $list->createUser->name }}</td>
                                <td>{{ $list->amount }}</td>
                                <td>{{ $list->acceptUser->name }}</td>
                                <td>
                                    <a href="{{route('admin.get_task_details',$list->id)}}"><i class="fas fa-eye"></i></a>
                                    &nbsp;&nbsp;
                                    <a href="{{route('admin.edit_task',$list->id)}}"><i class="fas fa-edit"></i></a>
                                    &nbsp;&nbsp;
                                    <a href="{{route('admin.delete_task',$list->id)}}"><i class="fas fa-trash"></i></a>
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