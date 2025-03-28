<?php

use App\Models\User;
use Carbon\Carbon;
function prx($arr)
{
    echo "<pre>";
    print_r($arr);
    die();
}


function checkedTokenExoiryInMinutes($time , $timeDiffer =60){
 $data = Carbon::parse($time->formate('Y-m-d h:i:s a'));
 $now = Carbon::now();
 $diff = $data->diffInMinute($now);
 if($diff >$timeDiffer){
 return true;
 }else{
    return false;
 }
}

function generateRandomString($lenght=20){
$ch ='123456789aabcdefghijklmnopqrtsuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$len = strlen($ch);
$str ='';
for($i=0 ; $i < $length; $i++){
  $str.=$ch[randam_int(0,$len - 1)];
}
return $str;
}
