<?php

include 'navbar.php';

// Check if user is logged in
if (!isset($_SESSION['bemail'])) {
header('location: index.php');
exit();
}

// Process order when form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
// Generate invoice number
$invoice_no = mt_rand();
$user_id = $_SESSION['bid'];

// Get form data
$name = $conn->real_escape_string($_POST['name']);
$address = $conn->real_escape_string($_POST['address']);
$phone = $conn->real_escape_string($_POST['number']);
$payment_method = $conn->real_escape_string($_POST['payment_method']);

// Calculate total from cart
$total = 0;
$delivery_charge = 250;

// Get all cart items for this user
$cart_query = "SELECT c.p_id, c.qty, p.price 
FROM cart c 
JOIN product p ON c.p_id = p.pid 
WHERE c.user_id = '$user_id'";
$cart_result = $conn->query($cart_query);

$order_success = true;
while ($row = $cart_result->fetch_assoc()) {
$subtotal = $row['price'] * $row['qty'];
$total += $subtotal;
$final_price= $delivery_charge + $subtotal;
// Insert each product into the order table
$insert_query = "INSERT INTO `orders` 
(`u_id`, `invoice`, `name`, `address`, `phone`, `p_id`, `qty`, `total`, `status`, `payment_method`) 
VALUES 
('$user_id', '$invoice_no', '$name', '$address', '$phone', '{$row['p_id']}', '{$row['qty']}', '$final_price', 'Pending', '$payment_method')";

if (!$conn->query($insert_query)) {
$order_success = false;
break; // If any insert fails, stop the process
}
}

// Check if all items were inserted successfully
if ($order_success) {
// Clear the cart after successful order
$clear_cart = "DELETE FROM cart WHERE user_id = '$user_id'";
$conn->query($clear_cart);

// Redirect with success message
echo "<script>
alert('Order placed successfully! Invoice #$invoice_no');
window.location.href = 'index.php';
</script>";
exit();
} else {
$error = "Error placing order: " . $conn->error;
}
}

?>

<div class="container-fluid">
<div class="row">
<div class="col-md-1"></div>
<div class="col-md-10">
<div class="row">
<!-- Order Summary -->
<div class="col-md-6">
<br><br>
<div class="card">
<div class="card-header bg-primary text-white">
<h4 class="mb-0">Order Summary</h4>
</div>
<div class="card-body">
<table class="table table-hover">
<thead class="thead-light">
<tr>
<th>Product</th>
<th class="text-center">Price</th>
<th class="text-center">Qty</th>
<th class="text-right">Subtotal</th>
</tr>
</thead>
<tbody>
<?php
$user_id = $_SESSION['bid'];
$slt = "SELECT * FROM cart WHERE user_id ='$user_id'";
$result = $conn->query($slt);
$grandTotal = 0;
$delivery_charge = 250;

if ($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
$product_id = $row['p_id'];
$qty = $row['qty'];
$cart_id = $row['c_id'];

$slt1 = "SELECT * FROM product WHERE pid='$product_id'";
$cnm1 = mysqli_query($conn, $slt1);
$cfetch = mysqli_fetch_array($cnm1);

$name = $cfetch['name'];
$pic = $cfetch['pic01'];
$price = $cfetch['price'];
$subtotal = $price * $qty;
$grandTotal += $subtotal;
?>
<tr>
<td>
<div class="d-flex align-items-center">
<img src="admin/upload/<?php echo $pic; ?>" alt="<?php echo $name; ?>" 
class="img-thumbnail" style="width: 60px; height: 60px;">
<div class="ml-3">
<h6 class="mb-0"><?php echo $name; ?></h6>
</div>
</div>
</td>
<td class="text-center">Rs. <?php echo number_format($price, 2); ?></td>
<td class="text-center"><?php echo $qty; ?></td>
<td class="text-right">Rs. <?php echo number_format($subtotal, 2); ?></td>
</tr>
<?php 
}
} 
?>
</tbody>
<tfoot>
<tr>
<th colspan="3" class="text-right">Subtotal:</th>
<th class="text-right">Rs. <?php echo number_format($grandTotal, 2); ?></th>
</tr>
<tr>
<th colspan="3" class="text-right">Delivery Charges:</th>
<th class="text-right">Rs. <?php echo number_format($delivery_charge, 2); ?></th>
</tr>
<tr class="table-active">
<th colspan="3" class="text-right">Grand Total:</th>
<th class="text-right">Rs. <?php echo number_format($grandTotal + $delivery_charge, 2); ?></th>
</tr>
</tfoot>
</table>
</div>
</div>
</div>

<!-- Checkout Form -->
<div class="col-md-6">
<br><br>
<div class="card">
<div class="card-header bg-primary text-white">
<h4 class="mb-0">Shipping & Payment Information</h4>
</div>
<div class="card-body">
<?php if (isset($error)): ?>
<div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

<form method="POST" action="">
<div class="form-group">
<label for="name">Full Name</label>
<input type="text" class="form-control" id="name" name="name" required>
</div>

<div class="form-group">
<label for="address">Shipping Address</label>
<textarea class="form-control" id="address" name="address" rows="3" required></textarea>
</div>

<div class="form-group">
<label for="number">Phone Number</label>
<input type="number" class="form-control" id="number" name="number"  required>
</div>

<div class="form-group">
<label>Payment Method</label>
<div class="border p-3">
<div class="custom-control custom-radio mb-2">
<input type="radio" id="cod" name="payment_method" value="COD" class="custom-control-input" checked>
<label class="custom-control-label" for="cod">Cash on Delivery (COD)</label>
</div>
</div>
</div>

<div class="d-flex justify-content-between mt-4">
<a href="index.php" class="btn btn-outline-secondary">Continue Shopping</a>
<button type="submit" name="submit" class="btn btn-primary">Place Order</button>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
<div class="col-md-1"></div>
</div>
</div>

<script>
</script>

<?php include 'footer.php'; ?>
