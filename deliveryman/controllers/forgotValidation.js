function validateForgot() {

    let email = document.getElementById("email").value.trim();
    let password = document.getElementById("new_password").value.trim();

    if (email === "" || password === "") {
        alert("All fields are required");
        return false;
    }

    if (password.length < 5) {
        alert("Password must be at least 5 characters");
        return false;
    }

    return true;
}
