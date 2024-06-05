<?php
session_start();

$usuarioLogueado = isset($_SESSION['usuario_id']);
include '../admin/config.php';

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
    <link rel="icon" href="../img/logo_sin_fondo.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet" type="text/css" media="all">
    <style>
        .producto .datos h2 a,
        .producto .datos h3 a,
        .producto .precios div span {
            text-transform: capitalize;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.producto .datos h2 a, .producto .datos h3 a, .producto .precios div span');

            elements.forEach(function(element) {
                let text = element.textContent.toLowerCase();
                element.textContent = text.charAt(0).toUpperCase() + text.slice(1);
            });
        });
    </script>
    <script>
        var usuarioLogueado = <?php echo json_encode($usuarioLogueado); ?>;
    </script>
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
                <?php if (!empty($productos)) : ?>
                    <?php foreach ($productos as $producto) : ?>
                        <div class="producto item">
                            <div class="contenedor-imagen">
                                <a href="producto_detalle.php?id=<?php echo $producto['ID']; ?>" class="link"></a>
                                <img src="<?php echo $producto['Foto']; ?>" alt="<?php echo $producto['Nombre']; ?>">
                                <?php if (!empty($producto['Foto'])) : ?>
                                    <img src="<?php echo $producto['Foto']; ?>" class="img-hover" alt="<?php echo $producto['Nombre']; ?>">
                                <?php endif; ?>
                            </div>
                            <div class="datos">
                                <div class="starrr"></div>
                                <small>
                                    <h3><a href="producto_detalle.php?id=<?php echo $producto['ID']; ?>"><?php echo $producto['Nombre']; ?></a></h3>
                                </small>
                                <h2><a href="producto_detalle.php?id=<?php echo $producto['ID']; ?>"><?php echo $producto['Descripcion']; ?></a></h2>
                            </div>
                            <div class="precios">
                                <div class="internet">
                                    <small>Precio</small>
                                    <span>€<?php echo number_format($producto['Precio'], 2); ?></span>
                                </div>
                            </div>
                            <a href="#" class="btn-carrito" data-nombre="<?php echo $producto['Nombre']; ?>" data-precio="<?php echo $producto['Precio']; ?>" data-foto="<?php echo $producto['Foto']; ?>" onclick="addToCart(event, '<?php echo $producto['Nombre']; ?>', '<?php echo $producto['Precio']; ?>', '<?php echo $producto['Foto']; ?>')">
                                <i class="fas fa-shopping-basket"></i> Agregar al carrito
                            </a>
                            <button class="btn-descripcion" onclick="toggleDescripcion(<?php echo $producto['ID']; ?>)">
                                Leer Descripción
                            </button>
                            <div id="descripcion-<?php echo $producto['ID']; ?>" class="descripcion" style="display: none;">
                                <?php echo $producto['Descripcion']; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p>No hay productos disponibles</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div id="carrito" class="carrito-menu">
        <div class="carrito-contenido">
            <h3>Carrito de Compras</h3>
            <div id="productos-carrito"></div>
            <a href="transmitir_pedido.php" class="btn-comprar">Transmitir Pedido</a>
        </div>
    </div>
    <?php include("../Contacto/chatbot.php"); ?>
    <script>
        function toggleDescripcion(id) {
            const descripcion = document.getElementById('descripcion-' + id);
            if (descripcion.style.display === 'none' || descripcion.style.display === '') {
                descripcion.style.display = 'block';
            } else {
                descripcion.style.display = 'none';
            }
        }

        function toggleChatbot() {
            const chatbotWindow = document.getElementById('chatbotWindow');
            if (chatbotWindow.style.display === 'none' || chatbotWindow.style.display === '') {
                chatbotWindow.style.display = 'block';
            } else {
                chatbotWindow.style.display = 'none';
            }
        }

        function sendMessage() {
            const input = document.getElementById('chatbotInput');
            const message = input.value.trim();
            if (message) {
                const messages = document.getElementById('chatbotMessages');
                const userMessage = document.createElement('div');
                userMessage.className = 'user-message';
                userMessage.textContent = 'Tú: ' + message;
                messages.appendChild(userMessage);

                input.value = '';

                fetch('../contacto/chatbot.php', { 
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'message=' + encodeURIComponent(message),
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log("Respuesta del backend: ", data); 
                        const botMessage = document.createElement('div');
                        botMessage.className = 'bot-message';
                        botMessage.textContent = 'Bot: ' + data.response;
                        messages.appendChild(botMessage);

                      
                        messages.scrollTop = messages.scrollHeight;
                    })
                    .catch(error => {
                        console.error("Error en la petición fetch: ", error); 
                    });
            }
        }
    </script>
    <?php include("../inicio/footer.php"); ?>
</body>

</html>
