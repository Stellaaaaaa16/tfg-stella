<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vital";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $correoElectronico = $_POST['correoElectronico'];
    $contrasena = $_POST['contrasena'];

    $stmt = $conn->prepare("SELECT ID, Nombre, Contrasena, is_admin FROM paciente WHERE CorreoElectronico = ?");
    $stmt->bind_param("s", $correoElectronico);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $nombre, $hashed_password, $admin);
        $stmt->fetch();

        if (password_verify($contrasena, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $nombre;
            $_SESSION['is_admin'] = $admin;
            $_SESSION['logged_in'] = true;

            echo "<script>
                    alert('Bienvenido, $nombre');
                    window.location.href = '../inicio/inicio.php';
                  </script>";
            exit();
        } else {
            echo "<script>alert('Contraseña incorrecta.'); window.location.href = '../IniciarSesion/iniciar.php';</script>";
        }
    } else {
        echo "<script>alert('El correo electrónico no está registrado.');</script>";
    }

    $stmt->close();
}

$conn->close();
