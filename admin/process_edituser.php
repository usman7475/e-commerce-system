<?php
session_start();
include '../conn.php';

// Check if admin is logged in
if (!isset($_SESSION['bemail'])) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $role = $_POST['role'];

    // Validate input
    if (empty($user_id) || empty($role)) {
        header('Location: edituser.php?id=' . $user_id . '&error=Please select a role');
        exit;
    }

    // Validate role
    $valid_roles = array('user', 'supplier', 'admin');
    if (!in_array($role, $valid_roles)) {
        header('Location: edituser.php?id=' . $user_id . '&error=Invalid role selected');
        exit;
    }

    // Update user role
    $update_query = "UPDATE registration SET role = '$role' WHERE id = '$user_id'";

    if (mysqli_query($conn, $update_query)) {
        header('Location: users.php?success=User role updated successfully');
    } else {
        header('Location: edituser.php?id=' . $user_id . '&error=Error updating role. Please try again.');
    }
    exit;
}

header('Location: users.php');
?>
