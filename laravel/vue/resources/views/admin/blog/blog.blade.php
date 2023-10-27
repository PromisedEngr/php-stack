@extends('admin.master')
@section('content')
<style>
    .req_red{
        color:red;
    }
    .title_desc {
        padding: 0 20px;
    }
    img.blog_img {
        max-width: -webkit-fill-available;
        padding: 30px;
    }
    .switch {
        position: relative;
        display: inline-block;
        width: 48px;
        height: 20px;
    }
    
    .switch input { 
        opacity: 0;
        width: 0;
        height: 0;
    }
    
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }
    
    .slider:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 20px;
        left: 1px;
        bottom: 1px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }
    
    input:checked + .slider {
        background-color: #27cb13;
    }
    
    input:focus + .slider {
        box-shadow: 0 0 1px #27cb13;
    }
    
    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }
    
    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }
    
    .slider.round:before {
        border-radius: 50%;
    }
</style>

<div class="content-wrapper">
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
                            <h3 class="card-title">Blog Table</h3>
                            <div class="blog_add_btn"><a href="javascript:void(0)" class="btn btn-primary float-right" data-toggle="modal" data-target=".bd-example-modal-lg">Add Blog</a></div>
                        </div>
                        <div class="card-body">
                            <table id="blog_table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 49px;">SL No.</th>
                                        <th>Blog Title</th>
                                        <th>Added Date</th>
                                        <th>Blog Description</th>
                                        <th>Blog Image</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                        <?php $count=1; ?>
                                        @foreach($blog_list as $blog_lists )
                                        <tr>
                                            <td>{{ $count++ }}</td>
                                            <td>{{ (strlen($blog_lists->blog_title) > 30) ? substr($blog_lists->blog_title,0,30).'...' : $blog_lists->blog_title;}}</td>
                                            <td>{{date('d-m-Y', strtotime($blog_lists->created_at))}}</td>
                                            <td>{{ (strlen($blog_lists->blog_details) > 30) ? substr(strip_tags($blog_lists->blog_details),0,30).'...' : strip_tags($blog_lists->blog_details);}}</td>
                                            <td><img src="{{ asset('public/blog_file').'/'.$blog_lists->blog_file }}" alt="" height="50px" width="100px"></td>
                                            @if($blog_lists->status == 'active')
                                                <td>
                                                    <label class="switch">
                                                    <input type="checkbox" class="status_change" data="{{ $blog_lists->id }}" checked>
                                                    <span class="slider round" title="Active" ></span>
                                                    </label>
                                                </td>
                                                @else
                                                <td>
                                                    <label class="switch">
                                                    <input type="checkbox" class="status_change" data="{{ $blog_lists->id }}">
                                                    <span class="slider round" title="Inactive"></span>
                                                    </label>
                                                </td>
                                            @endif
                                            
                                            <td>
                                                <a href="javascript:void(0)" class="single_blog_view" data-blog_view="{{ $blog_lists->id }}" data-toggle="modal" data-target=".bd-example-modal-lg-blog" ><i class="fas fa-eye"></i></a>&nbsp;&nbsp;
                                                <a href="javascript:void(0)" class="blog_edit" data-blog_edit="{{ $blog_lists->id }}" data-toggle="modal" data-target=".bd-example-modal-lg-editblog"><i class="fas fa-edit"></i></a>
                                                &nbsp;&nbsp;   
                                                <a href="javascript:void(0)" class="delete_blog" data="{{ $blog_lists->id }}"><i class="fas fa-trash"></i></a>
                                                &nbsp;&nbsp;
                                            </td>
                                        </tr>
                                        @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Add Blog -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Blog</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="javascript:void(0)" method="post" name="addblog" id="addblog">
            <div class="modal-body">
                
                <div class="form-group">
                    <label class="col-form-label">Blog Title <b class="req_red">*</b></label>
                    <input type="text" class="form-control" id="blog_title" name="blog_title">
                </div>
                <div class="form-group">
                    <label class="col-form-label">Blog Description <b class="req_red">*</b></label>
                    <textarea class="form-control" id="blog_details" name="blog_details"></textarea>
                </div>
                <div class="form-group">
                    <label for="formFileLg" class="form-label">Upload your file <b class="req_red">*</b></label>
                    <input class="form-control form-control-lg" id="blog_file" name="blog_file" type="file" accept="image/*" />
                    <div class="text-center" id="set_image"></div>
                </div>
                
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-primary submit_btn">Submit</button>
            </div>
        </form>
        <p class="text-center fl-success" id="successaddblog" style="display:none;"></p>  
        <p class="text-center fl-success" id="erroraddblog" style="display:none;"></p> 
    </div>
  </div>
</div>

<!-- View Blog -->
<div class="modal fade bd-example-modal-lg-blog" tabindex="-1" role="dialog" aria-labelledby="blog_view" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabelview">View Blog</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <diV id="singleBlogView">

        </div>
    </div>
  </div>
</div>
<!-- Edit Blog -->
<div class="modal fade bd-example-modal-lg-editblog" tabindex="-1" role="dialog" aria-labelledby="editblog_view" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabelview">Edit Blog</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="javascript:void(0)" method="post" name="edit_blogs" id="edit_blogs">
            <div class="modal-body">
                
                <div class="form-group">
                    <label class="col-form-label">Blog Title <b class="req_red">*</b></label>
                    <input type="text" class="form-control" id="edit_blog_title" name="blog_title">
                </div>
                <div class="form-group">
                    <label class="col-form-label">Blog Description <b class="req_red">*</b></label>
                    <textarea class="form-control" id="edit_blog_details" name="edit_blog_details"></textarea>
                </div>
                <div class="form-group">
                    <label for="formFileLg" class="form-label">Upload your file <b class="req_red">*</b></label>
                    <input class="form-control form-control-lg" id="edit_blog_file" name="blog_file" type="file" accept="image/*" />
                    <div class="text-center" id="edit_set_image"></div>
                </div>
                <input type="hidden" id="blog_id" name="blog_id" value="">
                
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-primary submit_btn">Submit</button>
            </div>
        </form>
        <p class="text-center fl-success" id="successeditblog" style="display:none;"></p>  
        <p class="text-center fl-success" id="erroreditblog" style="display:none;"></p> 
    </div>
  </div>
</div>


<script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
<script>   
    CKEDITOR.replace( 'blog_details', {
        toolbar: [
            { name: 'basicstyles', items : [ 'Bold','Italic' ] },
            { name: 'document', items : [ 'Source','-','Save' ] },
            { name: 'paragraph', items : [ 'NumberedList','BulletedList' ] },
        ]
    });

    
    CKEDITOR.config.allowedContent = true;
</script>
<script type="text/javascript" src="{{ asset('public/assets/js/view/admin/blog.js') }} "></script>

@endsection