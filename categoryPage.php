<?php

    require_once("database.php");

    if(isset($_GET["category"])) {
        $stmt = $con->prepare("SELECT * FROM categories WHERE categories.name=?");
        $stmt->bindValue(1, $_GET["category"]);

        $stmt->execute();
        $category = $stmt->fetchObject();
    }

    if(isset($_GET["search"])) {
        if(isset($_GET["order"])) {
            if($_GET["order"] == "asc") {
                $stmt = $con->prepare("SELECT products.id, products.product_code, products.name, products.description, products.specifications, products.price, products.stock, categories.name AS category FROM products LEFT JOIN categories ON categories.id = products.category_id WHERE products.name LIKE ? ORDER BY products.price ASC");
            } elseif($_GET["order"] == "desc") {
                $stmt = $con->prepare("SELECT products.id, products.product_code, products.name, products.description, products.specifications, products.price, products.stock, categories.name AS category FROM products LEFT JOIN categories ON categories.id = products.category_id WHERE products.name LIKE ? ORDER BY products.price DESC");
            }
        } else {
            $stmt = $con->prepare("SELECT products.id, products.product_code, products.name, products.description, products.specifications, products.price, products.stock, categories.name AS category FROM products LEFT JOIN categories ON categories.id = products.category_id WHERE products.name LIKE ? OR products.product_code LIKE ?");
            $stmt->bindValue(2, "%" . $_GET["search"] . "%");
        }

        $stmt->bindValue(1, "%" . $_GET["search"] . "%");
    } else {
        if(isset($_GET["order"])) {
            if($_GET["order"] == "asc") {
                $stmt = $con->prepare("SELECT products.id, products.product_code, products.name, products.description, products.specifications, products.price, products.stock, categories.name AS category FROM products LEFT JOIN categories ON categories.id = products.category_id WHERE categories.name=? ORDER BY products.price ASC");
            } elseif($_GET["order"] == "desc") {
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
        <title><?php if(isset($_GET["search"])) { echo '"' . $_GET["search"] . '"'; } else { echo $category->display_name; } ?> - Danio Components</title>
        <link rel="stylesheet" href="styleSheet.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body>
        <?php include("header.php") ?>
            <div class="TopPageContentBg">
                <strong><p class="categoryPageName"><?php if(isset($_GET["search"])) { echo 'Zoekresultaten voor "' . $_GET["search"] . '":'; } else { echo $category->display_name; } ?></p></strong>
                <p class="categoryPageDesc"><?php if(isset($_GET["search"])) { if(count($products) == 1) { echo "Er is " . count($products) . " resultaat gevonden. "; } else { echo "Er zijn " . count($products) . " resultaten gevonden."; } echo " Niet wat u zocht? Kijk eens naar de categorieen op de <a href='index.php'>homepagina</a>."; } else { echo $category->description; } ?></p>
            </div>
            <div class="PageContentBg">
                <?php 
                    if(empty($products)) {
                        echo "<div><h4 style='text-align:center;color:darkred;'>Geen producten gevonden!</h4><br>";
                        echo "<a href='index.php' style='color:white; width:20%; margin-left:40%;' class='btn btn-primary'>Ga terug naar home</a></div>";
                    } else {
                        if(count($products) > 1) {
                            if(isset($_GET["category"])) {
                                echo "<input class='mb-4 mr-3 btn btn-primary' type='button' onclick='location.href=`?category=" . $_GET["category"] . "`;' value='Standaard'>";
                                echo "<input class='mb-4 mr-3 btn btn-secondary' type='button' onclick='location.href=`?category=" . $_GET["category"] . "&order=asc`;' value='Prijs laag - hoog'>";
                                echo "<input class='mb-4 mr-3 btn btn-secondary' type='button' onclick='location.href=`?category=" . $_GET["category"] . "&order=desc`;' value='Prijs hoog - laag'>";
                            } elseif(isset($_GET["search"])) {
                                echo "<input class='mb-4 mr-3 btn btn-primary' type='button' onclick='location.href=`?search=" . $_GET["search"] . "`;' value='Standaard'>";
                                echo "<input class='mb-4 mr-3 btn btn-secondary' type='button' onclick='location.href=`?search=" . $_GET["search"] . "&order=asc`;' value='Prijs laag - hoog'>";
                                echo "<input class='mb-4 mr-3 btn btn-secondary' type='button' onclick='location.href=`?search=" . $_GET["search"] . "&order=desc`;' value='Prijs hoog - laag'>";
                            }
                        }
                        
                        echo "<div class='product-grid-container'>";
                            foreach($products as $product) {
                                echo "<div class='product' onclick='location.href=`productPage.php?product=$product->product_code`'>";
                                    echo "<div class='productName'>$product->name</div>";
                                    echo "<img class='productImage' src='products/$product->category/$product->product_code.jpg' onerror=\"this.onerror=null; this.src='images/not_found.jpg'\">";
                                    if(!$product->stock > 0) {
                                        echo "<div style='color:grey' class='productPrice'>€$product->price,-</div>";
                                        echo "<div style='color:salmon' class='productStock'>Voorraad: $product->stock</div>";
                                        echo "<button class='btn btn-secondary productButton' style='line-height:100%; font-size:1vw;'>Kopen</button>";
                                    } else {
                                        echo "<div style='color:green' class='productPrice'>€$product->price,-</div>";
                                        echo "<div style='color:green' class='productStock'>Voorraad: $product->stock</div>";
                                        echo "<button class='btn btn-success productButton' style='line-height:100%; font-size:1vw;'>Kopen</button>";
                                    }
                                echo "</div>";
                            }
                        echo "</div>";
                    }
                ?>
            </div>
        <?php include("footer.php") ?>
    </body>
</html>
