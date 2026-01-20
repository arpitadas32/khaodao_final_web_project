<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>Profile - খাও দাও</title>
    <link rel="stylesheet" href="profile.css">
</head>
<body>

<header class="page-header">
    <h1>খাও দাও</h1>
</header>

<div class="sidebar">
    <a href="../controller/DashboardController.php">📊 Dashboard</a>
    <a href="#">👤 Profile</a>
    <a href="#">📦 Delivery Request</a>
    <a href="#">🔄 Update Status</a>
    <a href="#">✅ Completed Deliveries</a>
    <a href="#">📜 Delivery History</a>
    <a href="../logout.php">🚪 Logout</a>
</div>

<div class="main">
    <div class="profile-box">
        <h2>My Profile</h2>

        <form method="POST" onsubmit="return validateProfile();">
            <label>Username</label>
            <input type="text" id="username" name="username"
                   value="<?= htmlspecialchars($username) ?>">

            <label>Email</label>
            <input type="email" id="email" name="email"
                   value="<?= htmlspecialchars($email) ?>">

            <label>New Password</label>
            <input type="password" id="password" name="password">

            <button type="submit">Update Profile</button>

            <?php if ($msg === "success"): ?>
                <p class="success">✅ Profile updated successfully!</p>
            <?php elseif ($msg === "error"): ?>
                <p class="error">❌ Update failed!</p>
            <?php elseif ($msg === "empty"): ?>
                <p class="error">❗ All fields are required!</p>
            <?php endif; ?>
        </form>
    </div>
</div>

<script src="../controller/profileValidation.js"></script>
</body>
</html>
