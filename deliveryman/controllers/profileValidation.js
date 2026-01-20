function validateProfile() {
    const username = document.getElementById("username").value.trim();
    const email    = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value.trim();

    if (username === "" || email === "" || password === "") {
        alert("All fields are required");
        return false;
    }
    return true;
}
