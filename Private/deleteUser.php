<?php

    require_once("database.php");
        
    $stmt = $con->prepare("DELETE FROM users WHERE id=?");
    $stmt->bindValue(1, $_GET["user_id"]);
    $stmt->execute();

    header("location:adminPage.php");

?>