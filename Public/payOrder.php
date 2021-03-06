<?php
    
    if(!isset($_SESSION)) {
        session_start();
    }

    require_once("../Private/database.php");

    $stmt = $con->prepare("SELECT products.id, products.product_code, products.name, products.description, products.specifications, products.price, products.stock, categories.name AS category FROM products LEFT JOIN categories ON categories.id = products.category_id");
    $stmt->execute();

    $products = $stmt->fetchAll(5);

    if(isset($_GET["addProduct"])) {
        $addProduct = $_GET["addProduct"];
        $inArray = false;

        foreach($_SESSION["cart"] as $key => $value) {
            if(in_array($addProduct, $value)) {
                echo $_SESSION["cart"][$key][1];
                $_SESSION["cart"][$key][1] += 1;
                //header("location:payOrder.php");
                $inArray = true;
            }
        }
        
        if(!$inArray) {
            array_push($_SESSION["cart"], array($addProduct, 1));
        }
        
        header("location:productPage.php?product=$addProduct");
    }

    if(!empty($_SESSION["cart"])) {
        foreach($_SESSION["cart"] as $key => $value) {
            if($_SESSION["cart"][$key][1] <= 0) {
                unset($_SESSION["cart"][$key]);
                $_SESSION["cart"] = array_values($_SESSION["cart"]);
                $key = 0;
                header("location:payOrder.php");
            }
        }
    }

    if(isset($_GET["updateQuantity"])) {
        $updateQuantity = $_GET["updateQuantity"];
        $updateProduct = $_GET["product"];

        foreach($_SESSION["cart"] as $key => $value) {
            if(in_array($updateProduct, $value)) {
                echo $_SESSION["cart"][$key][1];
                $_SESSION["cart"][$key][1] = (int)$updateQuantity;
                header("location:payOrder.php");
            }
        }
    }

    if(isset($_GET["removeProduct"])) {
        $removeProduct = $_GET["removeProduct"];

        foreach($_SESSION["cart"] as $key => $value) {
            if(in_array($removeProduct, $value)) {
                unset($_SESSION["cart"][$key]);
                $_SESSION["cart"] = array_values($_SESSION["cart"]);
                header("location:payOrder.php");
            }
        }
    }

    if(isset($_GET["stockErr"])) {
        foreach($products as $product) {
            if($product->product_code == $_GET["stockErr"]) {
                $errProduct = $product->name;
                echo "<script type='text/javascript'>alert('Product `" . trim($errProduct) . "` heeft nog maar een voorraad van " . $product->stock . ". Verander de hoeveelheid van dit product om uw bestelling te kunnen plaatsen.');</script>";
            }
        }
    }

    $cartItems = $_SESSION["cart"];

?>
<html>
    <head>
        <title>Winkelwagen - Danio Components</title>
        <link rel="shortcut icon" href="images/favicon.ico">
        <link rel="stylesheet" href="styleSheet.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php include("header.php") ?>
            <div class="PageContentBg">
                <?php 
                    if(!empty($cartItems)) {
                        echo "<div class='table-responsive'>";
                        echo "<table class='table-bordered table table-striped text-center text-center'>";
                            echo "<thead>";
                                echo "<th>Product</th>";
                                echo "<th>Naam</th>";
                                echo "<th>Prijs</th>";
                                echo "<th>Hoeveelheid</th>";
                                echo "<th>Verwijderen</th>";
                            echo "</thead>";
                            echo "<tbody>";
                    } else {
                        echo "<div><h4 style='text-align:center;color:darkred;'>Uw winkelmandje is leeg!</h4><br>";
                        echo "<a href='index.php' style='color:white; width:20%; margin-left:40%;' class='btn btn-primary'>Ga terug naar home</a></div>";
                    }

                    $_SESSION["TotalPrice"] = 0;
                    $cartItemCount = sizeof($cartItems);
                    foreach($products as $product) {
                        for($i = 0; $i <= $cartItemCount - 1; $i++) {
                            if($product->product_code == $cartItems[$i][0]) {
                                echo "<tr>";
                                echo "<td><img class='tableProductImage' src='products/$product->category/$product->product_code.jpg' onerror=\"this.onerror=null; this.src='images/not_found.jpg'\"></td>";
                                echo "<td><a href='productPage.php?product=$product->product_code'>$product->name</a></td>";
                                echo "<td>€" . $product->price . "</td>";
                                echo "<td><input type='number' id='$product->product_code' style='width:100px;' value='" . $cartItems[$i][1] . "'></td>";
                                echo "<td><a style='color:red;' href='payOrder.php?removeProduct=" . $product->product_code . "'>Verwijder</a></td>";
                                echo "</tr>";
                                $_SESSION["TotalPrice"] += ($product->price * $cartItems[$i][1]);
                            }
                        }
                    }

                    if(!empty($cartItems)) {
                            echo "</tbody>";
                        echo "</table>";
                        echo "</div>";
                        echo "<h3 class='totalPrice'>Totaal winkelwagen: €" . $_SESSION['TotalPrice'] . ",-</h3>"; 
                        echo "</br>";
                        echo "<a href='../Private/orderToDB.php' class='btn btn-success payOrderButton'>Afrekenen</a></div>";
                    }

                ?>
            </div>
        <?php include("footer.php") ?>
    </body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

    $(document).ready(function(){
        $("input").change(function(){
            window.location.replace("payOrder.php?updateQuantity=" + this.value + "&product=" + this.id);
        });
    });

</script>