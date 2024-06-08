<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicia</title>

    <link rel="icon" href="../img/logo_sin_fondo.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,800" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js?render=6LeekO0pAAAAAMCbi60Oqz6raZ9MVNJItn_mnWGS"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="style.css">
    <style>
        .password-container {
            display: flex;
            align-items: center;
        }

        .password-container input[type="password"],
        .password-container input[type="text"] {
            flex: 1;
            margin-right: 5px;
        }

        .password-container button {
            padding: 5px;
            font-size: 0.8em;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const today = new Date().toISOString().split('T')[0];
            document.getElementsByName("fechaNacimiento")[0].setAttribute('max', today);
        });

        function togglePasswordVisibility(id) {
            const passwordField = document.getElementById(id);
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
        }
    </script>
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
                    <span>Introduce tu fecha de Nacimiento</span>
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
                    <div class="password-container">
                        <input type="password" name="contrasena" placeholder="Contraseña" id="signupPassword" required />
                        <!-- para poder ver la contraseña -->
                        <button type="button" onclick="togglePasswordVisibility('signupPassword')"><i class="fas fa-eye"></i></button>
                        <span>¿Ya tienes cuenta? <a href="iniciar.php" id="goToSignIn">Inicia Sesión</a></span>
                    </div><br><br>
                    <div class="g-recaptcha" data-sitekey="6LcE5oopAAAAAJqMEqdMCfWyrJfFfKqVbqfxL3ul"></div><br>

                    <button type="submit">Registrar</button><br><br>
                </div>
            </form>
        </div>
        <div class="form-container2 sign-in-container2">
            <form id="loginForm" action="login.php" method="post">
                <h1>Inicia sesión</h1>
                <span>Inicia con tu cuenta</span>
                <input type="email" name="correoElectronico" placeholder="Email" required /><br>
                <div class="password-container">
                    <input type="password" name="contrasena" placeholder="Contraseña" id="loginPassword" required />
                    <button type="button" onclick="togglePasswordVisibility('loginPassword')"><i class="fas fa-eye"></i></button>
                </div><br>
                <div class="g-recaptcha" data-sitekey="6LcE5oopAAAAAJqMEqdMCfWyrJfFfKqVbqfxL3ul"></div><br>
                <button type="submit">Iniciar Sesión</button><br><br>
                <br> <br> <span>¿No tienes una cuenta? <a href="#" id="goToSignUp">Regístrate</a></span>
            </form>
        </div>


        <div class="overlay-container2">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>¡Bienvenido de nuevo!</h1>
                    <p>Para mantenerse conectado con nosotros, inicie sesión con su información personal.</p>
                    <button class="ghost" id="signIn" onClick="openSignIn()">Iniciar Sesión</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hola amigx!</h1>
                    <p>Ingrese tus datos personales, y registrate para tener una nueva cuenta.</p>
                    <button class="ghost" id="signUp" onClick="openSignUp()">Registrate</button>
                </div>
            </div>
        </div>
    </div>


    <?php include("../Contacto/chatbot.php"); ?>
    <script src="../Contacto/scriptchat.js">
    </script>
    <?php include("../inicio/footer.php"); ?>
    <script src="script.js"></script>
</body>

</html>