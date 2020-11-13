<?php

    session_start();
    require_once("database.php");

    $stmt = $con->prepare("SELECT products.id, products.product_code, products.name, products.description, products.specifications, products.price, products.stock, categories.name AS category FROM products LEFT JOIN categories ON categories.id = products.category_id");
    $stmt->execute();

    $products = $stmt->fetchAll(5);

    $cartItems = $_SESSION["cart"];

?>
<html>
    <?php include("header.php"); ?>
<head>
    <link rel="stylesheet" href="styleSheet.css">
</head>
    <body>
        </br>
        <div class="PageContentBg">
            <?php
                echo "<h2 id='thanks'>Bedankt voor je bestelling</h2>";
                echo "</br>";
            ?>
            <div id="orderpaid">
            <?php
                if(!empty($_SESSION["cart"]))
                {
                    echo "<table class='table table-striped table-responsive'>";
                            echo "<thead>";
                                echo "<th>Product</th>";
                                echo "<th>Naam</th>";
                                echo "<th>Prijs</th>";
                                echo "<th>Hoeveelheid</th>";
                            echo "</thead>";
                        echo "<tbody>";    
                } 

                $totalPrice = 0;
                    $cartItemCount = sizeof($cartItems);
                    foreach($products as $product) {
                        for($i = 0; $i <= $cartItemCount - 1; $i++) {
                            if($product->product_code == $cartItems[$i][0]) {
                                echo "<tr>";
                                echo "<td><img class='tableProductImage' src='products/$product->category/$product->product_code.jpg' onerror=\"this.onerror=null; this.src='images/not_found.jpg'\"></td>";
                                echo "<td><a href='productPage.php?product=$product->product_code'>$product->name</a></td>";
                                echo "<td>€" . $product->price . "</td>";
                                echo "<td><input type='number' id='$product->product_code' style='width:100px;' value='" . $cartItems[$i][1] . "'></td>";
                                echo "</tr>";
                                echo "</br>";
                                $totalPrice += ($product->price * $cartItems[$i][1]);
                            }
                        }
                    }

                if(!empty($_SESSION["cart"])) {
                    echo "</tbody>";
                    echo "</table>";
                    
                }
            ?>
            </div>
            <div id="total">
                <?php
                    echo"</br>";
                    echo "<h3 style='text-align:center;color:green;'>Totaal: €" . $totalPrice . ",-</h3>"; 
                ?>
            </div>
        </div> 
    </body>
        <?php include("footer.php"); ?>
</html>

