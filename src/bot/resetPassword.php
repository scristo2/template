<?php 
ob_start();
error_reporting(0);
ignore_user_abort(1);
require $_SERVER['DOCUMENT_ROOT'] . "/src/bot/Bot.php";
use robot\Robot;

try{

    if(isset($_POST['emailReset'])){


        if(!is_dir($_SERVER['DOCUMENT_ROOT'] . "/src/users/resetPassword")){

             if(!mkdir($_SERVER['DOCUMENT_ROOT'] . "/src/users/resetPassword", 0777, true)){

                 throw new Exception("An ocurred an error.Try again!");
             }
        }


       $conn = new mysqli(Robot::$hostname, Robot::$usernameHostname, Robot::$passwordHostname, Robot::$databaseName);

       if($conn->connect_error){

          throw new Exception("An ocurred an error.Try again!");
       
      }else{


            $sql = "CREATE TABLE IF NOT EXISTS `resetPassword` (`id` INT(9) NOT NULL AUTO_INCREMENT, `email` VARCHAR(65) NOT NULL, `date` VARCHAR(65) NOT NULL, `dateTime`
            VARCHAR(65) NOT NULL , `temporalPassword` VARCHAR(65) NOT NULL,PRIMARY KEY (`id`))";

            $query = $conn->query($sql);

            if(!$query){

                 throw new Exception("An ocurred an error.Try again!");


            }else{


                 $sql = "SELECT * FROM `register` WHERE `email`='".$_POST['emailReset']."'";


                 $query = $conn->query($sql);


                 if(!$query){

                    throw new Exception("An ocurred an error.try again!");
                 
                 }else{

                       if($query->num_rows < 1){

                            throw new Exception("An ocurred an error.Try again!");
                       
                       }else{

                           while($row = $query->fetch_assoc()){

                               $getUsernameForEmailReset = $row['username'];
                           }
                       }
                 }

                  

                  $sql = "SELECT * FROM `resetPassword` WHERE `email`='".$_POST['emailReset']."'";


                  $query = $conn->query($sql);


                  if(!$query){

                      throw new Exception("An ocurred an error.Try again!");
                  
                  }else{

                       if($query->num_rows > 0){

                            
                            while($row = $query->fetch_assoc()){

                                 $arrayDateResetPassword = explode("/", $row['date']);

                                 $arrayDateTimeresetPassword = explode(":", $row['dateTime']);

                                 
                            }


                            $dayResetPassword = null;
                            $monthResetPassword = null;
                            $yearResetPassword = $arrayDateResetPassword[2];

                            $hourResetPassword = null;
                            $minuteResetPassword = null;
                            $secondResetPassword = null;


                            $currentlyDay = Robot::getTime()['day'];
                            $currentlyMonth = Robot::getTime()['month'];
                            $currentlyYear = Robot::getTime()['year'];
                            $currentlyHour = Robot::getTime()['hour'];
                            $currentlyMinute = Robot::getTime()['minute'];
                            $currentlySecond =Robot::getTime()['second'];
                            
                            

                            if(preg_match("/^0/", $arrayDateResetPassword[0])){

                                 $dayResetPassword = $arrayDateResetPassword[0][1];
                                 
                            }else{

                                $dayResetPassword = $arrayDateResetPassword[0];
                            }


                            if(preg_match("/^0/", $arrayDateResetPassword[1])){

                                 $monthResetPassword = $arrayDateResetPassword[1][1];

                            }else{

                                 $monthResetPassword = $arrayDateResetPassword[1];       
                            }


                            if(preg_match("/^0/", $arrayDateTimeresetPassword[0])){

                                $hourResetPassword = $arrayDateTimeresetPassword[0][1];
                            
                            }else{

                                $hourResetPassword = $arrayDateTimeresetPassword[0];
                            }


                            if(preg_match("/^0/", $arrayDateTimeresetPassword[1])){

                                $minuteResetPassword = $arrayDateTimeresetPassword[1][1];
                            
                            }else{

                                $minuteResetPassword = $arrayDateTimeresetPassword[1];
                            }


                            if(preg_match("/^0/", $arrayDateTimeresetPassword[2])){

                                $secondResetPassword = $arrayDateTimeresetPassword[2][1];

                            
                            }else{

                                $secondResetPassword = $arrayDateTimeresetPassword[2];
                            }



                            if(preg_match("/^0/", $currentlyDay)){

                                $currentlyDay = $currentlyDay[1];
                            }

                            if(preg_match("/^0/", $currentlyMonth)){

                                $currentlyMonth = $currentlyMonth[1];
                            }

                            if(preg_match("/^0/", $currentlyHour)){

                                $currentlyHour = $currentlyHour[1];
                            }


                            if(preg_match("/^0/", $currentlyMinute)){

                                $currentlyMinute = $currentlyMinute[1];
                            }

                            if(preg_match("/^0/", $currentlySecond)){

                                $currentlySecond = $currentlySecond[1];
                            }


                            $oneDayInSeconds = (24 * 60 * 60);
    
                            $oneYearInSeconds = 365 * 24 * 60 * 60;

                            $oneMonthInSeconds = $oneYearInSeconds / 12;

                            $oneHourInSeconds = 1 * 60 * 60;

                            $oneMinInSeconds = 1 * 60;
                           


                            $daysConsumedResetPassword = null;
                            $daysConsumedCurrentlyDays = null;
                            

                            for ($i=0; $i < $monthResetPassword ; $i++) {
                                
                                if($i == 0){

                                    continue;
                                }
                               
                                $daysConsumedResetPassword += Robot::getTime()['calendar'][$i];
                            }


                            for ($i=0; $i < $currentlyMonth ; $i++) { 

                                if($i == 0){

                                    continue;
                                }
                                
                                $daysConsumedCurrentlyDays += Robot::getTime()['calendar'][$i];

                                
                            }


                            $totalDaysConsumedReset = $daysConsumedResetPassword + $dayResetPassword;
                            $totalDaysConsumedCurrentlyDays = $daysConsumedCurrentlyDays + $currentlyDay;


                            $totalDaysConsumedResetToSeconds = $totalDaysConsumedReset * $oneDayInSeconds;
                            $totalDaysConsumedCurrentlyDaysToSecond = $totalDaysConsumedCurrentlyDays * $oneDayInSeconds;


                            //convert time reset for seconds and after i have to plus to days second consumed year

                            $hourResetPasswordToSeconds = $hourResetPassword * $oneHourInSeconds;
                            $minutesResetPasswordToSeconds = $minuteResetPassword * $oneMinInSeconds;

                            //convert currently time for seconds and after i have to plus to days second consumed year
                            $hourCurrentlyPasswordToSeconds = $currentlyHour * $oneHourInSeconds;
                            $minutesCurrentlyPasswordToSeconds = $currentlyMinute * $oneMinInSeconds;


                            $totalAddedConsumedSecondsReset = $totalDaysConsumedResetToSeconds + $hourResetPasswordToSeconds + $minutesResetPasswordToSeconds + $secondResetPassword;
                            $totalAddedConsumedSecondsCurrently = $totalDaysConsumedCurrentlyDaysToSecond + $hourCurrentlyPasswordToSeconds + $minutesCurrentlyPasswordToSeconds + $currentlySecond;

                            $resultFinalSeconds = null;

                            if($currentlyYear !== $yearResetPassword){


                                 $timeComsumedYear = $oneYearInSeconds - $totalAddedConsumedSecondsReset;

                                 if($currentlyYear - $yearResetPassword <= 1){

                                    $resultFinalSeconds = $timeComsumedYear + $totalAddedConsumedSecondsCurrently;

                                 
                                 }else{

                                   $resultFinalSeconds =  ($timeComsumedYear + $totalAddedConsumedSecondsCurrently) + ($oneYearInSeconds * ($currentlyYear - $yearResetPassword - 1) );
                                 }

                                 

                            }else{

                                $resultFinalSeconds =  $totalAddedConsumedSecondsCurrently - $totalAddedConsumedSecondsReset;
                            }

                            
                            if($resultFinalSeconds < 180){

                                $resultFinalSeconds = 180 - $resultFinalSeconds;

                                if($resultFinalSeconds < 10){

                                    $resultFinalSeconds = "0" . $resultFinalSeconds;
                                    
                                }


                                if($resultFinalSeconds < 60){


                                    throw new Exception("You will again request the password change in" . "\n 00:00:" . $resultFinalSeconds . "\n seconds");
                                
                                }else if($resultFinalSeconds == 60){

                                    throw new Exception("You will again request the password change in" . "\n 00:01:00"  . "\n minutes");
                                
                                }else if ($resultFinalSeconds > 60 && $resultFinalSeconds < 120){
                                    
                                    if($resultFinalSeconds < 60){

                                        $resultFinalSeconds = 60 - $resultFinalSeconds;
                                    
                                    }else{

                                        $resultFinalSeconds = $resultFinalSeconds - 60;
                                    }


                                    if($resultFinalSeconds < 10){

                                        $resultFinalSeconds = "0" . $resultFinalSeconds;
                                    }
                                    

                                    throw new Exception("You will again request the password change in" . "\n 00:01:" . $resultFinalSeconds . "\n minutes");
                                
                                }else if($resultFinalSeconds == 120){

                                    throw new Exception("You will again request the password change in" . "\n 00:02:00"  . "\n minutes");
                                
                                }else{

                                    if($resultFinalSeconds < 120){

                                        $resultFinalSeconds = 120 - $resultFinalSeconds;
                                    
                                    }else{

                                        $resultFinalSeconds = $resultFinalSeconds - 120;
                                    }


                                    if($resultFinalSeconds < 10){

                                        $resultFinalSeconds = '0' . $resultFinalSeconds;
                                    }


                                    throw new Exception("You will again request the password change in" . "\n 00:02:"  . $resultFinalSeconds ."\n minutes");
                                }
                            
                            
                            }else{

                                  
                                   $scandFilesResetPassword = scandir($_SERVER['DOCUMENT_ROOT'] . "/src/users/resetPassword");

                                   if(!$scandFilesResetPassword){

                                      error_log("\r\nNo se han podido escanear los ficheros de la carpeta /src/users/resetPassword para eliminarlo y que pueda volver a cambiar la
                                      contraseña el usuario con el email" . $_POST['emailReset'] . " en la fecha " .  Robot::getTime()['dateCompleteHour'], 3,
                                      Robot::getPathErrorsLog());

                                      throw new Exception("An ocurred an error.Try again!");
                                   
                                   }else{


                                      $resultScanDir = null;

                                       for ($i=0; $i < count($scandFilesResetPassword); $i++) { 
                                           
                                            
                                            if(stripos($scandFilesResetPassword[$i], $_POST['emailReset'])){

                                                $resultScanDir = $scandFilesResetPassword[$i];
                                            }
                                       }


                                       if(!is_null($resultScanDir)){

                                           if(!unlink($_SERVER['DOCUMENT_ROOT'] . "/src/users/resetPassword/$resultScanDir")){
                                               
                                               throw new Exception("An ocurred an error.Try again!");
                                           }
                                       }

                                       
                                       $sql = "DELETE FROM `resetPassword` WHERE `email`='".$_POST['emailReset']."'";

                                       $query = $conn->query($sql);

                                       if(!$query){

                                          throw new Exception("An ocurred an error.Try again");

                                       
                                       }else{

                                            $sql = "ALTER TABLE `resetPassword` AUTO_INCREMENT = 1";


                                            $query = $conn->query($sql);


                                            if(!$query){

                                                throw new Exception("An ocurred an error.try again!");
                                            
                                            }else{

                                                  echo "succesfully";
                                            }
                                       }

                                   }
                            }


                       
                       }else{

                              
                                if(!file_exists($_SERVER['DOCUMENT_ROOT'] . "/src/bot/resetPasswordTemplate.php")){
                                       
                                       error_log("\r\nNo existe el archivo resetPasswordTemplate.php para obtener el codigo y cambiar la contraseña", 3, $_SERVER['DOCUMENT_ROOT'] . 
                                       "/src/bot/errorsUsers/error.log");

                                        throw new Exception("An ocurred an error.Try again!gg");
                                        
                                }else{

                                     $shufflePath = Robot::shuffleResetPassword($_POST['emailReset']) . Robot::createShuffleWords();

                                     $pathResetPassword = $_SERVER['DOCUMENT_ROOT'] . "/src/users/resetPassword/$shufflePath" . "QUERY" .$_POST['emailReset'] . ".php";

                                     $pahtResetPasswordForEmailUser = Robot::getMyDomain() . "/src/users/resetPassword/$shufflePath" . "QUERY" .$_POST['emailReset'];

                                     $fop = fopen($pathResetPassword, 'w+');

                                     if(!$fop){

                                        throw new Exception("An ocurred an error.Try again!");
                                     
                                     }else{

                                         $getCode = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/src/bot/resetPasswordTemplate.php");

                                         if(!$getCode){

                                             if(!unlink($pathResetPassword)){

                                                 throw new Exception("An ocurred an error.Try again!");
                                             }

                                             throw new Exception("An ocurred an error!Try again!");
                                         
                                         }else{

                                             fwrite($fop, $getCode);

                                         }

                                         fclose($fop);
                                          
                                          //create temporaly password
                                          $shuffleResetPassword = Robot::shuffleResetPassword($_POST['emailReset']);

                                        
                                          //send email for reset password

                                          $headers = "MIME-Version: 1.0" . "\r\n";
                                          $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
                                          $headers .= "";

                                          $subject = "Reset password";

                                           $message = '<!DOCTYPE html>
                                           <html lang="en">
                                           <head>
                                           <meta charset="UTF-8">
                                           <meta http-equiv="X-UA-Compatible" content="IE=edge">
                                           <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                           <title>Reset password</title>
                                           </head>' . 
                                           '<body>' .
                                           '<h1>Hello '. $getUsernameForEmailReset . ':</h1>'.
                                           '<p>We have received the request to change your password, if it was not you, ignore this email.</p>'.
                                           '<p>To change the password copy this temporaly password:&nbsp;<span style="font-weight:bold;"> ' . $shuffleResetPassword . '</span>  and <span><a href="' . 
                                            $pahtResetPasswordForEmailUser .'">click here</a></span></p>' . 
                                            '<hr>'.
                                            '</body>' . 
                                            '<footer style="text-align:center";>' . 
                                            '<div style="text-align:center;">' . 
                                            '<p>This email was sent to <span style="color:blue;text-decoration:underline;">' . $_POST['emailReset'] . '</span></p>'.
                                            '</div>'.
                                            '</footer>';


                                            if(!mail($_POST['emailReset'], $subject, wordwrap($message), $headers)){

                                                throw new Exception("An ocurred an error");
                                            
                                            }else{

                                                $dateTime = Robot::getTime()['hour'] . ':' . Robot::getTime()['minute'] . ':' . Robot::getTime()['second'];

                                                $sql = "INSERT INTO `resetPassword` (`id`, `email`, `date`, `dateTime`, `temporalPassword`) VALUES (NULL, '".$_POST['emailReset']."',
                                                '".Robot::getTime()['dateCompleteNoHour']."', '$dateTime', '$shuffleResetPassword')";

                                                $query = $conn->query($sql);

                                                if(!$query){
                                                    
                                                    if(!unlink($pathResetPassword)){
                                                        
                                                        error_log("\r\nNo se ha podido eliminar el fichero temporal\n" . $pathResetPassword, 3, $_SERVER['DOCUMENT_ROOT'] . 
                                                        "/src/bot/errorsUsers/error.log");
                                                    }



                                                    throw new Exception("An error an ocurred.Try again!");
                                               
                                                }else{

                                                      echo "We have sent you an email with the instructions to change the password. Check your spam folder. This email has an expiration of 10 minutes.";
                                                }
                                            }
       
                                     }
                                } 
                              
                       }
                  }
            }
      }

    
    }else{

         throw new Exception('Enter your email to be able to change your password');
    }


}catch(\Throwable $th){

    echo $th->getMessage();
    http_response_code(403);

}finally{

      if(isset($conn)){

          if(!$conn->connect_error){

               $conn->close();
          }
      }
}

$result = ob_get_contents();
ob_end_clean();
echo $result;
exit;
