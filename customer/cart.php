nooo not for cart...<?php
session_start();
require "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: customer_login.php");
    exit();
}

$user_id = $_SESSION["user_id"];
$success = '';
$error = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    $cart_json = $_POST['cart_data'] ?? '[]';
    $cart = json_decode($cart_json, true);

    if (empty($cart)) {
        $error = "⚠️ Your cart is empty!";
    } else {
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += ($item['price'] * $item['quantity']);
        }

        $delivery_charge = ($subtotal >= 500) ? 0 : 50;
        $final_total = $subtotal + $delivery_charge;

       
        $order_data = json_encode($cart, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        $order_data_sql = mysqli_real_escape_string($conn, $order_data);

        
        $sql = "INSERT INTO orders (user_id, order_data, total_amount, delivery_charge, status) 
                VALUES ('$user_id', '$order_data_sql', '$final_total', '$delivery_charge', 'Pending')";

        if (mysqli_query($conn, $sql)) {
            $success = "✅ Order placed successfully!";
            // Clear cart in localStorage
            echo "<script>localStorage.removeItem('khaoDaoCart');</script>";
        } else {
            $error = "Database error: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>My Cart - KHAO DAO</title>
<link rel="stylesheet" href="dashboard.css">
<style>

:root {
    --primary-gradient: linear-gradient(to right, #667eea, #764ba2);
    --sidebar-width: 260px;
}

html, body {
    margin: 0;
    padding: 0;
    font-family: 'Segoe UI', sans-serif;
    font-size: 16px;
    color: #333;
    background: #f8f9fa;
}


.dashboard {
    display: flex;
    min-height: 100vh;
}


.main {
    flex: 1;
    margin-left: var(--sidebar-width);
    padding: 30px 45px;
    min-height: 100vh;
    overflow-y: auto;
    font-family: inherit;
    color: inherit;
}


.cart-container {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 30px;
    margin-top: 20px;
}


table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 15px;
    border-bottom: 1px solid #f4f4f4;
    text-align: left;
    font-family: inherit;
}


.item-detail {
    display: flex;
    align-items: center;
    gap: 15px;
}

.item-detail img {
    width: 70px;
    height: 70px;
    border-radius: 12px;
    object-fit: cover;
}


.qty-btn {
    width: 30px;
    height: 30px;
    border-radius: 5px;
    border: none;
    background: #eee;
    font-weight: bold;
    cursor: pointer;
    transition: 0.2s;
}

.qty-btn:hover {
    background: #ddd;
}

.checkout-btn {
    width: 100%;
    padding: 15px;
    border: none;
    border-radius: 12px;
    background: var(--primary-gradient);
    color: #fff;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
}

.checkout-btn:disabled {
    background: #ccc;
    cursor: not-allowed;
}

.checkout-btn:hover:enabled {
    opacity: 0.9;
}


.empty-cart {
    text-align: center;
    padding: 60px 40px;
}

.empty-cart img {
    width: 120px;
    margin-bottom: 20px;
}


.alert {
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-family: inherit;
}

.alert-success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.alert-error {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}


.summary-card h3 {
    margin-bottom: 20px;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    padding: 8px 0;
    font-family: inherit;
}

.total-row {
    font-weight: bold;
    border-top: 1px solid #eee;
    padding-top: 12px;
}

</style>
</head>
<body>
<div class="dashboard">
    <?php include 'sidebar.php'; ?>

    <div class="main">
        <h2>🛒 Confirm Your Feast</h2>

        <?php if($error): ?>
        <div class="alert alert-error"><?= $error ?></div>
        <?php endif; ?>
        <?php if($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
        <?php endif; ?>

        <div class="cart-container">

            <div class="cart-table-card">
                <table id="cartTable">
                    <thead>
                        <tr><th>Item</th><th>Price</th><th>Qty</th><th>Subtotal</th><th>Action</th></tr>
                    </thead>
                    <tbody id="cartItemsList"></tbody>
                </table>
                <div id="emptyMsg" class="empty-cart" style="display:none;">
                    <img src="https://cdn-icons-png.flaticon.com/512/11329/11329060.png">
                    <h3>Your cart is empty! 🌮</h3>
                    <a href="menu.php">Browse Menu</a>
                </div>
            </div>

            <div class="summary-card">
                <h3>💰 Order Summary</h3>
                <div class="summary-row"><span>Items Total</span><span id="subtotalAmount">৳ 0</span></div>
                <div class="summary-row"><span>Delivery</span><span id="deliveryCharge">৳ 50</span></div>
                <div class="summary-row total-row"><span>Total Payable</span><span id="finalTotal">৳ 0</span></div>

                <form method="POST" id="orderForm" onsubmit="return prepareOrderForm()">
                    <input type="hidden" name="cart_data" id="cartDataInput">
                    <input type="hidden" name="subtotal" id="subtotalInput">
                    <input type="hidden" name="total" id="totalInput">
                    <button type="submit" name="place_order" class="checkout-btn" id="checkoutBtn">✅ Confirm Order</button>
                </form>
            </div>

        </div>
    </div>
</div>

<script>

let cart = JSON.parse(localStorage.getItem('khaoDaoCart')) || [];


function displayCart() {
    const list = document.getElementById('cartItemsList');
    const emptyMsg = document.getElementById('emptyMsg');
    const checkoutBtn = document.getElementById('checkoutBtn');
    list.innerHTML = '';

    if(cart.length === 0){
        emptyMsg.style.display = 'block';
        checkoutBtn.disabled = true;
        updateSidebarCartCount();
        return;
    }

    emptyMsg.style.display = 'none';
    checkoutBtn.disabled = false;

    let subtotal = 0;
    cart.forEach((item,index) => {
        let itemTotal = item.price * item.quantity;
        subtotal += itemTotal;
        list.innerHTML += `<tr>
            <td>
                <div class="item-detail">
                    <img src="${item.img || 'images/default_food.png'}">
                    <div><strong>${item.name}</strong></div>
                </div>
            </td>
            <td>৳ ${item.price}</td>
            <td>${item.quantity}</td>
            <td>৳ ${itemTotal}</td>
            <td><button onclick="removeItem(${index})" class="qty-btn">Remove</button></td>
        </tr>`;
    });

    updateSummary(subtotal);
    updateSidebarCartCount();
}

function removeItem(index){
    if(confirm('Remove this item?')){
        cart.splice(index,1);
        localStorage.setItem('khaoDaoCart', JSON.stringify(cart));
        displayCart();

        window.dispatchEvent(new Event('storage')); // update other pages
    }
}


function updateSummary(subtotal){
    const delivery = subtotal >= 500 ? 0 : 50;
    const total = subtotal + delivery;
    document.getElementById('subtotalAmount').innerText = '৳ ' + subtotal;
    document.getElementById('deliveryCharge').innerText = '৳ ' + delivery;
    document.getElementById('finalTotal').innerText = '৳ ' + total;
    document.getElementById('cartDataInput').value = JSON.stringify(cart);
    document.getElementById('subtotalInput').value = subtotal;
    document.getElementById('totalInput').value = total;
}


function prepareOrderForm(){
    if(cart.length === 0){
        alert('Cart is empty!');
        return false;
    }
    return confirm('Confirm order?');
}

function updateSidebarCartCount(){
    const countEl = document.getElementById('cartCount');
    if(countEl) countEl.innerText = cart.reduce((sum,item) => sum + item.quantity, 0);
}


window.addEventListener('storage', function(e){
    if(e.key === 'khaoDaoCart'){
        cart = JSON.parse(localStorage.getItem('khaoDaoCart')) || [];
        displayCart();
    }
});


document.addEventListener('DOMContentLoaded', displayCart);
</script>
</body>

</html>