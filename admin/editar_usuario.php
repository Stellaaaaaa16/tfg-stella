<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST["Nombre"];
        $apellido = $_POST["Apellido"];
        $fechaNacimiento = $_POST["FechaNacimiento"];
        $genero = $_POST["Genero"];
        $direccion = $_POST["Direccion"];
        $telefono = $_POST["Telefono"];
        $correoElectronico = $_POST["CorreoElectronico"];

        $sql = "UPDATE paciente SET Nombre='$nombre', Apellido='$apellido', FechaNacimiento='$fechaNacimiento', Genero='$genero', Direccion='$direccion', Telefono='$telefono', CorreoElectronico='$correoElectronico' WHERE ID=$id";

        if ($conn->query($sql) === TRUE) {
            echo "<p>Registro actualizado con éxito</p>";
            echo "<a href='index.php' class='button'>Volver al panel de administración</a>";
        } else {
            echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }

        $conn->close();
    } else {
        $sql = "SELECT * FROM paciente WHERE ID=$id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            ?>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . "?page=editar_usuario&id=$id"); ?>">
                Nombre: <input type="text" name="Nombre" value="<?php echo $row['Nombre'];?>" required><br>
                Apellido: <input type="text" name="Apellido" value="<?php echo $row['Apellido'];?>" required><br>
                Fecha de Nacimiento: <input type="date" name="FechaNacimiento" value="<?php echo $row['FechaNacimiento'];?>" required><br>
                Género: <input type="text" name="Genero" value="<?php echo $row['Genero'];?>" required><br>
                Dirección: <input type="text" name="Direccion" value="<?php echo $row['Direccion'];?>" required><br>
                Teléfono: <input type="text" name="Telefono" value="<?php echo $row['Telefono'];?>" required><br>
                Correo Electrónico: <input type="email" name="CorreoElectronico" value="<?php echo $row['CorreoElectronico'];?>" required><br>
                <input type="submit" value="Actualizar">
            </form>
            <?php
        } else {
            echo "<p>No se encontró el usuario</p>";
        }
    }
} else {
    echo "<p>ID no especificado</p>";
}
?>

<style>
    .button {
        display: inline-block;
        padding: 10px 20px;
        font-size: 16px;
        font-weight: bold;
        text-align: center;
        text-decoration: none;
        background-color: #4CAF50;
        color: white;
        border-radius: 5px;
        margin-top: 20px;
    }

    .button:hover {
        background-color: #45a049;
    }

    form {
        max-width: 600px;
        margin: 0 auto;
    }

    input[type="text"],
    input[type="date"],
    input[type="email"] {
        width: 100%;
        padding: 10px;
        margin: 5px 0 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 12px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin-top: 10px;
        cursor: pointer;
        border-radius: 4px;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }

    @media (max-width: 768px) {
        form {
            padding: 0 20px;
        }
    }
</style>
