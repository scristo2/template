<?php 
ob_start();
error_reporting(0);
ignore_user_abort(1);
require $_SERVER['DOCUMENT_ROOT'] . "/src/bot/Bot.php";
use robot\Robot;
try{

    if(isset($_POST['temporalPassword']) && isset($_POST['password1']) && isset($_POST['password2'])){


        $conn = new mysqli(Robot::$hostname, Robot::$usernameHostname, Robot::$passwordHostname, Robot::$databaseName);

        $temporalPassword = $_POST['temporalPassword'];
        $password1 = md5($_POST['password1']);
        $password2 = md5($_POST['password2']);

        if($password1 !== $password2){

            throw new Exception("The new passwords do not match");
        }

        
        $sql = "SELECT * FROM `resetPassword` WHERE `temporalPassword`='$temporalPassword'";

        $query = $conn->query($sql);

        if(!$query){

            throw new Exception("An ocurred an error.Try again!");
        
        }else{

            if($query->num_rows < 1){

                throw new Exception("The temporary password is not correct");
            
            }else{

                echo 'continue';
            }
        }


    }else{

        throw new Exception("Undefined vars");
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