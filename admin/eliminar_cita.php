<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (!is_numeric($id)) {
        echo "<p>ID inválido</p>";
        echo "<a class='styled-button' href='index.php?page=listar_cita'>Volver a la página de citas</a>";
        exit();
    }

    $sql = "DELETE FROM cita WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "<p>Cita eliminada con éxito</p>";
    } else {
        echo "<p>Error al eliminar cita: " . $stmt->error . "</p>";
    }

    echo "<a class='styled-button' href='index.php?page=listar_cita'>Volver a la página de citas</a>";
    $conn->close();
} else {
    echo "<p>ID no especificado</p>";
    echo "<a class='styled-button' href='index.php?page=listar_cita'>Volver a la página de citas</a>";
}
?>


<style>
    .boton {
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

    .boton:hover {
        background-color: #45a049;
    }
</style>