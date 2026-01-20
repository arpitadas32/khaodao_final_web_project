function validateOrder() {
    let id = document.getElementById("order_id").value;

    if (id === "" || id <= 0) {
        alert("Please enter a valid Order ID");
        return false;
    }
    return true;
}
