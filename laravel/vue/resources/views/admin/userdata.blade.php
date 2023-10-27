@extends('admin.master')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-12">
        @include('admin.notification')
          <div class="col-sm-6">
            <h1>User Tables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User : {{\App\Models\User::where('role','1')->count()}}</li>
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
                <h3 class="card-title">User Table</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="width: 6%;">SL No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th style="width: 6%;">Gender</th>
                    <th>DOB</th>
                    <th>Points</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $count =1;?>
                    @foreach($users as $user)
                  <tr>
                    <td>{{ $count++ }}</td>
                    <td>{{ucfirst($user->name)}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->mobile}}</td>
                    <td>{{ucfirst($user->gender)}}</td>
                    <td>{!! date('d/M/y', strtotime($user->dob)) !!}</td>
                    <td>{{$user->point}}</td>
                    <td>
                    <div class="card-body">
                    <input type="checkbox" name="toogle" value="{{$user->id}}" {{$user->status=='active' ? 'checked' : ''}} data-toggle="toggle" data-on="active" data-off="inactive" data-onstyle="success" data-offstyle="danger">
                    </div>
                  </td>
                    <td>
                    <a href="{{route('user.edit',$user->id)}}"><i class="fas fa-edit"></i></a>
                        &nbsp;&nbsp;

                        <form action="{{route('user.destroy',$user->id)}}" method="post" style="margin-left: 40%; margin-top: -24%;">
                          @csrf
                        <a href="" data-toggle="tooltip" title="delete" data-id="{{$user->id}}" class="dltBtn" style="color:red;" data-placement="botton" ><i class="fas fa-trash-alt"></i></a>
                        </form>

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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
 $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$('.dltBtn').click(function(e){
    var form=$(this).closest('form');
    var dataID=$(this).data('id');
    e.preventDefault();

      swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover this imaginary file!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          form.submit();
          swal("Poof! Your imaginary file has been deleted!", {
            icon: "success",
          });
        } else {
          swal("Your imaginary file is safe!");
        }
      });
});
</script>
@endsection