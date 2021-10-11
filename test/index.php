<?php 
class person{
   
    function __construct($name, $surname)
    {
        $this->name = $name;
        $this->surname = $surname;
    }

    function saludar(){
        return "my name is $this->name $this->surname";
    }
}


$sergio = new person('Sergio', 'Cristobal');
echo $sergio->saludar();
if(isset($_POST['username'])){

    echo PHP_EOL . "the username is " . $_POST['username'];
}