<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css">
    <style>
        @import url(https://fonts.googleapis.com/css?family=Open+Sans);

       
        html,
        body {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: "Open Sans", Helvetica, sans-serif;
            background-color: #404040;
        }

        #responsive-admin-menu {
            float: left;
            width: 200px;
            background-color: #404040;
            height: 100%;
            position: relative;
            overflow: hidden;
            left: 0px;
            min-height: 500px;
        }

        #content-wrapper {
            width: calc(100% - 200px);
            margin-left: 200px;
            background-color: #ffffff;
            min-height: 100vh;
            padding: 15px;
        }

        #responsive-admin-menu #menu a {
            border-bottom: 1px dotted #52535a;
            font-size: 14px;
            text-decoration: none;
            display: block;
            padding: 12px;
            color: #FFFFFF;
            position: relative;
            font-weight: 400;
            overflow: hidden;
        }

        #responsive-admin-menu #menu a:hover {
            color: #52535a;
            background-color: #fcfcfc;
        }

        #responsive-admin-menu #menu i {
            width: 16px;
            padding-right: 4px;
        }

        #responsive-admin-menu #menu div {
            display: none;
            width: 100%;
            background-color: #5c5d64;
            overflow: hidden;
        }

        #responsive-admin-menu #menu div a {
            color: #c0c0c0;
        }

        #responsive-admin-menu #menu div a:hover {
            color: #888888;
        }

        #responsive-admin-menu #menu a.submenu:before {
            font-family: FontAwesome;
            content: "\f054";
        }

        #responsive-admin-menu #menu a.downarrow:before {
            font-family: FontAwesome;
            content: "\f078";
        }

        #responsive-admin-menu #menu a.submenu:before {
            font-size: 14px;
            position: absolute;
            right: 15px;
            top: 17px;
        }

        #calendar {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px 0;
        }

        .fc-toolbar.fc-header-toolbar {
            padding: 5px 0;
            font-size: 14px;
            height: 20px;
        }

        .fc-toolbar .fc-center h2 {
            font-size: 18px;
        }

        @media (max-width: 768px) {
            #responsive-admin-menu {
                width: 100%;
                height: auto;
                position: relative;
            }
            #content-wrapper {
                width: 100%;
                margin-left: 0;
            }
            #responsive-admin-menu #menu a {
                text-align: center;
                padding: 10px;
            }
        }
    </style>
</head>

<body>
    <div id="responsive-admin-menu">
        <div id="responsive-menu"></div>
        <div id="logo"></div>
        <!--Menu-->
        <div id="menu">
            <a href="index.php" title="Dashboard"><span>Administración</span></a>
            <a href="index.php?page=listar_usuario" title="Usuarios"><span>Usuarios</span></a>
            <a href="index.php?page=listar_cita" title="Citas"><span>Citas</span></a>
            <a href="index.php?page=calendar" title="Calendario"><span>Calendario</span></a>
            <a href="../inicio/inicio.php" title="principal"><span>Pagina principal</span></a>
        </div>
        <!--Menu-->
    </div>

    <div id="content-wrapper">
        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            switch ($page) {
                case 'listar_usuario':
                    include 'listar_usuario.php';
                    break;
                case 'añadir_usuario':
                    include 'añadir_usuario.php';
                    break;
                case 'editar_usuario':
                    include 'editar_usuario.php';
                    break;
                case 'eliminar_usuario':
                    include 'eliminar_usuario.php';
                    break;
                case 'listar_cita':
                    include 'listar_cita.php';
                    break;
                case 'añadir_cita':
                    include 'añadir_cita.php';
                    break;
                case 'eliminar_cita':
                    include 'eliminar_cita.php';
                    break;
                case 'editar_cita':
                    include 'editar_cita.php';
                    break;

                case 'calendar':
                    include 'calendar.php';
                    break;
                default:
                    echo "<h1>Bienvenido al Panel de Administración</h1>";
            }
        } else {
            echo "<h1>Bienvenido al Panel de Administración</h1>";
        }
        ?>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#calendar').fullCalendar({
                events: 'evento.php',
                eventRender: function(event, element) {
                    if (event.color) {
                        element.css('background-color', event.color); 
                    }
                    element.css('color', '#fff');
                }
            });

            $('.delete-cita').on('click', function(e) {
                e.preventDefault();
                var link = $(this).attr('href');
                if (confirm('¿Estás seguro de que deseas eliminar esta cita?')) {
                    window.location.href = link;
                }
            });
        });
    </script>
</body>

</html>
