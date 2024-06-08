<?php
session_start();

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    echo "<script>
            alert('Debes iniciar sesión primero.');
            window.location.href = '../IniciarSesion/iniciar.php';
          </script>";
    exit();
}

include '../admin/config.php';

$trabajadores = [];
$servicios = [];

$result = $conn->query("SELECT * FROM servicio");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $servicios[] = $row;
    }
}

$result = $conn->query("SELECT * FROM trabajador");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $trabajadores[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedir Cita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <style>
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: linear-gradient(to bottom, rgb(0 0 0 / .75), rgb(0 0 0 / .5)), url(../img/imgfisio4.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            z-index: -1;
        }

        body {
            background-color: #e9ecef;
        }

        .container {
            background: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 30px;
            margin: 50px auto;
        }

        h2 {
            color: #343a40;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 50px;
            padding: 10px 20px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</head>

<body><?php
        include("../inicio/header.php");
        ?>
    <div class="container mt-5">
        <h2>Pedir Cita</h2>
        <form id="appointmentForm" action="procesar_cita.php" method="post">
            <div class="form-group">
                <label for="servicio">Servicio</label>
                <select id="servicio" name="servicio" class="form-control" required>
                    <option value="">Seleccione un servicio</option>
                    <?php foreach ($servicios as $servicio) { ?>
                        <option value="<?= $servicio['ID'] ?>"><?= $servicio['Nombre'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="trabajador">Profesional</label>
                <select id="trabajador" name="trabajador" class="form-control" required>
                    <option value="">Seleccione un Profesional</option>
                    <?php foreach ($trabajadores as $trabajador) { ?>
                        <option value="<?= $trabajador['ID'] ?>" data-servicio="<?= $trabajador['ServicioID'] ?>"><?= $trabajador['Nombre'] . ' ' . $trabajador['Apellido'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="text" id="fecha" name="fecha" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="hora">Hora</label>
                <select id="hora" name="hora" class="form-control" required>
                    <option value="">Seleccione una hora</option>
                </select>
            </div>
            <div class="form-group">
                <label for="nota">Nota (opcional)</label>
                <textarea id="nota" name="nota" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Pedir Cita</button>
        </form>
    </div>

    <script>
        //para aue el calendario solo muestre las horas seleccionadas, sin findes y apartir de x dia
        $(document).ready(function() {
            $('#fecha').datepicker({
                dateFormat: 'yy-mm-dd',
                minDate: 0,
                beforeShowDay: function(date) {
                    var day = date.getDay();
                    return [(day != 0 && day != 6)];
                },
                onSelect: function(dateText) {
                    var trabajadorID = $('#trabajador').val();
                    if (trabajadorID) {
                        $.ajax({
                            url: 'obtener_horas.php',
                            type: 'post',
                            data: {
                                fecha: dateText,
                                trabajador: trabajadorID
                            },
                            success: function(response) {
                                $('#hora').html(response);
                            }
                        });
                    }
                }
            });
            // a mediacion de ajax puedes seleccionar el trabajador con la espcialidad y escoger las hroas

            $('#servicio').change(function() {
                var servicioID = $(this).val();
                $('#trabajador').val('');
                $('#trabajador option').each(function() {
                    var $this = $(this);
                    if (servicioID == 5 || servicioID == 6) {
                        $this.show();
                    } else if ($this.data('servicio') == servicioID) {
                        $this.show();
                    } else {
                        $this.hide();
                    }
                });
                // mostrar los servicios que no estan con un profesional
                // para que salga cada servicio con su trabajador
                if (servicioID == 1) {
                    $('#trabajador').val(1);
                } else if (servicioID == 3) {
                    $('#trabajador').val(3);
                } else if (servicioID == 4) {
                    $('#trabajador').val(2);
                }
            });

            $('#trabajador').change(function() {
                var trabajadorID = $(this).val();
                var servicioID = $('#servicio').val();

                if (trabajadorID == 1) {
                    $('#servicio').val(1);
                } else if (trabajadorID == 2) {
                    $('#servicio').val(4);
                } else if (trabajadorID == 3) {
                    $('#servicio').val(3);
                }

                var fecha = $('#fecha').val();
                if (fecha) {
                    $.ajax({
                        url: 'obtener_horas.php',
                        type: 'post',
                        data: {
                            fecha: fecha,
                            trabajador: trabajadorID
                        },
                        success: function(response) {
                            $('#hora').html(response);
                        }
                    });
                }
            });
        });
    </script><?php include("../Contacto/chatbot.php"); ?>
    <script src="../Contacto/scriptchat.js">
    </script> <?php
                include("../inicio/footer.php");
                ?>
</body>

</html>