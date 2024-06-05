<?php
session_start();

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    echo "<script>
            alert('Debes iniciar sesión primero.');
            window.location.href = '../IniciarSesion/iniciar.php';
          </script>";
    exit();
}
include '../admin/config.php';

$pacienteID = $_SESSION['user_id'];
$servicioID = $_POST['servicio'];
$trabajadorID = $_POST['trabajador'];
$fechaHora = $_POST['fecha'] . ' ' . $_POST['hora'];
$nota = !empty($_POST['nota']) ? $_POST['nota'] : NULL;

$stmt = $conn->prepare("INSERT INTO cita (FechaHora, PacienteID, TrabajadorID, ServicioID, Notas) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("siiis", $fechaHora, $pacienteID, $trabajadorID, $servicioID, $nota);

if ($stmt->execute()) {
    echo "<script>
            alert('Cita reservada con éxito.');
            window.location.href = '../inicio/inicio.php';
          </script>";
} else {
    echo "<script>
            alert('Hubo un error al reservar la cita.');
            window.location.href = 'pedir.php';
          </script>";
}

$stmt->close();
$conn->close();
?>
