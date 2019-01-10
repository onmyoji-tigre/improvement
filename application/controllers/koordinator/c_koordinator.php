<?php
session_start();
class C_koordinator extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('nik_karyawan')=="") {
			redirect('auth');
		}
		$this->load->helper('text');
		$this->load->model('model_koordinator');
	}

	public function index() {
		$data['count'] = $this->model_koordinator->count();
		$data['count_jml_opl'] = $this->model_koordinator->count_jml_opl();
		$data['nik_karyawan'] = $this->session->userdata('nik_karyawan');
		$data['nama_karyawan'] = $this->session->userdata('nama_karyawan');
		$this->load->view('koordinator/index', $data);
	}

	public function inbox_ss() {
		$this->load->view('koordinator/v_inbox_ss');
	}

	public function inbox_opl() {
		$this->load->view('koordinator/v_inbox_opl');
	}

	public function ajax_list()
	{
	     $list = $this->model_koordinator->get_datatables();
	        $data = array();
	        $no = $_POST['start'];
	        foreach ($list as $person) {
	          $no++;
	          $row = array();
	          $row[] = $person->TGL_USUL;
	          $row[] = $person->TEMA;
	          $row[] = $person->PERBAIKAN;
	          $row[] = $person->MANFAAT;

	          //add html for action
	          $row[] = '<a class="btn btn-success btn-sm" href="javascript:void()" title="Accept" onclick="edit_person('."'".$person->ID_IMPROVEMENT."'".')"><i class="glyphicon glyphicon-pencil" ></i>Click To Show</a>';
	        
	          $data[] = $row;
	        }

	        $output = array(
	                "draw" => $_POST['draw'],
	                "recordsTotal" => $this->model_koordinator->count_all(),
	                "recordsFiltered" => $this->model_koordinator->count_filtered(),
	                "data" => $data,
	            );
	        //output to json format
	        echo json_encode($output);
	}

	public function ajax_list_opl_coordinator()
    {
     $list = $this->model_koordinator->get_datatables_opl_coordinator();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $person) {
          $no++;
          $row = array();
          $row[] = $person->no_registrasi;
          $row[] = $person->perbaikan;
          $row[] = $person->tema;

          //add html for action
          $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Accept" onclick="edit_person_opl('."'".$person->id_opl."'".')"><i class="glyphicon glyphicon-pencil"></i> Show</a>';
        
          $data[] = $row;
        } 

        $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->model_koordinator->count_coordinator_opl(),
                "recordsFiltered" => $this->model_koordinator->count_coordinator_filteredopl(),
                "data" => $data,
            );
        //output to json format
        echo json_encode($output);
    }

	public function ajax_edit($id)
	{
	      $data = $this->model_koordinator->get_by_id($id); // if 0000-00-00 set tu empty for datepicker compatibility
	      echo json_encode($data);
	}

	public function ajax_edit_opl($id)
	{
	      $data = $this->model_koordinator->get_by_id_opl($ID_OPL); // if 0000-00-00 set tu empty for datepicker compatibility
      	  echo json_encode($data);
	}

	public function ajax_update()
	{
	    $no_registrasi = $this->model_koordinator->get_no_register();
	    $data = array(
	        'no_registrasi' => $no_registrasi,
	        'status' => 'c',
	      );
	    $jml = $this->model_koordinator->get_by_id($this->input->post('ID_IMPROVEMENT'));
	    $count_jml = count($jml);
	    $poin_ss = round(1/$count_jml,1);
	    $data2 = array(
	        'no_registrasi' => $no_registrasi,
	        'POIN_REG' => $poin_ss,
	      );
	    $this->model_koordinator->update(array('ID_IMPROVEMENT' => $this->input->post('ID_IMPROVEMENT')), $data);
	    $this->model_koordinator->update2(array('PID_FLAG' => $this->input->post('ID_IMPROVEMENT')), $data2);
	    echo json_encode(array("status" => TRUE));
	}

	public function ajax_reject_ss()
	{
	    $data = array(
	        'REJECT' => $this->input->post('REJECT'),
	        'status' => 'r',
	      );
	    $this->model_koordinator->update(array('ID_IMPROVEMENT' => $this->input->post('ID_IMPROVEMENT')), $data);
	    echo json_encode(array("status" => TRUE));
	}

	public function logout() {
		$this->session->unset_userdata('nik_karyawan');
		$this->session->unset_userdata('level');
		$this->session->sess_destroy();
		redirect('c_dashboard');
	}

	public function ajax_update_opl_coordinator()
    {
    $no_opl = $this->model_koordinator->get_no_opl();
    $dataopl = array(
        'no_opl' => $no_opl,
        'status' => 'd',
    );
    
    $this->model_koordinator->updateopl(array('id_opl' => $this->input->post('id_opl')), $dataopl);
    echo json_encode(array("status" => TRUE));
    }

    public function ajax_reject_opl_coordinator()
    {
    $dataopl = array(
        'status' => 'r',
      );
    $this->model_koordinator->updateopl(array('id_opl' => $this->input->post('id_opl')), $dataopl);
    echo json_encode(array("status" => TRUE));
    }

    public function ajax_coordinator_opl($ID_OPL)
    {
      $data = $this->model_koordinator->get_by_id_opl($ID_OPL); // if 0000-00-00 set tu empty for datepicker compatibility
      echo json_encode($data);
    }

}
?>