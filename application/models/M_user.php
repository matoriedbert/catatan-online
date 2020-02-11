<?php 
 
class M_user extends CI_Model{	
	function cek_login($table,$where){		
		return $this->db->get_where($table,$where);
	}

	function cek_cookie($table,$where){		
		return $this->db->get_where($table,$where);
	}	

	function update_cookie($wherecookie,$data,$table){
		$this->db->where($wherecookie);
		$this->db->update($table,$data);
	}

	function update_setting($wherecookie,$data,$table){
		$this->db->where($wherecookie);
		$this->db->update($table,$data);
	}

	function tampil_data(){
		return $this->db->get('user');
	}
 
	function input_data($data,$table){
		$this->db->insert($table,$data);
	}

	public function isi_user($id) {
		 $this->db->select('*');
		 $this->db->from('user');
		 $this->db->where($id);
		 $query = $this->db->get();
		 return $query->row();
	}

	public function setting_user($id) {
		 $this->db->select('*');
		 $this->db->from('user');
		 $this->db->where($id);
		 $query = $this->db->get();
		 return $query->row();
	}

	public function listartikel_profile($id) {
		 $this->db->select('*');
		 $this->db->from('catatan');
		  $this->db->join('user', 'catatan.id_user = user.id_user');
		 $this->db->where($id);
		 $query = $this->db->get();
		 return $query->result();
	
	}
}