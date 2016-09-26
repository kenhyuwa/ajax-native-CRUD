<?php
session_start();
if(isset($_SESSION['user'])){
	header('location:index.php');
}
require 'vendor/autoload.php';
$app = new TestController();

?>
<?php require_once 'templates/header.php' ?>
<center>
	<form action="" method="POST" role="form">
		<legend>Form title</legend>
	
		<div class="form-group">
			<label for="">label</label>
			<input type="text" class="form-control" name="username" placeholder="Input field">
		</div>
	
		<div class="form-group">
			<label for="">label</label>
			<input type="password" class="form-control" name="password" placeholder="Input field">
		</div>
	
		
	
		<button type="submit" name="submit" class="btn btn-primary">Submit</button>
	</form>
</center>
<?php require_once 'templates/footer.php' ?>
<?php 

if(isset($_POST['submit']))
{
	include 'config.php';
	$user = $_POST['username'];
	$password = $_POST['password'];
	$sql = "SELECT * FROM users WHERE username = '$user'";
	$query = mysqli_query($db, $sql);
	if(mysqli_num_rows($query))
	{
		$rows = mysqli_fetch_assoc($query);
		$cekpass = $rows['password'];
		if(password_verify($password,$cekpass)){
			mysqli_query($db,"UPDATE users SET last_login = NOW() WHERE id = '$rows[id]'");
			session_start();
			$_SESSION['user'] = $rows['nama'];
			header('location:index.php');
		}else{
			header('location:login.php');
		}
	}else{
		mysqli_error($db);
	}

}
