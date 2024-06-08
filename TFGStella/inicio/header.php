<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vital Yaiza</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="../img/logo_sin_fondo.png" type="image/png">
    <link href="../inicio/style.css" rel="stylesheet" type="text/css" media="all">
</head>

<body>
<?php
// primero ve si la seseion esta iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggler" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="../inicio/inicio.php">
                    <img src="../img/logo_sin_fondo.png" class="logo">
                    <span class="vital-yaiza">Vital Yaiza</span>
                    <?php
                
                    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
                        echo "<span class='user-greeting'>Bienvenido, " . $_SESSION['user_name'] . "</span>";
                    }
                    ?>
                </a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item active"><a class="nav-link" href="../inicio/inicio.php">Inicio</a></li>
                    <li class="nav-item dropdown d-block d-lg-none">
                        <a class="nav-link" href="../Servicios/suelo.php">Suelo pélvico</a>
                    </li>
                    <li class="nav-item dropdown d-block d-lg-none">
                        <a class="nav-link" href="../Servicios/trauma.php">Traumatológica</a>
                    </li>
                    <li class="nav-item dropdown d-block d-lg-none">
                        <a class="nav-link" href="../Servicios/neuro.php">Neurológica</a>
                    </li>
                    <li class="nav-item dropdown" id="servicesDropdown">
                        <div class="dropdown-container">
                            <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Servicios <i class="fas fa-caret-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item d-none d-lg-block" href="../Servicios/suelo.php">Suelo pelvico</a></li>
                                <li><a class="dropdown-item d-none d-lg-block" href="../Servicios/trauma.php">Traumatológica</a></li>
                                <li><a class="dropdown-item d-none d-lg-block" href="../Servicios/neuro.php">Neurológica</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="../Productos/producto.php">Productos</a></li>
                    <li class="nav-item"><a class="nav-link" href="../Tarifa/tarifa.php">Tarifa</a></li>
                    <li class="nav-item"><a class="nav-link" href="../PedirCita/pedir.php">Pedir Cita</a></li>
                    <li class="nav-item"><a class="nav-link" href="../Contacto/contacto.php">Contacto</a></li>
                    
                    <?php
                    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
                        if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
                            echo "<li class='nav-item'><a class='nav-link' href='../admin/index.php'>Panel de Administración</a></li>";
                        }
                        echo "<li class='nav-item'><a class='nav-link' href='#' onclick='confirmarCerrarSesion()'>Cerrar Sesión</a></li>";
                    } else {
                        echo "<li class='nav-item'><a class='nav-link' href='../IniciarSesion/iniciar.php'>Iniciar Sesión</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <button id="btn-scroll-top" class="back-to-top" onclick="scrollToTop()">&#8679;</button>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script>   // alert
        function confirmarCerrarSesion() {
            if (confirm("¿Estás segura de que quieres cerrar sesión?")) {

                window.location.href = "../IniciarSesion/cerrar.php";
            }
        }
     //para dispositivos moviles el menu deplegable
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelector('.navbar-toggler').addEventListener('click', function() {
                document.querySelector('.navbar-collapse').classList.toggle('show');
            });

            document.querySelectorAll('.navbar-nav .nav-item .nav-link').forEach(function(link) {
                link.addEventListener('click', function() {
                    document.querySelector('.navbar-collapse').classList.remove('show');
                });
            });

            // para mostrar el menú desplegable
            var servicesDropdown = document.getElementById('servicesDropdown');
            var dropdownMenu = servicesDropdown.querySelector('.dropdown-menu');

            servicesDropdown.querySelector('.nav-link').addEventListener('click', function(event) {
                event.preventDefault(); 
                dropdownMenu.classList.toggle('show');
            });

            // Cerrar el menú desplegable al hacer clic fuera de él
            document.addEventListener('click', function(event) {
                if (!servicesDropdown.contains(event.target)) {
                    dropdownMenu.classList.remove('show');
                }
            });

            // si esta en la parte inferiorir de la pagina que pueda subit
            var btnScrollTop = document.getElementById("btn-scroll-top");

            // Mostrar el botón cuando se haga scroll
            window.addEventListener("scroll", function() {
                if (window.pageYOffset > 100) { 
                    btnScrollTop.style.display = "block";
                } else {
                    btnScrollTop.style.display = "none";
                }
            });

            // Scroll al principio al hacer clic en el botón
            btnScrollTop.addEventListener("click", function() {
                window.scrollTo({
                    top: 0,
                    behavior: "smooth" 
                });
            });
        });
    </script>
</body>

</html>
