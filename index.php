<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>Carrusel</title>
</head><?php
        // Incluir el encabezado (header)
        include("../inicio/header.php");
        ?>

<body>
    <div class="carrusel">
        <div class="atras click-effect">
            <img id="atras" src="../img/atras.svg" alt="atras" loading="lazy">
        </div>

        <div class="imagenes">
            <div id="img">
                <img class="img" src="../img/imgfisio1.jpg" alt="imagen 1" loading="lazy">
            </div>

            <div id="texto" class="texto">
                <h3>Proyecto 01</h3>
                <p>-</p>
                    <li><a href="../PedirCita/index.php">Pedit cita</a></li>
            </div>
        </div>

        <div class="adelante click-effect" id="adelante">
            <img src="../img/adelante.svg" alt="adelante" loading="lazy">
        </div>
    </div>

    <div class="puntos" id="puntos"></div>

    <script src="app.js"></script>

    <?php
    // Incluir el encabezado (header)
    include("../inicio/footer.php");
    ?>

</body>

</html>