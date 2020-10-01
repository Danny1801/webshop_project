<?php



?>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="styleSheet.css">
    </head>
    <body>
        <div class="header">
            <div class="container" >
                <div class="logo">
                    <!--<img src="./logo.png" class="rounded" alt="Cinque Terre" id="logo">-->
                </div>
                <div id="login">
                    <a href="login.php">Login</a>
                </div>
                <div id="winkelwagen">
                    <img src="images/cart.png" id="winkelwagen" href="cart.php">
                </div>
            </div>

            <nav class="navbar navbar-expand-sm bg-dark navbar-dark" id="menubalk">
                <ul class="navbar-nav">
                <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Componenten</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Processors</a>
                        <a class="dropdown-item" href="#">videokaarten</a>
                        <a class="dropdown-item" href="#">Ram</a>
                        <a class="dropdown-item" href="#">Moederborden</a>
                        <a class="dropdown-item" href="#">Koeling</a>
                        <a class="dropdown-item" href="#">Voeding</a>
                        <a class="dropdown-item" href="#">Opslag</a>
                        <a class="dropdown-item" href="#">Behuizingen</a>
                        <a class="dropdown-item" href="#">Accesiores</a>
                    </div>
                </li>        
                    <!-- Dropdown -->
                    <li class="nav-item">
                        <a class="nav-link" href="#">Over ons</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                    
                </ul>
            </nav>
        <div>
    </body>
</html>