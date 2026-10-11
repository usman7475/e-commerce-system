  <div class="container-fluid">
    <div class="row">

  <div class="col-md-2">
  <?php include 'sidebar.php' ?>   
</div>

 

  <div class="col-md-10" style="margin-top: 120px;" >
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 style="text-align: center; font-size: 24px; flex: 1;">Users Detail</h4>
    <a href="adduser.php" class="btn btn-success btn-md">
      <i class="fas fa-user-plus"></i> Add New User
    </a>
  </div>

  <!-- Display Messages -->
  <?php
  if (isset($_GET['success'])) {
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success!</strong> ' . htmlspecialchars($_GET['success']) . '
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>';
  }
  if (isset($_GET['error'])) {
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error!</strong> ' . htmlspecialchars($_GET['error']) . '
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>';
  }
  ?>

<div class="table-responsive">
<table class="table table-striped table-hover" >
  <thead class="bg-dark text-white">
    <tr>
      <th >#</th>
      <th>User ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Role</th>
      <th>Actions</th>
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
       $role= $row['role'];
       
       $i++;
?>                    
            <tr> 
               <td><?php echo $i; ?></td>      
               <td><?php echo $id; ?></td>
               <td><?php echo htmlspecialchars($name); ?></td>
               <td><?php echo htmlspecialchars($email); ?></td>
               <td>
                  <span class="badge <?php echo ($role == 'admin') ? 'badge-danger' : (($role == 'supplier') ? 'badge-info' : 'badge-primary'); ?>">
                    <?php echo ucfirst($role); ?>
                  </span>
               </td>
               <td>
                  <a href="edituser.php?id=<?php echo $id; ?>" class="btn btn-sm btn-primary">
                    <i class="fas fa-edit"></i> Edit Role
                  </a>
                  <a href="deleteuser.php?id=<?php echo $id; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">
                    <i class="fas fa-trash"></i> Delete
                  </a>
               </td>
            </tr>
   <?php } ?>
</tbody>
</table>
  </div>
    </div>
    </div>
    </div>
  
  

  <br>
  






  
  
  


