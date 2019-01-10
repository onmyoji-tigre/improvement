<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Change_password extends CI_Controller {

public function __construct() {
        parent::__construct();
        if ($this->session->userdata('nik_karyawan')=="") {
            redirect('auth');
        }
        $this->load->helper('text');
        $this->load->library('form_validation');
        $this->load->model('model_user');
    }
   
public function ganti_password()
    {
        $username = $this->session->userdata('nik_karyawan');

        $this->form_validation->set_rules('pw_baru','password baru','required');
        $this->form_validation->set_rules('cpw_baru','password kedua','required|matches[pw_baru]');

        $this->form_validation->set_message('required','%s wajib diisi');

        $this->form_validation->set_error_delimiters('<p class="alert">','</p>');

        if( $this->form_validation->run() == FALSE ){
            $this->load->view('change_password');
        } else {
            $post = $this->input->post();
            
            $data = array(
                'PASSWORD' => $post['pw_baru'],
            );
			//var_dump($data);die();
            $this->model_user->update($username, $data, 'ira_mst_karyawan');
			redirect('approver/c_approver');
        }
    }
}

