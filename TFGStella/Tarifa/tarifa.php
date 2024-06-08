<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/logo_sin_fondo.png" type="image/x-icon">
    <title>División en Tres Secciones con Tarjetas</title>
    <link rel="stylesheet" href="estilo.css">
    <style>
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: -1;
        }
    </style>
</head>

<body>
    <?php include("../inicio/header.php"); ?>

    <h1 class="titulo-bonito">BONOS Y TARIFAS</h1>
    <div class="container">
        <div class="section left">
            <h1>Sesión Individual</h1>
            <section class="cards">
                <article class="card card--1">
                    <img src="../img/imgfisio3.jpg" alt="Imagen 1">
                    <a href="#" class="card_link">
                        <div class="card__img--hover"></div>
                    </a>
                    <div class="card__info">
                        <span class="card__category">Sesión Individual</span>
                        <h3 class="card__title">Fisioterapia traumatológica</h3>
                        <span class="card__by">42€</span>
                    </div>
                </article>
                <article class="card card--1">
                    <img src="../img/imgfisio1.jpg" alt="Imagen 1">
                    <a href="#" class="card_link">
                        <div class="card__img--hover"></div>
                    </a>
                    <div class="card__info">
                        <span class="card__category"> Sesión Individual</span>
                        <h3 class="card__title">Fisioterapia del Suelo Pélvico </h3>
                        <span class="card__by">47€</span>
                    </div>
                </article>
                <article class="card card--1">
                    <img src="../img/imgfisio4.jpg" alt="Imagen 1">
                    <a href="#" class="card_link">
                        <div class="card__img--hover"></div>
                    </a>
                    <div class="card__info">
                        <span class="card__category">Sesión Individual</span>
                        <h3 class="card__title">Fisioterapia Neurológica </h3>
                        <span class="card__by">50€</span>
                    </div>
                </article>
            </section>
        </div>
        <div class="section center">
            <h1>Bono de 5</h1>
            <section class="cards">
                <article class="card card--1">
                    <img src="../img/imgfisio3.jpg" alt="Imagen 1">
                    <a href="#" class="card_link">
                        <div class="card__img--hover"></div>
                    </a>
                    <div class="card__info">
                        <span class="card__category">BONO 5 SESIONES</span>
                        <h3 class="card__title">Fisioterapia traumatológica</h3>
                        <span class="card__by">185€</span>
                    </div>
                </article>
                <article class="card card--1">
                    <img src="../img/imgfisio1.jpg" alt="Imagen 1">
                    <a href="#" class="card_link">
                        <div class="card__img--hover"></div>
                    </a>
                    <div class="card__info">
                        <span class="card__category"> BONO 5 SESIONES</span>
                        <h3 class="card__title">Fisioterapia del Suelo Pélvico </h3>
                        <span class="card__by">200€</span>
                    </div>
                </article>
                <article class="card card--1">
                    <img src="../img/imgfisio4.jpg" alt="Imagen 1">
                    <a href="#" class="card_link">
                        <div class="card__img--hover"></div>
                    </a>
                    <div class="card__info">
                        <span class="card__category"> BONO 5 SESIONES</span>
                        <h3 class="card__title">Fisioterapia Neurológica </h3>
                        <span class="card__by">195€</span>
                    </div>
                </article>
            </section>
        </div>
        <div class="section right">
            <h1>Bono de 10</h1>
            <section class="cards">
                <article class="card card--1">
                    <img src="../img/imgfisio3.jpg" alt="Imagen 1">
                    <a href="#" class="card_link">
                        <div class="card__img--hover"></div>
                    </a>
                    <div class="card__info">
                        <span class="card__category">BONO 10 SESIONES</span>
                        <h3 class="card__title">Fisioterapia traumatológica</h3>
                        <span class="card__by">360€</span>
                    </div>
                </article>
                <article class="card card--1">
                    <img src="../img/imgfisio1.jpg" alt="Imagen 1">
                    <a href="#" class="card_link">
                        <div class="card__img--hover"></div>
                    </a>
                    <div class="card__info">
                        <span class="card__category"> BONO 10 SESIONES</span>
                        <h3 class="card__title">Fisioterapia del Suelo Pélvico </h3>
                        <span class="card__by">390€</span>
                    </div>
                </article>
                <article class="card card--1">
                    <img src="../img/imgfisio4.jpg" alt="Imagen 1">
                    <a href="#" class="card_link">
                        <div class="card__img--hover"></div>
                    </a>
                    <div class="card__info">
                        <span class="card__category"> BONO 10 SESIONES</span>
                        <h3 class="card__title">Fisioterapia Neurológica </h3>
                        <span class="card__by">380€</span>
                    </div>
                </article>
            </section>
        </div>
    </div>
    <?php include("../Contacto/chatbot.php"); ?>
    <?php include("../inicio/footer.php"); ?>

    <script src="../Contacto/scriptchat.js">
</script>
</body>

</html>
