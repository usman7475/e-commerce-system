<style>
    .btn {
        margin-left: 10px;
    }
    .img-fluid{
        height: 300px !important;
    } 
</style>

<?php include 'navbar.php'; ?>

<div class="container my-5">
<?php
if (isset($_GET['id8'])) {
    $product_id = $_GET['id8'];
    $query = "SELECT * FROM product WHERE pid='$product_id'";
    $run = mysqli_query($conn, $query);

    if ($run && mysqli_num_rows($run) > 0) {
        $row = mysqli_fetch_array($run);
        $name = $row['name'];
        
        $description = $row['description'];
        $pic = $row['pic01'];
        $price = $row['price'];
        
?>
    <div class="row shadow p-4 rounded bg-light">
        <!-- Left: Image -->
        <div class="col-md-5 text-center">
            <img src="admin/upload/<?php echo $pic; ?>" class="img-fluid rounded" alt="<?php echo $name; ?>">
        </div>

        <!-- Right: Product Info -->
        <div class="col-md-7">
            <h2 class="product-title"><?php echo $name; ?></h2>
            <div class="product-price">PKR <?php echo $price; ?></div>
            
            <p><strong>Description:</strong> <?php echo $description; ?></p>

            <div class="mt-4 d-flex gap-2">
                <a href='cart2.php?id7=<?php echo $product_id; ?>' class="btn btn-success btn-sm">
                    <i class="fa fa-cart-plus"></i> Add to Cart
                </a>
                <a href='index.php' class="btn btn-secondary btn-sm">
                    <i class="fa fa-arrow-left"></i> Back to Shop
                </a>
          
            </div>
        </div>
    </div>

    <!-- Reviews Section -->
    <div class="row mt-5">
        <div class="col-md-12">
            <h3 class="mb-4">Customer Reviews</h3>
            
            <!-- Add Review Form -->
            <?php
            if (isset($_SESSION['bid'])) {
                // Check if user has purchased this product
                $user_id = $_SESSION['bid'];
                $check_purchase = "SELECT * FROM orders WHERE u_id = '$user_id' AND p_id = '$product_id' AND status = 'delivered'";
                $purchase_result = mysqli_query($conn, $check_purchase);
                
                if (mysqli_num_rows($purchase_result) > 0) {
                    // Check if user already reviewed this product
                    $check_review = "SELECT * FROM reviews WHERE product_id = '$product_id' AND user_id = '$user_id'";
                    $review_result = mysqli_query($conn, $check_review);
                    
                    if (mysqli_num_rows($review_result) == 0) {
                        ?>
                        <div class="card mb-4 p-4">
                            <h5>Add Your Review</h5>
                            <form method="POST" action="add_review.php">
                                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                
                                <div class="form-group">
                                    <label for="rating">Rating</label>
                                    <select class="form-control" name="rating" id="rating" required>
                                        <option value="">Select Rating</option>
                                        <option value="5">⭐⭐⭐⭐⭐ Excellent</option>
                                        <option value="4">⭐⭐⭐⭐ Good</option>
                                        <option value="3">⭐⭐⭐ Average</option>
                                        <option value="2">⭐⭐ Poor</option>
                                        <option value="1">⭐ Very Poor</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="review_text">Your Review</label>
                                    <textarea class="form-control" name="review_text" id="review_text" rows="4" placeholder="Share your experience with this product..." required></textarea>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Submit Review</button>
                            </form>
                        </div>
                        <?php
                    } else {
                        echo '<div class="alert alert-info">You have already reviewed this product.</div>';
                    }
                } else {
                    echo '<div class="alert alert-warning">You can only review products you have purchased and received.</div>';
                }
            } else {
                echo '<div class="alert alert-info"><a href="login.php">Login</a> to add a review for this product.</div>';
            }
            ?>
            
            <!-- Display Reviews -->
            <div class="reviews-list">
                <?php
                $get_reviews = "SELECT r.*, reg.name FROM reviews r 
                                INNER JOIN registration reg ON r.user_id = reg.id 
                                WHERE r.product_id = '$product_id' 
                                ORDER BY r.created_at DESC";
                $reviews_result = mysqli_query($conn, $get_reviews);
                
                if (mysqli_num_rows($reviews_result) > 0) {
                    while ($review = mysqli_fetch_array($reviews_result)) {
                        $stars = str_repeat('⭐', $review['rating']);
                        ?>
                        <div class="card mb-3 p-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="mb-1"><?php echo htmlspecialchars($review['name']); ?></h6>
                                    <small class="text-muted"><?php echo date('F j, Y', strtotime($review['created_at'])); ?></small>
                                </div>
                                <div class="text-warning">
                                    <?php echo $stars; ?> (<?php echo $review['rating']; ?>/5)
                                </div>
                            </div>
                            <p class="mt-2 mb-0"><?php echo htmlspecialchars($review['review_text']); ?></p>
                        </div>
                        <?php
                    }
                } else {
                    echo '<p class="text-muted">No reviews yet. Be the first to review this product!</p>';
                }
                ?>
            </div>
        </div>
    </div>
<?php  


}}
?>
    
</div>





    <div class="name"> <center> New Arrival!</center></div>
   <div class="container">
       <div class="row">
           <div class="col-md-12">
        <br>
        <br>
<div class="product-grid">
        <?php
        $fslt = "SELECT * from product ORDER BY pid DESC LIMIT 15";
        $fcnm = mysqli_query($conn,$fslt);
        while ($fetch = mysqli_fetch_array($fcnm)) {
          $pid = $fetch['pid'];
          $pname = $fetch['name'];
          $ccategory = $fetch['category'];
          $pic01 = $fetch['pic01'];
          $price = $fetch['price'];
          
          $slt1 = "SELECT * from category where id='$ccategory'";
          $cnm1 = mysqli_query($conn,$slt1);
          $cfetch = mysqli_fetch_array($cnm1);
          $pcategory = $cfetch['cname'];
        ?>
        <div class="product-card">
          <a href='detail.php?id8=<?php echo $pid; ?>'>
            <img src="admin/upload/<?php echo $pic01;?>" class="product-img" alt="<?php echo $pname; ?>">

            <div class="product-info">
              <h3 class="product-title"><?php echo $pname; ?></h3>
              <span class="product-category"><?php echo $pcategory; ?></span>
              
              <div class="product-price">PKR <?php echo $price; ?></div>

              <a href='cart2.php?id7=<?php echo $pid; ?>' class="add-to-cart">Add to Cart</a>
            </div>
          </a>
        </div>
        <?php } ?>
      </div>
       </div>
   </div>
   </div>
<?php include 'footer.php'; ?>
<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>