<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vital Yaiza</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="../img/logo_sin_fondo.png" type="image/png">
    <link href="../inicio/style.css" rel="stylesheet" type="text/css" media="all">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggler" aria-controls="bs-example-navbar-collapse-1"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="../inicio/index.php">
                    <img src="../img/logo_sin_fondo.png" class="logo">
                    <span class="vital-yaiza">Vital Yaiza</span>
                </a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item active"><a class="nav-link" href="../inicio/index.php">Inicio</a></li>
                    <li class="nav-item dropdown" id="servicesDropdown">
                        <div class="dropdown-container">
                            <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Servicios <i class="fas fa-caret-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="../Servicios/index.php">Servicio 1</a></li>
                                <li><a class="dropdown-item" href="../Servicios/index.php">Servicio 2</a></li>
                                <li><a class="dropdown-item" href="../Servicios/index.php">Servicio 3</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="../Productos/index.php">Productos</a></li>
                    <li class="nav-item"><a class="nav-link" href="../Tarifa/index.php">Tarifa</a></li>
                    <li class="nav-item"><a class="nav-link" href="../PedirCita/index.php">Pedir Cita</a></li>
                    <li class="nav-item"><a class="nav-link" href="../Contacto/index.php">Contacto</a></li>
                    <li class="nav-item"><a class="nav-link" href="../Registrate/index.php">Regístrate</a></li>
                    <li class="nav-item"><a class="nav-link" href="../IniciarSesion/index.php">Inicia Sesión</a></li>
                </ul>
            </div>

        </div>
    </nav>

    <!-- Botón para regresar arriba -->
    <button id="btn-scroll-top" class="back-to-top" onclick="scrollToTop()">&#8679;</button>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
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
</body>

</html>