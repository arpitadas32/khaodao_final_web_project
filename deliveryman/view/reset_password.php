<?php require_once "../controllers/ResetPasswordController.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>

    <link rel="stylesheet" href="reset_password.css">
    <script src="../controllers/resetValidation.js"></script>
</head>
<body>

<div class="container">
    <div class="card">
        <h2>Reset Password</h2>

        <form method="POST" onsubmit="return validateReset()">
            <input type="email" name="email" id="email" placeholder="Enter your email">
            <input type="password" name="password" id="password" placeholder="Enter new password">
            <button type="submit">Reset Password</button>
        </form>

        <?php if (!empty($error)): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <p class="success"><?= $success ?></p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
