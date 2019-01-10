<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Model_registrasi extends CI_Model {
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
		function getKoordinator()
	    {
	        $query = $this->db->query('SELECT * FROM ira_mst_karyawan WHERE ID_LEVEL=3 AND ID_DEPT = "'.$this->session->userdata('id_dept').'" AND ID_SUBDEPT = "'.$this->session->userdata('id_subdept').'" ORDER BY NAMA_KARYAWAN ASC');
	        return $query->result();
	    }

	    function getApprover()
	    {
	        $query = $this->db->query('SELECT * FROM ira_mst_karyawan WHERE ID_LEVEL=2 AND ID_DEPT = "'.$this->session->userdata('id_dept').'" AND ID_CG = "'.$this->session->userdata('id_cg').'" ORDER BY NAMA_KARYAWAN ASC');
	        return $query->result();
	    }

	    function getEmployee()
	    {
	        $query = $this->db->query('SELECT * FROM ira_mst_karyawan WHERE ID_LEVEL=6 ORDER BY NAMA_KARYAWAN ASC');
	        return $query->result();
	    }

	    function getLineProses()
	    {
	        $query = $this->db2->query('SELECT * FROM line_proses ORDER BY id_line_proses ASC');
	        return $query->result();
	    }

	    function getPID()
	    {
	      $query = $this->db->query("SELECT MAX(ID_IMPROVEMENT) as max_id FROM ira_data_improvement"); 
	      $row = $query->row_array();
	      $max_id = $row['max_id']; 
	      $maxno_ira = $max_id +1;
	      return $maxno_ira;
	    }

	    function areamesin($id)
	    {
	    $query=$this->db2->query("SELECT * FROM area_mesin WHERE line_proses='$id'");
	        return $query->result();
	    }

	    function jenismesin($idjenis){
	       $query=$this->db2->query("SELECT * FROM jenis_mesin WHERE line_proses='$idjenis'");
	        return $query->result();
	    }
	    
	    function proses_data($data)
	    {
	    	$this->db->insert('ira_data_improvement',$data);
	    }

	    function proses_data_detail($data)
	    {
	        $this->db->insert('ira_data_improvement_pengusul',$data);
	    }

	    function list_data_ss()
	    {
	    	$data = "SELECT * FROM
                        (select * from ira_data_improvement)a,
                        (select NIK_KARYAWAN as pengusul,PID_FLAG from ira_data_improvement_pengusul)b
                        WHERE a.ID_IMPROVEMENT=b.PID_FLAG AND b.pengusul='".$this->session->userdata('nik_karyawan')."' AND status != 'b' ";
        	return $this->db->query($data);
	    }

	    function list_koreksi_ss()
	    {
	    	$data = "SELECT * FROM ira_data_improvement WHERE nik_karyawan='".$this->session->userdata('nik_karyawan')."' AND status = 'b' ";
        	return $this->db->query($data);
	    }

	    function list_koreksi_opl()
	    {
	    	$data = "SELECT * FROM ira_data_opl 
	    			 JOIN ira_data_opl_pengusul ON ira_data_opl.no_registrasi = ira_data_opl_pengusul.no_registrasi
	    	WHERE ira_data_opl_pengusul.nik_pengusul='".$this->session->userdata('nik_karyawan')."' AND ira_data_opl.status = 'b' ";
        	return $this->db->query($data);
	    }

	    function get_datatables_correction()
	    {
	        $this->_get_datatables_correction_query();
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function get_datatables_correction_opl()
	    {
	        $this->_get_datatables_correction_query_opl();
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function _get_datatables_correction_query()
	    {
	        $status = 'b';
	        $this->db->from($this->table);
	        $this->db->join('ira_data_improvement_pengusul', 'ira_data_improvement_pengusul.PID_FLAG = ira_data_improvement.ID_IMPROVEMENT');
	        $this->db->where('status',$status);
	        $this->db->group_by("PID_FLAG");
	    }

	    function _get_datatables_correction_query_opl()
	    {
	        $status = 'b';
	        $nik_karyawan = $this->session->userdata('nik_karyawan');
	        $this->db->from($this->table3);
	        $this->db->join('ira_data_opl_pengusul', 'ira_data_opl.no_registrasi = ira_data_opl_pengusul.no_registrasi');
	        $this->db->where('ira_data_opl.status',$status);
	        $this->db->where('ira_data_opl_pengusul.nik_pengusul',$nik_karyawan);	    
	    }

	    function count_filtered()
	    {
	        $this->_get_datatables_correction_query();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_filtered_opl()
	    {
	        $this->_get_datatables_correction_query_opl();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all()
	    {
	        $this->db->from($this->table);
	        return $this->db->count_all_results();
	    }

	    function count_all_opl()
	    {
	        $this->db->from($this->table3);
	        return $this->db->count_all_results();
	    }

	    function update($where, $data)
	    {
	        $this->db->update($this->table, $data, $where);
	        return $this->db->affected_rows();
	    }

	    function get_by_id($ID_IMPROVEMENT)
	    {
	        $data = "SELECT 
	                    ira_data_improvement.ID_IMPROVEMENT,
	                    ira_data_improvement_pengusul.NIK_KARYAWAN as NIK,
	                    ira_data_improvement_pengusul.NAMA_KARYAWAN,
	                    ira_data_improvement.TEMA as TEMA,
	                    ira_data_improvement.PENYELESAIAN,
	                    ira_data_improvement.NO_REGISTRASI,
	                    ira_data_improvement.LATAR_BELAKANG,
	                    ira_data_improvement.PERBAIKAN,
	                    ira_data_improvement.MANFAAT,
	                    ira_data_improvement.ALAT_BAHAN,
	                    ira_data_improvement.BIAYA,
	                    ira_data_improvement.NO_WR,
	                    ira_data_improvement.KOREKSI,
	                    ira_data_improvement.REJECT,
	                    ira_data_improvement.approver,
	                    ira_mst_karyawan.NAMA_KARYAWAN as nama_approver

	                    FROM ira_data_improvement_pengusul join ira_data_improvement on ira_data_improvement_pengusul.PID_FLAG = ira_data_improvement.ID_IMPROVEMENT 
	                    join ira_mst_karyawan on ira_data_improvement.approver  = ira_mst_karyawan.NIK_KARYAWAN 
	                    WHERE ira_data_improvement_pengusul.PID_FLAG =  $ID_IMPROVEMENT "
	                    ;
	        
	        $query = $this->db->query($data);
	      
	        return $query->result_array();
	    }

	    function count()
		{
			$data = "SELECT
						count(ira_data_improvement.ID_IMPROVEMENT) as jumlah_koreksi
					 FROM
					    ira_data_improvement
					 WHERE
					 	ira_data_improvement.status = 'b'
					 AND ira_data_improvement.nik_karyawan = '".$this->session->userdata('nik_karyawan')."'  ";

			return $this->db->query($data);
		}

		function count_opl()
		{
			$data = "SELECT
						count(ira_data_opl.ID_OPL) as jumlah_koreksi
					 FROM
					    ira_data_opl JOIN ira_data_improvement on ira_data_opl.no_registrasi = ira_data_improvement.no_registrasi
					 WHERE
					 	ira_data_opl.status = 'b' 
					 AND ira_data_improvement.nik_karyawan = '".$this->session->userdata('nik_karyawan')."'";

			return $this->db->query($data);
		}

		function sum_register()
		{
			$data = "SELECT SUM(round(POIN_REG,1)) as poin_register, COUNT(ID) as jml_register FROM `ira_data_improvement_pengusul`
			JOIN ira_data_improvement ON ira_data_improvement.ID_IMPROVEMENT = ira_data_improvement_pengusul.PID_FLAG
					 WHERE ira_data_improvement_pengusul.nik_karyawan = '".$this->session->userdata('nik_karyawan')."' AND ira_data_improvement.STATUS = 'c' ";

			return $this->db->query($data);
		}

		function count_register()
		{
			$data = "SELECT COUNT(ID) as jml_register FROM ira_data_improvement_pengusul
						JOIN ira_data_improvement ON ira_data_improvement.ID_IMPROVEMENT = ira_data_improvement_pengusul.PID_FLAG
						WHERE ira_data_improvement_pengusul.nik_karyawan = '".$this->session->userdata('nik_karyawan')."' AND ira_data_improvement.STATUS = 'c' ";

			return $this->db->query($data);
		}

	}

?>