<?php

    session_start();
    
    if($_SESSION["login"] !== 1 || $_SESSION["user"]->is_admin == 0){
        header("location: index.php");
    }

?>
