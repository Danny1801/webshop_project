<?php

    if(!isset($_SESSION)) {
        session_start();
        if(!isset($_SESSION["cart"])) {
            $_SESSION["cart"] = array();
        }
        if(!isset($_SESSION["login"])) {
            $_SESSION["login"] = "";
        }
    }

    require_once("../Private/database.php");

    $stmt = $con->prepare("SELECT * FROM categories");
    $stmt->execute();

    $headCategories = $stmt->fetchAll(5);

    if(isset($_GET["searchTag"])) {
        $searchTag = strip_tags($_GET["searchTag"]);
        if(strlen($searchTag) >= 3) {
            header("location:categoryPage.php?search=$searchTag");
        } else {
            echo "<script type='text/javascript'>alert('Zoekterm `" . $searchTag . "` is te kort. Voer minimaal 3 karakters in.'); window.location.href='../index.php'</script>";
        }
    }
    
?>
<html>
    <head> 
        <link rel="stylesheet" href="styleSheet.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
        <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
    </head>
    <body>
        <div class="header">
            <div class="headerBg">
                <img src="images/logo.png" class="logo" alt="Cinque Terre" onclick="location.href='index.php'">
                <div class="cartLoginContainer">
                    <div>
                        <?php 
                            if($_SESSION["login"]) {
                                echo "<a class='login' href='session_destroy.php'>Logout</a>";
                            } else {
                               echo "<a class='login'  href='login.php'>Login</a>"; 
                            }
                        ?>
                    </div>
                    <div>
                        <img src="images/cart.png" class="winkelwagen" onclick="location.href='payOrder.php'">
                        <p class="text-success aantal" style="font-weight:bold; font-size:20px;">
                            <?php 
                                $cartItemAmount = 0;

                                if(!empty($_SESSION["cart"])) {
                                    foreach($_SESSION["cart"] as $key => $value) {
                                        $cartItemAmount += $_SESSION["cart"][$key][1];
                                    }
                                }

                                echo $cartItemAmount;
                            ?>
                        </p>
                    </div>
                </div>
            </div>
            <nav class="navbar navbar-expand-sm bg-secondary navbar-dark menubar">
                <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                </li>
                <li class="nav-item">
                    <button onclick="window.location.href='index.php'" class="mr-3 btn btn-secondary">Home</button>
                </li>
                <div class="dropdown">
                    <button class="mr-3 btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" data-target=".dropdown-menu" aria-haspopup="true" aria-expanded="false">Componenten</button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <?php
                        
                            foreach($headCategories as $headCategory) {
                                echo "<a class='dropdown-item' href='categoryPage.php?category=$headCategory->name'>$headCategory->display_name</a>";
                            }
                        
                        ?>
                    </div>
                </div>
                <li class="nav-item">
                    <button onclick="window.location.href='contactPage.php'" class="btn btn-secondary mr-3">Over Ons</button>
                </li>
                <?php

                    if($_SESSION["login"]) {
                        echo "<li class='nav-item'>";
                            echo "<button onclick='window.location.href=`accountPage.php`' class='mr-3 btn btn-success'>Mijn Account</button>";
                        echo "</li>";
                    }

                    if(isset($_SESSION["user"]->is_admin) && $_SESSION["user"]->is_admin == 1){
                        echo "<li class='nav-item'>";
                            echo "<a class='btn btn-warning' type='button' href='adminPage.php'>Admin Page</a>";
                        echo "</li>";
                    }
                ?>
                </ul>
                <form class="form-inline searchBar mx-auto" method="GET" action="index.php">
                    <input class="form-control mr-sm-2" type="search" placeholder="Zoek naar een product" name="searchTag">
                    <input class="btn btn-success my-2 my-sm-0 text-light" value="Zoeken" type="submit">
                </form>
            </nav>
        <div>
    </body>
</html>