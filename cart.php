<?php include 'navbar.php'; ?>


<div class="container my-5">
    <h4 class="mb-4 text-center text-primary">Your Shopping Cart</h4>

    <?php
    if (isset($_SESSION['bid'])) {
        $user_id = $_SESSION['bid'];
        $slt = "SELECT * FROM cart WHERE user_id ='$user_id'";
        $result = $conn->query($slt);

        $grandTotal = 0;
        if ($result->num_rows > 0) {
    ?>
            <form method="POST" action="cart.php">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>Remove</th>
                                <th>Image</th>
                                <th>Product Name</th>

                                <th>Quantity</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            while ($row = $result->fetch_assoc()) {
                                $pro_id = $row['p_id'];
                                $qty2 = $row['qty'];
                                $cart_id = $row['c_id'];

                                $slt1 = "SELECT * FROM product WHERE pid='$pro_id'";
                                $cnm1 = mysqli_query($conn, $slt1);
                                $cfetch = mysqli_fetch_array($cnm1);

                                $name = $cfetch['name'];

                                $pic = $cfetch['pic01'];
                                $price = $cfetch['price'];

                                $grandTotal += $price * $qty2;
                            ?>
                                <tr>
                                    <td>
                                        <a href='cart.php?remove=<?php echo $cart_id; ?>' class="text-danger" title="Remove Item">
                                            <i class="fa-solid fa-trash fa-lg"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <img src="admin/upload/<?php echo $pic; ?>" class="img-thumbnail" style="width: 80px; height: 60px;" alt="<?php echo $name; ?>">
                                    </td>
                                    <td><?php echo $name; ?></td>

                                    <td>
                                        <form method="POST" action="cart.php" class="d-flex justify-content-center gap-2">
                                            <input type="number" name="qty" min="1" max="10" value="<?php echo $qty2; ?>" class="form-control form-control-sm" style="width: 70px;">
                                            <input type="hidden" name="product_id" value="<?php echo $cart_id; ?>">
                                            <button type="submit" name="update" class="btn btn-sm btn-warning">Update</button>
                                        </form>
                                    </td>
                                    <td>Rs. <?php echo $price; ?></td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </form>

            <div class="text-end mt-3">
                <h5><strong>Grand Total:</strong> Rs. <?php echo $grandTotal; ?></h5>
            </div>

            <div class="text-center mt-4">
                <a href="index.php" class="btn btn-success me-2">
                    <i class="fa fa-shopping-cart"></i> Continue Shopping
                </a>
                <a href="checkout.php" class="btn btn-primary">
                    <i class="fa fa-credit-card"></i> Checkout
                </a>
            </div>

    <?php
        } else {
            echo "<div class='alert alert-info text-center'>Your cart is empty.</div>";
        }
    } else {
        echo "<div class='alert alert-warning text-center'>Please log in to view your cart.</div>";
    }
    ?>
</div>

<?php include 'footer.php'; ?>

<?php
// Handle cart item removal
if (isset($_GET['remove'])) {
    $getcart_id = $_GET['remove'];
    $del = "DELETE FROM cart WHERE c_id='$getcart_id'";
    $delete = mysqli_query($conn, $del);

    if ($delete) {
        echo "<script>alert('Item removed successfully.'); window.location='cart.php';</script>";
    } else {
        echo "<script>alert('Error removing item.'); window.location='cart.php';</script>";
    }
}

// Handle updating cart quantity
if (isset($_POST['update'])) {
    $getqty_id = $_POST['qty'];
    $getp_id = $_POST['product_id'];

    if ($getqty_id >= 1 && $getqty_id <= 10) {  // Validate quantity range
        $qtyupdate = "UPDATE cart SET qty='$getqty_id' WHERE c_id='$getp_id'";
        $checkqtyupdate = mysqli_query($conn, $qtyupdate);

        if ($checkqtyupdate) {
            echo "<script>alert('Quantity updated successfully.'); window.location='cart.php';</script>";
        } else {
            echo "<script>alert('Failed to update quantity.'); window.location='cart.php';</script>";
        }
    } else {
        echo "<script>alert('Please enter a valid quantity (1-10).'); window.location='cart.php';</script>";
    }
}
?>