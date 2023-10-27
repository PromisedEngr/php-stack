<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{asset('public/assets/images/faviconmook.png')}}">

    <!-- slick CSS -->
    <link href="{{URL::asset('public/front/css/slick-theme.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('public/front/css/slick.min.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{URL::asset('public/front/fonts/icomoon/style.css')}}">

    <link rel="stylesheet" href="{{URL::asset('public/front/css/animate.css')}}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{URL::asset('public/front/css/bootstrap.min.css')}}">

    <!-- Style -->
    <link rel="stylesheet" href="{{URL::asset('public/front/css/style.css')}}">

    <!-- Responsive -->
    <link rel="stylesheet" href="{{URL::asset('public/front/css/responsive.css')}}">

    <title>Mook Market Place</title>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="{{URL::asset('public/front/css/select2.min.css')}}"/>

    <script type="text/javascript" src="{{ asset('public/assets/js/jquery.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/jquery-ui.css') }} " />
    <script type="text/javascript" src="<?php echo asset('public/assets/js/jquery-ui.js')?>"></script>
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
@include('frontend.layout.header')

@yield('content')

@include('frontend.layout.footer')

    <!-- <script src="{{URL::asset('public/front/js/jquery-3.3.1.min.js')}}"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script src="{{URL::asset('public/front/js/popper.min.js')}}"></script>
    <script src="{{URL::asset('public/front/js/bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('public/front/js/jquery.sticky.js')}}"></script>
    <script src="{{URL::asset('public/front/js/wow.js')}}"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="{{URL::asset('public/front/js/slick.min.js')}}"></script>
    <script src="{{URL::asset('public/front/js/main.js')}}"></script>
    <script src="{{asset('public/assets/js/common.js')}}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="{{URL::asset('public/front/js/select2.min.js')}}"></script>
    <script src="{{URL::asset('public/assets/js/jquery.countdown360.min.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
   


    <script>
        new WOW().init();

    </script>
</body>

</html>
