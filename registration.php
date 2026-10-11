<?php include 'conn.php'; ?> 
<?php include 'navbar.php'; ?> 
<body>
<div class="container-fluid" style="margin-top: 80px;">
<div class="row">
<div class="col-md-4"> </div>
<div class="col-md-4" style="background-color: rgba(236, 240, 241,0.9);">
          <br>

    <h4 style="text-align: center;"> Registration  </h4>
    
   <form method="POST" action="" enctype="multipart/form-data">
          
        <label style="font-size: 17px;"> Name </label>
        
        <input type="text" class="form-control" placeholder="Name "  name="name" required="required"> 

        
          <label style="font-size: 17px;"> Email</label>
        <input type="email"  class="form-control" placeholder="Email " name="email" required="required">

            <label style="font-size: 17px;">Password</label>
          <input type="password"  name="password"  class="form-control" placeholder="Password" required="required" >
          
            <label style="font-size: 17px;">Confirm Password </label>
          <input type="password" name="confirm"  class="form-control" placeholder="Confirm Password"  required="required"> <br>
          
          
<a href="#" style="text-decoration:none;" > 
  <input type="submit" class="form-control" name="submit" value="Register" style="background-color: #d35400; color: white;">
</a>
          <br>


          
          
           <div class="col-md-4"></div>

        </form>
        </div>
        </div>
    

          
  
    
  </div> 
 <br>

    
</body>
<?php include 'footer.php'; ?>

    <?php
 
  
  // If upload button is clicked ...

  if (isset($_POST['submit'])) {
  
    $name = $_POST["name"];
    
       $email= $_POST["email"];
        $password= $_POST["password"];
        $confirm = $_POST["confirm"];

      if ($password != $confirm) {
          echo  "<script>

          alert('Password or confirm Password are not Matched!');
          window.location.href='registration.php'
          </script>";
        }
        else{




        // Get all the submitted data from the form
        
 $rgt = "INSERT INTO registration (name,email,password,role) VALUES ('$name','$email','$password','User')";

        if (mysqli_query($conn ,$rgt)) {

          echo  "<script>

      window.location.href='registration.php'
      alert('Registration Successfully!');

</script>
   ";
        }            
    }

  }
?>
