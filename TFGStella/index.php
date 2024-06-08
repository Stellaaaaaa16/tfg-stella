<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a Vital Yaiza</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #FF6B6B, #FFB74D);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            color: #fff;
        }

        .container {
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            padding: 50px;
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.5s, box-shadow 0.5s;
        }

        .container:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
        }

        h1 {
            font-size: 3em;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            animation: fadeInDown 1s ease-out;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        p {
            font-size: 1.2em;
            margin-bottom: 40px;
            animation: fadeInUp 1s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        button {
            padding: 15px 30px;
            font-size: 1.2em;
            background-color: #fff;
            color: #FF6B6B;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
            animation: fadeInUp 1s ease-out;
        }

        button:hover {
            background-color: #FF6B6B;
            color: #fff;
        }

        @media (max-width: 600px) {
            h1 {
                font-size: 2em;
            }

            p {
                font-size: 1em;
            }

            button {
                font-size: 1em;
                padding: 10px 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Bienvenido a Vital Yaiza</h1>
        <p>Tu salud y bienestar son nuestra prioridad. Comienza tu viaje hacia una vida más saludable con nosotros.</p>
        <a href="inicio/inicio.php"><button>Inicio</button></a>
    </div>
</body>

</html>
