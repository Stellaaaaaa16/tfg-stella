function onSubmit(token) {
    document.getElementById("signupForm").submit();
}

function togglePasswordVisibility(id) {
    const passwordField = document.getElementById(id);
    if (passwordField.type === "password") {
        passwordField.type = "text";
    } else {
        passwordField.type = "password";
    }
} function toggleChatbot() {
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
                console.error("Error en la petición fetch: ", error); // Añadir depuración
            });
    }
} const container2 = document.getElementById('container2');

function openSignIn() {
    container2.classList.remove("right-panel-active");
}

function openSignUp() {
    container2.classList.add("right-panel-active");
}document.addEventListener('DOMContentLoaded', function () {
    const goToSignUp = document.getElementById('goToSignUp');
    const container = document.getElementById('container2');

    goToSignUp.addEventListener('click', function (event) {
        event.preventDefault();
        container.classList.add('right-panel-active');
    });
});
