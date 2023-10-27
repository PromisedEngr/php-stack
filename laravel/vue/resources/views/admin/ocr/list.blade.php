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
                    <!-- card start -->
                    <div class="card"> 
                        <div class="card-header card-header-form">
                            OCR Settings
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if(session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            {{ Form::open(array('url' => '#','method'=>'POST','name'=>'ocr_setting_submit_form')) }}
                            <div class="form-group">
                                <label for="ocr_word">Word <span class="is-required">*</span></label>
                                {{ Form::text('ocr_word',Helper::getConfiguration('ocr_word'),['class'=>'form-control','id'=>'ocr_word','placeholder'=>'Enter word','aria-describedby'=>'ocr_wordHelp']) }}
                                <small id="ocr_wordHelp" class="form-text text-muted">This field value maching with OCR. For multiple word please use comma separated value, Like amount,price.</small>
                            </div>
                           
                            <button type="submit" class="btn btn-sm btn-success submit">Add</button>
            
                            {{ Form::close() }}
                            <p id="ocr_msg"></p>
                        </div>
                        <!-- /.card-body -->
                    </div>  
                    <!-- card start end-->

                    <!-- card start -->
                    <div class="card"> 
                        <div class="card-header card-header-form">
                            Added word list
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if(!empty($ocr_settings))
                                <ul class="ocr_word_list">
                                    @foreach($ocr_settings as $list)
                                        <li>
                                            <span>{{ $list->ocr_word }}</span>
                                            <a href="javascript:void(0)" data-id="{{ $list->id }}" class="delete_word text-danger"><i class="fas fa-trash"></i></a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>  
                    <!-- card start end-->
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('public/assets/js/view/admin/ocr.js') }} "></script>
@endsection