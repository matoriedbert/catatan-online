<!doctype html>
<html>
    <head>
        <title>Upload</title>
            <script type="text/javascript" src="<?php echo base_url('assets/editor/nicEdit.js'); ?>"></script> 
    <script type="text/javascript">
//<![CDATA[
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
  //]]>
  </script>
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
			 	echo "<br/>";
			 	echo "<a href='/'>Home </a>";
				echo "<a href=".site_url('user/login')." >Login</a>";
			 	//echo "id_user tidak sama dengan key";
			 }
?>
            <h4>Catatan Online</h4>
            <?php echo $this->session->flashdata('berhasil_simpan');?>
            <form action="<?php echo base_url('catatan/proses_upload'); ?>" method="post">
<label>Judul Catatan <?php echo $this->session->flashdata('judul');?> </label> <br/>
<input type="text" name="judul" placeholder="Judul Catatan"> <br/><br/>

<label>Isi Catatan <?php echo $this->session->flashdata('isi');?> </label> <br/>
<textarea name="isi" style="width: 300px; height: 100px;" placeholder="Masukan Catatan"><?php echo set_value('isi'); ?></textarea>
<br />

<label>Password </label>
<input type="password" name="password" />
<br />
Password boleh di kosongkan
<br />
<input type="submit" name="proses" value="Simpan" />
</form>
    </body>
</html>