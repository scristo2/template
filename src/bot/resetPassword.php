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

                                 echo $arrayDateTimeresetPassword[1];
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
                                           '<p>To change the password <span><a href="' . 
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
                                                '".Robot::getTime()['dateCompleteNoHour']."', '$dateTime', '".Robot::shuffleResetPassword($_POST['emailReset'])."')";

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
