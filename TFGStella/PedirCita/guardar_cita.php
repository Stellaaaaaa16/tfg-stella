<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}


$host = 'localhost';
$db = 'vital';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}


$user_id = $_SESSION['user_id'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$servicio_id = $_POST['servicio'];
$trabajador_id = $_POST['trabajador'];
$fecha_hora = $fecha . ' ' . $hora;
// entra en la base de datos se guarda cada variable y esto hace que la cita  escogida se guarde en la base de datos haciendo un insert into compronamdo que la hroa se puede seleccionar
$stmt = $pdo->prepare('SELECT * FROM cita WHERE FechaHora = ? AND TrabajadorID = ?');
$stmt->execute([$fecha_hora, $trabajador_id]);

if ($stmt->rowCount() > 0) {
    echo 'La hora seleccionada ya está ocupada. Por favor, elige otra hora.';
} else {
    $stmt = $pdo->prepare('INSERT INTO cita (FechaHora, PacienteID, TrabajadorID, ServicioID) VALUES (?, ?, ?, ?)');
    $stmt->execute([$fecha_hora, $user_id, $trabajador_id, $servicio_id]);
    echo 'Cita guardada con éxito.';
}
?>
