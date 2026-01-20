<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>Update Delivery Status</title>

<link rel="stylesheet" href="update_status.css">
<script src="../controllers/update_status_validation.js"></script>
</head>

<body>

<h2>Update Delivery Status</h2>

<?php if (!empty($update_msg)): ?>
<div class="msg"><?= $update_msg ?></div>
<?php endif; ?>

<div class="form-box">

<!-- SEARCH FORM -->
<form method="POST"
      action="../controllers/UpdateStatusController.php"
      onsubmit="return validateSearch()">

<label>Search by Order ID</label>
<input type="text" name="search_id" id="search_id">
<button name="search">Search</button>
</form>

<?php if ($order): ?>
<!-- UPDATE FORM -->
<form method="POST"
      action="../controllers/UpdateStatusController.php"
      onsubmit="return validateUpdate()">

<input type="hidden" name="id" value="<?= $order['ID'] ?>">

<label>Order ID</label>
<input type="text" name="orderid" id="orderid"
       value="<?= htmlspecialchars($order['Orderid']) ?>">

<label>Pickup</label>
<input type="text" name="pickup" id="pickup"
       value="<?= htmlspecialchars($order['pickup']) ?>">

<label>Delivery</label>
<input type="text" name="delivery" id="delivery"
       value="<?= htmlspecialchars($order['delivery']) ?>">

<button name="update">Update</button>
</form>
<?php endif; ?>

</div>

</body>
</html>
