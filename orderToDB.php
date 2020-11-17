<?php

    if(!isset($_SESSION)) {
        session_start();
    }
    
    require_once("database.php");

    if($_SESSION["login"] == 1) {
        $login = $_SESSION["user"]->id;
    } else {
        $login = "-";
    }

    $stmt = $con->prepare("INSERT INTO orders (`user_id`, product_codes, total_price, `date`) VALUES(? ,?, ?, ?)");
    $stmt->bindValue(1, $login);
    $stmt->bindValue(2, json_encode($_SESSION["cart"]));
    $stmt->bindValue(3, $_SESSION["TotalPrice"]);
    $stmt->bindValue(4, date('Y-m-d h:i:s'));

    $stmt->execute();

    $cartItems = $_SESSION["cart"];
    $cartItemCount = sizeof($cartItems);

    for($i = 0; $i <= $cartItemCount - 1; $i++) {
        $stmt = $con->prepare("UPDATE products SET stock=stock-? WHERE product_code=?");
        $stmt->bindValue(1, $cartItems[$i][1]);
        $stmt->bindValue(2, $cartItems[$i][0]);
        $stmt->execute();
    }

    header("location:orderPaid.php");

?>