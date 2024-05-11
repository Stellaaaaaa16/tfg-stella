<script>
        document.addEventListener("DOMContentLoaded", function () {
            // Manejar el clic en el botón del menú desplegable en dispositivos móviles
            document.querySelector('.navbar-toggler').addEventListener('click', function () {
                document.querySelector('.navbar-collapse').classList.toggle('show');
            });

            // Manejar el clic en el enlace del menú desplegable en dispositivos móviles
            document.querySelectorAll('.navbar-nav .nav-item .nav-link').forEach(function (link) {
                link.addEventListener('click', function () {
                    document.querySelector('.navbar-collapse').classList.remove('show');
                });
            });

            // Manejar el clic en el elemento "Servicios" para mostrar el menú desplegable
            var servicesDropdown = document.getElementById('servicesDropdown');
            var dropdownMenu = servicesDropdown.querySelector('.dropdown-menu');

            servicesDropdown.querySelector('.nav-link').addEventListener('click', function (event) {
                event.preventDefault(); // Evitar el comportamiento predeterminado del enlace
                dropdownMenu.classList.toggle('show');
            });

            // Cerrar el menú desplegable al hacer clic fuera de él
            document.addEventListener('click', function (event) {
                if (!servicesDropdown.contains(event.target)) {
                    dropdownMenu.classList.remove('show');
                }
            });

            // Obtener el botón de scroll al principio
            var btnScrollTop = document.getElementById("btn-scroll-top");

            // Mostrar el botón cuando se haga scroll
            window.addEventListener("scroll", function () {
                if (window.pageYOffset > 100) { // Cambiar a la cantidad de desplazamiento que desees
                    btnScrollTop.style.display = "block";
                } else {
                    btnScrollTop.style.display = "none";
                }
            });

            // Scroll al principio al hacer clic en el botón
            btnScrollTop.addEventListener("click", function () {
                window.scrollTo({
                    top: 0,
                    behavior: "smooth" // Desplazamiento suave
                });
            });
        });

    </script>