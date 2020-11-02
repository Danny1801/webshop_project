<?php 

    include("header.php");

    if($_POST){
    $password = $_POST["password"]; 

    $hashedPassword = hash('sha256', $password);

    $stmt = $con->prepare("INSERT INTO users (firstname, lastname, `address`, email, phone, password_hash, is_admin) VALUES(?, ?, ? ,? ,?, ?, ?)");
    $stmt->bindValue(1, $_POST["firstname"]);
    $stmt->bindValue(2, $_POST["lastname"]);
    $stmt->bindValue(3, $_POST["address"]);
    $stmt->bindValue(4, $_POST["email"]);
    $stmt->bindValue(5, $_POST["phone"]);
    $stmt->bindValue(6, $hashedPassword);
    $stmt->bindValue(7, isset($_POST["is_admin"]) ? 1 : 0);

    $stmt->execute();
    }




?>
<html>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<div class="PageContentBg">
    <div id="formContent">

        <form>
        <input type="text" id="firstname" name="login" placeholder="firstname"></br></br>
        <input type="text" id="lastname" name="login" placeholder="lastname"></br></br>
        <input type="text" id="address" name="login" placeholder="address"></br></br>
        <input type="text" id="email" name="login" placeholder="email"></br></br>
        <input type="number" id="phone" name="login" placeholder="phone"></br></br>
        <input type="text" id="password" name="login" placeholder="password"></br></br>
        Is Admin : <input type="checkbox" id="email" name="login" placeholder="Admin"></br></br>
        <input type="submit" value="Aanmaken"></br></br>
        <a href="index.php">Terug naar home</a>
        </form>
    </div>
</div>
</html>

<?php include("footer.php"); ?>