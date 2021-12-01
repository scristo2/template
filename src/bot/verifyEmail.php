<?php
ob_start();
error_reporting(0);
ignore_user_abort(1);
require $_SERVER['DOCUMENT_ROOT'] . "/src/bot/Bot.php";
use robot\Robot;
try{

    if(isset($_POST['emailUser']) && $_POST['emailUser'] !== 'Error email'){

        $emailUser = $_POST['emailUser'];

        $conn = new mysqli(Robot::$hostname , Robot::$usernameHostname, Robot::$passwordHostname, Robot::$databaseName);

        if($conn->connect_error){

            throw new Exception("Error mysqli");
        
        }else{

              $sql = "SELECT * FROM `register` WHERE `email`='$emailUser'";

              $query = $conn->query($sql);

              if(!$query){

                 throw new Exception('Error mysqli');
              
              }else{

                   if($query->num_rows < 1){


                       throw new Exception('Undefined email');
                   
                   }else{

                       $sql = "UPDATE `register` SET `verifyEmail`=1 WHERE `email`='$emailUser'";

                       $query = $conn->query($sql);


                       if(!$query){

                          throw new Exception('Error mysqli');
                       
                      }else{

                          
                           if(!scandir($_SERVER['DOCUMENT_ROOT'] . "/src/users/verifyEmail")){

                               //undefined because not exists the directory where will be users/VERIFY SO DELETE user from table and he will have to register again

                               $sql = "DELETE FROM `register` WHERE `email`='$emailUser'";


                               $query = $conn->query($sql);

                               if(!$query){

                                  throw new Exception("Error mysqli");
                               
                               }else{

                                  throw new Exception("Undefined email");
                               }
                               
                           
                           }else{

                               $scanDir = scandir($_SERVER['DOCUMENT_ROOT'] . "/src/users/verifyEmail");

                               $resultScanDir = null;
  
                               for ($i=0; $i < count($scanDir) ; $i++) { 
                                
                                   if(stripos($scanDir[$i], $emailUser)){
  
                                        $resultScanDir = $scanDir[$i];
                                         break;
                                
                                    }else{
  
                                        continue;
                                    }
                                }
  
  
                                if($resultScanDir){
  
                                      if(!unlink($_SERVER['DOCUMENT_ROOT'] . "/src/users/verifyEmail/" . $resultScanDir)){

                                          throw new Exception('Error mysqli');

                                      }else{

                                          echo "All ok";
                                      }
                            
                                }else{

                                     $sql = "DELETE FROM `register` WHERE `email`='$emailUser'";

                                     $query = $conn->query($sql);
  
                                     if(!$query){

                                         throw new Exception('Error mysqli');
                                     
                                     }else{

                                        throw new Exception("Undefined email");
                                     }

                               }


                           }
                      }


                   }
              }
        }
    
    }else{

         throw new Exception("Undefined email");
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