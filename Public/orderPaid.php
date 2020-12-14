<?php

    session_start();
    require_once("../Private/database.php");

    $stmt = $con->prepare("SELECT products.id, products.product_code, products.name, products.description, products.specifications, products.price, products.stock, categories.name AS category FROM products LEFT JOIN categories ON categories.id = products.category_id");
    $stmt->execute();

    $products = $stmt->fetchAll(5);

    $cartItems = $_SESSION["cart"];

    if(empty($cartItems)) {
        header("location:index.php");
    }

?>
<html>
    <head>
        <title>Bedankt! - Danio Components</title>
        <link rel="shortcut icon" href="images/favicon.ico">
        <link rel="stylesheet" href="styleSheet.css">
    </head>
    <body>
        <?php include("header.php"); ?>
            <div class="PageContentBg">
                <h2 class='thanksLabel'>Bedankt voor uw bestelling!</h2>
                <h4 class='thanksDescLabel'>U ontvangt binnen enkele minuten geen bevestigingsmail van uw bestelling.</h4>
                </br>
                <div class="orderPaidTable table-responsive">
                    <?php
                        if(!empty($_SESSION["cart"]))
                        {
                            echo "<table class='table-bordered table table-striped'>";
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
                                        echo "<td>" . $cartItems[$i][1] . "</td>";
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
                        echo "<h3 class='totalPrice'>Totaal bestelling: €" . $totalPrice . ",-</h3>"; 
                    ?>
                </div>
            </div> 
        <?php include("footer.php"); ?>
    </body>
</html>
<?php $_SESSION["cart"] = array(); $_SESSION["TotalPrice"] = 0; ?>