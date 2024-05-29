<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicia</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,800" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-image: linear-gradient(to bottom, rgb(0 0 0 / .75), rgb(0 0 0 / .5)), url(../img/imgfisio4.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
        }

        .container2 {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
            position: relative;
            overflow: hidden;
            width: 768px;
            max-width: 100%;
            min-height: 800px;
            margin: 50px auto;
        }

        .form-container2 {
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.6s ease-in-out;
        }

        .sign-in-container2 {
            left: 0;
            width: 50%;
            z-index: 2;
        }

        .container2.right-panel-active .sign-in-container2 {
            transform: translateX(100%);
        }

        .sign-up-container2 {
            left: 0;
            width: 50%;
            opacity: 0;
            z-index: 1;
        }

        .container2.right-panel-active .sign-up-container2 {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
            animation: show 0.6s;
        }

        @keyframes show {

            0%,
            49.99% {
                opacity: 0;
                z-index: 1;
            }

            50%,
            100% {
                opacity: 1;
                z-index: 5;
            }
        }

        .overlay-container2 {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: transform 0.6s ease-in-out;
            z-index: 100;
        }

        .container2.right-panel-active .overlay-container2 {
            transform: translateX(-100%);
        }

        .overlay {
            background: #ff416c;
            background: -webkit-linear-gradient(to right, #ff4b2b, #ff416c);
            background: linear-gradient(to right, #ff4b2b, #ff416c);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: 0 0;
            color: #ffffff;
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .container2.right-panel-active .overlay {
            transform: translateX(50%);
        }

        .overlay-panel {
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 40px;
            text-align: center;
            top: 0;
            height: 100%;
            width: 50%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .overlay-left {
            transform: translateX(-20%);
        }

        .container2.right-panel-active .overlay-left {
            transform: translateX(0);
        }

        .overlay-right {
            right: 0;
            transform: translateX(0);
        }

        .container2.right-panel-active .overlay-right {
            transform: translateX(20%);
        }

        .social-container2 {
            margin: 20px 0;
        }

        .social-container2 a {
            border: 1px solid #dddddd;
            border-radius: 50%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            margin: 0 5px;
            height: 40px;
            width: 40px;
        }

        form {
            background-color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 50px;
            height: 100%;
            text-align: center;
        }

        input {
            background-color: #eee;
            border: none;
            padding: 12px 15px;
            margin: 8px 0;
            width: 100%;
        }

        button {
            border-radius: 20px;
            border: 1px solid #ff4b2b;
            background-color: #ff4b2b;
            color: #ffffff;
            font-size: 12px;
            font-weight: bold;
            padding: 12px 45px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: transform 80ms ease-in;
        }

        button:active {
            transform: scale(0.95);
        }

        button:focus {
            outline: none;
        }

        button.ghost {
            background-color: transparent;
            border-color: #ffffff;
        }

        h1 {
            font-weight: bold;
            margin: 0;
        }

        h2 {
            text-align: center;
        }

        p {
            font-size: 14px;
            font-weight: 100;
            line-height: 20px;
            letter-spacing: 0.5px;
            margin: 20px 0 30px;
        }

        span {
            font-size: 12px;
        }
    </style>
</head>


<body>
    <?php include("../inicio/header.php"); ?>
    <div class="container2" id="container2">
        <div class="form-container2 sign-up-container2">
            <form id="signupForm" action="register.php" method="post">
                <div class="form-container">
                    <h1>Crea tu cuenta</h1>
                    <span>Introduce tus datos personales para registrarte</span>
                    <input type="text" name="nombre" placeholder="Nombre" required /><br><br>
                    <input type="text" name="apellidos" placeholder="Apellidos" required /><br><br>
                    <input type="date" name="fechaNacimiento" placeholder="Fecha de Nacimiento" required /><br><br>
                    <select name="genero" required>
                        <option value="" disabled selected>Selecciona tu género</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                        <option value="Otro">Otro</option>
                    </select><br><br>
                    <input type="text" name="direccion" placeholder="Dirección" required /><br><br>
                    <input type="tel" name="telefono" placeholder="Número de Teléfono" required /><br><br>
                    <input type="email" name="correoElectronico" placeholder="Email" required /><br><br>
                    <input type="password" name="contrasena" placeholder="Contraseña" required /><br><br>
                    <button type="submit">Registrar</button><br><br>
                </div>
            </form>



        </div>
        <div class="form-container2 sign-in-container2">
            <form id="loginForm" action="login.php" method="post">
                <h1>Inicia sesión</h1>
                <span>Inicia con tu cuenta</span>
                <input type="email" name="correoElectronico" placeholder="Email" required /><br>
                <input type="password" name="contrasena" placeholder="Contraseña" required /><br>
                <button type="submit">Iniciar Sesión</button><br><br>
            </form>
        </div>
        <div class="overlay-container2">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>¡Bienvenido de nuevo!</h1>
                    <p>Para mantenerse conectado con nosotros, inicie sesión con su información personal.</p> <button class="ghost" id="signIn" onClick="openSignIn()">Iniciar Sesión</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1> Hola amigx! </h1>
                    <p>Ingrese tus datos personales, y registrate para tener una nueva cuenta.</p> <button class="ghost" id="signUp" onClick="openSignUp()">Registrate</button>
                </div>
            </div>
        </div>
    </div>
    <?php include("../inicio/footer.php"); ?>
    <script>
        const container2 = document.getElementById('container2');
        const signInEmail = document.getElementById('signInEmail');
        const signUpEmail = document.getElementById('signUpEmail');

        function openSignIn() {
            container2.classList.remove("right-panel-active");
            if (signUpEmail.value !== "") {
                signInEmail.value = signUpEmail.value;
            }
        }

        function openSignUp() {
            container2.classList.add("right-panel-active");
            if (signInEmail.value !== "") {
                signUpEmail.value = signInEmail.value;
            }
        }
    </script>
</body>

</html>