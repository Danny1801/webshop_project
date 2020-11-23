<?php

    require_once("database.php");
            
    $stmt = $con->prepare("SELECT * FROM users WHERE id=?");
    $stmt->bindValue(1, $_GET["user_id"]);
    $stmt->execute();

    $user = $stmt->fetchObject();

    if($_POST) {
        if(!isset($_POST["is_admin"])) {
            $_POST["is_admin"] = 1;
        }
        $stmt = $con->prepare("UPDATE users SET firstname=?, lastname=?, `address`=?, email=?, phone=?, is_admin=? WHERE id=?");
		$stmt->bindValue(1, $_POST["firstname"]);
		$stmt->bindValue(2, $_POST["lastname"]);
		$stmt->bindValue(3, $_POST["address"]);
		$stmt->bindValue(4, $_POST["email"]);
		$stmt->bindValue(5, $_POST["phone"]);
		$stmt->bindValue(6, $_POST["is_admin"]);
		$stmt->bindValue(7, $_GET["user_id"]);

        $stmt->execute();
        
        header("location:adminPage.php");
    }

?>
<html>
    <head>
        <title>Edit <?php echo $user->firstname?> - Danio Components</title>
        <link rel="stylesheet" href="styleSheet.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="images/favicon.ico">
    </head>
    <body>
        <?php include("header.php") ?>
        <div class="PageContentBg">
            <form method="POST">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td>Firstname</td>
                            <td><input type="text" name="firstname" maxlength="45" value="<?php echo $user->firstname ?>"></td>
                        </tr>
                        <tr>
                            <td>Lastname</td>
                            <td><input type="text" name="lastname" maxlength="45" value="<?php echo $user->lastname ?>"></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td><input type="text" name="address" maxlength="90" value="<?php echo $user->address?>"></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><input type="text" name="email" maxlength="45" value="<?php echo $user->email ?>"></td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td><input type="number" name="phone" maxlength="11" value="<?php echo $user->phone ?>"></td>
                        </tr>
                        <?php
                            if($_GET["user_id"] != $_SESSION["login"]) {
                                echo "<tr>";
                                echo "<td>Administrator</td>";
                                echo "<td><input type='number' name='is_admin' value='<?php echo $user->is_admin ?>'></td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
                <input class=" btn btn-success" type="submit" value="Wijzigingen Opslaan">
            </form>
        </div>
        <?php include("footer.php") ?>
    </body>
</html>