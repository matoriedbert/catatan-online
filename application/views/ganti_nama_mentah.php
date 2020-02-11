	<form method="POST" action="<?php echo base_url('user/proses_nama'); ?>">
		<input type="text" name="nama" value="<?php echo $tampil->nama_user; ?>"> <br/>
		<input type="submit" name="proses" value="Proses">
	</form>