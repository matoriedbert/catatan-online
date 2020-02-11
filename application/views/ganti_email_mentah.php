	<form method="POST" action="<?php echo base_url('user/proses_email'); ?>">
		<input type="text" name="email" value="<?php echo $tampil->email_user; ?>"> <br/>
		<input type="password" name="password" placeholder="Masukan Password Kamu"> <br/>
		<input type="submit" name="proses" value="Proses">
	</form>