<?php

    require_once("database.php");

    $stmt = $con->prepare("SELECT products.id, products.product_code, products.name, products.description, products.specifications, products.price, products.stock, categories.name AS category FROM products LEFT JOIN categories ON categories.id = products.category_id WHERE product_code=?");
    $stmt->bindValue(1, $_GET["product"]);
    $stmt->execute();

    $product = $stmt->fetchObject();

    $data = $product->specifications;
    $specifications = json_decode($data, true);
    $properties = array_keys($specifications);

    $elements = count($specifications);

    $stmt = $con->prepare("SELECT products.id, products.product_code, products.name, products.description, products.specifications, products.price, products.stock, categories.name AS category FROM products LEFT JOIN categories ON categories.id = products.category_id WHERE product_code<>? ORDER BY RAND() LIMIT 4");
    $stmt->bindValue(1, $product->product_code);
    $stmt->execute();

    $altProducts = $stmt->fetchAll(5);
    
?>
<html>
    <head>
        <title><?php echo $product->name ?> - Danio Components</title>
        <link rel="shortcut icon" href="images/favicon.ico">
        <link rel="stylesheet" href="styleSheet.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php include("header.php"); ?>
            <div class="PageContentBg productPage-grid-container">
                <?php 
                    echo "<img class='productPageImage grid-item' src='products/$product->category/$product->product_code.jpg' onerror=\"this.onerror=null; this.src='images/not_found.jpg'\">";
                    echo "<div class='productInfoBg grid-item'>";
                        echo "<div class='productPageName'>$product->name</div>";
                        if(!$product->stock > 0) {
                            echo "<div style='color:grey' class='productPagePrice'>€$product->price,-</div>";
                            echo "<div style='color:salmon' class='productPageStock'>Voorraad: $product->stock</div>";
                            echo "<input class='btn btn-secondary productPageButton' type='button' value='Uitverkocht'>";
                        } else {
                            echo "<div style='color:green' class='productPagePrice'>€$product->price,-</div>";
                            echo "<div style='color:green' class='productPageStock'>Voorraad: $product->stock</div>";
                            echo "<form method='post' action='payOrder.php?addProduct=$product->product_code'>";
                                echo "<input class='btn btn-success productPageButton' type='submit' value='Kopen' onclick='location.href=payOrder.php?product=$product->product_code'>";
                            echo "</form>";
                        }
                        echo "<div class='productPageDescription'>$product->description</div>";
                        echo "<div class='specificationsTable'>";
                            echo "<table class='table table-striped' style='font-size:0.8vw;line-height:0.8vw;'>";
                                echo "<thead class='table-light'>";
                                    echo "<th>Specificatie</th>";
                                    echo "<th>Waarde</th>";
                                echo "</thead>";
                                echo "<tbody>";
                                    for ($i = 0; $i < $elements; $i++) {
                                        echo "<tr>";
                                            echo "<td>" . $properties[$i] . "</td><td>" . $specifications[$properties[$i]] . "</td>";
                                        echo "</tr>";
                                    }
                                    echo "<tr>";
                                        echo "<td>Product code</td><td>" . $product->product_code . "</td>";
                                    echo "</tr>";
                                    echo "<tr>";
                                        echo "<td>Category name</td><td>" . $product->category . "</td>";
                                    echo "</tr>";
                                echo "</tbody>";
                            echo "</table>";
                        echo "</div>";
                    echo "</div>";
                    echo "<div class='relevantProducts'>";
                        echo "<div class='alternativeText'>Kijk ook eens naar onze andere producten:</div><br>";
                        echo "<div class='product-grid-container'>";
                            foreach($altProducts as $altProduct) {
                                echo "<div class='product' onclick='location.href=`productPage.php?product=$altProduct->product_code`'>";
                                    echo "<div class='productName'>$altProduct->name</div>";
                                    echo "<img class='productImage' src='products/$altProduct->category/$altProduct->product_code.jpg' onerror=\"this.onerror=null; this.src='images/not_found.jpg'\">";
                                    if(!$altProduct->stock > 0) {
                                        echo "<div style='color:grey' class='productPrice'>€$altProduct->price,-</div>";
                                        echo "<div style='color:salmon' class='productStock'>Voorraad: $altProduct->stock</div>";
                                        echo "<button class='btn btn-secondary productButton' style='line-height:100%; font-size:1vw;'>Kopen</button>";
                                    } else {
                                        echo "<div style='color:green' class='productPrice'>€$altProduct->price,-</div>";
                                        echo "<div style='color:green' class='productStock'>Voorraad: $altProduct->stock</div>";
                                        echo "<button class='btn btn-success productButton' style='line-height:100%; font-size:1vw;'>Kopen</button>";
                                    }
                                echo "</div>";
                            }
                        echo "</div>";
                    echo "</div>";
                ?>
            </div>
        <?php include("footer.php") ?>
    </body>
</html>
<?php

    if($_POST) {
        header("location:payOrder.php?addProduct=$product->product_code");
    }

?>