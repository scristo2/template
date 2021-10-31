<?php 
error_reporting(0);
require $_SERVER['DOCUMENT_ROOT'] . "/src/bot/Bot.php";
use robot\Robot;

$hostname = "localhost";
$usernameHostname = 'root';
$passwordHostname = "";
$databaseName = "website";


try{
    

     $conn = new mysqli($hostname, $usernameHostname, $passwordHostname, $databaseName);

     if($conn->connect_errno){

         throw new Exception("El usuario con la IP\n" . Robot::getIpClient() . "\n no se ha podido conectar en la fecha\n" . Robot::getTime()['dateCompleteHour'] . 
        "\n por el siguiente motivo\n" . $conn->connect_error);
     
     }else{

          $ipQuery = Robot::getIpClient();

          $sql = "SELECT * FROM  `activedClients` WHERE `ip`='$ipQuery'";

          $query = $conn->query($sql);

          if(!$query){

            throw new Exception("El usuario con la IP\n" . Robot::getIpClient() . "\n no seha podio seleccionar nada en la base de datos en la fecha\n" . Robot::getTime()['dateCompleteHour'] . 
            "\n por el siguiente motivo\n" . $conn->error);
             
             
         }else{

              if($query->num_rows > 0){

                  
                   $sql = "DELETE  FROM `activedClients` WHERE ip='$ipQuery'";

                   $query = $conn->query($sql);

                   if(!$query){

                    throw new Exception("El usuario con la IP\n" . Robot::getIpClient() . "\n no  se ha podido eliminar en  la base de datos en la fecha\n" . Robot::getTime()['dateCompleteHour'] . 
                    "\n por el siguiente motivo\n" . $conn->error);
                   
                  }else{

                       
                       $sql = "ALTER TABLE `activedClients` AUTO_INCREMENT = 1";

                       $query = $conn->query($sql);

                       if(!$query){

                        throw new Exception("El usuario con la IP\n" . Robot::getIpClient() . "\n no se h apodido restablecer el id al borrar en la base de datos en la fecha\n" . Robot::getTime()['dateCompleteHour'] . 
                        "\n por el siguiente motivo\n" . $conn->error);
                       }
                  }

              }
         }
     }
    
}catch(\Throwable $th){
     
     error_log($th->getMessage() ."\r\n", 1, "javier235hj@hotmail.com", "Subject: Error en la actualizacion del los clientes en activo.");
     http_response_code(503); //forze error because the client can not  connect with the database

}finally{

     $conn->close();
    
}
