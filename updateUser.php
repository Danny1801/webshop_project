<?php

    require_once("database.php");
            
    $stmt = $con->prepare("SELECT * FROM users WHERE id=?");
    $stmt->bindValue(1, $_GET["user_id"]);
    $stmt->execute();

    $user = $stmt->fetchObject();

    if($_POST) {
        $stmt = $con->prepare("UPDATE users SET firstname=?, lastname=?, `address`=?, email=?, phone=?, is_admin=? WHERE id=?");
		$stmt->bindValue(1, $_POST["firstname"]);
		$stmt->bindValue(2, $_POST["lastname"]);
		$stmt->bindValue(3, $_POST["address"]);
		$stmt->bindValue(4, $_POST["email"]);
		$stmt->bindValue(5, $_POST["phone"]);
		$stmt->bindValue(6, $_POST["is_admin"]);
		$stmt->bindValue(8, $_GET["user_id"]);

        $stmt->execute();
        
        header("location:adminPage.php");
    }

?>
<html>
    <head>
        <title>Edit <?php echo $product->name?> - Danio Components</title>
        <link rel="stylesheet" href="styleSheet.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php include("header.php") ?>
        <div class="PageContentBg">
            <form method="POST">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td>Firstname</td>
                            <td><input type="text" name="product_code" maxlength="45" value="<?php echo $user->firstname ?>"></td>
                        </tr>
                        <tr>
                            <td>Lastname</td>
                            <td><input type="text" name="name" maxlength="60" size="50" value="<?php echo $user->lastname ?>"></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td><input type="text" maxlength="60" size="50" name="description" value="<?php echo $user->address?>"></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><input type="text" maxlength="60" size="50" name="specifications" value="<?php echo $user->email ?>"></td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td><input type="number" name="price" value="<?php echo $user->phone ?>"></td>
                        </tr>
                        <tr>
                            <td>Is Admin</td>
                            <td><input type="number" name="stock" value="<?php echo $user->is_admin ?>"></td>
                        </tr>
                    </tbody>
                </table>
                <input class=" btn btn-success" type="submit" value="Wijzigingen Opslaan">
            </form>
        </div>
        <?php include("footer.php") ?>
    </body>
</html>