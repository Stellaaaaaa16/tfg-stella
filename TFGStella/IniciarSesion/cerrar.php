<?php

session_start();
// elimina todas las variables de sesión:
session_unset();
// destruye la sesión:
session_destroy();
header("Location: ../IniciarSesion/iniciar.php");



$_SESSION = array();
// si estan las cookies habilitadas elimina la coockie de la seseion
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy();

header("Location: ../inicio/inicio.php");
exit();
?>
