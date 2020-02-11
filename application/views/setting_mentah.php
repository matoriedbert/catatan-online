<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
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
                echo "<a href= ".site_url('catatan/upload')." >Buat Catatan </a>";
                echo "<a href=".site_url('profile/'.$nama_seo_user)." >$nama_user </a>";
                echo "<a href= ".site_url('user/logout')." >Logout </a>";
                //echo "anda berhasil login";
             }else{
                echo "<a href='/'>Home </a>";
                echo "<a href=".site_url('user/login')." >Login</a>";
                //echo "id_user tidak sama dengan key";
             }
?>
	<br/>
<img src="<?php echo base_url().'assets/img-profile/'; ?><?php echo $tampil->foto_user; ?>" width="140" height="140">
<a href="<?php echo base_url('user/ganti_foto/'.get_cookie('nama_seo_user')); ?>">Ganti Foto</a>
	<br/>
	Edit User <br/>
	Nama  : <?php echo $tampil->nama_user; ?> <a href="<?php echo base_url('user/ganti_nama/'.get_cookie('nama_seo_user')); ?>">Ganti Nama</a>
	<br />
	Email : <?php echo $tampil->email_user; ?> <a href="<?php echo base_url('user/ganti_email/'.get_cookie('nama_seo_user')); ?>">Ganti Email</a>
	<br />
	Password : <a href="<?php echo base_url('user/ganti_password/'.get_cookie('nama_seo_user')); ?>">Ganti Password</a>
	
</body>
</html>