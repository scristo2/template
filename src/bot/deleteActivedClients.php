<?php 
error_reporting(0);
ignore_user_abort(1);
require $_SERVER['DOCUMENT_ROOT'] . "/src/bot/Bot.php";

use robot\Robot;

$hostname = "localhost";
$usernameHostname = 'root';
$passwordHostname = "";
$databaseName = "website";
$ipClient = Robot::getIpClient();

try{

     $conn = new mysqli($hostname, $usernameHostname, $passwordHostname, $databaseName);

     if($conn->connect_error){

          throw new Exception("El usuario con la IP\n" . Robot::getIpClient() . "\n no se ha podido conectar en la fecha\n" . Robot::getTime()['dateCompleteHour'] . 
          "\n por el siguiente motivo\n" . $conn->connect_error);
     
     }else{

          $sql = "SELECT * FROM `activedClients` WHERE `ip`='$ipClient'";

          $query = $conn->query($sql);

          if(!$query){

               throw new Exception("El usuario con la IP\n" . Robot::getIpClient() . "\n no se ha podido seleccionar en la base de datos en la fecha\n" . Robot::getTime()['dateCompleteHour'] . 
               "\n por el siguiente motivo\n" . $conn->error);
          
          }else{


                if($query->num_rows > 0){

                    
                     $sql = "DELETE FROM `activedClients` WHERE `ip`='$ipClient'";

                     $query = $conn->query($sql);

                     if(!$query){

                         throw new Exception("El usuario con la IP\n" . Robot::getIpClient() . "\n no se ha podido borrar en la base de datos en la fecha\n" . Robot::getTime()['dateCompleteHour'] . 
                         "\n por el siguiente motivo\n" . $conn->error);
                    
                    }
               
               }
          }


     }

}catch(\Throwable $th){

     error_log($th->getMessage(), 1, Robot::$errorEmail, "Subject: Error al eliminar de la base de datos al usuario en linea");
     http_response_code(503);

}finally{

     $conn->close();
}