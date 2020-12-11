<?php 

    if(!isset($_SESSION)) {
        session_start();
    }

    require_once("../checkLogin.php");
    require_once("../database.php");

    $stmt = $con->prepare("SELECT * FROM orders WHERE `user_id`=? ORDER BY `date` DESC");
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
        <link rel="stylesheet" href="../styleSheet.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php include("header2.php"); ?>
            <div class="PageContentBg">
                <h4>Welkom op je accountpagina, <?php echo $_SESSION["user"]->firstname . " " . $_SESSION["user"]->lastname ?>! Hier vind je jouw accountgegevens en recente bestellingen.</h4><br>
                <div class="accountPage-grid-container">
                    <form method="POST">
                        <div class="grid-item table-responsive">
                            <table class="table-bordered table table-striped editAccountTable">
                                <thead>
                                    <th>Gegeven</th>
                                    <th>Waarde</th>
                                </thead>
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
                        <?php if($_POST) { echo "<br><br><h5 class='text-success'>Wijzigingen zijn opgeslagen!</h5>"; } ?>
                    </form>   
                    <div class="grid-item">
                        <?php 
                            if(!empty($orders)) {
                                echo "<div class='table-responsive'>";
                                echo "<table class='table-bordered table table-striped text-center text-center' id='orders'>";
                                    echo "<thead>";
                                        echo "<th>Order Nr.</th>";
                                        echo "<th>Prijs</th>";
                                        echo "<th>Code, hoeveelheid</th>";
                                        echo "<th>Besteldatum</th>";
                                    echo "</thead>";
                                    echo "<tbody>";
                            }

                            $orderCount = count($orders);
                            $i = $orderCount;
                            foreach($orders as $order) {
                                $prodCodes =
                                str_replace(']', '<br>',
                                    str_replace('[[', '',
                                    str_replace('"', '',
                                    str_replace(',', ':',
                                    str_replace(', [', '.',
                                    $order->product_codes)))));
                                $codes = explode('.', $prodCodes);
                                
                                echo "<tr>";
                                echo "<td>" . $i . "</td>";
                                echo "<td>€" . $order->total_price . "</td>";
                                echo "<td>";
                                foreach($codes as $code) {
                                    $linkCode = explode(':', $code);
                                    echo "<a href='../productPage.php?product=$linkCode[0]'>" . $linkCode[0] . "</a>: $linkCode[1]";
                                } 
                                echo "</td>";
                                echo "<td>" . $order->date . "</td>";
                                echo "</tr>";
                                $i--;
                            }
                        
                            if(!empty($orders)) {
                                    echo "</tbody>";
                                echo "</table>";
                                echo "</div>";
                            }

                        ?>
                    </div> 
                </div> 
            </div> 
        <?php include("footer2.php"); ?>
    </body>
</html>
<script>
    $(document).ready(function(){
        $('#orders').dataTable( {
            "lengthMenu": [5, 10, 20]
        } );
    });
</script>