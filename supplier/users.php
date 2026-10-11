  <div class="container-fluid">
    <div class="row">

  <div class="col-md-2">
  <?php include 'sidebar.php' ?>   
</div>

 

  <div class="col-md-10" style="margin-top: 120px;" >
  <h4  style="text-align: center;font-size: 20px;"> Users Detail</h4> <br> 
<div class="table-responsive">
<table class="table table-striped" >
  <thead>
    <tr>
      <th >#</th>
 <th>User ID</th>
       <th>Name</th>
         <th>Email</th>
      
         

    </tr>
  </thead>
  <tbody>                                     
<?php
$i=0;

$fslt ="SELECT * from registration ";
   $fcnm=mysqli_query($conn,$fslt);
   while ($row= mysqli_fetch_array($fcnm)) {
       $id=$row['id'];  
      $name= $row['name'];
     
     $email = $row['email'];
      
 
     
    
    
     $i++;
?>                    
            <tr> 
               
      <td> <?php   echo  $i;    ?></td>      
    <td><?php echo $id; ?></td>
      <td> <?php   echo $name;    ?></td>
      <td> <?php   echo $email;    ?></td>



       </tr>
   <?php    }
   ?>
</tbody>
</table>
  </div>
    </div>
    </div>
    </div>
  
  

  <br>
  






  
  
  


