
	<form method="POST" action="<?php echo base_url('user/proses_foto'); ?>" enctype="multipart/form-data">
		<input type="file" name="foto" value="<?php echo $tampil->foto_user; ?>"> <br/>
		<input type="submit" name="proses" value="Proses">
	</form>