<?php 
class Robot{
   
    static $errorEmail = "javier235hj@hotmail.com";
 
    static function getIpClient(){
 
         $ip = null;
     
         if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
             $ip = $_SERVER['HTTP_CLIENT_IP'];
         } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
             $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
         } else {
             $ip = $_SERVER['REMOTE_ADDR'];
         }
     
         return $ip;
     }
 
 
     static function getTime(){
 
         date_default_timezone_set('Europe/Madrid');
 
         $day = date('d');
         $month = date('m');
         $year = date('Y');
         $hour = date('H');
         $minute = date('i');
         $second = date('s');
 
         $dateCompleteNoHour = $day . '/' . $month . "/" . $year;
         $dateCompleteHour = $dateCompleteNoHour . "\n $hour:$minute:$second";
 
         $result = ["day" => $day, "month" => $month, "year" => $year, "hour" => $hour, "minute" => $minute, "second" => $second,
         "dateCompleteNoHour" => $dateCompleteNoHour, "dateCompleteHour" => $dateCompleteHour];
 
         return $result;
     }
 
 
 
     
 }

 echo Robot::$errorEmail;