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


<?php

            
              if (isset($_GET['idc'])){
            $e= $_GET['idc'];

     $delete="DELETE FROM category WHERE id = '$e'";
            $delet = mysqli_query($conn,$delete );

         if ($delet){
           echo "<script>
           alert('Data Deleted')
           </script>";
            echo "<script>
           window.open('category.php' ,'_self')
           </script>";
}
else
{
    echo "Error!";
}
 }
     ?>


<?php

            
              if (isset($_GET['ids'])){
            $s= $_GET['ids'];

     $delete="DELETE FROM slide WHERE id = '$s'";
            $delet = mysqli_query($conn,$delete );

         if ($delet){
           echo "<script>
           alert('Data Deleted')
           </script>";
            echo "<script>
           window.open('slide.php' ,'_self')
           </script>";
}
else
{
    echo "Error!";
}
 }
     ?>