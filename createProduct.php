<?php

    if(!isset($_SESSION)) {
        session_start();
        $_SESSION["cart"] = [];
    }

	require_once("database.php");
	
	$stmt = $con->prepare("SELECT * FROM categories");
	$stmt->execute();

	$categories = $stmt->fetchAll(5);

    if($_POST) {
        if($_POST["category"] != "-" && trim($_POST["product_code"]) && trim($_POST["name"]) && trim($_POST["description"]) && trim($_POST["specifications"]) && trim($_POST["price"]) && trim($_POST["stock"])) {
            $stmt = $con->prepare("INSERT INTO products (product_code, `name`, `description`, specifications, price, stock, category_id) VALUES(?, ?, ? ,? ,?, ?, ?)");
            $stmt->bindValue(1, $_POST["product_code"]);
            $stmt->bindValue(2, $_POST["name"]);
            $stmt->bindValue(3, $_POST["description"]);
            $stmt->bindValue(4, $_POST["specifications"]);
            $stmt->bindValue(5, $_POST["price"]);
            $stmt->bindValue(6, $_POST["stock"]);
            $stmt->bindValue(7, $_POST["category"]);

            $stmt->execute();

            header("location:index.php");
        } else {
            echo "<script type='text/javascript'>alert('Alle velden moeten ingevuld zijn!');</script>";
        }
	}

?>
<html>
    <head>
        <title>Product Toevoegen - Danio Components</title>
        <link rel="stylesheet" href="styleSheet.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
	<body>
        <?php include("header.php") ?>
            <div class="PageContentBg">
                <form method="POST">
                    <div style="color:red;">Let op! Product code is de naam van de foto</div><br>
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td>Product code</td>
                                <td><input type="text" name="product_code" maxlength="45"></td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td><input type="text" name="name" maxlength="60" size="50"></td>
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td><textarea cols="80" rows="5" name="description"></textarea></td>
                            </tr>
                            <tr>
                                <td>Specifications</td>
                                <td><textarea cols="80" rows="2" name="specifications"></textarea></td>
                            </tr>
                            <tr>
                                <td>Price</td>
                                <td><input type="number" name="price"></td>
                            </tr>
                            <tr>
                                <td>Stock</td>
                                <td><input type="number" name="stock"></td>
                            </tr>
                            <tr>
                                <td>Category</td>
                                <td>
                                    <select name="category">
                                        <option>-</option>
                                        <?php
                                            foreach($categories as $category) {
                                                echo "<option value=" . $category->id . ">" . $category->name . "</option>";
                                            }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <input class="btn btn-success" type="submit" onclick="location.href='createProduct.php';" value="Product Aanmaken">
                </form>
            </div>
        <?php include("footer.php") ?>
	</body>
</html>