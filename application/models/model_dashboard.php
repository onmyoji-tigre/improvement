<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Model_dashboard extends CI_Model {
		// Declare variables
        private $_limit;
        private $_pageNumber;
        private $_offset;
        // setter getter function
        public function setLimit($limit) {
            $this->_limit = $limit;
        }
 
        public function setPageNumber($pageNumber) {
            $this->_pageNumber = $pageNumber;
        }
 
        public function setOffset($offset) {
            $this->_offset = $offset;
        }
        // Count all record of table "employee" in database.
        public function getAllEmployeeCount() {
        	$id_level = 6;
            $this->db->from('ira_mst_karyawan');
            $this->db->where('ira_mst_karyawan.id_level',$id_level);
            return $this->db->count_all_results();
        }
        // Fetch data according to per_page limit.
        public function employeeList() {   
        	$id_level = 6;    
            $this->db->select('*');
            $this->db->from('ira_mst_karyawan'); 
            $this->db->join('ira_mst_dept', 'ira_mst_dept.ID_DEPT = ira_mst_karyawan.ID_DEPT');
            $this->db->where('ira_mst_karyawan.id_level',$id_level);       
            $this->db->limit($this->_pageNumber, $this->_offset);
            $query = $this->db->get();
            return $query->result_array();
        }

        public function get_karyawan() {
			$data = "SELECT * FROM ira_mst_karyawan join ira_mst_dept on ira_mst_karyawan.ID_DEPT = ira_mst_dept.ID_DEPT
						WHERE ID_LEVEL = 6";

			return $this->db->query($data);
		}

		public function get_by_id($ID_KARYAWAN)
	    {
	        $data = "SELECT a.NIK_KARYAWAN,a.NAMA_KARYAWAN FROM ira_mst_karyawan as a

	                    WHERE ira_mst_karyawan.ID_KARYAWAN = $ID_KARYAWAN "
	                    ;
	        
	        $query = $this->db->query($data);
	      
	        return $query->result_array();
	    }

        function sum_register($NIK_KARYAWAN)
        {
            $data = "SELECT ira_data_improvement.NIK_KARYAWAN,ira_data_improvement_pengusul.NAMA_KARYAWAN,SUM(round(POIN_REG,1)) as poin_register, COUNT(ID) as jml_register FROM `ira_data_improvement_pengusul` JOIN ira_data_improvement ON ira_data_improvement.ID_IMPROVEMENT = ira_data_improvement_pengusul.PID_FLAG WHERE ira_data_improvement_pengusul.nik_karyawan = '$NIK_KARYAWAN' AND ira_data_improvement.STATUS = 'c' ";

            $query = $this->db->query($data);
            return $query->result_array();
        }



	}

?>