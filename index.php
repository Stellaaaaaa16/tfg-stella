<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a Vital Yaiza</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(45deg, #FF6B6B, #FFB74D);
            overflow: hidden;
        }

        .container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        h1 {
            font-size: 3em;
            color: #fff;
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

        button {
            padding: 10px 20px;
            font-size: 1.2em;
            background-color: #fff;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            transition: background-color 0.3s;
            animation: fadeInUp 1s ease-out;
        }

        button:hover {
            background-color: #FF6B6B;
            color: #fff;
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
    </style>
</head>

<body>
    <div class="container">
        <h1>Bienvenido a Vital Yaiza</h1>
        <a href="inicio/inicio.php"><button>Inicio</button></a>
    </div>
</body>

</html>
