<?php

    require_once("database.php");

    $stmt = $con->prepare("SELECT * FROM categories");
    $stmt->execute();

    $headCategories = $stmt->fetchAll(5);

    if(isset($_GET["searchTag"])) {
        $searchTag = $_GET["searchTag"];
        if(strlen($searchTag) >= 3) {
            header("location:categoryPage.php?search=$searchTag");
        } else {
            echo "<script type='text/javascript'>alert('Zoekterm `" . $searchTag . "` is te kort. Voer minimaal 3 karakters in.'); window.location.href='index.php'</script>";
        }
    }

?>
<html>
    <head>        
        <link rel="stylesheet" href="styleSheet.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body>
        <div class="header">
            <div>
                <img src="images/logo.png" class="logo" alt="Cinque Terre" onclick="location.href='index.php'">
                <input class="m-5 btn btn-warning" style="position:absolute;" type="button" onclick="location.href='adminPage.php';" value="Admin Page">
                <div class="cartLoginContainer">
                    <a class="login" href="login.php" value="Login">Login</a>
                    <img src="images/cart.png" class="winkelwagen" onclick="location.href='payOrder.php'">
                </div>
            </div>
            <nav class="navbar navbar-expand-sm bg-secondary navbar-dark menubar">
                <ul class="navbar-nav mx-auto">
                <li class="nav-item">
<<<<<<< HEAD
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Componenten</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="">Processors</a>
                        <a class="dropdown-item" href="categoryPage.php?graphics_card">videokaarten</a>
                        <a class="dropdown-item" href="">Ram</a>
                        <a class="dropdown-item" href="">Moederborden</a>
                        <a class="dropdown-item" href="">Koeling</a>
                        <a class="dropdown-item" href="">Voeding</a>
                        <a class="dropdown-item" href="">Opslag</a>
                        <a class="dropdown-item" href="">Behuizingen</a>
                        <a class="dropdown-item" href="">Accesiores</a>
=======
                    <a class="nav-link text-white" href="index.php">Home</a>
                </li>
                <!-- Dropdown -->
                <li class="nav-item dropdown show">
                    <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Componenten</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class='dropdown-item' href='#'>asdfasdkjf</a>
                        <a class='dropdown-item' href='#'>asdfasdkjf</a>
                        <a class='dropdown-item' href='#'>asdfasdkjf</a>
                        <a class='dropdown-item' href='#'>asdfasdkjf</a>
                        <?php
                        
                            foreach($headCategories as $headCategory) {
                                echo "<a class='dropdown-item' href='categoryPage.php?category=$headCategory->name'>$headCategory->display_name</a>";
                            }
                        
                        ?>
>>>>>>> 19f6ee1be31cbcf8442649921984a9f6b30f8e89
                    </div>
                </li>        
                <li class="nav-item">
                    <a class="nav-link text-white" href="contactPage.php">Contact</a>
                </li>
                </ul>
                <form class="form-inline searchBar mx-auto" method="GET" action="index.php">
                    <input class="form-control mr-sm-2" type="search" placeholder="Zoek naar een product" name="searchTag">
                    <input class="btn btn-success my-2 my-sm-0 text-light" value="Zoeken" type="submit">
                </form>
            </nav>
        <div>
    </body>
</html>