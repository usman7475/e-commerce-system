<?php include '../conn.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Product Entry</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      background-color: #f5f6fa;
    }
    .form-section {
      margin-top: 60px;
      background-color: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }
    h4 {
      font-weight: bold;
      margin-bottom: 20px;
    }
    .table-section {
      margin-top: 60px;
    }
    .table img {
      width: 70px;
      height: 50px;
      object-fit: cover;
    }
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-2">
      <?php include 'sidebar.php'; ?>   
    </div>

    <div class="col-md-4">
      <br>
<br>

      <div class="form-section">
        <h4 class="text-center">Add Product Detail</h4>
        <form method="POST" enctype="multipart/form-data">

          <label>Name</label>
          <input type="text" class="form-control" name="name" placeholder="Product Name" required>

          <label class="mt-2">Category</label>
          <select name="category" class="form-control" required>
            <option value="">Select a Category</option>
            <?php
              $query = "SELECT * FROM category";
              $result = mysqli_query($conn, $query);
              while ($row = mysqli_fetch_array($result)) {
                echo "<option value='{$row['id']}'>{$row['cname']}</option>";
              }
            ?>
          </select>

          

          <label class="mt-2">Description</label>
          <textarea name="description" rows="4" class="form-control"></textarea>


          <label class="mt-2">Image</label>
          <input type="file" name="pic1" class="form-control" required>

          <label class="mt-2">Price</label>
          <input type="text" class="form-control" name="price" placeholder="Price" required>

          <input type="submit" name="submit" class="btn btn-success mt-3 btn-block" value="Submit">
        </form>
      </div>
    </div>

    <div class="col-md-6 table-section">
           <br>
<br>
      <h4 class="text-center">Your Product Detail</h4>
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
          <thead class="thead-dark">
            <tr>
              <th>#</th>
              <th>User ID</th>
              <th>Name</th>
              <th>Category</th>
           
              <th>Image</th>
              <th>Price</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $i = 0;
              $query = "SELECT * FROM product";
              $result = mysqli_query($conn, $query);
              while ($row = mysqli_fetch_array($result)) {
                $i++;
                $categoryId = $row['category'];
                $catQuery = "SELECT cname FROM category WHERE id='$categoryId'";
                $catResult = mysqli_query($conn, $catQuery);
                $catRow = mysqli_fetch_assoc($catResult);
                echo "<tr>
                        <td>{$i}</td>
                        <td>{$row['user_id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$catRow['cname']}</td>
                       
                        <td><img src='upload/{$row['pic01']}' alt='Image'></td>
                        <td>{$row['price']}</td>
                        <td><a href='editproduct.php?id={$row['pid']}' class='btn btn-sm btn-success'>Edit</a></td>
                        <td><a href='deletebtn.php?id={$row['pid']}' class='btn btn-sm btn-danger'>Delete</a></td>
                      </tr>";
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>

<!-- PHP Insert Logic -->
<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $category = $_POST['category'];
 
    $price = $_POST['price'];
      $description = $_POST['description'];
    $user_id = $_SESSION['bid'];
    $pic = $_FILES["pic1"]["name"];
    $tempname = $_FILES["pic1"]["tmp_name"];
    move_uploaded_file($tempname, "upload/" . $pic);

    $query = "INSERT INTO product (user_id,name, category, description,  pic01, price) 
              VALUES ('$user_id','$name', '$category', '$description',  '$pic', '$price')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Product added successfully!'); window.location.href='product.php';</script>";
    } else {
        echo "<script>alert('Error adding product');</script>";
    }
}
?>
</body>
</html>
