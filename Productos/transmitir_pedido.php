<?php
session_start();

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
    <style>
        .btn-iniciar-sesion {
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

        .btn-iniciar-sesion:hover {
            background-color: #8a2be2;
            color: black;
        }
    </style>
    <link rel="icon" href="../img/logo_sin_fondo.png" type="image/x-icon">
    <script src="https://www.paypal.com/sdk/js?client-id=Aez6AR8kTK31tvovrxUs5WDeakHidgEOD0j4HqdPwo6gsmA76Ld0hxkLhbM2RlANiGeuiZRhumyFmvXK&currency=EUR"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const carrito = JSON.parse(localStorage.getItem('carrito')) || [];
            const productosCarrito = document.getElementById('productos-carrito');
            const totalElement = document.getElementById('total');
            let total = 0;

            carrito.forEach(producto => {
                const productoDiv = document.createElement('div');
                productoDiv.classList.add('producto-carrito');
                productoDiv.innerHTML = `
                    <img src="${producto.foto}" alt="Producto">
                    <div class="producto-info">
                        <h4>${producto.nombre}</h4>
                        <p>Precio: €<span class="precio">${producto.precio.toFixed(2)}</span></p>
                    </div>
                `;
                productosCarrito.appendChild(productoDiv);
                total += producto.precio;
            });

            totalElement.textContent = `Total: €${total.toFixed(2)}`;
        });
    </script>
</head>

<body>
    <?php include("../inicio/header.php"); ?>
    <div class="contenedor">
        <div class="titulo">
            <h2>Transmitir Pedido</h2>
        </div>
        <?php if ($usuario_iniciado) : ?>
            <div class="carrito">
                <h3>Productos en el Carrito</h3>
                <div id="productos-carrito"></div>
                <h3 id="total">Total: €0.00</h3>
                <div id="paypal-button-container"></div>
            </div>
        <?php else : ?>
            <div class="mensaje">
                <p>Debe iniciar sesión para continuar con su pedido.</p>
                <a href="../IniciarSesion/iniciar.php" class="btn-iniciar-sesion">Iniciar Sesión</a>
            </div>
        <?php endif; ?>
    </div>
    <script src="https://www.paypal.com/sdk/js?client-id=Aez6AR8kTK31tvovrxUs5WDeakHidgEOD0j4HqdPwo6gsmA76Ld0hxkLhbM2RlANiGeuiZRhumyFmvXK&currency=EUR"></script>
<script>
    paypal.Buttons({
        style: {
            color: 'blue'
        },
        createOrder: function(data, actions) {
            const total = document.getElementById('total').textContent.replace('Total: €', '');
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: total
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(detalles) {
                const carrito = JSON.parse(localStorage.getItem('carrito')) || [];
                const productos = carrito.map(producto => ({
                    id: producto.id,
                    nombre: producto.nombre,
                    precio: producto.precio,
                    foto: producto.foto
                }));

                const data = {
                    productos: productos,
                    total: parseFloat(document.getElementById('total').textContent.replace('Total: €', ''))
                };

                fetch('guardar_pedido.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                }).then(response => response.json()).then(data => {
                    if (data.success) {
                        window.location.href = "completado.php";
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

    <?php include("../inicio/footer.php"); ?>
</body>

</html>
