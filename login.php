<?php 

    include("header.php"); 

    if(isset($_POST["email"]) && isset($_POST["password"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];
        //echo "Username: " . $email . "<br>" . "Password: " . $password;
    
        $hashedPassword = hash('sha256', $password);
    
        //GLOBAL $con;
    
        $statement = $con->prepare("SELECT * FROM users WHERE email = ? AND Password = ?");
        $statement->bindValue(1,$email);
        $statement->bindValue(2,$hashedPassword);
        $statement->execute();
    
        $result = $statement->fetchObject();
    }


?>

<html>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <div class="PageContentBg">
        <div id="formContent">
            <form>
                <input type="text" id="email" name="login" placeholder="email"></br></br>
                <input type="text" id="password" name="login" placeholder="password"></br></br>
                <input type="submit" value="Log In">
            </form>

            <div id="formFooter">
                <a class="underlineHover" href="createAccount.php">Account aanmaken</a>
            </div>

        </div>
    </div>
</html>

<?php include("footer.php"); ?>