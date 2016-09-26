<?php
session_start();
if(!isset($_SESSION['user'])){
	header('location:login.php');
}
require 'vendor/autoload.php';
$app = new TestController();

?>
<?php require_once 'templates/header.php' ?>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="table-responsive">
			<form class="navbar-form navbar-right" role="search" action="search.php" method="GET">
				<div class="form-group">
					<input type="text" name="search" class="form-control" placeholder="Search..." required>
				</div>
				<button type="submit" class="btn btn-default">Search</button>
			</form>
			<table class="table table-hover table-responsive table-bordered">
				<thead>
					<tr>
						<th><center>NO</center></th>
						<th><center>NAMA</center></th>
						<th><center>ALAMAT</center></th>
						<th><center>JENIS KELAMIN</center></th>
						<th>
							<center>
								<a href="form.php" class="btn btn-sm btn-primary">new</a>
							</center>
						</th>
					</tr>
				</thead>
				<tbody>
					<?php

					if(isset($_GET['search'])){
					include 'config.php';

					$search = $_GET['search'];
					$sql ="SELECT * FROM users WHERE nama  LIKE '$search%' OR nama = '$search' OR alamat LIKE '$search%'";
					$query = mysqli_query($db,$sql);
					if(mysqli_num_rows($query) < 1){
						echo '
						<div class="alert alert-info">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>Maaf !</strong> Tidak ada data yang cocok dengan pencarian.
						</div>
						';
					}else{
					$no = 1;
					while ($row = mysqli_fetch_assoc($query)) { ?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?php echo strtoupper($row['nama']); ?></td>
						<td><?php echo strtoupper($row['alamat']); ?></td>
						<td><?php echo strtoupper($row['jk']); ?></td>
						<td>
							<center>
							<a href="edit.php?edit&id=<?= $row['id']; ?>" class="btn btn-sm btn-info">edit</a>
							<a href="act.php?delete&id=<?= $row['id']; ?>" class="btn btn-sm btn-danger">delete</a>
							</center>
						</td>
					</tr>
					<?php } } } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php require_once 'templates/footer.php' ?>