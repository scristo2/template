<?php
error_reporting(0);
ignore_user_abort(1);
require $_SERVER['DOCUMENT_ROOT'] . "/src/bot/Bot.php";
use robot\Robot;

if(isset($_POST['emailRegister']) && isset($_POST['usernameRegister']) && isset($_POST['passwordRegister1']) &&
isset($_POST['passwordRegister2']) && isset($_POST['dateRegister']) && isset($_POST['checkRegister'])){

    $emailRegister = $_POST['emailRegister'];
    $usernameRegister = $_POST['usernameRegister'];
    $passwordRegister1 = $_POST['passwordRegister1'];
    $passwordRegister2 = $_POST['passwordRegister2'];
    $checkRegister = $_POST['checkRegister'];
    $dateRegister = $_POST['dateRegister'];

        
    try{

        $conn = new mysqli(Robot::$hostname, Robot::$usernameHostname, Robot::$passwordHostname, Robot::$databaseName);
         
    
         if($conn->connect_error){
    
            throw new Exception("El usuario con la IP\n" . Robot::getIpClient() . "\n no se ha podido conectar en la fecha\n" . Robot::getTime()['dateCompleteHour'] . 
            "\n por el siguiente motivo\n" . $conn->connect_error);
        
        }else{
    
    
             $sql = "CREATE TABLE IF NOT EXISTS `register` (`id` INT(9) NOT NULL AUTO_INCREMENT, `email` VARCHAR(65) NOT NULL ,`username` VARCHAR(65) NOT NULL, `pass` VARCHAR(65) NOT NULL,
             `verifyEmail` TINYINT(1) NOT NULL, `dateRegister` VARCHAR(65) NOT NULL, PRIMARY KEY (`id`))";

              $query = $conn->query($sql);


              if(!$query){

                throw new Exception("El usuario con la IP\n" . Robot::getIpClient() . "\n no se ha podido crear la tabla de registro en la fecha\n" . Robot::getTime()['dateCompleteHour'] . 
                "\n por el siguiente motivo\n" . $conn->error);
              
              }else{

                  echo "todo ok";
              }
        }
    
    
    }catch(\Throwable $th){
           
           error_log("En el archivo\n" . __FILE__  . ":\n".$th->getMessage(), 1, Robot::$errorEmail, "Subject: Error al crearse una cuenta.");
           http_response_code(503);
    
    }finally{
    
         $conn->close();
    }
    

}else{

     echo "undefined vars";
     
}




