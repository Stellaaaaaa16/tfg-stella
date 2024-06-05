<?php
$secretKey = "6LcE5oopAAAAAPHmg2JsxwKN-qO4N_3OcCKfdArD";

$captcha = trim(htmlspecialchars($_POST['g-recaptcha-response']));
$captcha = trim(htmlspecialchars($_POST['nombre']));
$captcha = trim(htmlspecialchars($_POST['contra']));

if (!$captcha) {
    echo "Por favor, completa el reCAPTCHA.";
    exit;
}
$url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captcha";
$response = file_get_contents( $url);
$responseKeys = json_decode($response);

if ($responseKeys==true) {
    echo "reCAPTCHA validado. muy bien.";
    require_once("iniciar.php");
    $users = new Usuario();
    $users->verificar($user,$contra);
} else {
    echo "Error: reCAPTCHA no validado. Por favor, inténtalo de nuevo.";
}
?>