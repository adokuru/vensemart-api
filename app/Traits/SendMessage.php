<?php

namespace App\Traits;
use DB;

trait SendMessage {
    
    
        function send_otp($mobiles,$msg){
        
            //send sms
            $username = "ejikeme.evuolu@gmail.com";
            $password = "Chukwuemeka";
            $sender = "+2347031053693";
           
            $ch = curl_init();
           
            $url = "https://www.bbnplace.com/sms/bulksms/bulksms.php?username=" . $username . "&password=" . $password . "&sender=". $sender ."&message=" . $msg."&mobile=".$mobiles;
            curl_setopt($ch, CURLOPT_URL, $url);
            
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, fasle);
        
            $output = curl_exec($ch);
            
            $result1 =  json_decode($output);
            curl_close($ch);
           // return $result1;
            if($result1 == "1801"){
                return true;
            }else{
                return  false;
            }
    }
    
    
    
}