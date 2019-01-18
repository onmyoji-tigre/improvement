<?php
session_start();
class C_admin extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('nik_karyawan')=="") {
			redirect('auth');
		}
		$this->load->helper('text');
	}
	public function index() {
		$data['nik_karyawan'] = $this->session->userdata('nik_karyawan');
		$data['nama_karyawan'] = $this->session->userdata('nama_karyawan');
		$this->load->view('admin/index', $data);
	}

	public function logout() {
		$this->session->unset_userdata('nik_karyawan');
		$this->session->unset_userdata('level');
		$this->session->session_destroy();
		redirect('auth');
	}
}
?>