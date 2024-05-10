window.addEventListener('scroll', function() {
    var imagenEntrada = document.getElementById('imagenEntrada');
    var scrollPos = window.scrollY;

    // Puedes ajustar la cantidad de desplazamiento para activar la transición
    if (scrollPos > 100) { // Cambia 100 a la posición de scroll que prefieras
        imagenEntrada.classList.add('oculto'); // Oculta la imagen al hacer scroll
    } else {
        imagenEntrada.classList.remove('oculto'); // Muestra la imagen si se desplaza hacia arriba
    }
});
