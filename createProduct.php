<?php

	require_once("database.php");
	
	$stmt = $con->prepare("SELECT * FROM categories");
	$stmt->execute();

	$categories = $stmt->fetchAll(5);

	if($_POST) {
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
	}

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
                <form method="POST">
                    <div style="color:salmon;">Let op! Product code is de naam van de foto</div>
                    Product code <input type="text" name="product_code"><br>
                    Name <input type="text" name="name"><br>
                    Description <input type="text" name="description"><br>
                    Specifications <input type="text" name="specifications"><br>
                    Price <input type="number" name="price"><br>
                    Stock <input type="number" name="stock"><br>
                    Category <select name="category">
                        <?php
                            foreach($categories as $category) {
                                echo "<option value=" . $category->id . ">" . $category->name . "</option>";
                            }
                        ?>
                    </select><br>
                    <input class=" btn btn-success" type="submit" onclick="location.href='createProduct.php';" value="Product Toevoegen">
                </form>
            </div>
        <?php include("footer.php") ?>
	</body>
</html>