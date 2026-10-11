<?php
session_start();
include '../conn.php';

// Check if admin is logged in
if (!isset($_SESSION['bemail'])) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role'];

    // Validate input
    if (empty($name) || empty($email) || empty($password) || empty($confirm_password) || empty($role)) {
        header('Location: adduser.php?error=Please fill all fields');
        exit;
    }

    // Check password match
    if ($password != $confirm_password) {
        header('Location: adduser.php?error=Passwords do not match');
        exit;
    }

    // Check if email already exists
    $check_email = "SELECT * FROM registration WHERE email = '$email'";
    $result = mysqli_query($conn, $check_email);

    if (mysqli_num_rows($result) > 0) {
        header('Location: adduser.php?error=Email already exists');
        exit;
    }

    

    // Insert new user
    $email = mysqli_real_escape_string($conn, $email);
    $name = mysqli_real_escape_string($conn, $name);
    
    $insert_query = "INSERT INTO registration (name, email, password, role) 
                     VALUES ('$name', '$email', '$password', '$role')";

    if (mysqli_query($conn, $insert_query)) {
        header('Location: adduser.php?success=1');
    } else {
        header('Location: adduser.php?error=Error creating user. Please try again.');
    }
    exit;
}

header('Location: adduser.php');
?>
