<?php
include '../admin/config.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    $message = $_POST['message'];
    $response = "";

    error_log("Mensaje recibido: " . $message);

    $sql = "SELECT respuesta FROM chatbot WHERE pregunta LIKE ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        error_log("Error en la preparación de la consulta: " . $conn->error);
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    $likeMessage = "%" . $message . "%";
    $stmt->bind_param("s", $likeMessage);
    $stmt->execute();
    $stmt->bind_result($respuesta);

    if ($stmt->fetch()) {
        $response = $respuesta;
    } else {
        $response = "Lo siento, no tengo una respuesta para eso.";
    }

    $stmt->close();
    $conn->close();

    error_log("Respuesta: " . $response);

    echo json_encode(["response" => $response]);
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .chatbot-button {
            position: fixed;
            bottom: 20px;
            left: 20px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 50%;
            padding: 15px;
            cursor: pointer;
        }

        .chatbot-button img {
            width: 30px;
            height: 30px;
        }

        .chatbot-window {
            display: none;
            position: fixed;
            bottom: 80px;
            left: 20px;
            width: 300px;
            max-height: 400px;
            background: white;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            z-index: 1000;
        }

        .chatbot-header {
            background: #333;
            color: white;
            padding: 10px;
            text-align: center;
        }

        .chatbot-messages {
            padding: 10px;
            height: 300px;
            overflow-y: auto;
        }

        .chatbot-input {
            display: flex;
            border-top: 1px solid #ccc;
        }

        .chatbot-input input {
            flex: 1;
            padding: 10px;
            border: none;
            border-radius: 0;
            outline: none;
        }

        .chatbot-input button {
            padding: 10px;
            background: #333;
            color: white;
            border: none;
            cursor: pointer;
        }

        .user-message {
            background-color: #e1ffc7;
            padding: 5px;
            border-radius: 5px;
            margin-bottom: 5px;
            text-align: right;
            word-wrap: break-word;
        }

        .bot-message {
            background-color: #f1f1f1;
            padding: 5px;
            border-radius: 5px;
            margin-bottom: 5px;
            text-align: left;
            word-wrap: break-word;
        }
    </style>
</head>

<body>

    <button class="chatbot-button" onclick="toggleChatbot()">
        <i class="fas fa-robot"></i>
    </button>

    <div class="chatbot-window" id="chatbotWindow">
        <div class="chatbot-header">
            <i class="fas fa-robot"></i> Chatbot
        </div>
        <div class="chatbot-messages" id="chatbotMessages">
        </div>
        <div class="chatbot-input">
            <input type="text" id="chatbotInput" placeholder="Escribe tu mensaje...">
            <button onclick="sendMessage()">Enviar</button>
        </div>
    </div>

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

                fetch('', {
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

</body>

</html>
