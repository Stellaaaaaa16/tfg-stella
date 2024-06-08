window.addEventListener('scroll', function() {
    var imagenEntrada = document.getElementById('imagenEntrada');
    var scrollPos = window.scrollY;
    if (scrollPos > 100) { 
        imagenEntrada.classList.add('oculto'); // Oculta la imagen al hacer scroll
    } else {
        imagenEntrada.classList.remove('oculto'); // Muestra la imagen si se desplaza hacia arriba
    }
});
