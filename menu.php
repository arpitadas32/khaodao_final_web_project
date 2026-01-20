<?php
session_start();
require "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: customer_login.php");
    exit();
}


$sql = "SELECT * FROM menu_items ORDER BY category, name";
$result = mysqli_query($conn, $sql);

$foods = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $foods[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sultan's Dine Menu - KHAO DAO</title>
    <link rel="stylesheet" href="dashboard.css">
    <style>
        :root { --primary-gradient: linear-gradient(to right, #667eea, #764ba2); --accent-orange: #ffad06; --card-shadow: 0 10px 30px rgba(0,0,0,0.05); --sidebar-width: 260px; }
        body, html { margin:0; padding:0; height:100%; overflow:hidden; font-family:'Segoe UI', sans-serif; background:#f8f9fa; }
        .dashboard { display:flex; height:100vh; }
        .main { flex:1; margin-left:var(--sidebar-width); height:100vh; overflow-y:auto; padding:30px 45px; display:flex; flex-direction:column; }
        .topbar { background:white; padding:20px 30px; border-radius:15px; margin-bottom:25px; box-shadow:var(--card-shadow); display:flex; justify-content:space-between; align-items:center; }
        .category-slider { display:flex; gap:12px; overflow-x:auto; padding:5px 5px 25px 5px; scrollbar-width:none; flex-shrink:0; }
        .category-slider::-webkit-scrollbar { display:none; }
        .cat-item { background:white; padding:12px 25px; border-radius:50px; box-shadow:0 4px 10px rgba(0,0,0,0.05); cursor:pointer; font-weight:600; transition:0.3s; border:1px solid #eee; white-space:nowrap; color:#555; }
        .cat-item.active { background:var(--primary-gradient); color:white; border:none; }
        .cat-item:hover:not(.active) { background:#f0f0f0; }
        .menu-grid { display:grid; grid-template-columns:repeat(auto-fill, minmax(280px,1fr)); gap:30px; margin-bottom:50px; }
        .menu-card { background:#fff; border-radius:20px; overflow:hidden; box-shadow:var(--card-shadow); transition:0.4s ease; display:flex; flex-direction:column; border:1px solid rgba(0,0,0,0.03); }
        .menu-card.hide { display:none; }
        .menu-card:hover { transform:translateY(-8px); box-shadow:0 15px 35px rgba(0,0,0,0.1); }
        .image-box { width:100%; height:210px; overflow:hidden; position:relative; }
        .image-box img { width:100%; height:100%; object-fit:cover; transition:0.5s; }
        .menu-card:hover .image-box img { transform:scale(1.1); }
        .cat-badge { position:absolute; top:15px; right:15px; background:rgba(255,255,255,0.9); padding:5px 12px; border-radius:20px; font-size:0.75rem; font-weight:bold; color:#764ba2; }
        .content-box { padding:20px; flex-grow:1; text-align:left; }
        .content-box h3 { margin:0 0 8px 0; font-size:1.15rem; color:#333; }
        .price-tag { color:#ff105f; font-weight:800; font-size:1.25rem; display:block; margin:10px 0; }
        .add-to-cart { background:var(--primary-gradient); color:white; border:none; padding:12px; border-radius:12px; cursor:pointer; font-weight:600; width:100%; transition:0.3s; }
        .add-to-cart:hover { filter:brightness(1.1); }
        .footer { margin-top:auto; padding:30px 0; text-align:center; color:#888; border-top:1px solid #eee; }
    </style>
</head>
<body>

<div class="dashboard">
    <?php include 'sidebar.php'; ?>
    <div class="main">
        <div class="topbar">
            <h2 style="margin:0; color:#444;">Sultan's Feast Menu</h2>
            <div style="font-size:0.9rem; color:#888;">Authentic Kacchi Since 2016</div>
        </div>

        <div class="category-slider">
            <div class="cat-item active" data-filter="all">All Items</div>
            <div class="cat-item" data-filter="Kacchi">Kacchi</div>
            <div class="cat-item" data-filter="Biryani">Biryani</div>
            <div class="cat-item" data-filter="Tehari">Tehari</div>
            <div class="cat-item" data-filter="Platters">Platters</div>
            <div class="cat-item" data-filter="Add-ons">Sides & Curry</div>
            <div class="cat-item" data-filter="Beverages">Drinks</div>
            <div class="cat-item" data-filter="Desserts">Desserts</div>
        </div>

        <div class="menu-grid" id="menuGrid">
            <?php foreach ($foods as $item): ?>
            <div class="menu-card" data-category="<?php echo $item['category']; ?>">
                <div class="image-box">
                    <img src="<?php echo $item['img']; ?>" alt="<?php echo $item['name']; ?>" onerror="this.src='images/default_food.png'">
                    <div class="cat-badge"><?php echo $item['category']; ?></div>
                </div>
                <div class="content-box">
                    <h3><?php echo $item['name']; ?></h3>
                    <span class="price-tag">৳ <?php echo $item['price']; ?></span>
                    <button class="add-to-cart" onclick="addToCart('<?php echo $item['name']; ?>', <?php echo $item['price']; ?>, '<?php echo $item['img']; ?>')">Add to Feast</button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="footer">
            <p>© <?php echo date("Y"); ?> Sultan's Dine - Khao Dao Integration. All rights reserved.</p>
        </div>
    </div>
</div>

<script>
const filterBtns = document.querySelectorAll('.cat-item');
const cards = document.querySelectorAll('.menu-card');

filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        filterBtns.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        const filter = btn.getAttribute('data-filter');
        cards.forEach(card => {
            const category = card.getAttribute('data-category');
            if (filter === 'all' || filter === category) card.classList.remove('hide');
            else card.classList.add('hide');
        });
    });
});

let cart = JSON.parse(localStorage.getItem('khaoDaoCart')) || [];

function addToCart(name, price, img) {
    const existing = cart.find(item => item.name === name);
    if(existing) existing.quantity += 1;
    else cart.push({name, price, img, quantity:1});
    
    localStorage.setItem('khaoDaoCart', JSON.stringify(cart));
    
    alert(name + " added to cart!");
    
    
    updateSidebarCartCount();

    
    window.dispatchEvent(new Event('storage'));
}
function removeItem(index){
    if(confirm('Remove this item?')){
        cart.splice(index,1);
        localStorage.setItem('khaoDaoCart', JSON.stringify(cart));

      
        displayCart();

        
        updateSidebarCartCount();

        
        window.dispatchEvent(new Event('storage'));
    }
}


function updateSidebarCartCount() {
    const countEl = document.getElementById('cartCount');
    if(countEl) countEl.innerText = cart.reduce((sum,i)=>sum+i.quantity,0);
}

updateSidebarCartCount();

</script>
</body>
</html>
