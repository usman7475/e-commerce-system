<?php
session_start();
include '../conn.php';

// Check if supplier is logged in
if (!isset($_SESSION['bemail'])) {
    header('Location: index.php');
    exit;
}

if (!isset($_GET['id'])) {
    header('Location: reviews.php?error=Review ID not provided');
    exit;
}

$review_id = $_GET['id'];
$supplier_id = $_SESSION['bid'];

// Verify review exists and belongs to supplier's product
$check_query = "SELECT r.* FROM reviews r
                INNER JOIN product p ON r.product_id = p.pid
                WHERE r.review_id = '$review_id' AND p.user_id = '$supplier_id'";
$result = mysqli_query($conn, $check_query);

if (mysqli_num_rows($result) == 0) {
    header('Location: reviews.php?error=Review not found or unauthorized');
    exit;
}

// Delete review
$delete_query = "DELETE FROM reviews WHERE review_id = '$review_id'";

if (mysqli_query($conn, $delete_query)) {
    header('Location: reviews.php?success=Review deleted successfully');
} else {
    header('Location: reviews.php?error=Error deleting review. Please try again.');
}
exit;
?>
