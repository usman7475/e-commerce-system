<?php include 'conn.php';  ?>

<?php
session_start();
?> <!-- session is used for storing data -->
<!DOCTYPE html>
<html lang="en">
<head>
  <title>PakBazar</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <!-- Bootstrap CDN -->
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<!-- Font Awesome CDN -->
  <script src="https://kit.fontawesome.com/8a2bdd4e42.js" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="style.css" />

</head>
<style>
  
</style>
<body>


<nav class="navbar navbar-expand-lg navbar-light bg-light">

  <a class="navbar-brand" id="navbartitle" href="index.php">PakBazar</a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home </a>
      </li>  
  <li class="nav-item">
  <a class="nav-link" href="product.php">Products</a>
      </li>  

  


 <li class="nav-item">
  <a class="nav-link" href="cart.php">
    <i class="fa-solid fa-cart-shopping"></i>  Cart</a>
      </li>
     <li class="nav-item">
      <?php

     if(!isset($_SESSION['bemail'])){
        
  echo"
 <a class='nav-link d' href='registration.php'>Registration</a>

  <a class='nav-link d' href='login.php'style='text-decoration: none; '>

      <i class='fa-solid fa-right-to-bracket'></i>
         Login</a>
       
     ";

     }else {
        echo"
<a class='nav-link d' href='myaccount.php'style='text-decoration: none;' >

          My Account</a>
        <a class='nav-link d' href='logout.php'style='text-decoration: none;' >
        
 <i class='fa-solid fa-right-to-bracket'></i> Logout</a>";
      } 
  ?>
      </li>


 

    

    </ul>

    <form class="form-inline my-2 my-lg-0" method="get" action="product.php" > 

      <input class="form-control mr-sm-2" type="search" placeholder="Search" name="search" aria-label="Search" required>
      
      <button class="btn btn submit my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>