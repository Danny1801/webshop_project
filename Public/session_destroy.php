<?php
    session_start();
    $_SESSION["login"] = 0;
    $_SESSION["user"] = "";
    header("Location:index.php");
?>

