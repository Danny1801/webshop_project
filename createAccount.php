<?php 
    
    if(!isset($_SESSION)) {
        session_start();
    }

    require_once("database.php");

    if($_POST){
        if(isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["address"]) && isset($_POST["email"]) && !empty($_POST["phone"]) && isset($_POST["password"])) {
            $password = $_POST["password"]; 
            $hashedPassword = hash('sha256', $password);

            $stmt = $con->prepare("INSERT INTO users (firstname, lastname, `address`, email, phone, password_hash, is_admin) VALUES(?, ?, ? ,? ,?, ?, ?)");
            $stmt->bindValue(1, $_POST["firstname"]);
            $stmt->bindValue(2, $_POST["lastname"]);
            $stmt->bindValue(3, $_POST["address"]);
            $stmt->bindValue(4, $_POST["email"]);
            $stmt->bindValue(5, $_POST["phone"]);
            $stmt->bindValue(6, $hashedPassword);
            $stmt->bindValue(7, 0);

            $stmt->execute();

            $statement = $con->prepare("SELECT * FROM users WHERE email=? AND password_hash=?");
            $statement->bindValue(1, $_POST["email"]);
            $statement->bindValue(2, $hashedPassword);
            $statement->execute();
        
            $result = $statement->fetchObject();

            $_SESSION["user"] = $result;
            $_SESSION["login"] = 1;

            header("location:index.php");
        } else {
            echo "<script type='text/javascript'>alert('Alle velden moeten ingevuld zijn!');</script>";
        }    
    }

?>
<html>
    <head>
        <title>Account aanmaken - Danio Components</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="shortcut icon" href="images/favicon.ico">
    </head>
    <body>
        <?php include("header.php"); ?>
            <div class="PageContentBg">
                <div id="formContent">
                    <form method="POST">
                        <h3>Account aanmaken</h3><br>
                        <input type="text" id="firstname" name="firstname" placeholder="Voornaam"></br></br>
                        <input type="text" id="lastname" name="lastname" placeholder="Achternaam"></br></br>
                        <input type="text" id="address" name="address" placeholder="Adres"></br></br>
                        <input type="text" id="email" name="email" placeholder="Email"></br></br>
                        <input type="number" id="phone" name="phone" placeholder="Telefoon"></br></br>
                        <input type="password" id="password" name="password" placeholder="Wachtwoord"></br></br>
                        <input type="submit" class="btn btn-success" value="Aanmaken"></br></br>
                        <h5><a href="login.php" class="">Terug naar inloggen</a></h5>
                    </form>
                </div>
            </div>
        <?php include("footer.php"); ?>
    </body>
</html>

