<?php

    require_once("database.php");

    $stmt = $con->prepare("SELECT * FROM categories WHERE categories.name=?");
    $stmt->bindValue(1, $_GET["category"]);
    $stmt->execute();

    $category = $stmt->fetchObject();

    $stmt = $con->prepare("SELECT products.id, products.product_code, products.name, products.description, products.specifications, products.price, products.stock, categories.name AS category FROM products LEFT JOIN categories ON categories.id = products.category_id WHERE categories.name=?");
    $stmt->bindValue(1, $_GET["category"]);
    $stmt->execute();

    $products = $stmt->fetchAll(5);

?>
<html>
    <head>
        <title><?php echo $category->display_name; ?> - Danio Components</title>
        <link rel="stylesheet" href="styleSheet.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body>
        <?php include("header.php") ?>
            <div class="PageContentBg">
                <div class="product-grid-container">
                    <?php 
                        foreach($products as $product) {
                            echo "<div class='product' onclick='location.href=`productPage.php?product=$product->product_code`'>";
                                echo "<div class='productName'>$product->name</div>";
                                echo "<img class='productImage' src='products/$product->category/$product->product_code.jpg' onerror=\"this.onerror=null; this.src='images/not_found.jpg'\">";
                                echo "<div class='productPrice'>€$product->price,-</div>";
                                echo "<div class='productStock'>Voorraad: $product->stock</div>";
                                echo "<button class='btn btn-success productButton'>Kopen</button>";
                            echo "</div>";
                        }
                    ?>
                </div>
            </div>
        <?php include("footer.php") ?>
    </body>
</html>
