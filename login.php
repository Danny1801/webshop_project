<?php 

    require_once("database.php");
    session_start(); 

    if($_POST){

            $email = $_POST["email"];
            $password = $_POST["password"];
            $hashedPassword = hash('sha256', $password);

        if(isset($_POST["email"]) && isset($_POST["password"])) {
            
            $statement = $con->prepare("SELECT * FROM users WHERE email = ? AND password_hash = ?");
            $statement->bindValue(1,$email);
            $statement->bindValue(2,$hashedPassword);
            $statement->execute();
        
            $result = $statement->fetchObject();
            
            $_SESSION["id"] = $_POST["id"];

            header("location:index.php");

        }
    }    

?>

<html>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php include("header.php"); ?>
    <div class="PageContentBg">
        <div id="formContent">
            <form method="POST">
                <input type="text" id="email" name="email" placeholder="email"></br></br>
                <input type="password" id="password" name="password" placeholder="password"></br></br>
                <input type="submit" value="Log In">
            </form>

            <div id="formFooter">
                <a class="underlineHover" href="createAccount.php">Account aanmaken</a>
            </div>

        </div>
    </div>
</html>

<?php include("footer.php"); ?>