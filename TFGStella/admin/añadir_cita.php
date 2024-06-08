<?php
include 'config.php';

$formularioMostrado = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fechaHora = $_POST["FechaHora"];
    $pacienteID = $_POST["PacienteID"];
    $trabajadorID = $_POST["TrabajadorID"];
    $servicioID = $_POST["ServicioID"];
    $notas = $_POST["Notas"];

    $sql = "INSERT INTO cita (FechaHora, PacienteID, TrabajadorID, ServicioID, Notas)
    VALUES ('$fechaHora', '$pacienteID', '$trabajadorID', '$servicioID', '$notas')";

    if ($conn->query($sql) === TRUE) {
      // cita añadida con exito
        echo "Nueva cita agregada con éxito";
        $formularioMostrado = false;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<?php if ($formularioMostrado): ?>
  <!-- muestra el formulario si es true -->
<form method="post" action="<?php echo $_SERVER['PHP_SELF'] . '?page=añadir_cita';?>">
  Fecha y Hora: <input type="datetime-local" name="FechaHora"><br>
  Paciente:
  <select name="PacienteID">
    <?php
    // lista de pacientes
    $sql = "SELECT ID, Nombre FROM paciente";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
// bucle para mostrar los pacientes con su nombre
      echo "<option value='" . $row["ID"] . "'>" . $row["Nombre"] . "</option>";
    }
    ?>
  </select><br>
  Trabajador:
  <select name="TrabajadorID">
    <?php
    $sql = "SELECT ID, Nombre FROM trabajador";
    // lista de trabajadores
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
      // bucle para mostrar los trabajadores con su nombre
        echo "<option value='" . $row["ID"] . "'>" . $row["Nombre"] . "</option>";
    }
    ?>
  </select><br>
  Servicio:
  <select name="ServicioID">
    <?php
    $sql = "SELECT ID, Nombre FROM servicio";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
        echo "<option value='" . $row["ID"] . "'>" . $row["Nombre"] . "</option>";
    }
    ?>
  </select><br>
  Notas: <textarea name="Notas"></textarea><br>
  <input type="submit" value="Añadir Cita">
</form>
<?php else: ?>
<br>

<?php endif; ?>

<a class="boton" href="index.php">Volver a la página principal</a>

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