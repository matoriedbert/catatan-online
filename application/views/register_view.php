<?php
		$nama_seo_user = get_cookie('nama_seo_user');
		$nama_user = get_cookie('nama_user');
			$where = array(
			'id_user' => get_cookie('id_user'),
			'key_user' => get_cookie('key_user')
			);
			 $cek = $this->M_user->cek_cookie("user",$where);
			 if($cek->num_rows() > 0){
			 	echo "<a href='/'>Home </a>";
				echo "<a href= ".site_url('catatan/upload')." >Upload </a>";
				echo "<a href=".site_url('profile/'.$nama_seo_user)." >$nama_user </a>";
				echo "<a href= ".site_url('user/logout')." >Logout </a>";
			 	//echo "anda berhasil login";
			 }else{
			 	echo "<a href='/'>Home </a>";
				echo "<a href=".site_url('user/login')." >Login</a>";
			 	//echo "id_user tidak sama dengan key";
			 }
?>
<!-- REGISTER -->

    <section id="register" class="mb-5">
        
        <!-- HEADER REGISTER -->
        <div class="row mx-4">
            <div class="col text-center">
                <h3>REGISTER</h3>
            </div>
        </div>
        
        <!-- FORM REGISTER -->
        <div class="row justify-content-center">
            <div class="col-md-4 mx-4">
                <form class="login-page" action="<?php echo base_url()?>user/proses_register" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama</label>
                        <input type="text" class="form-control" name="nama" placeholder="Nama" value="<?php echo $this->session->flashdata('temporary_nama'); ?>">
                        <small id="emailHelp" class="form-text text-danger"><?php echo $this->session->flashdata('error_nama'); ?></small>
                    </div>
                                        <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $this->session->flashdata('temporary_email'); ?>" >
                        <small id="email" class="form-text text-danger"><?php echo $this->session->flashdata('error_email'); ?> <?php echo $this->session->flashdata('error_cekdata'); ?></small>
                    </div>                    <div class="form-group">
                        <label for="exampleInputEmail1">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <small id="emailHelp" class="form-text text-danger"><?php echo $this->session->flashdata('error_password'); ?></small>
                    </div>                    <div class="form-group">
                        <label for="exampleInputEmail1">Konfirmasi Password</label>
                        <input type="password" class="form-control" name="passwordk" placeholder="Konfirmasi Password">
                        <small id="emailHelp" class="form-text text-danger"><?php echo $this->session->flashdata('error_passwordk'); ?></small>
                    </div>
                    
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Setuju dengan syarat dan kebijakan</label>
                    </div>
                    <input type="hidden" name="level" value="user">
                    <button type="submit" class="btn btn-primary btn-block" value="Tambah">DAFTAR</button>
                </form>
            </div>
        </div>
        
    </section>


<!-- ASLI -->
<!--
<center>
		<h1>Register</h1>
	</?php echo $this->session->flashdata('message');?>
	</?php echo $this->session->flashdata('message_validasi');?>
	</center>

	<form class="login-page" action="</?php echo base_url(). 'register/proses_register'; ?>" method="post">
		<table style="margin:20px auto;">
			<tr>
				<td>Nama</td>
				<td><input type="text" name="nama"></td>
			</tr>
			<tr>
				<td>email</td>
				<td><input type="text" name="email"></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="password" name="password"></td>
			</tr>
			<tr>
				<td>Konfirmasi Password</td>
				<td><input type="password" name="passwordk"></td>
			</tr>
			<tr>
				<td></td>
				<input type="hidden" name="level" value="user">
				<td><input type="submit" value="Tambah"></td>
			</tr>
		</table>
	</form>	

<!-- end Register -->

