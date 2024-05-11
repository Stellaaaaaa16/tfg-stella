<?php
// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vital";

try {
    // Conexión a la base de datos utilizando PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    // Configurar el modo de error de PDO para que lance excepciones en caso de error
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Realizar la consulta SQL
    $query = "SELECT * FROM servicio";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    
    // Obtener los resultados de la consulta
    $servicios = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch(PDOException $e) {
    // En caso de error en la conexión o la consulta, capturamos la excepción
    echo "Error: " . $e->getMessage();
}

// Cerrar la conexión a la base de datos al terminar
$conn = null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>Carrusel</title>
</head>

<body>
    <div class="carrusel">
        <?php foreach ($servicios as $servicio) { ?>
            <div class="imagenes">
                <div id="texto" class="texto">
                    <h3><?php echo $servicio['Nombre']; ?></h3>
                    <p><?php echo $servicio['Descripcion']; ?></p>
                </div>
            </div>
        <?php } ?>
    </div>

    <script src="app.js"></script>

    <?php
    // Incluir el encabezado (header)
    include("../inicio/footer.php");
    ?>

</body>

</html>
