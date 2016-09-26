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
<form id="myform" action="#" method="POST" role="form">
<div class="modal fade" id="modal-id">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
				<label for="">Nama :</label>
					<input type="text" class="form-control" name="name" placeholder="Input field">
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
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>
</form>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<?php
		if(isset($_GET['success']))
		{
			echo '
		<div class="alert alert-info">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Success !</strong> Data berhasil disimpan.
		</div>
			';
		}
		if(isset($_GET['deleted']))
		{
			echo '
		<div class="alert alert-info">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Success !</strong> Hapus data berhasil.
		</div>
			';
		}
		?>
		<div id="message" class="alert-block" style="display: none">
	        <center>
	        	<strong id="info" class="blue"></strong>
	        </center>
	    </div>
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
						<th><center>USERNAME</center></th>
						<th><center>LAST LOGIN</center></th>
						<th>
							<center>
								<a href="form.php" class="btn btn-sm btn-primary">new</a>
							</center>
						</th>
					</tr>
				</thead>
				<tbody>
					<?php
					include 'config.php';

					$sql ="SELECT * FROM users";
					$query = mysqli_query($db,$sql);
					$no = 1;
					while ($row = mysqli_fetch_assoc($query)) { ?>
					<tr data-id="<?= $row['id']; ?>">
						<td><?= $no++ ?></td>
						<td><?php echo strtoupper($row['nama']); ?></td>
						<td><?php echo strtoupper($row['alamat']); ?></td>
						<td><?php echo strtoupper($row['jk']); ?></td>
						<td><?php echo strtoupper($row['username']); ?></td>
						<td><?php echo strtoupper($row['last_login']); ?></td>
						<td>
							<center>
							<button type="button" onclick="edit(<?= $row['id']; ?>)" class="btn btn-sm btn-success">ajax</button>
							<a href="edit.php?edit&id=<?= $row['id']; ?>" class="btn btn-sm btn-info">edit</a>
							<button type="button" id="hapus" data-id="<?= $row['id']; ?>" class="btn btn-sm btn-danger">delete</button>
							</center>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<?php
		// for ($a=0; $a <=3 ; $a++) {
		// 		for ($i=$a; $i >=0 ; $i--) {
		// 			echo '<b>*</b>';
		// 		}
		// 			echo '<br/>';
		// 	}
		// for ($a=0; $a <=2 ; $a++) {
		// 		for ($i=$a; $i <=2 ; $i++) {
		// 			echo '<b>*</b>';
		// 		}
		// 			echo '<br/>';
		// 	}
		
		?>
	</div>
</div>
<?php require_once 'templates/footer.php' ?>
<script>
	$(document).on('click', '#hapus', function(){
		var act = 'act.php';
		var id = $(this).attr('data-id');
		var method = 'delete';
		
		$.ajax({
			type:'POST',
			url :act,
			datatype:'json',
			data:{
				method:method,id:id
			},
			success:function(data)
			{
				if(data == 'true')
				{
					$("tr[data-id='"+id+"']").fadeOut("fast", function()
					{
                       $(this).remove();
                    });
                    $('#message').addClass('alert alert-info').fadeIn(2000, function(){
		                $(this).hide();
		            });
		            $('#info').text('Data berhasil dihapus !');
				}
				else
				{
					alert(data);
				}
			}
		});
	});

	function edit(id)
	{
		var act = 'edt.php';
		var method = 'edit';
		
		$.ajax({
			type:'GET',
			url:act,
			datatype:'JSON',
			data:{
				id:id,method:method
			},
			success:function(data)
			{
				console.log(data);
				$('[name="name"]').val(data[0].nama);
				$('[name="alamat"]').val(data.alamat);
				$('#jk').val(data[0].jk);
				$('#modal-id').modal('show');
				$('.modal-title').text(data.nama);
				
			}
		});
	}

	// $(document).on('click','#ajax',function(){
	// 	var id = $(this).attr('data-id');
	// 	var act = 'edt.php';
	// 	var method = 'edit';
		
	// 	$.ajax({
	// 		type:'GET',
	// 		url:act,
	// 		datatype:'JSON',
	// 		data:{
	// 			id:id,method:method
	// 		},
	// 		success:function(data)
	// 		{
	// 			console.log(data);
	// 			$('[name="name"]').val(data.nama);
	// 			$('#modal-id').modal('show');
	// 			$('.modal-title').text(data.nama);
				
	// 		}
	// 	});
	// });
</script>