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
