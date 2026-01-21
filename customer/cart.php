<?php
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
    margin: 0; padding: 0;
    font-family: 'Segoe UI', sans-serif;
    background: #f8f9fa;
}

.dashboard { display: flex; min-height: 100vh; }

.main {
    flex: 1;
    margin-left: var(--sidebar-width);
    padding: 30px 45px;
}

/* Updated Topbar Style */
.topbar {
    background: white;
    padding: 20px 30px;
    border-radius: 15px;
    margin-bottom: 25px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.cart-container {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 30px;
}

.cart-table-card {
    background: white;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

table { width: 100%; border-collapse: collapse; }
th, td { padding: 15px; border-bottom: 1px solid #f4f4f4; text-align: left; }

.item-detail { display: flex; align-items: center; gap: 15px; }
.item-detail img { width: 60px; height: 60px; border-radius: 10px; object-fit: cover; }

/* Quantity Selector */
.cart-qty-box {
    display: flex;
    align-items: center;
    background: #f1f3f6;
    border-radius: 8px;
    width: fit-content;
    border: 1px solid #ddd;
}
.cart-qty-btn {
    width: 28px;
    height: 28px;
    border: none;
    background: none;
    cursor: pointer;
    font-weight: bold;
    color: #764ba2;
}
.cart-qty-val {
    width: 30px;
    text-align: center;
    font-weight: bold;
    font-size: 0.9rem;
}

/* STYLISH REMOVE BUTTON - Suitable Color Update */
.remove-btn {
    background: #fff5f5;
    color: #e74c3c;
    border: 1px solid #fab1a0;
    padding: 8px 15px;
    border-radius: 10px;
    cursor: pointer;
    font-weight: 600;
    font-size: 0.85rem;
    transition: 0.3s ease;
    display: flex;
    align-items: center;
    gap: 5px;
}

.remove-btn:hover {
    background: #e74c3c;
    color: white;
    border-color: #e74c3c;
    box-shadow: 0 4px 12px rgba(231, 76, 60, 0.2);
}

.summary-card {
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    height: fit-content;
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
    margin-top: 20px;
    transition: 0.3s;
}

.checkout-btn:hover {
    opacity: 0.9;
    transform: translateY(-2px);
}

.alert { padding: 15px; border-radius: 8px; margin-bottom: 20px; }
.alert-success { background: #d4edda; color: #155724; }
.alert-error { background: #f8d7da; color: #721c24; }

.summary-row { display: flex; justify-content: space-between; padding: 10px 0; }
.total-row { font-weight: bold; font-size: 1.2rem; border-top: 1px solid #eee; margin-top: 10px; padding-top: 15px; }
</style>
</head>
<body>
<div class="dashboard">
    <?php include 'sidebar.php'; ?>

    <div class="main">
        <div class="topbar">
            <div>
                <h2 style="margin:0; color:#444;">🛒 Confirm Your Feast</h2>
            </div>
            <div style="text-align: right;">
                <span style="background: #f1f3f6;font-size: 0.85rem;">
                    Authentic Kacchi Since 2016
                </span>
            </div>
        </div>

        <?php if($error): ?> <div class="alert alert-error"><?= $error ?></div> <?php endif; ?>
        <?php if($success): ?> <div class="alert alert-success"><?= $success ?></div> <?php endif; ?>

        <div class="cart-container">
            <div class="cart-table-card">
                <table id="cartTable">
                    <thead>
                        <tr><th>Item</th><th>Price</th><th>Qty</th><th>Subtotal</th><th>Action</th></tr>
                    </thead>
                    <tbody id="cartItemsList"></tbody>
                </table>
                <div id="emptyMsg" style="display:none; text-align:center; padding:40px;">
                    <h3>Your cart is empty! 🌮</h3>
                    <a href="menu.php" style="color:#764ba2; font-weight:bold;">Go to Menu</a>
                </div>
            </div>

            <div class="summary-card">
                <h3>💰 Order Summary</h3>
                <div class="summary-row"><span>Items Total</span><span id="subtotalAmount">৳ 0</span></div>
                <div class="summary-row"><span>Delivery Charge</span><span id="deliveryCharge">৳ 50</span></div>
                <div class="summary-row total-row"><span>Total Payable</span><span id="finalTotal">৳ 0</span></div>

                <form method="POST" id="orderForm" onsubmit="return prepareOrderForm()">
                    <input type="hidden" name="cart_data" id="cartDataInput">
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
        document.getElementById('cartTable').style.display = 'none';
        checkoutBtn.disabled = true;
        updateSummary(0);
        updateSidebarCartCount();
        return;
    }

    emptyMsg.style.display = 'none';
    document.getElementById('cartTable').style.display = 'table';
    checkoutBtn.disabled = false;

    let subtotal = 0;
    cart.forEach((item, index) => {
        let itemTotal = item.price * item.quantity;
        subtotal += itemTotal;
        list.innerHTML += `
            <tr>
                <td>
                    <div class="item-detail">
                        <img src="${item.img || 'images/default_food.png'}">
                        <strong>${item.name}</strong>
                    </div>
                </td>
                <td>৳ ${item.price}</td>
                <td>
                    <div class="cart-qty-box">
                        <button class="cart-qty-btn" onclick="updateQty(${index}, -1)">−</button>
                        <div class="cart-qty-val">${item.quantity}</div>
                        <button class="cart-qty-btn" onclick="updateQty(${index}, 1)">+</button>
                    </div>
                </td>
                <td>৳ ${itemTotal}</td>
                <td><button onclick="removeItem(${index})" class="remove-btn">✖ Remove</button></td>
            </tr>`;
    });

    updateSummary(subtotal);
    updateSidebarCartCount();
}

function updateQty(index, delta) {
    cart[index].quantity += delta;
    if (cart[index].quantity < 1) {
        removeItem(index);
    } else {
        saveAndRefresh();
    }
}

function removeItem(index){
    if(confirm('Remove this item?')){
        cart.splice(index, 1);
        saveAndRefresh();
    }
}

function saveAndRefresh() {
    localStorage.setItem('khaoDaoCart', JSON.stringify(cart));
    displayCart();
    window.dispatchEvent(new Event('storage'));
}

function updateSummary(subtotal){
    const delivery = (subtotal >= 500 || subtotal === 0) ? 0 : 50;
    const total = subtotal + delivery;
    document.getElementById('subtotalAmount').innerText = '৳ ' + subtotal;
    document.getElementById('deliveryCharge').innerText = '৳ ' + delivery;
    document.getElementById('finalTotal').innerText = '৳ ' + total;
    document.getElementById('cartDataInput').value = JSON.stringify(cart);
}

function prepareOrderForm(){
    if(cart.length === 0) return false;
    return confirm('Ready to place your order?');
}

function updateSidebarCartCount(){
    const countEl = document.getElementById('cartCount');
    if(countEl) countEl.innerText = cart.reduce((sum, item) => sum + item.quantity, 0);
}

document.addEventListener('DOMContentLoaded', displayCart);
</script>
</body>
</html>