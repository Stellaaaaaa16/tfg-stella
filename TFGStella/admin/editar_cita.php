<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // si las id existern se recogen por get

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fechaHora = $_POST["FechaHora"];
        $pacienteID = $_POST["PacienteID"];
        $trabajadorID = $_POST["TrabajadorID"];
        $servicioID = $_POST["ServicioID"];
        $notas = $_POST["Notas"];

        $sql = "UPDATE cita SET FechaHora='$fechaHora', PacienteID='$pacienteID', TrabajadorID='$trabajadorID', ServicioID='$servicioID', Notas='$notas' WHERE ID=$id";

        if ($conn->query($sql) === TRUE) {
            echo "<p>Cita actualizada con éxito</p>";
            echo "<a class='boton' href='index.php'>Volver a la página principal</a>";
        } else {
            echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
            echo "<a class='boton' href='index.php'>Volver a la página principal</a>";
        }

        $conn->close();
    } else {
        $sql = "SELECT * FROM cita WHERE ID=$id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            ?>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . "?page=editar_cita&id=$id");?>">
              Fecha y Hora: <input type="datetime-local" name="FechaHora" value="<?php echo $row['FechaHora'];?>"><br>
              <!-- formulario para editar la cita -->
              Paciente:
              <select name="PacienteID">
                <?php
                $sql = "SELECT ID, Nombre FROM paciente";
                // nombre del apciente
                $resultPaciente = $conn->query($sql);
                while($paciente = $resultPaciente->fetch_assoc()) {
                    $selected = $row['PacienteID'] == $paciente['ID'] ? 'selected' : '';
                    echo "<option value='" . $paciente["ID"] . "' $selected>" . $paciente["Nombre"] . "</option>";
                }
                ?>
              </select><br>
              Trabajador:
              <select name="TrabajadorID">
                <?php
                $sql = "SELECT ID, Nombre FROM trabajador";
                $resultTrabajador = $conn->query($sql);
                // si ocincide el trbajador con el resultado de la query puede cambiarse con lo seleccionadoa
                while($trabajador = $resultTrabajador->fetch_assoc()) {
                    $selected = $row['TrabajadorID'] == $trabajador['ID'] ? 'selected' : '';
                    echo "<option value='" . $trabajador["ID"] . "' $selected>" . $trabajador["Nombre"] . "</option>";
                }
                ?>
              </select><br>
              Servicio:
              <select name="ServicioID">
                <?php
                $sql = "SELECT ID, Nombre FROM servicio";
                $resultServicio = $conn->query($sql);
                while($servicio = $resultServicio->fetch_assoc()) {
                    $selected = $row['ServicioID'] == $servicio['ID'] ? 'selected' : '';
                    echo "<option value='" . $servicio["ID"] . "' $selected>" . $servicio["Nombre"] . "</option>";
                }
                ?>
              </select><br>
              Notas: <textarea name="Notas"><?php echo $row['Notas'];?></textarea><br>
              <input type="submit" value="Actualizar">
            </form>
            <?php
        } else {
            echo "<p>No se encontró la cita</p>";
            echo "<a class='boton' href='index.php'>Volver a la página principal</a>";
        }
    }
} else {
    echo "<p>ID no especificado</p>";
    echo "<a class='boton' href='index.php'>Volver a la página principal</a>";
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
