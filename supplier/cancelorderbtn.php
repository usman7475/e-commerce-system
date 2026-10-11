<?php include '../conn.php'; ?> 
<?php

            
              if (isset($_GET['id5'])){
            $e= $_GET['id5'];

 $accept="UPDATE orders SET status='Cancel' WHERE o_id= '$e'";
            $delet = mysqli_query($conn,$accept);

            echo '<script type="text/javascript">';
            echo 'alert("Order Cancel!");';
            echo 'window.location.href="order.php"';
            echo '</script>';
        }

      
