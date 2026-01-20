function validateSignup() {
    const password = document.getElementById("password").value;
    const confirm  = document.getElementById("confirm_password").value;
    const error    = document.getElementById("error-msg");

    if (password !== confirm) {
        error.textContent = "Passwords do not match";
        return false;
    }

    if (password.length < 6) {
        error.textContent = "Password must be at least 6 characters";
        return false;
    }

    error.textContent = "";
    return true;
}
