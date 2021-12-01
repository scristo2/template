<?php 
session_name('login');
session_start();
error_reporting(0);
ignore_user_abort(1);
setcookie("rememberSession"," ", time() - 3600, "/");
session_destroy();