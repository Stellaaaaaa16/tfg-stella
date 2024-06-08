<?php
include '../admin/config.php';

$fecha = $_POST['fecha'];
$trabajadorID = $_POST['trabajador'];

$horas = [
    '09:00:00', '10:00:00', '11:00:00', '12:00:00', '13:00:00',
    '16:00:00', '17:00:00', '18:00:00', '19:00:00'
];

$query = "SELECT TIME(FechaHora) as hora FROM cita WHERE DATE(FechaHora) = '$fecha' AND TrabajadorID = $trabajadorID";
$result = $conn->query($query);

if (!$result) {
    die("Error en la consulta: " . $conn->error);
}

$horas_ocupadas = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $horas_ocupadas[] = $row['hora'];
    }
}

foreach ($horas as $hora) {
    if (!in_array($hora, $horas_ocupadas)) {
        echo "<option value='$hora'>$hora</option>";
    }
}

$conn->close();
?>
