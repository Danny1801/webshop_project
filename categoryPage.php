<?php

    require_once("database.php");

    if(isset($_GET["category"])) {
        $stmt = $con->prepare("SELECT * FROM categories WHERE categories.name=?");
        $stmt->bindValue(1, $_GET["category"]);

        $stmt->execute();
        $category = $stmt->fetchObject();
    }

    if(isset($_GET["search"])) {
        /*if(isset($_GET["order"])) {
            if($_GET["order"] == "asc") {
                $stmt = $con->prepare("SELECT products.id, products.product_code, products.name, products.description, products.specifications, products.price, products.stock, categories.name AS category FROM products LEFT JOIN categories ON categories.id = products.category_id WHERE products.name LIKE ? ORDER BY products.price ASC");
            } else {
                $stmt = $con->prepare("SELECT products.id, products.product_code, products.name, products.description, products.specifications, products.price, products.stock, categories.name AS category FROM products LEFT JOIN categories ON categories.id = products.category_id WHERE products.name LIKE ? ORDER BY products.price DESC");
            }
        } else {*/
            $stmt = $con->prepare("SELECT products.id, products.product_code, products.name, products.description, products.specifications, products.price, products.stock, categories.name AS category FROM products LEFT JOIN categories ON categories.id = products.category_id WHERE products.name LIKE ?");
        //}

        $stmt->bindValue(1, "%" . $_GET["search"] . "%");
    } else {
        if(isset($_GET["order"])) {
            if($_GET["order"] == "asc") {
                $stmt = $con->prepare("SELECT products.id, products.product_code, products.name, products.description, products.specifications, products.price, products.stock, categories.name AS category FROM products LEFT JOIN categories ON categories.id = products.category_id WHERE categories.name=? ORDER BY products.price ASC");
            } else {
                $stmt = $con->prepare("SELECT products.id, products.product_code, products.name, products.description, products.specifications, products.price, products.stock, categories.name AS category FROM products LEFT JOIN categories ON categories.id = products.category_id WHERE categories.name=? ORDER BY products.price DESC");
            }
        } else {
            $stmt = $con->prepare("SELECT products.id, products.product_code, products.name, products.description, products.specifications, products.price, products.stock, categories.name AS category FROM products LEFT JOIN categories ON categories.id = products.category_id WHERE categories.name=?");
        }

        $stmt->bindValue(1, $_GET["category"]);
    }

    $stmt->execute();

    $products = $stmt->fetchAll(5);

?>
<html>
    <head>
        <title><?php if(isset($_GET["search"])) { echo $_GET["search"]; } else { echo $category->display_name; } ?> - Danio Components</title>
        <link rel="stylesheet" href="styleSheet.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body>
        <?php include("header.php") ?>
            <div class="TopPageContentBg">
                <strong><p class="categoryPageName"><?php if(isset($_GET["search"])) { echo 'Zoekresultaten voor "' . $_GET["search"] . '":'; } else { echo $category->display_name; } ?></p></strong>
                <p class="categoryPageDesc"><?php if(isset($_GET["search"])) { echo "[NUMBER OF RESULTS]"; } else { echo $category->description; } ?></p>
            </div> <!-- if not set search, dont show asc, desc buttons -->
            <div class="PageContentBg">
                <div class="product-grid-container">
                    <?php 
                        if(empty($products)) {
                            echo "<div><h4 style='text-align:center;color:darkred;'>Geen producten gevonden!</h4>";
                            echo "<a href='index.php' style='color:white; width:80%; margin-left:10%;' class='btn btn-primary'>Ga terug naar home</a></div>";
                        }
                        foreach($products as $product) {
                            echo "<div class='product' onclick='location.href=`productPage.php?product=$product->product_code`'>";
                                echo "<div class='productName'>$product->name</div>";
                                echo "<img class='productImage' src='products/$product->category/$product->product_code.jpg' onerror=\"this.onerror=null; this.src='images/not_found.jpg'\">";
                                echo "<div class='productPrice'>€$product->price,-</div>";
                                echo "<div class='productStock'>Voorraad: $product->stock</div>";
                                echo "<button class='btn btn-success productButton' style='line-height:100%; font-size:1vw;'>Kopen</button>";
                            echo "</div>";
                        }
                    ?>
                </div>
            </div>
        <?php include("footer.php") ?>
    </body>
</html>
