<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('m_login');
		$this->load->model('m_guru');
	}

	function index(){
		/*
		| Cek status session
		| Alihkan jika session status tidak kosong
		*/
		$check = $this->session->userdata('status');
		if($check=="guru")
		{
			redirect('guru');
		}
		if($check=="admin")
		{
			redirect('admin');
		}

		/*
		| Load tampilan form login.
		*/
		
		$data['infosekolah'] = $this->m_login->select_dataFrom('info_sekolah')->row();
		$data['']="";
		// $this->load->view('v_sino_login',$data);
		$this->load->view('head');
		$this->load->view('login');
		$this->load->view('footer');
	}

	/*
	| Proses Login
	*/

	function aksi_login(){
		$level = $this->input->post('level');
		
		if($level=='admin')
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$where = array(
				'username' => $username,
				'password' => md5($password)
			);

			$cek = $this->m_login->cek_login('user_admin',$where)->num_rows();
			$row = $this->m_login->cek_login('user_admin',$where)->row();

			if($cek > 0){

				$data_session = array(
					'id' => $row->id_admin,
					'nama' => $username,
					'status' => "admin",
					'waktu' => date('d-m-Y H:i:s')
					);
				$this->session->set_userdata($data_session);

				redirect('admin');
			}else{

				$this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Username atau Password tidak sah.</div>');
				redirect('login');

			}
		}

		if($level=='guru')
		{
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$where = array(
				'username' => $username,
				'password' => md5($password)
			);

			$cek = $this->m_login->cek_login('data_guru',$where)->num_rows();
			$row = $this->m_login->cek_login('data_guru',$where)->row();

			if($cek > 0){

				$data_session = array(
					'id' => $row->id_guru,
					'nama' => $row->nama_guru,
					'status' => "guru",
					'waktu' => date('d-m-Y H:i:s')
					);
				$this->session->set_userdata($data_session);

				redirect('guru?m=dashboard');
			}else{

				$this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Username atau Password tidak sah. </div>');
				redirect('login');

			}
		}

		if($level=="orangtua"){
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$where = array(
				'username' => $username,
				'password' => md5($password)
			);

			$cek = $this->m_login->cek_login('data_siswa',$where)->num_rows();
			$row = $this->m_login->cek_login('data_siswa',$where)->row();

			if($cek > 0){

				$data_session = array(
					'id' => $row->id_siswa,
					'nama' => $row->nama_siswa,
					'status' => "orang_tua",
					'waktu' => date('d-m-Y H:i:s')
					);
				$this->session->set_userdata($data_session);

				redirect('ortu');
			}else{

				$this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Username atau Password tidak sah. </div>');
				redirect('login');

			}
		}
		
	}

	function logout(){
		$this->session->sess_destroy();
		redirect('login');
	}

}

/* end of file login.php */
/* location: .../application/controller/login.php */
