<?php

    require_once("database.php");

    if(isset($_GET["category"])) {
        $stmt = $con->prepare("SELECT products.id, products.product_code, products.name, products.description, products.specifications, products.price, products.stock, categories.name AS category FROM products LEFT JOIN categories ON categories.id = products.category_id WHERE categories.id=?");
        $stmt->bindValue(1, $_GET["category"]);
    } else {
        $stmt = $con->prepare("SELECT products.id, products.product_code, products.name, products.description, products.specifications, products.price, products.stock, categories.name AS category FROM products LEFT JOIN categories ON categories.id = products.category_id");
    }

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
            <input class=" btn btn-success" type="button" onclick="location.href='createProduct.php';" value="Product Toevoegen">
                <table class="table table-striped">
                    <thead>
                        <th>Id</th>
                        <th>Image</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Specifications</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Category</th>
                        <th>Wijzigen</th>
                        <th>Verwijderen</th>
                    </thead>
                    <tbody>
                        <?php 
                            foreach($products as $product) {
                                echo "<tr>";
                                echo "<td>" . $product->id . "</td>";
                                echo "<td><img class='tableProductImage' src='products/$product->category/$product->product_code.jpg'></td>";
                                echo "<td>" . $product->product_code . "</td>";
                                echo "<td>" . $product->name . "</td>";
                                echo "<td>" . $product->description . "</td>";
                                echo "<td>" . $product->specifications . "</td>";
                                echo "<td>" . $product->price . "</td>";
                                echo "<td>" . $product->stock . "</td>";
                                echo "<td>" . $product->category . "</td>";
                                echo "<td><a href='updateProduct.php?product=" . $product->product_code . "'>Wijzig</a></td>";
                                echo "<td><a href='deleteProduct.php?product=" . $product->product_code . "'>Verwijder</a></td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        <?php include("footer.php") ?>
    </body>
</html>
