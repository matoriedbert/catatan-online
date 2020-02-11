<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catatan extends CI_Controller {

	function __construct(){
		parent::__construct();	
		$this->load->database();
		$this->load->helper('url');	
		$this->load->model('M_catatan');
        $this->load->model('M_user');
		$this->load->library('user_agent');	
		$this->load->library('session');
		 $this->load->library('form_validation');
		 $this->load->helper('slug');
         $this->load->helper('cookie');
	}

	public function index($id){
	        $cekadagak = $this->db->query("SELECT * FROM catatan WHERE id_catatan = '$id' ")->num_rows();
			if ($cekadagak<=0) {
                echo "Maaf Catatan yang anda cari tidak ada";
			}else{
    			$aktifartikel = array('id_catatan'=>$id);
    		    $data['tampil'] = $this->M_catatan->isi_catatan($aktifartikel);
                $password = $data['tampil']->password_catatan;
                if ($password == "") {
                    
                    date_default_timezone_set('Asia/Jakarta');
                    
                    $aktifcatatan = array('id_catatan'=>$id);
                    $data['catatan'] = $this->M_catatan->isi_catatan($aktifcatatan);
                    $this->load->view('V_catatan', $data);
                }else{

                    if (get_cookie('status') != "Berhasil") {
                        $this->load->view('V_catatan_password', $data);
                    }else{
                        $this->load->view('V_catatan', $data); 
                    }
 
                 }
			}
	}

    public function edit($id){
        $id_user = get_cookie('id_user');
        $cekuser = $this->db->query("SELECT * FROM catatan WHERE id_catatan = '$id' AND id_user ='$id_user' ")->num_rows();
        if ($cekuser<=0) {
            echo "Acces Denied";
        }else{
            $cekadagak = $this->db->query("SELECT * FROM catatan WHERE id_catatan = '$id' ")->num_rows();
            if ($cekadagak<=0) {
                echo "Maaf Catatan yang anda cari tidak ada";
            }else{
                $aktifartikel = array('id_catatan'=>$id);
                $data['tampil'] = $this->M_catatan->isi_catatan($aktifartikel);
                $password = $data['tampil']->password_catatan;
                if ($password == "") {
                    date_default_timezone_set('Asia/Jakarta');
                    $aktifcatatan = array('id_catatan'=>$id);
                    $data['catatan'] = $this->M_catatan->isi_catatan($aktifcatatan);
                    $this->load->view('V_catatan_edit', $data);
                }else{

                    if (get_cookie('status') != "Berhasil") {
                        $this->load->view('V_catatan_password', $data);
                    }else{
                        $this->load->view('V_catatan_edit', $data); 
                    }
 
                 }
            }

        }//ifcek user
            
    }

    public function proses_edit_catatan(){
            $data = array(
                        'isi_catatan' => $this->input->post('catatan', true),
                        "judul_catatan" => $this->input->post('judul', true)
                    );
            $wherecookie = array(
                         'id_catatan'=> $this->input->post('id', true)
                    );
            $this->M_catatan->update_catatan($wherecookie, $data,'catatan');
            $this->session->set_flashdata('berhasil_edit', '<b>Catatan Berhasil di Edit</b>');
            redirect(base_url('catatan/edit/'.$this->input->post('id', true)));
    }

    public function proses_hapus_catatan($id){
            // $data = array(
            //             'isi_catatan' => $this->input->post('catatan', true),
            //             "judul_catatan" => $this->input->post('judul', true)
            //         );
            $wherecookie = array(
                         'id_catatan'=> $id
                    );
            $this->M_catatan->hapus_catatan($wherecookie, 'catatan');
            $this->session->set_flashdata('berhasil_hapus', '<b>Catatan Berhasil di Hapus</b>');
            redirect(base_url('profile/'.get_cookie('nama_user')));
    }

	public function upload($error = NULL){
  
        $data = array(
            'action' => site_url('artikel/proses_upload'),
            'judul' => set_value('judul'),
            'error' => $error['error'] // ambil parameter error
        );
        $this->load->view('upload_mentah', $data);    
    }

	public function proses_upload()
    {
        // validasi judul
        $this->form_validation->set_rules('isi', 'isi', 'required');
        $this->form_validation->set_rules('judul', 'judul', 'alpha_numeric_spaces');
        
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('isi', form_error('isi'));
            $this->session->set_flashdata('judul', form_error('judul'));
            $this->upload();
        } else {
            // config upload
                date_default_timezone_set('Asia/Jakarta');

                $cekidterakhir = $this->db->query("SELECT * FROM catatan ORDER BY id_catatan DESC LIMIT 1 ")->row();
                $id_catatan = $cekidterakhir->id_catatan + 1;
                if (get_cookie('id_user') == "") {
                    $id = 1;
                }else{
                    $id = get_cookie('id_user');
                }
                $data = [
                    "id_catatan" => $id_catatan,
                    "judul_catatan" => $this->input->post('judul', true),
                    "isi_catatan" => $this->input->post('isi', true),
                    "password_catatan" => $this->input->post('password', true),
                    "waktu_catatan" => date('Y-m-d H:i:s'),
                    "id_user" => $id
                    
                ];
        
        $this->db->insert('catatan', $data);
         $this->session->set_flashdata('berhasil_simpan', '<b>Catatan Berhasil di simpan</b>');
                redirect(base_url('profile/'.get_cookie('nama_user')));
            
        }
    }


    public function proses_password()
    {
        // validasi judul
        $this->form_validation->set_rules('id', 'id', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('id', form_error('id'));
            $this->session->set_flashdata('password', form_error('password'));
            redirect($this->agent->referrer());
        } else {
            // config upload
                date_default_timezone_set('Asia/Jakarta');
                $id = $this->input->post('id', true);
                $where = array(
                    'id_catatan' => $id,
                    'password_catatan' => $this->input->post('password', true),
                    );
                $cek = $this->M_catatan->cek_password("catatan",$where);
                if($cek->num_rows() > 0){
                    
                    set_cookie('status', 'Berhasil', 3600*24*1); // set expired 1 hari kedepan
                    redirect(base_url('/'.$id));
                }else{
                    $this->session->set_flashdata('password_salah', 'Maaf password salah');
                    redirect($this->agent->referrer());
                }       
        }
    }

    public function logout(){
        delete_cookie('status');
        redirect($this->agent->referrer());
    }

}
