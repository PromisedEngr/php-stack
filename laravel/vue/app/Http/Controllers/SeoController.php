<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Seo;

class SeoController extends Controller
{
    public function seos(){
        $seos = Seo::orderBy('created_at', 'DESC')->get();
        return view('admin.seo.seo',compact('seos'));
    }

    public function create_seo(){
        return view('admin.seo.create_seo');
    }

    public function store_seo(Request $request){

        $this->validate($request,[
            'meta_title'=>'required|string',
            'meta_keywords'=>'required|string',
            'post_seo_name'=>'required|string',
            'post_title'=>'required|string',
        ]);

        $data = $request->all();
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        // die();
        $status = Seo::create($data);
        if($status){
            return redirect()->route('admin.seos')->with('success','Successfully Created Seo');
        }else{
            return back()->with('error','Somthing went wrong');
        }
    }

    public function seoEdit($id){
        $seos = Seo::find($id);
        if($seos){
            return view('admin.seo.edit_seo',compact('seos'));
        }else{
            return back()->with('error','Data Not Found');
        }
    }


    public function updateSeo(Request $request,$id){ 

        $seo = Seo::find($id);
        $seo->meta_title = $request->meta_title;
        $seo->meta_keywords = $request->meta_keywords;
        $seo->post_seo_name = $request->post_seo_name;
        $seo->post_title = $request->post_title;
        // $seo->gender = $request->gender;
        // $seo->dob = $request->dob;
        // $seo->point = $request->point;
        if( $seo->save()){

            return redirect()->route('admin.seos')->with('sucess','updated');

        }else{

            return redirect()->route('seo.edit')->with('error',' not updated');
        }
               
    }
    
}
