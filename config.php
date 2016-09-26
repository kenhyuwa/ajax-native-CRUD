<?php
	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$dbname = 'crud';
	
	$db = mysqli_connect($host,$user,$pass,$dbname);
?>
<?php 
if(isset($_GET['logout']))
{
	session_start();
	session_destroy();
	header('location:login.php');
}
 ?>