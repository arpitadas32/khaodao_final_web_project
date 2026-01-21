<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome - Khao Dao</title>

    <link href="https://fonts.googleapis.com/css2?family=Baloo+Da+2:wght@600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="style.css">

    <style>
        body {
            margin: 0;
            min-height: 100vh;
            background: linear-gradient(135deg, #fff3e0, #ffe0b2);
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            text-align: center;
            background: #ffffff;
            padding: 50px 40px;
            border-radius: 22px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            max-width: 1000px;
            width: 90%;
        }

        /* FOOD BRAND LOGO */
         .bangla-title {
            font-family: 'Baloo Da 2', cursive !important;
            font-size: 75px;
            font-weight: 700;
            margin: 0;
            background: linear-gradient(90deg, #ff512f, #f09819);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 2px 2px 10px rgba(0,0,0,0.1);
            animation: logoFade 1s ease-out, pulse 2s infinite ease-in-out;
        }

        @keyframes logoFade {
            from { opacity: 0; transform: translateY(-25px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.03); }
            100% { transform: scale(1); }
        }

        .container p.tagline {
            color: #555;
            margin-top: 5px;
            font-size: 20px;
            letter-spacing: 1px;
        }

        /* CARDS WRAPPER */
        .card-wrapper {
            display: flex;
            gap: 20px;
            margin-top: 50px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .card {
            width: 240px;
            padding: 40px 20px;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #ffffff;
            text-align: center;
        }

        .card h2 {
            margin-bottom: 15px;
            font-size: 24px;
        }

        .card p {
            font-size: 14px;
            opacity: 0.9;
            line-height: 1.4;
        }

        .card:hover {
            transform: translateY(-12px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }

        /* ROLE COLORS */
        .admin {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
        }

        .customer {
            background: linear-gradient(135deg, #43cea2, #185a9d);
        }

        .delivery {
            background: linear-gradient(135deg, #47693b, #94c82a);
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="bangla-title">খাও দাও</h1>
    <p class="tagline"><b>Fastest Food Delivery in Town</b></p>

    <div class="card-wrapper">
        <div class="card admin" onclick="goAdmin()">
            <h2>Admin</h2>
            <p>Manage restaurant, menu, and system users</p>
        </div>

        <div class="card customer" onclick="goCustomer()">
            <h2>Customer</h2>
            <p>Browse delicious meals and order now</p>
        </div>

        <div class="card delivery" onclick="goDelivery()">
            <h2>Delivery Man</h2>
            <p>Pick up orders and deliver happiness</p>
        </div>
    </div>
</div>

<script>
    // Navigation Functions
   function goAdmin() {
    window.location.href = "/project/views/admin/login.php";
}

function goCustomer() {
    window.location.href = "/project/views/customer/customer_login.php";
}

function goDelivery() {
    window.location.href = "/project/views/deliveryman/login.php";
}

</script>

</body>
</html>