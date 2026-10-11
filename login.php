<?php 
include 'navbar.php'; 
include 'conn.php'; 
?>

<body>

<div class="container" style="margin-top: 40px;">
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4" style="background-color: rgba(236, 240, 241,0.0);">
        <br>
        <h4 style="text-align: center;">Login</h4>

        <form method="POST" action="" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <label style="font-size: 17px;">Email:</label>
                    <input type="email" class="form-control" placeholder="Email" required name="email" >
                </div>
            </div><br>

            <div class="row">
                <div class="col-md-12">
                    <label style="font-size: 17px;">Password:</label>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
            </div><br>

            <input type="submit" name="submit" class="form-control" value="LOGIN" style="background-color:#d35400; color:white;">
            <br><br><br>
        </form>

    </div>
    <div class="col-md-4"></div> 
</div> <!-- end of row -->
</div> <!-- end of container -->

<?php include 'footer.php'; ?>

<!-- PHP Code for Login -->
<?php
if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM registration WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        $_SESSION['bid'] = $row['id'];
        $_SESSION['bname'] = $row['name'];
        $_SESSION['bemail'] = $row['email'];
        $_SESSION['bpassword'] = $row['password'];

        if ($row['role'] == 'Admin') {
            echo '<script>window.location.href="admin/home.php";</script>';
        } else if ($row['role'] == 'User') {
            echo '<script>window.location.href="index.php";</script>';
        } else if ($row['role'] == 'Supplier') {
            echo '<script>window.location.href="supplier/home.php";</script>';
        } else {
            echo '<script>alert("Invalid Role Detected!"); window.location.href="login.php";</script>';
        }

    } else {
        echo '<script>alert("Incorrect Email or Password!"); window.location.href="login.php";</script>';
    }
}
?>
