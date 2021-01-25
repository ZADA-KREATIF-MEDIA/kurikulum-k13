<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru extends CI_Controller {

	/*
	| -----------------------------------------------------------------------
	| SINO 2018 - COPYRIGHTS - WATULINTANG.COM
	| DAFTAR ISI CLASS Guru
	| -----------------------------------------------------------------------
	| 1) DASHBOARD GURU
	| 2) SET PROFILE
	| 3) INPUT NILAI
	| 4) INPUT DESKRIPSI NILAI
	| 5) INPUT NILAI SIKAP (wali kelas)
	| 6) INPUT NILAI EKSTRA (wali kelas)
	| 7) INPUT PRESTASI SISWA (wali kelas)
	| 8) INPUT KEHADIRAN (wali kelas)
	| 9) INPUT CATATAN WALI KELAS (wali kelas)
	| 10) PELAPORAN - NILAI MAPEL YANG DIAMPU
	| 11) LEGGER SEMUA MAPEL (wali kelas))
	| 12) LEGGER SEMUA SISWA DIKELAS (wali kelas)

	*/

	function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->library("PHPExcel");
		$this->load->model("m_guru");
		$this->load->model("phpexcel_model");
		$this->load->model('m_admin');
		$this->load->model('m_cetak');
		$this->load->library('pagination');
		/*
		|-----------------------------------------------------
		|Periksa Session Login
		|------------------------------------------------------
		*/
		if($this->session->userdata('status') != "guru"){
			redirect('login');
		}

	}

	/*
	|=================================================================================
	| 1) DAHSBOARD GURU
	|=================================================================================
	*/

	public function index()
	{
		$id_guru = $this->session->userdata('id');
		$where = array('id_guru' => $id_guru);
		$data['user'] = $this->m_guru->select_dataWhere($where,'data_guru');
		$data['page_title'] = '';
		$id_thn_aktif = $this->m_guru->select_dataWhere('status_aktif=1','setup_tahun')->row('id_tahun');
		//CEK TYPE USER
		//GURU SAJA?
		$guru_saja = $this->m_guru->cek_guru_saja($id_guru,$id_thn_aktif)->num_rows();
		//WALI_KELAS
		$wali_kelas = $this->m_guru->cek_wali_kelas($id_guru,$id_thn_aktif)->num_rows();
		

		if($wali_kelas>0)
		{
			//public,guru,wali kelas
			$data['pengumuman'] = $this->m_guru->get_pengumuman_all();
		}
		elseif($guru_saja>0)
		{
			$data['pengumuman'] = $this->m_guru->get_pengumuman_guru();
		}
		else
		{
			$data['pengumuman'] = $this->m_guru->get_pengumuman_publik();	
		}
		
		$data['content_utama'] = "guru/content_dashboard";
		$data['content'] = "guru/v_dashboard";
		$this->load->view('guru/index',$data);

	}

	/*
	|=================================================================================
	| 2) HALAMAN
	|=================================================================================
	*/

	public function index_pgm()
	{
		$id_guru = $this->session->userdata('id');
		$where = array('id_guru' => $id_guru);
		$data['user'] = $this->m_guru->select_dataWhere($where,'data_guru');
		$data['page_title'] = 'Pengumuman';

		$id_thn_aktif = $this->m_guru->select_dataWhere('status_aktif=1','setup_tahun')->row('id_tahun');

		//CEK TYPE USER
		//GURU SAJA?
		$guru_saja = $this->m_guru->cek_guru_saja($id_guru,$id_thn_aktif)->num_rows();
		//WALI_KELAS
		$wali_kelas = $this->m_guru->cek_wali_kelas($id_guru,$id_thn_aktif)->num_rows();
		

		if($wali_kelas>0)
		{
			//public,guru,wali kelas
			$data['pengumuman'] = $this->m_guru->get_pengumuman_all();
			$model_function = "pengumuman_all_wp";		
		}
		elseif($guru_saja>0)
		{
			$data['pengumuman'] = $this->m_guru->get_pengumuman_guru();
			$model_function = "pengumuman_guru_wp";		
		}
		else
		{
			$data['pengumuman'] = $this->m_guru->get_pengumuman_publik();
			$model_function = "pengumuman_publik_wp";		
		}
		
		//Pgination Config::
		$siteurl = site_url('guru/index_pgm/');
		$rows = $data['pengumuman']->num_rows();
		$perpage = 3;
		$urisegment = 3;
		$Mfunction = $model_function;
		//$key = $setup_tahun->id_tahun;
		$model = "m_guru";
		$type = "tanpa_where";
		include("pagination_config.php");
		//end Pagination::
		$data['content_utama'] = "guru/content_pgm";
		$data['content'] = "guru/v_dashboard";
		$this->load->view('guru/index',$data);

	}

	public function readmore()
	{
		$id_guru = $this->session->userdata('id');
		$where = array('id_guru' => $id_guru);
		$data['user'] = $this->m_guru->select_dataWhere($where,'data_guru');
		$id_post = $this->uri->segment(3, 0);
		$data['tulisan'] = $this->m_guru->get_tulisan($id_post);
		if($data['tulisan']->num_rows()>0)
		{
			$title_page = '<h1>'.$data['tulisan']->row('judul_post').'</h1>';
		}
		else
		{
			$title_page = '<h1>Halaman tidak ditemukan!</h1>';	
		}
		$data['page_title'] = $title_page;

		
		$data['content'] = "guru/v_halaman";
		$this->load->view('guru/index',$data);
	}

	/*
	|=================================================================================
	| 2) SET PROFILE
	|=================================================================================
	*/

	public function set_profile()
	{
		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('nip','NIP','required');
		$this->form_validation->set_rules('nik','NIK','required');
		$this->form_validation->set_rules('jk','Jenis Kelamin','required');
		$this->form_validation->set_rules('alamat_guru','Alamat','required');
		$this->form_validation->set_rules('telpon','Telepon','required');
		$this->form_validation->set_rules('username','Username','required');

		// File Upload
		if(!empty($_FILES['userfile']['name'])){
			$config['upload_path'] = './assets/photos/';
			$config['file_name'] = time().'_'.$_FILES['userfile']['name'];
			$config['allowed_types'] = 'gif|jpg|jpeg|png|JPG|JPEG';
			$config['max_size'] = 500;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$foto = $this->upload->data();
		}


		if($this->form_validation->run()==FALSE OR (!empty($_FILES['userfile']['name']) && !$this->upload->do_upload('userfile')))
		{
			
			$notif = "";

			if($this->form_validation->run()==FALSE)
			{
				$notif .= validation_errors();
			}

			if(!empty($_FILES['userfile']['name']) && !$this->upload->do_upload('userfile'))
			{	
				$notif .= $this->upload->display_errors();
			}

			$this->setmessage($notif,'warning');
			redirect('guru?m=dashboard#profil');

		}else{
			if(!empty($_FILES['userfile']['name']))
			{
				
				//Compress Image
				$config['image_library']='gd2';
				$config['source_image']= './assets/photos/'.$foto['file_name'];
				$config['create_thumb']= FALSE;
				$config['maintain_ratio']= FALSE;
				$config['quality']= '100%';
				$config['width']= 400;
				$config['height']= 400;
				$config['new_image']= './assets/photos/'.$foto['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();

				$post = $this->input->post();
				$data = array(
					'nama_guru' => trim(strip_tags($post['nama'])),
					'nip' => trim(strip_tags($post['nip'])),
					'kelamin' => trim($post['jk']),
					'alamat_guru' => trim(strip_tags($post['alamat_guru'])),
					'telpon_guru' => trim(strip_tags($post['telpon'])),
					'username' => trim(strip_tags($post['username'])),
					'foto_guru' => $foto['file_name']
					
				);

				//del foto lama from direktori
					if($post['fotolm']!='')
					{
						unlink('./assets/photos/'.$post['fotolm']);
					}

				
			}else{
				$post = $this->input->post();
				$data = array(
					'nama_guru' => trim(strip_tags($post['nama'])),
					'nip' => trim(strip_tags($post['nip'])),
					'kelamin' => trim(strip_tags($post['jk'])),
					'alamat_guru' => trim(strip_tags($post['alamat_guru'])),
					'telpon_guru' => trim(strip_tags($post['telpon'])),
					'username' => trim(strip_tags($post['username'])),
				);
			}

			
			//Simpan::
			$where = array('id_guru' => $post['id_guru']);
			$this->m_guru->update_dataTable($where,$data,'data_guru');

			$this->setmessage('Profil berhasil diperbarui','success');
			redirect('guru?m=dashboard#profil');
		}

	}

	public function change_password()
	{
		$post=$this->input->post();
		$idguru = $this->session->userdata('id');
		

		$this->form_validation->set_rules('pwd_saat_ini','Password saat ini','required');
		$this->form_validation->set_rules('pwd_baru','Password Baru','required');
		$this->form_validation->set_rules('pwd_confirm','Password Konfirmasi','required|matches[pwd_baru]');
		if($this->form_validation->run()==FALSE)
		{
			$this->setmessage(validation_errors(),'warning');
			redirect('guru');
		}

		$where = array(
			'id_guru' => $idguru,
			'password' => md5($post['pwd_saat_ini'])
		);
		$cekpwd = $this->m_guru->select_dataWhere($where,'data_guru')->num_rows();
		if($cekpwd>0)
		{
			$data = array(
				'password' => md5($post['pwd_baru'])
			);

			$this->m_guru->update_dataTable('id_guru='.$idguru.'',$data,'data_guru');
			$this->setmessage('Password berhasil diperbarui!','success');
			redirect('guru');
		}
		else
		{
			$this->setmessage('<b>Password saat ini, salah!</b>','danger');
			redirect('guru');
		}
	}

	public function detail_siswa()
	{
		$id_guru = $this->session->userdata('id');
		$where = array('id_guru' => $id_guru);
		$data['user'] = $this->m_guru->select_dataWhere($where,'data_guru');
		$data['page_title'] = "<h1>Detail Siswa</h1>";
		$whereid = array('nis' => $this->uri->segment(3));
		$data['data_siswa'] = $this->m_guru->select_dataWhere($whereid,'data_siswa');
		$siswa = $data['data_siswa']->row();
		$setup_tahun = $this->m_guru->select_dataWhere('status_aktif=1','setup_tahun')->row();
		$id_thn_aktif = $setup_tahun->id_tahun;
		$data['tahun_ajaran'] = $setup_tahun->tahun;
		$semester_aktif = $this->m_guru->select_dataWhere('status_semester=1','setup_semester')->row('id_semester');
		//kelas siswa sesuai tahun aktif sekarang
		$data['viewkls']= $this->m_admin->get_kelas_siswa($siswa->nis,$id_thn_aktif);
		//Riwayat Kelas
		$data['riwayat_kelas'] = $this->m_admin->get_riwayat_kelas($siswa->nis);
		
		//Nilai Semester 1;
		$nis = $siswa->nis;
		$idkelas = $data['viewkls']->row('id_kelas');
		$id_tahun = $id_thn_aktif;
		$semester = 1;
		//refernsi:
		//$data['sekolah'] = $this->m_cetak->get_data_sekolah()->row();
		//$data['siswa'] = $this->m_cetak->select_dataWhere('nis='.$nis.'','data_siswa')->row();
		
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

		//Nilai Semester 2;
		
		$semester2 = 2;
		//refernsi:
		//$data['sekolah'] = $this->m_cetak->get_data_sekolah()->row();
		//$data['siswa'] = $this->m_cetak->select_dataWhere('nis='.$nis.'','data_siswa')->row();
		
		$data['semester2'] = $this->m_cetak->select_dataWhere('id_semester='.$semester2.'','setup_semester')->row();
		
		//tbl_nilai,setup_pelajaran,tbl_kategori_mapel,data_siswa,setup_kelas
		$data['nilai_sikap2'] = $this->m_cetak->get_nilai_sikap($nis,$idkelas,$id_tahun,$semester2);
		$data['nilai_rapor2'] = $this->m_cetak->get_nilai_rapor($nis,$idkelas,$id_tahun,$semester2,$kategori_kls);
		$data['deskripsi_nilai2'] = $this->m_cetak->get_deskripsi_nilai($nis,$idkelas,$id_tahun,$semester2);
		$data['nilai_ekstra2'] = $this->m_cetak->get_nilai_ekstra($nis,$idkelas,$id_tahun,$semester2);
		$data['nilai_prestasi2'] = $this->m_cetak->get_nilai_prestasi($nis,$idkelas,$id_tahun,$semester2);
		$data['kehadiran2'] = $this->m_cetak->get_kehadiran_siswa($nis,$idkelas,$id_tahun,$semester2);
		$data['catatan_wk2'] = $this->m_cetak->get_cttnwk($nis,$idkelas,$id_tahun,$semester2);
		
		$data['kepsek2'] = $this->m_cetak->get_ref_kepsek($id_tahun,$semester2)->row();
		
						
		$data['content'] = "v_detail_siswa";
		$this->load->view('guru/index',$data);
	}

	/*
	|=================================================================================
	| 3) INPUT NILAI
	|=================================================================================
	*/
	
	public function input_nilai()
	{
		//tahun aktif
		$setup_tahun = $this->m_guru->get_ref_thn_aktif()->row();
		//semester aktif
		$setup_semester = $this->m_guru->select_dataWhere('status_semester=1','setup_semester')->row();

		$data['thn_aktif'] = $setup_tahun->id_tahun;
		$id_guru = $this->session->userdata('id');
		$where = array('id_guru' => $id_guru);
		$data['user'] = $this->m_guru->select_dataWhere($where,'data_guru');
		$data['page_title'] = '<h1>Input Nilai '.$setup_tahun->tahun.' Semester '.ucwords($setup_semester->semester).'</h1>';
		$data['input_type'] = "nilai";

		//Menampilkan mapel, dan kelas yang diampu
		$data['input_nilai_perkelas'] = $this->m_guru->input_nilai_perkelas($id_guru,$setup_semester->id_semester,$setup_tahun->id_tahun);
		$data['kategori_nilai'] = $this->m_guru->kategori_nilai();
		//Semester yg aktif;
		$data['semester'] = $setup_semester->id_semester;

		$data['content'] = "guru/v_input_nilai";
		$this->load->view('guru/index',$data);
	}

	public function aksi_input_nilai()
	{
		//tahun aktif
		$setup_tahun = $this->m_guru->get_ref_thn_aktif()->row();
		//get_post::
		$id_guru = trim($this->input->post('id_guru'));
		$id_kelas = trim($this->input->post('id_kelas'));
		$id_pelajaran = trim($this->input->post('id_pelajaran'));
		//$id_kategori = trim($this->input->post('id_kategori'));
		$semester = trim($this->input->post('semester'));
		//data::
		$data['guru'] = $this->m_guru->select_dataWhere('id_guru='.$id_guru.'', 'data_guru');
		$data['kelas'] = $this->m_guru->select_dataWhere('id_kelas='.$id_kelas.'', 'setup_kelas');
		$data['pelajaran'] = $this->m_guru->select_dataWhere('id_pelajaran='.$id_pelajaran.'', 'setup_pelajaran');
		//$data['kategori'] = $this->m_guru->select_dataWhere('id_kategori='.$id_kategori.'', 'tbl_kategori_nilai');
		$data['tahun'] = $setup_tahun->id_tahun;
		$data['semester'] = $this->m_guru->select_dataWhere('id_semester='.$semester.'', 'setup_semester');

		//Cek di Kelas, ada siswa/tdk?
		$where_kelas = array('id_kelas' => $id_kelas, 'id_tahun' => $setup_tahun->id_tahun);
		$cek_kelas = $this->m_guru->select_dataWhere($where_kelas,'tbl_ruangan')->num_rows();
		//Jika ada siswa dikelas...
		if($cek_kelas>0)
		{
			$where = array(
				'id_guru' => $id_guru,
				'id_kelas' => $id_kelas,
				'id_pelajaran' => $id_pelajaran,
				//'id_kategori' => $id_kategori,
				'id_tahun' => $setup_tahun->id_tahun,
				'semester' => $semester
			);

			$data['tbl_nilai'] = $this->m_guru->select_dataWhere($where,'tbl_nilai');
			$cek = $data['tbl_nilai']->num_rows();


			if($cek>0) //mode update: jika nilai sdh diinput
			{
				$data['page_title'] = '<h1>Update Nilai '.$setup_tahun->tahun.' Semester '.ucwords($data['semester']->row('semester')).'</h1>';
				$data['mode_form'] = "update";
				$data['list_siswa'] = $this->m_guru->list_nilai_siswa($id_guru,$id_kelas,$id_pelajaran,$setup_tahun->id_tahun,$semester);
			}
			else
			{
				$data['page_title'] = '<h1>Input Nilai '.$setup_tahun->tahun.' Semester '.ucwords($data['semester']->row('semester')).'</h1>';
				$data['mode_form'] = "input"; //mode input: jk nilai masih kosong
				$data['list_siswa'] = $this->m_guru->list_siswa_dikelas($id_kelas,$setup_tahun->id_tahun,$semester);
			}
		}
		else
		{
			//Jika kelas kosong...
			$this->setmessage('Maaf, input nilai belum bisa dilakukan. System tidak menemukan data siswa di kelas ini. Silahkan hubungi Administrator!','danger');
			redirect('guru/input_nilai?m=input_nilai');
		}

		$id_guru = $this->session->userdata('id');
		$where = array('id_guru' => $id_guru);
		$data['user'] = $this->m_guru->select_dataWhere($where,'data_guru');

		$data['content'] = "guru/v_input_nilai_siswa";
		$this->load->view('guru/index',$data);
	}

	public function proses_input_nilai()
	{
		$post = $this->input->post();
		
		if(isset($post['input_nilai']))
		{
			
			$nis = $post['nis'];
			foreach ($nis as $key => $value)
			{
			   $input[$key]['nis'] = trim($post['nis'][$key]);
			   $input[$key]['id_pelajaran'] = trim($post['id_pelajaran']);
			   $input[$key]['id_kelas'] = trim($post['id_kelas']);
			   $input[$key]['id_guru'] = trim($post['id_guru']);
			   $input[$key]['nilai_pengetahuan']  = trim(strip_tags($post['nilai_pengetahuan'][$key]));
			   $input[$key]['nilai_ketrampilan']  = trim(strip_tags($post['nilai_ketrampilan'][$key]));
			   //$input[$key]['id_kategori'] = $post['id_kategori'];
			   $input[$key]['id_tahun'] = trim($post['tahun']);
			   $input[$key]['semester'] = trim($post['semester']);
			}

			   $this->m_guru->insert_batch('tbl_nilai',$input);

			   $this->setmessage('Nilai berhasil disimpan!','success');
			   redirect('guru/input_nilai?m=input_nilai');
			 
		}

		if(isset($post['update_nilai']))
		{
			$idnilai = $post['id_nilai'];
			foreach ($idnilai as $key => $value)
			{
				$update[$key]['id_nilai'] = trim($post['id_nilai'][$key]);
				$update[$key]['nilai_pengetahuan']  = trim(strip_tags($post['nilai_pengetahuan'][$key]));
				$update[$key]['nilai_ketrampilan']  = trim(strip_tags($post['nilai_ketrampilan'][$key]));
			   
			}

			$this->m_guru->update_batch('tbl_nilai',$update,'id_nilai');

			  $this->setmessage('Nilai berhasil diperbarui!','success');
			   redirect('guru/input_nilai?m=input_nilai');
			 
		}
	}




	/*public function down_templateup_nilai()
	{
		//Export Excel::
		
		header("Content-type:application/vnd-ms-excel");
		header("Content-Disposition:attachment; filename=template_excel_nilai_siswa.xls");

		//referensi data::
		//------------------------------------------------------------------------------

		//tahun aktif
		$setup_tahun = $this->m_guru->get_ref_thn_aktif()->row();
		//get_post::
		$id_guru = $this->session->userdata('id');
		$id_kelas = $this->uri->segment(3);
		$id_pelajaran = $this->uri->segment(4);
		//$id_kategori = trim($this->input->post('id_kategori'));
		$semester = $this->uri->segment(5);
		//data::
		$data['guru'] = $this->m_guru->select_dataWhere('id_guru='.$id_guru.'', 'data_guru');
		$data['kelas'] = $this->m_guru->select_dataWhere('id_kelas='.$id_kelas.'', 'setup_kelas');
		$data['pelajaran'] = $this->m_guru->select_dataWhere('id_pelajaran='.$id_pelajaran.'', 'setup_pelajaran');
		$nama_pelajaran = $data['pelajaran']->row('nama_pelajaran');
		//$data['kategori'] = $this->m_guru->select_dataWhere('id_kategori='.$id_kategori.'', 'tbl_kategori_nilai');
		$data['tahun'] = $setup_tahun->id_tahun;
		$data['semester'] = $this->m_guru->select_dataWhere('id_semester='.$semester.'', 'setup_semester');
		$data['pd_tahun'] = $setup_tahun->tahun;

		$where = array(
				'id_guru' => $id_guru,
				'id_kelas' => $id_kelas,
				'id_pelajaran' => $id_pelajaran,
				//'id_kategori' => $id_kategori,
				'id_tahun' => $setup_tahun->id_tahun,
				'semester' => $semester
			);

			$data['tbl_nilai'] = $this->m_guru->select_dataWhere($where,'tbl_nilai');
			$cek = $data['tbl_nilai']->num_rows();


			if($cek>0) //tampilkan tbl_nilai lengkap
			{
				$data['page_title'] = 'DATA NILAI '.$nama_pelajaran.' ';
				$data['mode_form'] = "update";
				$data['list_siswa'] = $this->m_guru->list_nilai_siswa($id_guru,$id_kelas,$id_pelajaran,$setup_tahun->id_tahun,$semester);
			}
			else //tampilkan nis,mapel,id_guru,id_kelas,id_pelajaran,tahun_semester
			{
				$data['page_title'] = 'DATA NILAI '.$nama_pelajaran.' ';
				$data['mode_form'] = "input"; //mode input: jk nilai masih kosong
				$data['list_siswa'] = $this->m_guru->list_siswa_dikelas($id_kelas,$setup_tahun->id_tahun,$semester);
			}
		
		//------------------------------------------------------------------------------
			
			
		$this->load->view('template_excel/v_template_excel_nilai_siswa',$data);
	}*/

	/*
	|=================================================================================
	| 4) INPUT DESKRIPSI NILAI
	|=================================================================================
	*/
	
	public function input_deskripsi_nilai()
	{
		//tahun aktif
		$setup_tahun = $this->m_guru->get_ref_thn_aktif()->row();
		//semester aktif
		$setup_semester = $this->m_guru->select_dataWhere('status_semester=1','setup_semester')->row();

		$data['thn_aktif'] = $setup_tahun->id_tahun;
		$id_guru = $this->session->userdata('id');
		$where = array('id_guru' => $id_guru);
		$data['user'] = $this->m_guru->select_dataWhere($where,'data_guru');
		$data['page_title'] = '<h1>Input Deskripsi Nilai '.$setup_tahun->tahun.'</h1>';
		$data['input_type'] = "deskripsi";

		//Menampilkan kategori nilai, mapel, dan kelas yang diampu
		$data['input_nilai_perkelas'] = $this->m_guru->input_nilai_perkelas($id_guru,$setup_semester->id_semester,$setup_tahun->id_tahun);
		//$data['kategori_nilai'] = $this->m_guru->kategori_nilai();
		//Semester yg aktif;
		$data['semester'] = $setup_semester->id_semester;

		$data['content'] = "guru/v_input_nilai";
		$this->load->view('guru/index',$data);
	}

public function aksi_input_deskripsi()
	{
		//tahun aktif
		$setup_tahun = $this->m_guru->get_ref_thn_aktif()->row();
		//get_post::
		$id_guru = trim($this->input->post('id_guru'));
		$id_kelas = trim($this->input->post('id_kelas'));
		$id_pelajaran = trim($this->input->post('id_pelajaran'));
		//$id_kategori = trim($this->input->post('id_kategori'));
		$semester = trim($this->input->post('semester'));
		//data::
		$data['guru'] = $this->m_guru->select_dataWhere('id_guru='.$id_guru.'', 'data_guru');
		$data['kelas'] = $this->m_guru->select_dataWhere('id_kelas='.$id_kelas.'', 'setup_kelas');
		$data['pelajaran'] = $this->m_guru->select_dataWhere('id_pelajaran='.$id_pelajaran.'', 'setup_pelajaran');
		//$data['kategori'] = $this->m_guru->select_dataWhere('id_kategori='.$id_kategori.'', 'tbl_kategori_nilai');
		$data['tahun'] = $setup_tahun->id_tahun;
		$data['semester'] = $this->m_guru->select_dataWhere('id_semester='.$semester.'', 'setup_semester');

		
		$where = array(
			'id_guru' => $id_guru,
			'id_kelas' => $id_kelas,
			'id_pelajaran' => $id_pelajaran,
			//'id_kategori' => $id_kategori,
			'id_tahun' => $setup_tahun->id_tahun,
			'semester' => $semester
		);

		$data['tbl_nilai'] = $this->m_guru->select_dataWhere($where,'tbl_nilai');
		$cek = $data['tbl_nilai']->num_rows();


		if($cek>0) //mode update: jika nilai sdh diinput
		{
			$data['page_title'] = '<h1>Update Deskripsi Nilai '.$setup_tahun->tahun.' Semester '.ucwords($data['semester']->row('semester')).'</h1>';
			$data['mode_form'] = "update";
			$data['list_siswa'] = $this->m_guru->list_deskripsi_nilai($id_guru,$id_kelas,$id_pelajaran,$setup_tahun->id_tahun,$semester);
		}
		else
		{
			$this->setmessage('Maaf, input deskripsi nilai tidak dapat dilakukan, karena data nilai masih kosong. Silahkan isi data nilai terlebih dahulu!','danger');
			redirect('guru/input_deskripsi_nilai?m=input_nilai');
		}

		$id_guru = $this->session->userdata('id');
		$where = array('id_guru' => $id_guru);
		$data['user'] = $this->m_guru->select_dataWhere($where,'data_guru');

		$data['content'] = "guru/v_input_nilai_deskripsi";
		$this->load->view('guru/index',$data);
	}

	public function proses_input_deskripsi()
	{
		$post = $this->input->post();
				
		
			$idnilai = $post['id_nilai'];
			foreach ($idnilai as $key => $value)
			{
				$data = array(
					'id_nilai' => trim($post['id_nilai'][$key]),
					'id_pelajaran' => trim($post['id_pelajaran']),
					'nis' => trim($post['nis'][$key]),
					'pengetahuan' => trim(strip_tags($post['desk_pengetahuan'][$key])),
					'ketrampilan'  => trim(strip_tags($post['desk_ketrampilan'][$key])),
					'semester' => trim($post['semester']),
					'id_tahun' => trim($post['tahun']),
				);

				$this->m_guru->replace_data('tbl_deskripsi_nilai',$data);
			}
			
			$this->setmessage('Deskripsi nilai berhasil disimpan!','success');
			redirect('guru/input_deskripsi_nilai?m=input_nilai');
	}

	/*
	|=================================================================================
	| 5) INPUT NILAI SIKAP
	|=================================================================================
	*/
	
	public function input_nilai_sikap()
	{
		//*Head*
		//tahun aktif
		$setup_tahun = $this->m_guru->get_ref_thn_aktif()->row();
		//semester aktif
		$setup_semester = $this->m_guru->select_dataWhere('status_semester=1','setup_semester')->row();

		$data['thn_aktif'] = $setup_tahun->tahun;
		$data['idtahun'] = $setup_tahun->id_tahun;
		$data['semester_aktif'] = ucwords($setup_semester->semester);
		$data['idsemester'] = $setup_semester->id_semester;

		$id_guru = $this->session->userdata('id');
		$where = array('id_guru' => $id_guru);
		$data['user'] = $this->m_guru->select_dataWhere($where,'data_guru');
		$data['page_title'] = '<h1>Input Nilai Sikap Siswa '.$setup_tahun->tahun.' Semester '.$data['semester_aktif'].'</h1>';
		//$data['input_type'] = "deskripsi";

		//*Body*
		
		include "include/id_wali_kelas.php";
		$data['wali_id_wali'] = $wali_id_wali;
		$data['kelas'] = $this->m_guru->select_dataWhere('id_kelas='.$id_wali_kelas.'','setup_kelas');
		
		$data['cek_nilai_sikap'] = $this->m_guru->get_nilai_sikap2($id_wali_kelas,$data['idtahun'],$data['idsemester']);
		

		$data['content'] = "guru/v_input_sikap";
		$this->load->view('guru/index',$data);
	}

	public function form_nilai_sikap()
	{
		//*Head*
		//tahun aktif
		$setup_tahun = $this->m_guru->get_ref_thn_aktif()->row();
		//semester aktif
		$setup_semester = $this->m_guru->select_dataWhere('status_semester=1','setup_semester')->row();

		$data['thn_aktif'] = $setup_tahun->tahun;
		$data['idtahun'] = $setup_tahun->id_tahun;
		$data['semester_aktif'] = ucwords($setup_semester->semester);
		$data['idsemester'] = $setup_semester->id_semester;

		$id_guru = $this->session->userdata('id');
		$where = array('id_guru' => $id_guru);
		$data['user'] = $this->m_guru->select_dataWhere($where,'data_guru');
		include "include/id_wali_kelas.php";
		$data['wali_id_wali'] = $wali_id_wali;
				
		//*GetPost*/
		$post_idtahun = trim(htmlentities($this->input->post('idtahun')));
		$post_idkelas = trim(htmlentities($this->input->post('idkelas')));
		$post_semester = trim(htmlentities($this->input->post('semester')));
		$data['kelas'] = $this->m_guru->select_dataWhere('id_kelas='.$post_idkelas.'','setup_kelas');
		$data['id_kelas'] = $post_idkelas;
		//*Body*

		
		if(isset($_POST['input'])){
			$data['page_title'] = '<h1>Input Nilai Sikap Siswa '.$setup_tahun->tahun.' Semester '.$data['semester_aktif'].'</h1>';
			$data['nilai_sikap'] = $this->m_guru->get_nilai_sikap1($post_idkelas,$post_idtahun);
			$data['jumSis'] = $data['nilai_sikap']->num_rows();
			$data['content'] = "guru/v_form_nilai_sikap";
		}elseif(isset($_POST['update']))
		{
			$data['page_title'] = '<h1>Update Nilai Sikap Siswa '.$setup_tahun->tahun.' Semester '.$data['semester_aktif'].'</h1>';
			$data['nilai_sikap'] = $this->m_guru->get_nilai_sikap2($post_idkelas,$post_idtahun,$post_semester);
			$data['jumSis'] = $data['nilai_sikap']->num_rows();
			$data['content'] = "guru/v_form_up_nilai_sikap";
		}

		$this->load->view('guru/index',$data);
	}

	public function simpan_nilai_sikap()
	{
		$post = $this->input->post();

		if(isset($post['insert']))
		{
			$jumSis = $post['jumlah'];
			for ($ok=1; $ok<=$jumSis; $ok++)
			{
			   $data[$ok]['nis'] = trim($post['nis'.$ok]);
			   $data[$ok]['id_kelas'] = trim($post['idkelas']);
			   $data[$ok]['id_wali'] = trim($post['idwali']);
			   $data[$ok]['id_semester'] = trim($post['idsemester']);
			   $data[$ok]['id_tahun'] = trim($post['idtahun']); 
			   $data[$ok]['predikat_spiritual'] = trim(strip_tags($post['a'.$ok]));
			   $data[$ok]['sikap_spiritual'] = trim(strip_tags($post['b'.$ok]));
			   $data[$ok]['predikat_sosial'] = trim(strip_tags($post['c'.$ok]));
			   $data[$ok]['sikap_sosial'] = trim(strip_tags($post['d'.$ok]));
			}

			$this->m_guru->insert_batch('tbl_nilai_sikap',$data);
			$this->setmessage('Data nilai sikap berhasil disimpan!','success');
			redirect('guru/input_nilai_sikap?m=input_nilai&sm=input_nilai_sikap');
		}

		if(isset($post['update']))
		{
			$jumSis = $post['jumlah'];
			for ($ok=1; $ok<=$jumSis; $ok++)
			{
			   
				$data = array(
				    'predikat_spiritual' => trim(strip_tags($post['a'.$ok])),
			   		'sikap_spiritual' => trim(strip_tags($post['b'.$ok])),
			   		'predikat_sosial' => trim(strip_tags($post['c'.$ok])),
			   		'sikap_sosial' => trim(strip_tags($post['d'.$ok]))
				);

				$where = array(
					'nis' => trim($post['nis'.$ok]),
					'id_kelas' => trim($post['idkelas']),
					'id_tahun' => trim($post['idtahun']),
					'id_semester' => trim($post['idsemester'])
				);

				$this->m_guru->update_dataTable($where,$data,'tbl_nilai_sikap');
			}

			$this->setmessage('Nilai Sikap berhasil diperbarui!','success');
			redirect('guru/input_nilai_sikap?m=input_nilai&sm=input_nilai_sikap');
		}
	}

	/*
	|=================================================================================
	| 6) INPUT NILAI EKSTRA
	|=================================================================================
	*/
	
	public function ekstra_kurikuler()
	{
		//*Head*
		//tahun aktif
		$setup_tahun = $this->m_guru->get_ref_thn_aktif()->row();
		//semester aktif
		$setup_semester = $this->m_guru->select_dataWhere('status_semester=1','setup_semester')->row();

		$data['thn_aktif'] = $setup_tahun->tahun;
		$data['idtahun'] = $setup_tahun->id_tahun;
		$data['semester_aktif'] = ucwords($setup_semester->semester);
		$data['idsemester'] = $setup_semester->id_semester;

		$id_guru = $this->session->userdata('id');
		$where = array('id_guru' => $id_guru);
		$data['user'] = $this->m_guru->select_dataWhere($where,'data_guru');
		$data['page_title'] = '<h1>Input Nilai Ekstra Kurikuler '.$setup_tahun->tahun.' Semester '.$data['semester_aktif'].'</h1>';
		//$data['input_type'] = "deskripsi";

		//*Body*
		
		include "include/id_wali_kelas.php";
		$data['wali_id_wali'] = $wali_id_wali;
		$data['kelas'] = $this->m_guru->select_dataWhere('id_kelas='.$id_wali_kelas.'','setup_kelas');
		$idkelas = $data['kelas']->row('id_kelas');
		//refensi from db
		$data['kegiatan_ekstra'] = $this->m_guru->select_table_orderby('nama_ekstra ASC','ekstrakurikuler');
		$data['siswadikelas'] = $this->m_guru->data_siswa_dikelas($idkelas,$data['idtahun']);
		
		$data['nilai_ekstra'] = $this->m_guru->get_nilai_ekstra($idkelas,$data['idtahun'],$data['idsemester']);
			
		$data['content'] = "guru/v_siswa_nilai_ekstra";
		
		$this->load->view('guru/index',$data);
	}
	
	public function edit_nilai_ekstra()
	{
		//*Head*
		//tahun aktif
		$setup_tahun = $this->m_guru->get_ref_thn_aktif()->row();
		//semester aktif
		$setup_semester = $this->m_guru->select_dataWhere('status_semester=1','setup_semester')->row();

		$data['thn_aktif'] = $setup_tahun->tahun;
		$data['idtahun'] = $setup_tahun->id_tahun;
		$data['semester_aktif'] = ucwords($setup_semester->semester);
		$data['idsemester'] = $setup_semester->id_semester;

		$id_guru = $this->session->userdata('id');
		$where = array('id_guru' => $id_guru);
		$data['user'] = $this->m_guru->select_dataWhere($where,'data_guru');

		//refensi from db
		$data['kegiatan_ekstra'] = $this->m_guru->select_table_orderby('nama_ekstra ASC','ekstrakurikuler');
						
		//*GetURI*/
		$get = $this->input->get();
		if($get['set']=='update'){
		
			$nis = $this->uri->segment(3);
			$idkelas = $this->uri->segment(4);
			$geturi5 = explode("-", $this->uri->segment(5));
				$idwali = $geturi5['0'];
				$idsemester = $geturi5['1'];
				$idtahun = $geturi5['2'];
				$where = "siswa.nis=$nis AND ekstra.id_kelas=$idkelas AND ekstra.id_wali=$idwali AND ekstra.id_semester=$idsemester AND ekstra.id_tahun=$idtahun";
			$data['nilai_ekstra'] = $this->m_guru->lihat_nilai_ekstra($where);
			$data['page_title'] = '<h1>Input Nilai Ekstra Kurikuler '.$setup_tahun->tahun.' Semester '.$data['semester_aktif'].'</h1>';
			$data['type_form'] = "update";
			$data['content'] = "guru/v_form_in_nilai_ekstra";
		}
			

		$this->load->view('guru/index',$data);
	}

	public function simpan_nilai_ekstra()
	{
		$post = $this->input->post();

		if(isset($post['insert']))
		{
			$data = array(
				'nis' => trim($post['nis']),
				'id_kelas' => trim($post['idkelas']),
				'id_wali' => trim($post['idwali']),
				'id_semester' => trim($post['idsemester']),
				'id_tahun' => trim($post['idtahun']),
				'id_ekstra' => trim($post['ekstra']),
				'nilai' => trim(strip_tags($post['nilai'])),
				'deskripsi' => trim(strip_tags($post['deskripsi']))
			);
			if($post['nilai']!='' && $post['deskripsi']!='')
			{
				$this->m_guru->insert_dataTo($data,'tbl_nilai_ekstra');
			}
			else
			{
				$this->setmessage('Ups! Gagal menambahkan nilai ekstra kurikuler. Form isian tidak boleh kosong. Periksa lagi!','danger');
			redirect('guru/ekstra_kurikuler?m=input_nilai&sm=ekstra_kurikuler');
			}

			$this->setmessage('Data nilai ekstra berhasil disimpan!','success');
			redirect('guru/ekstra_kurikuler?m=input_nilai&sm=ekstra_kurikuler');
			  
		}

		if(isset($post['update']))
		{
			$ekstra = $post['ekstra'];
			foreach ($ekstra as $key => $value) {
				$data = array(
			   		'id_ekstra' => trim($post['ekstra'][$key]),
			   		'nilai' => trim(strip_tags($post['nilai'][$key])),
			   		'deskripsi' => trim(strip_tags($post['deskripsi'][$key]))
			   	);
			   
				$where = array(
					'id_ekst' => trim($post['idekst'][$key])
				   
				);

				if($post['nilai'][$key]!='' && $post['deskripsi'][$key]!='')
				{
				   	$this->m_guru->update_dataTable($where,$data,'tbl_nilai_ekstra');
				}else{
					$this->setmessage('Ups! Tidak dapat melanjutkan penyimpanan perubahan! Periksa lagi!','danger');
					redirect($post['back_url']);
				}
			}
			//proses tambah keg. ekstra:
			if(!empty($post['ekstra2'] OR $post['nilai2'] OR $post['deskripsi2']))
			{
				$data = array(
			   		'nis' => trim($post['nis']),
			   		'id_kelas' => trim($post['idkelas']),
			   		'id_wali' => trim($post['idwali']),
			   		'id_semester' => trim($post['idsemester']),
			   		'id_tahun' => trim($post['idtahun']),
			   		'id_ekstra' => trim($post['ekstra2']),
			   		'nilai' => trim(strip_tags($post['nilai2'])),
			   		'deskripsi' => trim(strip_tags($post['deskripsi2']))
			   	);
				   			
					
					if($post['nilai2']!='' && $post['deskripsi2']!='')
					{
					   	$this->m_guru->insert_dataTo($data,'tbl_nilai_ekstra');
					}else{
						$this->setmessage('Ups! Tidak dapat melanjutkan penyimpanan perubahan! Jika ingin menambahkan kegiatan Ekstra Kurikuler data tidak boleh ada yang kosong. Periksa lagi!','danger');
						redirect($post['back_url']);
					}
			}


			$this->setmessage('Perubahan data berhasil disimpan!','success');
					redirect($post['back_url']);
		}
	}

	public function hapus_ekstra_siswa()
	{
		$id_ekst = $this->uri->segment(3);
		$this->m_guru->delete_dataTable('id_ekst='.$id_ekst.'','tbl_nilai_ekstra');
		$back_url = $this->input->get('back');
		$get2 = $this->input->get('m');
		$get3 = $this->input->get('sm');
		$get = "&m=$get2&sm=$get3";

		$this->setmessage('Data berhasil dihapus!','success');
		redirect($back_url.$get);
	}

	/*
	|=================================================================================
	| 7) INPUT PRESTASI SISWA
	|=================================================================================
	*/
	
	public function input_prestasi()
	{
		//*Head*
		//tahun aktif
		$setup_tahun = $this->m_guru->get_ref_thn_aktif()->row();
		//semester aktif
		$setup_semester = $this->m_guru->select_dataWhere('status_semester=1','setup_semester')->row();

		$data['thn_aktif'] = $setup_tahun->tahun;
		$data['idtahun'] = $setup_tahun->id_tahun;
		$data['semester_aktif'] = ucwords($setup_semester->semester);
		$data['idsemester'] = $setup_semester->id_semester;

		$id_guru = $this->session->userdata('id');
		$where = array('id_guru' => $id_guru);
		$data['user'] = $this->m_guru->select_dataWhere($where,'data_guru');
		$data['page_title'] = '<h1>Input Prestasi Siswa '.$setup_tahun->tahun.' Semester '.$data['semester_aktif'].'</h1>';
		//$data['input_type'] = "deskripsi";

		//*Body*
		
		include "include/id_wali_kelas.php";
		$data['wali_id_wali'] = $wali_id_wali;
		$data['kelas'] = $this->m_guru->select_dataWhere('id_kelas='.$id_wali_kelas.'','setup_kelas');
		$idkelas = $data['kelas']->row('id_kelas');

		$data['siswadikelas'] = $this->m_guru->data_siswa_dikelas($idkelas,$data['idtahun']);
	
		$data['prestasi_siswa'] = $this->m_guru->get_prestasi_siswa($idkelas,$data['idtahun'],$data['idsemester']);
		
		$data['content'] = "guru/v_prestasi_list_siswa";
		
		$this->load->view('guru/index',$data);
	}

	function set_prestasi_siswa()
	{
		$this->form_validation->set_rules('jenis','Jenis Kegiatan','required');
		$this->form_validation->set_rules('ket','Keterangan','required');

		$post = $this->input->post();

		if($this->form_validation->run()==FALSE){
			$this->setmessage(validation_errors(),'warning');
			redirect('guru/input_prestasi?m=input_nilai&sm=prestasi');
		}
		else
		{
			
			$data = array(
				'nis' => $post['nis'],
				'id_kelas' => $post['idkelas'],
				'id_wali' => $post['idwali'],
				'id_semester' => $post['idsemester'],
				'id_tahun' => $post['idtahun'],
				'jenis_kegiatan' => trim(strip_tags($post['jenis'])),
				'keterangan' => trim(strip_tags($post['ket']))
			);

			$this->m_guru->insert_dataTo($data,'tbl_prestasi_siswa');
			$this->setmessage('Prestasi siswa berhasil disimpan!','success');
			redirect('guru/input_prestasi?m=input_nilai&sm=prestasi');
		}
		
	}

	public function edit_prestasi_siswa()
	{
		//*Head*
		//tahun aktif
		$setup_tahun = $this->m_guru->get_ref_thn_aktif()->row();
		//semester aktif
		$setup_semester = $this->m_guru->select_dataWhere('status_semester=1','setup_semester')->row();

		$data['thn_aktif'] = $setup_tahun->tahun;
		$data['idtahun'] = $setup_tahun->id_tahun;
		$data['semester_aktif'] = ucwords($setup_semester->semester);
		$data['idsemester'] = $setup_semester->id_semester;

		$id_guru = $this->session->userdata('id');
		$where = array('id_guru' => $id_guru);
		$data['user'] = $this->m_guru->select_dataWhere($where,'data_guru');
						
		//*GetURI*/
		$get = $this->input->get();
		if($get['set']=='input'){
			$nis = $this->uri->segment(3);
			$data['siswa'] = $this->m_guru->select_cols('nis,nama_siswa','nis='.$nis.'','data_siswa');
			$data['idkelas'] = $this->uri->segment(4);
			$data['idwali'] = $this->uri->segment(5);
			$data['nama_kelas'] = $this->m_guru->select_cols('nama_kelas','id_kelas='.$data['idkelas'].'','setup_kelas')->row('nama_kelas');
			$data['page_title'] = '<h1>Input Prestasi Siswa '.$setup_tahun->tahun.' Semester '.$data['semester_aktif'].'</h1>';
			$data['type_form'] = "input";
			$data['content'] = "guru/v_form_input_prestasi";
		}
		else
		{
			$nis = $this->uri->segment(3);
			$idkelas = $this->uri->segment(4);
			$geturi5 = explode("-", $this->uri->segment(5));
				$idwali = $geturi5['0'];
				$idsemester = $geturi5['1'];
				$idtahun = $geturi5['2'];
				$where = "prestasi.nis=$nis AND prestasi.id_kelas=$idkelas AND prestasi.id_wali=$idwali AND prestasi.id_semester=$idsemester AND prestasi.id_tahun=$idtahun";
			$data['prestasi_siswa'] = $this->m_guru->lihat_prestasi_persiswa($where);
			$data['page_title'] = '<h1>Update Prestasi Siswa '.$setup_tahun->tahun.' Semester '.$data['semester_aktif'].'</h1>';
			$data['type_form'] = "update";
			$data['content'] = "guru/v_form_input_prestasi";
		}
			

		$this->load->view('guru/index',$data);
	}

	public function simpan_prestasi_siswa()
	{
		$post = $this->input->post();

		if(isset($post['insert']))
		{
			for ($ok=1; $ok<=10; $ok++)
			{
			   	$data = array(
			   		'nis' => trim($post['nis']),
			   		'id_kelas' => trim($post['idkelas']),
			   		'id_wali' => trim($post['idwali']),
			   		'id_semester' => trim($post['idsemester']),
			   		'id_tahun' => trim($post['idtahun']),
			   		'jenis_kegiatan' => trim(strip_tags($post['jenis'.$ok])),
			   		'keterangan' => trim(strip_tags($post['ket'.$ok]))
			   	);
			   	if($post['jenis'.$ok]!='' && $post['ket'.$ok]!='')
			   {
			   	$this->m_guru->insert_dataTo($data,'tbl_prestasi_siswa');
			   }
			  
			}

			$this->setmessage('Data Prestasi Siswa berhasil disimpan!','success');
			redirect('guru/input_prestasi?m=input_nilai&sm=prestasi');
		}

		if(isset($post['update']))
		{
			$jenis = $post['jenis'];
			foreach ($jenis as $key => $value) {
				$data = array(
			   		'jenis_kegiatan' => trim(strip_tags($post['jenis'][$key])),
			   		'keterangan' => trim(strip_tags($post['ket'][$key]))
			   	);
			   
				$where = array(
					'id_prestasi' => trim($post['idp'][$key])
				   
				);

				if($post['jenis'][$key]!='' && $post['ket'][$key]!='')
				{
				   	$this->m_guru->update_dataTable($where,$data,'tbl_prestasi_siswa');
				}else{
					$this->setmessage('Ups! Tidak dapat melanjutkan penyimpanan perubahan! Data tidak boleh kosong. Periksa lagi!','danger');
					redirect($post['back_url']);
				}
			}
			//proses tambah prestasi:
			if(!empty($post['jenis2'] OR $post['ket2']))
			{
				$data = array(
			   		'nis' => trim($post['nis']),
			   		'id_kelas' => trim($post['idkelas']),
			   		'id_wali' => trim($post['idwali']),
			   		'id_semester' => trim($post['idsemester']),
			   		'id_tahun' => trim($post['idtahun']),
			   		'jenis_kegiatan' => trim(strip_tags($post['jenis2'])),
			   		'keterangan' => trim(strip_tags($post['ket2']))
			   	);
				   			
					
					if($post['jenis2']!='' && $post['ket2']!='')
					{
					   	$this->m_guru->insert_dataTo($data,'tbl_prestasi_siswa');
					}else{
						$this->setmessage('Ups! Tidak dapat melanjutkan penyimpanan perubahan! Jika ingin menambah Prestasi Siswa data tidak boleh ada yang kosong. Periksa lagi!','danger');
						redirect($post['back_url']);
					}
			}


			$this->setmessage('Perubahan data berhasil disimpan!','success');
					redirect($post['back_url']);
		}
	}

	public function hapus_prestasi_siswa()
	{
		$idp = $this->uri->segment(3);
		$this->m_guru->delete_dataTable('id_prestasi='.$idp.'','tbl_prestasi_siswa');
		$back_url = $this->input->get('back');
		$get2 = $this->input->get('m');
		$get3 = $this->input->get('sm');
		$get = "&m=$get2&sm=$get3";

		$this->setmessage('Data berhasil dihapus!','success');
		redirect($back_url.$get);
	}



	/*
	|=================================================================================
	| 8) INPUT KEHADIRAN
	|=================================================================================
	*/
	
	public function input_kehadiran()
	{
		//*Head*
		//tahun aktif
		$setup_tahun = $this->m_guru->get_ref_thn_aktif()->row();
		//semester aktif
		$setup_semester = $this->m_guru->select_dataWhere('status_semester=1','setup_semester')->row();

		$data['thn_aktif'] = $setup_tahun->tahun;
		$data['idtahun'] = $setup_tahun->id_tahun;
		$data['semester_aktif'] = ucwords($setup_semester->semester);
		$data['idsemester'] = $setup_semester->id_semester;

		$id_guru = $this->session->userdata('id');
		$where = array('id_guru' => $id_guru);
		$data['user'] = $this->m_guru->select_dataWhere($where,'data_guru');
		$data['page_title'] = '<h1>Input Kehadiran Siswa '.$setup_tahun->tahun.' Semester '.$data['semester_aktif'].'</h1>';
		//$data['input_type'] = "deskripsi";

		//*Body*
		
		include "include/id_wali_kelas.php";
		$data['kelas'] = $this->m_guru->select_dataWhere('id_kelas='.$id_wali_kelas.'','setup_kelas');
		
		$data['cek_hadir'] = $this->m_guru->get_data_bkhadir($id_wali_kelas,$data['idtahun'],$data['idsemester']);
		

		$data['content'] = "guru/v_input_kehadiran";
		$this->load->view('guru/index',$data);
	}

	public function form_kehadiran()
	{
		//*Head*
		//tahun aktif
		$setup_tahun = $this->m_guru->get_ref_thn_aktif()->row();
		//semester aktif
		$setup_semester = $this->m_guru->select_dataWhere('status_semester=1','setup_semester')->row();

		$data['thn_aktif'] = $setup_tahun->tahun;
		$data['idtahun'] = $setup_tahun->id_tahun;
		$data['semester_aktif'] = ucwords($setup_semester->semester);
		$data['idsemester'] = $setup_semester->id_semester;

		$id_guru = $this->session->userdata('id');
		$where = array('id_guru' => $id_guru);
		$data['user'] = $this->m_guru->select_dataWhere($where,'data_guru');
				
		//*GetPost*/
		$post_idtahun = trim(htmlentities($this->input->post('idtahun')));
		$post_idkelas = trim(htmlentities($this->input->post('idkelas')));
		$post_semester = trim(htmlentities($this->input->post('semester')));
		$data['kelas'] = $this->m_guru->select_dataWhere('id_kelas='.$post_idkelas.'','setup_kelas');
		$data['id_kelas'] = $post_idkelas;
		//*Body*

		
		if(isset($_POST['input'])){
			$data['page_title'] = '<h1>Input Kehadiran Siswa '.$setup_tahun->tahun.' Semester '.$data['semester_aktif'].'</h1>';

			$data['data_kehadiran'] = $this->m_guru->get_siswa_bkhadir($post_idkelas,$post_idtahun);
			$data['jumSis'] = $data['data_kehadiran']->num_rows();
			$data['content'] = "guru/v_form_kehadiran";
		}elseif(isset($_POST['update']))
		{
			$data['page_title'] = '<h1>Update Kehadiran Siswa '.$setup_tahun->tahun.' Semester '.$data['semester_aktif'].'</h1>';
			$data['data_kehadiran'] = $this->m_guru->get_data_bkhadir($post_idkelas,$post_idtahun,$post_semester);
			$data['jumSis'] = $data['data_kehadiran']->num_rows();
			$data['content'] = "guru/v_form_up_kehadiran";
		}
		$this->load->view('guru/index',$data);
	}

	public function proses_simpan_kehadiran()
	{
		$post = $this->input->post();

		if(isset($post['insert']))
		{
			$jumSis = $post['jumlah'];
			for ($ok=1; $ok<=$jumSis; $ok++)
			{
			   $data[$ok]['nis'] = $post['nis'.$ok];
			   $data[$ok]['id_kelas'] = $post['id_kelas'];
			   $data[$ok]['id_tahun'] = $post['id_tahun']; 
			   $data[$ok]['semester'] = $post['semester'];
			   $data[$ok]['sakit']  = $post['a'.$ok];
			   $data[$ok]['izin'] = $post['b'.$ok];
			   $data[$ok]['tnp_ket'] = $post['c'.$ok];
			   //$data[$ok]['terlambat'] = $post['d'.$ok];
			   //$data[$ok]['meninggalkan_sek'] = $post['e'.$ok];
			   //$data[$ok]['tdk_upacara'] = $post['f'.$ok];
			   //$data[$ok]['pm_s'] = $post['g'.$ok];
			   //$data[$ok]['pm_i'] = $post['h'.$ok];
			   //$data[$ok]['pm_a'] = $post['i'.$ok];
			   //$data[$ok]['pm_t'] = $post['j'.$ok];			   			   
			}

			$this->m_guru->insert_batch('tbl_kehadiran',$data);
			$this->setmessage('Data Kehadiran berhasil disimpan!','success');
			redirect('guru/input_kehadiran?m=input_kehadiran');
		}

		if(isset($post['update']))
		{
			$jumSis = $post['jumlah'];
			for ($ok=1; $ok<=$jumSis; $ok++)
			{
			   
				$data = array(
				   	'sakit' => $post['a'.$ok],
				    'izin' => $post['b'.$ok],
				    'tnp_ket' => $post['c'.$ok]
				    //'terlambat' => $post['d'.$ok],
				    //'meninggalkan_sek' => $post['e'.$ok],
				    //'tdk_upacara' => $post['f'.$ok],
				    //'pm_s' => $post['g'.$ok],
				    //'pm_i' => $post['h'.$ok],
				    //'pm_a' => $post['i'.$ok],
				    //'pm_t' => $post['j'.$ok]
				);

				$where = array(
					'nis' => $post['nis'.$ok],
					'id_kelas' => $post['id_kelas'],
					'id_tahun' => $post['id_tahun'],
					'semester' => $post['semester']

				);
				$this->m_guru->update_dataTable($where,$data,'tbl_kehadiran');
			}

			$this->setmessage('Data Kehadiran berhasil diperbarui!','success');
			redirect('guru/input_kehadiran?m=input_kehadiran');
		}
	}

	/*
	|=================================================================================
	| 9) INPUT CATATAN WALI KELAS
	|=================================================================================
	*/
	
	public function input_catatanwk()
	{
		//*Head*
		//tahun aktif
		$setup_tahun = $this->m_guru->get_ref_thn_aktif()->row();
		//semester aktif
		$setup_semester = $this->m_guru->select_dataWhere('status_semester=1','setup_semester')->row();

		$data['thn_aktif'] = $setup_tahun->tahun;
		$data['idtahun'] = $setup_tahun->id_tahun;
		$data['semester_aktif'] = ucwords($setup_semester->semester);
		$data['idsemester'] = $setup_semester->id_semester;

		$id_guru = $this->session->userdata('id');
		$where = array('id_guru' => $id_guru);
		$data['user'] = $this->m_guru->select_dataWhere($where,'data_guru');
		$data['page_title'] = '<h1>Catatan Wali Kelas '.$setup_tahun->tahun.' Semester '.$data['semester_aktif'].'</h1>';
		//$data['input_type'] = "deskripsi";

		//*Body*
		
		include "include/id_wali_kelas.php";
		$data['wali_id_wali'] = $wali_id_wali;
		$data['kelas'] = $this->m_guru->select_dataWhere('id_kelas='.$id_wali_kelas.'','setup_kelas');
		
		$data['cek_catatan'] = $this->m_guru->get_catatan_walikelas2($id_wali_kelas,$data['idtahun'],$data['idsemester']);
		

		$data['content'] = "guru/v_catatanwk_listkelas";
		$this->load->view('guru/index',$data);
	}

	public function form_isi_catatanwk()
	{
		//*Head*
		//tahun aktif
		$setup_tahun = $this->m_guru->get_ref_thn_aktif()->row();
		//semester aktif
		$setup_semester = $this->m_guru->select_dataWhere('status_semester=1','setup_semester')->row();

		$data['thn_aktif'] = $setup_tahun->tahun;
		$data['idtahun'] = $setup_tahun->id_tahun;
		$data['semester_aktif'] = ucwords($setup_semester->semester);
		$data['idsemester'] = $setup_semester->id_semester;

		$id_guru = $this->session->userdata('id');
		$where = array('id_guru' => $id_guru);
		$data['user'] = $this->m_guru->select_dataWhere($where,'data_guru');
		include "include/id_wali_kelas.php";
		$data['wali_id_wali'] = $wali_id_wali;
				
		//*GetPost*/
		$post_idtahun = trim(htmlentities($this->input->post('idtahun')));
		$post_idkelas = trim(htmlentities($this->input->post('idkelas')));
		$post_semester = trim(htmlentities($this->input->post('semester')));
		$data['kelas'] = $this->m_guru->select_dataWhere('id_kelas='.$post_idkelas.'','setup_kelas');
		
		//*Body*

		
		if(isset($_POST['input'])){
			$data['page_title'] = '<h1>Input Catatan '.$setup_tahun->tahun.' Semester '.$data['semester_aktif'].'</h1>';
			$data['catatanwk'] = $this->m_guru->get_catatan_walikelas1($post_idkelas,$post_idtahun);
			$data['jumSis'] = $data['catatanwk']->num_rows();
			$data['content'] = "guru/v_form_input_catatanwk";
		}elseif(isset($_POST['update']))
		{
			$data['page_title'] = '<h1>Update Catatan '.$setup_tahun->tahun.' Semester '.$data['semester_aktif'].'</h1>';
			$data['catatanwk'] = $this->m_guru->get_catatan_walikelas2($post_idkelas,$post_idtahun,$post_semester);
			$data['jumSis'] = $data['catatanwk']->num_rows();
			$data['content'] = "guru/v_form_up_catatanwk";
		}

		$this->load->view('guru/index',$data);
	}

	public function simpan_catatanwk()
	{
		$post = $this->input->post();

		if(isset($post['insert']))
		{
			$jumSis = $post['jumlah'];
			for ($ok=1; $ok<=$jumSis; $ok++)
			{
			   $data[$ok]['nis'] = trim($post['nis'.$ok]);
			   $data[$ok]['id_kelas'] = trim($post['idkelas']);
			   $data[$ok]['id_wali'] = trim($post['idwali']);
			   $data[$ok]['id_semester'] = trim($post['idsemester']);
			   $data[$ok]['id_tahun'] = trim($post['idtahun']);
			   $data[$ok]['catatanwk'] = trim(strip_tags($post['catatanwk'.$ok]));
			}

			$this->m_guru->insert_batch('tbl_catatanwk',$data);
			$this->setmessage('Catatan Wali Kelas berhasil disimpan!','success');
			redirect('guru/input_catatanwk?m=catatan_wali_kelas');
		}

		if(isset($post['update']))
		{
			$jumSis = $post['jumlah'];
			for ($ok=1; $ok<=$jumSis; $ok++)
			{
			   
				$data = array(
				    'catatanwk' => trim(strip_tags($post['catatanwk'.$ok])),
				);

				$where = array(
					'nis' => trim(htmlentities($post['nis'.$ok])),
					'id_kelas' => trim(htmlentities($post['idkelas'])),
					'id_tahun' => trim(htmlentities($post['idtahun'])),
					'id_semester' => trim(htmlentities($post['idsemester']))
				);

				$this->m_guru->update_dataTable($where,$data,'tbl_catatanwk');
			}

			$this->setmessage('Catatan Wali Kelas berhasil diperbarui!','success');
			redirect('guru/input_catatanwk?m=catatan_wali_kelas');
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

		
	public function laporan_per_mapel()
	{
		//*Head*
		//tahun aktif
		$setup_tahun = $this->m_guru->get_ref_thn_aktif()->row();
		//semester aktif
		$setup_semester = $this->m_guru->select_dataWhere('status_semester=1','setup_semester')->row();

		$data['thn_aktif'] = $setup_tahun->tahun;
		$data['idtahun'] = $setup_tahun->id_tahun;
		$data['semester_aktif'] = ucwords($setup_semester->semester);
		$data['idsemester'] = $setup_semester->id_semester;

		$id_guru = $this->session->userdata('id');
		$where = array('id_guru' => $id_guru);
		$data['user'] = $this->m_guru->select_dataWhere($where,'data_guru');
		$data['page_title'] = '<h1>Laporan Per Mapel '.$setup_tahun->tahun.' Semester '.$data['semester_aktif'].'</h1>';
		
		if(isset($_POST['submit']))
		{
			$id_kelas = $this->input->post('idkelas');
			$data['post_idkelas'] = $id_kelas;
		}
		else
		{
			$id_kelas = $this->m_guru->get_kelas_mengajar($id_guru,$data['idsemester'],$data['idtahun'])->row('id_kelas');
			$data['post_idkelas'] = $id_kelas;		
		}

		$data['kelas'] = $this->m_guru->get_kelas_mengajar($id_guru,$data['idsemester'],$data['idtahun']);
		
		//legger-list_siswa
		$data['list_siswa'] = $this->m_guru->get_siswa_dikelas($id_kelas,$setup_tahun->id_tahun);
		//legger-list_mapel yang diampu
		$data['list_mapel'] = $this->m_guru->get_mapel_diampu($id_guru,$id_kelas,$data['idsemester'],$data['idtahun']);

		$data['pd_semester'] = $setup_semester->semester;
		$data['pd_tahun'] = $setup_tahun->tahun;
		$data['nama_kelas'] = $this->m_guru->select_dataWhere('id_kelas='.$id_kelas.'','setup_kelas')->row('nama_kelas');
		
		

		$data['content'] = "guru/v_laporan_nilai_diampu";
		$this->load->view('guru/index',$data);
	}

	public function laporan_legger_semua()
	{
		//Export Excel::
		if(isset($_POST['export_excel']))
		{
			header("Content-type:application/vnd-ms-excel");
			header("Content-Disposition:attachment; filename=laporan_legger_nilai.xls");


			$idkelas = $this->input->post('kelas');
			$where = array('id_tahun' => $this->input->post('tahun'));
			$setup_tahun = $this->m_guru->select_dataWhere($where,'setup_tahun')->row();
			$semester = $this->input->post('semester');

				//data_post
			$data['post_idkelas'] = $idkelas;
			$data['post_idtahun'] = $setup_tahun->id_tahun;
			$data['post_idsemester'] = $semester;

			//legger-list_siswa
			$data['list_siswa'] = $this->m_guru->get_list_siswa($idkelas,$setup_tahun->id_tahun);
			//legger-list_mapel
			//$data['list_mapel'] = $this->m_guru->select_table_orderby('id_pelajaran ASC','setup_pelajaran');
			$data['list_mapel'] = $this->m_guru->get_list_mapel_sesuai($idkelas,$setup_tahun->id_tahun,$semester);


			$data['pd_semester'] = $this->m_guru->select_dataWhere('id_semester='.$semester.'','setup_semester')->row('semester');
			$data['pd_tahun'] = $setup_tahun->tahun;
			$data['nama_kelas'] = $this->m_guru->select_dataWhere('id_kelas='.$idkelas.'','setup_kelas')->row('nama_kelas');
			
			$this->load->view('guru/v_export_excel_legger',$data);

		}

		$id_guru = $this->session->userdata('id');
		//------------------
		//Filtering KKM::
		if(isset($_POST['sort_legger']))
		{
			//$per_hlm = $this->input->post('rows');
			$idkelas = $this->input->post('kelas');
			$where = array('id_tahun' => $this->input->post('tahun'));
			$setup_tahun = $this->m_guru->select_dataWhere($where,'setup_tahun')->row();
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
			$setup_tahun = $this->m_guru->select_dataWhere($where,'setup_tahun')->row();
		}
		else
		{
			//Default:
			//$per_hlm = 5;
			//Defaultnya id_kelas yang diampu (wali kelas);
			
			$where = array('status_semester' => 1);
			$semester = $this->m_guru->select_dataWhere($where,'setup_semester')->row('id_semester'); 
						
			$where = array('status_aktif' => 1);
			$setup_tahun = $this->m_guru->select_dataWhere($where,'setup_tahun')->row();

			$idkelas=$this->m_guru->get_kelas_walikelas($id_guru,$setup_tahun->id_tahun)->row('id_kelas');
		}
		//EndFiltering

		
		$where = array('id_guru' => $id_guru);
		$data['user'] = $this->m_guru->select_dataWhere($where,'data_guru');
		$data['page_title'] = "<h1>Laporan Legger Semua Mapel</h1>";
		//$data['kelas'] = $this->m_guru->select_table_orderby('nama_kelas ASC','setup_kelas');
		//hanya menampilkan wali kelas yang ia ampu..
		$data['kelas'] = $this->m_guru->get_kelas_walikelas($id_guru,$setup_tahun->id_tahun);
		$data['tahun'] = $this->m_guru->select_dataWhere('id_tahun='.$setup_tahun->id_tahun.'','setup_tahun');
		$data['semester'] = $this->m_guru->select_dataWhere('id_semester='.$semester.'','setup_semester');
		//data_post
		$data['post_idkelas'] = $idkelas;
		$data['post_idtahun'] = $setup_tahun->id_tahun;
		$data['post_idsemester'] = $semester;

		//legger-list_siswa
		$data['list_siswa'] = $this->m_guru->get_list_siswa($idkelas,$setup_tahun->id_tahun);
		//legger-list_mapel pada semester, tahun, dan kelas yang sudah ditentukan...
		//lama: $data['list_mapel'] = $this->m_guru->select_table_orderby('id_pelajaran ASC','setup_pelajaran');
		//update:
		$data['list_mapel'] = $this->m_guru->get_list_mapel_sesuai($idkelas,$setup_tahun->id_tahun,$semester);


		$data['pd_semester'] = $this->m_guru->select_dataWhere('id_semester='.$semester.'','setup_semester')->row('semester');
		$data['pd_tahun'] = $setup_tahun->tahun;
		$data['nama_kelas'] = $this->m_guru->select_dataWhere('id_kelas='.$idkelas.'','setup_kelas')->row('nama_kelas');
		
		$data['content'] = "guru/v_legger_semua";
		$this->load->view('guru/index',$data);
	}


	function index_pengumuman()
	{
		$id_guru = $this->session->userdata('id');
		$where = array('id_guru' => $id_guru);
		$data['user'] = $this->m_guru->select_dataWhere($where,'data_guru');
		$data['page_title'] = 'Pengumuman';
		$data_pengumuman = $this->m_guru->data_pengumuman();
		//Pgination Config::
		$siteurl = site_url('guru/index_pengumuman/');
		$rows = $data_pengumuman->num_rows();
		$perpage = 10;
		$urisegment = 3;
		$Mfunction = "data_pengumuman_wp";
		//$key = $setup_tahun->id_tahun;
		$model = "m_guru";
		$type = "tanpa_where";
		include("pagination_config.php");
		//end Pagination::
		$data['content'] = "guru/v_index_pengumuman";
		$this->load->view('guru/index',$data);
	}





}
