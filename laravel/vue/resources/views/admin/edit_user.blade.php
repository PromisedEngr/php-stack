@extends('admin.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Validation</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Validation</li>
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
                <h3 class="card-title">Quick Example <small>jQuery Validation</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('user.update',$user->id)}}" method="POST">
                  @csrf
                <div class="card-body">
                  <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="test" class="form-control" name="name" value="{{$user->name}}">
                    @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                   @endif
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Email</label>
                    <input type="email" name="email" class="form-control" value="{{$user->email}}">
                    @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Mobile</label>
                    <input type="number" name="mobile" class="form-control" value="{{$user->mobile}}">
                    @if ($errors->has('mobile'))
                    <span class="text-danger">{{ $errors->first('mobile') }}</span>
                @endif
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Address</label>
                    <textarea name="address" class="form-control" id="" cols="10" rows="5">{{$user->address}}</textarea>
                    @if ($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
                  </div>
                  <div class="form-group col-md-2">
                    <label for="exampleInputPassword1">Gender</label>
                    <select id="inputState" name="gender" value="{{old('gender')}}" class="form-control">
                    <option>--Select Gender--</option>
                    <option value="male" {{$user->gender=='male' ? 'selected' : ''}}>Male</option>
                    <option value="female" {{$user->gender=='female' ? 'selected' : ''}}>Female</option>
                </select>
                @if ($errors->has('gender'))
                    <span class="text-danger">{{ $errors->first('gender') }}</span>
                @endif
                  </div>
                  <div class="form-group col-md-4">
                    <label for="exampleInputPassword1">DOB</label>
                    <input type="date" name="dob" class="form-control" value="{{$user->dob}}">
                    @if ($errors->has('dob'))
                    <span class="text-danger">{{ $errors->first('dob') }}</span>
                @endif
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Point</label>
                    <input type="number" name="point" class="form-control" value="{{$user->point}}">
                    @if ($errors->has('point'))
                    <span class="text-danger">{{ $errors->first('point') }}</span>
                @endif
                  </div>
                  <!-- <div class="form-group col-md-6">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" value="{{$user->password}}">
                  </div> -->
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
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