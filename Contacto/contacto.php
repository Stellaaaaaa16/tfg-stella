<?php
include("../inicio/header.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: auto;
            overflow: hidden;
            padding: 20px;
        }

        header {
            background: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        .section {
            padding: 20px 0;
            border-bottom: 1px solid #ddd;
        }

        .section:last-child {
            border-bottom: none;
        }

        h2 {
            color: #333;
        }

        .contact-info, .hours {
            list-style: none;
            padding: 0;
        }

        .contact-info li, .hours li {
            margin: 10px 0;
        }

        iframe {
            width: 100%;
            height: 400px;
            border: 0;
        }

        .flex-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .contact, .hours {
            width: 48%;
            background: #f4f4f4;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .contact, .hours {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<header>
    <h1>Contacto</h1>
</header>

<div class="container">
    <div class="section flex-container">
        <div class="contact">
            <h2>Información de Contacto</h2>
            <ul class="contact-info">
                <li><strong>Teléfono:</strong> +34 651 06 53 27</li>
                <li><strong>Email:</strong> stellapozofernandez@gmail.com</li>
                <li><strong>Facebook:</strong> <a href="https://facebook.com/ejemplo" target="_blank">facebook.com/ejemplo</a></li>
                <li><strong>Twitter:</strong> <a href="https://twitter.com/ejemplo" target="_blank">@ejemplo</a></li>
                <li><strong>Instagram:</strong> <a href="https://instagram.com/ejemplo" target="_blank">@ejemplo</a></li>
            </ul>
        </div>

        <div class="hours">
            <h2>Horario</h2>
            <ul>
                <li><strong>Lunes a Viernes:</strong></li>
                <li>09:00 - 14:00</li>
                <li>16:00 - 20:00</li>
            </ul>
        </div>
    </div>
    <div class="section">
        <h2>Ubicación</h2>
        <p>Dirección: Calle tierno, Madrid</p>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d24339.61403170023!2d-3.783528851743991!3d40.31013049793949!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd418a25b1944a9f%3A0x4d7e9ac150d5d1c6!2sIES%20Enrique%20Tierno%20Galv%C3%A1n!5e0!3m2!1ses!2ses!4v1712846040041!5m2!1ses!2ses" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</div>

<?php
    include("../Contacto/chatbot.php");
    include("../inicio/footer.php");
?>
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
</body>

</html>
