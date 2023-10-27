<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <link rel="shortcut icon" href="{{asset('public/assets/images/faviconmook.png')}}">
    
        <title>Mook Market Place</title>

        <!-- Bootstrap CSS -->
        <link href="{{URL::asset('public/assets/css/new_customer_style/css/bootstrap.min.css')}}" rel="stylesheet">

        <!-- Style -->
        <link rel="stylesheet" href="{{URL::asset('public/assets/css/new_customer_style/css/style.css')}}">

        <!-- Responsive -->
        <link rel="stylesheet" href="{{URL::asset('public/assets/css/new_customer_style/css/responsive.css')}}">
        <link rel="stylesheet" href="{{URL::asset('public/front/css/jquery.dataTables.min.css')}}"/>
    
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
        <script type="text/javascript" src="{{ asset('public/assets/js/jquery.js')}}"></script>
        <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/jquery-ui.css') }} " />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
        <meta name="_token" content="{{ csrf_token() }}" />
        <script type="text/javascript">
            var SITE_URL         = "<?php echo config('constants.SITE_URL');?>";
             $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                    }
                });
            });

        </script>
        <style type="text/css">
            i.msg.msg-error.error {
                color: red;
            }
            .req{
                color: #f01d1d;
            }
            
        </style>
</head>
<body>

    @include('vendar.layouts.header')
        @yield('content')
    @include('vendar.layouts.footer')



        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
        <script src="{{URL::asset('public/assets/js/new_customer_js/popper.min.js')}}"></script>
        <script src="{{URL::asset('public/assets/js/new_customer_js/main.js')}}"></script>
        <script src="{{URL::asset('public/assets/js/new_customer_js/bootstrap.min.js')}}"></script>
        <script src="{{URL::asset('public/assets/js/new_customer_js/jquery.sticky.js')}}"></script>
        <script src="{{URL::asset('public/assets/js/new_customer_js/slick.min.js')}}"></script>
        <script src="{{asset('public/assets/js/common.js')}}"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script src="{{URL::asset('public/front/js/jquery.dataTables.min.js')}}"></script>
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
        <script src="{{URL::asset('public/front/js/jquery-ui.js')}}"></script>
        <script src="{{asset('public/assets/js/common.js')}}"></script>
        <script src="{{URL::asset('public/front/js/select2.min.js')}}"></script>
        <script src="{{URL::asset('public/front/js/sweetalert2.js')}}"></script>
    
   <script>
    $(document).ready(function(){
        $("#customer_image").click(function(){
            $("#showHide_toggle").toggle();
        });
    });
    </script>
    

</body>

</html>