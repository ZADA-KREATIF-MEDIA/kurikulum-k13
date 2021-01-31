<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cetak extends CI_Controller {

	/*
	| -----------------------------------------------------------------------
	| SINO 2018 - COPYRIGHTS - WATULINTANG.COM
	| DAFTAR PROGRAM PADA CLASS Cetak
	| -----------------------------------------------------------------------
	| 1) CETAK LAPORAN NILAI PER SISWA
	*/

	function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('m_admin');
		$this->load->model('m_guru');
		$this->load->model('m_cetak');
		$this->load->library('pagination');
		/*
		|-----------------------------------------------------
		|Periksa Session Login
		|------------------------------------------------------
		*/

		if($this->session->userdata('status') == ""){
			redirect('login');
		}
	}
	
	/*
	|=================================================================================
	| 1) CETAK LAPORAN NILAI PER SISWA
	|=================================================================================
	*/

	public function cetak_rapor()
	{
		$id_user = $this->session->userdata('id');

		//Filtering KKM::
		if(isset($_POST['sort_lap_nilai']))
		{
			//$per_hlm = $this->input->post('rows');
			$idkelas = $this->input->post('kelas');
			$where = array('id_tahun' => $this->input->post('tahun'));
			$setup_tahun = $this->m_admin->select_dataWhere($where,'setup_tahun')->row();
			$semester = $this->input->post('semester');
			//menyimpan data post ke session;
			$data = array(
				'ses_lapnilai_thn' => $this->input->post('tahun'),
				//'ses_lapnilai_rows' => $per_hlm,
				'ses_lapnilai_kelas' => $idkelas,
				'ses_lapnilai_sms' => $semester
			);
			$this->session->set_userdata($data);
		}
		elseif($this->session->userdata('ses_lapnilai_thn')!='' && $this->session->userdata('ses_lapnilai_sms')!='' && $this->session->userdata('ses_lapnilai_kelas')!='')
		{
			//$per_hlm = $this->session->userdata('ses_lapnilai_rows');
			$idkelas = $this->session->userdata('ses_lapnilai_kelas');
			$semester = $this->session->userdata('ses_lapnilai_sms');
			$where = array('id_tahun' => $this->session->userdata('ses_lapnilai_thn'));
			$setup_tahun = $this->m_admin->select_dataWhere($where,'setup_tahun')->row();
		}
		else
		{
			//Default:
			//$per_hlm = 5;
			
			$where = array('status_semester' => 1);
			$semester = $this->m_admin->select_dataWhere($where,'setup_semester')->row('id_semester'); 
						
			$where = array('status_aktif' => 1);
			$setup_tahun = $this->m_admin->select_dataWhere($where,'setup_tahun')->row();

			if($this->session->userdata('status')=="admin")
			{
				$idkelas=$this->m_admin->select_table_orderby('nama_kelas ASC','setup_kelas')->row('id_kelas');
			}
			elseif($this->session->userdata('status')=="guru")
			{
				$idkelas=$this->m_guru->get_kelas_walikelas($id_user,$setup_tahun->id_tahun)->row('id_kelas');
			}
		}
		//EndFiltering

		
		if($this->session->userdata('status')=="admin")
		{
			$where = array('id_admin' => $id_user);
			$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');
			$data['page_title'] = "<h1>Cetak Rapor</h1>";
			$data['kelas'] = $this->m_admin->select_table_orderby('nama_kelas ASC','setup_kelas');
			$data['tahun'] = $this->m_admin->select_table_orderby('tahun ASC','setup_tahun');
			$data['semester'] = $this->m_admin->select_table_orderby('id_semester ASC','setup_semester');
		}
		elseif($this->session->userdata('status')=="guru")
		{
			$where = array('id_guru' => $id_user);
			$data['user'] = $this->m_admin->select_dataWhere($where,'data_guru');
			$data['page_title'] = "<h1>Cetak Rapor</h1>";
			$data['kelas'] = $this->m_guru->get_kelas_walikelas($id_user,$setup_tahun->id_tahun);
			$data['tahun'] = $this->m_admin->select_dataWhere('status_aktif=1','setup_tahun');
			$data['semester'] = $this->m_admin->select_dataWhere('status_semester=1','setup_semester');
		}
		
		$data['rapor_siswa'] = $this->m_admin->laporan_nilai_siswa($idkelas,$setup_tahun->id_tahun,$semester);
		$data['pd_semester'] = $this->m_admin->select_dataWhere('id_semester='.$semester.'','setup_semester')->row('semester');
		$data['pd_tahun'] = $setup_tahun->tahun;
		
		$data['content'] = "admin/v_laporan_persiswa";

		if($this->session->userdata('status')=="admin")
		{
			$this->load->view('admin/index',$data);
		}else{
			$this->load->view('guru/index',$data);
		}
	}

	public function print_nilai_rapor()
	{
		$nis = $this->uri->segment(3);
		$idkelas = $this->uri->segment(4);
		$id_tahun = $this->uri->segment(5);
		$semester = $this->input->get('semester');
		$post = [
			'nis' 		=> $nis,
			'idkelas'	=> $idkelas,
			'id_tahun'	=> $id_tahun,
			'semester'	=> $semester
		];
		//refernsi:
		$data['sekolah'] = $this->m_cetak->get_data_sekolah();
		$data['siswa'] = $this->m_cetak->select_dataWhere('nis='.$nis.'','data_siswa');
		$data['tahun_ajaran'] = $this->m_cetak->select_dataWhere('id_tahun='.$id_tahun.'','setup_tahun')->row();
		$data['semester'] = $this->m_cetak->select_dataWhere('id_semester='.$semester.'','setup_semester')->row();
		$data['kelas'] = $this->m_cetak->select_dataWhere('id_kelas='.$idkelas.'','setup_kelas')->row();
		$kategori_kls = $data['kelas']->kategori_kls;
		//tbl_nilai,setup_pelajaran,tbl_kategori_mapel,data_siswa,setup_kelas
		$data['nilai_sikap'] = $this->m_cetak->get_nilai_sikap($nis,$idkelas,$id_tahun,$semester);
		$data['nilai_rapor'] = $this->m_cetak->get_nilai_rapor($nis,$idkelas,$id_tahun,$semester,$kategori_kls);
		$data['deskripsi_nilai'] = $this->m_cetak->get_deskripsi_nilai($nis,$idkelas,$id_tahun,$semester);
		$data['nilai_ekstra'] = $this->m_cetak->get_nilai_ekstra($nis,$idkelas,$id_tahun,$semester);
		$data['nilai_prestasi'] = $this->m_cetak->get_nilai_prestasi($nis,$idkelas,$id_tahun,$semester);
		$data['kehadiran'] = $this->m_cetak->get_kehadiran_siswa($nis,$idkelas,$id_tahun,$semester);
		$data['catatan_wk'] = $this->m_cetak->get_cttnwk($nis,$idkelas,$id_tahun,$semester);
		$data['wali_kelas'] = $this->m_cetak->get_wk_saat_ini($id_tahun,$idkelas)->row();
		$data['kepsek'] = $this->m_cetak->get_ref_kepsek($id_tahun,$semester)->row();
		$data['tinggi_berat'] = $this->m_cetak->get_tinggi_berat($post);
		// print('<pre>');print_r($data['tinggi_berat']);exit();
		$this->load->view('admin/cetak_rapor/v_hal_nilai_rapor',$data);
	}

	public function cetak_sampul()
	{
		$id_user = $this->session->userdata('id');
		//Filtering KKM::
		if(isset($_POST['sort_lap_nilai']))
		{
			//$per_hlm = $this->input->post('rows');
			$idkelas = $this->input->post('kelas');
			$where = array('id_tahun' => $this->input->post('tahun'));
			$setup_tahun = $this->m_admin->select_dataWhere($where,'setup_tahun')->row();
			$semester = $this->input->post('semester');
			//menyimpan data post ke session;
			$data = array(
				'ses_lapnilai_thn' => $this->input->post('tahun'),
				//'ses_lapnilai_rows' => $per_hlm,
				'ses_lapnilai_kelas' => $idkelas,
				'ses_lapnilai_sms' => $semester
			);
			$this->session->set_userdata($data);
		}
		elseif($this->session->userdata('ses_lapnilai_thn')!='' && $this->session->userdata('ses_lapnilai_sms')!='' && $this->session->userdata('ses_lapnilai_kelas')!='')
		{
			//$per_hlm = $this->session->userdata('ses_lapnilai_rows');
			$idkelas = $this->session->userdata('ses_lapnilai_kelas');
			$semester = $this->session->userdata('ses_lapnilai_sms');
			$where = array('id_tahun' => $this->session->userdata('ses_lapnilai_thn'));
			$setup_tahun = $this->m_admin->select_dataWhere($where,'setup_tahun')->row();
		}
		else
		{
			//Default:
			//$per_hlm = 5;
						
			$where = array('status_semester' => 1);
			$semester = $this->m_admin->select_dataWhere($where,'setup_semester')->row('id_semester'); 
						
			$where = array('status_aktif' => 1);
			$setup_tahun = $this->m_admin->select_dataWhere($where,'setup_tahun')->row();

			if($this->session->userdata('status')=="admin")
			{
				$idkelas=$this->m_admin->select_table_orderby('nama_kelas ASC','setup_kelas')->row('id_kelas');
			}
			elseif($this->session->userdata('status')=="guru")
			{
				$idkelas=$this->m_guru->get_kelas_walikelas($id_user,$setup_tahun->id_tahun)->row('id_kelas');
			}
		}
		//EndFiltering

		if($this->uri->segment(3)=="depan")
		{
			$data['halaman'] = "depan";
		}
		if($this->uri->segment(3)=="identitas")
		{
			$data['halaman'] = "identitas";
		}

		if($this->session->userdata('status')=="admin")
		{
			$where = array('id_admin' => $id_user);
			$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');
			$data['page_title'] = "<h1>Cetak Sampul</h1>";
			$data['kelas'] = $this->m_admin->select_table_orderby('nama_kelas ASC','setup_kelas');
			$data['tahun'] = $this->m_admin->select_table_orderby('tahun ASC','setup_tahun');
			$data['semester'] = $this->m_admin->select_table_orderby('id_semester ASC','setup_semester');
		}
		elseif($this->session->userdata('status')=="guru")
		{
			$where = array('id_guru' => $id_user);
			$data['user'] = $this->m_admin->select_dataWhere($where,'data_guru');
			$data['page_title'] = "<h1>Cetak Sampul</h1>";
			$data['kelas'] = $this->m_guru->get_kelas_walikelas($id_user,$setup_tahun->id_tahun);
			$data['tahun'] = $this->m_admin->select_dataWhere('status_aktif=1','setup_tahun');
			$data['semester'] = $this->m_admin->select_dataWhere('status_semester=1','setup_semester');
		}

		
		$data['rapor_siswa'] = $this->m_admin->laporan_nilai_siswa($idkelas,$setup_tahun->id_tahun,$semester);
		$data['pd_semester'] = $this->m_admin->select_dataWhere('id_semester='.$semester.'','setup_semester')->row('semester');
		$data['pd_tahun'] = $setup_tahun->tahun;
		
		$data['content'] = "admin/v_cetak_sampul";
		if($this->session->userdata('status')=="admin")
		{
			$this->load->view('admin/index',$data);
		}
		elseif($this->session->userdata('status')=="guru")
		{
			$this->load->view('guru/index',$data);
		}
	}

	public function sampul_depan()
	{
		//data_sekolah
		$data['identitas_sekolah'] = $this->m_cetak->get_data_sekolah();
		//identitas_siswa
		$nis = $this->uri->segment(3);
		$data['identitas_siswa'] = $this->m_cetak->get_data_siswa($nis);
		$ta_masuk = $data['identitas_siswa']->row('tahun_ajaran');
		$where = array('tahun' => $ta_masuk);
		$get_id_tahun = $this->m_admin->select_dataWhere($where,'setup_tahun')->row('id_tahun');
		//untuk ttd sampul rapor id_semester fixed semester Ganjil/1
		$id_semester = 1;
		$data['kepsek'] = $this->m_cetak->get_ttd_kepsek_sampul($get_id_tahun,$id_semester);
		
		$this->load->view('admin/cetak_rapor/v_hal_sampul_depan',$data);
	}

	public function identitas()
	{
		//data_sekolah
		$data['identitas_sekolah'] = $this->m_cetak->get_data_sekolah();
		//identitas_siswa
		$nis = $this->uri->segment(3);
		$data['identitas_siswa'] = $this->m_cetak->get_data_siswa($nis);
		$ta_masuk = $data['identitas_siswa']->row('tahun_ajaran');
		$where = array('tahun' => $ta_masuk);
		$get_id_tahun = $this->m_admin->select_dataWhere($where,'setup_tahun')->row('id_tahun');
		//untuk ttd sampul rapor id_semester fixed semester Ganjil/1
		$id_semester = 1;
		$data['kepsek'] = $this->m_cetak->get_ttd_kepsek_sampul($get_id_tahun,$id_semester);
		
		$this->load->view('admin/cetak_rapor/v_hal_sampul_identitas',$data);
	}

	public function legger_semua()
	{
		//Export Excel::
		if(isset($_POST['export_excel']))
		{
			header("Content-type:application/vnd-ms-excel");
			header("Content-Disposition:attachment; filename=laporan_legger_nilai.xls");


			$idkelas = $this->input->post('kelas');
			$where = array('id_tahun' => $this->input->post('tahun'));
			$setup_tahun = $this->m_admin->select_dataWhere($where,'setup_tahun')->row();
			$semester = $this->input->post('semester');

				//data_post
			$data['post_idkelas'] = $idkelas;
			$data['post_idtahun'] = $setup_tahun->id_tahun;
			$data['post_idsemester'] = $semester;

			//legger-list_siswa
			$data['list_siswa'] = $this->m_admin->get_list_siswa($idkelas,$setup_tahun->id_tahun);
			//legger-list_mapel
			//$data['list_mapel'] = $this->m_admin->select_table_orderby('id_pelajaran ASC','setup_pelajaran');
			//update:
			$data['list_mapel'] = $this->m_admin->get_list_mapel_sesuai($idkelas,$setup_tahun->id_tahun,$semester);


			$data['pd_semester'] = $this->m_admin->select_dataWhere('id_semester='.$semester.'','setup_semester')->row('semester');
			$data['pd_tahun'] = $setup_tahun->tahun;
			$data['nama_kelas'] = $this->m_admin->select_dataWhere('id_kelas='.$idkelas.'','setup_kelas')->row('nama_kelas');
			
			$this->load->view('admin/cetak_rapor/v_export_excel_legger',$data);

		}

		//------------------
		//Filtering KKM::
		if(isset($_POST['sort_legger']))
		{
			//$per_hlm = $this->input->post('rows');
			$idkelas = $this->input->post('kelas');
			$where = array('id_tahun' => $this->input->post('tahun'));
			$setup_tahun = $this->m_admin->select_dataWhere($where,'setup_tahun')->row();
			$semester = $this->input->post('semester');
			//menyimpan data post ke session;
			$data = array(
				'ses_legger_thn' => $this->input->post('tahun'),
				//'ses_lapnilai_rows' => $per_hlm,
				'ses_legger_kelas' => $idkelas,
				'ses_legger_sms' => $semester
			);
			$this->session->set_userdata($data);
		}
		elseif($this->session->userdata('ses_legger_thn')!='' && $this->session->userdata('ses_legger_sms')!='' && $this->session->userdata('ses_legger_kelas')!='')
		{
			//$per_hlm = $this->session->userdata('ses_lapnilai_rows');
			$idkelas = $this->session->userdata('ses_legger_kelas');
			$semester = $this->session->userdata('ses_legger_sms');
			$where = array('id_tahun' => $this->session->userdata('ses_legger_thn'));
			$setup_tahun = $this->m_admin->select_dataWhere($where,'setup_tahun')->row();
		}
		else
		{
			//Default:
			//$per_hlm = 5;
			$idkelas=$this->m_admin->select_table_orderby('nama_kelas ASC','setup_kelas')->row('id_kelas');
			
			$where = array('status_semester' => 1);
			$semester = $this->m_admin->select_dataWhere($where,'setup_semester')->row('id_semester'); 
						
			$where = array('status_aktif' => 1);
			$setup_tahun = $this->m_admin->select_dataWhere($where,'setup_tahun')->row();
		}
		//EndFiltering

		$id_admin = $this->session->userdata('id');
		$where = array('id_admin' => $id_admin);
		$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');
		$data['page_title'] = "<h1>Laporan Legger Semua Mapel</h1>";
		$data['kelas'] = $this->m_admin->select_table_orderby('nama_kelas ASC','setup_kelas');
		$data['tahun'] = $this->m_admin->select_table_orderby('tahun ASC','setup_tahun');
		$data['semester'] = $this->m_admin->select_table_orderby('id_semester ASC','setup_semester');
		//data_post
		$data['post_idkelas'] = $idkelas;
		$data['post_idtahun'] = $setup_tahun->id_tahun;
		$data['post_idsemester'] = $semester;

		//legger-list_siswa
		$data['list_siswa'] = $this->m_admin->get_list_siswa($idkelas,$setup_tahun->id_tahun);
		//legger-list_mapel pada semester, tahun, dan kelas yang sudah ditentukan...
		//lama: $data['list_mapel'] = $this->m_admin->select_table_orderby('id_pelajaran ASC','setup_pelajaran');
		//update:
		$data['list_mapel'] = $this->m_admin->get_list_mapel_sesuai($idkelas,$setup_tahun->id_tahun,$semester);



		$data['pd_semester'] = $this->m_admin->select_dataWhere('id_semester='.$semester.'','setup_semester')->row('semester');
		$data['pd_tahun'] = $setup_tahun->tahun;
		$data['nama_kelas'] = $this->m_admin->select_dataWhere('id_kelas='.$idkelas.'','setup_kelas')->row('nama_kelas');
		
		$data['content'] = "admin/v_legger";
		$this->load->view('admin/index',$data);
	}


}