<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<link href="https://fonts.googleapis.com/css2?family=Baloo+Da+2:wght@600;700&display=swap" rel="stylesheet">

<style>

.bangla-title {
    font-family: 'Baloo Da 2', cursive !important;
    font-weight: 700;
    color: #ff5722;
    letter-spacing: 2px;
    text-shadow: 3px 3px 0px #ffd54f;
}


.sidebar {
    width: 240px;
    height: 100vh;
    background: #f5d8c6; 
    padding: 30px 20px;
    box-shadow: 4px 0 20px rgba(0,0,0,0.1);
    position: fixed;
    left: 0;
    top: 0;
    display: flex;
    flex-direction: column;
    z-index: 1000;
}


.sidebar-title {
    font-size: 32px;
    text-align: center;
    margin-bottom: 30px;
}

.sidebar-nav {
    flex-grow: 1; 
}

.sidebar-nav a {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 15px;
    margin-bottom: 10px;
    border-radius: 10px;
    text-decoration: none;
    color: #333;
    font-weight: 600;
    transition: all 0.3s ease;
}

.sidebar-nav a:hover {
    background: #ffede3;
    color: #ff5722;
    transform: translateX(5px);
}

.sidebar-nav a.active {
    background: linear-gradient(90deg, #ff5722, #ff9800);
    color: #fff;
    box-shadow: 0 4px 15px rgba(255, 87, 34, 0.3);
}


.nav-badge {
    background: #ff5722;
    color: white;
    font-size: 11px;
    padding: 2px 8px;
    border-radius: 20px;
    font-weight: bold;
}
.sidebar-nav a.active .nav-badge {
    background: #fff;
    color: #ff5722;
}


.logout-link {
    background: #ffe5e5;
    color: #d32f2f !important;
    margin-top: 20px;
}
.logout-link:hover {
    background: #ffd1d1 !important;
}


.company-profile {
    text-align: center;
    padding-top: 20px;
    border-top: 2px solid rgba(0,0,0,0.05);
}

.company-profile img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 10px;
    border: 3px solid #fff;
}

.sidebar-subtitle {
    font-size: 20px;
}

.company-profile p {
    font-size: 13px;
    color: #777;
    margin-bottom: 10px;
}

.placeholder-logo {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: #fff3e0;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: auto;
    border: 3px solid #fff;
}
</style>

<div class="sidebar">

    <h2 class="bangla-title sidebar-title">খাও দাও</h2>

    <nav class="sidebar-nav">
        <a href="dashboard.php" class="<?= ($current_page=='dashboard.php')?'active':'' ?>">
            <span>🏠 Dashboard</span>
        </a>
        <a href="profile.php" class="<?= ($current_page=='profile.php')?'active':'' ?>">
            <span>👤 Profile</span>
        </a>
        <a href="menu.php" class="<?= ($current_page=='menu.php')?'active':'' ?>">
            <span>🍱 Food Menu</span>
        </a>
        
        <a href="cart.php" class="<?= ($current_page=='cart.php')?'active':'' ?>">
            <span>🛒 My Cart</span>
            <span id="side-cart-count" class="nav-badge">0</span>
        </a>

        <a href="orders.php" class="<?= ($current_page=='orders.php')?'active':'' ?>">
            <span>📜 My Orders</span>
        </a>
        <a href="settings.php" class="<?= ($current_page=='settings.php')?'active':'' ?>">
            <span>⚙️ Settings</span>
        </a>

        <a href="logout.php" class="logout-link"
           onclick="return confirm('Are you sure you want to logout?')">
            <span>🚪 Logout</span>
        </a>
    </nav>

    <div class="company-profile">
        <?php
        $logo_path = "images/company-logo.JPG";
        if (file_exists($logo_path)) {
            echo '<img src="'.$logo_path.'" alt="Company Logo">';
        } else {
            echo '<div class="placeholder-logo bangla-title">খা দা</div>';
        }
        ?>
        <h4 class="bangla-title sidebar-subtitle">খাও দাও</h4>
        <p>Fastest Food Delivery</p>
    </div>

</div>

<script>
    function updateSidebarCartCount() {
    const cart = JSON.parse(localStorage.getItem('khaoDaoCart')) || [];
    const count = cart.reduce((total,item)=>total + (item.quantity || 1), 0);
    const badge = document.getElementById('side-cart-count');
    if(badge) badge.innerText = count;
}
updateSidebarCartCount();
window.addEventListener('storage', updateSidebarCartCount);

    
</script>