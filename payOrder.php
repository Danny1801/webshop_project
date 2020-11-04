<?php 

    session_start();

    session_destroy();

    // go back to previous page option

?>
<html>
    <head>
        <title>Home - Danio Components</title>
        <link rel="stylesheet" href="styleSheet.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php include("header.php") ?>
            <div class="PageContentBg">
                <?php ?>
            </div>
        <?php include("footer.php") ?>
    </body>
</html>
