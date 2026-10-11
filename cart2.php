<?php include 'conn.php';  ?>  
<?php
session_start();



// Check if the user is logged in
if (!isset($_SESSION['bemail'])) {
    // User is not logged in
    

       echo '<script >';
        echo 'alert(" Please log in to add  to the cart.!");';
        echo 'window.location.href="index.php"';
        echo '</script>';
} else {
    // User is logged in, check cart status
    $user_id = $_SESSION['bid'];
    $product_id =  $_GET['id7'];
  
     

    // Check if the product is already in the cart
    $check_query = "SELECT * FROM cart WHERE user_id='$user_id' AND p_id='$product_id'";



    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        // Product is already in the cart
       

       echo '<script >';
     echo 'alert("Already in the cart!");';
        echo 'window.location.href="index.php"';
        echo '</script>';


    } else {
          $qty='1';
        // Product is not in the cart, add it to the cart
        $insert_query  ="INSERT INTO cart (user_id,p_id,qty) VALUES (' $user_id',' $product_id','$qty')";

        $conn->query($insert_query);

        // Display a success message or perform any other necessary actions

     echo '<script >';
     echo 'alert("Added to the cart!");';   
      echo 'window.location.href="cart.php"';
        echo '</script>';


    }
}


?>
