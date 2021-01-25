<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Import_excel extends CI_Controller {

	public $nama_tabel = 'data';

	public function __construct()
	{
		parent::__construct();
		$this->load->library("PHPExcel");
		$this->load->model("m_guru");
		$this->load->model("phpexcel_model");
		if($this->session->userdata('status') != "guru")
		{
			redirect('login');
		}
	}
	//insert data nilai
	public function do_importin_nilai_siswa(){
		$config['upload_path'] = './assets/file_import/';

        $config['allowed_types'] = 'xls|xlsx';
		
		$this->load->library('upload', $config);
			$this->upload->initialize($config);
		
		if (!$this->upload->do_upload()){

			$this->setmessage($this->upload->display_errors(),'warning');
			redirect($this->input->post('back_url'));
		}
		else{
			$post = $this->input->post();
			$data = array('upload_data' => $this->upload->data());
            $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
            $filename = $upload_data['file_name'];
            $this->phpexcel_model->importin_nilai_siswa($filename,$post['id_pelajaran'],$post['id_kelas'],$post['id_guru'],$post['semester'],$post['tahun']);
            unlink('./assets/file_import/'.$filename);

            $this->setmessage('Import nilai siswa berhasil dilakukan!','success');
            redirect($this->input->post('back_url'),'refresh');
		}
	}

	//update data nilai
	public function do_importup_nilai_siswa(){
		$config['upload_path'] = './assets/file_import/';

        $config['allowed_types'] = 'xls|xlsx';
		
		$this->load->library('upload', $config);
			$this->upload->initialize($config);
		
		if (!$this->upload->do_upload()){

			$this->setmessage($this->upload->display_errors(),'warning');
			redirect($this->input->post('back_url'));
		}
		else{
			$post = $this->input->post();
			$data = array('upload_data' => $this->upload->data());
            $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
            $filename = $upload_data['file_name'];
            $this->phpexcel_model->importup_nilai_siswa($filename,$post['id_pelajaran'],$post['id_kelas'],$post['id_guru'],$post['semester'],$post['tahun']);
            unlink('./assets/file_import/'.$filename);

            $this->setmessage('Import nilai siswa berhasil dilakukan!','success');
            redirect($this->input->post('back_url'),'refresh');
		}
	}

	//update data deskripsi
	public function do_importup_deskripsi(){
		$config['upload_path'] = './assets/file_import/';

        $config['allowed_types'] = 'xls|xlsx';
		
		$this->load->library('upload', $config);
			$this->upload->initialize($config);
		
		if (!$this->upload->do_upload()){

			$this->setmessage($this->upload->display_errors(),'warning');
			redirect($this->input->post('back_url'));
		}
		else{
			$post = $this->input->post();
			$data = array('upload_data' => $this->upload->data());
            $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
            $filename = $upload_data['file_name'];
            $this->phpexcel_model->importup_deskripsi($filename,$post['id_pelajaran'],$post['id_kelas'],$post['id_guru'],$post['semester'],$post['tahun']);
            unlink('./assets/file_import/'.$filename);

            $this->setmessage('Import deskripsi pengetahuan dan ketrampilan berhasil dilakukan!','success');
            redirect($this->input->post('back_url'),'refresh');
		}
	}

	//insert data nilai sikap
	public function do_importin_sikap(){
		$config['upload_path'] = './assets/file_import/';

        $config['allowed_types'] = 'xls|xlsx';
		
		$this->load->library('upload', $config);
			$this->upload->initialize($config);
		
		if (!$this->upload->do_upload()){

			$this->setmessage($this->upload->display_errors(),'warning');
			redirect($this->input->post('back_url'));
		}
		else{
			$post = $this->input->post();
			$data = array('upload_data' => $this->upload->data());
            $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
            $filename = $upload_data['file_name'];
            $this->phpexcel_model->importin_nilai_sikap($filename,$post['id_kelas'],$post['id_wali'],$post['semester'],$post['tahun']);
            unlink('./assets/file_import/'.$filename);

            $this->setmessage('Import nilai siswa berhasil dilakukan!','success');
            redirect($this->input->post('back_url'),'refresh');
		}
	}
	//update
	public function do_importup_sikap(){
		$config['upload_path'] = './assets/file_import/';

        $config['allowed_types'] = 'xls|xlsx';
		
		$this->load->library('upload', $config);
			$this->upload->initialize($config);
		
		if (!$this->upload->do_upload()){

			$this->setmessage($this->upload->display_errors(),'warning');
			redirect($this->input->post('back_url'));
		}
		else{
			$post = $this->input->post();
			$data = array('upload_data' => $this->upload->data());
            $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
            $filename = $upload_data['file_name'];
            $this->phpexcel_model->importup_nilai_sikap($filename,$post['id_kelas'],$post['id_wali'],$post['semester'],$post['tahun']);
            unlink('./assets/file_import/'.$filename);

            $this->setmessage('Import nilai sikap berhasil dilakukan!','success');
            redirect($this->input->post('back_url'),'refresh');
		}
	}
	
    public function setmessage($message,$label)
	{
		if($label=='success'){
			$alert = 'success';
			$txt = '<h4><i class="fa fa-check-circle"></i> SUKSES!</h4>';
		}elseif($label=='warning'){
			$alert = 'warning';
			$txt = '<h4><i class="fa fa-warning"></i> TERJADI KESALAHAN!</h4>';
		}else{
			$alert = 'danger';
			$txt = '<h4><i class="fa fa-ban"></i> PROSES GAGAL!</h4>';
		}
		$this->session->set_flashdata('notif','<div class="alert alert-'.$alert.' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> '.$txt.$message.'</div>');
	}

}

/* End of file Phpexcel.php */
/* Location: ./application/controllers/Phpexcel.php */