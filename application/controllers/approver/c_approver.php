<?php
session_start();
class C_approver extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('nik_karyawan')=="") {
			redirect('auth');
		}
		$this->load->helper('text');
		$this->load->model('model_approver');
	}

	public function index() {
		$data['count'] = $this->model_approver->count();
		$data['count_jml_opl'] = $this->model_approver->count_jml_opl();
		$data['nik_karyawan'] = $this->session->userdata('nik_karyawan');
		$data['nama_karyawan'] = $this->session->userdata('nama_karyawan');
		$this->load->view('approver/index', $data);
	}

	public function inbox_ss() {
		$this->load->view('approver/v_inbox_ss');
	}

	public function inbox_opl() {
		$this->load->view('approver/v_inbox_opl');
	}

	public function ajax_list()
	{
	     $list = $this->model_approver->get_datatables();
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
	          $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Accept" onclick="edit_person('."'".$person->ID_IMPROVEMENT."'".')"><i class="glyphicon glyphicon-pencil"></i> Show</a>';
	        
	          $data[] = $row;
	        }

	        $output = array(
	                "draw" => $_POST['draw'],
	                "recordsTotal" => $this->model_approver->count_all(),
	                "recordsFiltered" => $this->model_approver->count_filtered(),
	                "data" => $data,
	            );
	        //output to json format
	        echo json_encode($output);
	}

	public function ajax_edit($id)
	{
	      $data = $this->model_approver->get_by_id($id); // if 0000-00-00 set tu empty for datepicker compatibility
	      echo json_encode($data);
	}

	public function ajax_update()
	{
	    $data = array(
	        'status' => 'a',
	      );
	    $this->model_approver->update(array('ID_IMPROVEMENT' => $this->input->post('ID_IMPROVEMENT')), $data);
	    echo json_encode(array("status" => TRUE));
	}

	public function ajax_koreksi()
	{
	    $data = array(
	        'KOREKSI' => $this->input->post('KOREKSI'),
	        'status' => 'b',
	      );
	    $this->model_approver->update(array('ID_IMPROVEMENT' => $this->input->post('ID_IMPROVEMENT')), $data);
	    echo json_encode(array("status" => TRUE));
	}

	public function ajax_reject_approver()
	{
	    $data = array(
	        'REJECT' => $this->input->post('REJECT'),
	        'status' => 'j',
	      );
	    $this->model_approver->update(array('ID_IMPROVEMENT' => $this->input->post('ID_IMPROVEMENT')), $data);
	    echo json_encode(array("status" => TRUE));
	}

	public function logout() {
		$this->session->unset_userdata('nik_karyawan');
		$this->session->unset_userdata('level');
		$this->session->sess_destroy();
		redirect('c_dashboard');
	}

	public function ajax_list_opl()
	{
	     $list = $this->model_approver->get_datatables_opl();
	        $data = array();
	        $no = $_POST['start'];
	        foreach ($list as $person) {
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
	                "recordsTotal" => $this->model_approver->count_opl(),
	                "recordsFiltered" => $this->model_approver->count_filteredopl(),
	                "data" => $data,
	            );
	        //output to json format
	        echo json_encode($output);
	}

	public function ajax_approve_opl($ID_OPL)
  	{
      $data = $this->model_approver->get_by_id_opl($ID_OPL); // if 0000-00-00 set tu empty for datepicker compatibility
      echo json_encode($data);
    }

    public function ajax_update_opl()
  	{

    $dataopl = array(
        'status' => 'c',
      );
    $this->model_approver->updateopl(array('id_opl' => $this->input->post('id_opl')), $dataopl);
    echo json_encode(array("status" => TRUE));
    }

    public function ajax_koreksi_opl()
    {
    $dataopl = array(
        'koreksi' => $this->input->post('KOREKSI'),
        'status' => 'b',
    );

	}

	

}
?>