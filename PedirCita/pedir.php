<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<script src="https://www.paypal.com/sdk/js?client-id=Aez6AR8kTK31tvovrxUs5WDeakHidgEOD0j4HqdPwo6gsmA76Ld0hxkLhbM2RlANiGeuiZRhumyFmvXK&currency=EUR"></script>

<body>
    <div id="paypal-button-container"></div>
    <script>
        paypal.Buttons({
            style: {
                color: 'blue',
                shape: 'pill',
                label: 'pay'
            },
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: 0.2
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                actions.order.capture().then(function(detalles){
                    console.log(detalles);
                    window.location.href="completado.html"
                })

            },
            onCancel: function(data) {
                alert("Pago Cancelado")
            }
        }).render('#paypal-button-container')
    </script>
</body>

</html>