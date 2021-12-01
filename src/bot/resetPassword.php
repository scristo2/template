<?php 
try{

     throw new Exception("error");
}catch(\Throwable $th){

     echo "this is a error";
     http_response_code(403);
}