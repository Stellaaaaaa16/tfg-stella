<?php

session_start();
session_unset();
session_destroy();
header("Location: ../IniciarSesion/iniciar.php");



$_SESSION = array();

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
