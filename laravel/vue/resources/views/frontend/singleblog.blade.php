@extends('frontend.master')
@section('content')

<script type="text/javascript">
    var BLOGDETAILS = {!! json_encode($blog_details) !!};
</script>

<div class="inner-sec-bg service-sec">
    <div class="container">
        <div class="row">
            <div class="sblog_view">
                <div class="sblog_image">
                    <img src="{{$blog_file}}" alt="{{$blog_title}}" class="blog_img">
                </div>
                <div class="title_desc">
                    <h2 class="page-title mb-40">{{$blog_title}}</h2>
                    <div class="blog_details_single" id="blog_details"></div>
                    <div class="blog_date">{{$created_at}}</div>
                </div>
            </div>

        </div>
    </div>
</div>




<script type="text/javascript">
    $(document).ready(function () {
        $('#blog_details').html(BLOGDETAILS)
    });
</script>
@endsection