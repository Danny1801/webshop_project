<?php

    require_once("database.php");

    //$stmt = $con->prepare("SELECT * FROM products WHERE product_code=?");
    $stmt = $con->prepare("SELECT products.id, products.product_code, products.name, products.description, products.specifications, products.price, products.stock, categories.name AS category FROM products LEFT JOIN categories ON categories.id = products.category_id WHERE product_code=?");
    $stmt->bindValue(1, "1112"); // Zet hier de product_code van het product die je als featured wil hebben
    $stmt->execute();

    $featuredProduct = $stmt->fetchObject();

    $stmt = $con->prepare("SELECT * FROM categories LIMIT 4");
    $stmt->execute();

    $categories = $stmt->fetchAll(5);

//var_dump($_POST["search"]);
    if(isset($_POST["search"])) { // AANPASSEN
        $searchTag = $_POST["search"];
        header("location:categoryPage.php?search=" . $searchTag);
        echo "asdfkajsdfhfkjasdhjfkjas";
    }

?>
<html>
    <head>
        <title>Home - Danio Components</title>
        <link rel="stylesheet" href="styleSheet.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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
