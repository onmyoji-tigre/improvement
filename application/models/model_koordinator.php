<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Model_koordinator extends CI_Model {
		var $table = 'ira_data_improvement';
	    var $table2 = 'ira_data_improvement_pengusul';
	    var $table3 = 'ira_data_opl';
	    var $table4 = 'ira_data_opl_pengusul';
	    var $column = array('nik_karyawan'); //set column field database for order and search
	    var $order = array('ID_IMPROVEMENT' => 'desc'); // default order 
	    public function __construct()
	    {
	        parent::__construct();
	        $this->db2 = $this->load->database('db2', TRUE);
	    }

		function get_datatables()
	    {
	        $this->_get_datatables_query();
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function get_datatables_opl_coordinator()
	    {
	        $this->_get_datatables_query_opl();
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function _get_datatables_query()
	    {
	        $status = 'a';
	        $dept = $this->session->userdata('id_dept');
	        $nik = $this->session->userdata('nik_karyawan');
	        $this->db->from($this->table);
	        $this->db->join('ira_data_improvement_pengusul', 'ira_data_improvement_pengusul.PID_FLAG = ira_data_improvement.ID_IMPROVEMENT');
	        $this->db->where('status',$status);
	        $this->db->where('dept_pengusul',$dept);
	        $this->db->where('KOORDINATOR',$nik);
	        $this->db->group_by("PID_FLAG");
	        
	    }

	    function _get_datatables_query_opl()
	    {
	        $status = 'c';
	        $nik = $this->session->userdata('nik_karyawan');
	        $this->db->from('ira_data_opl');
	        $this->db->where('status',$status);
	        $this->db->where('nik_koordinator',$nik);
	        
	    }

	    function count_filtered()
	    {
	        $this->_get_datatables_query();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all()
	    {
	        $this->db->from($this->table);
	        return $this->db->count_all_results();
	    }

	    function count_coordinator_filteredopl()
	    {
	        $this->_get_datatables_query_opl();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_coordinator_opl()
	    {
	        $this->db->from($this->table3);
	        return $this->db->count_all_results();
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

	    public function get_by_id_opl($ID_OPL)
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

	    public function update($where, $data)
	    {
	        $this->db->update($this->table, $data, $where);
	        return $this->db->affected_rows();
	    }

	    public function update2($where, $data2)
	    {
	        $this->db->update($this->table2, $data2, $where);
	        return $this->db->affected_rows();
	    }

	    public function get_no_register() 
	    {
	        $tahun = date("Y");
	        $bulan = date("m");
	        $kode = 'SS';
	        $query = $this->db->query("SELECT MAX(LEFT(NO_REGISTRASI,5)) as noreg FROM ira_data_improvement"); 
	        $row = $query->row_array();
	        $max_id = $row['noreg']; 
	        $ID_IMPROVEMENT = $max_id +1;
	        $maxno_registrasi = sprintf("%05s",$ID_IMPROVEMENT).'/'.$kode.'/'.$bulan.'/'.$tahun;
	        return $maxno_registrasi;
	    }

	    public function updateopl($where, $dataopl)
        {
        $this->db->update($this->table3, $dataopl, $where);
        return $this->db->affected_rows();
        }

        public function updateopl2($where, $dataopl2)
        {
        $this->db->update($this->table4, $dataopl2, $where);
        return $this->db->affected_rows();
        }

        public function get_no_opl() {
	        $tahun = date("Y");
	        $bulan = date("m");
	        $kode = 'OPL';
	        $query = $this->db->query("SELECT MAX(LEFT(no_opl,5)) as noopl FROM ira_data_opl"); 
	        $row = $query->row_array();
	        $max_id = $row['noopl']; 
	        $id_opl = $max_id +1;
	        $maxno_opl = sprintf("%05s",$id_opl).'/'.$kode.'/'.$bulan.'/'.$tahun;
	        return $maxno_opl;
	    }

	    function count()
		{
			$data = "SELECT
						count(ira_data_improvement.ID_IMPROVEMENT) as jumlah_ss_koordinator
					 FROM
					    ira_data_improvement
					 WHERE
					 	ira_data_improvement.status = 'a'
					 AND ira_data_improvement.KOORDINATOR = '".$this->session->userdata('nik_karyawan')."'  ";

			return $this->db->query($data);
		}

		function count_jml_opl()
		{
			$data = "SELECT
						count(ira_data_opl.ID_OPL) as jumlah_ss_koordinator
					 FROM
					    ira_data_opl JOIN ira_data_improvement on ira_data_opl.no_registrasi = ira_data_improvement.no_registrasi
					 WHERE
					 	ira_data_opl.status = 'c' 
					 AND ira_data_improvement.KOORDINATOR = '".$this->session->userdata('nik_karyawan')."'";

			return $this->db->query($data);
		}

	}

?>