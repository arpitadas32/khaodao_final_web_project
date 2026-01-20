<?php
session_start();
// Admin check
if (!isset($_SESSION["admin"])) { 
    header("Location: login.php"); 
    exit(); 
}
require "db.php";

$sql = "SELECT * FROM menu_items ORDER BY id DESC";
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
    <title>Food Menu Gallery | খাও দাও</title>
    <style>
        :root { 
            --card-shadow: 0 10px 30px rgba(0,0,0,0.05); 
            --sidebar-width: 240px; 
        }
        body, html { margin:0; padding:0; height:100%; font-family:'Segoe UI', sans-serif; background:#f8f9fa; }
        
        .dashboard { display:flex; min-height:100vh; }
        
        .main { 
            flex:1; 
            margin-left: var(--sidebar-width); 
            display:flex; 
            flex-direction:column; 
            min-height: 100vh; 
        }
        
        .content-wrapper { 
            padding:30px 45px; 
            flex-grow: 1; 
        }
        
        .topbar { 
            background:white; padding:20px 30px; border-radius:8px; margin-bottom:25px; 
            box-shadow:var(--card-shadow); display:flex; justify-content:space-between; align-items:center; 
        }

        .menu-grid { 
            display:grid; grid-template-columns:repeat(auto-fill, minmax(250px, 1fr)); 
            gap:25px; margin-bottom:50px; 
        }

        .menu-card { 
            background:#fff; border-radius:20px; overflow:hidden; 
            box-shadow:var(--card-shadow); transition: transform 0.4s ease, box-shadow 0.4s ease; 
            border:1px solid rgba(0,0,0,0.03); 
        }

        .menu-card:hover { transform: translateY(-10px); box-shadow: 0 15px 35px rgba(0,0,0,0.12); }

        .image-box { width:100%; height:180px; overflow:hidden; position:relative; background:#eee; }
        .image-box img { width:100%; height:100%; object-fit:cover; transition: transform 0.5s ease; }
        .menu-card:hover .image-box img { transform: scale(1.1); }
        
        .cat-badge { 
            position:absolute; top:12px; right:12px; background:rgba(255,255,255,0.9); 
            padding:4px 10px; border-radius:15px; font-size:0.7rem; font-weight:bold; color:#764ba2; transition: 0.3s;
        }
        .menu-card:hover .cat-badge { background: #764ba2; color: white; }

        .content-box { padding:18px; text-align:left; }
        .content-box h3 { margin:0 0 5px 0; font-size:1.1rem; color:#333; }
        .price-tag { color:#27ae60; font-weight:800; font-size:1.1rem; display:block; margin-bottom: 15px; }

        .action-area { display: flex; gap: 8px; border-top: 1px solid #f0f0f0; padding-top: 15px; }
        .btn-action { 
            flex:1; padding:8px; border-radius:8px; text-align:center; 
            font-size:12px; font-weight:600; cursor:pointer; background:#f1f2f6; color:#57606f; border:none; transition: 0.3s;
        }
        .btn-delete { color:#e74c3c; background:#fee; }
        .btn-delete:hover { background: #e74c3c; color: white; }
        
        /* ডিজেবল করা বাটন স্টাইল */
        .btn-add-disabled {
            background: #dcdde1; 
            color: #7f8c8d; 
            padding: 10px 20px;
            border-radius: 10px; 
            text-decoration: none; 
            font-weight: 600;
            cursor: not-allowed; /* মাউস নিলে নিষিদ্ধ চিহ্ন দেখাবে */
            pointer-events: none; /* ক্লিক করা যাবে না */
            border: 1px solid #bdc3c7;
            display: inline-block;
        }

        .footer-container {
            width: 100%;
            margin-top: auto; 
        }
    </style>
</head>
<body>

<div class="dashboard">
    <?php include 'sidebar.php'; ?>
    
    <div class="main">
        <div class="content-wrapper">
            <div class="topbar">
                <div>
                    <h2 style="margin:0; color:#444;">🍱 Food Menu Gallery</h2>
                    <p style="margin:10px 0 0 0; font-size:0.85rem; color:#888;">Manage your restaurant items</p>
                </div>
                <a href="#" class="btn-add-disabled">+ Add New Item</a>
            </div>

            <div class="menu-grid">
                <?php if (!empty($foods)): ?>
                    <?php foreach ($foods as $item): ?>
                    <div class="menu-card">
                        <div class="image-box">
                            <img src="<?php echo $item['img']; ?>" 
                                 alt="<?php echo $item['name']; ?>" 
                                 onerror="this.src='../images/default_food.png'">
                            <div class="cat-badge"><?php echo $item['category']; ?></div>
                        </div>
                        <div class="content-box">
                            <h3><?php echo $item['name']; ?></h3>
                            <span class="price-tag">৳ <?php echo number_format($item['price'], 0); ?></span>
                            
                            <div class="action-area">
                                <button class="btn-action">Edit</button>
                                <button class="btn-action btn-delete">Delete</button>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p style="text-align: center; width: 100%; color: #95a5a6;">No food items found.</p>
                <?php endif; ?>
            </div>
        </div> 

        <div class="footer-container">
            <?php include 'footer.php'; ?>
        </div>
    </div> 
</div> 

</body>
</html>