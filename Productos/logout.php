<?php
session_start();

// Destruir la sesión para cerrar la sesión del usuario
session_destroy();

// Borrar el carrito en localStorage
echo '<script>
    localStorage.removeItem("carrito");
</script>';

// Redirigir al usuario a la página de inicio de sesión o inicio
header("Location: index.php");
exit();
?>
