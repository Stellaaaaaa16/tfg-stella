<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si el usuario ha iniciado sesión
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(array("success" => false, "message" => "Debes iniciar sesión para agregar productos al carrito"));
        exit();
    }

    // Obtener datos del producto enviado por el cliente
    $producto = json_decode(file_get_contents("php://input"));

    // Agregar el producto al carrito del usuario (guardado en la sesión)
    $_SESSION['carrito'][] = array(
        "nombre" => $producto->nombre,
        "precio" => $producto->precio,
        "foto" => $producto->foto
    );

    echo json_encode(array("success" => true));
} else {
    echo json_encode(array("success" => false, "message" => "Método no permitido"));
}
?>
