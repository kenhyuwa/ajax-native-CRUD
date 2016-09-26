<?php 
session_start();
if(!isset($_SESSION['user'])){
	header('location:login.php');
}
$method = $_GET['method'];

if($method == 'edit')
{
	include 'config.php';
	
	$id = $_GET['id'];
	$sql = "SELECT * FROM users WHERE id = $id";
	$query = mysqli_query($db,$sql);
	if($data = mysqli_fetch_assoc($query))
	{
		var_dump($data);
	}

}

 ?>