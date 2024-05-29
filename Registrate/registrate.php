<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>División en Tres Secciones</title>
    <style>
        .aaa {
            display: flex;
            height: 100vh;
            margin: 0;
        }

        .section {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 1px solid #000;
        }

        .left {
            background-color: #f0f0f0;
        }

        .center {
            background-color: #d0d0d0;
        }

        .right {
            background-color: #b0b0b0;
        }

        h1 {
            margin: 0;
        }
    </style>
</head>

<body>
    <?php include("../inicio/header.php"); ?>
    <div class=" aaa">
        <div class="section left">
            <h1>Sesión Individual</h1>
        </div>
        <div class="section center">
            <h1>Bono de 5</h1>
        </div>
        <div class="section right">
            <h1>Bono de 10</h1>
        </div>
    </div>
    <?php include("../inicio/footer.php"); ?>
</body>

</html>