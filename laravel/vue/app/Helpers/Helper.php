<?php

namespace App\Helpers;

use DB;
use Twilio\Rest\Client;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class Helper
{
    public static function log_write($method_name, $data)
    {
        try {
   
            if (Storage::exists('attempt1.txt')) {
                Storage::append('attempt1.txt', $method_name);
                Storage::append('attempt1.txt', $data);
            } else {
                Storage::put('attempt1.txt', $method_name);
                Storage::append('attempt1.txt', $data);
            }

        } catch (\Exception $e) {
           dd($e);
        }
    }

    public static function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename)) {
            return false;
        }

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                $data[] = $row;
            }
            fclose($handle);
        }
        return $data;
    }
    public static function image_crop($source, $destination_path)
    {

        $new = imagecreatefromjpeg($source);

        $crop_width = imagesx($new);
        $crop_height = imagesy($new);

        $size = min($crop_width, $crop_height);

        if ($crop_width >= $crop_height) {
            $newx = ($crop_width - $crop_height) / 2;

            $im2 = imagecrop($new, ['x' => $newx, 'y' => 0, 'width' => $size, 'height' => $size]);
        } else {
            $newy = ($crop_height - $crop_width) / 2;

            $im2 = imagecrop($new, ['x' => 0, 'y' => $newy, 'width' => $size, 'height' => $size]);
        }
        if ($image_type == 'jpg' || 'jpeg') {
            imagejpeg($im2, $destination_path, 90);
        } else {
            imagepng($im2);
        }

    }
    public static function writeToCsv($filename = '', $delimiter = ',', $data = array())
    {
        if (!file_exists($filename) || !is_readable($filename)) {
            return false;
        }

        $file = fopen($filename, "w");
        fputcsv($file, $data);
        fclose($file);
    }
    public static function get_field($table, $check_field, $check_value, $return_field)
    {
        //echo $check_value; exit;
        $rtn = '';
        $rtn = DB::table($table)->select($return_field)->where($check_field, $check_value)->first();
        $field = $return_field;
        //print_r($rtn->$field); exit;
        if (!empty($rtn->$field)) {
            return $rtn->$field;
        } else {
            return $rtn;
        }
    }
    public static function get_field_multiple($table, $check_field, $check_value, $return_field)
    {
        //echo $check_value; exit;
        $rtn = '';
        $rtn = DB::table($table)->select($return_field)->where($check_field, $check_value)->get();
        $field = $return_field;
        //print_r($rtn->$field); exit;
        if (!empty($rtn->$field)) {
            return $rtn->$field;
        } else {
            return $rtn;
        }
    }

    public static function pr($array = array()){
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }

    public static function verifyMobileOnly($mobile_no){
        $rtn=[];
        
        $twillio_sid = self::getConfiguration('twillio_sid');
        $twillio_token = self::getConfiguration('twillio_token');
        $twillio_phone = self::getConfiguration('twillio_phone');
        $twillio_client = new Client($twillio_sid, $twillio_token);
        $to=$mobile_no;
        $otp=mt_rand(100000,999999);

        $message = $twillio_client->messages->create(
            $to,
            [
                'from' => $twillio_phone,
                'body' => 'Your OTP is: '.$otp
            ]
        );
        if(!empty($message->sid)){
            $rtn['status']=true;
            $rtn['otp']=$otp;
        } else{
            $rtn['status']=false;
            $rtn['otp']=null;
        }
        return $rtn;
    }

    public static function verifyMobile($user_id,$mobile_no){
        $rtn=[];
        
        $twillio_sid = self::getConfiguration('twillio_sid');
        $twillio_token = self::getConfiguration('twillio_token');
        $twillio_phone = self::getConfiguration('twillio_phone');
        $twillio_client = new Client($twillio_sid, $twillio_token);
        $to=$mobile_no;
        $otp=mt_rand(100000,999999);
        $update=User::where('id',$user_id)->update(['otp'=>$otp,'otp_date'=>date('Y-m-d H:i:s')]);
        //dd($user_id);
        // Use the client to do fun stuff like send text messages!
        $message = $twillio_client->messages->create(
            // the number you'd like to send the message to
            $to,
            [
                // A Twilio phone number you purchased at twilio.com/console
                'from' => $twillio_phone,
                // the body of the text message you'd like to send
                'body' => 'Your OTP is: '.$otp
            ]
        );
        if(!empty($message->sid)){
            $rtn['status']=true;
            $rtn['otp']=$otp;
        } else{
            $rtn['status']=false;
            $rtn['otp']=null;
        }
        return $rtn;
    }

    public static function checkOtp($user_id,$otp){
        $get_user=User::where('id',$user_id)->where('otp',$otp)->first();
        if(!empty($get_user)){
            $d1 = strtotime($get_user->otp_date);
            $d2 = strtotime(date("Y-m-d H:i:s"));
            $totalSecondsDiff = abs($d2-$d1); //42600225
           // dd($totalSecondsDiff);
            $otp_expired_time=self::getConfiguration('otp_expired_time');
            if((int) $totalSecondsDiff>(int) $otp_expired_time){
                $rtn['status']=false;
                $rtn['message']='OTP expired. You enter otp after expired time.';
            } else{
                $rtn['status']=true;
                $rtn['message']='OTP Matched successfully.';
            }

        } else{
            $rtn['status']=false;
            $rtn['message']='OTP not matched. You entered wrong OTP.';
        }
        return $rtn;
    }

    public static function getConfiguration($meta_key=''){
        if(!empty($meta_key)){
            $get_value=DB::table('configurations')->where('meta_key',$meta_key)->first();
            if(!empty($get_value)){
                $rtn=$get_value->meta_value;
            } else{
                $rtn='';
            }
        } else{ // for all meta key value
            $get_value=DB::table('configurations')->where('meta_key',$meta_key)->get();
            if(!empty($get_value)){
                foreach ($get_value as $value) {
                    $rtn[$value->meta_key]=$value->meta_value;
                }
            } else{
                $rtn='';
            }
        }
        return $rtn;
    }

}
