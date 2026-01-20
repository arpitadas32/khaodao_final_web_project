function validateOrderForm() {
    const orderId = document.getElementById("orderid").value.trim();
    const orderName = document.getElementById("ordername").value.trim();
    const price = document.getElementById("price").value;

    if (orderId === "" || orderName === "" || price <= 0) {
        alert("All fields are required and price must be greater than 0");
        return false;
    }
    return true;
}
