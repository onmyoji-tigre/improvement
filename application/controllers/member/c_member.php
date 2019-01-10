<?php
session_start();
class C_member extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('nik_karyawan')=="") {
			redirect('auth');
		}
		$this->load->helper('text');
		$this->load->model('model_registrasi');
		$this->load->model('model_opl');
		$this->db2 = $this->load->database('db2', TRUE);
	}

	public function index() {
		$data['sum_register'] = $this->model_registrasi->sum_register();
		$data['count'] = $this->model_registrasi->count();
		$data['count_opl'] = $this->model_registrasi->count_opl();
		$data['nik_karyawan'] = $this->session->userdata('nik_karyawan');
		$data['nama_karyawan'] = $this->session->userdata('nama_karyawan');
		$this->load->view('member/index', $data);
	}

	public function registration() {
		$level = $this->session->userdata('level');
		if($level == 6) 
		{
			$data['nik_karyawan']  = $this->session->userdata('nik_karyawan');
			$data['nama_karyawan'] = $this->session->userdata('nama_karyawan');
			$data['id_dept']       = $this->session->userdata('id_dept');
			$data['id_subdept']    = $this->session->userdata('id_subdept');
			$data['koordinator']   = $this->model_registrasi->getKoordinator();
			$data['approver']      = $this->model_registrasi->getApprover();
			$data['employee']      = $this->model_registrasi->getEmployee();
			$data['line_proses']   = $this->model_registrasi->getLineProses();
			$this->load->view('member/registration', $data);
		}
		else
		{
			echo "Anda tidak mempunyai akses ke Halaman ini!";
		}
	}

	public function list_registration() {
		$data['list_data_ss'] = $this->model_registrasi->list_data_ss();
		$data['koordinator']  = $this->model_registrasi->getKoordinator();
		$this->load->view('member/data_registration_ss',$data);
	}

	public function list_koreksi_ss() {
		$data['list_koreksi_ss'] = $this->model_registrasi->list_koreksi_ss();
		$this->load->view('member/data_koreksi_ss',$data);
	}

	public function list_koreksi_opl() {
		$data['list_koreksi_opl'] = $this->model_registrasi->list_koreksi_opl();
		$this->load->view('member/data_koreksi_opl',$data);
	}

	public function save() {
		$maxid['max_id']    = $this->model_registrasi->getPID();
	    $nik_karyawan 		= array_filter($this->input->post('nik_karyawan'),'strlen');
	    $nama_karyawan 		= array_filter($this->input->post('nama_karyawan'),'strlen');
	  	$tema 				= $this->input->post('tema');
	  	$lat_belakang 		= $this->input->post('latar_belakang');
	  	$usulan_perbaikan 	= $this->input->post('usulan_perbaikan');
	  	$target 			= $this->input->post('target_manfaat');
	  	$penyelesaian 		= $this->input->post('tgl_penyelesaian');
	  	$alat_bahan 		= $this->input->post('alat_bahan');
	  	$biaya 				= $this->input->post('biaya');
	  	$nowr 				= $this->input->post('no_wr');
	  	$koordinator 		= $this->input->post('koordinator');
	  	$approver 			= $this->input->post('approver');
	  	$line_proses 		= $this->input->post('line_proses');
	  	$area_mesin 		= $this->input->post('area_mesin');
	  	$jenis_mesin 		= $this->input->post('jenis_mesin');
	  	$tahun 				= date('Y');
	  	$jumlah_orang		= count($nik_karyawan);
	  	$urutan 			= array_keys($nik_karyawan);


 
		$data = array(
					'NIK_KARYAWAN' 		=> $this->session->userdata('nik_karyawan'),
					'DEPT_PENGUSUL' 	=> $this->session->userdata('id_dept'),
					'TGL_USUL' 			=> date('Y-m-d'),
					'TEMA' 				=> $tema,
					'LATAR_BELAKANG' 	=> $lat_belakang,
					'PERBAIKAN' 		=> $usulan_perbaikan,
					'MANFAAT' 			=> $target,
					'PENYELESAIAN' 		=> $penyelesaian,
					'ALAT_BAHAN' 		=> $alat_bahan,
					'BIAYA' 			=> $biaya,
					'NO_WR' 			=> $nowr,
					'KOORDINATOR' 		=> preg_replace("/[^0-9]/", '', $koordinator),
					'APPROVER' 			=> preg_replace("/[^0-9]/", '', $approver),
					'LINE_PROSES'		=> $line_proses,
					'AREA_MESIN'		=> $area_mesin,
					'JENIS_MESIN'		=> $jenis_mesin,
					'STATUS' 			=> 'p',
					'OPL' 				=> 0,
		);
		
		$this->model_registrasi->proses_data($data);
	
		for($i=0;$i<$jumlah_orang;$i++)
	    {
	        
	        $data_detail = array(
					'NO_REGISTRASI'		=> "",
					'NIK_KARYAWAN' 		=> $nik_karyawan[$i],
					'NAMA_KARYAWAN'		=> $nama_karyawan[$i],
					'ID_DEPT' 		    => $this->session->userdata('id_dept')[$i],
					'PID_FLAG' 			=> $maxid['max_id'],
					'TAHUN'				=> $tahun,
					'URUTAN'			=> $i
				);
	    //var_dump($nik_karyawan);die();
	    $this->model_registrasi->proses_data_detail($data_detail);
		}
		redirect("member/c_member/list_registration");
	}

	function save_opl(){
	  	 $this->load->helper('compress');
	     $maxid['max_id']   	= $this->model_opl->getPID();
	     $no_registrasi     	= $this->input->post('NO_REGISTRASI');
	     $tema    	 	   	  	= $this->input->post('TEMA');              
	     $perbaikan    	   	  	= $this->input->post('PERBAIKAN');
	     $koordinator       	= $this->input->post('koordinator');
	     $approver          	= $this->input->post('nik_approver');

	     $acak				  	= rand(1,99);
	     $no_ss 		  	    = str_replace('/','-',$no_registrasi);
	     $lokasi_file_before    = $_FILES['beforeimage']['tmp_name'];
	     $tipe_file_before      = $_FILES['beforeimage']['type'];
	     $nama_file_before      = $_FILES['beforeimage']['name'];
	     $image_before          = $acak.'2_'.$no_ss.'_'.$nama_file_before;
	     $pathbefore            = pathinfo($nama_file_before,PATHINFO_EXTENSION);
	     
	     $lokasi_file_after     = $_FILES['afterimage']['tmp_name'];
	     $tipe_file_after       = $_FILES['afterimage']['type'];
	     $nama_file_after       = $_FILES['afterimage']['name'];
	     $image_after           = $acak.'1_'.$no_ss.'_'.$nama_file_after;
	     $pathafter             = pathinfo($nama_file_after,PATHINFO_EXTENSION);

	     $compressed = compress_image($lokasi_file_before,'assets/foto_opl/'.$image_before, 20);
	     $compressed = compress_image($lokasi_file_after,'assets/foto_opl/'.$image_after,20);

	     $bq					  = $this->input->post('bq');
	     $bc				      = $this->input->post('bc');
	     $bd					  = $this->input->post('bd');
	     $bs 			  	      = $this->input->post('bs');
	     $bm 					  = $this->input->post('bm');
	     $be 					  = $this->input->post('be');
	     $aq 					  = $this->input->post('aq');
	     $ac 					  = $this->input->post('ac');
	     $ad 					  = $this->input->post('ad');
	     $as 				      = $this->input->post('as');
	     $am 				      = $this->input->post('am');
	     $ae 					  = $this->input->post('ae');
	     $keterangan_before	  	  = $this->input->post('keterangan_before');
	     $keterangan_after	  	  = $this->input->post('keterangan_after');
	     $ID_IMPROVEMENT	  	  = $this->input->post('ID_IMPROVEMENT');
	     $pengusulopl 		  	  = $this->model_opl->get_by_nik($ID_IMPROVEMENT);
	     $jumlah_orang		  	  = count($pengusulopl);

   	  		if($tema != 'MORAL')
			{
			   $poin_ss=round(2/$jumlah_orang,1);
			}
			else
			{
			   $poin_ss=round(1/$jumlah_orang,1);
			}
      $data = array(
      	  'no_registrasi'		=> $no_registrasi,
          'TGL_OPL'        		=> date('Y-m-d'),
          'TEMA'           		=> $tema,
          'PERBAIKAN'      		=> $perbaikan,
          'STATUS'         		=> 'a',
          'bq'			   		=> $bq,
  		  'bc'			   		=> $bc,
  		  'bd'			   		=> $bd,
  		  'bs' 			  	 	=> $bs,
  		  'bm' 			   		=> $bm,
  		  'be' 			   		=> $be,
  		  'aq' 			   		=> $aq,
  		  'ac' 			   		=> $ac,
  		  'ad' 			   		=> $ad,
  		  'a_s' 			   	=> $as,
  		  'am' 			   		=> $am,
  		  'ae' 			   		=> $ae,
  		  'keterangan_before' 	=> $keterangan_before,
  		  'keterangan_after' 	=> $keterangan_after,
  		  'updated'		   		=> 0,
  		  'nik_koordinator'    	=> preg_replace("/[^0-9]/", '', $koordinator),
          'nik_approver'       	=> preg_replace("/[^0-9]/", '', $approver),
          'image_before'		=> $image_before,
          'image_after'			=> $image_after,
          );
      //var_dump($compressed);
      $this->model_opl->proses_opl($data);
      $datax 	= array();
      $tahun 	= date('Y');
      $urutan 	= array_keys($pengusulopl);

      for($i=0;$i<$jumlah_orang;$i++)
      {
	      $datax[] = array(
	            'nik_pengusul'    	=> $pengusulopl[$i]['NIK'],
	            'NO_REGISTRASI'   	=> $pengusulopl[$i]['NO_REGISTRASI'],
	            'tahun'				=> $tahun,
	            'urutan'			=> $urutan[$i],
	            'poin_ss'			=> $poin_ss
	      );
  	  }

  	
  	//var_dump($urutan);die();
      $this->db->insert_batch('ira_data_opl_pengusul', $datax);
      $this->update_opl();
      redirect("member/c_member/list_registration");
      
   }

   public function update_opl()
	{
	   $data = array(
	     'OPL' => 1,
	   );
	   $this->model_opl->update(array('ID_IMPROVEMENT' => $this->input->post('ID_IMPROVEMENT')), $data);
	   echo json_encode(array("status" => TRUE));
	}

	Public function getAreamesin(){
		$id=$this->input->post('id');
		$data=$this->model_registrasi->areamesin($id);
		echo json_encode($data);
	}

	Public function getJenismesin(){
		$idjenis=$this->input->post('idjenis');
		$data=$this->model_registrasi->jenismesin($idjenis);
		echo json_encode($data);
	}

	public function logout() {
		$this->session->unset_userdata('nik_karyawan');
		$this->session->unset_userdata('level');
		$this->session->sess_destroy();
		redirect('c_dashboard');
	}

	public function ajax_list_correction()
	{
	     $list = $this->model_registrasi->get_datatables_correction();
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
	                "recordsTotal" => $this->model_registrasi->count_all(),
	                "recordsFiltered" => $this->model_registrasi->count_filtered(),
	                "data" => $data,
	            );
	        //output to json format
	        echo json_encode($output);
	}

	public function ajax_list_correction_opl()
	{
	     $list = $this->model_registrasi->get_datatables_correction_opl();
	        $data = array();
	        $no = $_POST['start'];
	        foreach ($list as $person) {
	          $no++;
	          $row = array();
	          $row[] = $person->no_registrasi;
	          $row[] = $person->perbaikan;
	          $row[] = $person->tema;

	          //add html for action
	          $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Accept" onclick="edit_person_opl('."'".$person->ID_OPL."'".')"><i class="glyphicon glyphicon-pencil"></i> Show</a>';
	        
	          $data[] = $row;
	        }

	        $output = array(
	                "draw" => $_POST['draw'],
	                "recordsTotal" => $this->model_registrasi->count_all_opl(),
	                "recordsFiltered" => $this->model_registrasi->count_filtered_opl(),
	                "data" => $data,
	            );
	        //output to json format
	        echo json_encode($output);
	}

	public function ajax_correction_update()
	{
	    $data = array(
	        'STATUS' => 'p',
	        'LATAR_BELAKANG' => $this->input->post('LATAR_BELAKANG'),
	        'PERBAIKAN' => $this->input->post('PERBAIKAN'),
	        'MANFAAT' => $this->input->post('MANFAAT'),
	      );
	    $this->model_registrasi->update(array('ID_IMPROVEMENT' => $this->input->post('ID_IMPROVEMENT')), $data);
	    echo json_encode(array("status" => TRUE));
	}

	public function ajax_edit($id)
	{
	    $data = $this->model_registrasi->get_by_id($id); // if 0000-00-00 set tu empty for datepicker compatibility
	    echo json_encode($data);
	}

	public function ajax_approve_opl($ID_OPL)
	{
	    $data = $this->model_opl->get_by_id_opl($ID_OPL); // if 0000-00-00 set tu empty for datepicker compatibility
	    echo json_encode($data);
	}

	public function ajax_correctionopl_update()
	{
	    $data = array(
	        'STATUS' => 'a',
	        'LATAR_BELAKANG' => $this->input->post('LATAR_BELAKANG'),
	        'PERBAIKAN' => $this->input->post('PERBAIKAN'),
	        'MANFAAT' => $this->input->post('MANFAAT'),
	      );
	    $this->model_registrasi->update(array('ID_IMPROVEMENT' => $this->input->post('ID_IMPROVEMENT')), $data);
	    echo json_encode(array("status" => TRUE));
	}
}
?>