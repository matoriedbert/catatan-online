<!DOCTYPE html>
<html>
<head>
  <title>Catatan Online</title>
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
                echo "<a href='/'>Home </a>";
                echo "<a href=".site_url('user/login')." >Login</a>";
                //echo "id_user tidak sama dengan key";
             }
?>
  <h1 align="center">Catatan Online</h1>
  <?php
  $id_user = get_cookie('id_user');
        $cekuser = $this->db->query("SELECT * FROM catatan WHERE id_catatan = '$tampil->id_catatan' AND id_user ='$id_user' ")->num_rows();
        if ($cekuser<=0) {
            // boleh
        }else{
        ?>
        <a href="<?php echo base_url('catatan/edit/'.$tampil->id_catatan); ?>"> Edit Catatan</a>
        <?php 
        }
        ?>

<br/>
    <?php echo $this->session->flashdata('berhasil_edit'); ?>
<label>Judul Catatan <?php echo $this->session->flashdata('judul');?> </label> <br/>
<input  type="text" name="judul" placeholder="Judul Catatan" value="<?php echo $tampil->judul_catatan; ?>"> <br/><br/>

<textarea name="catatan" style="width: 300px; height: 100px;"><?php echo $tampil->isi_catatan; ?></textarea>
 
</body>
</html>