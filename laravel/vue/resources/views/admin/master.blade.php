<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MOOKS | </title>
<link rel="shortcut icon" href="{{asset('public/assets/images/faviconmook.png')}}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{URL::asset('public/admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{URL::asset('public/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{URL::asset('public/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{URL::asset('public/admin/dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{URL::asset('public/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{URL::asset('public/admin/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{URL::asset('public/admin/plugins/summernote/summernote-bs4.min.css')}}">
  <link rel="stylesheet" href="{{URL::asset('public/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{URL::asset('public/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{URL::asset('public/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{URL::asset('public/admin/plugins/daterangepicker/daterangepicker.css')}}">
  <link rel="stylesheet" href="{{URL::asset('public/admin/dist/css/custom.css')}}">
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
  <!-- jQuery -->

<script src="{{URL::asset('public/admin/plugins/jquery/jquery.min.js')}}"></script>

<!-- jQuery UI 1.11.4 -->
<script src="{{URL::asset('public/admin/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<meta name="_token" content="{{ csrf_token() }}" />
<script>
  var SITE_URL         = "<?php echo config('constants.SITE_URL');?>";
  var _token         = "{{ csrf_token() }}";
    $(function() {
      $.ajaxSetup({
          headers: {
              'X-CSRF-Token': $('meta[name="_token"]').attr('content')
          }
      });
  });
</script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Navbar -->
@include('admin.layout.header')
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
@include('admin.layout.sidebar')
  <!-- Content Wrapper. Contains page content -->
@yield('content')
  <!-- /.content-wrapper -->
 <!-- @include('admin.layout.footer') -->
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

<!-- Bootstrap 4 -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script src="{{URL::asset('public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{URL::asset('public/admin/plugins/moment/moment.min.js')}}"></script>
<script src="{{URL::asset('public/admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{URL::asset('public/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{URL::asset('public/admin/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{URL::asset('public/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{URL::asset('public/admin/dist/js/adminlte.js')}}"></script>
<script src="{{URL::asset('public/admin/dist/js/pages/dashboard.js')}}"></script>
<script src="{{URL::asset('public/admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('public/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('public/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('public/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('public/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('public/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('public/admin/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{URL::asset('public/admin/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('public/admin/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('public/admin/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('public/admin/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('public/admin/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script src="{{URL::asset('public/admin/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{URL::asset('public/admin/plugins/jquery-validation/additional-methods.min.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{URL::asset('public/admin/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
<!-- InputMask -->
<script src="{{URL::asset('public/admin/plugins/moment/moment.min.js')}}"></script>
<script src="{{URL::asset('public/admin/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
<!-- date-range-picker -->
<script src="{{URL::asset('public/admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- added by Rana Ghosh 16-02-2022 -->
<script src="{{URL::asset('public/front/js/sweetalert2.js')}}"></script>
<script type="text/javascript" src="{{ asset('public/assets/js/common.js') }} "></script>

@yield('scripts')
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    $("#blog_table").DataTable();


  });
</script>


<script>
  $('input[name=toogle]').change(function(){
    var mode=$(this).prop('checked');
    var id=$(this).val();
    // alert(id);
    $.ajax({
      url:"{{route('user.status')}}",
      type:"POST",
      data:{
        _token:'{{csrf_token()}}',
        mode:mode,
        id:id,
      },
      success:function(response){
        console.log(response.status)
        if(response.status){
          alert(response.msg)
        }else{
          alert('Please try again later');
        }
      }
    })
  });


  $('input[name=toogle1]').change(function(){
    var mode=$(this).prop('checked');
    var id=$(this).val();
    // alert(id);
    $.ajax({
      url:"{{route('voucher.status')}}",
      type:"POST",
      data:{
        _token:'{{csrf_token()}}',
        mode:mode,
        id:id,
      },
      success:function(response){
        console.log(response.status)
        if(response.status){
          alert(response.msg)
        }else{
          alert('Please try again later');
        }
      }
    })
  });


  $('input[name=toogle2]').change(function(){
    var mode=$(this).prop('checked');
    var id=$(this).val();
    // alert(id);
    $.ajax({
      url:"{{route('vendor.status')}}",
      type:"POST",
      data:{
        _token:'{{csrf_token()}}',
        mode:mode,
        id:id,
      },
      success:function(response){
        console.log(response.status)
        if(response.status){
          alert(response.msg)
        }else{
          alert('Please try again later');
        }
      }
    })
  });
  
</script>

<!-- <script>
 
</script> -->

<script>
$(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      alert( "Form successful submitted!" );
    }
  });
  $('#quickForm').validate({
    rules: {
      email: {
        required: true,
        email: true,
      },
      password: {
        required: true,
        minlength: 5
      },
      terms: {
        required: false
      },
    },
    messages: {
      email: {
        required: "Please enter a email address",
        email: "Please enter a valid email address"
      },
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      terms: "Please accept our terms"
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>

<script>
  setTimeout(function(){
    $('#alert').slideUp();
  },4000);
</script>

</body>

</html>

