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
        $newSpecs = array();

        $_POST["specifications"] = array_combine(range(1, count($_POST["specifications"])), array_values($_POST["specifications"]));
        
        for($i = 1; $i <= count($_POST["specifications"]); $i++) {
            if(isset($_POST["specifications"][$i])) {
                $val1 = $_POST["specifications"][$i];
            
                if(!empty($_POST["specifications"][$i]) && $_POST["specifications"][$i] != null) {
                    $i++;
                    $val2 = $_POST["specifications"][$i];
                    
                    if(!empty($_POST["specifications"][$i]) && $_POST["specifications"][$i] != null) {
                        array_push($newSpecs, array($val1 => $val2));
                    }
                }
            }
        }

        $jsonSpecs = json_encode($newSpecs);
        $jsonSpecs = "{" . str_replace('[', '', str_replace(']', '', str_replace('{', '', str_replace('}', '', $jsonSpecs)))) . "}";
        var_dump($jsonSpecs);
        
        $stmt = $con->prepare("UPDATE products SET product_code=?, `name`=?, `description`=?, specifications=?, price=?, stock=?, category_id=? WHERE product_code=?");
		$stmt->bindValue(1, htmlspecialchars($_POST["product_code"]));
		$stmt->bindValue(2, htmlspecialchars($_POST["name"]));
		$stmt->bindValue(3, htmlspecialchars($_POST["description"]));
		$stmt->bindValue(4, strip_tags($jsonSpecs));
		$stmt->bindValue(5, htmlspecialchars($_POST["price"]));
		$stmt->bindValue(6, $_POST["stock"]);
		$stmt->bindValue(7, $_POST["category"]);
		$stmt->bindValue(8, $_GET["product"]);

        $stmt->execute();
        
        header("location:updateProduct.php?product=$product->product_code");
    }

?>
<html>
    <head>
        <title>Edit <?php echo $product->name?> - Danio Components</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../images/favicon.ico">
    </head>
    <body>
        <?php include("header2.php") ?>
        <div class="PageContentBg">
            <form method="POST">
                <div style="color:red;">Let op! Product code is de naam van de foto</div><br>
                <table class="table table-striped">
                    <thead class="table table-light"><th>Algemeen</th><th></th></thead>
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
                        <thead class="table table-light"><th>Specificaties<button type="button" class="ml-5 btn-success" onclick="addElement()">Rij Toevoegen</button></th><th></th></thead>
                        <tbody id="addRowId">
                        <tr>
                            <td>Naam</td>
                            <td>Waarde</td>
                            <?php 

                                $specificationsArray = str_replace('"', '', str_replace('{', '', str_replace('}', '', str_replace('",', '".', $product->specifications))));
                                $specifications = explode('.', $specificationsArray);
                                $specCount = 0;
                                $element = 1;

                                foreach($specifications as $specification) {
                                    $spec = explode(':', $specification);
                                    $specCount++;
                                    echo "<tr id='row$element'>";
                                    echo "<td><input type='text' name='specifications[$specCount]' maxlength='60' size='30' value='" . trim($spec[0]) . "'</td>";
                                    $specCount++;
                                    echo "<td><input type='text' name='specifications[$specCount]' maxlength='60' size='30' value='" . trim($spec[1]) . "'</td>";
                                    echo "<button type='button' class='ml-3 btn-danger' onclick=removeElement('row" . $element . "')>Verwijderen</button>";
                                    echo "</tr>";
                                    $element++;
                                }

                            ?>
                        </tr>
                        </tbody>
                        <thead class="table table-light"><th>Overig</th><th></th></thead>
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
<script>

    function addElement() {
        document.getElementById("addRowId").innerHTML += "<tr id='row<?php echo $element ?>'><td><input type='text' name='specifications[<?php $specCount++; echo $specCount ?>]' maxlength='60' size='30' value=''</td><td><input type='text' name='specifications[<?php $specCount++; echo $specCount ?>]' maxlength='60' size='30' value=''</td><button type='button' class='ml-3 btn-danger' onclick=removeElement('row<?php echo $element ?>')>Verwijderen</button></tr>";
    }

    function removeElement(elementId) {
        var element = document.getElementById(elementId);
        element.parentNode.removeChild(element);
    }

</script>
