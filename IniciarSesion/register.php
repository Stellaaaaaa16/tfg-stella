<?php
include '../admin/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $fechaNacimiento = $_POST['fechaNacimiento'];
    $genero = $_POST['genero'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $correoElectronico = $_POST['correoElectronico'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT); 

    $stmt = $conn->prepare("SELECT CorreoElectronico FROM paciente WHERE CorreoElectronico = ?");
    $stmt->bind_param("s", $correoElectronico);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        echo "El correo electrónico ya está registrado.";
    } else {
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