<?php
include("../inicio/header.php");

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

// Consulta para obtener los servicios
$sql = "SELECT Nombre, Descripcion FROM servicio";
$result = $conn->query($sql);

$servicios = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $servicios[] = $row;
    }
}

// Consulta para obtener los trabajadores junto con el nombre del servicio
$sqlTrabajadores = "
    SELECT trabajador.Nombre AS TrabajadorNombre, trabajador.Apellido, servicio.Nombre AS ServicioNombre, trabajador.Foto
    FROM trabajador
    LEFT JOIN servicio ON trabajador.ServicioID = servicio.ID
";
$resultTrabajadores = $conn->query($sqlTrabajadores);

$trabajadores = [];
if ($resultTrabajadores->num_rows > 0) {
    while ($row = $resultTrabajadores->fetch_assoc()) {
        $trabajadores[] = $row;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>Vital Yaiza</title>
</head>

<body>
    <div class="wrap-header-principal fixed-navbar" id="navbar">
        <main class="menu-principal ">
            <section class="pagina-inicio">
                <div class="titulo-pagina-inicio titulo-bienvenida">
                    <h1>Bienvenidos a Vital Yaiza</h1>
                    <p>En nuestra clínica, nos dedicamos apasionadamente a tu bienestar físico y emocional.<br>
                        Con un equipo de fisioterapeutas altamente capacitados y un enfoque personalizado en cada paciente,
                        estamos aquí para acompañarte en tu camino hacia una vida plena y sin dolor.</p><br>

                    <a href="../PedirCita/pedir.php" class="gradient-btn"> PIDE CITA </a>
                </div>
            </section>
        </main>
    </div>

    <h1 class="titulo-bonito">SERVICIOS</h1>

    <div class="carrusel">
        <div class="atras click-effect">
            <img id="atras" src="../img/atras.svg" alt="atras" loading="lazy">
        </div>
        <div class="imagenes">
            <div id="img">
                <img class="img" src="../img/imgfisio2.jpg" alt="imagen 1" loading="lazy">
            </div>
            <div id="texto" class="texto">
                <h3>Proyecto 01</h3>
                <p></p>
            </div>
        </div>
        <div class="adelante click-effect" id="adelante">
            <img src="../img/adelante.svg" alt="adelante" loading="lazy">
        </div>
    </div>
    <div class="puntos" id="puntos"></div>
    <br><br>

    <div class="container">
        <h1 class="titulo-bonito">
            SOBRE NOSOTRAS
        </h1>
        <div class="profiles">
            <?php foreach ($trabajadores as $trabajador) : ?>
                <div class="profile">
                    <img src="<?php echo htmlspecialchars($trabajador['Foto']); ?>" class="profile-img">
                    <h3 class="user-name"><?php echo htmlspecialchars($trabajador['TrabajadorNombre']) . ' ' . htmlspecialchars($trabajador['Apellido']); ?></h3>
                    <h5><?php echo htmlspecialchars($trabajador['ServicioNombre']); ?></h5>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        let servicios = <?php echo json_encode($servicios); ?>;
    </script>
    <script src="apj.js"></script>
    <?php
    include("../inicio/footer.php");
    ?>
</body>

</html>