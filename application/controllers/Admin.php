<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {


	function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('m_admin');
		$this->load->model('m_cetak');
		$this->load->library('pagination');
		date_default_timezone_set("Asia/Jakarta");
		if($this->session->userdata('status') != "admin"){
			redirect('login');
		}

	}
	
	/*
	|=================================================================================
	| 1) BAGIAN DASHBOARD
	|=================================================================================
	*/

	public function index()
	{
		$id_admin = $this->session->userdata('id');
		$where = array('id_admin' => $id_admin);
		$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');
		$data['page_title'] = '';

		//Memeriksa status system::
		$data['tahun_aktif'] = $this->m_admin->select_dataWhere('status_aktif=1','setup_tahun');
		$id_thn_aktif = $data['tahun_aktif']->row('id_tahun');
		$data['semester_aktif'] = $this->m_admin->select_dataWhere('status_semester=1','setup_semester');
		$id_semester = $data['semester_aktif']->row('id_semester');
		$data['setup_tahun'] = $this->db->query("SELECT id_tahun FROM setup_tahun")->num_rows();
		$data['setup_semester'] = $this->db->query("SELECT id_semester FROM setup_semester")->num_rows();
		$data['setup_kelas'] = $this->db->query("SELECT id_kelas FROM setup_kelas")->num_rows();
		$data['setup_pelajaran'] = $this->db->query("SELECT id_pelajaran FROM setup_pelajaran")->num_rows();
		$data['kepsek'] = $this->db->query("SELECT id_kepsek FROM tbl_kepsek WHERE id_tahun=$id_thn_aktif AND id_semester=$id_semester")->num_rows();
		$data['input_ekstra'] = $this->db->query("SELECT id_ekstra FROM ekstrakurikuler")->num_rows();
		$data['kkm'] = $this->db->query("SELECT id_kkm FROM tbl_kkm WHERE id_tahun=$id_thn_aktif")->num_rows();
		$data['identitas_sekolah'] = $this->db->query("SELECT id FROM info_sekolah")->num_rows();

		$data['dataguru'] = $this->db->query("SELECT id_guru FROM data_guru")->num_rows();
		$data['datasiswa'] = $this->db->query("SELECT id_siswa FROM data_siswa")->num_rows();
		$data['tdk_punya_kls'] = $this->db->query("SELECT nis FROM data_siswa WHERE nis NOT IN (SELECT nis FROM tbl_ruangan)")->num_rows();
		$data['pembagian_kelas'] = $this->db->query("SELECT id_ruangan FROM tbl_ruangan WHERE id_tahun=$id_thn_aktif")->num_rows();
		$data['tbjadwal'] = $this->db->query("SELECT id_jadwal FROM tbl_jadwal WHERE id_tahun=$id_thn_aktif AND id_semester=$id_semester")->num_rows();
		$data['wali_kelas'] = $this->db->query("SELECT id_wali FROM tbl_wali WHERE id_tahun=$id_thn_aktif")->num_rows();


		//end proses::
		
		// $data['content'] = "admin/v_dashboard";
		$this->load->view('head');
		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('content');
		$this->load->view('footer');
	}

	/*
	|=================================================================================
	| 2) BAGIAN SET PROFILE
	|=================================================================================
	*/

	public function set_profile()
	{
		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('nip','NIP','required');
		$this->form_validation->set_rules('jk','Jenis Kelamin','required');
		$this->form_validation->set_rules('alamat_admin','Alamat','required');
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
			$this->session->set_flashdata('profil_open', '<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <h4><i class="fa fa-warning"></i> Gagal</h4>');

			if($this->form_validation->run()==FALSE)
			{
				$this->session->set_flashdata('validation_errors', validation_errors());
			}

			if(!empty($_FILES['userfile']['name']) && !$this->upload->do_upload('userfile'))
			{
				$this->session->set_flashdata('upload_errors', $this->upload->display_errors());
			}

			$this->session->set_flashdata('profil_close', '</div>');

			redirect('admin?m=dashboard#profil');

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
					'nama_admin' => $post['nama'],
					'nip' => $post['nip'],
					'kelamin' => $post['jk'],
					'alamat_admin' => $post['alamat_admin'],
					'telpon_admin' => $post['telpon'],
					'username' => $post['username'],
					'foto_admin' => $foto['file_name']
					
				);

				//del foto lama from direktori
					if($post['fotolm']!='')
					{
						unlink('./assets/photos/'.$post['fotolm']);
					}


			}else{
				$post = $this->input->post();
				$data = array(
					'nama_admin' => trim(strip_tags($post['nama'])),
					'nip' => trim(strip_tags($post['nip'])),
					'kelamin' => trim($post['jk']),
					'alamat_admin' => trim(strip_tags($post['alamat_admin'])),
					'telpon_admin' => trim(strip_tags($post['telpon'])),
					'username' => trim(strip_tags($post['username']))
				);
			}
			

			//Simpan::
			$where = array('id_admin' => $post['id_admin']);
			$this->m_admin->update_dataTable($where,$data,'user_admin');

			$this->session->set_flashdata('profil_sukses', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <h4><i class="fa fa-check-circle"></i> Sukses</h4> Profil berhasil diperbarui </div>');

			redirect('admin?m=dashboard#profil');
		}

	}

	public function change_password()
	{
		$post=$this->input->post();
		$idadmin = $this->session->userdata('id');
		

		$this->form_validation->set_rules('pwd_saat_ini','Password saat ini','required');
		$this->form_validation->set_rules('pwd_baru','Password Baru','required');
		$this->form_validation->set_rules('pwd_confirm','Password Konfirmasi','required|matches[pwd_baru]');
		if($this->form_validation->run()==FALSE)
		{
			$this->setmessage(validation_errors(),'warning');
			redirect('admin');
		}

		$where = array(
			'id_admin' => $idadmin,
			'password' => md5($post['pwd_saat_ini'])
		);
		$cekpwd = $this->m_admin->select_dataWhere($where,'user_admin')->num_rows();
		if($cekpwd>0)
		{
			$data = array(
				'password' => md5($post['pwd_baru'])
			);

			$this->m_admin->update_dataTable('id_admin='.$idadmin.'',$data,'user_admin');
			$this->setmessage('Password berhasil diperbarui!','success');
			redirect('admin');
		}
		else
		{
			$this->setmessage('<b>Password saat ini, salah!</b>','danger');
			redirect('admin');
		}
	}

	/*
	|=================================================================================
	| 3) BAGIAN SETUP KELAS
	|=================================================================================
	*/

	public function setup_kelas()
	{
		
		$id_admin = $this->session->userdata('id');
		$where = array('id_admin' => $id_admin);
		$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');
		$data['page_title'] = "<h1>Setup Kelas<small>mengelola pengaturan kelas</small></h1>";
		$data['datakelas'] = $this->m_admin->select_table_orderby('nama_kelas ASC','setup_kelas');
		//Pgination Config::
		$siteurl = site_url('admin/setup_kelas/');
		$rows = $data['datakelas']->num_rows();
		$perpage = 10;
		$urisegment = 3;
		$Mfunction = "data_kelas_wp";
		//$key = $setup_tahun->id_tahun;
		$model = "m_admin";
		$type = "tanpa_where";
		include("pagination_config.php");
		//end Pagination::
		$data['content'] = "admin/v_setup_kelas";
		$this->load->view('admin/index',$data);
	}

	public function create_kelas()
	{
		$this->form_validation->set_rules('nama_kelas','Nama Kelas','required|max_length[10]');
		$this->form_validation->set_rules('kategori_kls','Kategori Kelas','required');

		if($this->form_validation->run()==FALSE)
		{
			$this->session->set_flashdata('error_open', '<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <h4><i class="fa fa-warning"></i> Gagal</h4>');

			$this->session->set_flashdata('validation_errors', validation_errors()); 

			$this->session->set_flashdata('error_close', '</div>'); 
			redirect('admin/setup_kelas/?m=setup&sm=kelas');
		}
		else
		{
			$data = array(
				'nama_kelas' => $this->input->post('nama_kelas'),
				'kategori_kls' => $this->input->post('kategori_kls')
			);
			$this->m_admin->insert_dataTo($data,'setup_kelas');

			$this->session->set_flashdata('sukses', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <h4><i class="fa fa-check-circle"></i> Sukses!</h4> Alhamdulillah yaa, Kelas berhasil ditambahkan :) </div>');

			redirect('admin/setup_kelas/?m=setup&sm=kelas');
		}

	}

	//-->> Multi Action <<--
	public function aksi_kelas()
	{
		$post = $this->input->post();

		if(isset($post['multidelete'])){
			$check = $post['check'];
			$jml = count($check);
			if(isset($check)){
				
				//menghapus data di database
				$cols = "id_kelas";
				$this->m_admin->del_selected_data($post,'setup_kelas',$cols);

			$this->session->set_flashdata('sukses', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="fa fa-check-circle"></i> Sukses!</h4> Berhasil menghapus '.$jml.' data kelas.</div>');

			redirect('admin/setup_kelas?m=setup&sm=kelas');
			}else{
				$this->session->set_flashdata('error_open', '<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <h4><i class="fa fa-warning"></i> Ups, Terjadi kesalahan!</h4> Tidak ada data yang dipilih!');

				$this->session->set_flashdata('error_close', '</div>'); 
		
				redirect('admin/setup_kelas?m=setup&sm=kelas');
			}
		}

		if(isset($post['multiedit'])){
			$check = $post['check'];
			if(isset($check)){
				
				$cols = "id_kelas";
			$data['select_kelas'] = $this->m_admin->get_selected_data($post,'setup_kelas',$cols);

			$id_admin = $this->session->userdata('id');
			$where = array('id_admin' => $id_admin);
			$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');
			$data['page_title'] = "<h1>Edit Kelas<small>melakukan perubahan data kelas</small></h1>";
			$data['tipe_form'] = "multi";
			$data['content'] = "admin/v_edit_kelas";
			$this->load->view('admin/index',$data);

			}else{
				$this->session->set_flashdata('error_open', '<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <h4><i class="fa fa-warning"></i> Ups, Terjadi kesalahan!</h4> Tidak ada data yang dipilih!');

				$this->session->set_flashdata('error_close', '</div>'); 
		
				redirect('admin/setup_kelas?m=setup&sm=kelas');
			}
		}
	}

	public function update_kelas()
	{
		$this->form_validation->set_rules('nama_kelas[]','Nama Kelas','required|max_length[10]');
		$this->form_validation->set_rules('kategori_kls[]','Kategori Kelas','required');

		if($this->form_validation->run()==FALSE)
		{
			$this->session->set_flashdata('error_open', '<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <h4><i class="fa fa-warning"></i> Gagal</h4>');

			$this->session->set_flashdata('validation_errors', validation_errors()); 

			$this->session->set_flashdata('error_close', '</div>'); 
			redirect('admin/setup_kelas/?m=setup&sm=kelas');
		}
		else
		{
			$id_kelas = $this->input->post('id_kelas');
			$nama_kelas = $this->input->post('nama_kelas');
			$kategori_kls = $this->input->post('kategori_kls');
			$jml = count($id_kelas);

			//-->> Perulangan <<--

			foreach ($id_kelas as $key => $value) {
				$data = array(
					'nama_kelas' => $nama_kelas[$key],
					'kategori_kls' => $kategori_kls[$key],
				);
				$where = array('id_kelas' => $id_kelas[$key]);
				$this->m_admin->update_dataTable($where,$data,'setup_kelas');
			}

			//-->> Set Message <<--
			$this->session->set_flashdata('sukses', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="fa fa-check-circle"></i> Sukses!</h4> Berhasil memperbarui '.$jml.' data kelas.</div>');

			redirect('admin/setup_kelas/?m=setup&sm=kelas');
			
		}
	}

	//-->> Singgle Action <<--
	public function edit_kelas()
	{
		$where = array('id_kelas' => $this->uri->segment(3));
		$data['select_kelas'] = $this->m_admin->select_dataWhere($where,'setup_kelas');

		$id_admin = $this->session->userdata('id');
		$where = array('id_admin' => $id_admin);
		$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');
		$data['page_title'] = "<h1>Edit Kelas<small>melakukan perubahan data kelas</small></h1>";
		$data['tipe_form'] = "multi";
		$data['content'] = "admin/v_edit_kelas";
		$this->load->view('admin/index',$data);
	}

	public function drop_kelas()
	{
		$where = array('id_kelas' => $this->uri->segment(3));
		$this->m_admin->delete_dataTable($where,'setup_kelas');

		$this->session->set_flashdata('sukses', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="fa fa-check-circle"></i> Sukses!</h4> Berhasil menghapus data kelas.</div>');

		redirect('admin/setup_kelas?m=setup&sm=kelas');

	}


	/*
	|=================================================================================
	| 4) BAGIAN SETUP PELAJARAN
	|=================================================================================
	*/

	public function setup_pelajaran()
	{
		
		$id_admin = $this->session->userdata('id');
		$where = array('id_admin' => $id_admin);
		$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');
		$data['page_title'] = "<h1>Setup Pelajaran<small> mengelola pengaturan Mata Pelajaran</small></h1>";
		$data['datamapel'] = $this->m_admin->select_table_orderby('nama_pelajaran ASC','setup_pelajaran');
		$data['kat_mapel'] = $this->m_admin->select_table_orderby('kategori_mapel ASC','tbl_kategori_mapel');
		//Pgination Config::
		/*$siteurl = site_url('admin/setup_pelajaran/');
		$rows = $data['datamapel']->num_rows();
		$perpage = 10;
		$urisegment = 3;
		$Mfunction = "data_mapel_wp";
		//$key = $setup_tahun->id_tahun;
		$model = "m_admin";
		$type = "tanpa_where";
		include("pagination_config.php");*/
		//end Pagination::
		$data['content'] = "admin/v_setup_pelajaran";
		$this->load->view('admin/index',$data);
	}

	public function create_mapel()
	{
		$this->form_validation->set_rules('nama_pelajaran','Nama Mata Pelajaran','required|max_length[50]');
		
		if($this->form_validation->run()==FALSE)
		{
			$this->session->set_flashdata('error_open', '<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <h4><i class="fa fa-warning"></i> Gagal</h4>');

			$this->session->set_flashdata('validation_errors', validation_errors()); 

			$this->session->set_flashdata('error_close', '</div>'); 
			redirect('admin/setup_pelajaran/?m=setup&sm=pelajaran');
		}
		else
		{
			$data = array(
				'id_kat_mapel' => $this->input->post('kat_mapel'),
				'nama_pelajaran' => $this->input->post('nama_pelajaran'),
				'sub_mapel' => $this->input->post('sub_mapel')
				);
			$this->m_admin->insert_dataTo($data,'setup_pelajaran');

			$this->session->set_flashdata('sukses', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <h4><i class="fa fa-check-circle"></i> Sukses!</h4> Alhamdulillah yaa, Mata Pelajaran berhasil ditambahkan :) </div>');

			redirect('admin/setup_pelajaran?m=setup&sm=pelajaran');
		}

	}

	//-->> Multi Action <<--
	public function aksi_mapel()
	{
		$post = $this->input->post();

		if(isset($post['multidelete'])){
			$check = $post['check'];
			$jml = count($check);
			if(isset($check)){
				
				//menghapus data di database
				$cols = "id_pelajaran";
				$this->m_admin->del_selected_data($post,'setup_pelajaran',$cols);

			$this->session->set_flashdata('sukses', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="fa fa-check-circle"></i> Sukses!</h4> Berhasil menghapus '.$jml.' data Mata Pelajaran.</div>');

			redirect('admin/setup_pelajaran?m=setup&sm=pelajaran');
			}else{
				$this->session->set_flashdata('error_open', '<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <h4><i class="fa fa-warning"></i> Ups, Terjadi kesalahan!</h4> Tidak ada data yang dipilih!');

				$this->session->set_flashdata('error_close', '</div>'); 
		
				redirect('admin/setup_pelajaran?m=setup&sm=pelajaran');
			}
		}

		if(isset($post['multiedit'])){
			$check = $post['check'];
			if(isset($check)){
				
				
				$cols = "id_pelajaran";
			$data['select_mapel'] = $this->m_admin->get_selected_data($post,'setup_pelajaran',$cols);
			$data['kat_mapel'] = $this->m_admin->select_table_orderby('kategori_mapel ASC','tbl_kategori_mapel');
			$data['datamapel'] = $this->m_admin->select_table_orderby('nama_pelajaran ASC','setup_pelajaran');
			$id_admin = $this->session->userdata('id');
			$where = array('id_admin' => $id_admin);
			$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');
			$data['page_title'] = "<h1>Edit Mata Pelajaran<small>melakukan perubahan Mata Pelajaran</small></h1>";
			$data['tipe_form'] = "multi";
			$data['content'] = "admin/v_edit_pelajaran";
			$this->load->view('admin/index',$data);

			}else{
				$this->session->set_flashdata('error_open', '<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <h4><i class="fa fa-warning"></i> Ups, Terjadi kesalahan!</h4> Tidak ada data yang dipilih!');

				$this->session->set_flashdata('error_close', '</div>'); 
		
				redirect('admin/setup_pelajaran?m=setup&sm=pelajaran');
			}
		}
	}

	public function update_mapel()
	{
		$this->form_validation->set_rules('nama_pelajaran[]','Nama Mata Pelajaran','required|max_length[50]');
		
		if($this->form_validation->run()==FALSE)
		{
			$this->session->set_flashdata('error_open', '<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <h4><i class="fa fa-warning"></i> Gagal</h4>');

			$this->session->set_flashdata('validation_errors', validation_errors()); 

			$this->session->set_flashdata('error_close', '</div>'); 
			redirect('admin/setup_pelajaran/?m=setup&sm=pelajaran');
		}
		else
		{
			$id_pelajaran = $this->input->post('id_pelajaran');
			$nama_pelajaran = $this->input->post('nama_pelajaran');
			$kat_mapel = $this->input->post('kat_mapel');
			$sub_mapel = $this->input->post('sub_mapel');
			
			$jml = count($id_pelajaran);

			//-->> Perulangan <<--

			foreach ($id_pelajaran as $key => $value) {
				
				$data[$key]['id_pelajaran'] = $id_pelajaran[$key];
				$data[$key]['id_kat_mapel'] = $kat_mapel[$key];
				$data[$key]['sub_mapel'] = $sub_mapel[$key];
				$data[$key]['nama_pelajaran'] = $nama_pelajaran[$key];
				
				//$where = array('id_pelajaran' => $id_pelajaran[$key]);
				
			}
			$this->m_admin->update_batch('setup_pelajaran',$data,'id_pelajaran');

			//-->> Set Message <<--
			$this->session->set_flashdata('sukses', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="fa fa-check-circle"></i> Sukses!</h4> Berhasil memperbarui '.$jml.' data Mata Pelajaran.</div>');

			redirect('admin/setup_pelajaran/?m=setup&sm=pelajaran');
			
		}
	}

	//-->> Singgle Action <<--
	public function edit_mapel()
	{
		$where = array('id_pelajaran' => $this->uri->segment(3));
		$data['select_mapel'] = $this->m_admin->select_dataWhere($where,'setup_pelajaran');
		$data['kat_mapel'] = $this->m_admin->select_table_orderby('kategori_mapel ASC','tbl_kategori_mapel');
		$data['datamapel'] = $this->m_admin->select_table_orderby('nama_pelajaran ASC','setup_pelajaran');
		$id_admin = $this->session->userdata('id');
		$where = array('id_admin' => $id_admin);
		$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');
		$data['page_title'] = "<h1>Edit Mata Pelajaran<small>melakukan perubahan Mata Pelajaran</small></h1>";
		$data['tipe_form'] = "multi";
		$data['content'] = "admin/v_edit_pelajaran";
		$this->load->view('admin/index',$data);
	}

	public function drop_mapel()
	{
		$where = array('id_pelajaran' => $this->uri->segment(3));
		$this->m_admin->delete_dataTable($where,'setup_pelajaran');

		$this->session->set_flashdata('sukses', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="fa fa-check-circle"></i> Sukses!</h4> Berhasil menghapus mata pelajaran.</div>');

		redirect('admin/setup_pelajaran?m=setup&sm=pelajaran');


	}

	/*
	|=================================================================================
	| 5) SETUP TAHUN PELAJARAN
	|=================================================================================
	*/
	public function setup_tahun_pelajaran()
	{
		
		$id_admin = $this->session->userdata('id');
		$where = array('id_admin' => $id_admin);
		$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');
		$data['page_title'] = "<h1>Setup Tahun Pelajaran<small> mengelola Tahun Pelajaran</small></h1>";
		$data['thn_pelajaran'] = $this->m_admin->select_table_orderby('id_tahun ASC','setup_tahun');
		$data['semester'] = $this->m_admin->select_dataWhere('status_semester = 1','setup_semester');
		
		$data['content'] = "admin/v_setup_tahun_pelajaran";
		$this->load->view('admin/index',$data);
	}

	public function create_tahun_pelajaran()
	{
		$this->form_validation->set_rules('tahun','Tahun Pelajaran','required');
		
		if($this->form_validation->run()==FALSE)
		{
			$this->setmessage(validation_errors(),'warning'); 

			redirect('admin/setup_tahun_pelajaran/?m=setup&sm=tahun_pelajaran');
		}
		else
		{
			$data = array(
				'tahun' => $this->input->post('tahun')
				);
			$this->m_admin->insert_dataTo($data,'setup_tahun');

			$this->setmessage('Alhamdulillah yaa, Tahun Pelajaran berhasil ditambahkan :)','success');

			redirect('admin/setup_tahun_pelajaran?m=setup&sm=tahun_pelajaran');
		}

	}

	//-->> Multi Action <<--
	public function aksi_tahun()
	{
		$post = $this->input->post();

		if(isset($post['multidelete'])){
			$check = $post['check'];
			$jml = count($check);
			if(isset($check)){
				
				//menghapus data di database
				$cols = "id_tahun";
				$this->m_admin->del_selected_data($post,'setup_tahun',$cols);

			$this->setmessage('Tahun Pelajaran berhasil dihapus..','success');

			redirect('admin/setup_tahun_pelajaran?m=setup&sm=tahun_pelajaran');
			}else{
				$this->setmessage('Tidak ada data yang dipilih!','warning');

				redirect('admin/setup_tahun_pelajaran?m=setup&sm=tahun_pelajaran');
			}
		}

		if(isset($post['multiedit'])){
			$check = $post['check'];
			if(isset($check)){
				
				
				$cols = "id_tahun";
			$data['select_tahun'] = $this->m_admin->get_selected_data($post,'setup_tahun',$cols);

			$id_admin = $this->session->userdata('id');
			$where = array('id_admin' => $id_admin);
			$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');
			$data['page_title'] = "<h1>Edit Tahun Pelajaran<small>melakukan perubahan Tahun Pelajaran</small></h1>";
			$data['tipe_form'] = "multi";
			$data['content'] = "admin/v_edit_tahun_pelajaran";
			$this->load->view('admin/index',$data);

			}else{
				$this->setmessage('Tidak ada data yang dipilih!','warning');
		
				redirect('admin/setup_tahun_pelajaran?m=setup&sm=tahun_pelajaran');
			}
		}

		if(isset($post['onkan'])){
			$check = $post['check'];
			if(isset($check)){
						
			$aksi_on = $this->m_admin->set_tahun_on($post);
			
				$this->setmessage('Berhasil melakukan perubahan Tahun Pelajaran aktif!','success');	
			
			redirect('admin/setup_tahun_pelajaran?m=setup&sm=tahun_pelajaran');	

			}else{
				$this->setmessage('Tidak ada data yang dipilih!','warning');
		
				redirect('admin/setup_tahun_pelajaran?m=setup&sm=tahun_pelajaran');
			}
		}
	}

	public function update_tahun()
	{
		$this->form_validation->set_rules('tahun[]','Tahun Pelajaran','required');
		
		if($this->form_validation->run()==FALSE)
		{
			$this->setmessage(validation_errors(),'warning'); 
			redirect('admin/setup_tahun_pelajaran/?m=setup&sm=tahun_pelajaran');
		}
		else
		{
			$id_tahun = $this->input->post('id_tahun');
			$tahun = $this->input->post('tahun');
			
			$jml = count($id_tahun);

			//-->> Perulangan <<--

			foreach ($id_tahun as $key => $value) {
				$data = array(
					'tahun' => $tahun[$key],
				);
				$where = array('id_tahun' => $id_tahun[$key]);
				$this->m_admin->update_dataTable($where,$data,'setup_tahun');
			}

			//-->> Set Message <<--
			$this->setmessage('Berhasil memperbarui '.$jml.' data Tahun Pelajaran.','success');

			redirect('admin/setup_tahun_pelajaran/?m=setup&sm=tahun_pelajaran');
			
		}
	}

	//-->> Singgle Action <<--
	public function edit_tahun()
	{
		$where = array('id_tahun' => $this->uri->segment(3));
		$data['select_tahun'] = $this->m_admin->select_dataWhere($where,'setup_tahun');

		$id_admin = $this->session->userdata('id');
		$where = array('id_admin' => $id_admin);
		$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');
		$data['page_title'] = "<h1>Edit Tahun Pelajaran<small>melakukan perubahan Tahun Pelajaran</small></h1>";
		$data['tipe_form'] = "multi";
		$data['content'] = "admin/v_edit_tahun_pelajaran";
		$this->load->view('admin/index',$data);
	}

	public function drop_tahun()
	{
		$where = array('id_tahun' => $this->uri->segment(3));
		$this->m_admin->delete_dataTable($where,'setup_tahun');

		$this->setmessage('Berhasil menghapus mata pelajaran.','success');

		redirect('admin/setup_tahun_pelajaran?m=setup&sm=tahun_pelajaran');

	}

	public function set_semester()
	{
		$id_semester = trim(htmlentities($this->input->post('semester')));
		$this->m_admin->set_on_semester($id_semester);
		$this->setmessage('Pengaturan semester aktif telah disimpan!','success');
		redirect('admin/setup_tahun_pelajaran?m=setup&sm=tahun_pelajaran');
	}

	/*
	|=================================================================================
	| 6) BAGIAN SETUP KKM
	|=================================================================================
	*/
	public function setup_kkm()
	{
		//Set default:
		//tahun aktif;
		$where = array('status_aktif' => 1);
		$setup_tahun = $this->m_admin->select_dataWhere($where,'setup_tahun')->row();
		//set kategori_kls
		$kategori_kls = $this->m_admin->select_table_orderby('kategori_kls ASC','setup_kelas')->row('kategori_kls');
		
		$id_admin = $this->session->userdata('id');
		$where = array('id_admin' => $id_admin);
		$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');
		$data['page_title'] = "<h1>Setup KKM<small> Penentuan KKM mapel sesuai kategori kelas</small></h1>";
		$get_tbl_kkm = $this->m_admin->select_tbl_kkm($setup_tahun->id_tahun,$kategori_kls);
		$data['pd_tahun'] = $setup_tahun->tahun;
		$data['id_tahun'] = $setup_tahun->id_tahun;
		$data['tahun_ajaran'] = $this->m_admin->select_table_orderby('tahun ASC','setup_tahun');
		$data['mapel'] = $this->m_admin->select_table_orderby('nama_pelajaran ASC','setup_pelajaran');

		if($get_tbl_kkm->num_rows()>0)
		{
			$data['type_form'] = "update";
			$data['tbl_kkm'] = $get_tbl_kkm;
			$data['mapel_notset'] = $this->m_admin->select_mapel_notset_kkm($data['id_tahun'],$kategori_kls);
			$data['kategori_kls'] = $kategori_kls;
		}
		else
		{
			$data['type_form'] = "input";
			$data['tbl_kkm'] = $this->m_admin->get_list_mapel();
			$data['kategori_kls'] = $kategori_kls;	
		}
		
		$data['content'] = "admin/v_setup_kkm";
		$this->load->view('admin/index',$data);
	}

	public function set_kkm()
	{
		$id_admin = $this->session->userdata('id');
		$where = array('id_admin' => $id_admin);
		$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');
		$data['page_title'] = "<h1>Setup KKM<small> Penentuan KKM mapel sesuai kategori kelas</small></h1>";
		$data['tahun_ajaran'] = $this->m_admin->select_table_orderby('tahun ASC','setup_tahun');
		$data['pd_tahun'] = $this->m_admin->select_dataWhere('id_tahun='.$this->input->post('idtahun').'','setup_tahun')->row('tahun');
		$data['id_tahun'] = $this->input->post('idtahun');

		//------------------
		$where = array(
			'id_tahun' => trim($this->input->post('idtahun')),
			'kategori_kls' => trim($this->input->post('kategori_kls'))
		);
		$cektabel = $this->m_admin->select_dataWhere($where,'tbl_kkm')->num_rows();
		
		if($cektabel>0)
		{
			$post = $this->input->post();
			$data['tbl_kkm'] = $this->m_admin->select_tbl_kkm($post['idtahun'],$post['kategori_kls']);

			$data['mapel_notset'] = $this->m_admin->select_mapel_notset_kkm($post['idtahun'],$post['kategori_kls']);

			$data['kategori_kls'] = $post['kategori_kls'];
			$data['type_form'] = "update";
		}
		else
		{
			$post = $this->input->post();
			$data['tbl_kkm'] = $this->m_admin->get_list_mapel();
			$data['type_form'] = "input";
			$data['kategori_kls'] = trim($this->input->post('kategori_kls'));
		}


		$data['content'] = "admin/v_setup_kkm";

		$this->load->view('admin/index',$data);
	}

	//-->> Multi Action <<--
	public function aksi_kkm()
	{
		$post = $this->input->post();

		if(isset($post['update'])){
			$id_kkm = $post['idkkm'];
			
			$jml = count($id_kkm);

			//-->> Perulangan <<--

			foreach ($id_kkm as $key => $value) {
				
				$data[$key]['id_kkm'] = trim($post['idkkm'][$key]);
				$data[$key]['id_tahun'] = trim($post['idtahun'][$key]);
				$data[$key]['id_pelajaran'] = trim($post['idpelajaran'][$key]);
				$data[$key]['kategori_kls'] = trim($post['kategori_kls'][$key]);
				$data[$key]['kkm'] = $post['kkm'][$key];			
			}

			$this->m_admin->update_batch('tbl_kkm',$data,'id_kkm');


			$idpelajaran2 = $post['idpelajaran2'];
			if($idpelajaran2!=''){
				foreach ($idpelajaran2 as $key => $value) {
					$data2[$key]['id_tahun'] = trim($post['idtahun2'][$key]);
					$data2[$key]['id_pelajaran'] = trim($post['idpelajaran2'][$key]);
					$data2[$key]['kategori_kls'] = trim($post['kategori_kls2'][$key]);
					$data2[$key]['kkm'] = trim(htmlentities($post['kkm2'][$key]));	
				}

				$this->m_admin->insert_batch('tbl_kkm',$data2);
			}
			//-->> Set Message <<--
			$this->setmessage('Berhasil memperbarui '.$jml.' data nilai KKM.','success');
			redirect('admin/setup_kkm/?m=setup&sm=kkm');
		}

		if(isset($post['input'])){
			$idpelajaran = $post['idpelajaran'];
			
			$jml = count($idpelajaran);

			//-->> Perulangan <<--

			foreach ($idpelajaran as $key => $value) {
				$data[$key]['id_tahun'] = trim($post['idtahun'][$key]);
				$data[$key]['id_pelajaran'] = trim($post['idpelajaran'][$key]);
				$data[$key]['kategori_kls'] = trim($post['kategori_kls'][$key]);
				$data[$key]['kkm'] = trim(htmlentities($post['kkm'][$key]));				
			}

			$this->m_admin->insert_batch('tbl_kkm',$data);

			//-->> Set Message <<--
			$this->setmessage('Nilai KKM berhasil disimpan!','success');
			redirect('admin/setup_kkm/?m=setup&sm=kkm');
		}
	}

	public function update_kkm()
	{
		$post = $this->input->post();
		$this->form_validation->set_rules('kkm[]','KKM','required');
		
		if($this->form_validation->run()==FALSE)
		{
			$this->setmessage(validation_errors(),'warning'); 
			redirect($post['back_url']);
		}
		else
		{
			$id_kkm = $post['id_kkm'];
			$tahun_ajaran = $post['tahunajaran'];
			$mapel = $post['mapel'];
			$katkel = $post['katkel'];
			$kkm = $post['kkm'];
			
			$jml = count($id_kkm);

			//-->> Perulangan <<--

			foreach ($id_kkm as $key => $value) {
				
				$data[$key]['id_kkm'] = trim($id_kkm[$key]);
				$data[$key]['id_tahun'] = trim($tahun_ajaran[$key]);
				$data[$key]['id_pelajaran'] = trim($mapel[$key]);
				$data[$key]['kategori_kls'] = trim($katkel[$key]);
				$data[$key]['kkm'] = trim(htmlentities($kkm[$key]));				
			}

			$this->m_admin->update_batch('tbl_kkm',$data,'id_kkm');

			//-->> Set Message <<--
			$this->setmessage('Berhasil memperbarui '.$jml.' data nilai KKM.','success');
			redirect('admin/setup_kkm/?m=setup&sm=kkm');
			
		}
	}

	//-->> Singgle Action <<--
	public function edit_kkm()
	{
		$where = array('id_kkm' => $this->uri->segment(3));
		$data['select_kkm'] = $this->m_admin->select_dataWhere($where,'tbl_kkm');
		$data['kat_mapel'] = $this->m_admin->select_table_orderby('kategori_mapel ASC','tbl_kategori_mapel');

		$id_admin = $this->session->userdata('id');
		$where = array('id_admin' => $id_admin);
		$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');
		$data['page_title'] = "<h1>Edit Nilai KKM<small>melakukan perubahan nilai KKM</small></h1>";
		$data['tahun_ajaran'] = $this->m_admin->select_table_orderby('tahun ASC','setup_tahun');
		$data['mapel'] = $this->m_admin->select_table_orderby('nama_pelajaran ASC','setup_pelajaran');
		$data['tipe_form'] = "multi";
		$data['content'] = "admin/v_edit_kkm";
		$this->load->view('admin/index',$data);
	}

	public function drop_kkm()
	{
		$where = array('id_kkm' => $this->uri->segment(3));
		$this->m_admin->delete_dataTable($where,'tbl_kkm');

		$this->setmessage('Berhasil menghapus data nilai KKM','success');

		redirect('admin/setup_kkm?m=setup&sm=kkm');


	}

	/*
	|=================================================================================
	| 4) BAGIAN SETUP PELAJARAN
	|=================================================================================
	*/

	public function setup_ekstra()
	{
		
		$id_admin = $this->session->userdata('id');
		$where = array('id_admin' => $id_admin);
		$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');
		$data['page_title'] = "<h1>Setup Ekstra Kurikuler<small> mengelola pengaturan Ekstra Kurikuler</small></h1>";
		$data['dataekstra'] = $this->m_admin->select_table_orderby('nama_ekstra ASC','ekstrakurikuler');
		
		
		$data['content'] = "admin/v_setup_ekstra";
		$this->load->view('admin/index',$data);
	}

	public function create_ekstra()
	{
		$this->form_validation->set_rules('nama_ekstra','Ekstra Kurikuler','required');
		
		if($this->form_validation->run()==FALSE)
		{
			$this->setmessage(validation_errors(),'warning'); 
			redirect('admin/setup_ekstra/?m=setup&sm=ekstra_kurikuler');
		}
		else
		{
			$data = array(
				'nama_ekstra' => trim(strip_tags($this->input->post('nama_ekstra')))
				);
			$this->m_admin->insert_dataTo($data,'ekstrakurikuler');

			$this->setmessage('Alhamdulillah yaa, Ekstra Kurikuler berhasil ditambahkan :)','success');

			redirect('admin/setup_ekstra?m=setup&sm=ekstra_kurikuler');
		}

	}

	//-->> Multi Action <<--
	public function aksi_ekstra()
	{
		$post = $this->input->post();

		if(isset($post['multidelete'])){
			$check = $post['check'];
			$jml = count($check);
			if(isset($check)){
				
				//menghapus data di database
				$cols = "id_ekstra";
				$this->m_admin->del_selected_data($post,'ekstrakurikuler',$cols);

			$this->setmessage('Berhasil menghapus '.$jml.' data Ekstra Kurikuler.','success');

			redirect('admin/setup_ekstra?m=setup&sm=ekstra_kurikuler');
			}else{
				$this->setmessage('Tidak ada data yang pilih!','warning');
		
				redirect('admin/setup_ekstra?m=setup&sm=ekstra_kurikuler');
			}
		}

		if(isset($post['multiedit'])){
			$check = $post['check'];
			if(isset($check)){
				
				
				$cols = "id_ekstra";
			$data['select_ekstra'] = $this->m_admin->get_selected_data($post,'ekstrakurikuler',$cols);
			
			$id_admin = $this->session->userdata('id');
			$where = array('id_admin' => $id_admin);
			$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');
			$data['page_title'] = "<h1>Edit Ekstra Kurikuler<small>melakukan perubahan Ekstra Kurikuler</small></h1>";
			$data['tipe_form'] = "multi";
			$data['content'] = "admin/v_edit_ekstrakurikuler";
			$this->load->view('admin/index',$data);

			}else{
				$this->setmessage('Tidak ada data yang dipilih!','warning');
		
				redirect('admin/setup_ekstra?m=setup&sm=ekstra_kurikuler');
			}
		}
	}

	public function update_ekstra()
	{
		$this->form_validation->set_rules('nama_ekstra[]','Ekstra Kurikuler','required');
		
		if($this->form_validation->run()==FALSE)
		{
			$this->setmessage(validation_errors(),'warning');
			redirect('admin/setup_ekstra/?m=setup&sm=ekstra_kurikuler');
		}
		else
		{
			$id_ekstra = $this->input->post('id_ekstra');
			$nama_ekstra = $this->input->post('nama_ekstra');
			
			$jml = count($id_ekstra);

			//-->> Perulangan <<--

			foreach ($id_ekstra as $key => $value) {
				
				$data[$key]['id_ekstra'] = trim($id_ekstra[$key]);
				$data[$key]['nama_ekstra'] = trim(strip_tags($nama_ekstra[$key]));				
			}
			$this->m_admin->update_batch('ekstrakurikuler',$data,'id_ekstra');

			//-->> Set Message <<--
			$this->setmessage('Berhasil memperbarui '.$jml.' data Ekstra Kurikuler.','success');

			redirect('admin/setup_ekstra/?m=setup&sm=ekstra_kurikuler');
			
		}
	}

	//-->> Singgle Action <<--
	public function edit_ekstra()
	{
		$where = array('id_ekstra' => $this->uri->segment(3));
		$data['select_ekstra'] = $this->m_admin->select_dataWhere($where,'ekstrakurikuler');

		$id_admin = $this->session->userdata('id');
		$where = array('id_admin' => $id_admin);
		$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');
		$data['page_title'] = "<h1>Edit Ekstra Kurikuler<small>melakukan perubahan data Ekstra Kurikuler</small></h1>";
		$data['tipe_form'] = "multi";
		$data['content'] = "admin/v_edit_ekstrakurikuler";
		$this->load->view('admin/index',$data);
	}

	public function drop_ekstra()
	{
		$where = array('id_ekstra' => $this->uri->segment(3));
		$this->m_admin->delete_dataTable($where,'ekstrakurikuler');

		$this->setmessage('Berhasil menghapus mata pelajaran.','success');

		redirect('admin/setup_ekstra?m=setup&sm=ekstra_kurikuler');


	}

	/*
	|=================================================================================
	| 8) BAGIAN SETUP KEPSEK
	|=================================================================================
	*/
	public function setup_kepsek()
	{
		//Filtering KKM::
		if(isset($_POST['sort_kepsek']))
		{
			$per_hlm = $this->input->post('rows');
			$where = array('id_tahun' => $this->input->post('tahun'));
			$setup_tahun = $this->m_admin->select_dataWhere($where,'setup_tahun')->row();
			//menyimpan data post ke session;
			$data = array(
				'ses_semes_thn' => $this->input->post('tahun'),
				'ses_semes_rows' => $per_hlm
			);
			$this->session->set_userdata($data);
		}
		elseif($this->session->userdata('ses_semes_thn')!='' && $this->session->userdata('ses_semes_rows')!='')
		{
			$per_hlm = $this->session->userdata('ses_semes_rows');
			$where = array('id_tahun' => $this->session->userdata('ses_semes_thn'));
			$setup_tahun = $this->m_admin->select_dataWhere($where,'setup_tahun')->row();
		}
		else
		{
			//Default:
			$per_hlm = 5;
						
			$where = array('status_aktif' => 1);
			$setup_tahun = $this->m_admin->select_dataWhere($where,'setup_tahun')->row();
		}
		//<<./>>
		$id_admin = $this->session->userdata('id');
		$where = array('id_admin' => $id_admin);
		$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');
		$data['page_title'] = "<h1>Data Kepala Sekolah<small> Mengelola data kepala sekolah</small></h1>";
		$data['data_kepsek'] = $this->m_admin->get_data_kepsek($setup_tahun->id_tahun);
		$data['pd_tahun'] = $setup_tahun->tahun;
		$data['tahun'] = $this->m_admin->select_table_orderby('tahun ASC','setup_tahun');
		$data['semester'] = $this->m_admin->select_table_orderby('semester ASC','setup_semester');
		$data['guru'] = $this->m_admin->select_table_orderby('nama_guru ASC','data_guru');;
		$data['jml_data'] = $data['data_kepsek']->num_rows();

		//Pgination Config::
		$siteurl = site_url('admin/setup_kepsek/');
		$rows = $data['data_kepsek']->num_rows();
		$perpage = $per_hlm;
		$urisegment = 3;
		$Mfunction = "data_kepsek_wp";
		$key = $setup_tahun->id_tahun;
		$model = "m_admin";
		$type = "ada_where";
		include("pagination_config.php");
		//end Pagination::
		$data['content'] = "admin/v_setup_kepsek";
		$this->load->view('admin/index',$data);
	}

	function tambah_kepsek()
	{
		
			$post = $this->input->post();
			$data = array(
				'id_tahun' => trim($post['tahunajaran']),
				'id_semester' => trim($post['semester']),
				'id_guru' => trim($post['nama']),
				'tgl_rapor' => trim(htmlentities($post['tgl_rapor'])),
				'tgl_siswa_diterima' => trim(htmlentities($post['tgl_siswa_diterima'])),
			);

			$where = array(
				'id_tahun' => trim($post['tahunajaran']),
				'id_semester' => trim($post['semester']),
				//'id_guru' => trim($post['nama'])
			);
			$cek = $this->m_admin->select_dataWhere($where,'tbl_kepsek')->num_rows();
			
			if($cek>0)
			{
				$this->setmessage('Tidak dapat menambahkan data Kepala Sekolah! System menemukan data yang sama!','danger');
			redirect('admin/setup_kepsek?m=setup&sm=data_kepala_sekolah');
			}
			else
			{
			$this->m_admin->insert_dataTo($data,'tbl_kepsek');
			$this->setmessage('Berhasil menambahkan data kepala sekolah!','success');
			redirect('admin/setup_kepsek?m=setup&sm=data_kepala_sekolah');
			}
	
	}

	//-->> Multi Action <<--
	public function aksi_kepsek()
	{
		$post = $this->input->post();

		if(isset($post['multidelete'])){
			$check = $post['check'];
			$jml = count($check);
			if(isset($check)){
				
				//menghapus data di database
				$cols = "id_kepsek";
				$this->m_admin->del_selected_data($post,'tbl_kepsek',$cols);

			$this->setmessage('Berhasil mengahpus '.$jml.' data kepala sekolah!','success');
			redirect('admin/setup_kepsek?m=setup&sm=data_kepala_sekolah');

			}else{
				$this->setmessage('Tidak ada data yang dipilih!','warning');

				redirect('admin/setup_kepsek?m=setup&sm=data_kepala_sekolah');
			}
		}

		if(isset($post['multiedit'])){
			$check = $post['check'];
			if(isset($check)){
				
				
			$cols = "id_kepsek";
			$data['select_kepsek'] = $this->m_admin->get_selected_data($post,'tbl_kepsek',$cols);
			$data['tahun'] = $this->m_admin->select_table_orderby('tahun ASC','setup_tahun');
			$data['semester'] = $this->m_admin->select_table_orderby('semester ASC','setup_semester');
			$data['guru'] = $this->m_admin->select_table_orderby('nama_guru ASC','data_guru');

			$id_admin = $this->session->userdata('id');
			$where = array('id_admin' => $id_admin);
			$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');
			$data['page_title'] = "<h1>Edit Data Kepala Sekolah<small>melakukan perubahan data Kepala Sekolah</small></h1>";
			$data['tipe_form'] = "multi";
			$data['content'] = "admin/v_edit_kepsek";
			$this->load->view('admin/index',$data);

			}else{
				$this->setmessage('Tidak ada data yang dipilih!','warning');		
				redirect('admin/setup_kepsek?m=setup&sm=data_kepala_sekolah');
			}
		}
	}

	public function update_kepsek()
	{
		$post = $this->input->post();
		
			$id_kepsek = $post['id_kepsek'];
			$tahunajaran = $post['tahunajaran'];
			$semester = $post['semester'];
			$guru = $post['nama'];
			$tgl_rapor = $post['tgl_rapor'];
			$tgl_s_diterima = $post['tgl_siswa_diterima'];
			
			$jml = count($id_kepsek);

			//-->> Perulangan <<--

			$data = array(
				'id_kepsek' => trim($id_kepsek),
				'id_guru' => trim($guru),
				'id_semester' => trim($semester),
				'id_tahun' => trim($tahunajaran),
				'tgl_rapor' => trim(htmlentities($tgl_rapor)),
				'tgl_siswa_diterima' => trim(htmlentities($tgl_s_diterima))
			);

			$where = array(
				'id_kepsek' => trim($id_kepsek)
			);

			$cekdata = $this->m_admin->select_dataWhere($where,'tbl_kepsek')->num_rows();
			if($cekdata>0)
			{
				//mengupdate data referensi tanggal saja;
				$data2 = array(
					'tgl_rapor' => trim(htmlentities($tgl_rapor)),
					'tgl_siswa_diterima' => trim(htmlentities($tgl_s_diterima))
				);

				$where2 = array('id_kepsek' => $id_kepsek);
				$this->m_admin->update_dataTable($where2,$data2,'tbl_kepsek');

				$this->setmessage(' System berhasil menyimpan referensi tanggal! Namun, system tidak melakukan pembaruan data kepala sekolah meliputi Tahun Ajaran, Semester dan Nama karena ditemukan data yang sama.','info');
					redirect('admin/setup_kepsek/?m=setup&sm=data_kepala_sekolah');
			}

			$this->m_admin->update_dataTable($where,$data,'tbl_kepsek');
						
			//-->> Set Message <<--
			$this->setmessage('Berhasil memperbarui Referensi tanggal dan data Kepala Sekolah.','success');
			redirect('admin/setup_kepsek/?m=setup&sm=data_kepala_sekolah');
			
	}
	

	//-->> Singgle Action <<--
	public function edit_kepsek()
	{
		$where = array('id_kepsek' => $this->uri->segment(3));
		$data['select_kepsek'] = $this->m_admin->select_dataWhere($where,'tbl_kepsek');
		
		$id_admin = $this->session->userdata('id');
		$where = array('id_admin' => $id_admin);
		$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');
		$data['page_title'] = "<h1>Edit Data Kepala Sekolah<small>melakukan perubahan data kepala sekolah</small></h1>";
		$data['tahun'] = $this->m_admin->select_table_orderby('tahun ASC','setup_tahun');
		$data['semester'] = $this->m_admin->select_table_orderby('semester ASC','setup_semester');
		$data['guru'] = $this->m_admin->select_table_orderby('nama_guru ASC','data_guru');
		$data['tipe_form'] = "multi";
		$data['content'] = "admin/v_edit_kepsek";
		$this->load->view('admin/index',$data);
	}

	public function drop_kepsek()
	{
		$where = array('id_kepsek' => $this->uri->segment(3));
		$this->m_admin->delete_dataTable($where,'tbl_kepsek');

		$this->setmessage('Berhasil menghapus data Kepala Sekolah','success');

		redirect('admin/setup_kepsek?m=setup&sm=data_kepala_sekolah');
	}

	/*
	|=================================================================================
	| 9) BAGIAN SETUP IDENTITAS SEKOLAH
	|=================================================================================
	*/
	public function identitas_sekolah()
	{
		$id_admin = $this->session->userdata('id');
		$where = array('id_admin' => $id_admin);
		$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');
		$data['page_title'] = "<h1>Identitas Sekolah<small> Mengatur identitas sekolah</small></h1>";
		$data['identitas_sekolah'] = $this->m_admin->select_dataFrom('info_sekolah');
		
		$data['content'] = "admin/v_infosekolah";
		$this->load->view('admin/index',$data);
	}

	public function update_infosekolah()
	{
		$this->form_validation->set_rules('nama_aplikasi','Nama Aplikasi','required');
		$this->form_validation->set_rules('nama_sekolah','Nama Sekolah','required');
		$this->form_validation->set_rules('alamat','Alamat','required');
		$this->form_validation->set_rules('telpon','Telepon','required');
		$this->form_validation->set_rules('kelurahan','Kelurahan','required');
		$this->form_validation->set_rules('kecamatan','Kecamatan','required');
		$this->form_validation->set_rules('kabupaten','Kabupaten','required');
		$this->form_validation->set_rules('provinsi','Provinsi/Daerah','required');
		$this->form_validation->set_rules('email','Email','valid_email');

		if(!empty($_FILES['file']['name']))
		{
			$config['upload_path'] = './assets/photos';
			$config['file_name'] = time().'_'.$_FILES['file']['name'];
			$config['allowed_types'] = 'gif|jpg|jpeg|png|JPG|JPEG';
			$config['max_size'] = 500;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if($this->form_validation->run()==FALSE && !$this->upload->do_upload('file'))
			{
				$this->setmessage(validation_errors().$this->upload->display_errors(),'warning');
				$this->identitas_sekolah();
			}
			elseif($this->form_validation->run()==FALSE OR !$this->upload->do_upload('file'))
			{
				$this->setmessage(validation_errors().$this->upload->display_errors(),'warning');
				$this->identitas_sekolah();
			}
			else
			{
				$foto = $this->upload->data();
				//Compress Image
				$config['image_library']='gd2';
				$config['source_image']='./assets/photos/'.$foto['file_name'];
				$config['create_thumb']= FALSE;
				$config['maintain_ratio']= FALSE;
				$config['quality']= '100%';
				$config['width']= 200;
				$config['height']= 200;
				$config['new_image']= './assets/photos/'.$foto['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();

				$post = $this->input->post();
				$data = array(
					'nama_aplikasi' => trim(strip_tags($post['nama_aplikasi'])),
					'nama_sekolah' => trim(strip_tags($post['nama_sekolah'])),
					'npsn' => trim(strip_tags($post['npsn'])),
					'nss' => trim(strip_tags($post['nss'])),
					'alamat_sekolah' => trim(strip_tags($post['alamat'])),
					'kode_pos' => trim(strip_tags($post['kode_pos'])),
					'kelurahan' => trim(strip_tags($post['kelurahan'])),
					'kecamatan' => trim(strip_tags($post['kecamatan'])),
					'kabupaten' => trim(strip_tags($post['kabupaten'])),
					'provinsi' => trim(strip_tags($post['provinsi'])),
					'website' => trim(strip_tags($post['website'])),
					'telpon' => trim(strip_tags($post['telpon'])),
					'email' => trim(strip_tags($post['email'])),
					'logo' => $foto['file_name']
				);

				//Detele foto lama from direktori...
				if($post['fotolama']!='')
				{
					unlink('./assets/photos/'.$post['fotolama'].'');
				}

				$this->m_admin->update_dataTable('id='.$post['id'].'',$data,'info_sekolah');
				$this->setmessage('Identitas sekolah berhasil diperbarui','success');
				redirect('admin/identitas_sekolah?m=setup&sm=identitas_sekolah');
			}
		}
		elseif($this->form_validation->run()==FALSE)
		{
			$this->setmessage(validation_errors(),'warning');
			$this->identitas_sekolah();
		}
		else
		{
			$post = $this->input->post();
				$data = array(
					'nama_aplikasi' => trim(strip_tags($post['nama_aplikasi'])),
					'nama_sekolah' => trim(strip_tags($post['nama_sekolah'])),
					'npsn' => trim(strip_tags($post['npsn'])),
					'nss' => trim(strip_tags($post['nss'])),
					'alamat_sekolah' => trim(strip_tags($post['alamat'])),
					'kode_pos' => trim(strip_tags($post['kode_pos'])),
					'kelurahan' => trim(strip_tags($post['kelurahan'])),
					'kecamatan' => trim(strip_tags($post['kecamatan'])),
					'kabupaten' => trim(strip_tags($post['kabupaten'])),
					'provinsi' => trim(strip_tags($post['provinsi'])),
					'website' => trim(strip_tags($post['website'])),
					'telpon' => trim(strip_tags($post['telpon'])),
					'email' => trim(strip_tags($post['email']))
				);
				$this->m_admin->update_dataTable('id='.$post['id'].'',$data,'info_sekolah');
				$this->setmessage('Identitas sekolah berhasil diperbarui','success');
				redirect('admin/identitas_sekolah?m=setup&sm=identitas_sekolah');
		}
	}



	/*
	|=================================================================================
	| 10) BAGIAN DATA INDUK - GURU
	|=================================================================================
	*/
	public function data_guru()
	{
		$id_admin = $this->session->userdata('id');
		$where = array('id_admin' => $id_admin);
		$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');
		$data['page_title'] = "<h1>Data Guru<small> mengelola keadaan guru</small></h1>";
		$data['dataguru'] = $this->m_admin->select_table_orderby('nama_guru ASC','data_guru');
		//Pgination Config::
		$siteurl = site_url('admin/data_guru/');
		$rows = $data['dataguru']->num_rows();
		$perpage = 10;
		$urisegment = 3;
		$Mfunction = "data_guru_wp";
		//$key = $setup_tahun->id_tahun;
		$model = "m_admin";
		$type = "tanpa_where";
		include("pagination_config.php");
		//end Pagination::
		$data['content'] = "admin/v_data_guru";
		$this->load->view('admin/index',$data);
	}

	public function tambah_guru()
	{
		$this->form_validation->set_rules('nama_guru','Nama Guru','required');
		$this->form_validation->set_rules('niy','NIY/NIGK','required');
		$this->form_validation->set_rules('nik','NIK','required|numeric');
		$this->form_validation->set_rules('kelamin','Kelamin','required');
		$this->form_validation->set_rules('alamat','Alamat','required');
		$this->form_validation->set_rules('telpon','Telepon','required');
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','Password','required');
		$this->form_validation->set_rules('repassword','Konfirmasi Password','required|matches[password]');

		//<!> Cek File upload <<---------

		if(!empty($_FILES['userfile']['name']))
		{
			$config['upload_path'] = './assets/photos';
			$config['file_name'] = time().'_'.$_FILES['userfile']['name'];
			$config['allowed_types'] = 'gif|jpg|jpeg|png|JPG|JPEG';
			$config['max_size'] = 500;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if($this->form_validation->run()==FALSE && !$this->upload->do_upload('userfile'))
			{
				$this->setmessage(validation_errors().$this->upload->display_errors(),'warning');
				$this->data_guru();
			}
			elseif($this->form_validation->run()==FALSE OR !$this->upload->do_upload('userfile'))
			{
				$this->setmessage(validation_errors().$this->upload->display_errors(),'warning');
				$this->data_guru();
			}
			else
			{
				$foto = $this->upload->data();
				//Compress Image
				$config['image_library']='gd2';
				$config['source_image']='./assets/photos/'.$foto['file_name'];
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
					'nama_guru' => trim(ucwords(htmlentities($post['nama_guru']))),
					'nip' => trim(htmlentities($post['niy'])),
					'kelamin' => trim(htmlentities($post['kelamin'])),
					'alamat_guru' => trim(ucwords(htmlentities($post['alamat']))),
					'telpon_guru' => trim(htmlentities($post['telpon'])),
					'username' => trim(htmlentities($post['username'])),
					'password' => trim(md5(htmlentities($post['password']))),
					'nik' => trim(strtoupper(htmlentities($post['nik']))),
					'foto_guru' => $foto['file_name']
				);

				$this->m_admin->insert_dataTo($data,'data_guru');

				$this->setmessage('Alhamdulillah yaa, Data Guru berhasil ditambahkan :)','success');
				redirect('admin/data_guru');
			}
		}
		elseif($this->form_validation->run()==FALSE)
		{
			$this->setmessage(validation_errors(),'warning');
			$this->data_guru();
		}
		else
		{
			$post = $this->input->post();
			$data = array(
					'nama_guru' => trim(ucwords(htmlentities($post['nama_guru']))),
					'nip' => trim(htmlentities($post['niy'])),
					'kelamin' => trim(htmlentities($post['kelamin'])),
					'alamat_guru' => trim(ucwords(htmlentities($post['alamat']))),
					'telpon_guru' => trim(htmlentities($post['telpon'])),
					'username' => trim(htmlentities($post['username'])),
					'nik' => trim(strtoupper(htmlentities($post['nik'])))
				);

				$this->m_admin->insert_dataTo($data,'data_guru');

				//-->> Set Message <<--
				$this->setmessage('Alhamdulillah yaa, Data Guru berhasil ditambahkan :)','success');

				redirect('admin/data_guru');
		}
}

	//-->> Multi Action <<--
	public function aksi_guru()
	{
		$post = $this->input->post();

		if(isset($post['multidelete'])){
			$check = $post['check'];
			$jml = count($check);
			if(isset($check)){
				
				//menghapus data di database
				$cols = "id_guru";
				$this->m_admin->del_selected_data($post,'data_guru',$cols);

			$this->setmessage('Berhasil menghapus '.$jml.' data guru.','success');

			redirect('admin/data_guru?m=data_induk&sm=guru');
			}else{
				$this->setmessage('Tidak ada data yang dipilih!','warning');
				redirect('admin/data_guru?m=data_induk&sm=guru');
			}
		}
	
	}

	public function update_guru()
	{
		$post = $this->input->post();
		$this->form_validation->set_rules('nama_guru','Nama Guru','required');
		$this->form_validation->set_rules('niy','NIY/NIGK','required');
		$this->form_validation->set_rules('nik','NIK','required|numeric');
		$this->form_validation->set_rules('kelamin','Kelamin','required');
		$this->form_validation->set_rules('alamat','Alamat','required');
		$this->form_validation->set_rules('telpon','Telepon','required');
		$this->form_validation->set_rules('username','Username','required');
		
		//<!> Cek File upload <<---------

		if(!empty($_FILES['userfile']['name']))
		{
			$config['upload_path'] = './assets/photos';
			$config['file_name'] = time().'_'.$_FILES['userfile']['name'];
			$config['allowed_types'] = 'gif|jpg|jpeg|png|JPG|JPEG';
			$config['max_size'] = 500;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if($this->form_validation->run()==FALSE && !$this->upload->do_upload('userfile'))
			{
				$this->setmessage(validation_errors().$this->upload->display_errors(),'warning');
				redirect('admin/edit_guru/'.$post['id_guru'].'/?m=data_induk&sm=guru');
			}
			elseif($this->form_validation->run()==FALSE OR !$this->upload->do_upload('userfile'))
			{
				$this->setmessage(validation_errors().$this->upload->display_errors(),'warning');
				redirect('admin/edit_guru/'.$post['id_guru'].'/?m=data_induk&sm=guru');
			}
			else
			{
				$foto = $this->upload->data();
				//Compress Image
				$config['image_library']='gd2';
				$config['source_image']='./assets/photos/'.$foto['file_name'];
				$config['create_thumb']= FALSE;
				$config['maintain_ratio']= FALSE;
				$config['quality']= '100%';
				$config['width']= 400;
				$config['height']= 400;
				$config['new_image']= './assets/photos/'.$foto['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();

				$data = array(
					'nama_guru' => trim(ucwords(htmlentities($post['nama_guru']))),
					'nip' => trim(htmlentities($post['niy'])),
					'kelamin' => trim(htmlentities($post['kelamin'])),
					'alamat_guru' => trim(ucwords(htmlentities($post['alamat']))),
					'telpon_guru' => trim(htmlentities($post['telpon'])),
					'username' => trim(htmlentities($post['username'])),
					//'password' => trim(md5(htmlentities($post['password']))),
					'nik' => trim(strtoupper(htmlentities($post['nik']))),
					'foto_guru' => $foto['file_name']
				);

				//----->>hapus foto lama<<---
				if($post['fotolama']!=''){
					unlink('./assets/photos/'.$post['fotolama'].'');
				}

				$where = array('id_guru' => $post['id_guru']);
				$this->m_admin->update_dataTable($where,$data,'data_guru');

				//-->> Set Message <<--
				$this->setmessage('Berhasil memperbarui data guru.','success');

				redirect('admin/edit_guru/'.$post['id_guru'].'/?m=data_induk&sm=guru');
			}
		}
		elseif($this->form_validation->run()==FALSE)
		{
			$this->setmessage(validation_errors(),'warning');
			redirect('admin/edit_guru/'.$post['id_guru'].'/?m=data_induk&sm=guru');
		}
		else
		{
			$data = array(
					'nama_guru' => trim(ucwords(htmlentities($post['nama_guru']))),
					'nip' => trim(htmlentities($post['niy'])),
					'kelamin' => trim(htmlentities($post['kelamin'])),
					'alamat_guru' => trim(ucwords(htmlentities($post['alamat']))),
					'telpon_guru' => trim(htmlentities($post['telpon'])),
					'username' => trim(htmlentities($post['username'])),
					//'password' => trim(md5(htmlentities($post['password']))),
					'nik' => trim(strtoupper(htmlentities($post['nik'])))
				);

				$where = array('id_guru' => $post['id_guru']);
				$this->m_admin->update_dataTable($where,$data,'data_guru');

				//-->> Set Message <<--
				$this->setmessage('Berhasil memperbarui data guru.','success');

				redirect('admin/edit_guru/'.$post['id_guru'].'/?m=data_induk&sm=guru');
		}
		
			
	}

	//-->> Singgle Action <<--
	public function edit_guru()
	{
		$where = array('id_guru' => $this->uri->segment(3));
		$data['data_guru'] = $this->m_admin->select_dataWhere($where,'data_guru');

		$id_admin = $this->session->userdata('id');
		$where = array('id_admin' => $id_admin);
		$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');
		$data['page_title'] = "<h1>Edit Data<small>melakukan perubahan data guru</small></h1>";
		//$data['tipe_form'] = "multi";
		$data['content'] = "admin/v_edit_guru";
		$this->load->view('admin/index',$data);
	}

	public function drop_guru()
	{
		$where = array('id_guru' => $this->uri->segment(3));
		$this->m_admin->delete_dataTable($where,'data_guru');

		$this->setmessage('Berhasil menghapus data guru','success');

		redirect('admin/data_guru?m=data_induk&sm=guru');

	}

	/*public function reset_pass_guru()
	{
		$this->form_validation->set_rules('pass_lama','Password Sekarang','required');
		$this->form_validation->set_rules('password','Password Baru','required');
		$this->form_validation->set_rules('repassword','Konfirmasi Password','required|matches[password]');

		if($this->form_validation->run()==FALSE)
		{
			$this->setmessage(validation_errors(),'warning');
			redirect('admin/edit_guru/'.$this->input->post('id_guru').'/?m=data_induk&sm=guru');
		}
		else
		{
			$old = trim(md5(htmlentities($this->input->post('pass_lama'))));
			$where = array('id_guru'=> $this->input->post('id_guru'), 'password' => $old);

			$cek = $this->m_admin->select_dataWhere($where,'data_guru')->num_rows();
			if($cek<1)
			{
				$this->setmessage('Maaf, isian untuk <b>Password Sekarang</b> salah!','danger');
				redirect('admin/edit_guru/'.$this->input->post('id_guru').'/?m=data_induk&sm=guru');
			}
			else
			{

				$data = array(
					'password' => trim(md5(htmlentities($this->input->post('password'))))
				);

				$where = array('id_guru' => $this->input->post('id_guru'));
				$this->m_admin->update_dataTable($where,$data,'data_guru');

				$this->setmessage('Password berhasil diganti','success');

				redirect('admin/edit_guru/'.$this->input->post('id_guru').'/?m=data_induk&sm=guru');
			}
		}

	}*/


	/*
	|=================================================================================
	| 10) BAGIAN DATA INDUK - SISWA
	|=================================================================================
	*/

	public function data_siswa()
	{
		//Filtering data ref siswa::
		if(isset($_POST['sort_siswa']))
		{
			$jml_hlm = $this->input->post('jml_hlm');
			$status_siswa = $this->input->post('status_siswa');
			//menyimpan data post ke session;
			$data = array('ses_stat_siswa' => $status_siswa,'ses_siswa_rows' => $jml_hlm);
			$this->session->set_userdata($data);
		}
		elseif($this->session->userdata('ses_stat_siswa')!='')
		{
			$status_siswa = $this->session->userdata('ses_stat_siswa');
			$jml_hlm = $this->session->userdata('ses_siswa_rows');
			
		}
		else
		{
			//Default:
			$jml_hlm = 5;
			$status_siswa = 1;
		}

		$id_admin = $this->session->userdata('id');
		$where = array('id_admin' => $id_admin);
		$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');
		$data['page_title'] = "<h1>Data Siswa<small> mengelola keadaan siswa</small></h1>";
		//$data['datasiswa'] = $this->m_admin->select_table_orderby('nama_siswa ASC','data_siswa');
		$data['datasiswa'] = $this->m_admin->data_siswa($status_siswa);
		$data['jml_data'] = $data['datasiswa']->num_rows();
		$data['datakelas'] = $this->m_admin->select_table_orderby('nama_kelas ASC','setup_kelas');
		$data['tahunajaran'] = $this->m_admin->select_table_orderby('tahun ASC','setup_tahun');
		//Pgination Config::
		$siteurl = site_url('admin/data_siswa/');
		$rows = $data['datasiswa']->num_rows();
		$perpage = $jml_hlm;
		$urisegment = 3;
		$Mfunction = "data_siswa_wp";
		$key = $status_siswa;
		$model = "m_admin";
		$type = "ada_where";
		include("pagination_config.php");
		//end Pagination::
		
		$data['content'] = "admin/v_data_siswa";
		$this->load->view('admin/index',$data);
	}

	public function tambah_siswa()
	{
		$this->form_validation->set_rules('nama_siswa','Nama Siswa','required');
		$this->form_validation->set_rules('nis','NIS','required');
		$this->form_validation->set_rules('nisn','NISN','required|numeric');
		$this->form_validation->set_rules('tempat_lahir','Tempat Lahir','required');
		$this->form_validation->set_rules('tgl_lahir','Tanggal Lahir','required');
		$this->form_validation->set_rules('kelamin','Kelamin','required');
		$this->form_validation->set_rules('agama','Agama','required');
		$this->form_validation->set_rules('status_dlm_kel','Status dalam Keluarga','required');
		$this->form_validation->set_rules('anakke','Anak Ke','required');
		$this->form_validation->set_rules('alamat_siswa','Alamat Siswa','required');
		$this->form_validation->set_rules('telpon_siswa','Telpon Siswa','required');
		$this->form_validation->set_rules('asal_sekolah','Asal Sekolah','required');
		$this->form_validation->set_rules('kelas','Kelas','required');
		$this->form_validation->set_rules('diterima_tgl','Tanggal Diterima','required');
		$this->form_validation->set_rules('nama_ayah','Nama Ayah','required');
		$this->form_validation->set_rules('nama_ibu','Nama Ibu','required');
		$this->form_validation->set_rules('alamat_ortu','Alamat Ortu','required');
		$this->form_validation->set_rules('telpon_ortu','Telpon Ortu','required');
		$this->form_validation->set_rules('kerja_ayah','Pekerjaan Ayah','required');
		$this->form_validation->set_rules('kerja_ibu','Pekerjaan Ibu','required');
		$this->form_validation->set_rules('nama_wali','Nama Wali','required');
		$this->form_validation->set_rules('alamat_wali','Alamat Wali','required');
		$this->form_validation->set_rules('telpon_wali','Telpon Wali','required');
		$this->form_validation->set_rules('kerja_wali','Pekerjaan Wali','required');
		$this->form_validation->set_rules('tahun_ajaran','Tahun Ajaran','required');
		$this->form_validation->set_rules('kelamin','Kelamin','required');
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','Password','required');
		$this->form_validation->set_rules('repassword','Konfirmasi Password','required|matches[password]');
		$this->form_validation->set_rules('status','Status','required');

		//<!> Cek nis siswa <<--------

		$cek_nis = $this->m_admin->select_dataWhere('nis='.$this->input->post('nis').'','data_siswa')->num_rows();

		//<!> Cek File upload <<---------

		if(!empty($_FILES['userfile']['name']))
		{
			$config['upload_path'] = './assets/photos';
			$config['file_name'] = time().'_'.$_FILES['userfile']['name'];
			$config['allowed_types'] = 'gif|jpg|jpeg|png|JPG|JPEG';
			$config['max_size'] = 500;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if($this->form_validation->run()==FALSE && !$this->upload->do_upload('userfile') && $cek_nis>0)
			{
				$this->setmessage(validation_errors().$this->upload->display_errors().'<br>Ditemukan NIS yang sama dalam database','warning');
				$this->data_siswa();
			}
			elseif($this->form_validation->run()==FALSE OR !$this->upload->do_upload('userfile') OR $cek_nis>0)
			{
				$this->setmessage(validation_errors().$this->upload->display_errors().'<br>Ditemukan NIS yang sama dalam database','warning');
				$this->data_siswa();
			}
			else
			{
				$foto = $this->upload->data();
				//Compress Image
				$config['image_library']='gd2';
				$config['source_image']='./assets/photos/'.$foto['file_name'];
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
					'nama_siswa' => trim(ucwords(htmlentities($post['nama_siswa']))),
					'nis' => trim(htmlentities($post['nis'])),
					'nisn' => trim(htmlentities($post['nisn'])),
					'tempat_lahir' => trim(htmlentities($post['tempat_lahir'])),
					'tgl_lahir' => trim(htmlentities($post['tgl_lahir'])),
					'kelamin' => trim(htmlentities($post['kelamin'])),
					'agama' => trim(htmlentities($post['agama'])),
					'status_dlm_kel' => trim(htmlentities($post['status_dlm_kel'])),
					'anakke' => trim(htmlentities($post['anakke'])),
					'alamat_siswa' => trim(ucwords(htmlentities($post['alamat_siswa']))),
					'telpon_siswa' => trim(htmlentities($post['telpon_siswa'])),
					'asal_sekolah' => trim(htmlentities($post['asal_sekolah'])),
					'kelas' => trim(htmlentities($post['kelas'])),
					'diterima_tanggal' => trim(htmlentities($post['diterima_tgl'])),
					'nama_ayah' => trim(htmlentities($post['nama_ayah'])),
					'nama_ibu' => trim(htmlentities($post['nama_ibu'])),
					'alamat_ortu' => trim(htmlentities($post['alamat_ortu'])),
					'telpon_ortu' => trim(htmlentities($post['telpon_ortu'])),
					'kerja_ayah' => trim(htmlentities($post['kerja_ayah'])),
					'kerja_ibu' => trim(htmlentities($post['kerja_ibu'])),
					'nama_wali' => trim(htmlentities($post['nama_wali'])),
					'alamat_wali' => trim(htmlentities($post['alamat_wali'])),
					'telpon_wali' => trim(htmlentities($post['telpon_wali'])),
					'kerja_wali' => trim(htmlentities($post['kerja_wali'])),
					'tahun_ajaran' => trim(htmlentities($post['tahun_ajaran'])),
					'username' => trim(htmlentities($post['username'])),
					'password' => trim(md5(htmlentities($post['password']))),
					'foto_siswa' => $foto['file_name'],
					'status' => trim($post['status'])
				);

				$this->m_admin->insert_dataTo($data,'data_siswa');

				$this->setmessage('Alhamdulillah yaa, Data Siswa berhasil ditambahkan :)','success');
				redirect('admin/data_siswa');
			}
		}
		elseif($this->form_validation->run()==FALSE OR $cek_nis>0)
		{
			$this->setmessage(validation_errors().'<br>Ditemukan NIS yang sama dalam database','warning');
			$this->data_siswa();
		}
		else
		{
			$post = $this->input->post();
			$data = array(
					'nama_siswa' => trim(ucwords(htmlentities($post['nama_siswa']))),
					'nis' => trim(htmlentities($post['nis'])),
					'nisn' => trim(htmlentities($post['nisn'])),
					'tempat_lahir' => trim(htmlentities($post['tempat_lahir'])),
					'tgl_lahir' => trim(htmlentities($post['tgl_lahir'])),
					'kelamin' => trim(htmlentities($post['kelamin'])),
					'agama' => trim(htmlentities($post['agama'])),
					'status_dlm_kel' => trim(htmlentities($post['status_dlm_kel'])),
					'anakke' => trim(htmlentities($post['anakke'])),
					'alamat_siswa' => trim(ucwords(htmlentities($post['alamat_siswa']))),
					'telpon_siswa' => trim(htmlentities($post['telpon_siswa'])),
					'asal_sekolah' => trim(htmlentities($post['asal_sekolah'])),
					'kelas' => trim(htmlentities($post['id_kelas'])),
					'diterima_tanggal' => trim(htmlentities($post['diterima_tanggal'])),
					'nama_ayah' => trim(htmlentities($post['nama_ayah'])),
					'nama_ibu' => trim(htmlentities($post['nama_ibu'])),
					'alamat_ortu' => trim(htmlentities($post['alamat_ortu'])),
					'telpon_ortu' => trim(htmlentities($post['telpon_ortu'])),
					'kerja_ayah' => trim(htmlentities($post['kerja_ayah'])),
					'kerja_ibu' => trim(htmlentities($post['kerja_ibu'])),
					'nama_wali' => trim(htmlentities($post['nama_wali'])),
					'alamat_wali' => trim(htmlentities($post['alamat_wali'])),
					'telpon_wali' => trim(htmlentities($post['telpon_wali'])),
					'kerja_wali' => trim(htmlentities($post['kerja_wali'])),
					'tahun_ajaran' => trim(htmlentities($post['tahun_ajaran'])),
					'username' => trim(htmlentities($post['username'])),
					'password' => trim(md5(htmlentities($post['password']))),
					'status' => trim($post['status'])
				);

				$this->m_admin->insert_dataTo($data,'data_siswa');

				//-->> Set Message <<--
				$this->setmessage('Alhamdulillah yaa, Data Siswa berhasil ditambahkan :)','success');

				redirect('admin/data_siswa');
		}
}

	//-->> Multi Action <<--
	public function aksi_siswa()
	{
		$post = $this->input->post();

		if(isset($post['multidelete'])){
			$check = $post['check'];
			$jml = count($check);
			if(isset($check)){
				
				//menghapus data di database
				$cols = "id_siswa";
				$this->m_admin->del_selected_data($post,'data_siswa',$cols);

			$this->setmessage('Berhasil menghapus '.$jml.' data siswa.','success');

			redirect('admin/data_siswa?m=data_induk&sm=siswa');
			}else{
				$this->setmessage('Tidak ada data yang dipilih!','warning');
				redirect('admin/data_siswa?m=data_induk&sm=siswa');
			}
		}
	
	}

	public function detail_siswa()
	{
		$id_admin = $this->session->userdata('id');
		$where = array('id_admin' => $id_admin);
		$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');
		$data['page_title'] = "<h1>Detail Siswa</h1>";
		$whereid = array('nis' => $this->uri->segment(3));
		$data['data_siswa'] = $this->m_admin->select_dataWhere($whereid,'data_siswa');
		$siswa = $data['data_siswa']->row();
		$setup_tahun = $this->m_admin->select_dataWhere('status_aktif=1','setup_tahun')->row();
		$id_thn_aktif = $setup_tahun->id_tahun;
		$data['tahun_ajaran'] = $setup_tahun->tahun;
		$semester_aktif = $this->m_admin->select_dataWhere('status_semester=1','setup_semester')->row('id_semester');
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
		$this->load->view('admin/index',$data);
	}

	public function update_siswa()
	{
		$post = $this->input->post();
		$this->form_validation->set_rules('nama_siswa','Nama Siswa','required');
		$this->form_validation->set_rules('nis','NIS','required');
		$this->form_validation->set_rules('nisn','NISN','required|numeric');
		$this->form_validation->set_rules('tempat_lahir','Tempat Lahir','required');
		$this->form_validation->set_rules('tgl_lahir','Tanggal Lahir','required');
		$this->form_validation->set_rules('kelamin','Kelamin','required');
		$this->form_validation->set_rules('agama','Agama','required');
		$this->form_validation->set_rules('status_dlm_kel','Status dalam Keluarga','required');
		$this->form_validation->set_rules('anakke','Anak Ke','required');
		$this->form_validation->set_rules('alamat_siswa','Alamat Siswa','required');
		$this->form_validation->set_rules('telpon_siswa','Telpon Siswa','required');
		$this->form_validation->set_rules('asal_sekolah','Asal Sekolah','required');
		$this->form_validation->set_rules('kelas','Kelas','required');
		$this->form_validation->set_rules('diterima_tgl','Tanggal Diterima','required');
		$this->form_validation->set_rules('nama_ayah','Nama Ayah','required');
		$this->form_validation->set_rules('nama_ibu','Nama Ibu','required');
		$this->form_validation->set_rules('alamat_ortu','Alamat Ortu','required');
		$this->form_validation->set_rules('telpon_ortu','Telpon Ortu','required');
		$this->form_validation->set_rules('kerja_ayah','Pekerjaan Ayah','required');
		$this->form_validation->set_rules('kerja_ibu','Pekerjaan Ibu','required');
		$this->form_validation->set_rules('nama_wali','Nama Wali','required');
		$this->form_validation->set_rules('alamat_wali','Alamat Wali','required');
		$this->form_validation->set_rules('telpon_wali','Telpon Wali','required');
		$this->form_validation->set_rules('kerja_wali','Pekerjaan Wali','required');
		$this->form_validation->set_rules('tahun_ajaran','Tahun Ajaran','required');
		$this->form_validation->set_rules('kelamin','Kelamin','required');
		$this->form_validation->set_rules('username','Username','required');
		
		$this->form_validation->set_rules('status','Status','required');
		
		//<!> Cek File upload <<---------

		if(!empty($_FILES['userfile']['name']))
		{
			$config['upload_path'] = './assets/photos';
			$config['file_name'] = time().'_'.$_FILES['userfile']['name'];
			$config['allowed_types'] = 'gif|jpg|jpeg|png|JPG|JPEG';
			$config['max_size'] = 500;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if($this->form_validation->run()==FALSE && !$this->upload->do_upload('userfile'))
			{
				$this->setmessage(validation_errors().$this->upload->display_errors(),'warning');
				redirect('admin/edit_siswa/'.$post['id_siswa'].'/?m=data_induk&sm=siswa');
			}
			elseif($this->form_validation->run()==FALSE OR !$this->upload->do_upload('userfile'))
			{
				$this->setmessage(validation_errors().$this->upload->display_errors(),'warning');
				redirect('admin/edit_siswa/'.$post['id_siswa'].'/?m=data_induk&sm=siswa');
			}
			else
			{
				$foto = $this->upload->data();
				//Compress Image
				$config['image_library']='gd2';
				$config['source_image']='./assets/photos/'.$foto['file_name'];
				$config['create_thumb']= FALSE;
				$config['maintain_ratio']= FALSE;
				$config['quality']= '100%';
				$config['width']= 400;
				$config['height']= 400;
				$config['new_image']= './assets/photos/'.$foto['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();

				$data = array(
					'nama_siswa' => trim(ucwords(htmlentities($post['nama_siswa']))),
					'nis' => trim(htmlentities($post['nis'])),
					'nisn' => trim(htmlentities($post['nisn'])),
					'tempat_lahir' => trim(htmlentities($post['tempat_lahir'])),
					'tgl_lahir' => trim($post['tgl_lahir']),
					'kelamin' => trim(htmlentities($post['kelamin'])),
					'agama' => trim(htmlentities($post['agama'])),
					'status_dlm_kel' => trim(htmlentities($post['status_dlm_kel'])),
					'anakke' => trim(htmlentities($post['anakke'])),
					'alamat_siswa' => trim(ucwords(htmlentities($post['alamat_siswa']))),
					'telpon_siswa' => trim(htmlentities($post['telpon_siswa'])),
					'asal_sekolah' => trim(htmlentities($post['asal_sekolah'])),
					'kelas' => trim(htmlentities($post['kelas'])),
					'diterima_tanggal' => trim(htmlentities($post['diterima_tgl'])),
					'nama_ayah' => trim(htmlentities($post['nama_ayah'])),
					'nama_ibu' => trim(htmlentities($post['nama_ibu'])),
					'alamat_ortu' => trim(htmlentities($post['alamat_ortu'])),
					'telpon_ortu' => trim(htmlentities($post['telpon_ortu'])),
					'kerja_ayah' => trim(htmlentities($post['kerja_ayah'])),
					'kerja_ibu' => trim(htmlentities($post['kerja_ibu'])),
					'nama_wali' => trim(htmlentities($post['nama_wali'])),
					'alamat_wali' => trim(htmlentities($post['alamat_wali'])),
					'telpon_wali' => trim(htmlentities($post['telpon_wali'])),
					'kerja_wali' => trim(htmlentities($post['kerja_wali'])),
					'tahun_ajaran' => trim(htmlentities($post['tahun_ajaran'])),
					'username' => trim(htmlentities($post['username'])),
					'password' => trim(md5(htmlentities($post['password']))),
					'foto_siswa' => $foto['file_name'],
					'status' => trim($post['status'])
				);

				//----->>hapus foto lama<<---
				if($post['fotolama']!=''){
					unlink('./assets/photos/'.$post['fotolama'].'');
				}

				$where = array('id_siswa' => $post['id_siswa']);
				$this->m_admin->update_dataTable($where,$data,'data_siswa');

				//-->> Set Message <<--
				$this->setmessage('Berhasil memperbarui data siswa.','success');

				redirect('admin/edit_siswa/'.$post['id_siswa'].'/?m=data_induk&sm=siswa');
			}
		}
		elseif($this->form_validation->run()==FALSE)
		{
			$this->setmessage(validation_errors(),'warning');
			redirect('admin/edit_siswa/'.$post['id_siswa'].'/?m=data_induk&sm=siswa');
		}
		else
		{
			$data = array(
					'nama_siswa' => trim(ucwords(htmlentities($post['nama_siswa']))),
					'nis' => trim(htmlentities($post['nis'])),
					'nisn' => trim(htmlentities($post['nisn'])),
					'tempat_lahir' => trim(htmlentities($post['tempat_lahir'])),
					'tgl_lahir' => trim($post['tgl_lahir']),
					'kelamin' => trim(htmlentities($post['kelamin'])),
					'agama' => trim(htmlentities($post['agama'])),
					'status_dlm_kel' => trim(htmlentities($post['status_dlm_kel'])),
					'anakke' => trim(htmlentities($post['anakke'])),
					'alamat_siswa' => trim(ucwords(htmlentities($post['alamat_siswa']))),
					'telpon_siswa' => trim(htmlentities($post['telpon_siswa'])),
					'asal_sekolah' => trim(htmlentities($post['asal_sekolah'])),
					'kelas' => trim(htmlentities($post['kelas'])),
					'diterima_tanggal' => trim(htmlentities($post['diterima_tgl'])),
					'nama_ayah' => trim(htmlentities($post['nama_ayah'])),
					'nama_ibu' => trim(htmlentities($post['nama_ibu'])),
					'alamat_ortu' => trim(htmlentities($post['alamat_ortu'])),
					'telpon_ortu' => trim(htmlentities($post['telpon_ortu'])),
					'kerja_ayah' => trim(htmlentities($post['kerja_ayah'])),
					'kerja_ibu' => trim(htmlentities($post['kerja_ibu'])),
					'nama_wali' => trim(htmlentities($post['nama_wali'])),
					'alamat_wali' => trim(htmlentities($post['alamat_wali'])),
					'telpon_wali' => trim(htmlentities($post['telpon_wali'])),
					'kerja_wali' => trim(htmlentities($post['kerja_wali'])),
					'tahun_ajaran' => trim(htmlentities($post['tahun_ajaran'])),
					'username' => trim(htmlentities($post['username'])),
					'password' => trim(md5(htmlentities($post['password']))),
					'status' => trim($post['status'])
				);


				$where = array('id_siswa' => $post['id_siswa']);
				$this->m_admin->update_dataTable($where,$data,'data_siswa');

				//-->> Set Message <<--
				$this->setmessage('Berhasil memperbarui '.$jml.' data siswa.','success');

				redirect('admin/edit_siswa/'.$post['id_siswa'].'/?m=data_induk&sm=siswa');
		}
		
			
	}

	//-->> Singgle Action <<--
	public function edit_siswa()
	{
		$where = array('id_siswa' => $this->uri->segment(3));
		$data['data_siswa'] = $this->m_admin->select_dataWhere($where,'data_siswa');
		$data['datakelas'] = $this->m_admin->select_table_orderby('nama_kelas ASC','setup_kelas');
		$data['tahunajaran'] = $this->m_admin->select_table_orderby('tahun ASC','setup_tahun');
		$id_admin = $this->session->userdata('id');
		$where = array('id_admin' => $id_admin);
		$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');
		$data['page_title'] = "<h1>Edit Data<small>melakukan perubahan data siswa</small></h1>";
		//$data['tipe_form'] = "multi";
		$data['content'] = "admin/v_edit_siswa";
		$this->load->view('admin/index',$data);
	}

	public function drop_siswa()
	{
		$where = array('id_siswa' => $this->uri->segment(3));
		$this->m_admin->delete_dataTable($where,'data_siswa');

		$this->setmessage('Berhasil menghapus data siswa','success');

		redirect('admin/data_siswa?m=data_induk&sm=siswa');

	}

	public function reset_password_siswa()
	{
		$post = $this->input->post();
		$passdefault = array('password' => md5(12345));

		$this->m_admin->update_dataTable('id_siswa='.$post['id_siswa'].'',$passdefault,'data_siswa');
		$this->setmessage('Password berhasil direset ke password default (12345)!','success');
		redirect($post['back_url']);
	}

	/*public function reset_pass_siswa()
	{
		$this->form_validation->set_rules('pass_lama','Password Sekarang','required');
		$this->form_validation->set_rules('password','Password Baru','required');
		$this->form_validation->set_rules('repassword','Konfirmasi Password','required|matches[password]');

		if($this->form_validation->run()==FALSE)
		{
			$this->setmessage(validation_errors(),'warning');
			redirect('admin/edit_siswa/'.$this->input->post('id_siswa').'/?m=data_induk&sm=siswa');
		}
		else
		{
			$old = trim(md5(htmlentities($this->input->post('pass_lama'))));
			$where = array('id_siswa'=> $this->input->post('id_siswa'), 'password' => $old);

			$cek = $this->m_admin->select_dataWhere($where,'data_siswa')->num_rows();
			if($cek<1)
			{
				$this->setmessage('Maaf, isian untuk <b>Password Sekarang</b> salah!','danger');
				redirect('admin/edit_siswa/'.$this->input->post('id_siswa').'/?m=data_induk&sm=siswa');
			}
			else
			{

				$data = array(
					'password' => trim(md5(htmlentities($this->input->post('password'))))
				);

				$where = array('id_siswa' => $this->input->post('id_siswa'));
				$this->m_admin->update_dataTable($where,$data,'data_siswa');

				$this->setmessage('Password berhasil diganti','success');

				redirect('admin/edit_siswa/'.$this->input->post('id_siswa').'/?m=data_induk&sm=siswa');
			}
		}

	}*/

/*
|=================================================================================
| 8) BAGIAN PENJADWALAN - RUANG KELAS
|=================================================================================
*/

public function jadwal_ruangkelas()
{
	//Filtering data ref siswa::
	if(isset($_POST['sort_ref_siswa']))
	{
		$jml_hlm = $this->input->post('jml_hlm');
		$status_siswa = $this->input->post('status_siswa');
		//menyimpan data post ke session;
		$data = array('ses_stat_siswa' => $status_siswa,'ses_siswa_rows' => $jml_hlm);
		$this->session->set_userdata($data);
	}
	elseif($this->session->userdata('ses_stat_siswa')!='')
	{
		$status_siswa = $this->session->userdata('ses_stat_siswa');
		$jml_hlm = $this->session->userdata('ses_siswa_rows');
		
	}
	else
	{
		//Default:
		$jml_hlm = 5;
		$status_siswa = 1;
	}

	//Filtering data pembagian kelas::
	if(isset($_POST['sort_pembagian_kelas']))
	{
		$per_hlm = $this->input->post('rows');
		$id_kelas = $this->input->post('kelas');
		$where = array('id_tahun' => $this->input->post('tahun'));
		$setup_tahun = $this->m_admin->select_dataWhere($where,'setup_tahun')->row();
		//menyimpan data post ke session;
		$data = array(
			'ses_idthn_pel' => $this->input->post('tahun'),
			'ses_tbl_rows' => $per_hlm,
			'ses_id_kelas' => $id_kelas
		);
		$this->session->set_userdata($data);
	}
	elseif($this->session->userdata('ses_idthn_pel')!='' && $this->session->userdata('ses_tbl_rows')!='' && $this->session->userdata('ses_id_kelas')!='')
	{
		$per_hlm = $this->session->userdata('ses_tbl_rows');
		$id_kelas = $this->session->userdata('ses_id_kelas');
		$where = array('id_tahun' => $this->session->userdata('ses_idthn_pel'));
		$setup_tahun = $this->m_admin->select_dataWhere($where,'setup_tahun')->row();
	}
	else
	{
		//Default:
		$per_hlm = 5;
		$kelas = $this->m_admin->select_data('id_kelas','id_kelas ASC','setup_kelas',1)->row();

		$id_kelas = $kelas->id_kelas;
		$where = array('status_aktif' => 1);
		$setup_tahun = $this->m_admin->select_dataWhere($where,'setup_tahun')->row();
	}

	

	//------------>>>><<<<--------\\

	$id_admin = $this->session->userdata('id');
	$where = array('id_admin' => $id_admin);
	$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');
	$data['page_title'] = "<h1>Pembagian Ruang Kelas<small> pembagian kelas siswa sesuai tahun dan kelasnya</small></h1>";

	//Data Referensi Seluruh Siswa::>>
	//hanya menampilkan siswa yang belum memiliki kelas
	$data['ref_siswa'] = $this->m_admin->belum_punya_kelas();
	$data['jml_siswa'] = $data['ref_siswa']->num_rows();
	//Pgination Config::
	/*$siteurl = site_url('admin/jadwal_ruangkelas/');
	$rows = $data['jml_siswa'];
	$perpage = $jml_hlm;
	$urisegment = 3;
	$Mfunction = "ref_data_siswa_wp";
	$key = $status_siswa;
	$model = "m_admin";
	$type = "ada_where";
	include("pagination_conf_2.php");*/
	//end Pagination::

	$data['pd_tahun'] = $setup_tahun->tahun;
	$data['ruangkelas'] = $this->m_admin->data_pembagian_kelas($setup_tahun->id_tahun,$id_kelas);
	$data['jml_data'] = $data['ruangkelas']->num_rows();
	//data tahun pelajaran
	$data['tahun_pelajaran'] = $this->m_admin->select_table_orderby('tahun DESC', 'setup_tahun');
	//data kelas
	$data['kelas'] = $this->m_admin->select_table_orderby('nama_kelas ASC', 'setup_kelas');
	//Pgination Config::
	$siteurl = site_url('admin/jadwal_ruangkelas/');
	$rows = $data['ruangkelas']->num_rows();
	$perpage = $per_hlm;
	$urisegment = 3;
	$Mfunction = "pembagian_kelas_wp";
	$key1 = $setup_tahun->id_tahun;
	$key2 = $id_kelas;
	$model = "m_admin";
	$type = "dua_where";
	include("pagination_config.php");
	//end Pagination::
	$data['content'] = "admin/v_pembagian_kelas";
	$this->load->view('admin/index',$data);
}

public function ruangkelas_siswa_baru()
{
	$id_admin = $this->session->userdata('id');
	$where = array('id_admin' => $id_admin);
	$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');
	$data['page_title'] = "<h1>Pembagian Ruang Kelas<small> pembagian kelas siswa sesuai tahun dan kelasnya</small></h1>";

	//Data Referensi Seluruh Siswa::>>
	//hanya menampilkan siswa yang belum memiliki kelas
	$data['ref_siswa'] = $this->m_admin->belum_punya_kelas();
	$data['jml_siswa'] = $data['ref_siswa']->num_rows();
	
	
	//data tahun pelajaran
	$data['tahun_pelajaran'] = $this->m_admin->select_table_orderby('tahun DESC', 'setup_tahun');
	//data kelas
	$data['kelas'] = $this->m_admin->select_table_orderby('nama_kelas ASC', 'setup_kelas');
	
	$data['content'] = "admin/v_pembagian_kelas_siswabaru";
	$this->load->view('admin/index',$data);
}

public function drop_siswa_dari_kelas()
{
		$where = array('id_ruangan' => $this->uri->segment(3));
		$this->m_admin->delete_dataTable($where,'tbl_ruangan');

		$this->setmessage('Berhasil menghapus <b>'.humanize($this->uri->segment(4),'%20').'</b> dari kelas <b>'.$this->uri->segment(5).'</b>','success');

		redirect('admin/jadwal_ruangkelas?m=penjadwalan&sm=ruang_kelas');

}

public function proses_pembagian_kelas()
{

	if(isset($_POST['set_new_kelas'])){
		$post = $this->input->post();
		$check = $post['check'];
		$jml = count($check);

		if(isset($check))
		{

		//Memeriksa apakah ditemukan data double::
		
		$cek_data = $this->m_admin->select_pembagian_kelas($post)->num_rows();

		if($cek_data>0){
			$this->setmessage('Tidak dapat memproses data. Ini terjadi karena system menemukan data yang dianggap sama!','danger');
			redirect('admin/ruangkelas_siswa_baru?m=penjadwalan&sm=set_kelas_siswa_baru');
		}else{
			$this->m_admin->set_pembagian_kelas($post);
			
			$this->setmessage($jml.' data berhasil diperbarui!','success');
			redirect('admin/ruangkelas_siswa_baru?m=penjadwalan&sm=set_kelas_siswa_baru');
		}

		}else{
			$this->setmessage('Tidak ada data yang terpilih!','warning');
			redirect('admin/ruangkelas_siswa_baru?m=penjadwalan&sm=set_kelas_siswa_baru');
		}
	}

	if(isset($_POST['set_kelas'])){
		$post = $this->input->post();
		$check = $post['check'];
		$jml = count($check);

		if(isset($check))
		{

		//Memeriksa apakah ditemukan data double::
		
		$cek_data = $this->m_admin->select_pembagian_kelas($post)->num_rows();

		if($cek_data>0){
			$this->setmessage('Tidak dapat memproses data. Ini terjadi karena system menemukan data yang dianggap sama!','danger');
			redirect('admin/jadwal_ruangkelas?m=penjadwalan&sm=ruang_kelas');
		}else{
			$this->m_admin->set_pembagian_kelas($post);
			
			$this->setmessage($jml.' data berhasil diperbarui!','success');
			redirect('admin/jadwal_ruangkelas?m=penjadwalan&sm=ruang_kelas');
		}

		}else{
			$this->setmessage('Tidak ada data yang terpilih!','warning');
			redirect('admin/jadwal_ruangkelas?m=penjadwalan&sm=ruang_kelas');
		}
	}


	//Aksi Tombol Multidelete

	if(isset($_POST['multidelete'])){
		$post = $this->input->post();
		$check = $post['check'];
		$jml = count($check);
		if(isset($check)){
					
		//menghapus data di database
		$cols = "id_ruangan";
		$this->m_admin->hapus_siswa_dari_kelas($post,'tbl_ruangan',$cols);

		$this->setmessage($jml.' Data berhasil dihapus!','success');
		redirect('admin/jadwal_ruangkelas?m=penjadwalan&sm=ruang_kelas');
	}else{
			$this->setmessage('Terjadi kesalahan. Tidak ada data yang dipilih!','warning');
		redirect('admin/jadwal_ruangkelas?m=penjadwalan&sm=ruang_kelas');
		}
	}
}

/*
|=================================================================================
| 9) BAGIAN PENJADWALAN - GURU MENGAJAR
|=================================================================================
*/

public function jadwal_guru()
{
	//Aksi Tombol Multidelete

	if(isset($_POST['multidelete'])){
		$post = $this->input->post();
		$check = $post['check'];
		$jml = count($check);
		if(isset($check)){
					
		//menghapus data di database
		$cols = "id_jadwal";
		$this->m_admin->hapus_siswa_dari_kelas($post,'tbl_jadwal',$cols);

		$this->setmessage($jml.' Data berhasil dihapus!','success');
		redirect('admin/jadwal_guru?m=penjadwalan&sm=guru_mengajar');
	}else{
			$this->setmessage('Terjadi kesalahan. Tidak ada data yang dipilih!','warning');
		redirect('admin/jadwal_guru?m=penjadwalan&sm=guru_mengajar');
		}
	}

	//Filtering data jadwal guru mengajar::
	if(isset($_POST['sort_jadwal_mengajar']))
	{
		$id_kelas = trim($this->input->post('kelas'));
		$id_semester = trim($this->input->post('semester'));
		$id_tahun = trim($this->input->post('tahun'));
		$per_hlm = trim($this->input->post('rows'));

		$where = array('id_tahun' => $id_tahun);
		$setup_tahun = $this->m_admin->select_dataWhere($where,'setup_tahun')->row();
		//menyimpan data post ke session;
		$data = array(
			'ses_mengajar_kelas' => $id_kelas,
			'ses_mengajar_thn' => $id_tahun,
			'ses_mengajar_semes' => $id_semester,
			'ses_mengajar_rows' => $per_hlm
		);
		$this->session->set_userdata($data);
	}
	elseif($this->session->userdata('ses_mengajar_kelas')!='' && $this->session->userdata('ses_mengajar_thn')!='' && $this->session->userdata('ses_mengajar_semes')!='' && $this->session->userdata('ses_mengajar_rows')!='')
	{
		
		$id_kelas = $this->session->userdata('ses_mengajar_kelas');
		$id_semester = $this->session->userdata('ses_mengajar_semes');
		$id_tahun = $this->session->userdata('ses_mengajar_thn');
		$per_hlm = $this->session->userdata('ses_mengajar_rows');
		$where = array('id_tahun' => $id_tahun);
		$setup_tahun = $this->m_admin->select_dataWhere($where,'setup_tahun')->row();
	}
	else
	{
		//Default:

		$kelas = $this->m_admin->select_data('id_kelas','id_kelas ASC','setup_kelas',1)->row();
		$semester = $this->m_admin->select_data('id_semester','id_semester ASC','setup_semester',1)->row();
		
		$id_kelas = $kelas->id_kelas;
		$id_semester = $semester->id_semester;
		$per_hlm = 5;

		$where = array('status_aktif' => 1);
		$setup_tahun = $this->m_admin->select_dataWhere($where,'setup_tahun')->row();
	}

	$id_admin = $this->session->userdata('id');
	$where = array('id_admin' => $id_admin);
	$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');
	$data['page_title'] = "<h1>Jadwal Guru Mengajar<small> Pembagian guru mengajar di kelas</small></h1>";
	//data guru
	$data['guru'] = $this->m_admin->select_table_orderby('nama_guru ASC','data_guru');
	//data mapel
	$data['mapel'] = $this->m_admin->select_table_orderby('nama_pelajaran ASC','setup_pelajaran');
	//data kelas
	$data['kelas'] = $this->m_admin->select_table_orderby('nama_kelas ASC','setup_kelas');
	//data tahun
	$data['tahun'] = $this->m_admin->select_table_orderby('tahun DESC','setup_tahun');
	//data semester
	$data['semester'] = $this->m_admin->select_table_orderby('id_semester ASC','setup_semester');
	//Jadwal Tahun
	$data['pd_tahun'] = $setup_tahun->tahun;
	//data jadwal guru mengajar
	$where = array(
		'jadwal.id_kelas' => $id_kelas,
		'jadwal.id_semester' => $id_semester,
		'jadwal.id_tahun' => $setup_tahun->id_tahun
	);
	$data['jdwl_guru'] = $this->m_admin->jadwal_guru_mengajar($where);
	$data['jml_data'] = $data['jdwl_guru']->num_rows();
	//Pgination Config::
	$siteurl = site_url('admin/jadwal_guru/');
	$rows = $data['jml_data'];
	$perpage = $per_hlm;
	$urisegment = 3;
	$Mfunction = "jadwal_guru_wp";
	$key = array(
		'jadwal.id_kelas' => $id_kelas,
		'jadwal.id_semester' => $id_semester,
		'jadwal.id_tahun' => $setup_tahun->id_tahun
	);
	$model = "m_admin";
	$type = "ada_where";
	include("pagination_config.php");
	//end Pagination::
	
	$data['content'] = "admin/v_jadwal_guru_mengajar";
	$this->load->view('admin/index',$data);
}

public function set_jadwal_guru()
{
	$data = array(
		'id_guru' => trim(htmlentities($this->input->post('id_guru'))),
		'id_pelajaran' => trim(htmlentities($this->input->post('id_pelajaran'))),
		'id_kelas' => trim(htmlentities($this->input->post('id_kelas'))),
		'id_tahun' => trim(htmlentities($this->input->post('tahun'))),
		'id_semester' => trim(htmlentities($this->input->post('semester')))
	);

	$where = $data;
	$cek = $this->m_admin->select_dataWhere($where,'tbl_jadwal')->num_rows();
	if($cek>0)
	{
		$this->setmessage('Sytem menemukan data yang sama, proses tidak dapat dilanjutkan!','danger');
		redirect('admin/jadwal_guru?m=penjadwalan&sm=guru_mengajar');
	}
	else
	{
		$this->m_admin->insert_dataTo($data,'tbl_jadwal');
		$this->setmessage('Data berhasil disimpan!','success');
		redirect('admin/jadwal_guru?m=penjadwalan&sm=guru_mengajar');
	}

}

public function edit_jadwal_guru()
{

	$id_jadwal = $this->uri->segment(3);
	$data['jadwalguru'] = $this->m_admin->select_dataWhere('id_jadwal = '.$id_jadwal.'','tbl_jadwal');

	$id_admin = $this->session->userdata('id');
	$where = array('id_admin' => $id_admin);
	$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');
	$data['page_title'] = "<h1>Jadwal Guru Mengajar<small> Pembagian guru mengajar di kelas</small></h1>";
	//data guru
	$data['guru'] = $this->m_admin->select_table_orderby('nama_guru ASC','data_guru');
	//data mapel
	$data['mapel'] = $this->m_admin->select_table_orderby('nama_pelajaran ASC','setup_pelajaran');
	//data kelas
	$data['kelas'] = $this->m_admin->select_table_orderby('nama_kelas ASC','setup_kelas');
	//data tahun
	$data['tahun'] = $this->m_admin->select_table_orderby('tahun DESC','setup_tahun');
	//data semester
	$data['semester'] = $this->m_admin->select_table_orderby('id_semester ASC','setup_semester');

	$data['content'] = "admin/v_edit_jadwal_guru";
	$this->load->view('admin/index',$data);
}

public function update_jadwal_guru()
{
	$id_jadwal = trim(htmlentities($this->input->post('id_jadwal')));
	$data = array(
		'id_guru' => trim(htmlentities($this->input->post('id_guru'))),
		'id_pelajaran' => trim(htmlentities($this->input->post('id_pelajaran'))),
		'id_kelas' => trim(htmlentities($this->input->post('id_kelas'))),
		'id_tahun' => trim(htmlentities($this->input->post('tahun'))),
		'id_semester' => trim(htmlentities($this->input->post('semester')))
	);

	$where = $data;
	$cek = $this->m_admin->select_dataWhere($where,'tbl_jadwal')->num_rows();
	if($cek>0)
	{
		$this->setmessage('Sytem menemukan data yang sama, proses tidak dapat dilanjutkan!','danger');
		redirect('admin/edit_jadwal_guru/'.$id_jadwal.'?m=penjadwalan&sm=guru_mengajar');
	}
	else
	{
		$whereid = array('id_jadwal' => $id_jadwal);
		$this->m_admin->update_dataTable($whereid,$data,'tbl_jadwal');
		$this->setmessage('Data berhasil disimpan!','success');
		redirect('admin/edit_jadwal_guru/'.$id_jadwal.'?m=penjadwalan&sm=guru_mengajar');
	}

}

public function drop_jadwal_guru()
{
		$where = array('id_jadwal' => $this->uri->segment(3));
		$this->m_admin->delete_dataTable($where,'tbl_jadwal');

		$this->setmessage('Data berhasil dihapus!','success');

		redirect('admin/jadwal_guru?m=penjadwalan&sm=guru_mengajar');

}


/*
|=================================================================================
| 10) BAGIAN PENJADWALAN - WALI KELAS
|=================================================================================
*/

public function penjadwalan_wali_kelas()
{
	//Filtering data wali kelas::
	if(isset($_POST['sort_wali_kelas']))
	{
		$per_hlm = $this->input->post('rows');
		$where = array('id_tahun' => $this->input->post('tahun'));
		$setup_tahun = $this->m_admin->select_dataWhere($where,'setup_tahun')->row();
		//menyimpan data post ke session;
		$data = array('ses_wali_thn' => $this->input->post('tahun'),'ses_wali_rows' => $per_hlm);
		$this->session->set_userdata($data);
	}
	elseif($this->session->userdata('ses_wali_thn')!='')
	{
		$per_hlm = $this->session->userdata('ses_wali_rows');
		$where = array('id_tahun' => $this->session->userdata('ses_wali_thn'));
		$setup_tahun = $this->m_admin->select_dataWhere($where,'setup_tahun')->row();
	}
	else
	{
		//Default:
		$per_hlm = 5;
		$where = array('status_aktif' => 1);
		$setup_tahun = $this->m_admin->select_dataWhere($where,'setup_tahun')->row();
	}

	//Aksi Tombol Multidelete

	if(isset($_POST['multidelete'])){
		$post = $this->input->post();
		$check = $post['check'];
		$jml = count($check);
		if(isset($check)){
					
		//menghapus data di database
		$cols = "id_wali";
		$this->m_admin->del_selected_data($post,'tbl_wali',$cols);

		$this->setmessage($jml.' Data berhasil dihapus!','success');
		redirect('admin/penjadwalan_wali_kelas?m=penjadwalan&sm=wali_kelas');
	}else{
		$this->setmessage('Terjadi kesalahan. Tidak ada data yang dipilih!','warning');
		redirect('admin/penjadwalan_wali_kelas?m=penjadwalan&sm=wali_kelas');
		}
	}

	$id_admin = $this->session->userdata('id');
	$where = array('id_admin' => $id_admin);
	$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');
	$data['page_title'] = "<h1>Penentuan Wali Kelas<small> Pembagian guru sebagai wali kelas</small></h1>";
	//data guru
	$data['guru'] = $this->m_admin->select_table_orderby('nama_guru ASC','data_guru');
	//data tahun
	$data['tahun_pelajaran'] = $this->m_admin->select_table_orderby('tahun DESC','setup_tahun');
	//data kelas
	$data['kelas'] = $this->m_admin->select_table_orderby('nama_kelas ASC','setup_kelas');
	
	//untuk judul tahun
	$data['pd_tahun'] = $setup_tahun->tahun;
	//data wali kelas	
	$data['wali_kelas'] = $this->m_admin->pembagian_wali_kelas($setup_tahun->id_tahun);
	$data['jml_data'] = $data['wali_kelas']->num_rows();
	//Pgination Config::
	$siteurl = site_url('admin/penjadwalan_wali_kelas/');
	$rows = $data['jml_data'];
	$perpage = $per_hlm;
	$urisegment = 3;
	$Mfunction = "wali_kelas_wp";
	$key = $setup_tahun->id_tahun;
	$model = "m_admin";
	$type = "ada_where";
	include("pagination_config.php");
	//end Pagination::
	
	$data['content'] = "admin/v_pembagian_wali_kelas";
	$this->load->view('admin/index',$data);
}

public function set_wali_kelas()
{
	$id_guru = trim(htmlentities($this->input->post('id_guru')));
	$id_tahun = trim(htmlentities($this->input->post('id_tahun')));
	$id_kelas = trim(htmlentities($this->input->post('id_kelas')));
	$data = array(
		'id_guru' => $id_guru,
		'id_tahun' => $id_tahun,
		'id_kelas' => $id_kelas
	);

	$nama_kelas = $this->m_admin->select_dataWhere('id_kelas='.$id_kelas.'','setup_kelas')->row('nama_kelas');
	$tahun = $this->m_admin->select_dataWhere('id_tahun='.$id_tahun.'','setup_tahun')->row('tahun');

	//memeriksa untuk memastikan hanya meengaampu 1 kelas pada tahun yg sama dan kelas belum ada yang mengampu pada tahun ajaran tersebut,
	
	$cek1 = $this->m_admin->select_dataWhere('id_guru='.$id_guru.' AND id_tahun='.$id_tahun.'','tbl_wali')->num_rows();
	$cek2 = $this->m_admin->select_dataWhere('id_tahun='.$id_tahun.' AND id_kelas='.$id_kelas.'','tbl_wali')->num_rows();
	if($cek1>0)
	{
		$this->setmessage('Sytem menemukan data yang sama, proses tidak dapat dilanjutkan!','danger');
		redirect('admin/penjadwalan_wali_kelas?m=penjadwalan&sm=wali_kelas');
	}
	elseif($cek2>0)
	{
		$this->setmessage('Kelas <b>'.$nama_kelas.'</b> sudah diampu oleh guru yang lain pada tahun ajaran <b>'.$tahun.'</b>, proses tidak dapat dilanjutkan!','danger');
		redirect('admin/penjadwalan_wali_kelas?m=penjadwalan&sm=wali_kelas');
	}
	else
	{
		$this->m_admin->insert_dataTo($data,'tbl_wali');
		$this->setmessage('Data berhasil disimpan!','success');
		redirect('admin/penjadwalan_wali_kelas?m=penjadwalan&sm=wali_kelas');
	}

}

public function drop_wali()
{
		$where = array('id_wali' => $this->uri->segment(3));
		$this->m_admin->delete_dataTable($where,'tbl_wali');

		$this->setmessage('Data berhasil dihapus!','success');

		redirect('admin/penjadwalan_wali_kelas?m=penjadwalan&sm=wali_kelas');

}




	/*>>>>>>>>>>>>>>>>>>>>>>><<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<*/


public function msg()
{
	$data['message'] = $this->m_admin->select_dataFrom('tb_message');

	$data['content'] = "admin/v_data_message";
	$this->load->view('admin/index',$data);
}

public function detail_msg()
{
	$where = array('id_msg' => $this->uri->segment(3));
	$data['dtmessage'] = $this->m_admin->select_datawhere($where,'tb_message');

	//update status pesan => 1;
	$wheremsg = array('id_msg' => $this->uri->segment(3));
	$data2 = array('status' => 1);
	$this->m_admin->update_dataTable($wheremsg,$data2,'tb_message');

	$data['content'] = "admin/v_detail_message";
	$this->load->view('admin/index',$data);
}

public function del_msg()
{
	if(isset($_POST['multidelete'])){
			$post = $this->input->post();
			$check = $post['check'];
			if(isset($check)){
				
				//menghapus data di database
				$cols = "id_msg";
				$this->m_admin->del_selected_data($post,'tb_message',$cols);

			$this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data berhasil dihapus!</div>');

			redirect('admin/msg');
			}else{
		$this->session->set_flashdata('notif', '<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-warning"></i> Terjadi kesalahan. Tidak ada data yang dipilih!</div>');
			redirect('admin/msg');
			}
		}
}

public function reset_password_guru()
{
	$post = $this->input->post();
	$passdefault = array('password' => md5(12345));

	$this->m_admin->update_dataTable('id_guru='.$post['id_guru'].'',$passdefault,'data_guru');
	$this->setmessage('Password berhasil direset ke password default (12345)!','success');
	redirect($post['back_url']);
}

/*
* -----------------
* POST
* -----------------
*/

public function tulisan_baru()
{
	$id_admin = $this->session->userdata('id');
	$where = array('id_admin' => $id_admin);
	$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');
	$data['page_title'] = '<h1>Tulisan Baru <small>Membuat tulisan baru</small></h1>';
		
	$data['content'] = "admin/post/v_tulisan_baru";
	$this->load->view('admin/index',$data);
}

public function semua_tulisan()
{
	$id_admin = $this->session->userdata('id');
	$where = array('id_admin' => $id_admin);
	$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');
	$data['page_title'] = '<h1>Semua Tulisan <small>Mengelola data post/tulisan</small></h1>';
	
	$data['data_tulisan'] = $this->m_admin->get_data_tulisan();	
	$data['content'] = "admin/post/v_semua_tulisan";
	$this->load->view('admin/index',$data);
}

public function edit_tulisan()
{
	$idpost = $this->uri->segment(3);

	$id_admin = $this->session->userdata('id');
	$where = array('id_admin' => $id_admin);
	$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');
	$data['page_title'] = '<h1>Edit Tulisan </h1>';
	
	$data['data_tulisan'] = $this->m_admin->select_dataWhere('id_post='.$idpost.'','tbl_post');	
	$data['content'] = "admin/post/v_edit_tulisan";
	$this->load->view('admin/index',$data);

}

public function proses_simpan_tulisan()
{
	$post = $this->input->post();
	if(isset($post['insert']))
	{
		$this->tulisan_formvalidation();

		if($this->form_validation->run()==FALSE)
		{
			$this->setmessage(validation_errors(),'warning');
			$this->tulisan_baru();
		}
		else
		{
			
			$data = array(
				'type_post' => trim(htmlentities($post['kategori'])),
				'judul_post' => trim(htmlentities($post['judul'])),
				'isi_post' => trim($post['isi']),
				'privacy_post' => trim(htmlentities($post['privacy'])),
				'tgl_post' => date('Y-m-d H:i:s'),
				'author_post' => $this->session->userdata('id')
			);

			$this->m_admin->insert_dataTo($data,'tbl_post');
			$post_type = ucwords($post['kategori']);
			$this->setmessage($post_type.' tentang <b>'.$post['judul'].'</b> berhasil disimpan','success');
			redirect('admin/semua_tulisan?m=post&sm=semua_tulisan');

		}
	}

	if(isset($post['update']))
	{
		$this->tulisan_formvalidation();

		if($this->form_validation->run()==FALSE)
		{
			$this->setmessage(validation_errors(), 'warning');
			redirect($post['back_url']);
		}
		else
		{
			$data = array(
				'type_post' => trim(htmlentities($post['kategori'])),
				'judul_post' => trim(htmlentities($post['judul'])),
				'isi_post' => trim($post['isi']),
				'privacy_post' => trim(htmlentities($post['privacy'])),
				'author_post' => $this->session->userdata('id')
			);

			$this->m_admin->update_dataTable('id_post='.$post['id_post'].'',$data,'tbl_post');
			$post_type = ucwords($post['kategori']);
			$this->setmessage($post_type.' tentang <b>'.$post['judul'].'</b> berhasil diperbarui!','success');

			redirect('admin/semua_tulisan?m=post&sm=semua_tulisan');
		}
	}


}

private function tulisan_formvalidation()
{
	$this->form_validation->set_rules('judul','Judul','required');
	$this->form_validation->set_rules('isi','Isi','required');
	$this->form_validation->set_rules('kategori','Kategori','required');
	$this->form_validation->set_rules('privacy','Pemirsa','required');
}

public function aksi_tulisan()
	{
		$post = $this->input->post();

		if(isset($post['multidelete'])){
			$check = $post['check'];
			$jml = count($check);
			if(isset($check)){
				
				//menghapus data di database
				$cols = "id_post";
				$this->m_admin->del_selected_data($post,'tbl_post',$cols);

			$this->setmessage('Berhasil menghapus '.$jml.' tulisan','success');

			redirect('admin/semua_tulisan?m=post&sm=semua_tulisan');
			}else{
				$this->setmessage('Tidak ada data yang dipilih!','warning');

				redirect('admin/semua_tulisan?m=post&sm=semua_tulisan');
			}
		}
		$get = $this->input->get('aksi');
		if($get=="delete"){
			$idpost = $this->uri->segment(3);
			$this->m_admin->delete_dataTable('id_post='.$idpost.'','tbl_post');
			$this->setmessage('Berhasil menghapus tulisan','success');

			redirect('admin/semua_tulisan?m=post&sm=semua_tulisan');
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
		}elseif($label=='info'){
			$alert = 'info';
			$txt = '<h4><i class="fa fa-info-circle"></i> PESAN SYSTEM!</h4>';
		}else{
			$alert = 'danger';
			$txt = '<h4><i class="fa fa-ban"></i> PROSES GAGAL!</h4>';
		}
		$this->session->set_flashdata('notif','<div class="alert alert-'.$alert.' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> '.$txt.$message.'</div>');
	}


}
