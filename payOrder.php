<?php

    require_once("database.php");

    $stmt = $con->prepare("SELECT products.id, products.product_code, products.name, products.description, products.specifications, products.price, products.stock, categories.name AS category FROM products LEFT JOIN categories ON categories.id = products.category_id");
    $stmt->execute();

    $products = $stmt->fetchAll(5);

    if(isset($_GET["addProduct"])) {
        $addProduct = $_GET["addProduct"];
        if(array_search($_SESSION["cart"], $addProduct)) {
            array_replace($_SESSION["cart"]);
        } else {
            $newProduct["name"] = array($addProduct => 1);
            array_push($_SESSION["cart"], $newProduct["name"]);
        }
        header("location:productPage.php?product=$addProduct");
    }

    if(isset($_GET["updateQuantity"])) {
        $updatedProduct = $_GET["product"];
        header("location:payOrder.php");
    }
    $_SESSION["cart"] = array();
    var_dump($_SESSION["cart"]);
    $cartItems = $_SESSION["cart"];

?>
<html>
    <head>
        <title>Home - Danio Components</title>
        <link rel="stylesheet" href="styleSheet.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php include("header.php") ?>
            <div class="PageContentBg">
                <table class="table table-striped table-responsive">
                    <thead>
                        <th>Product</th>
                        <th>Naam</th>
                        <th>Prijs</th>
                        <th>Hoeveelheid</th>
                        <th>Verwijderen</th>
                    </thead>
                    <tbody>
                        <?php 
                            $totalPrice = 0;
                            $cartItemCount = sizeof($cartItems);
                            foreach($products as $product) {
                                if(array_search($product->product_code, $cartItems)) {
                                    for($i = 0; $i <= $cartItemCount - 1; $i++) {
                                        if($cartItems[$i] != 0) {
                                            echo "<tr>";
                                            echo "<td><img class='tableProductImage' src='products/$product->category/$product->product_code.jpg' onerror=\"this.onerror=null; this.src='images/not_found.jpg'\"></td>";
                                            echo "<td><a href='productPage.php?product=$product->product_code'>$product->name</a></td>";
                                            echo "<td>€" . $product->price . "</td>";
                                            echo "<td><input type='number' id='$product->product_code' style='width:100px;' value='" . count(array_search($product->product_code, $cartItems[0])) . "'></td>";
                                            echo "<td><a style='color:red;' href='product=" . $product->product_code . "'>Verwijder</a></td>";
                                            echo "</tr>";
                                            $totalPrice += $product->price;
                                        }
                                        //unset($product);
                                    }
                                }
                            }
                        ?>
                    </tbody>
                </table>
                <?php 
                
                    echo "Totaal: €" . $totalPrice; 
                
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