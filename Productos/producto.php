<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vital";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT ID, Nombre, Descripcion, Precio, Stock, Foto FROM producto";
$result = $conn->query($sql);

$productos = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $productos[] = $row;
    }
} else {
    echo "0 resultados";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Producto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet" type="text/css" media="all">
    <script src="script.js"></script>
</head>
<body>
    <?php include("../inicio/header.php"); ?>
    <div class="contenedor">
        <div class="titulo">
            <div class="shape right-skew">
                <h2><i class="fas fa-shopping-cart"></i> Tienda</h2>
            </div>
        </div>
        <button id="btnMostrarCarrito" class="show-on-mobile">
            <i class="fas fa-shopping-cart"></i>
        </button>
        <div class="slider carousel">
            <div class="productos-container">
                <?php if (!empty($productos)): ?>
                    <?php foreach ($productos as $producto) : ?>
                        <div class="producto item">
                            <div class="contenedor-imagen">
                                <a href="#" class="link"></a>
                                <img src="<?php echo $producto['Foto']; ?>" alt="<?php echo $producto['Nombre']; ?>">
                                <?php if (!empty($producto['Foto'])) : ?>
                                    <img src="<?php echo $producto['Foto']; ?>" class="img-hover" alt="<?php echo $producto['Nombre']; ?>">
                                <?php endif; ?>
                            </div>
                            <div class="datos">
                                <div class="starrr"></div>
                                <small>
                                    <h3><a href="#"><?php echo $producto['Nombre']; ?></a></h3>
                                </small>
                                <h2><a href="#"><?php echo $producto['Descripcion']; ?></a></h2>
                            </div>
                            <div class="precios">
                                <div class="internet">
                                    <small>Online</small>
                                    <span>€<?php echo number_format($producto['Precio'], 2); ?></span>
                                </div>
                                <div>
                                    <small>Tienda</small>
                                    <span>€<?php echo number_format($producto['Precio'] * 1.25, 2); ?></span>
                                </div>
                            </div>
                            <a href="#" class="btn-carrito" onclick="addToCart(event, '<?php echo $producto['Nombre']; ?>', '<?php echo $producto['Precio']; ?>', '<?php echo $producto['Foto']; ?>')">
                                <i class="fas fa-shopping-basket"></i> Agregar al carrito
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No hay productos disponibles</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div id="carrito" class="carrito-menu">
        <div class="carrito-contenido">
            <h3>Carrito de Compras</h3>
            <div id="productos-carrito"></div>
            <a href="pedido.php" class="btn-comprar">Transmitir Pedido</a>
        </div>
    </div>

    <?php include("../inicio/footer.php"); ?>
</body>
</html>
