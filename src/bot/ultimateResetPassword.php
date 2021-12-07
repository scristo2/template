<?php 
ob_start();
error_reporting(0);
ignore_user_abort(1);
require $_SERVER['DOCUMENT_ROOT'] . "/src/bot/Bot.php";
use robot\Robot;
try{

    if(isset($_POST['temporalPassword']) && isset($_POST['password1']) && isset($_POST['password2']) && isset($_POST['path'])){


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

                while($row = $query->fetch_assoc()){

                    $emailToResetPassword = $row['email'];
                }


                $sql = "SELECT * FROM `register` WHERE `email`='$emailToResetPassword'";

                $query = $conn->query($sql);

                if(!$query){

                    throw new Exception("An ocurred an error.Try again!");
                
                }else{

                    if($query->num_rows < 1){

                        error_log("\r\nAl buscar el email en la base de datos del registro para cambiar la contraseña dice que no hay resultados", 3, Robot::getPathErrorsLog());
                        throw new Exception($emailToResetPassword);
                    
                    }else{

                        while($row1 = $query->fetch_assoc()){

                            $usernameToReset = $row1['username'];
                        }

                        $sql = "UPDATE `register` SET `pass`='$password1' WHERE `email`='$emailToResetPassword'";

                        $query = $conn->query($sql);

                        if(!$query){

                            throw new Exception("An ocurred an error.Try again!");
                        
                        }else{

                             
                             $sql = "DELETE  FROM `resetPassword` WHERE `email`='$emailToResetPassword'";

                             $query = $conn->query($sql);

                             if(!$query){

                                error_log("\r\nNo se ha podido eliminar de la tabla resetPassword al email $emailToResetPassword, eliminalo tu a mano", 3, Robot::getPathErrorsLog());
                             
                             }else{

                                   $sql = "ALTER TABLE `resetPassword` AUTO_INCREMENT = 1";

                                   $query = $conn->query($sql);

                                   if(!$query){

                                       error_log("\r\nno se ha podido restaural el autoincrement de l atabla reset password despues de eliminar a " . $emailToResetPassword, "\nhazlo tu a mano", Robot::getPathErrorsLog());
                                   }
                             }
                             

                             if(!unlink($_POST['path'] . ".php")){

                                   error_log("\r\nNo se ha podido eliminar el archivo despues de cambiar la contraseña con el email $emailToResetPassword, hazlo tu a mano", 3, Robot::getPathErrorsLog());
                             }


                             //send email succesfully change password

                             $headers = "MIME-Version: 1.0" . "\r\n";
                             $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
                             $headers .= "";

                             $subject = "Password change request successful.";

                             $message = '<!DOCTYPE html>
                             <html lang="en">
                             <head>
                                 <meta charset="UTF-8">
                                 <meta http-equiv="X-UA-Compatible" content="IE=edge">
                                 <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                 <title>Reset password</title>
                             </head>' . 
                             '<body>' .
                             '<h1>Hello '. $usernameToReset . ':</h1>'.
                             '<p>We just want to tell you that your password change request has been successful.</p>' . 
                             '<p>We hope you have a great day.</p>' . 
                             '<p style="font-weight:bold">The team of League of Legends premium.</p>'.
                             '<hr>'.
                             '</body>' . 
                             '<footer style="text-align:center";>' . 
                             '<div style="text-align:center;">' . 
                             '<p>This email was sent to <span style="color:blue;text-decoration:underline;">' . $emailToResetPassword . '</span></p>'.
                             '</div>'.
                             '</footer>';
                             
                             if(!mail($emailToResetPassword, $subject, wordwrap($message), $headers)){

                                 error_log("\r\nNo se ha podido envial el email de informacion sobre el cambio de contraseña exitoso al usuario " . $emailToResetPassword, 3, Robot::getPathErrorsLog());
                             }


                             echo "You have changed the password correctly";

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

     if(isset($conn)){

         if(!$conn->connect_error){

             $conn->close();
         }
     }
}
$result = ob_get_contents();
ob_end_clean();
echo $result;