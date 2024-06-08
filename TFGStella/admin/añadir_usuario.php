<?php
include 'config.php';

$formularioMostrado = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["Nombre"];
    $apellido = $_POST["Apellido"];
    $fechaNacimiento = $_POST["FechaNacimiento"];
    $genero = $_POST["Genero"];
    $direccion = $_POST["Direccion"];
    $telefono = $_POST["Telefono"];
    $correoElectronico = $_POST["CorreoElectronico"];
    $contrasena = password_hash($_POST["Contrasena"], PASSWORD_BCRYPT);
    $is_admin = isset($_POST["is_admin"]) ? 1 : 0;

    $sql = "INSERT INTO paciente (Nombre, Apellido, FechaNacimiento, Genero, Direccion, Telefono, CorreoElectronico, Contrasena, is_admin)
    VALUES ('$nombre', '$apellido', '$fechaNacimiento', '$genero', '$direccion', '$telefono', '$correoElectronico', '$contrasena', '$is_admin')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Nuevo usuario agregado con éxito</p>";
        echo "<a href='index.php' class='button'>Volver al panel de administración</a>";
        $formularioMostrado = false;
    } else {
        echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }

    $conn->close();
}
?>

<?php if ($formularioMostrado): ?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . '?page=añadir_usuario'); ?>">
    Nombre: <input type="text" name="Nombre" required><br>
    Apellido: <input type="text" name="Apellido" required><br>
    Fecha de Nacimiento: <input type="date" name="FechaNacimiento" required><br>
    Género: <input type="text" name="Genero" required><br>
    Dirección: <input type="text" name="Direccion" required><br>
    Teléfono: <input type="text" name="Telefono" required><br>
    Correo Electrónico: <input type="email" name="CorreoElectronico" required><br>
    Contraseña: <input type="password" name="Contrasena" required><br>
    Administrador: <input type="checkbox" name="is_admin"><br>
    <input type="submit" value="Agregar Usuario">
</form>
<?php endif; ?>

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
    input[type="email"],
    input[type="password"] {
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
