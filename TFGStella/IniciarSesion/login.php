<?php
session_start();
include('../admin/config.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // variables enviadas
    $correoElectronico = $_POST['correoElectronico'];
    $contrasena = $_POST['contrasena'];

    $stmt = $conn->prepare("SELECT ID, Nombre, Contrasena, is_admin FROM paciente WHERE CorreoElectronico = ?");
    $stmt->bind_param("s", $correoElectronico);
    $stmt->execute();
    $stmt->store_result();
// si existe el correo que se ha iniciado se en laza con las variables del usuario
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $nombre, $hashed_password, $admin);
        $stmt->fetch();

        if (password_verify($contrasena, $hashed_password)) {
            // almacena las vatiables si la contraseña coincide con la contraseña de bbdd
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
