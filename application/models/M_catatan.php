<?php 
 
class M_catatan extends CI_Model{

	public function __construct()
    {
        parent::__construct();
        
    }

    function insert_pengunjung($data,$table){
		$this->db->insert($table,$data);
	}
    
	public function isi_catatan($aktifartikel) {
		 $this->db->select('*');
		 $this->db->from('catatan');
		 // $this->db->join('user', 'artikel.id_user = user.id_user');
		 $this->db->where($aktifartikel);
		 $query = $this->db->get();
		 return $query->row();
	}

	function update_catatan($wherecookie,$data,$table){
		$this->db->where($wherecookie);
		$this->db->update($table,$data);
	}

	function hapus_catatan($wherecookie,$table){
		$this->db->where($wherecookie);
		$this->db->delete($table);
	}

	function cek_password($table,$where){		
		return $this->db->get_where($table,$where);
	}

}