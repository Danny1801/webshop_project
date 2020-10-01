<?php

    require_once("database.php");

    $stmt = $con->prepare("SELECT * FROM products");
    $stmt->execute();

    $products = $stmt->fetchAll(5);

?>
<html>
    <head>
        <link rel="stylesheet" href="styleSheet.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body>
        <?php include("header.php") ?>
            <div class="PageContentBg">
                <?php 
                    foreach($products as $product) {
                        echo "<div class='product' onclick='location.href=`productPage.php?product=$product->product_code`'>";
                            echo "<div class='productName'>$product->name</div>";
                            echo "<img class='productImage' src='products/$product->category/$product->product_code.jpg'>";
                            echo "<div class='productPrice'>€$product->price,-</div>";
                            echo "<div class='productStock'>Voorraad: $product->stock</div>";
                            echo "<button class='btn btn-success productButton'>Kopen</button>";
                        echo "</div>";
                    }
                ?>
            </div>
        <?php include("footer.php") ?>
    </body>
</html>
