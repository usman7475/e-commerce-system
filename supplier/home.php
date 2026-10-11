<?php include '../conn.php'; ?> 
<!DOCTYPE html>
<html lang="en">
<head>
<style>

    .g{
    font-family: 'Trocchi', serif;
   background-color: black;
    color: white;
    font-size: 20px;
     
    height: 50%;
    width: 100%;
    padding: 18px 20px;
  }

body{
background:;
font-family: 'Raleway', sans-serif;
}
.main-section{
width:100%;
margin:0 auto;
text-align: center;
padding: 0px 5px;
}
.dashbord{
width:32%;
display: inline-block;
background-color:#34495E;
color:#fff;
margin-top: 50px;
}
.icon-section i{
font-size: 30px;
padding:10px;
border:1px solid #fff;
border-radius:50%;
margin-top:-25px;
margin-bottom: 10px;
background-color:#34495E;
}
.icon-section p{
margin:0px;
font-size: 20px;
padding-bottom: 10px;
}
.detail-section{
background-color: #2F4254;
padding: 5px 0px;
}
.dashbord .detail-section:hover{
background-color: #5a5a5a;
cursor: pointer;
}
.detail-section a{
color:#fff;
text-decoration: none;
}
.dashbord-green .icon-section,.dashbord-green .icon-section i{
background-color: #16A085;
}
.dashbord-green .detail-section{
background-color: #149077;
}
.dashbord-orange .icon-section,.dashbord-orange .icon-section i{
background-color: #F39C12;
}
.dashbord-orange .detail-section{
background-color: #DA8C10;
}
.dashbord-blue .icon-section,.dashbord-blue .icon-section i{
background-color: #2980B9;
}
.dashbord-blue .detail-section{
background-color:#2573A6;
}
.dashbord-red .icon-section,.dashbord-red .icon-section i{
background-color:#E74C3C;
}
.dashbord-red .detail-section{
background-color:#CF4436;
}
.dashbord-skyblue .icon-section,.dashbord-skyblue .icon-section i{
background-color:#8E44AD;
}
.dashbord-skyblue .detail-section{
background-color:#803D9B;
}



</style>

</head>

<body>

    
        
<div class="container-fluid">
    <div class="row"> 
 
  <div class="col-md-2">
<?php include 'sidebar.php' ?>
    
    </div>
  <!-- Main content area -->
  <main role="main" class="col-md-10">
                <!-- Your main content goes here -->
<div>
 
     <br> <br>
     <br> <br>
<label style="font-size:23px;color:;"> <center> Welcome To Dashboard </center></label>


<div class="main-section">
<div class="dashbord">
<div class="icon-section">
<i class="fas fa-users"></i><br>

<small>Category</small>

<?php

$sql = "SELECT * from category";

if ($result = mysqli_query($conn, $sql)) {

    // Return the number of rows in result set
    $rowcount = mysqli_num_rows( $result );
}
   ?>

<p>
    
  <?php echo $rowcount; ?>
       </p>


 
</div>
<div class="detail-section">
<!-- <a href="category.php">More Info </a> -->
</div>


</div>
<div class="dashbord dashbord-green">
<div class="icon-section">
<i class="fas fa-book-reader"></i><br>
<small>Product</small>

<?php

$sql = "SELECT * from product";

if ($result = mysqli_query($conn, $sql)) {

    // Return the number of rows in result set
    $rowcount = mysqli_num_rows( $result );
}
   ?>

<p>
    
  <?php echo $rowcount; ?>
       </p>

</div>
<div class="detail-section">
<!-- <a href="product.php">More Info </a> -->
</div>
</div>



                </div>
               
          
 </main>
</div>
    
</div>
</div>    
</body>

</html>



  


