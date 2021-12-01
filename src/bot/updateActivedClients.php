<?php 
error_reporting(0);
ignore_user_abort(1);
require $_SERVER['DOCUMENT_ROOT'] . "/src/bot/Bot.php";
use robot\Robot;



try{
    

     $conn = new mysqli(Robot::$hostname, Robot::$usernameHostname, Robot::$passwordHostname, Robot::$databaseName);

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

             $sql = "SELECT * FROM  `activedClients` WHERE `ip`='$queryIp'";

             $query = $conn->query($sql);

             
             if(!$query){

                throw new Exception("El usuario con la IP\n" . Robot::getIpClient() . "\n no se ha podido consultar si la ip esta en la base de datos  en la fecha\n" . Robot::getTime()['dateCompleteHour'] . 
                "\n por el siguiente motivo\n" . $conn->error);
            
            }else{


                 if($query->num_rows < 1){

                     $sql = "INSERT INTO `activedClients` (`id`, `ip`) VALUES (NULL, '$queryIp')";

                     $query = $conn->query($sql);


                     if(!$query){

                         throw new Exception("El usuario con la IP\n" . Robot::getIpClient() . "\n no se ha podido insertar los datos  en la base de datos  en la fecha\n" . Robot::getTime()['dateCompleteHour'] . 
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

     if(!$conn->connect_error){

          $conn->close();
     }
    
}
