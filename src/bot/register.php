<?php
error_reporting(0);
ignore_user_abort(1);
require $_SERVER['DOCUMENT_ROOT'] . "/src/bot/Bot.php";
use robot\Robot;

if(isset($_POST['emailRegister']) && isset($_POST['usernameRegister']) && isset($_POST['passwordRegister1']) &&
isset($_POST['passwordRegister2']) && isset($_POST['dateRegister']) && isset($_POST['checkRegister'])){

    $emailRegister = strtolower(strval($_POST['emailRegister']));
    $usernameRegister = $_POST['usernameRegister'];
    $passwordRegister1 = $_POST['passwordRegister1'];
    $passwordRegister2 = $_POST['passwordRegister2'];
    $checkRegister = $_POST['checkRegister'];
    $dateRegister = $_POST['dateRegister'];

    //array with the vars

    $listFormVars = [$emailRegister, $usernameRegister]; //the password not beacuse is in md5 insert
    $prohibitedCharacter = ['(', ')', ';', '"', '%', '&', '<', '>'];

    //errror thow message information email
    $errorInforamtionEmail = "y con el correo\n" . $emailRegister;

    //path future file cretaed fopen verify email
    $futurePathVerifyEmail = $_SERVER['DOCUMENT_ROOT'] ."/src/users/verifyEmail/" . md5($emailRegister) . md5($dateRegister) . "QUERY" . $emailRegister . ".php";

    //url website is in the last where mail
    $futurePathVerifyEmailDomain = Robot::getMyDomain() . "/src/users/verifyEmail/" . md5($emailRegister) . md5($dateRegister) . "QUERY" . $emailRegister ;
        
    try{

        $conn = new mysqli(Robot::$hostname, Robot::$usernameHostname, Robot::$passwordHostname, Robot::$databaseName);
         
    
         if($conn->connect_error){
    
            throw new Exception("El usuario con la IP\n" . Robot::getIpClient() . "\n $errorInforamtionEmail no se ha podido conectar en la fecha\n" . Robot::getTime()['dateCompleteHour'] . 
            "\n por el siguiente motivo\n" . $conn->connect_error);
        
        }else{
    
    
             $sql = "CREATE TABLE IF NOT EXISTS `register` (`id` INT(9) NOT NULL AUTO_INCREMENT, `email` VARCHAR(65) NOT NULL ,`username` VARCHAR(65) NOT NULL, `pass` VARCHAR(65) NOT NULL,
             `verifyEmail` TINYINT(1) NOT NULL, `dateRegister` VARCHAR(65) NOT NULL, `rememberSession` VARCHAR(65) NOT NULL, PRIMARY KEY (`id`))";

              $query = $conn->query($sql);


              if(!$query){

                throw new Exception("El usuario con la IP\n" . Robot::getIpClient() . "\n $errorInforamtionEmail no se ha podido crear la tabla de registro en la fecha\n" . Robot::getTime()['dateCompleteHour'] . 
                "\n por el siguiente motivo\n" . $conn->error);
              
              }else{

                  
                    //before insert data check form vars prohibited character in email and username
                    
                    for($i = 0; $i < count($prohibitedCharacter); $i++){

                           for($xi = 0; $xi < count($listFormVars); $xi++){

                                  if(strpos($listFormVars[$xi], $prohibitedCharacter[$i])){

                                      throw new Exception("This character:\n" . $prohibitedCharacter[$i] . "\nis not allowed!");
                                          
                                  }
                           }
                    }//end for prohibited character


                    //check if the inputs password are same


                    if($passwordRegister1 !== $passwordRegister2){

                          
                          throw new Exception("Passwords do not match");

                    
                    }else{

                           //check if exists email and username
                           $listCheckRegister = ['email', 'username'];  
                           for($i = 0; $i < count($listFormVars); $i++){

                               $elementListCheckRegister = $listCheckRegister[$i];
                               $searchQuery = $listFormVars[$i];
                               $sql = "SELECT * FROM `register` WHERE `$elementListCheckRegister`='$searchQuery'";

                               $query = $conn->query($sql);

                               if(!$query){

                                throw new Exception("El usuario con la IP\n" . Robot::getIpClient() . "\n$errorInforamtionEmail no se ha podido buscar en la tabla de registro en la fecha\n" . Robot::getTime()['dateCompleteHour'] . 
                                "\n por el siguiente motivo\n" . $conn->error);
                               
                              
                              }else{


                                   if($query->num_rows > 0){

                                       throw new Exception("This\n" . $listCheckRegister[$i] . "\nis already registered");
                                   
                                   }
                              }

                           }//end for

                           //encript password client form
                           
                           $encriptPassword = md5($passwordRegister1);
                           
                           $sql = "INSERT INTO `register` (`id`, `email`, `username`, `pass`, `verifyEmail`, `dateRegister`, `rememberSession`) VALUES (NULL, '$emailRegister',
                           '$usernameRegister','$encriptPassword', 0, '$dateRegister', 'default')";

                           $query = $conn->query($sql);

                           if(!$query){

                            throw new Exception("El usuario con la IP\n" . Robot::getIpClient() . "\n$errorInforamtionEmail no se ha podido registrar en la tabla de registro en la fecha\n" . Robot::getTime()['dateCompleteHour'] . 
                            "\n por el siguiente motivo\n" . $conn->error);
                           
                           
                           }else{

                              ///CREATE A PHP DIRECTORY WHERE VERIFY EMAIL

                              $sqlErrorCreateDirectoryOrFileVerifyEmail = "DELETE FROM `register` WHERE `email`='$emailRegister'";
                             
                              if(!is_dir($_SERVER['DOCUMENT_ROOT'] . "/src/users")){
                                  
                                   if(!mkdir($_SERVER['DOCUMENT_ROOT'] . "/src/users/verifyEmail", 0777, true)){
                                          
                                          //delete from table to user registed

                                          $query = $conn->query($sqlErrorCreateDirectoryOrFileVerifyEmail);

                                          if(!$query){

                                            throw new Exception("El usuario con la IP\n" . Robot::getIpClient() . "\n$errorInforamtionEmail no se ha podido crear el directorio de verificar el email ni tampoco eliminarlo de la base de datos para que se vuelva a registrar en la fecha\n" . Robot::getTime()['dateCompleteHour'] . 
                                            "\n por el siguiente motivo\n" . $conn->error);
                                          
                                          }else{

                                            throw new Exception("El usuario con la IP\n" . Robot::getIpClient() . "\n$errorInforamtionEmail no se ha podido crear el directorio de verificar el email en la fecha\n" . Robot::getTime()['dateCompleteHour'] . 
                                            "");
                                          }

                                     
                                   }

                              }

                              $fop = fopen($futurePathVerifyEmail, "w+");
                              if(!$fop){
                                
                                $query = $conn->query($sqlErrorCreateDirectoryOrFileVerifyEmail);

                                if(!$query){
                                    throw new Exception("El usuario con la IP\n" . Robot::getIpClient() . "\n$errorInforamtionEmail no se ha podido crear el archivo php para verifica el email ni tampoco eliminarlo de l abase de datos para que se vuelva a registrar  en la fecha\n" . Robot::getTime()['dateCompleteHour'] . 
                                    "\n por el siguiente motivo\n" . $conn->error);
                                
                                
                                }else{

                                    throw new Exception("El usuario con la IP\n" . Robot::getIpClient() . "\n$errorInforamtionEmail no se ha podido crear el archivo php para verificar el email  en la fecha\n" . Robot::getTime()['dateCompleteHour'] );
                                }
                                
                              }

                              

                              $fopFileCode = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/src/bot/verifyEmailTemplate.php", false);
                              if(!$fopFileCode){
                                
                                //delete registed user from table because there is not the the code for verfi email

                                $query = $conn->query($sqlErrorCreateDirectoryOrFileVerifyEmail);

                                if(!$query){

                                    fclose($fop);

                                    throw new Exception("El usuario con la IP\n" . Robot::getIpClient() . "\n$errorInforamtionEmail no se ha podido eliminar de la base de datos para que se vuelva a registrar  en la fecha\n" . Robot::getTime()['dateCompleteHour'] . 
                                    "\n por el siguiente motivo\n" . $conn->error);
                                }

                                fclose($fop);
                                
                                throw new Exception("El usuario con la IP\n" . Robot::getIpClient() . "\n$errorInforamtionEmail no se ha podido obtener el codigo del archivo verifyEmailTemplate  en la fecha\n" . Robot::getTime()['dateCompleteHour']);
                              }
                              fwrite($fop, $fopFileCode);
                              fclose($fop);


                              //send email for verify email

                              $headers = "MIME-Version: 1.0" . "\r\n";
                              $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
                              $headers .= "";

                              $subject = "Verify email";

                              $message = '<!DOCTYPE html>
                              <html lang="en">
                              <head>
                                  <meta charset="UTF-8">
                                  <meta http-equiv="X-UA-Compatible" content="IE=edge">
                                  <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                  <title>Verify email</title>
                              </head>' . 
                              '<body>' .
                              '<h1>Hello '. $usernameRegister . ':</h1>'.
                              '<p>You have just registered and to be able to access your account you just have to verify it by <span><a href="' . 
                              $futurePathVerifyEmailDomain .'">click here</a></span></p>' . 
                              '<hr>'.
                              '</body>' . 
                              '<footer style="text-align:center";>' . 
                              '<div style="text-align:center;">' . 
                              '<p>This email was sent to <span style="color:blue;text-decoration:underline;">' . $emailRegister . '</span></p>'.
                              '</div>'.
                              '</footer>';
       
                             if(!mail($emailRegister, $subject, $message, $headers)){

                                 //delete users from table beacuse the error send email an delete file verify email.php

                                 if(file_exists($futurePathVerifyEmail)){

                                     unlink($futurePathVerifyEmail);
                                 }

                                 $query = $conn->query($sqlErrorCreateDirectoryOrFileVerifyEmail);

                                 if(!$query){

                                    throw new Exception("El usuario con la IP\n" . Robot::getIpClient() . "\n$errorInforamtionEmail no se ha podido enviar el email de verificacion ni eliminar de la tabla el registro del cliente  en la fecha\n" . Robot::getTime()['dateCompleteHour'] . 
                                    "\n por el siguiente motivo\n" . $conn->error);
                                
                                 }else{

                                    throw new Exception("El usuario con la IP\n" . Robot::getIpClient() . "\n$errorInforamtionEmail no se ha podido enviar el email para verificar la cuenta en la fecha\n" . Robot::getTime()['dateCompleteHour']);
                                 }
                                 

                            }else{

                                 //$query = $conn->query($sqlErrorCreateDirectoryOrFileVerifyEmail);

                                 echo "We have sent you an email to confirm your account.Check your spam mailbox";
                            }


                           }
                    } 
               
                }
        }
    
    
    }catch(\Throwable $th){

           
           if(preg_match('/character/', $th->getMessage()) || preg_match("/Passwords/", $th->getMessage()) || preg_match('/already\sregistered/', $th->getMessage())){
              
                    echo $th->getMessage();

           }else{

                error_log("En el archivo\n" . __FILE__  . ":\n".$th->getMessage(), 1, Robot::$errorEmail, "Subject: Error al crearse una cuenta.");

           }

           http_response_code(503);
           
    
    }finally{
    
         if(!$conn->connect_error){

              $conn->close();
         }
    }
    

}else{

     echo "Undefined vars";
     
}




