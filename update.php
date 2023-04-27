<?php
  session_start();
  if((!isset($_SESSION['loggedin']))||($_SESSION['loggedin']!=true)){
    header("location:login.php");
    exit;
  }
?>
<html>
   <head>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
   </head>
<body>
	<?php
	error_reporting(E_ERROR | E_PARSE);
	include("partials/db_connect.php");
	$id=$_REQUEST['id'];
	$username=$_SESSION['username'];
	$sql="select * from $username where id=$id";
	$res=mysqli_query($conn,$sql);
	$row=mysqli_fetch_assoc($res);
	if(isset($_POST['update']))
	{
		$id=$_POST['id'];
		$title=$_POST['title'];
		$desc=$_POST['description'];
		
		$update="update $username set title='$title',descr='$desc' where id=$id";
		$res1=mysqli_query($conn,$update);
		if($res1){
			$_SESSION['update']=true;	
			header("location:welcome.php");
		}
		else
			echo "Row not updated";
	}
	else
	{
	?>
	<form action=" " method="POST">
	<input type="hidden" name="id" value="<?php echo $row['id'];?>">
	<div class="container my-4">
			<h2>Edit a Note from iNotes</h2>
			<div class="form-group">
				<label for="title" class="my-3">Note Title</label>
				<input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp"  value="<?php echo $row['title'];?>">
			</div>

			<div class="form-group">
				<label for="desc" class="my-2">Note Description</label>
				<textarea class="form-control " id="description" name="description" rows="3" ><?php echo $row['descr'];?></textarea>
			</div>
			<button type="submit" class="btn btn-primary my-3" name="update">Update Note</button>
   </div>
	<?php
	}
	?>
	</form>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
