<?php include '../conn.php'; ?> 

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


