<?php 

    require_once("database.php");

    if($_POST){
        	$password = $_POST["password"]; 
            $hashedPassword = hash('sha256', $password);
        if(isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["address"]) && isset($_POST["email"]) && isset($_POST["phone"]) && isset($_POST["password"]) && isset($_POST["is_admin"])){
            $stmt = $con->prepare("INSERT INTO users (firstname, lastname, `address`, email, phone, password_hash, is_admin) VALUES(?, ?, ? ,? ,?, ?, ?)");
            $stmt->bindValue(1, $_POST["firstname"]);
            $stmt->bindValue(2, $_POST["lastname"]);
            $stmt->bindValue(3, $_POST["address"]);
            $stmt->bindValue(4, $_POST["email"]);
            $stmt->bindValue(5, $_POST["phone"]);
            $stmt->bindValue(6, $hashedPassword);
            $stmt->bindValue(7, isset($_POST["is_admin"]) ? 1 : 0);

            $stmt->execute();

            header("location:index.php");
        } else {
            echo "<script type='text/javascript'>alert('Alle velden moeten ingevuld zijn!');</script>";
        }    
    }

?>
<html>
    <head>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
    <body>
        <?php include("header.php"); ?>
            <div class="PageContentBg">
                <div id="formContent">
                    <form method="POST">
                        <input type="text" id="firstname" name="firstname" placeholder="firstname"></br></br>
                        <input type="text" id="lastname" name="lastname" placeholder="lastname"></br></br>
                        <input type="text" id="address" name="address" placeholder="address"></br></br>
                        <input type="text" id="email" name="email" placeholder="email"></br></br>
                        <input type="number" id="phone" name="phone" placeholder="phone"></br></br>
                        <input type="password" id="password" name="password" placeholder="password"></br></br>
                        Is Admin : <input type="checkbox" id="isAdmin" name="isAdmin"></br></br>
                        <input type="submit" value="Aanmaken"></br></br>
                        <a href="index.php">Terug naar home</a>
                    </form>
                </div>
            </div>
        <?php include("footer.php"); ?>
    </body>
</html>

