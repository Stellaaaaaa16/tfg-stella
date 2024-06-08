<?php
include 'config.php';

$sql = "SELECT c.ID, c.FechaHora, p.Nombre AS Paciente, t.Nombre AS Trabajador, s.Nombre AS Servicio, c.Notas
        FROM cita c
        LEFT JOIN paciente p ON c.PacienteID = p.ID
        LEFT JOIN trabajador t ON c.TrabajadorID = t.ID
        LEFT JOIN servicio s ON c.ServicioID = s.ID";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>Gestión de Citas</title>
    <style>
        .table-container {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: plum;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .styled-button, .edit-button, .delete-button {
            border: none;
            color: white;
            padding: 10px 24px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 12px;
        }

        .styled-button {
            background-color: plum;
        }

        .edit-button {
            background-color: #d1a0d1;
        }

        .delete-button {
            background-color: #800000; /* Granate */
        }

        .styled-button:hover, .edit-button:hover, .delete-button:hover {
            opacity: 0.8;
        }

        .message-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .button-container {
            text-align: center;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            th, td {
                padding: 8px 10px;
            }

            .styled-button, .edit-button, .delete-button {
                padding: 10px 12px;
                font-size: 14px;
            }

            .table-container {
                padding: 10px;
            }

            .message-container {
                padding: 15px;
            }
        }

        @media (max-width: 480px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            th {
                display: none;
            }

            td {
                position: relative;
                padding-left: 50%;
                text-align: right;
                border: none;
                border-bottom: 1px solid #ddd;
            }

            td:before {
                position: absolute;
                top: 50%;
                left: 10px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                content: attr(data-label);
                transform: translateY(-50%);
                font-weight: bold;
                text-align: left;
            }

            .styled-button, .edit-button, .delete-button {
                width: 100%;
                margin: 5px 0;
            }

            .table-container {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .message-container {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="button-container">
        <a href="index.php?page=añadir_cita" class="styled-button">Agregar nueva cita</a>
    </div>

    <?php
    if ($result->num_rows > 0) {
        echo "<div class='table-container'>";
        echo "<table>";
        echo "<thead><tr><th>ID</th><th>Fecha y Hora</th><th>Paciente</th><th>Trabajador</th><th>Servicio</th><th>Notas</th><th>Acciones</th></tr></thead>";
        echo "<tbody>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td data-label='ID'>" . $row["ID"] . "</td>";
            echo "<td data-label='Fecha y Hora'>" . $row["FechaHora"] . "</td>";
            echo "<td data-label='Paciente'>" . $row["Paciente"] . "</td>";
            echo "<td data-label='Trabajador'>" . $row["Trabajador"] . "</td>";
            echo "<td data-label='Servicio'>" . $row["Servicio"] . "</td>";
            echo "<td data-label='Notas'>" . $row["Notas"] . "</td>";
            echo "<td data-label='Acciones'><a href='index.php?page=editar_cita&id=" . $row["ID"] . "' class='edit-button'>Editar</a> | <a href='eliminar_cita.php?id=" . $row["ID"] . "' class='delete-button eliminar_cita'>Eliminar</a></td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
    } else {
        echo "<div class='message-container'>No se encontraron resultados</div>";
    }
    $conn->close();
    ?>

</body>
</html>
