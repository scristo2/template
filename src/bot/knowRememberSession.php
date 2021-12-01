<?php
session_name('login');
session_start();
ob_start();
error_reporting(0);
ignore_user_abort(1);
require $_SERVER['DOCUMENT_ROOT'] . "/src/bot/Bot.php";
use robot\Robot;
if(isset($_COOKIE['rememberSession'])){

    try{

        $conn = new mysqli(Robot::$hostname, Robot::$usernameHostname, Robot::$passwordHostname, Robot::$databaseName);

        if($conn->connect_error){

             throw new Exception($conn->connect_error);

        }else{

              $sql = "SELECT * FROM `register` WHERE `rememberSession`='".$_COOKIE['rememberSession']."'";

              $query = $conn->query($sql);


              if(!$query){

                  throw new Exception($conn->error);
              
              }else{

                    $result = null;

                    if($query->num_rows < 1){

                         $result = ['textUsername' => 'Log In', 'pathImageTextUsername' => './src/images/blockedPng.png',
                         "displayMenuLogin" => 'flex', "displayMenuRegister" => "flex", "displayMenuAccount" => "none",
                          "displayAppContentTemporalLogin" => "none", "displayAppContentTemporalAcoount" => 'none'];

                         //how not result with the cookie, unset var

                         if(isset($_SESSION['logged'])){

                             unset($_SESSION['logged']);
                         }
                    
                    
                    }else{


                         while($row = $query->fetch_assoc()){

                             $result = ['textUsername' => $row['username'], 'pathImageTextUsername' => "./src/images/profileMenu.png",
                             "displayMenuLogin" => 'none', "displayMenuRegister" => "none", "displayMenuAccount" => "flex",
                             "displayAppContentTemporalLogin" => "none","displayAppContentTemporalAccount" => 'flex'];

                             $_SESSION['logged'] = true;
                             $_SESSION['username'] = $row['username'];
                             $_SESSION['email'] = $row['email'];
                         }
                    }


                    echo json_encode($result);
              }
        }
    }catch(\Throwable $th){

         http_response_code(403);
    
    }finally{

         if(!$conn->connect_error){

             $conn->close();
         }
    }

}else{
     
     $result = null;
     
     if(isset($_SESSION['username'])){

        try{

             $conn = new mysqli(Robot::$hostname, Robot::$usernameHostname, Robot::$passwordHostname, Robot::$databaseName);

             if($conn->connect_error){

                  throw new Exception($conn->connect_error);
             
             }else{

                 $sql = "SELECT * FROM `register` WHERE `username`='".$_SESSION['username']."'";

                 $query = $conn->query($sql);

                 if(!$query){

                     throw new Exception($conn->error);
                     
                 }else{

                      if($query->num_rows < 1){

                          throw new Exception('error');
                      
                       }else{

                            while($row = $query->fetch_assoc()){

                                $_SESSION['logged'] = true;
                                $_SESSION['username'] = $row['username'];
                                $_SESSION['email'] = $row['email'];

                                $result = ['textUsername' => $row['username'], 'pathImageTextUsername' => "./src/images/profileMenu.png",
                                "displayMenuLogin" => 'none', "displayMenuRegister" => "none", "displayMenuAccount" => "flex",
                                "displayAppContentTemporalLogin" => "none","displayAppContentTemporalAccount" => 'flex'];
                            }
                       }
                 }
                
            }

        }catch(\Throwable $th){

             http_response_code(403);
        
        }finally{

             if(!$conn->connect_error){

                $conn->close();
             }
        }
     
    }else{

        $result = ['textUsername' => 'Log In', 'pathImageTextUsername' => './src/images/blockedPng.png',
     "displayMenuLogin" => 'flex', "displayMenuRegister" => "flex", "displayMenuAccount" => "none",
      "displayAppContentTemporalLogin" => "none", "displayAppContentTemporalAccount" => 'none'];
    }


      echo json_encode($result);

      
}

$getResult = ob_get_contents();
ob_end_clean();
echo $getResult;