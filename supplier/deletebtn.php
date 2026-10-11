<?php include '../conn.php'; ?> 
<?php

            
              if (isset($_GET['id'])){
            $e= $_GET['id'];

     $delete="DELETE FROM product WHERE pid = '$e'";
            $delet = mysqli_query($conn,$delete );

         if ($delet){
           echo "<script>
           alert('Data Deleted')
           </script>";
            echo "<script>
           window.open('product.php' ,'_self')
           </script>";
}
else
{
    echo "Error!";
}
 }
     ?>




