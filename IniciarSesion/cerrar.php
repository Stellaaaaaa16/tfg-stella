<?php
// Iniciar sesión si aún no está iniciada

session_start();
session_unset();
session_destroy();
header("Location: ../IniciarSesion/iniciar.php");



// Destruir todas las variables de sesión
$_SESSION = array();

// Si se desea destruir la sesión completamente, borra también la cookie de sesión
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalmente, destruir la sesión
session_destroy();

// Redireccionar a la página de inicio u otra página después de cerrar sesión
header("Location: ../inicio/inicio.php");
exit();
?>