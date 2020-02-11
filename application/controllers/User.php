<?php 
 
class User extends CI_Controller{
 
	function __construct(){
		parent::__construct();
		// $this->load->model('Sering_m');
		$this->load->model('M_user');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->helper('cookie');
		$this->load->helper('string');
		$this->load->helper('slug');
		$this->load->helper('keamanan');
         $this->load->helper('string');
	}
 
	function login(){
		$this->load->view('login_view');
	}
 
	function proses_login(){
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$where = array(
			'email_user' => $email,
			'password_user' => md5($password)
			);

		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if($this->form_validation->run() == FALSE){
		    //$this->session->set_flashdata('message_validasi', validation_errors());
		    $this->session->set_flashdata('error_email', form_error('email'));
		    $this->session->set_flashdata('error_password', form_error('password'));
			$this->session->set_flashdata('temporary_email', $this->input->post('email') );
			redirect('user/login');
		}else{
			$cekemail = $this->db->query("SELECT * FROM user where email_user='".$this->input->post('email')."'")->num_rows();
			if ($cekemail<=0) {
				$this->session->set_flashdata('temporary_email', $this->input->post('email') );
				$this->session->set_flashdata('error_salah', 'Email belum terdaftar <a href='.base_url().'user/register >Daftar</> ');
				redirect('user/login');
			}else{
				$cek = $this->M_user->cek_login("user",$where);
				if($cek->num_rows() > 0){
					$data=$cek->row_array(); 
					$id_user = $data['id_user']; //kalau gak di buat ini gak bisa
					//membuat cookie
					$key = random_string('alnum', 64);
					set_cookie('key_user', $key, 3600*24*30); // set expired 30 hari kedepan
					set_cookie('id_user', $id_user, 3600*24*30);
					set_cookie('nama_user', $data['nama_user'], 3600*24*30);
					set_cookie('nama_seo_user', $data['nama_seo_user'], 3600*24*30);

					 $data = array(
						'key_user' => $key
					);
					$wherecookie = array(
						 'id_user'=> $id_user
					);
					$this->M_user->update_cookie($wherecookie, $data,'user');
       				
					//$this->session->set_userdata($data_session);
					redirect(base_url());
				}else{
				    $this->session->set_flashdata('temporary_email', $this->input->post('email') );
					$this->session->set_flashdata('error_salah', 'Email atau password salah');
					redirect('user/login');
				}
			}
		}
	}
 
	function logout(){
		delete_cookie('status');
		delete_cookie('nama_user');
		delete_cookie('nama_seo_user');
		delete_cookie('id_user');
		delete_cookie('nama_cookie');
		delete_cookie('key_user');
		delete_cookie('key_cookie');
		$this->session->sess_destroy();
		redirect(base_url('user/login'));
	}

	function register(){
 	    // $data['judul'] = 'Registrasi';
 	    // $data['menu'] = $this->Sering_m->list_menu()->result();
		// $this->load->view('teamplates/header.php');
		$this->load->view('register_view');
		// $this->load->view('teamplates/footer.php');
	}
 
