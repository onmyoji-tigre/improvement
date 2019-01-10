<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_dashboard extends CI_Controller {
	
	//Load libraries in Constructor.
        public function __construct() {
            parent::__construct(); 
            // load pagination library
            $this->load->library('pagination');
            // load Employee Model
            $this->load->helper('text');
			$this->load->model('model_dashboard');
        }
        // listing recards
        public function index() { 
            $config['total_rows'] = $this->model_dashboard->getAllEmployeeCount();
            $data['total_count'] = $config['total_rows'];
            $config['suffix'] = '';
 
            if ($config['total_rows'] > 0) {
                $page_number = $this->uri->segment(3);
                $config['base_url'] = base_url() . 'C_dashboard/index/';
                if (empty($page_number))
                    $page_number = 1;
                $offset = ($page_number - 1) * $this->pagination->per_page;
                $this->model_dashboard->setPageNumber($this->pagination->per_page);
                $this->model_dashboard->setOffset($offset);
                $this->pagination->cur_page = $offset;
                $this->pagination->initialize($config);
                $data['page_links'] = $this->pagination->create_links();
                $data['employeeInfo'] = $this->model_dashboard->employeeList();
            }
            // load view
            $this->load->view('employee_dashboard', $data);
        }

        public function show_poin($NIK_KARYAWAN)
	    {
	       $data = $this->model_dashboard->sum_register($NIK_KARYAWAN); // if 0000-00-00 set tu empty for datepicker compatibility
	       echo json_encode($data);
	    }
}

?>