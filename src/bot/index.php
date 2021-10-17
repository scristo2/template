<?php 
error_reporting(0);
$hostname = 'localhost';
$username ='root';
$password = 'root';
$database = 'website';


try{

    $connect = new mysqli($hostname, $username, $password, $database);

    if($connect->connect_errno){

        throw new Exception($connect->connect_errno);
    
    }else{

        echo "you are connected";
    }
}catch(\Throwable $th){

    echo $th->getMessage();

}finally{

    $connect->close();
    
}