	function proses_register(){
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('nama', 'Username', 'required|alpha_numeric_spaces');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('passwordk', 'Password Confirmation', 'required|matches[password]');
		
		if($this->form_validation->run() == FALSE){
			//$this->session->set_flashdata('message_validasi', validation_errors());

 			$this->session->set_flashdata('error_nama', form_error('nama'));
			$this->session->set_flashdata('error_email', form_error('email'));
			$this->session->set_flashdata('error_password', form_error('password'));
			$this->session->set_flashdata('error_passwordk', form_error('passwordk'));
			$this->session->set_flashdata('error_nama', form_error('nama'));
			$this->form_validation->set_message('required', 'wajib diisi');
			$this->form_validation->set_message('alpha_numeric_spaces', 'wajib angka, huruf dan spasi');
			$this->session->set_flashdata('temporary_email', $this->input->post('email') );
			$this->session->set_flashdata('temporary_nama', $this->input->post('nama') );
			redirect('register/index');
		}else{
			$cek = $this->db->query("SELECT * FROM user where email_user='".$this->input->post('email')."'")->num_rows();
			if ($cek<=0) {
				$nama = $this->input->post('nama');
				$nama_seo = slug($nama);
				$email = $this->input->post('email');
				$password = $this->input->post('password');
				$password = $this->input->post('passwordk');
				// $level = $this->input->post('level');
		 		$key = random_string('alnum', 64);
				$data = array(
					'nama_user' => $nama,
					'nama_seo_user' => $nama_seo,
					'email_user' => $email,
					//'key_user' => $key,
					// 'level_user' => $level,
					'password_user' => md5($password)
					);
				$this->M_user->input_data($data,'user');
				$this->session->set_flashdata('berhasil_daftar', '<b>'.$nama.'</b>'.'  anda berhasil mendaftar silahkan login');

				 //    set_cookie('key_user', $key, 3600*24*30); // set expired 30 hari kedepan
					// set_cookie('status', 'Berhasil', 3600*24*30);
					// set_cookie('id_user', $id_user, 3600*24*30);
					// set_cookie('nama_user', $data['nama_user'], 3600*24*30);
					// set_cookie('nama_seo_user', $data['nama_seo_user'], 3600*24*30);
				redirect(base_url('user/login'));
			}else {
				$this->session->set_flashdata('error_cekdata', 'Email sudah terdaftar');
				$this->session->set_flashdata('temporary_email', $this->input->post('email') );
			    $this->session->set_flashdata('temporary_nama', $this->input->post('nama') );

				redirect(base_url('user/login'));
			}
		}
	}


	public function profile($id){
            $cekadagak = $this->db->query("SELECT * FROM user WHERE nama_seo_user = '$id' ")->num_rows();
			if ($cekadagak<=0) {
                echo "Maaf profil yang anda cari tidak ada";
			}else{
				$id = get_cookie('nama_seo_user');
			    $aktifuser = array('nama_seo_user'=>$id);
    		    $data['tampil'] = $this->M_user->isi_user($aktifuser);
    		    $data['catatan'] = $this->M_user->listartikel_profile($aktifuser);

    		 	$this->load->view('profil_mentah', $data);
			}
	}

	public function setting($id){
	        $cekadagak = $this->db->query("SELECT * FROM user WHERE nama_seo_user = '$id' ")->num_rows();
	        if ($cekadagak<=0) {
                echo "Maaf profil yang anda cari tidak ada";
			}else{
			    $aktifuser = array('nama_seo_user'=>$id);
    		    $data['tampil'] = $this->M_user->setting_user($aktifuser);
    		    if (get_cookie('id_user') == $data['tampil']->id_user) {
    		    	$this->load->view('setting_mentah', $data);
    		    }else{
    		    $url = get_cookie('nama_seo_user');
    			redirect('setting/'.$url);
		   		}
			}
	}

	public function ganti_nama($id){
	        $cekadagak = $this->db->query("SELECT * FROM user WHERE nama_seo_user = '$id' ")->num_rows();
	        if ($cekadagak<=0) {
                echo "Maaf profil yang anda cari tidak ada";
			}else{
			    $aktifuser = array('nama_seo_user'=>$id);
    		    $data['tampil'] = $this->M_user->setting_user($aktifuser);
    		    if (get_cookie('id_user') == $data['tampil']->id_user) {
    		    	$this->load->view('ganti_nama_mentah', $data);
    		    }else{
    			redirect(base_url('user/ganti_nama/'.get_cookie('nama_seo_user')));
		   		}
			}
	}

	public function ganti_foto($id){
	        $cekadagak = $this->db->query("SELECT * FROM user WHERE nama_seo_user = '$id' ")->num_rows();
	        if ($cekadagak<=0) {
                echo "Maaf profil yang anda cari tidak ada";
			}else{
			    $aktifuser = array('nama_seo_user'=>$id);
    		    $data['tampil'] = $this->M_user->setting_user($aktifuser);
    		    if (get_cookie('id_user') == $data['tampil']->id_user) {
    		    	$this->load->view('ganti_foto_mentah', $data);
    		    }else{
    			redirect(base_url('user/ganti_nama/'.get_cookie('nama_seo_user')));
		   		}
			}
	}

