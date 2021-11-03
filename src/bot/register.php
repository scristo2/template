<?php
error_reporting(0);
ignore_user_abort(1);
require $_SERVER['DOCUMENT_ROOT'] . "/src/bot/Bot.php";
use robot\Robot;

if(isset($_POST['emailRegister']) && isset($_POST['usernameRegister']) && isset($_POST['passwordRegister1']) &&
isset($_POST['passwordRegister2']) && isset($_POST['dateRegister']) && isset($_POST['checkRegister'])){

    $emailRegister = strtolower(strval($_POST['emailRegister']));
    $usernameRegister = strtolower(strval($_POST['usernameRegister']));
    $passwordRegister1 = strtolower(strval($_POST['passwordRegister1']));
    $passwordRegister2 = strtolower(strval($_POST['passwordRegister2']));
    $checkRegister = $_POST['checkRegister'];
    $dateRegister = $_POST['dateRegister'];

    //array with the vars

    $listFormVars = [$emailRegister, $usernameRegister]; //the password not beacuse is in md5 insert
    $prohibitedCharacter = ['(', ')', ';', '"', ' ', '%', '&', '<', '>'];
        
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

                    }
               
                }
        }
    
    
    }catch(\Throwable $th){

           
           if(preg_match('/character/', $th->getMessage()) || preg_match("/Passwords/", $th->getMessage())){
              
                    echo $th->getMessage();
           }else{

              error_log("En el archivo\n" . __FILE__  . ":\n".$th->getMessage(), 1, Robot::$errorEmail, "Subject: Error al crearse una cuenta.");

           }

           http_response_code(503);
           
    
    }finally{
    
         $conn->close();
    }
    

}else{

     echo "undefined vars";
     
}




