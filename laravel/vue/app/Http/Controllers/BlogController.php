<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Blog;
use URL;
use Session;
use Helper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function blog(){
        $data['page_title']='Blog';
        $data['blog_list'] = Blog::get();
        
        return view('admin.blog.blog',$data);
       
    }

    public function addblogsubmit(Request $request){
       //Helper::pr($request->all()); die;
       $data = $request->all();
       $validator = Validator::make($request->all(), [
        'blog_title'=>'required',
        'blog_details'=>'required|string',
        ]);
        if($validator->fails()){
            $status['success'] = false;
            $status['message'] =  $validator->errors();
           
        }
        // To be checked dublicate 
        // To be checked dublicate
        $insert_data['blog_title']= $data['blog_title'];
        $insert_data['blog_slug']= strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $data['blog_title']))) ;
        $insert_data['blog_details']= $data['blog_details'];
        $insert_data['created_at']= date('Y-m-d H:i:s');

        $fileName='';
        if(!empty($request->blog_file)){
            $fileName = time().'.'.$request->blog_file->extension();
            $file_error=$request->blog_file->move(public_path('blog_file'), $fileName);
            $insert_data['blog_file']=$fileName;
        }
        $result = Blog::insert($insert_data);
        if(!empty($result)){
            $status['status'] = true;
            $status['message'] = "You have successfully added blog"; 
            return \Response::json($status);

        }else {
            $status['status'] = false;
            $status['message'] = "Something went wrong"; 
            return \Response::json($status);

        }
       

    }

    public function singleblogsView(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($request->all(), [
           'singleBlogId'=>'required',
        ]);
        if($validator->fails()){
            $status['success'] = false;
            $status['message'] =  $validator->errors();
           
        }

        $fetch_blog = Blog::where('id','=',$data['singleBlogId'] )->first();
        if(!empty($fetch_blog)){
            $status['status'] = true;
            $status['fetched_blog'] = $fetch_blog;
            $status['message'] = "Successfully fetched blog"; 
            return \Response::json($status);

        }else {
            $status['status'] = false;
            $status['message'] = "Something went wrong"; 
            return \Response::json($status);

        }

    }

    public function editblogsubmit(Request $request){
      // Helper::pr($request->all()); die;

       $data = $request->all();
       $validator = Validator::make($request->all(), [
        'blog_title'=>'required',
        'edit_blog_details'=>'required|string',
        ]);
        if($validator->fails()){
            $status['success'] = false;
            $status['message'] =  $validator->errors();
        }

        $insert_data['blog_title']= $data['blog_title'];
        $insert_data['blog_slug']= strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $data['blog_title']))) ;
        $insert_data['blog_details']= $data['edit_blog_details'];
        $insert_data['updated_at']= date('Y-m-d H:i:s');
        $fileName='';
        if(!empty($request->blog_file)){
            $fileName = time().'.'.$request->blog_file->extension();
            $file_error=$request->blog_file->move(public_path('blog_file'), $fileName);
            $insert_data['blog_file']=$fileName;
        }

        $update_result = Blog::where("id", $data['blog_id'])->update($insert_data);

        if(!empty($update_result)){
            $status['status'] = true;
            $status['message'] = "You have successfully edited blog"; 
            return \Response::json($status);

        }else {
            $status['status'] = false;
            $status['message'] = "Something went wrong"; 
            return \Response::json($status);

        }
    }

    public function blogStatusUpdate(Request $request){
        //dd($request->all()); exit;
        $update=Blog::where('id',$request->singleBlogsId)->update(array('status'=>$request->status));
        if($update){
            $status['status'] = true;
            $status['html'] = 'Status successfully updated.';
            return \Response::json($status);
        } else{
            $status['status'] = false;
            $status['html'] = 'Please try again later.';
            return \Response::json($status);
        }
        
    }
    
}
