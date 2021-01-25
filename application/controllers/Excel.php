<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Excel extends CI_Controller {

	public $nama_tabel = 'data';

	public function __construct()
	{
		parent::__construct();
		$this->load->library("PHPExcel");
		$this->load->model("m_admin");
		$this->load->model("phpexcel_model");
		if($this->session->userdata('status') != "admin")
		{
			redirect('login');
		}
	}


	public function do_upload_siswa(){
		$config['upload_path'] = './assets/file_import/';

        $config['allowed_types'] = 'xls|xlsx';
		
		$this->load->library('upload', $config);
			$this->upload->initialize($config);
		
		if ( ! $this->upload->do_upload()){

			$this->setmessage($this->upload->display_errors(),'warning');
			redirect('admin/data_siswa/?m=data_induk&sm=data_siswa','refresh');
		}
		else{
			$data = array('upload_data' => $this->upload->data());
            $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
            $filename = $upload_data['file_name'];
            $this->phpexcel_model->upload_data_siswa($filename);
            unlink('./assets/file_import/'.$filename);

            $this->setmessage('Import data siswa berhasil!','success');
            redirect('admin/data_siswa/?m=data_induk&sm=data_siswa','refresh');
		}
	}

	public function do_upload_guru(){
		$config['upload_path'] = './assets/file_import/';

        $config['allowed_types'] = 'xls|xlsx';
		
		$this->load->library('upload', $config);
			$this->upload->initialize($config);
		
		if ( ! $this->upload->do_upload()){

			$this->setmessage($this->upload->display_errors(),'warning');
			redirect('admin/data_guru/?m=data_induk&sm=data_guru','refresh');
		}
		else{
			$data = array('upload_data' => $this->upload->data());
            $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
            $filename = $upload_data['file_name'];
            $this->phpexcel_model->upload_data_guru($filename);
            unlink('./assets/file_import/'.$filename);

            $this->setmessage('Import data guru berhasil!','success');
            redirect('admin/data_guru/?m=data_induk&sm=data_guru','refresh');
		}
	}


	public function export(){ 
            //membuat objek
            $objPHPExcel = new PHPExcel();
            $data = $this->db->get($this->nama_tabel);

            // Nama Field Baris Pertama
        	$fields = $data->list_fields();
        	$col = 0;
	        foreach ($fields as $field)
	        {
	            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
	            $col++;
	        }
	 
	        // Mengambil Data
	        $row = 2;
	        foreach($data->result() as $data)
	        {
	            $col = 0;
	            foreach ($fields as $field)
	            {
	                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
	                $col++;
	            }
	 
	            $row++;
	        }
	        $objPHPExcel->setActiveSheetIndex(0);

            //Set Title
            $objPHPExcel->getActiveSheet()->setTitle('Data Absen');
 
            //Save ke .xlsx, kalau ingin .xls, ubah 'Excel2007' menjadi 'Excel5'
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
 
            //Header
            header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            header("Cache-Control: no-store, no-cache, must-revalidate");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

            //Nama File
            header('Content-Disposition: attachment;filename="absen.xlsx"');

            //Download
            $objWriter->save("php://output");
 
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