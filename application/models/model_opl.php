<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Model_opl extends CI_Model {
		var $table = 'ira_data_improvement';
	    var $table2 = 'ira_data_improvement_pengusul';
	    var $table3 = 'ira_data_opl';
	    var $column = array('nik_karyawan'); //set column field database for order and search
	    var $order = array('ID_IMPROVEMENT' => 'desc'); // default order 
	    public function __construct()
	    {
	        parent::__construct();
	        $this->db2 = $this->load->database('db2', TRUE);
	    }
		
		function update($where, $data)
	    {
	        $this->db->update($this->table, $data, $where);
	        return $this->db->affected_rows();
	    }

	    function proses_opl($data)
    	{
        	$this->db->insert('ira_data_opl',$data);
    	}

    	function get_by_nik($ID_IMPROVEMENT)
	    {
	        $data = "SELECT 
	                    ira_data_improvement_pengusul.NIK_KARYAWAN as NIK,
	                    ira_data_improvement_pengusul.NO_REGISTRASI
	                    FROM ira_data_improvement_pengusul join ira_data_improvement on ira_data_improvement_pengusul.PID_FLAG = ira_data_improvement.ID_IMPROVEMENT 
	                    join ira_mst_karyawan on ira_data_improvement.approver  = ira_mst_karyawan.NIK_KARYAWAN 
	                    WHERE ira_data_improvement_pengusul.PID_FLAG =  $ID_IMPROVEMENT "
	                    ;
	        
	        $query = $this->db->query($data);
	      
	        return $query->result_array();
	    }

	    function getPID()
	    {
	      $query = $this->db->query("SELECT MAX(ID_IMPROVEMENT) as max_id FROM ira_data_improvement"); 
	      $row = $query->row_array();
	      $max_id = $row['max_id']; 
	      $maxno_ira = $max_id +1;
	      return $maxno_ira;
	    }

	    function get_by_id_opl($ID_OPL)
	    {
	        $data = "SELECT a.tema as tema,
	                        a.id_opl as id_opl,
	                        a.no_registrasi as no_registrasi,
	                        a.no_opl as no_opl,
	                        a.perbaikan as perbaikan,
	                        b.NIK_KARYAWAN as nik_karyawan,
	                        b.NAMA_KARYAWAN as nama_karyawan,
	                        a.keterangan_before as keterangan_before,
	                        a.keterangan_after as keterangan_after,
	                        a.bq as bq,
	                        a.bc as bc,
	                        a.bd as bd,
	                        a.bs as bs,
	                        a.bm as bm,
	                        a.be as be,
	                        a.aq as aq,
	                        a.ac as ac,
	                        a.ad as ad,
	                        a.a_s as a_s,
	                        a.am as am,
	                        a.ae as ae,
	                        a.image_before as image_before,
	                        a.image_after as image_after

	         FROM ira_data_opl a 
	                    join ira_data_improvement_pengusul b on a.no_registrasi = b.no_registrasi
	        where a.id_opl ='".$ID_OPL."'   ";
	        
	        $query = $this->db->query($data);
	      
	        return $query->result_array();
	    }

	}

?>