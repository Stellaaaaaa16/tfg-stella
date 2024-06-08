<?php
include("../inicio/header.php");

include('../admin/config.php');

$sql = "SELECT Nombre, Descripcion, Precio, Foto FROM servicio WHERE ID = 1";
$result = $conn->query($sql);

$servicio = null;
if ($result->num_rows > 0) {
    $servicio = $result->fetch_assoc();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Fisioterapia de Suelo Pélvico</title>

</head>

<body>
    <?php if ($servicio) : ?>
        <h2><?php echo htmlspecialchars($servicio['Nombre']); ?></h2>
        <div class="servicio-container">
            <div class="servicio-img">
                <img src="<?php echo htmlspecialchars($servicio['Foto']); ?>" alt="<?php echo htmlspecialchars($servicio['Nombre']); ?>">
            </div>
            <div class="servicio-descripcion">
                <p><?php echo nl2br(htmlspecialchars($servicio['Descripcion'])); ?></p>
                <p>Precio: <?php echo htmlspecialchars($servicio['Precio']); ?>€</p>
                <button onclick="toggleMoreInfo()" class="btn">
                  
                    <span>Saber Más</span></button>
                <button onclick="pedirCita()" class="btn2">
                   
                    <span>Pedir Cita</span>
                </button>
                <div id="moreInfo" style="display: none;">
                    <h3>Información adicional sobre la Disfunción del Suelo Pélvico:</h3>
                    <h4>Patología uroginecológica</h4>
                    <ul>
                        <li>Incontinencias urinarias de esfuerzo, urgencia o mixta.</li>
                        <li>Prolapsos (desprendimientos) de útero (uterocele), vejiga (vesicocele), uretra (uretrocele) o recto (rectocele).</li>
                        <li>Congestiones pélvicas.</li>
                        <li>Problemas menstruales como por ejemplo dismenorreas o amenorreas.</li>
                        <li>Disfunciones sexuales como vulvodinias, vaginismos o dispareunias.</li>
                        <li>Dolor pélvico crónico.</li>
                        <li>Dolor neuropático.</li>
                        <li>Neuropatías del nervio pudendo.</li>
                        <li>Estreñimiento funcional y crónico.</li>
                    </ul>
                    <h4>Patología habitual obstétrica</h4>
                    <ul>
                        <li>Ciáticas o cistalgias.</li>
                        <li>Lumbalgias.</li>
                        <li>Dolor en la región sacra.</li>
                        <li>Síndrome del piramidal.</li>
                        <li>Piernas hinchadas.</li>
                        <li>Dolor pélvico.</li>
                        <li>Ardores y acidez.</li>
                        <li>Varices vulvares.</li>
                    </ul>
                    <h4>Secuelas postparto</h4>
                    <ul>
                        <li>Dolor en la región de la episiotomía o desgarro.</li>
                        <li>Dolor al mantener relaciones sexuales (dispareunias, vaginismos, vulvodinias).</li>
                        <li>Incontinencias de orina de esfuerzo, urgencia o mixta.</li>
                        <li>Incontinencias fecales o a gases.</li>
                        <li>Neuropatías del nervio pudendo.</li>
                        <li>Dolor secundario a la epidural.</li>
                        <li>Adherencias en la cicatriz de la cesárea.</li>
                    </ul>
                </div>
            </div>
        </div>
    <?php else : ?>
        <p>El servicio no está disponible.</p>
    <?php endif; ?>
    </div>

    <script src="script.js">
    </script>
</body><?php include("../Contacto/chatbot.php"); ?>
<script src="../Contacto/scriptchat.js">
</script>

</html>

<?php
include("../inicio/footer.php");
?>