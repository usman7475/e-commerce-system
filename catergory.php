<?php include 'navbar.php';  ?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
            <br>
            <br>
<!-- Search -->




  <div class="product-grid">
       
        <?php  
if(isset($_GET['catergory'])){ 
 $name=$_GET['catergory'];

$fslt ="SELECT * from product where category='$name' ";
        
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
        <?php }} ?>
      </div>
  </div>
    </div>
      </div>

<?php include 'footer.php';   ?>