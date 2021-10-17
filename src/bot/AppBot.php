<?php 
namespace bot;
//
setcookie('username', 'olleros', time() +  3600, "/");
setcookie('password', 'olleros', time() + 3600, '/');
class Robot{



    static function getCookiesLogin(){

        if(isset($_COOKIE['username']) && isset($_COOKIE['password'])){

            
        
        }else{

            return "Log In";
        }
    }

}
