<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
    
        .boton {
            background-color: purple;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
        }
        .boton:hover {
            background-color: #dda0dd;
        }
        .message {
            text-align: center;
            margin: 15px 0;
        }
        .message .boton {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <?php include("../inicio/header.php"); ?>


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
                echo '<div class="message">El correo electrónico ya está registrado, inicia sesión.<br><button class="boton" onclick="location.href=\'iniciar.php\'">Iniciar Sesión</button></div>';
            } else {
                $stmt = $conn->prepare("INSERT INTO paciente (Nombre, Apellido, FechaNacimiento, Genero, Direccion, Telefono, CorreoElectronico, Contrasena) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssssss", $nombre, $apellidos, $fechaNacimiento, $genero, $direccion, $telefono, $correoElectronico, $contrasena);
                
                if ($stmt->execute()) {
                    echo '<div class="message">Usuario registrado exitosamente.<br><button class="boton" onclick="location.href=\'iniciar.php\'">Iniciar Sesión</button></div>';
                } else {
                    echo "Error: " . $stmt->error;
                }
            }
            
            $stmt->close();
        }

        $conn->close();
        ?>
    </div>
    <?php include("../inicio/footer.php"); ?>
</body>
</html>
