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

        fetch('../Contacto/chatbot.php', { 
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