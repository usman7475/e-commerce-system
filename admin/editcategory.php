<?php include '../conn.php'; ?>

<?php
// Get the category ID from the URL
if (isset($_GET['id'])) {
    $edit_id = $_GET['id'];
    $get_query = "SELECT * FROM category WHERE id = '$edit_id'";
    $result = mysqli_query($conn, $get_query);
    $data = mysqli_fetch_assoc($result);
    $old_name = $data['cname'];
} else {
    echo "<script>window.location.href='category.php';</script>";
}
?>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2">
            <?php include 'sidebar.php'; ?>
        </div>

        <!-- Edit Category Form -->
        <div class="col-md-4">
            <br><br>
            <div class="card mt-5 shadow-sm">
                <div class="card-header bg-warning text-white text-center">
                    <h5 class="mb-0">Edit Category</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Category Name</label>
                            <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($old_name); ?>" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" name="update" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Category List -->
        <div class="col-md-6">
            <br><br>
            <div class="card mt-5 shadow-sm">
                <div class="card-header bg-dark text-white text-center">
                    <h5 class="mb-0">Category List</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Category</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                $fslt = "SELECT * FROM category";
                                $fcnm = mysqli_query($conn, $fslt);
                                while ($fetch = mysqli_fetch_array($fcnm)) {
                                    $cid = $fetch['id'];
                                    $cname = $fetch['cname'];
                                    $i++;
                                ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= htmlspecialchars($cname); ?></td>
                                        <td>
                                            <a href="editcategory.php?id=<?= $cid; ?>" class="btn btn-sm btn-success">Edit</a>
                                        </td>
                                        <td>
                                            <a href="deletebtn.php?idc=<?= $cid; ?>" onclick="return confirm('Are you sure you want to delete this category?');" class="btn btn-sm btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div> <!-- table-responsive -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- PHP Update Logic -->
<?php
if (isset($_POST['update'])) {
    $new_name = mysqli_real_escape_string($conn, $_POST["name"]);
    $update_query = "UPDATE category SET cname = '$new_name' WHERE id = '$edit_id'";

    if (mysqli_query($conn, $update_query)) {
        echo "<script>
            alert('Category Updated Successfully!');
            window.location.href='category.php';
        </script>";
    } else {
        echo "<script>alert('Update failed. Try again!');</script>";
    }
}
?>
