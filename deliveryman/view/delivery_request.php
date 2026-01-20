<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<title>Delivery Request</title>
<link rel="stylesheet" href="delivery_request.css">
<script src="../controllers/delivery_validation.js"></script>
</head>

<body>

<h2>Delivery Requests</h2>

<?php if(!empty($message)): ?>
<div class="msg"><?= $message ?></div>
<?php endif; ?>

<table>
<tr>
<th>ID</th>
<th>Order ID</th>
<th>Pickup</th>
<th>Delivery</th>
</tr>

<?php if(count($requests)>0): ?>
<?php foreach($requests as $r): ?>
<tr>
<td><?= $r['ID'] ?></td>
<td><?= htmlspecialchars($r['Orderid']) ?></td>
<td><?= htmlspecialchars($r['pickup']) ?></td>
<td><?= htmlspecialchars($r['delivery']) ?></td>
</tr>
<?php endforeach; ?>
<?php else: ?>
<tr><td colspan="4">No Requests Found</td></tr>
<?php endif; ?>
</table>

<div class="form-box">
<form method="POST" action="../controllers/DeliveryController.php"
      onsubmit="return validateOrder()">

<input type="number" name="order_id" id="order_id" placeholder="Order ID" required>

<button name="accept">Accept</button>
<button name="reject">Reject</button>

</form>
</div>

</body>
</html>
