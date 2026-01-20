function validateSignup() {

    let username = document.getElementById("username").value.trim();
    let email = document.getElementById("email").value.trim();
    let password = document.getElementById("password").value.trim();
    let confirm = document.getElementById("confirm_password").value.trim();

    if (username === "" || email === "" || password === "" || confirm === "") {
        alert("All fields are required");
        return false;
    }

    let emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    if (!email.match(emailPattern)) {
        alert("Invalid email format");
        return false;
    }

    if (password !== confirm) {
        alert("Passwords do not match");
        return false;
    }

    if (password.length < 6) {
        alert("Password must be at least 6 characters");
        return false;
    }

    return true;
}
