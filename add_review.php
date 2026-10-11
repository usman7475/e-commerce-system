<?php
include 'conn.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_SESSION['bid'])) {
        header('Location: login.php');
        exit;
    }

    $product_id = $_POST['product_id'];
    $user_id = $_SESSION['bid'];
    $rating = $_POST['rating'];
    $review_text = $_POST['review_text'];

    // Validate input
    if (empty($product_id) || empty($rating) || empty($review_text)) {
        header('Location: detail.php?id8=' . $product_id . '&error=Please fill all fields');
        exit;
    }

    // Verify user has purchased the product
    $check_purchase = "SELECT * FROM orders WHERE u_id = '$user_id' AND p_id = '$product_id' AND status = 'delivered'";
    $purchase_result = mysqli_query($conn, $check_purchase);

    if (mysqli_num_rows($purchase_result) == 0) {
        header('Location: detail.php?id8=' . $product_id . '&error=You can only review products you have purchased');
        exit;
    }

    // Check if already reviewed
    $check_review = "SELECT * FROM reviews WHERE product_id = '$product_id' AND user_id = '$user_id'";
    $review_result = mysqli_query($conn, $check_review);

    if (mysqli_num_rows($review_result) > 0) {
        header('Location: detail.php?id8=' . $product_id . '&error=You already reviewed this product');
        exit;
    }

    // Insert review
    $review_text = mysqli_real_escape_string($conn, $review_text);
    $insert_review = "INSERT INTO reviews (product_id, user_id, rating, review_text) 
                      VALUES ('$product_id', '$user_id', '$rating', '$review_text')";

    if (mysqli_query($conn, $insert_review)) {
        header('Location: detail.php?id8=' . $product_id . '&success=Review added successfully');
    } else {
        header('Location: detail.php?id8=' . $product_id . '&error=Error adding review');
    }
    exit;
}

header('Location: index.php');
?>
