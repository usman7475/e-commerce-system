<?php include 'navbar.php';  ?>



       <!-- Search Results -->
            <?php  
            if(isset($_GET['search'])) { 
                $name = $_GET['search'];
                $result = mysqli_query($conn, "SELECT * FROM product WHERE name LIKE '%{$name}%'");
                $sql2 = mysqli_num_rows($result);
                
                if (!$sql2 > 0) {     
                    echo "<div style='padding:5px; margin:20px 0; background:#fff3cd; border-radius:5px; text-align:center;'><h5 style='color:#856404;'>No Products Found!</h5></div>";
                } else {
       
        while ($fetch = mysqli_fetch_array( $result)) {
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

<div class="container">
    <div class="row">
        <div class="col-md-12">
<!-- New Arrivals Section -->
     <br>
        
      
      <div class="product-grid">
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
        <?php }}} ?>
      </div>
      

  </div>
</div>
</div>








<div class="container">
	<div class="row">
		<div class="col-md-12">
<!-- New Arrivals Section -->
      <div class="section-title">
        <h2>New Arrivals</h2>
      </div>
      
      <div class="product-grid">
        <?php
        $fslt = "SELECT * from product ORDER BY pid DESC ";
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

<?php include 'footer.php';   ?>