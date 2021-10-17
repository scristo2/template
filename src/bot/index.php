<?php 
error_reporting(0);
$hostname = 'localhost';
$username ='root';
$password = '';
$database = 'website';

try{

    $connect = new mysqli($hostname, $username, $password, $database);

    if($connect->connect_errno){

        throw new Exception($connect->connect_errno);
    
    }else{

       date_default_timezone_set('Europe/Madrid');
       echo date('H:i:s');
       echo "<p>my name is sergio</p>";
       echo "<p>my name is sergio</p>";
    }
}catch(\Throwable $th){

    echo $th->getMessage();

}finally{

    $connect->close();
    
}

