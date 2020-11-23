<?php 

    if(!isset($_SESSION)) {
        session_start();
    }

    require_once("checkLogin.php");
    require_once("database.php");

    $stmt = $con->prepare("SELECT * FROM orders WHERE `user_id`=? ORDER BY `date` ASC");
    $stmt->bindValue(1, $_SESSION["user"]->id);
    $stmt->execute();

    $orders = $stmt->fetchAll(5);

    $stmt = $con->prepare("SELECT products.id, products.product_code, products.name, products.description, products.specifications, products.price, products.stock, categories.name AS category FROM products LEFT JOIN categories ON categories.id = products.category_id");
    $stmt->execute();

    $products = $stmt->fetchAll(5);

    if($_POST){
        if(isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["address"]) && isset($_POST["email"]) && !empty($_POST["phone"])) {
            //$password = $_POST["password"]; 
            //$hashedPassword = hash('sha256', $password);

            $stmt = $con->prepare("UPDATE users SET firstname=?, lastname=?, `address`=?, email=?, phone=? WHERE id=?");
            $stmt->bindValue(1, htmlspecialchars($_POST["firstname"]));
            $stmt->bindValue(2, htmlspecialchars($_POST["lastname"]));
            $stmt->bindValue(3, htmlspecialchars($_POST["address"]));
            $stmt->bindValue(4, htmlspecialchars($_POST["email"]));
            $stmt->bindValue(5, htmlspecialchars($_POST["phone"]));
            $stmt->bindValue(6, $_SESSION["user"]->id);
            //$stmt->bindValue(6, $hashedPassword);

            $_SESSION["user"]->firstname = $_POST["firstname"];
            $_SESSION["user"]->lastname = $_POST["lastname"];
            $_SESSION["user"]->address = $_POST["address"];
            $_SESSION["user"]->email = $_POST["email"];
            $_SESSION["user"]->phone = $_POST["phone"];

            $stmt->execute();
        } else {
            echo "<script type='text/javascript'>alert('Alle velden moeten ingevuld zijn!');</script>";
        }    
    }  
?>
<html>
    <head>
        <title>Mijn account - Danio Components</title>
        <link rel="shortcut icon" href="images/favicon.ico">
        <link rel="stylesheet" href="styleSheet.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php include("header.php"); ?>
            <div class="PageContentBg accountPage-grid-container">
                <h3>Welkom op je accountpagina, <?php echo $_SESSION["user"]->firstname . " " . $_SESSION["user"]->lastname ?>!</h3><br><br>
                <?php if($_POST) { echo "<h5 class='text-success'>Wijzigingen zijn opgeslagen!</h5>"; } ?>
                <form method="POST">
                    <div class="grid-item table-responsive">
                        <table class="table table-striped editAccountTable">
                            <tbody>
                                <tr>
                                    <td>Voornaam</td>
                                    <td><input type="text" name="firstname" maxlength="45" value="<?php echo $_SESSION["user"]->firstname ?>"></td>
                                </tr>
                                <tr>
                                    <td>Achternaam</td>
                                    <td><input type="text" name="lastname" maxlength="45" value="<?php echo $_SESSION["user"]->lastname ?>"></td>
                                </tr>
                                <tr>
                                    <td>Adres</td>
                                    <td><input type="text" name="address" maxlength="45" value="<?php echo $_SESSION["user"]->address ?>"></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><input type="text" name="email" maxlength="45" value="<?php echo $_SESSION["user"]->email ?>"></td>
                                </tr>
                                <tr>
                                    <td>Telefoon</td>
                                    <td><input type="number" name="phone" value="<?php echo $_SESSION["user"]->phone ?>"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <input class=" btn btn-success" type="submit" value="Wijzigingen Opslaan">
                </form>
                <div class="grid-item">
                    <?php 
                        if(!empty($orders)) {
                            echo "<div class='table-responsive'>";
                            echo "<table class='table table-striped text-center text-center'>";
                                echo "<thead>";
                                    echo "<th>Order Nr.</th>";
                                    echo "<th>Prijs</th>";
                                    echo "<th>[code, hoeveelheid]</th>";
                                    echo "<th>Besteldatum</th>";
                                echo "</thead>";
                                echo "<tbody>";
                        }

                        $orderCount = count($orders);
                        $i = 1;
                        foreach($orders as $order) {
                            echo "<tr>";
                            echo "<td>" . $i . "</td>";
                            echo "<td>€" . $order->total_price . "</td>";
                            echo "<td>" . $order->product_codes . "</td>";
                            echo "<td>" . $order->date . "</td>";
                            echo "</tr>";
                            $i++;
                        }
                    
                        if(!empty($orders)) {
                                echo "</tbody>";
                            echo "</table>";
                            echo "</div>";
                        }

                    ?>
                </div> 
            </div> 
        <?php include("footer.php"); ?>
    </body>
</html>