<!doctype html>
<html>
    <head>
        <title>Upload</title>
    </head>
    <body>
            <h4>Catatan Online</h4>
            <form action="<?php echo base_url('catatan/proses_password'); ?>" method="post">

<label>Password <?php echo $this->session->flashdata('password');?> <?php echo $this->session->flashdata('password_salah');?> </label>
<input type="password" name="password" />
<br />
<input type="hidden" name="id" value="<?php echo $tampil->id_catatan; ?>">

<input type="submit" name="proses" value="Proses" />
</form>
    </body>
</html>