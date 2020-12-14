<?php 
    
    if(!isset($_SESSION)) {
        session_start();
    }

    require_once("../database.php");

    if($_POST){
        if(isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["address"]) && isset($_POST["email"]) && !empty($_POST["phone"]) && isset($_POST["password"])) {
            $password = $_POST["password"]; 
            $hashedPassword = hash('sha256', $password);

            $stmt = $con->prepare("INSERT INTO users (firstname, lastname, `address`, email, phone, password_hash, is_admin) VALUES(?, ?, ? ,? ,?, ?, ?)");
            $stmt->bindValue(1, htmlspecialchars($_POST["firstname"]));
            $stmt->bindValue(2, htmlspecialchars($_POST["lastname"]));
            $stmt->bindValue(3, htmlspecialchars($_POST["address"]));
            $stmt->bindValue(4, htmlspecialchars($_POST["email"]));
            $stmt->bindValue(5, strip_tags($_POST["phone"]));
            $stmt->bindValue(6, strip_tags($hashedPassword));
            $stmt->bindValue(7, 0);

            $stmt->execute();

            $statement = $con->prepare("SELECT * FROM users WHERE email=? AND password_hash=?");
            $statement->bindValue(1, $_POST["email"]);
            $statement->bindValue(2, $hashedPassword);
            $statement->execute();
        
            $result = $statement->fetchObject();

            $_SESSION["user"] = $result;
            $_SESSION["login"] = 1;

            header("location:../index.php");
        } else {
            echo "<script type='text/javascript'>alert('Alle velden moeten ingevuld zijn!');</script>";
        }    
    }

?>
<html>
    <head>
        <title>Account aanmaken - Danio Components</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../images/favicon.ico">
    </head>
    <body>
        <?php include("header2.php"); ?>
            <div class="PageContentBg">
                <div id="formContent">
                    <form method="POST">
                        <h3>Account aanmaken</h3><br>
                        <input type="text" id="firstname" name="firstname" maxlength="45" placeholder="Voornaam"></br></br>
                        <input type="text" id="lastname" name="lastname" maxlength="45" placeholder="Achternaam"></br></br>
                        <input type="text" id="address" name="address" maxlength="90" placeholder="Adres"></br></br>
                        <input type="text" id="email" name="email" maxlength="45" placeholder="Email"></br></br>
                        <input type="number" id="phone" name="phone" maxlength="11" placeholder="Telefoon"></br></br>
                        <input type="password" id="password" name="password" placeholder="Wachtwoord"></br></br>
                        <input type="submit" class="btn btn-success" value="Aanmaken"></br></br>
                        <h5><a href="../login.php" class="">Terug naar inloggen</a></h5>
                    </form>
                </div>
            </div>
        <?php include("footer2.php"); ?>
    </body>
</html>

