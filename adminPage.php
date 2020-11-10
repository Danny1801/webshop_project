<?php

    require_once("database.php");

    if(isset($_GET["category"])) {
        $stmt = $con->prepare("SELECT products.id, products.product_code, products.name, products.description, products.specifications, products.price, products.stock, categories.name AS category FROM products LEFT JOIN categories ON categories.id = products.category_id WHERE categories.id=?");
        $stmt->bindValue(1, $_GET["category"]);
    } else {
        $stmt = $con->prepare("SELECT products.id, products.product_code, products.name, products.description, products.specifications, products.price, products.stock, categories.name AS category FROM products LEFT JOIN categories ON categories.id = products.category_id");
    }

    if(!empty($_SESSION["user"])){
        $stmt = $con->prepare("SELECT id, firstname, lastname, `address`, email, phone, is_admin FROM users");
    }

    $stmt->execute();

    $products = $stmt->fetchAll(5);
    $users = $stmt->fetchAll(5);

?>
<html>
    <head>
        <title>Admin - Danio Components</title>
        <link rel="stylesheet" href="styleSheet.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php include("header.php") ?>

            <div class="PageContentBg">
            <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#products">Products</a></li>
            <li><a data-toggle="tab" href="#users">Users</a></li>
            </ul>
            <div class="tab-content">
                <div id="products" class="tab-pane fade in active">
                    <input class=" btn btn-success" type="button" onclick="location.href='createProduct.php';" value="Product Toevoegen"><br><br>
                        <table class="table table-striped table-responsive">
                            <thead>
                                <th>Id</th>
                                <th>Foto</th>
                                <th>Code</th>
                                <th>Naam</th>
                                <th>Beschrijving</th>
                                <th>Specificaties</th>
                                <th>Prijs</th>
                                <th>Voorraad</th>
                                <th>Categorie</th>
                                <th>Wijzigen</th>
                                <th>Verwijderen</th>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach($products as $product) {
                                        echo "<tr>";
                                        echo "<td>" . $product->id . "</td>";
                                        echo "<td><img class='tableProductImage' src='products/$product->category/$product->product_code.jpg' onerror=\"this.onerror=null; this.src='images/not_found.jpg'\"></td>";
                                        echo "<td>" . $product->product_code . "</td>";
                                        echo "<td>" . $product->name . "</td>";
                                        echo "<td>" . $product->description . "</td>";
                                        echo "<td>" . $product->specifications . "</td>";
                                        echo "<td>" . $product->price . "</td>";
                                        echo "<td>" . $product->stock . "</td>";
                                        echo "<td>" . $product->category . "</td>";
                                        echo "<td><a href='updateProduct.php?product=" . $product->product_code . "'>Wijzig</a></td>";
                                        echo "<td><a style='color:red;' href='deleteProduct.php?product=" . $product->product_code . "'>Verwijder</a></td>";
                                        echo "</tr>";
                                    }
                                ?>
                            </tbody>
                        </table>    
                </div>
                <div id="users" class="tab-pane fade in active">
                    <table class="table table-striped table-responsive">
                            <thead>
                                <th>Id</th>
                                <th>Voornaam</th>
                                <th>Achternaam</th>
                                <th>Adres</th>
                                <th>Email</th>
                                <th>phone</th>
                                <th>Admin</th>
                                <th>Wijzigen</th>
                                <th>Verwijderen</th>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach($users as $user) {
                                        echo "<tr>";
                                        echo "<td>" . $user->id . "</td>";
                                        echo "<td>" . $user->firstname . "</td>";
                                        echo "<td>" . $user->lastname . "</td>";
                                        echo "<td>" . $user->address . "</td>";
                                        echo "<td>" . $user->email . "</td>";
                                        echo "<td>" . $user->phone . "</td>";
                                        echo "<td>" . $user->is_admin . "</td>";
                                        echo "<td><a href='updateUser.php?user=" . $user->id . "'>Wijzig</a></td>";
                                        echo "<td><a style='color:red;' href='deleteUser.php?user=" . $user->id . "'>Verwijder</a></td>";
                                        echo "</tr>";
                                    }
                                ?>
                            </tbody>
                        </div>
                    </table>    
                </div>    
                
            </div>
        <?php //include("footer.php") ?>
    </body>
</html>
<?php include("footer.php") ?>
