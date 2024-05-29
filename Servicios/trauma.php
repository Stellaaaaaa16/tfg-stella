<?php
// Incluir el encabezado (header)
include("../inicio/header.php");

// Detalles de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vital";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT Nombre, Descripcion, Precio, Foto FROM servicio WHERE ID = 3";
$result = $conn->query($sql);

$servicio = null;
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
    <title>Fisioterapia Traumatologica</title>
</head>

<body>
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

                    <span>Saber Más</span></button>
                <button onclick="pedirCita()" class="btn2">

                    <span>Pedir Cita</span>
                </button>
                <div id="moreInfo" style="display: none;">
                    <h3>Información adicional sobre las lesiones traumatólogica:</h3>
                    <h4>Lesiones traumatólogica</h4>
                    <ul>
                        <li>Patologías de la columna vertebral (cervicalgias, dorsalgias, lumbalgias, ciatalgia, hernias discales,etc)</li>
                        <li>Recuperación pre y post-quirúrgica.</li>
                        <li>Fracturas, luxaciones, contusiones.</li>
                        <li>Disfunción cráneo-mandibular (ATM, bruxismo,chasquidos)</li>
                        <li>Accidentes de tráfico y laborales.</li>
                    </ul>
                </div>
            </div>
        </div>
        </div>
        </div>
    <?php else : ?>
        <p>El servicio no está disponible.</p>
    <?php endif; ?>
    <script>
        function toggleMoreInfo() {
            var moreInfo = document.getElementById("moreInfo");
            if (moreInfo.style.display === "none") {
                moreInfo.style.display = "block";
            } else {
                moreInfo.style.display = "none";
            }
        }

        function pedirCita() {
            // Aquí puedes agregar el código para redirigir a la página de solicitud de cita
            window.location.href = "../PedirCita/pedir.php";
        }
    </script>
</body>

</html>

<?php
// Incluir el pie de página (footer)
include("../inicio/footer.php");
?>