<?php
session_start();
require "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: customer_login.php");
    exit();
}

$user_id = $_SESSION["user_id"];


$query = mysqli_query($conn, "SELECT username, email, profile_pic FROM users WHERE id = '$user_id'");
$user = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Settings - KHAO DAO</title>
<link rel="stylesheet" href="dashboard.css">
<style>
.dashboard { display:flex; height:100vh; overflow:hidden; }
.sidebar { width:230px; position:fixed; top:0; left:0; height:100vh; background:linear-gradient(180deg,#667eea,#764ba2); color:white; padding:20px; overflow-y:auto; }
.main { flex:1; margin-left:230px; padding:25px; overflow-y:auto; height:100vh; display:flex; flex-direction:column; }
.settings-wrapper { display:grid; grid-template-columns:1fr 2fr; gap:25px; flex:1; margin-bottom:25px; }
.settings-card { background:white; padding:30px; border-radius:15px; box-shadow:0 10px 25px rgba(0,0,0,0.05); }
.photo-upload-box { border:2px dashed #ddd; padding:20px; text-align:center; border-radius:15px; }
.preview-square { width:150px; height:150px; margin:0 auto 15px; border-radius:10px; overflow:hidden; background:#f8f9fa; display:flex; align-items:center; justify-content:center; border:1px solid #eee; }
.preview-square img { width:100%; height:100%; object-fit:cover; }
.form-group { margin-bottom:20px; }
.form-group label { display:block; margin-bottom:8px; font-weight:bold; }
.form-group input { width:100%; padding:12px; border:1px solid #ddd; border-radius:8px; }
.btn-update { background:#764ba2; color:white; border:none; padding:12px 25px; border-radius:8px; cursor:pointer; font-weight:bold; width:100%; }
.file-label { display:block; margin-top:10px; color:#764ba2; cursor:pointer; font-weight:600; text-decoration:underline; }
.footer { margin-top:auto; padding:15px; background:white; text-align:center; border-radius:10px; box-shadow:0 5px 15px rgba(0,0,0,0.05); }
.message { margin-bottom:15px; padding:10px; border-radius:8px; font-weight:bold; text-align:center; }
.message.success { background:#d4edda; color:#155724; }
.message.error { background:#f8d7da; color:#721c24; }
</style>
</head>
<body>

<div class="dashboard">
    <?php include 'sidebar.php'; ?>

    <div class="main">
        <div class="topbar"><h3>Account Settings</h3></div>

        
        <?php
        if (isset($_SESSION['success'])) {
            echo '<div class="message success">'.$_SESSION['success'].'</div>';
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['error'])) {
            echo '<div class="message error">'.$_SESSION['error'].'</div>';
            unset($_SESSION['error']);
        }
        ?>

        <form action="settings_process.php" method="POST" enctype="multipart/form-data">
            <div class="settings-wrapper">

              
                <div class="settings-card">
                    <h4 style="text-align:center; color:#764ba2; margin-bottom:15px;">Profile Photo</h4>
                    <div class="photo-upload-box">
                        <div class="preview-square" id="imagePreview">
                            <?php if (!empty($user['profile_pic']) && file_exists("uploads/".$user['profile_pic'])): ?>
                                <img src="uploads/<?php echo $user['profile_pic']; ?>" alt="Profile Picture">
                            <?php else: ?>
                                <span style="font-size:40px; color:#ccc;"><?php echo strtoupper(substr($user['username'],0,1)); ?></span>
                            <?php endif; ?>
                        </div>

                        <label for="profile_image" class="file-label">Choose Photo</label>
                        <input type="file" name="profile_image" id="profile_image" accept="image/*" style="display:none;" onchange="showPreview(this)">

                        <button type="submit" name="upload_photo" class="btn-update" style="margin-top:15px; padding:8px; font-size:13px; background:#667eea;">
                            Upload Photo
                        </button>
                    </div>
                </div>

                
                <div class="settings-card">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>New Password (Optional)</label>
                        <input type="password" name="new_password" placeholder="Leave blank to keep current">
                    </div>
                    <button type="submit" name="update_info" class="btn-update">Save Changes</button>
                </div>

            </div>
        </form>

        <div class="footer">
            <p>© <?php echo date("Y"); ?> Khao Dao. All rights reserved.</p>
        </div>
    </div>
</div>

<script>
function showPreview(input) {
    if(input.files && input.files[0]){
        var reader = new FileReader();
        reader.onload = function(e){
            document.getElementById('imagePreview').innerHTML = '<img src="'+e.target.result+'">';
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

</body>
</html>
