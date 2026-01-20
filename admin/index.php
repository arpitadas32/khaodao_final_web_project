<?php
// index.php
// Entry point of the project
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Web Tech Project</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 0;
        }
        header {
            background: #2c3e50;
            color: white;
            padding: 20px;
            text-align: center;
        }
        main {
            padding: 40px;
            text-align: center;
        }
        .card {
            background: white;
            padding: 30px;
            max-width: 600px;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        footer {
            margin-top: 40px;
            padding: 15px;
            text-align: center;
            background: #ecf0f1;
            color: #555;
        }
    </style>
</head>
<body>

<header>
    <h1>Welcome to Web Technology Project</h1>
    <p>Git Workflow Simulation Project</p>
</header>

<main>
    <div class="card">
        <h2>Project Status</h2>
        <p>This project is successfully connected with GitHub.</p>

        <p>
            <strong>Branches:</strong><br>
            main – Production<br>
            dev – Development<br>
            stage – Testing
        </p>

        <p>
            <strong>Student:</strong><br>
            Tousif Tarik
        </p>

        <p>
            <strong>Status:</strong> Setup Completed ✅
        </p>
    </div>
</main>

<footer>
    <p>&copy; <?php echo date("Y"); ?> Web Tech Project | All Rights Reserved</p>
</footer>

</body>
</html>
<?php
// admin/index.php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit();
}
header("Location: login.php");
exit();
?>      