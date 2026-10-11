<?php include '../conn.php'; ?>

<?php
if (isset($_GET['id'])) {
    $edit_id = $_GET['id'];
    $eslt = "SELECT * FROM product WHERE pid='$edit_id'";
    $ecnm = mysqli_query($conn, $eslt);
    $xfetch = mysqli_fetch_array($ecnm);

    $pid = $xfetch['pid'];
    $pname = $xfetch['name'];
    $ccategory = $xfetch['category'];
 
    $pprice = $xfetch['price'];

     $pdescription = $xfetch['description'];
    $ppic01 = $xfetch['pic01'];

    $slt1 = "SELECT * FROM category WHERE id='$ccategory'";
    $cnm1 = mysqli_query($conn, $slt1);
    $cfetch = mysqli_fetch_array($cnm1);
    $pcategory = $cfetch['cname'];
}
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <?php include 'sidebar.php'; ?>
        </div>

        <div class="col-md-4">
            <div style="margin-top: 80px; background-color: rgba(236, 240, 241, 0.9); padding: 20px; border-radius: 10px;">
                <h4 style="text-align: center; font-size: 20px;">Please Update Your Product Detail</h4>
                <form method="POST" enctype="multipart/form-data">

                    <label style="font-size: 17px;">Name</label>
                    <input type="text" value="<?php echo $pname; ?>" class="form-control" name="name" required><br>

                    <label style="font-size: 17px;">Category</label>
                    <select name="category" class="form-control">
                        <option selected value="<?php echo $ccategory; ?>"><?php echo $pcategory; ?> (Current)</option>
                        <option value="">-- Select New Category (Optional) --</option>
                        <?php
                        $slt = "SELECT * FROM category";
                        $cnm = mysqli_query($conn, $slt);
                        while ($yfetch = mysqli_fetch_array($cnm)) {
                            $c_id = $yfetch['id'];
                            $yname = $yfetch['cname'];
                            echo "<option value='$c_id'>$yname</option>";
                        }
                        ?>
                    </select><br>

                   



                    <label class="mt-2">Description</label>
          <textarea name="description" rows="4" class="form-control"><?php echo $pdescription; ?>  </textarea>


                    <label style="font-size: 17px;">Image</label>
                    <input type="file" name="pic1" class="form-control"><br>
                    <img src="../admin/upload/<?php echo $ppic01; ?>" style="width: 100%; height: 150px; object-fit: cover; border: 1px solid #ccc;"><br><br>

                    <label style="font-size: 17px;">Price</label>
                    <input type="text" value="<?php echo $pprice; ?>" class="form-control" name="price" required><br>

                    <input type="submit" class="btn btn-success w-100" name="submit" value="Update Product">
                </form>
            </div>
        </div>

        <div class="col-md-6" style="margin-top: 80px;">
            <h4 style="text-align: center; font-size: 20px;">Your Product List</h4><br>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Category</th>
                          
                            <th>Pic</th>
                            <th>Price</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $fslt = "SELECT * FROM product";
                        $fcnm = mysqli_query($conn, $fslt);
                        while ($fetch = mysqli_fetch_array($fcnm)) {
                            $pid = $fetch['pid'];
                            $pname = $fetch['name'];
                            $ccategory = $fetch['category'];
                            
                            $ppic01 = $fetch['pic01'];
                            $price = $fetch['price'];

                            $slt1 = "SELECT * FROM category WHERE id='$ccategory'";
                            $cnm1 = mysqli_query($conn, $slt1);
                            $cfetch = mysqli_fetch_array($cnm1);
                            $pcategory = $cfetch['cname'];
                            $i++;
                        ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $pname; ?></td>
                                <td><?php echo $pcategory; ?></td>
                               
                               
                                <td><img src="../admin/upload/<?php echo $ppic01; ?>" style="height: 50px; width: 100px;"></td>
                                <td><?php echo $price; ?></td>
                                <td><a href="editproduct.php?id=<?php echo $pid; ?>" class="btn btn-primary btn-sm">Edit</a></td>
                                <td><a href="deletebtn.php?id=<?php echo $pid; ?>" class="btn btn-danger btn-sm">Delete</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST['submit'])) {
    $name = $_POST["name"];
    $model = $_POST["model"];
    $uprice = $_POST["price"];
    $udescription = $_POST["description"];

    $category = trim($_POST["category"]);
    if ($category == "") {
        $category = $ccategory;
    }

    // Image check
    if (!empty($_FILES["pic1"]["name"])) {
        $pic = $_FILES["pic1"]["name"];
        $tempname1 = $_FILES["pic1"]["tmp_name"];
        move_uploaded_file($tempname1, "../admin/upload/" . $pic);
    } else {
        $pic = $ppic01;
    }

    $rgt = "UPDATE product SET 
            name='$name',
            category='$category',
            
            price='$uprice',
           
              description='$udescription',
           
            pic01='$pic' 
            WHERE pid='$edit_id'";

    if (mysqli_query($conn, $rgt)) {
        echo "<script>
            alert('Product updated successfully!');
            window.location.href='product.php';
        </script>";
    } else {
        echo "<script>alert('Error while updating!');</script>";
    }
}
?>
