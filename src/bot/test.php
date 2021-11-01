<?php 
$password = "Cuartelkose";

$encript = md5($password);

echo $encript;

$aa = $password;


if(md5($aa) == $encript){

    echo "the same password";
}