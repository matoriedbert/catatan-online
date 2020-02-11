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
    <?php echo $this->session->flashdata('berhasil_simpan'); ?>
    <?php echo $this->session->flashdata('berhasil_hapus'); ?>
	<br/>
	<img src="<?php echo base_url().'assets/img-profile/'; ?><?php echo $tampil->foto_user; ?>" width="140" height="140">
	<br/>
	nama : <?php tampil_aman($tampil->nama_user); ?> <br/>
	email : <?php tampil_aman($tampil->email_user); ?><br />
	<?php
	if (get_cookie('id_user') == $tampil->id_user) {
    	?> <a href="<?php echo base_url('setting/'.$nama_seo_user); ?>" >Setting Profile</a>
    	<?php
    }else{
    	//kosong
	}    		
	?>

	<p>List catatan user</p>
	<?php
	foreach ($catatan as $nampil) {
        ?>
        <a href="<?php echo base_url('/'.$nampil->id_catatan); ?>" ><?php echo $nampil->judul_catatan; ?></a> <a href="<?php echo base_url('catatan/edit/'.$nampil->id_catatan); ?>">Edit</a> <a href="<?php echo base_url('catatan/proses_hapus_catatan/'.$nampil->id_catatan); ?>">Hapus</a>
        <br/>
        <?php
		echo "";
	}
	?>
	



</body>
</html>