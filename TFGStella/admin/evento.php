<?php
include 'config.php';

$sql = "SELECT c.FechaHora, p.Nombre AS Paciente, t.Nombre AS Trabajador
        FROM cita c
        LEFT JOIN paciente p ON c.PacienteID = p.ID
        LEFT JOIN trabajador t ON c.TrabajadorID = t.ID";
$result = $conn->query($sql);

$events = array();
while ($row = $result->fetch_assoc()) {
    $color = "";
    if ($row['Trabajador'] == 'Yaiza Pozo') {
        $color = "blue";
    } elseif ($row['Trabajador'] == 'Míriam Montero') {
        $color = "green";
    } elseif ($row['Trabajador'] == 'Irene Sánchez') {
        $color = "yellow";
    }

    $events[] = array(
        'title' => $row['Paciente'],
        'start' => $row['FechaHora'],
        'color' => $color
    );
}

$conn->close();
echo json_encode($events);
?>