<?php

    require_once("../database.php");
        
    $stmt = $con->prepare("DELETE FROM products WHERE product_code=?");
    $stmt->bindValue(1, $_GET["product"]);
    $stmt->execute();

    header("location:adminPage.php");

?>