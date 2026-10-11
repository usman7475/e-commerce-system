<?php include '../conn.php'; ?>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2">
            <?php include 'sidebar.php'; ?>
        </div>

        <!-- Add Slide Form -->
        <div class="col-md-4">
          <br>
          <br>
            <div class="card mt-5 shadow-sm" style="background-color: rgba(236, 240, 241, 0.9);">
                <div class="card-header bg-primary text-white text-center">
                    <h5 class="mb-0">Add Your Slide</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="pic1" class="form-label" style="font-size: 17px;">Select Slide Picture</label>
                            <input type="file" name="pic1" id="pic1" class="form-control" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" name="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Slide Details Table -->
        <div class="col-md-6">
          <br>
          <br>
            <div class="card mt-5 shadow-sm">
                <div class="card-header bg-dark text-white text-center">
                    <h5 class="mb-0">Your Slide Details</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered align-middle text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Picture</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                $fslt = "SELECT * from slide";
                                $fcnm = mysqli_query($conn, $fslt);
                                while ($fetch = mysqli_fetch_array($fcnm)) {
                                    $pid = $fetch['id'];
                                    $ppic01 = $fetch['pic'];
                                    $i++;
                                ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><img style="width: 100px; height: 50px;" src="upload/<?= $ppic01; ?>" alt="Slide Picture"></td>
                                        <td>
                                            <a href="editslide.php?id=<?= $pid; ?>" class="btn btn-sm btn-success">Edit</a>
                                        </td>
                                        <td>
                                            <a href="deletebtn.php?ids=<?= $pid; ?>" onclick="return confirm('Are you sure you want to delete this slide?');" class="btn btn-sm btn-danger">Delete</a>
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

<!-- PHP Insert Logic -->
<?php
if (isset($_POST['submit'])) {
    $pic = $_FILES["pic1"]["name"];
    $tempname1 = $_FILES["pic1"]["tmp_name"];
    
    // Move the uploaded file to the 'upload' directory
    move_uploaded_file($tempname1, "upload/" . $pic);

    // Insert the data into the database
    $rgt = "INSERT INTO slide(pic) VALUES ('$pic')";

    if (mysqli_query($conn, $rgt)) {
        echo "<script>
            alert('Successfully uploaded your slide!');
            window.location.href='slide.php';
        </script>";
    }
}
?>
