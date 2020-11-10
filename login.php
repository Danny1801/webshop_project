<?php 

    require_once("database.php");
    ob_start();
    session_start(); 

    $valid = "";

    if($_POST){
        $email = $_POST["email"];
        $password = $_POST["password"];
        $hashedPassword = hash('sha256', $password);

        if(isset($_POST["email"]) && isset($_POST["password"])) {
            if(empty($_POST["email"]) || empty($_POST["password"])) {
                $valid = "<script type='text/javascript'>alert('Niet alle velden zijn ingevuld!');</script>";
            }
            else {

                $statement = $con->prepare("SELECT * FROM users WHERE email = ? AND password_hash = ?");
                $statement->bindValue(1,$email);
                $statement->bindValue(2,$hashedPassword);
                $statement->execute();
            
                $result = $statement->fetchObject();
                if($result !== false) {
                    
                    $_SESSION["user"] = $result;
                    $_SESSION["login"] = 1;

                    header("location:index.php");
                }
                else {
                    $valid = "<script type='text/javascript'>alert('De logingegevens zijn niet juist!');</script>";
                }
            }
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
                    <input type="text" id="email" name="email" placeholder="Email"></br></br>
                    <input type="password" id="password" name="password" placeholder="Password"></br></br>
                    <input class="btn btn-success" type="submit" value="Log In">
                </form>
                <div id="formFooter">
                    <a class="underlineHover" href="createAccount.php">Account aanmaken</a>
                </div>
            </div>
        </div>    
    <?php include("footer.php"); ?>
    <?php 
    
        if(!empty($valid)) {
            echo $valid;
        }
    
    ?>
    </body>
</html>