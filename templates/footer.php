</div>
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script>
	function confirm(){
		var nama = $('#nama').val();
		var alamat = $('#alamat').val();
		if(nama ==''){
			alert('Nama tidak boleh kosong');
			return false;
		}
		if(alamat ==''){
			alert('Alamat tidak boleh kosong');
			return false;
		}
	}
</script>
</body>
</html>