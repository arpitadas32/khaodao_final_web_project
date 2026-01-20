<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>

    <link href="https://fonts.googleapis.com/css2?family=Baloo+Da+2:wght@600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="style.css">

    
    <style>
        .container {
            text-align: center;
            background: #ffe0b2;
            padding: 50px 40px;
            border-radius: 22px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.18);
            max-width: 900px;
            width: 90%;
        }

        /* FOOD BRAND LOGO */
         .bangla-title {
            font-family: 'Baloo Da 2', cursive !important;
            font-size: 70px;
            font-weight: 700;
            color: #ff5722;
            letter-spacing: 2px;
            text-shadow: 3px 3px 0px #ffd54f;

            background: linear-gradient(90deg, #ff512f, #f09819);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;

            text-shadow: 2px 2px 10px rgba(0,0,0,0.15);

            animation: logoFade 1s ease-out, pulse 1.8s infinite ease-in-out;
        }

        @keyframes logoFade {
            from {
                opacity: 0;
                transform: translateY(-25px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .container p {
            color: #000000ff;
            margin-top: 10px;
            font-size: 18px;
        }

        /* CARDS */
        .card-wrapper {
            display: flex;
            gap: 30px;
            margin-top: 45px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .card {
            width: 260px;
            padding: 30px 20px;
            border-radius: 18px;
            cursor: pointer;
            transition: transform 0.35s ease, box-shadow 0.35s ease;
            color: #ffffff;
        }

        .card h2 {
            margin-bottom: 10px;
        }

        .card p {
            font-size: 15px;
        }

        .card:hover {
            transform: translateY(-10px) scale(1.06);
            box-shadow: 0 18px 35px rgba(0,0,0,0.35);
        }

        .customer {
            background: linear-gradient(135deg, #43cea2, #185a9d);
        }

        .delivery {
            background: linear-gradient(135deg, #47693bff, #94c82aff);
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="bangla-title">খাও দাও</h1>
    <p><b>Fastest Food Delivery in Town</b></p>

    <div class="card-wrapper">
        <div class="card customer" onclick="goCustomer()">
            <h2>Customer</h2>
            <p>Order food and track delivery</p>
        </div>

        <div class="card delivery" onclick="goDelivery()">
            <h2>Delivery Man</h2>
            <p>Deliver orders and earn money</p>
        </div>
    </div>
</div>

<script>
   
    function goCustomer() {
        window.location.href = "customer_login.php";
    }

    
    function goDelivery() {
        alert("Delivery page not ready yet!");
    }
</script>

</body>
</html>
