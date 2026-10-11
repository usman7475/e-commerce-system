<?php
session_start();
include '../conn.php';

// Check if admin is logged in
if (!isset($_SESSION['bemail'])) {
    header('Location: index.php');
    exit;
}

if (!isset($_GET['id'])) {
    header('Location: users.php?error=User ID not provided');
    exit;
}

$user_id = $_GET['id'];

// Verify user exists
$check_query = "SELECT * FROM registration WHERE id = '$user_id'";
$result = mysqli_query($conn, $check_query);

if (mysqli_num_rows($result) == 0) {
    header('Location: users.php?error=User not found');
    exit;
}

// Prevent deleting the admin user (optional - adjust as needed)
$user = mysqli_fetch_array($result);
if ($user['role'] == 'admin') {
    header('Location: users.php?error=Cannot delete admin user');
    exit;
}

// Delete user
$delete_query = "DELETE FROM registration WHERE id = '$user_id'";

if (mysqli_query($conn, $delete_query)) {
    header('Location: users.php?success=User deleted successfully');
} else {
    header('Location: users.php?error=Error deleting user. Please try again.');
}
exit;
?>
