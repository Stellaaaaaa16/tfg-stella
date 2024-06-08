let imagenes = servicios.map((servicio, index) => {
    return {
        "url": `../img/imgfisio${index + 1}.jpg`,
        "nombre": servicio.Nombre,
        "descripcion": servicio.Descripcion
    };
});
//manegar el carrousel primero declaramos variables
let atras = document.getElementById('atras');
let adelante = document.getElementById('adelante');
let imagen = document.getElementById('img');
let puntos = document.getElementById('puntos');
let texto = document.getElementById('texto');
let actual = 0;
//para que vaya en fincion con la base de datos y las imagenes subidas
function actualizarCarrusel() {
    console.log('Actualizando carrusel:', imagenes[actual]);
    imagen.innerHTML = `<img class="img" src="${imagenes[actual].url}" alt="${imagenes[actual].nombre}" loading="lazy">`;
    texto.innerHTML = `
        <h3>${imagenes[actual].nombre}</h3>
        <p>${imagenes[actual].descripcion}</p>
    `;
    posicionCarrusel();
}

//indica la posicion actual del carrousel
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
//si le das click atrasa el carrousel cogiedno la posicion axtual y retrasandola
atras.addEventListener('click', function() {
    actual = (actual - 1 + imagenes.length) % imagenes.length;
    actualizarCarrusel();
});
//al igual que la de atras pero para adelante
adelante.addEventListener('click', function() {
    actual = (actual + 1) % imagenes.length;
    actualizarCarrusel();
});
//chatboe esto hace que no tenga estilo y se pueda deplegar o se quede como en inicio con un boton
function toggleChatbot() {
    const chatbotWindow = document.getElementById('chatbotWindow');
    if (chatbotWindow.style.display === 'none' || chatbotWindow.style.display === '') {
        chatbotWindow.style.display = 'block';
    } else {
        chatbotWindow.style.display = 'none';
    }
}
//para enviar un mensaje al chatbot y se depliegue el menu que haya un diferencia del chatbot con el usuario
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