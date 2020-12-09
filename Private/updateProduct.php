<?php

    require_once("../database.php");
            
    $stmt = $con->prepare("SELECT * FROM products WHERE product_code=?");
    $stmt->bindValue(1, $_GET["product"]);
    $stmt->execute();

    $product = $stmt->fetchObject();

    $stmt = $con->prepare("SELECT * FROM categories");
	$stmt->execute();

	$categories = $stmt->fetchAll(5);

    if($_POST) {
        $stmt = $con->prepare("UPDATE products SET product_code=?, `name`=?, `description`=?, specifications=?, price=?, stock=?, category_id=? WHERE product_code=?");
		$stmt->bindValue(1, htmlspecialchars($_POST["product_code"]));
		$stmt->bindValue(2, htmlspecialchars($_POST["name"]));
		$stmt->bindValue(3, htmlspecialchars($_POST["description"]));
		$stmt->bindValue(4, strip_tags($_POST["specifications"]));
		$stmt->bindValue(5, htmlspecialchars($_POST["price"]));
		$stmt->bindValue(6, $_POST["stock"]);
		$stmt->bindValue(7, $_POST["category"]);
		$stmt->bindValue(8, $_GET["product"]);

        $stmt->execute();
        
        header("location:adminPage.php");
    }

?>
<html>
    <head>
        <title>Edit <?php echo $product->name?> - Danio Components</title>
        <link rel="stylesheet" href="../styleSheet.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../favicon.ico">
    </head>
    <body>
        <?php include("header2.php") ?>
        <div class="PageContentBg">
            <form method="POST">
                <div style="color:red;">Let op! Product code is de naam van de foto</div><br>
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td>Product code</td>
                            <td><input type="text" name="product_code" maxlength="45" value="<?php echo $product->product_code ?>"></td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td><input type="text" name="name" maxlength="60" size="50" value="<?php echo $product->name ?>"></td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td><textarea cols="80" rows="5" name="description"><?php echo $product->description ?></textarea></td>
                        </tr>
                        <tr>
                            <td>Specifications</td>
                            <td><textarea cols="80" rows="2" name="specifications"><?php echo $product->specifications ?></textarea></td>
                        </tr>
                        <tr>
                            <td>Price</td>
                            <td><input type="number" name="price" value="<?php echo $product->price ?>"></td>
                        </tr>
                        <tr>
                            <td>Stock</td>
                            <td><input type="number" name="stock" value="<?php echo $product->stock ?>"></td>
                        </tr>
                        <tr>
                            <td>Category</td>
                            <td>
                                <select name="category">
                                    <?php
                                        foreach($categories as $category) {
                                            if($product->category_id == $category->id) {
                                                echo "<option selected value=" . $category->id . ">" . $category->name . "</option>";
                                            } else {
                                                echo "<option value=" . $category->id . ">" . $category->name . "</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <input class=" btn btn-success" type="submit" value="Wijzigingen Opslaan">
            </form>
        </div>
        <?php include("footer2.php") ?>
    </body>
</html>