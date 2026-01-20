<?php
// Always ensure session is started before checking session variables
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Security Check: Redirect if not an admin
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit();
}
?>

<footer style="margin-left: 0px; padding: 25px; text-align: center; background: #ffffff; border-top: 1px solid #e0e4e8; color: #7f8c8d; font-size: 14px;">
    <div style="margin-bottom: 8px;">
        <strong style="color: #6366f1; font-family: 'Inter', sans-serif;">খাও দাও</strong> 
        &copy; <?php echo date("Y"); ?> Admin Management System.
    </div>
    <div style="font-size: 11px; color: #bdc3c7; letter-spacing: 0.5px; text-transform: uppercase;">
        Developed for efficient food delivery & customer management.
    </div>
</footer>