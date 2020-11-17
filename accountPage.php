<?php 

    if(!isset($_SESSION)) {
        session_start();
    }

    require_once("database.php");

    if($_POST){
        if(isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["address"]) && isset($_POST["email"]) && !empty($_POST["phone"])) {
            //$password = $_POST["password"]; 
            //$hashedPassword = hash('sha256', $password);

            $stmt = $con->prepare("UPDATE users SET firstname=?, lastname=?, `address`=?, email=?, phone=? WHERE id=?");
            $stmt->bindValue(1, $_POST["firstname"]);
            $stmt->bindValue(2, $_POST["lastname"]);
            $stmt->bindValue(3, $_POST["address"]);
            $stmt->bindValue(4, $_POST["email"]);
            $stmt->bindValue(5, $_POST["phone"]);
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
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="shortcut icon" href="images/favicon.ico">
    </head>
    <body>
        <?php include("header.php"); ?>
            <div class="PageContentBg">
                <h3>Welkom op je accountpagina, <?php echo $_SESSION["user"]->firstname . " " . $_SESSION["user"]->lastname ?>!</h3><br>
                <?php if($_POST) { echo "<h5 class='text-success'>Wijzigingen zijn opgeslagen!</h5>"; } ?>
                <form method="POST">
                    <table class="table table-striped">
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
                    <input class=" btn btn-success" type="submit" value="Wijzigingen Opslaan">
                </form>
            </div>    
        <?php include("footer.php"); ?>
    </body>
</html>