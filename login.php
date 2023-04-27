<?php
  if($_SERVER['REQUEST_METHOD']=='POST'){
    include 'partials/db_connect.php';
    $username=$_POST['username'];
    $password=$_POST['password'];
   
    $Login=false;
    $showError=false;
    
   
      //$sql="Select * from users where username='$username'AND password='$password'";
      $sql="Select * from users where username='$username'";
      $result=mysqli_query($conn,$sql);
      $num=mysqli_num_rows($result);
      if($num==1)
      {
        while($row=mysqli_fetch_assoc($result)){
          if (password_verify($password, $row['password'])){
            $Login=true;
            session_start();
            $_SESSION['loggedin']=true;
            $_SESSION['username']=$username;
          
            
              header("location:welcome.php");
         
          }
          else{
            $showError="Invalid credentials";
          }
        }
        
      }
    
    else{
        $showError="Invalid credentials";
    }
  }

  
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>
  <body>
    <?php
    require 'partials/_nav.php';
    ?>
    <?php
      //$showAlert=false;
      global $Login,$showError;
      if($Login){
         echo  '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success</strong> Your are logged in.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
      }
      if($showError){
        echo  '<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong></strong>' .$showError.'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>';
     }
    ?>
    
    <div class="container">
        <h1 class="text-center my-5 ">Login to our website</h1>
        <form  method="POST">
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" aria-describedby="emailHelp" name="username">
              
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password">
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>  </body>
</html>