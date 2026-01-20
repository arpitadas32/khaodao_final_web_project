<?php
session_start();
$error = "";

if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $error = "All fields are required.";
    } else {
        $conn = new mysqli("localhost", "root", "", "khodao");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("SELECT * FROM regi WHERE username=? AND password=?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid username or password.";
        }

        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            font-family: Arial;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        .login-container {
            display: flex;
            justify-content: center;
            margin-top: 50px;
        }
        .login-card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            width: 350px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 10px;
        }
        p {
            text-align: center;
            margin-bottom: 20px;
        }
        .input-box {
            position: relative;
            margin-bottom: 20px;
        }
        .input-box input {
            width: 100%;
            padding: 10px;
            border: 1px solid #aaa;
            border-radius: 5px;
        }
        .input-box label {
            position: absolute;
            top: -10px;
            left: 10px;
            background: white;
            padding: 0 5px;
            font-size: 14px;
            color: #555;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 10px;
        }
        .signup-link {
            text-align: center;
        }
        .error {
            color: red;
            text-align: center;
        }
        .success {
            color: green;
            text-align: center;
        }
        .forgot-link {
            text-align: center;
            margin-bottom: 10px;
        }
        .forgot-link a {
            color: #007BFF;
            text-decoration: none;
            font-size: 14px;
        }
        .forgot-link a:hover {
            text-decoration: underline;
        }
    </style>
    <script>
        function validateLogin() {
            let username = document.getElementById("username").value.trim();
            let password = document.getElementById("password").value.trim();
            let errors = [];

            if (username === "" || password === "") {
                errors.push("All fields are required.");
            }

            if (errors.length > 0) {
                alert(errors.join("\n"));
                return false;
            }
            return true;
        }
    </script>
</head>
<body>

<div class="login-container">
    <div class="login-card">
        <h2>Welcome Back</h2>
        <p>Please login to your account</p>

        <form method="POST" action="" onsubmit="return validateLogin()">
            <div class="input-box">
                <input type="text" name="username" id="username" required>
                <label>Username</label>
            </div>

            <div class="input-box">
                <input type="password" name="password" id="password" required>
                <label>Password</label>
            </div>

            <!-- Forgot Password link above Login button -->
            <div class="forgot-link">
                <a href="forgot_password.php">Forgot Password?</a>
            </div>

            <button type="submit" name="submit">Login</button>

            <?php
            if (!empty($error)) {
                echo "<p class='error'>$error</p>";
            }
            ?>

            <div class="signup-link">
                <p>Don’t have an account?
                    <a href="signup.php">Create one</a>
                </p>
            </div>
        </form>
    </div>
</div>

</body>
</html>

