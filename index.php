<?php

    require_once("database.php");

    //$a = array("1234", "8765", "5678", "1112", "9090");
    //shuffle($a);

    $stmt = $con->prepare("SELECT products.id, products.product_code, products.name, products.description, products.specifications, products.price, products.stock, categories.name AS category FROM products LEFT JOIN categories ON categories.id = products.category_id ORDER BY RAND() LIMIT 1");
    $stmt->execute();

    $featuredProduct = $stmt->fetchObject();

    //$stmt = $con->prepare("SELECT products.id, products.product_code, products.name, products.description, products.specifications, products.price, products.stock, categories.name AS category FROM products LEFT JOIN categories ON categories.id = products.category_id WHERE product_code=?");
    //$stmt->bindValue(1, "0001"); // Zet hier de product_code van het product die je als featured wil hebben
    //$stmt->execute();

    //$featuredProduct = $stmt->fetchObject();

    $stmt = $con->prepare("SELECT * FROM categories LIMIT 8");
    $stmt->execute();

    $categories = $stmt->fetchAll(5);

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
                <?php 
                    echo "<div class='featured indexFeatured-grid-container' onclick='location.href=`productPage.php?product=$featuredProduct->product_code`'>";
                        echo "<img class='featuredImage' src='products/$featuredProduct->category/$featuredProduct->product_code.jpg' onerror=\"this.onerror=null; this.src='images/not_found.jpg'\">";
                        echo "<div class='featuredInfoBg'>";
                            echo "<div class='featuredName'>Nieuw in onze collectie <br>$featuredProduct->name</div>";
                            echo "<div class='featuredDescription'>$featuredProduct->description</div>";
                            echo "<button class='btn btn-success featuredButton' style='font-size:1vw;'>Product Bekijken</button>";
                        echo "</div>";
                    echo "</div>";

                    echo "<div class='categories-grid-container'>";
                        foreach($categories as $category) {
                            echo "<div class='category' onclick='location.href=`categoryPage.php?category=$category->name`'>";
                                echo "<div class='categoryName'>$category->display_name</div>";
                                echo "<img class='categoryImage' src='images/$category->name.jpg' onerror=\"this.onerror=null; this.src='images/not_found.jpg'\">";
                                echo "<strong><div class='categoryDescription'>$category->tiny_desc</div></strong>";
                                echo "<button class='btn btn-success categoryButton' style='line-height:100%; font-size:1vw;'>Bekijken</button>";
                            echo "</div>";
                        }
                    echo "</div>";
                ?>
            </div>
        <?php include("footer.php") ?>
    </body>
</html>
