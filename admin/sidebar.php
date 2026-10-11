<?php session_start(); ?>
<?php
if (!isset($_SESSION['bemail'])) {         // condition Check: if session is not set. 
  header('location: index.php');   // if not set the user is sendback to login page.
}
?>
<?php include '../conn.php'; ?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PakBazar </title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        /* Custom CSS for responsive sidebar */
        @media (min-width: 768px) {
            .sidebar {
                position: fixed;
                top: 0;
                bottom: 0;
                left: 0;
                z-index: 1000;
                padding-top: 56px; /* Adjust this value based on your navbar height */
              
            }

            .sidebar-sticky {
               
                top: 56px; /* Adjust this value based on your navbar height */
                height: calc(100vh - 56px); /* Adjust this value based on your navbar height */
                overflow-x: hidden;
                overflow-y: auto; /* Scrollable sidebar */
            }
            a {
    color:  rgb(0,200,200);
    font-weight: bold;  
}
            a:hover {
                background-color: #dc3545;
    color:  rgb(0,200,200);
    font-weight: bold;  
}

            
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top" >
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
               
   <a class="navbar-brand" href="#">PakBazar</a>          

<div class="navbar-nav ml-auto">
    <a class="nav-link" style='font-size:20px;color:red;' href="logout.php">
        <i class="fas fa-power-off"></i> LogOut
    </a>
</div>


     </nav>
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse" id="sidebarCollapse" ><br><br>
                <div class="sidebar-sticky">
                  
                    <ul class="nav flex-column">
                        
      <li class="nav-item">
 <a class="nav-link active" href="home.php">
  <i class="fas fa-home"></i> Home
                            </a>
                        </li>
         <li class="nav-item">
 <a class="nav-link" href="category.php">
    <i class="fas fa-user"></i> Category
                            </a>
                        </li>
                        <li class="nav-item">
        <a class="nav-link" href="product.php">
    
    <i class="fas fa-user"></i> Product
                            </a>
                        </li>

     <li class="nav-item">
        <a class="nav-link" href="order.php">
    
    <i class="fas fa-user"></i> Orders
                            </a>
                        </li>

                         

      <li class="nav-item">
        <a class="nav-link" href="slide.php">
    
    <i class="fas fa-user"></i> Slide
                            </a>
                        </li>                 
                          
       <li class="nav-item">
        <a class="nav-link" href="users.php">
                                <i class="fas fa-user"></i> Users
                            </a>
                        </li>

       <li class="nav-item">
        <a class="nav-link" href="reviews.php">
                                <i class="fas fa-star"></i> Reviews
                            </a>
                        </li>
       

                                     
        
                       
                    </ul>
                </div>
            </nav>

            <!-- Main content area -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <!-- Your main content goes here -->
            </main>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js (Optional) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
