<?php
  session_start();
  if((!isset($_SESSION['loggedin']))||($_SESSION['loggedin']!=true)){
    header("location:login.php");
    exit;
  }
?>
<?php
$insert=false;
	
?>
<!-----Insert data-------------->
<?php
require 'partials/db_connect.php';
if($_SERVER['REQUEST_METHOD']=="POST")
{
  if(isset($_POST['insert'])){
      $title=$_POST['title'];
      $desc=$_POST['description'];
      $username=$_SESSION['username'];
      $sql="INSERT INTO `$username` ( `title`, `descr`) VALUES ( '$title', '$desc')";
      $res=mysqli_query($conn,$sql);
      if($res){
        $insert=true;
      }
  }
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome <?php echo $_SESSION['username'];?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
  </head>
  <body>
    <?php
    require 'partials/_nav.php';
    if($insert){
      echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
      <strong>Success!</strong> Your note has been inserted successfully
      <button type='button' class='close float-right' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button>
    </div>";
    }
    //  if(isset($_SESSION['delete'])){
    //    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    //    <strong>Success!</strong> Your note has been deleted successfully
    //   <button type='button' class='close float-right' data-dismiss='alert' aria-label='Close'>
    //     <span aria-hidden='true'>&times;</span>
    //   </button>
    // </div>";
    
    // }
    // if(isset($_SESSION['update'])){
    //   echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    //   <strong>Success!</strong> Your note has been updated successfully
    //   <button type='button' class='close float-right' data-dismiss='alert' aria-label='Close'>
    //     <span aria-hidden='true'>&times;</span>
    //   </button>
    // </div>";
    // }
    
   //echo "welcome -".$_SESSION['username'];
    echo " <div class='container bg-primary'><center> <h2 class=' text-white'>WELCOME ".$_SESSION['username']."</h2></center></div>";
    ?>
    <div class="container my-4">
    <h2>Add a Note to iNotes</h2>
    <form action="" method="POST">
      <div class="form-group">
        <label for="title">Note Title</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
      </div>

      <div class="form-group">
        <label for="desc">Note Description</label>
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary my-3" name="insert">Add Note</button>
    </form>
  </div>
  

  
  <div class="container my-4">

    <h2 class="  bg-primary text-white"><center>Here is your Notes</center></h2>
    <table class="table my-2" id="myTable">
      <thead>
        <tr>
          <th scope="col">S.No</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $username=$_SESSION['username'];
          $sql = "SELECT * FROM `$username`";
          $result = mysqli_query($conn, $sql);
          $sno = 1;
          while($row = mysqli_fetch_assoc($result)){
            
            echo "<tr>
            <th scope='row'>". $sno . "</th>
            <td>". $row['title'] . "</td>
            <td>". $row['descr'] . "</td>";
            ?>
            <td> <a href='update.php?id=<?php echo $row['id'];?>' class='btn btn-primary'>Edit</a> <a href='delete.php?id=<?php echo $row['id'];?>' class='btn btn-primary'>Delete</a></td></tr>
          <?php
              $sno = $sno + 1;
        } 
        ?>  


      </tbody>
    </table>
  </div>
      
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>  </body>
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
          $('#myTable').DataTable();

        });
      </script>
</html>