<?php
session_start();

// Verificar si hay productos en el carrito
$carrito = json_decode(file_get_contents('php://input'), true) ?? [];
$total = 0;
foreach ($carrito as $producto) {
    $total += $producto['precio'];
}

// Verificar si el usuario ha iniciado sesión
$usuario_iniciado = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Transmitir Pedido</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet" type="text/css" media="all">
    <script src="https://www.paypal.com/sdk/js?client-id=Aez6AR8kTK31tvovrxUs5WDeakHidgEOD0j4HqdPwo6gsmA76Ld0hxkLhbM2RlANiGeuiZRhumyFmvXK&currency=EUR"></script>
</head>
<body>
    <div class="contenedor">
        <div class="titulo">
            <h2>Transmitir Pedido</h2>
        </div>
        <?php if ($usuario_iniciado) : ?>
            <div class="carrito">
                <h3>Productos en el Carrito</h3>
                <div id="productos-carrito">
                    <?php foreach ($carrito as $producto) : ?>
                        <div class="producto">
                            <img src="<?php echo htmlspecialchars($producto['foto']); ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>">
                            <h3><?php echo htmlspecialchars($producto['nombre']); ?></h3>
                            <p>€<?php echo number_format($producto['precio'], 2, '.', ''); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
                <h3>Total: €<?php echo number_format($total, 2, '.', ''); ?></h3>
                <div id="paypal-button-container"></div>
            </div>
        <?php else : ?>
            <div class="mensaje">
                <p>Debe iniciar sesión para continuar con su pedido.</p>
                <a href="../inicio/inicio.php" class="btn-iniciar-sesion">Iniciar Sesión</a>
            </div>
        <?php endif; ?>
    </div>
    <script>
        paypal.Buttons({
            style: {
                color: 'blue'
            },
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '<?php echo number_format($total, 2, '.', ''); ?>'
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(detalles) {
                    fetch('guardar_pedido.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(detalles)
                    }).then(response => response.json()).then(data => {
                        if (data.success) {
                            window.location.href = "completado.html";
                        } else {
                            alert('Error al guardar el pedido');
                        }
                    });
                });
            },
            onCancel: function(data) {
                alert("Pago Cancelado");
            }
        }).render('#paypal-button-container');
    </script>
</body>
</html>
