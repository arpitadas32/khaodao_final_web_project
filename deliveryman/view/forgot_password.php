<?php require_once "../controllers/ForgotPasswordController.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Forget Password</title>

    <link rel="stylesheet" href="forgot_password.css">
    <script src="../controllers/forgotValidation.js"></script>
</head>
<body>

<h2>🔐 Forget Password</h2>

<form method="POST" onsubmit="return validateForgot()">

    <label>Email</label>
    <input type="email" name="email" id="email">

    <label>New Password</label>
    <input type="password" name="new_password" id="new_password">

    <button type="submit">Reset Password</button>

    <?php if (!empty($message)): ?>
        <p class="<?= $msgType ?>"><?= $message ?></p>
    <?php endif; ?>

</form>

</body>
</html>
