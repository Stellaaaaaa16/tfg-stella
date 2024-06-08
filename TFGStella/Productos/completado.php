
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Pedido Completado</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><link rel="icon" href="../img/logo_sin_fondo.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet" type="text/css" media="all">
    <style>
        .btn {
            background-color: #6a0dad; 
            color: #fff;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px 0;
            cursor: pointer;
            border-radius: 5px;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #8a2be2; 
        }
    </style>
</head>
<body>
<?php include("../inicio/header.php"); ?>
<!-- pagina de pedido completado -->
    <div class="contenedor">
        <div class="titulo">
            <h2>Pedido Completado</h2>
        </div>
        <div class="mensaje">
            <p>Su pedido ha sido completado con éxito.</p>
            <a href="../inicio/inicio.php" class="btn">Volver a la tienda</a>
        </div>
    </div>
<?php include("../inicio/footer.php"); ?>
</body>
</html>
