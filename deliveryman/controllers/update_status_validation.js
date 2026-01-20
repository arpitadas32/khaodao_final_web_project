function validateSearch() {
    let id = document.getElementById("search_id").value.trim();
    if (id === "") {
        alert("Please enter Order ID");
        return false;
    }
    return true;
}

function validateUpdate() {
    let orderid = document.getElementById("orderid").value.trim();
    let pickup = document.getElementById("pickup").value.trim();
    let delivery = document.getElementById("delivery").value.trim();

    if (orderid === "" || pickup === "" || delivery === "") {
        alert("All fields are required");
        return false;
    }
    return true;
}
