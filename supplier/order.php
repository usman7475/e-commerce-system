<?php include '../conn.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Order Management</title>
  
  <style>
    body {
      background-color: #f8f9fa;
    }
    .table-container {
      margin-top: 80px;
     
      background: white;
      border-radius: 15px;
      box-shadow: 0px 0px 15px rgba(0,0,0,0.1);
    }
    .table thead {
      background-color: #343a40;
      color: white;
    }
    .action-buttons input {
      margin-bottom: 5px;
      width: 100%;
    }
   
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row">
    
    <div class="col-md-2 ">
     <?php include 'sidebar.php'; ?>
    </div>

    <div class="col-md-10">
      <div class="table-container">
        <h4 class="mb-4">All Orders</h4>
        <div class="table-responsive">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Invoice</th>
                <th>User ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i = 0;
              $slt = "SELECT * FROM orders";
              $cnm = mysqli_query($conn, $slt);
              while ($fetch = mysqli_fetch_array($cnm)) {
                $i++;
                $o_id = $fetch['o_id'];
                $u_id = $fetch['u_id'];
                $invoice = $fetch['invoice'];
                $name = $fetch['name'];
                $address = $fetch['address'];
                $phone = $fetch['phone'];
                $p2_id = $fetch['p_id'];
                $qty = $fetch['qty'];
                $total = $fetch['total'];
                $status = $fetch['status'];

                // Get product name
                $product_query = "SELECT name FROM product WHERE pid='$p2_id'";
                $product_result = mysqli_query($conn, $product_query);
                $product = mysqli_fetch_array($product_result);
                $proname = $product['name'];
              ?>
              <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $invoice; ?></td>
                <td><?php echo $u_id; ?></td>
                <td><?php echo $name; ?></td>
                <td><?php echo $address; ?></td>
                <td><?php echo $phone; ?></td>
                <td><?php echo $proname; ?></td>
                <td><?php echo $qty; ?></td>
                <td><?php echo $total; ?></td>
                <td>
                  <span class="badge bg-<?php 
                    if($status == 'Pending') echo 'primary';
                    elseif($status == 'Dispatched') echo 'success';
                    elseif($status == 'Cancelled') echo 'danger';
                    elseif($status == 'Delivered') echo 'warning';
                    else echo 'info';
                  ?>"><?php echo $status; ?></span>
                </td>
                <td class="action-buttons">
                  <a href="approveorderbtn.php?id5=<?php echo $o_id; ?>">
                    <input type="button" value="Dispatch" class="btn btn-success btn-sm">
                  </a>
                  <a href="cancelorderbtn.php?id5=<?php echo $o_id; ?>">
                    <input type="button" value="Cancel" class="btn btn-danger btn-sm">
                  </a>
                  <a href="deliveredorderbtn.php?id5=<?php echo $o_id; ?>">
                    <input type="button" value="Delivered" class="btn btn-warning btn-sm">
                  </a>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
