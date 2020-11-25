<html>
    <head>
        <title>Over Ons - Danio Components</title>
        <link rel="stylesheet" href="styleSheet.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="images/favicon.ico">
        <script src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap&libraries=&v=weekly"defer></script>
        <style type="text/css">
            /* Set the size of the div element that contains the map */
            #map {
                height: 400px;
                /* The height is 400 pixels */
                width: 100%;
                /* The width is the width of the web page */
            }
        </style>
        <script>
            // Initialize and add the map
            function initMap() {
            // The location of Uluru
            const uluru = { lat: 52.223970, lng: 5.170920 };
            // The map, centered at Uluru
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: uluru,
            });
            // The marker, positioned at Uluru
            const marker = new google.maps.Marker({
                position: uluru,
                map: map,
            });
            }
        </script>
    </head>
    <body>
        <?php include("header.php") ?>
            <div class="PageContentBg">
                <div class="contactPageDiv">
                    <h2 class="contactHeader">Danio Components</h2>
                    </br>
                    <div class="contactDesc">Hier bij Danio Componets hebben we 10 minuten ervaring met het verkopen van computeronderdelen. We verkopen alle onderdelen die je nodig hebt om een computer te bouwen. We zullen ervoor zorgen dat u een goede ervaring bij ons krijgt.</div>
                    </br></br>
                    <h5 class="contactSmallHeader">Contact</h5>
                    <div class="contactDesc">Email: info@daniocomponents.com</div>
                    <div class="contactDesc">Tel. Mobiel: + 06 516 697 34</div>
                    <div class="contactDesc">Tel. Bedrijf: + 035 233 29 88</div>
                    </br></br>
                    <h3 class="contactSmallHeader">Adres: Van Linschotenlaan 501, 1212 GG</h3>
                    </br>
                    <!-- <a href="https://www.google.com/maps?q=ict+campus+hilversum&um=1&ie=UTF-8&sa=X&ved=2ahUKEwjCzLa5p4ftAhUQ6aQKHXE6B38Q_AUoAXoECAcQAw"><img class='googleMapsImage' src='images/adres.png'></a> -->
                    <div id="map" style="height:700px;"></div>
                </div>
            </div>
        <?php include("footer.php") ?>
    </body>
</html>
