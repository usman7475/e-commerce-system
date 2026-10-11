<?php
include 'navbar.php';
if (!isset($_SESSION['bemail'])) {
    header('location: index.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['bid'];
    $name = $_POST['name'];
    $password = $_POST['password'];

    if (empty($name) || empty($password)) {
        echo "<script>alert('Name and Password cannot be empty!');</script>";
    } else {
        $update_query = "UPDATE registration SET name='$name', password='$password' WHERE id='$user_id'";
        $result = mysqli_query($conn, $update_query);

        if ($result) {
            $_SESSION['bname'] = $name;
            $_SESSION['bpassword'] = $password;
            echo "<script>alert('Account details updated successfully!');</script>";
        } else {
            echo "<script>alert('Failed to update account details. Please try again!');</script>";
        }
    }
}
?>

<style>
    .section-title {
        font-size: 26px;
        font-weight: bold;
        color: #343a40;
        border-bottom: 2px solid #007bff;
        padding-bottom: 8px;
        margin-bottom: 25px;
        text-align: center;
    }

    .form-control:disabled {
        background-color: #e9ecef;
    }

    .badge-status {
        padding: 5px 10px;
        font-size: 14px;
        border-radius: 5px;
    }

    .badge-pending {
        background-color: #ffc107;
        color: #212529;
    }

    .badge-completed {
        background-color: #28a745;
        color: #fff;
    }

    .badge-cancelled {
        background-color: #dc3545;
        color: #fff;
    }

    .table th, .table td {
        vertical-align: middle;
        text-align: center;
    }

    .btn-update {
        background-color: #28a745;
        color: white;
        font-weight: bold;
        padding: 10px 25px;
        border: none;
        cursor: pointer;
        border-radius: 5px;
    }

    .btn-update:hover {
        background-color: #218838;
    }
</style>

<div class="container mt-5 mb-5">
    <!-- Account Details -->
    <div class="section-title"> Your Account Details</div>
    <form method="POST" action="myaccount.php">
        <table class="table table-bordered">
            <tr>
                <th>Name</th>
                <td><input type="text" class="form-control" name="name" value="<?php echo $_SESSION['bname']; ?>" required></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><input type="email" class="form-control" value="<?php echo $_SESSION['bemail']; ?>" disabled></td>
            </tr>
            <tr>
                <th>Password</th>
                <td><input type="password" class="form-control" name="password" value="<?php echo $_SESSION['bpassword']; ?>" required></td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit" class="btn-update">Update Account</button>
                </td>
            </tr>
        </table>
    </form>

    <!-- Orders Section -->
    <div class="section-title mt-5"> Your Orders</div>
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Invoice</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Total (Rs)</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $user_id = $_SESSION['bid'];
            $i = 0;
            $cstorder = "SELECT * FROM orders WHERE u_id='$user_id'";
            $run_price = mysqli_query($conn, $cstorder);

            while ($fetch = mysqli_fetch_array($run_price)) {
                $o_id = $fetch['o_id'];
                $invoice = $fetch['invoice'];
                $p2_id = $fetch['p_id'];
                $qty = $fetch['qty'];
                $total = $fetch['total'];
                $status = $fetch['status'];

                $slt4 = "SELECT * FROM product WHERE pid='$p2_id'";
                $cnm4 = mysqli_query($conn, $slt4);
                $cfetch4 = mysqli_fetch_array($cnm4);
                $proname = $cfetch4['name'];

                $i++;
                $badgeClass = 'badge-status badge-pending';
                if (strtolower($status) == 'completed') $badgeClass = 'badge-status badge-completed';
                elseif (strtolower($status) == 'cancelled') $badgeClass = 'badge-status badge-cancelled';
            ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $invoice; ?></td>
                    <td><?php echo $proname; ?></td>
                    <td><?php echo $qty; ?></td>
                    <td><?php echo $total; ?></td>
                    <td><span class="<?php echo $badgeClass; ?>"><?php echo ucfirst($status); ?></span></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>


   
</div>

<?php include 'footer.php'; ?>
