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

          $sql = "CREATE TABLE IF NOT EXISTS `activedClients` (`id` INT(9) AUTO_INCREMENT NOT NULL, `ip` VARCHAR(65) NOT NULL, PRIMARY KEY (`id`))";

          $query = $conn->query($sql);

          if(!$query){

            throw new Exception("El usuario con la IP\n" . Robot::getIpClient() . "\n no se h apodio crear la tabla en la base de datos en la fecha\n" . Robot::getTime()['dateCompleteHour'] . 
            "\n por el siguiente motivo\n" . $conn->error);
          
         }else{

             $queryIp = Robot::getIpClient();

             $sql = "INSERT INTO `activedClients` (`id`, `ip`) VALUES (NULL, '$queryIp')";

             $query = $conn->query($sql);

             
             if(!$query){

                throw new Exception("El usuario con la IP\n" . Robot::getIpClient() . "\n no se ha podido insertar en la base d edatos en la fecha\n" . Robot::getTime()['dateCompleteHour'] . 
                "\n por el siguiente motivo\n" . $conn->connect_error);
            
            }else{

                 echo "datos insertados correctamente";
            }
         }
     }
    
}catch(\Throwable $th){
     
     error_log($th->getMessage() ."\r\n", 1, "javier235hj@hotmail.com", "Subject: Error en la actualizacion del los clientes en activo.");
     http_response_code(503); //forze error because the client can not  connect with the database

}finally{

     $conn->close();
    
}
