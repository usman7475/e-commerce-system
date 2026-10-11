<?php include 'navbar.php'; ?>
<br>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

<div class="container-fluid">
  <div class="row">
    <!-- Category Sidebar -->
    <div class="col-md-2">
      <div class="category-sidebar">
        <h5><i class="fas fa-list"></i> Categories</h5>
        <ul class="category-list">
          <?php
          $fslt = "SELECT * from category ";
          $fcnm = mysqli_query($conn,$fslt);
          while ($row = mysqli_fetch_array($fcnm)) {
            $id = $row['id'];  
            $cname = $row['cname'];
            echo '<li>
            <a href="catergory.php?catergory='.$id.'">


            <i class="fas fa-chevron-right"></i> '.$cname.'</a></li>';
          }
          ?>
        </ul>
        
      
      </div>
    </div>
    
    <!-- Main Content -->
    <div class="col-md-10">
      <!-- Hero Carousel -->
      <div class="hero-section">
        <?php
        $get_slides = "SELECT * from slide";  
        $run_slides = mysqli_query($conn,$get_slides);
        while($row_slides=mysqli_fetch_array($run_slides)){
          $image[] = $row_slides['pic']; 
        }
        ?>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="admin/upload/<?php echo $image[0];?>" class="d-block w-100" alt="Delicious Desserts">
              <div class="hero-text">
                <h2>Electric Delights</h2>
                <p>Electronice products for all occasions</p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="admin/upload/<?php echo $image[1];?>" class="d-block w-100" alt="Seasonal Specials">
              <div class="hero-text">
                <h2>Seasonal Specials</h2>
                <p>Limited-time offerings featuring the best flavors of the season</p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="admin/upload/<?php echo $image[2];?>" class="d-block w-100" alt="Custom Cakes">
              <div class="hero-text">
                <h2>Grocies Delights</h2>
                <p>Groceries for all occasions</p>
              </div>
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      
      <!-- Special Offers Banner -->
      <div class="special-offers">
        <h3> Summer Specials!</h3>
        <p class="offer-text">Get 20% off all products in this summer season with code: SWEETSUMMER22</p>
        <a href="#" class="offer-btn">View Offers</a>
      </div>
      
      <!-- New Arrivals Section -->
      <div class="section-title">
        <h2>New Arrivals</h2>
      </div>
      
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
      
      <!-- Best Sellers Section -->
      <div class="section-title">
        <h2>Best Sellers</h2>
      </div>
      
      <div class="product-grid">
        <?php
        $fslt = "SELECT * from product ORDER BY RAND() LIMIT 3";
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





</body>
</html>