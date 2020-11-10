<?php

    require_once("database.php");

    if(isset($_GET["category"])) {
        $stmt = $con->prepare("SELECT products.id, products.product_code, products.name, products.description, products.specifications, products.price, products.stock, categories.name AS category FROM products LEFT JOIN categories ON categories.id = products.category_id WHERE categories.name=?");
        $stmt->bindValue(1, $_GET["category"]);
    } else {
        $stmt = $con->prepare("SELECT products.id, products.product_code, products.name, products.description, products.specifications, products.price, products.stock, categories.name AS category FROM products LEFT JOIN categories ON categories.id = products.category_id");
    }

    //if(!empty($_SESSION["user"])){
        $stmtt = $con->prepare("SELECT id, firstname, lastname, `address`, email, phone, is_admin FROM users");
    //}

    $stmt->execute();
    $stmtt->execute();

    $products = $stmt->fetchAll(5);
    $users = $stmtt->fetchAll(5);

?>
<html>
    <head>
        <title>Admin - Danio Components</title>
    </head>
    <body>
        <?php include("header.php") ?>
            <div class="PageContentBg">
                <ul class="nav nav-tabs">
                    <li class="active"><a class="nav-link active" data-toggle="tab" href="#products">Products</a></li>
                    <li><a class="nav-link" data-toggle="tab" href="#users">Users</a></li>
                </ul>
                <div class="tab-content">
                    <div id="products" class="tab-pane active">
                        <br><input class="btn btn-success" type="button" onclick="location.href='createProduct.php';" value="Product Toevoegen"><br><br>
                        <input class="btn btn-primary" type="button" onclick="location.href='adminPage.php';" value="All Products">
                        <input class="btn btn-secondary" type="button" onclick="location.href='adminPage.php?category=graphics_card';" value="Graphics Cards">
                        <input class="btn btn-secondary" type="button" onclick="location.href='adminPage.php?category=processor';" value="Processors">
                        <input class="btn btn-secondary" type="button" onclick="location.href='adminPage.php?category=ram';" value="Ram">
                        <input class="btn btn-secondary" type="button" onclick="location.href='adminPage.php?category=motherboard';" value="Motherboards">
                        <input class="btn btn-secondary" type="button" onclick="location.href='adminPage.php?category=storage';" value="Storage SSD/HDD">
                        <input class="btn btn-secondary" type="button" onclick="location.href='adminPage.php?category=power_supply';" value="Power Supplies">
                        <input class="btn btn-secondary" type="button" onclick="location.href='adminPage.php?category=cpu_cooler';" value="CPU Coolers">
                        <input class="btn btn-secondary" type="button" onclick="location.href='adminPage.php?category=pc_case';" value="PC Cases"><br><br>
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
                    <div id="users" class="tab-pane fade">
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
                                        echo "<td><a href='updateUser.php?user_id=" . $user->id . "'>Wijzig</a></td>";
                                        echo "<td><a style='color:red;' href='deleteUser.php?user_id=" . $user->id . "'>Verwijder</a></td>";
                                        echo "</tr>";
                                    }
                                ?>
                            </tbody>
                        </table>    
                    </div>
                </div>
            </div>
        <?php include("footer.php") ?>
    </body>
</html>
