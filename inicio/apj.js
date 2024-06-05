let imagenes = servicios.map((servicio, index) => {
    return {
        "url": `../img/imgfisio${index + 1}.jpg`,
        "nombre": servicio.Nombre,
        "descripcion": servicio.Descripcion
    };
});

let atras = document.getElementById('atras');
let adelante = document.getElementById('adelante');
let imagen = document.getElementById('img');
let puntos = document.getElementById('puntos');
let texto = document.getElementById('texto');
let actual = 0;

function actualizarCarrusel() {
    console.log('Actualizando carrusel:', imagenes[actual]);
    imagen.innerHTML = `<img class="img" src="${imagenes[actual].url}" alt="${imagenes[actual].nombre}" loading="lazy">`;
    texto.innerHTML = `
        <h3>${imagenes[actual].nombre}</h3>
        <p>${imagenes[actual].descripcion}</p>
    `;
    posicionCarrusel();
}


function posicionCarrusel() {
    puntos.innerHTML = "";
    for (let i = 0; i < imagenes.length; i++) {
        if (i === actual) {
            puntos.innerHTML += '<p class="bold">.</p>';
        } else {
            puntos.innerHTML += '<p>.</p>';
        }
    }
}

actualizarCarrusel();

atras.addEventListener('click', function() {
    actual = (actual - 1 + imagenes.length) % imagenes.length;
    actualizarCarrusel();
});

adelante.addEventListener('click', function() {
    actual = (actual + 1) % imagenes.length;
    actualizarCarrusel();
});
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
}  function handleCookieConsent(isAccepted) {
    const consentBox = document.getElementById('cookieConsent');
    if (isAccepted) {
        consentBox.style.backgroundColor = '#4CAF50';
    } else {
        consentBox.style.backgroundColor = '#f44336';
    }
    setTimeout(() => {
        consentBox.style.display = 'none';
    }, 500);
}