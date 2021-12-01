<?php
session_name('login');
session_start();
error_reporting(0);
?>
<div class="App-content-temporal-divs App-content-temporal-account">
    this is my account <?php echo $_SESSION['username'];?>
</div>