<?php
session_name("login");
session_start();
ob_start();
error_reporting(0);
ignore_user_abort(1);
require $_SERVER['DOCUMENT_ROOT'] . "/src/bot/Bot.php";
use robot\Robot;
try{

    if(isset($_POST['emailLogin']) && isset($_POST['passwordLogin'])){

        $emailLogin = $_POST['emailLogin'];
        $passwordLogin = md5($_POST['passwordLogin']);

        $conn = new mysqli(robot::$hostname, Robot::$usernameHostname, Robot::$passwordHostname, Robot::$databaseName);

        if($conn->connect_error){

            throw new Exception("An ocurred an error.Try again!");
        
        }else{

             $sql = "SELECT * FROM `register` WHERE `email` ='$emailLogin'";

             $query = $conn->query($sql);

             if(!$query){

                 throw new Exception("An ocurred an error.Try again!");
             
             }else{

                  if($query->num_rows < 1){

                       throw new Exception("The email or password is not correct.");
                  
                  }else{

                       while($row = $query->fetch_assoc()){

                           if($row['pass'] == $passwordLogin){

                               
                                if($row['verifyEmail']){      
                                                                         
                                     $_SESSION['logged'] = true;
                                     $_SESSION['username'] = $row['username'];
                                     $_SESSION['email'] = $row['email'];
                                     $listResult = ["username" => $row['username'], "email" => $row['email']];
                                     
                                     if(isset($_POST['checkLogin'])){

                                        //shuffle valueCookieRememberSession

                                         $rangenumbersCookieRememberSession = range(1, 99999);
                                         $letterLowerCookieRememberSession = range('a', 'z');
                                         $letterUpperCookieRememberSession = range('A', 'Z');

                                         $listArrysCookieRememberSession = [$rangenumbersCookieRememberSession, $letterLowerCookieRememberSession, $letterUpperCookieRememberSession];

                                         for ($i=0; $i < count($listArrysCookieRememberSession) ; $i++) { 
                                              
                                             shuffle($listArrysCookieRememberSession[$i]);
                                         }

                                         $valueCookieRememberSession = md5($_POST['emailLogin']) . $listArrysCookieRememberSession[0][10] . $listArrysCookieRememberSession[1][10] . $listArrysCookieRememberSession[2][10] . $listArrysCookieRememberSession[2][5] . $listArrysCookieRememberSession[0][5] . $listArrysCookieRememberSession[1][5];

                                         $sql1 = "UPDATE `register` SET `rememberSession`='$valueCookieRememberSession' WHERE `email`='".$_POST['emailLogin']."'";

                                         $query1 = $conn->query($sql1);

                                         if(!$query1){

                                            throw new Exception("An ocurred an error.Try again!");
                                         
                                         
                                         }else{

                                            setcookie("rememberSession", $valueCookieRememberSession, time() + ( 365 * 24 * 60 * 60), "/");

                                            echo json_encode($listResult);
                                         }

                                     }else{

                                         echo json_encode($listResult);
                                     }

                                     
                                
                                }else{

                                     throw new Exception("You have to validate your email, check your inbox or spam folder");
                                }
                           
                           }else{

                               throw new Exception("The email or password is not correct!");
                           }
                       }
                  }
             }
        }
    
    }else{

        throw new Exception("Undefined vars");
    }


}catch(\Throwable $th){
    
    echo $th->getMessage(); 
    http_response_code(403);

}finally{

    if(!$conn->connect_error){

         $conn->close();
    }
}


$result = ob_get_contents();
ob_end_clean();
echo $result;