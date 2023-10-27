<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Common extends Model
{
    use HasFactory;

    public static function fetchOptionDropDown($param = array()){
        
        //$conditions = array('flag' => 0);
        if(!empty($param['wherefld'])){
            $conditions[$param['wherefld']] = $param['whereval'];
            $result = DB::table($param['table'])->select('id',$param['field'].' as name')->where($conditions)->orderBy($param['table'].'.id','ASC')->get();
        } else{
            $result = DB::table($param['table'])->select('id',$param['field'].' as name')->orderBy($param['table'].'.id','ASC')->get();
        }
        
        return $result; 
    }
}
