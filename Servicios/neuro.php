<?php
include("../inicio/header.php");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vital";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT Nombre, Descripcion, Precio, Foto FROM servicio WHERE ID = 4";
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
    <title>Fisioterapia Neurologica</title>
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
                <p>Precio:  <?php echo htmlspecialchars($servicio['Precio']); ?>€</p>
                <button onclick="toggleMoreInfo()" class="btn">

                    <span>Saber Más</span></button>
                <button onclick="pedirCita()" class="btn2">

                    <span>Pedir Cita</span>
                </button>
                <div id="moreInfo" style="display: none;">
                    <h3>Información adicional sobre las lesiones neurológicas:</h3>
                    <h4>Lesiones Neurológicas</h4>
                    <ul>
                        <li>Cefaleas (cefalea tensional, migraña)</li>
                        <li>Hemiplejías (ACV).</li>
                        <li>Esclerosis Múltiple, ELA.</li>
                        <li>Parkinson.</li>
                        <li>Neuralgias.</li>
                    </ul>
                </div>
            </div>
        </div>
    <?php else : ?>
        <p>El servicio no está disponible.</p>
    <?php endif; ?>
    <script>
        function toggleMoreInfo() {
            var moreInfo = document.getElementById("moreInfo");
            if (moreInfo.style.display === "none") {
                moreInfo.style.display = "block";
            } else {
                moreInfo.style.display = "none";
            }
        }

        function pedirCita() {
            window.location.href = "../PedirCita/pedir.php";
        }
    </script>
</body><?php include("../Contacto/chatbot.php"); ?>
    <script>
        function toggleChatbot() {
            const chatbotWindow = document.getElementById('chatbotWindow');
            if (chatbotWindow.style.display === 'none' || chatbotWindow.style.display === '') {
                chatbotWindow.style.display = 'block';
            } else {
                chatbotWindow.style.display = 'none';
            }
        }

        function sendMessage() {
            const input = document.getElementById('chatbotInput');
            const message = input.value.trim();
            if (message) {
                const messages = document.getElementById('chatbotMessages');
                const userMessage = document.createElement('div');
                userMessage.className = 'user-message';
                userMessage.textContent = 'Tú: ' + message;
                messages.appendChild(userMessage);

                input.value = '';

                fetch('../contacto/chatbot.php', { 
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'message=' + encodeURIComponent(message),
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log("Respuesta del backend: ", data); 
                        const botMessage = document.createElement('div');
                        botMessage.className = 'bot-message';
                        botMessage.textContent = 'Bot: ' + data.response;
                        messages.appendChild(botMessage);

                       
                        messages.scrollTop = messages.scrollHeight;
                    })
                    .catch(error => {
                        console.error("Error en la petición fetch: ", error); 
                    });
            }
        }
    </script>

</html>

<?php
include("../inicio/footer.php");
?>