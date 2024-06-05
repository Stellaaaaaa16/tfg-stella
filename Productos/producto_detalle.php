<?php
session_start();

$usuarioLogueado = isset($_SESSION['usuario_id']);

include '../admin/config.php';

$productoID = $_GET['id'];
$sql = "SELECT ID, Nombre, Descripcion, Precio, Stock, Foto FROM producto WHERE ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $productoID);
$stmt->execute();
$result = $stmt->get_result();
$producto = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title><?php echo $producto['Nombre']; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/logo_sin_fondo.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet" type="text/css" media="all">
    <style>
        .producto-detalle img {
            max-width: 100%;
        }
        .producto-detalle .datos {
            margin-top: 20px;
        }
        .producto-detalle .datos h2,
        .producto-detalle .datos h3 {
            text-transform: capitalize;
        }
    </style>
    <script>
        var usuarioLogueado = <?php echo json_encode($usuarioLogueado); ?>;
    </script>
    <script src="script.js"></script>
</head>

<body>
    <?php include("../inicio/header.php"); ?>
    <div class="contenedor producto-detalle">
        <div class="titulo">
            <div class="shape right-skew">
                <h2><i class="fas fa-shopping-cart"></i> Detalle del Producto</h2>
            </div>
        </div>
        <div class="producto">
            <div class="contenedor-imagen">
                <img src="<?php echo $producto['Foto']; ?>" alt="<?php echo $producto['Nombre']; ?>">
            </div>
            <div class="datos">
                <h3><?php echo $producto['Nombre']; ?></h3>
                <h2><?php echo $producto['Descripcion']; ?></h2>
                <div class="precios">
                    <div class="internet">
                        <small>Precio</small>
                        <span>€<?php echo number_format($producto['Precio'], 2); ?></span>
                    </div>
                </div>
                <a href="#" class="btn-carrito" data-nombre="<?php echo $producto['Nombre']; ?>" data-precio="<?php echo $producto['Precio']; ?>" data-foto="<?php echo $producto['Foto']; ?>" onclick="addToCart(event, '<?php echo $producto['Nombre']; ?>', '<?php echo $producto['Precio']; ?>', '<?php echo $producto['Foto']; ?>')">
                    <i class="fas fa-shopping-basket"></i> Agregar al carrito
                </a>
            </div>
        </div>
    </div>
    <?php include("../Contacto/chatbot.php"); ?>
    <?php include("../inicio/footer.php"); ?>
</body>

</html>
