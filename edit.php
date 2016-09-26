<?php
session_start();
if(!isset($_SESSION['user'])){
	header('location:login.php');
}
require 'vendor/autoload.php';
$app = new TestController();

if(isset($_GET['edit'])){
	include 'config.php';
	
	$id = $_GET['id'];
	$sql = "SELECT * FROM users WHERE id = $id";
	$query = mysqli_query($db,$sql);
	$result = mysqli_fetch_assoc($query);
}
?>
<?php require_once 'templates/header.php' ?>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<form id="form" action="act.php" method="POST" role="form">
			<legend><?php echo strtoupper('edit data') ?></legend>
			<input type="hidden" id="id" name="id" value="<?php echo $result['id'] ?>">
			<div class="form-group">
				<label for="">Nama :</label>
				<input type="text" class="form-control" name="nama" id="nama" value="<?php echo $result['nama'] ?>" placeholder="Input field">
			</div>
			<div class="form-group">
				<label for="">Alamat :</label>
				<input type="text" class="form-control" name="alamat" id="alamat" value="<?php echo $result['alamat'] ?>" placeholder="Input field">
			</div>
			<div class="form-group">
				<label for="">Jenis Kelamin :</label>
				<select name="jk" id="jk" class="form-control" required="required">
					<?php
						if($result['jk'] == 'male'){
							echo '
								<option selected="selected" value="male">Male</option>
								<option value="female">Female</option>
							';
						}else{
							echo '
							<option value="male">Male</option>
							<option selected="selected" value="female">Female</option>
							';
						}
					?>
				</select>
			</div>
			
			
			<button type="button" id="update" class="btn btn-primary">Submit</button>
		</form>
	</div>
</div>
<?php require_once 'templates/footer.php' ?>
<script>
	$(document).ready(function(){
		$('#update').click(function(){
			var act = $('#form').attr('action');
			var nama = $('#nama').val();
			var alamat = $('#alamat').val();
			var jk = $('#jk').val();
			var id = $('#id').val();
			var method = 'update';
			
			$.ajax({
				type:'POST',
				url :act,
				datatype:'json',
				data:{
					nama:nama,alamat:alamat,jk:jk,method:method,id:id
				},
				success:function(data)
				{
					if(data == 'true')
					{
						//alert('data masuk');
						window.location ='index.php?success';
					}
					else
					{
						alert(data);
					}
				}
			});
		});
	});
</script>