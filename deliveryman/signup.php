<?php
// ---------- PHP Validation & Database Insert ----------
$errors = [];
$success = "";

if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Basic validation
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $errors[] = "All fields are required.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }
    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters.";
    }

    // If no errors, insert into database
    if (empty($errors)) {
        $conn = new mysqli("localhost", "root", "", "login_system");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if username or email already exists
        $check = $conn->prepare("SELECT * FROM regi WHERE username=? OR email=?");
        $check->bind_param("ss", $username, $email);
        $check->execute();
        $result = $check->get_result();

        if ($result->num_rows > 0) {
            $errors[] = "Username or Email already exists.";
        } else {
            $stmt = $conn->prepare("INSERT INTO regi (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $password);
            if ($stmt->execute()) {
                $success = "Account created successfully!";
            } else {
                $errors[] = "Error inserting data.";
            }
            $stmt->close();
        }
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup</title>
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
        .login-link {
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
    </style>
    <script>
        function validateSignup() {
            let username = document.getElementById("username").value.trim();
            let email = document.getElementById("email").value.trim();
            let password = document.getElementById("password").value.trim();
            let confirm_password = document.getElementById("confirm_password").value.trim();
            let errors = [];

            if (username === "" || email === "" || password === "" || confirm_password === "") {
                errors.push("All fields are required.");
            }
            let emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
            if (!email.match(emailPattern)) {
                errors.push("Invalid email format.");
            }
            if (password !== confirm_password) {
                errors.push("Passwords do not match.");
            }
            if (password.length < 6) {
                errors.push("Password must be at least 6 characters.");
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
        <h2>Welcome Delivery Man</h2>
        <p>Please fill in the details</p>

        <form method="POST" action="" onsubmit="return validateSignup()">
            <div class="input-box">
                <input type="text" name="username" id="username" required>
                <label>Username</label>
            </div>

            <div class="input-box">
                <input type="email" name="email" id="email" required>
                <label>Email</label>
            </div>

            <div class="input-box">
                <input type="password" name="password" id="password" required>
                <label>Password</label>
            </div>

            <div class="input-box">
                <input type="password" name="confirm_password" id="confirm_password" required>
                <label>Confirm Password</label>
            </div>

            <button type="submit" name="submit">Sign Up</button>

            <?php
            if (!empty($errors)) {
                foreach ($errors as $error) {
                    echo "<p class='error'>$error</p>";
                }
            }
            if (!empty($success)) {
                echo "<p class='success'>$success</p>";
            }
            ?>

            <div class="login-link">
                <p>Already have an account?
                    <a href="login.php">Login</a>
                </p>
            </div>
        </form>
    </div>
</div>

</body>
</html>