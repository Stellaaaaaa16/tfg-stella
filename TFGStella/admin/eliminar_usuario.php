<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
// Elimina las citas asociadas al paciente
    $sqlCita = "DELETE FROM cita WHERE PacienteID=$id";
    $conn->query($sqlCita);

    // Elimina el historial médico asociado al paciente
    $sqlHistorial = "DELETE FROM historialmedico WHERE PacienteID=$id";
    $conn->query($sqlHistorial);
// Elimina los registros de productos asociados al paciente
    $sqlPacienteProducto = "DELETE FROM paciente_producto WHERE PacienteID=$id";
    $conn->query($sqlPacienteProducto);
 // Elimina el registro del paciente
    $sqlPaciente = "DELETE FROM paciente WHERE ID=$id";
    if ($conn->query($sqlPaciente) === TRUE) {
        echo "<div class='message-container'>Registro eliminado con éxito";
        echo '<br><form method="get" action="index.php">';
        echo '<input type="submit" value="Volver a la página principal" class="styled-button">';
        echo '</form></div>';
    } else {
        echo "<div class='message-container'>Error: " . $sqlPaciente . "<br>" . $conn->error . '</div>';
    }

    $conn->close();
} else {
    echo "<div class='message-container'>ID no especificado</div>";
}
?>

<style>
    .styled-button {
        background-color: #4CAF50; 
        border: none;
        color: white;
        padding: 10px 24px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 12px;
    }

    .styled-button:hover {
        background-color: #45a049;
    }

    .message-container {
        max-width: 600px;
        margin: 50px auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    @media (max-width: 768px) {
        .styled-button {
            width: 100%;
            font-size: 14px;
            padding: 12px;
        }

        .message-container {
            padding: 15px;
            width: 90%;
        }
    }
</style>
