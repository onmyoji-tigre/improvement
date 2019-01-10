<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index() {
		$this->load->view('index');
	}

	public function cek_login() {
		$data = array('NIK_KARYAWAN' => $this->input->post('username', TRUE),
					  'PASSWORD' => $this->input->post('password', TRUE)
			);
		$this->load->model('model_user'); // load model_user
		$hasil = $this->model_user->cek_user($data);
		if ($hasil->num_rows() == 1) {
			foreach ($hasil->result() as $sess) {
				$sess_data['logged_in'] 		= 'Sudah Loggin';
				$sess_data['uid'] 				= $sess->ID_KARYAWAN;
				$sess_data['nik_karyawan'] 		= $sess->NIK_KARYAWAN;
				$sess_data['nama_karyawan'] 	= $sess->NAMA_KARYAWAN;
				$sess_data['level'] 			= $sess->ID_LEVEL;
				$sess_data['id_dept']			= $sess->ID_DEPT;
				$sess_data['id_subdept'] 		= $sess->ID_SUBDEPT;
				$sess_data['id_cg'] 			= $sess->ID_CG;
				$sess_data['password'] 			= $sess->PASSWORD;
				$this->session->set_userdata($sess_data);
			}
			if ($this->session->userdata('level')=='1') {
				redirect('admin/c_admin');
			}
			elseif ($this->session->userdata('level')=='2') {
				redirect('approver/c_approver');
			}
			elseif ($this->session->userdata('level')=='3') {
				redirect('koordinator/c_koordinator');
			}
			elseif ($this->session->userdata('level')=='6') {
				redirect('member/c_member');
			}		
				
		}
		else {
			echo "<script>alert('Gagal login: Cek username, password!');history.go(-1);</script>";
		}
	}

}

?>