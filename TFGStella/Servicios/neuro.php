<?php
include("../inicio/header.php");

include('../admin/config.php');
// informaicon del servicio 
$sql = "SELECT Nombre, Descripcion, Precio, Foto FROM servicio WHERE ID = 4";
$result = $conn->query($sql);

$servicio = null;
//guarda el primer resultado en la variable $servicio
if ($result->num_rows > 0) {
    $servicio = $result->fetch_assoc();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Fisioterapia Neurologica</title>
</head>

<body>
    <!-- Comprueba si se encontraron datos del servicio -->
    <?php if ($servicio) : ?>
        <h2><?php echo htmlspecialchars($servicio['Nombre']); ?></h2>
        <div class="servicio-container">
            <div class="servicio-img">
                <img src="<?php echo htmlspecialchars($servicio['Foto']); ?>" alt="<?php echo htmlspecialchars($servicio['Nombre']); ?>">
            </div>
            <div class="servicio-descripcion">
                <p><?php echo nl2br(htmlspecialchars($servicio['Descripcion'])); ?></p>
                <p>Precio: <?php echo htmlspecialchars($servicio['Precio']); ?>€</p>
                <button onclick="toggleMoreInfo()" class="btn">
                    <span>Saber Más</span>
                </button>
                <button onclick="pedirCita()" class="btn2">
                    <span>Pedir Cita</span>
                </button>
                <div id="moreInfo" style="display: none;">
                    <h3>Información adicional sobre las lesiones neurológicas:</h3>
                    <h4>Lesiones Neurológicas</h4>
                    <ul>
                        <li>Cefaleas (cefalea tensional, migraña)</li>
                        <li>Hemiplejías (ACV).</li>
                        <li>Esclerosis Múltiple, ELA.</li>
                        <li>Parkinson.</li>
                        <li>Neuralgias.</li>
                    </ul>
                </div>
            </div>
        </div>
    <?php else : ?>
        <p>El servicio no está disponible.</p>
    <?php endif; ?>

    <script src="script.js">
    </script>
</body><?php include("../Contacto/chatbot.php"); ?>
<script src="../Contacto/scriptchat.js">
</script>

</html>

<?php
include("../inicio/footer.php");
?>