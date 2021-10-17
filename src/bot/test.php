<?php 
namespace robot;

class bot{

    function __construct($name){
        $this->name = $name;
    }

    function saludar(){
        echo 'my name is ' . $this->name;
    }
}