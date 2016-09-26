<?php 
session_start();
if(!isset($_SESSION['user'])){
	header('location:login.php');
}
$method = $_POST['method'];

if($method =='save')
{
	include 'config.php';

	$nama = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$jk = $_POST['jk'];
	$user = rand(11111,99999);
	$pass = password_hash($alamat,PASSWORD_BCRYPT);
	$sqli = "INSERT INTO users (nama,alamat,jk,username,password) VALUES ('$nama','$alamat','$jk','$user','$pass')";
	$queryli = mysqli_query($db,$sqli);
	if($queryli){
		echo '1';
	}else{
		echo '0';
	}
}	

if($method == 'update')
{
	include 'config.php';
	
	$id = $_POST['id'];
	$nama = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$jk = $_POST['jk'];
	$sql = "UPDATE users SET nama ='$nama', alamat = '$alamat', jk = '$jk' WHERE id = $id";
	$query = mysqli_query($db,$sql);
	if($query){
		echo 'true';
	}else{
		echo 'false';
	}
}

if($method == 'delete')
{
	include 'config.php';

	$id = $_POST['id'];
	$sql = "DELETE FROM users WHERE id = $id";
	$query = mysqli_query($db,$sql);
	if($query){
		echo 'true';
	}else{
		echo 'false';
	}
}
