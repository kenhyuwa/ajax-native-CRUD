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
		<form id="form" action="act.php" method="POST" role="form"  onsubmit=" return confirm();">
			<legend><?php echo strtoupper('tambah data') ?></legend>
			
			<div class="form-group">
				<label for="">Nama :</label>
				<input type="text" class="form-control" name="nama" id="nama" placeholder="Input field">
			</div>
			<div class="form-group">
				<label for="">Alamat :</label>
				<input type="text" class="form-control" name="alamat" id="alamat" placeholder="Input field">
			</div>
			<div class="form-group">
				<label for="">Jenis Kelamin :</label>
				<select name="jk" id="jk" class="form-control" required="required">
					<option value="male">MALE</option>
					<option value="female">FEMALE</option>
				</select>
			</div>
			
			
			<button type="button" id="save" name="save" class="btn btn-primary">Submit</button>
		</form>
	</div>
</div>
<?php require_once 'templates/footer.php' ?>
<script>
	$(document).ready(function(){
		$('#save').click(function(){
			var act = $('#form').attr('action');
			var nama = $('#nama').val();
			var alamat = $('#alamat').val();
			var jk = $('#jk').val();
			var method = 'save';
			
			$.ajax({
				type:'POST',
				url :act,
				datatype:'json',
				data:{
					nama:nama,alamat:alamat,jk:jk,method:method
				},
				success:function(data)
				{
					if(data == '1')
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