	public function ganti_password($id){
	        $cekadagak = $this->db->query("SELECT * FROM user WHERE nama_seo_user = '$id' ")->num_rows();
	        if ($cekadagak<=0) {
                echo "Maaf profil yang anda cari tidak ada";
			}else{
			    $aktifuser = array('nama_seo_user'=>$id);
    		    $data['tampil'] = $this->M_user->setting_user($aktifuser);
    		    if (get_cookie('id_user') == $data['tampil']->id_user) {
    		    	echo "Maaf fitur belum tersedia";
    		    	//$this->load->view('ganti_nama_mentah', $data);
    		    }else{
    			redirect(base_url('user/ganti_nama/'.get_cookie('nama_seo_user')));
		   		}
			}
	}

	public function ganti_email($id){
	        $cekadagak = $this->db->query("SELECT * FROM user WHERE nama_seo_user = '$id' ")->num_rows();
	        if ($cekadagak<=0) {
                echo "Maaf profil yang anda cari tidak ada";
			}else{
			    $aktifuser = array('nama_seo_user'=>$id);
    		    $data['tampil'] = $this->M_user->setting_user($aktifuser);
    		    if (get_cookie('id_user') == $data['tampil']->id_user) {
    		    	$this->load->view('ganti_email_mentah', $data);
    		    }else{
    			redirect(base_url('user/ganti_email/'.get_cookie('nama_seo_user')));
		   		}
			}
	}

	public function proses_nama(){
	 		$data = array(
						'nama_user' => $this->input->post('nama', true),
					);
			$wherecookie = array(
						 'id_user'=> get_cookie('id_user')
					);
			$this->M_user->update_setting($wherecookie, $data,'user');
			redirect(base_url('setting/'.get_cookie('nama_seo_user')));
	}

	public function proses_email(){
			$where = array(
				'password_user' => md5($this->input->post('password', true))
			);
			$cek = $this->M_user->cek_login("user",$where);
				if($cek->num_rows() > 0){
					$data = array(
						'email_user' => $this->input->post('email', true),
					);
					$whereemail = array(
						 'id_user'=> get_cookie('id_user')
					);
					$this->M_user->update_setting($whereemail, $data,'user');
					redirect(base_url('setting/'.get_cookie('nama_seo_user')));
				}else{
					echo "Maaf Password salah";
					$this->ganti_email(get_cookie('nama_seo_user'));
				}
	}


	public function proses_foto(){
			$config['upload_path'] = './assets/img-profile/';
            $config['allowed_types'] = 'jpg|png|gif';
            $config['max_size'] = '100';
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('foto')) {
            	//echo "Tidak Sesuai aturan";
            	echo $this->upload->display_errors();
                $this->ganti_foto(get_cookie('nama_seo_user'));
            } else {
                // jika berhasil upload ambil data dan masukkan ke database
                $upload_data = $this->upload->data();
                $namafile = get_cookie('nama_seo_user');
                $new_file_name=$namafile.'.jpg'; // nama baru 

                $config['source_image'] = './assets/img-profile/'.$upload_data['file_name'];
                $config['new_image'] = './assets/img-profile/'.$new_file_name;
                $this->load->library('image_lib',$config);
                $this->image_lib->initialize($config);
                $this->image_lib->watermark();
                unlink('./assets/img-profile/'.$upload_data['file_name']);

                date_default_timezone_set('Asia/Jakarta');
		        $data = [
		            "foto_user" => $new_file_name,
		            "id_user" => get_cookie('id_user')
		        ];
        		$data = array(
						"foto_user" => $new_file_name,
					);
				$wherefoto = array(
						 'id_user'=> get_cookie('id_user')
					);
					$this->M_user->update_setting($wherefoto, $data,'user');
                redirect(base_url('setting/'.get_cookie('nama_seo_user')));
            }
    }
}