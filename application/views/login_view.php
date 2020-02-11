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
<?php echo $this->session->flashdata('berhasil_daftar'); ?>
<!-- LOGIN -->
    <section id="login" class="mb-4">
        
        <!-- HEADER LOGIN -->
        <div class="row">
            <div class="col text-center mx-4">
                <h3 class="text-center">Silahkan Login ke akun Anda</h3>
	            <p class="text-center">Belum punya akun?<a href="<?php echo base_url()?>user/register"> Klik disini</a> untuk mendaftar</p>
                
            </div>
        </div>
        
        <!-- FORM LOGIN -->
        <div class="row justify-content-center">
            <div class="col-md-4 mx-4">
                <form action="<?php echo base_url('user/proses_login'); ?>" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="input" class="form-control" name="email" placeholder="Masukan email" value="<?php echo $this->session->flashdata('temporary_email'); ?>"/>
                        <small id="emailHelp" class="form-text text-danger"><?php echo $this->session->flashdata('error_email'); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password" value=""/>
                        <small id="emailHelp" class="form-text text-danger"><?php echo $this->session->flashdata('error_password'); ?><?php echo $this->session->flashdata('error_salah'); ?></small>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" name="login" value="Login">Login</button>
                </form>
            </div>
        </div>
        
        
        <!-- LUA SANDI -->
        <div class="row mt-3">
            <div class="col text-center mx-4">
                <p class="text-center">Lupa Sandi?<a href="<?php echo base_url()?>atur_sandi">
				!! BELUM ADA !!</a> Untuk mengatur ulang kata sandi.</p>
            </div>
        </div>
    </section>















<!-- ASLI -->
<!--
<section>
<body>
    <div class="container background-white">
	    <div class="row margin-vert-30">
	        <!-- Login Box --> <!--
	        <div class="col-md-6 col-sm-offset-3">
	             <form class="login-page" action="</?php echo base_url('login/proses_login'); ?>" method="post">	
	                <div class="login-header margin-bottom-30">
	                    <h3 class="text-center">Silahkan Login ke akun Anda</h3>
	                    <p class="text-center">Belum punya akun?<a href="Register_view.php"> Klik disini</a> untuk mendaftar</p>
	                </div>
                	Email:
                	<div class="input-group margin-bottom-30">
                	    <span class="input-group-addon">
                	        <i class="fa fa-email"></1>
                	    </span>
                	    <input class="form-control" type="text" name="email" placeholder="Email" value=""/>
                	    <p></p>
                	Password:
                	<div class="input-group margin-bottom-30">
                        <span class="input-group-addon">
                            <i class="fa fa-lock"></i>
                        </span>
                        <input class="form-control" type="password" name="password" placeholder="Password" value=""/>
                        <p></p>
                	</div><br/>
                        <input type="submit" class="fa fa-login btn btn-primary btn-block" name="login" value="Login" /><br/>
                        <p class="text-center">Lupa Sandi?<a href="atur_sandi.php">
						Klik Disini</a> Untuk mengatur ulang kata sandi.</p>
                </form>
	        </div>
	        <div class="col">
                <div class="text-center text-danger mb-2"></?php echo $this->session->flashdata('message');?>
                </div>
                <div class="text-center text-danger mb-2"></?php echo $this->session->flashdata('message_validasi');?>
                </div>
	       </div>
	        </div>
	    </div>
	</div>
</body>
</section>
-->

<!-- end Login -->