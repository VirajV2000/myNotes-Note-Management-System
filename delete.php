<?php
  session_start();
  if((!isset($_SESSION['loggedin']))||($_SESSION['loggedin']!=true)){
    header("location:login.php");
    exit;
  }
?>

<?php
include("partials/db_connect.php");
$username=$_SESSION['username'];
$id=$_REQUEST['id'];
$sql="Delete from $username where id=$id";
$res=mysqli_query($conn,$sql);
if($res){
    $_SESSION['delete']=true;	
    header("location:welcome.php");
}
else
	echo "Row Not Deleted";
?>
