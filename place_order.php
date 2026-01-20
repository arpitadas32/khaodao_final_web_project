<?php
session_start();
require "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: customer_login.php");
    exit();
}

$user_id = $_SESSION["user_id"];
$error = '';
$success = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['place_order'])) {
    $cart_json = $_POST['cart_data'] ?? '[]';
    $cart = json_decode($cart_json, true);

    if(empty($cart)) {
        $error = "⚠️ Your cart is empty!";
    } else {
        $subtotal = 0;
        foreach($cart as $item){
            $subtotal += floatval($item['price']) * intval($item['quantity']);
        }

        $delivery_charge = ($subtotal >= 500) ? 0 : 50;
        $total_amount = $subtotal + $delivery_charge;

        $order_data_sql = mysqli_real_escape_string($conn, $cart_json);

        $sql = "INSERT INTO orders (user_id, order_data, total_amount, delivery_charge, status)
                VALUES ('$user_id', '$order_data_sql', '$total_amount', '$delivery_charge', 'Pending')";

        if(mysqli_query($conn, $sql)){
            $order_id = mysqli_insert_id($conn);
            $success = "✅ Order #$order_id placed successfully!";

            echo "<script>
                localStorage.removeItem('khaoDaoCart');
                setTimeout(function(){ window.location.href='orders.php'; }, 1500);
            </script>";
        } else {
            $error = "Database error: ".mysqli_error($conn);
        }
    }
}
?>
