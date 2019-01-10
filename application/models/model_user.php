<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Model_user extends CI_Model {

		public function cek_user($data) {
			$query = $this->db->get_where('ira_mst_karyawan', $data);
			return $query;
		}
		
		public function update($username,$data,$table)
		{
			 //id apa yang mau di update, lalu DATA apa yang mau dikirim ke tabel di database
			$this->db->where('NIK_KARYAWAN',$username);
			$this->db->update($table,$data);
		}
	}

?>