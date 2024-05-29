<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vital";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $fechaNacimiento = $_POST['fechaNacimiento'];
    $genero = $_POST['genero'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $correoElectronico = $_POST['correoElectronico'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT); // Encriptar la contraseña

    // Comprobar si el correo ya está registrado
    $stmt = $conn->prepare("SELECT CorreoElectronico FROM paciente WHERE CorreoElectronico = ?");
    $stmt->bind_param("s", $correoElectronico);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        echo "El correo electrónico ya está registrado.";
    } else {
        // Insertar nuevo usuario en la base de datos
        $stmt = $conn->prepare("INSERT INTO paciente (Nombre, Apellido, FechaNacimiento, Genero, Direccion, Telefono, CorreoElectronico, Contrasena) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $nombre, $apellidos, $fechaNacimiento, $genero, $direccion, $telefono, $correoElectronico, $contrasena);
        
        if ($stmt->execute()) {
            echo "Usuario registrado exitosamente.";
        } else {
            echo "Error: " . $stmt->error;
        }
    }
    
    $stmt->close();
}

$conn->close();
?>
