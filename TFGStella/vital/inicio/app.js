let imagenes = [
    {
        "url": "../img/imgfisio1.jpg",
        "nombre": "Servicio 01",
        "descripcion": ""

    },
    {
        "url": "../img/imgfisio2.jpg",
        "nombre": "Servicio 02",
        "descripcion": ""

    },
    {
        "url": "../img/imgfisio3.jpg",
        "nombre": "Servicio 03",
        "descripcion": ""

    },
    {
        "url": "../img/imgfisio3.jpg",
        "nombre": "Bono 01",
        "descripcion": ""

    },
    {
        "url": "../img/imgfisio3.jpg",
        "nombre": "Bono 02",
        "descripcion": "E"

    }
    
]
//variables para los iconos iteractivos

let atras = document.getElementById('atras');
let adelante = document.getElementById('adelante');
let imagen = document.getElementById('img');
let puntos = document.getElementById('puntos'); //para las imagenes
let texto = document.getElementById('texto')
let actual = 0
posicionCarrusel()
//por cada vez que se haga click en la imagen entra en la funcion, y va para atras, ya que se resta 1
atras.addEventListener('click', function(){
    actual -=1

    if (actual == -1){
        actual = imagenes.length - 1
    }

    imagen.innerHTML = ` <img class="img" src="${imagenes[actual].url}" alt="logo pagina" loading="lazy"></img>`
    texto.innerHTML = `
    <h3>${imagenes[actual].nombre}</h3>
    <p>${imagenes[actual].descripcion}</p>
    `
    posicionCarrusel()
})  
//por cada vez que se haga click en la parte de delante se le suamu no y pasa a la siguiente imagen con la nueva url
adelante.addEventListener('click', function(){
    actual +=1

    if (actual == imagenes.length){
        actual = 0
    }

    imagen.innerHTML = ` <img class="img" src="${imagenes[actual].url}" alt="logo pagina" loading="lazy"></img>`
    texto.innerHTML = `
    <h3>${imagenes[actual].nombre}</h3>
    <p>${imagenes[actual].descripcion}</p>
    `
    posicionCarrusel()
})  
//posicion de la imagen posteriormente para los puntoss
function posicionCarrusel() {
    puntos.innerHTML = ""
    for (var i = 0; i <imagenes.length; i++){
        if(i == actual){
            puntos.innerHTML += '<p class="bold">.<p>'
        }
        else{
            puntos.innerHTML += '<p>.<p>'
        }
    } 
}

