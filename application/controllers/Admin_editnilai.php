<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_editnilai extends CI_Controller {

	/*
	| -----------------------------------------------------------------------
	| SINO 2018 - COPYRIGHTS - WATULINTANG.COM
	| DAFTAR PROGRAM PADA CLASS Admin
	| -----------------------------------------------------------------------
	*/

	function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('m_admin');
		$this->load->library('pagination');
		/*
		|-----------------------------------------------------
		|Periksa Session Login
		|------------------------------------------------------
		*/

		if($this->session->userdata('status') != "admin"){
			redirect('login');
		}

	}
	/*
	| -----------------------------------------------------------------------------------------------
	| Edit Nilai Pengetahuan dan Ketrampilan
	| -----------------------------------------------------------------------------------------------
	*/
	public function edit_nilai_peng_ketr()
	{
		$data['mapel'] = $this->m_admin->select_table_orderby('nama_pelajaran ASC','setup_pelajaran');
		$data['kelas'] = $this->m_admin->select_table_orderby('nama_kelas ASC','setup_kelas');
		$data['semester'] = $this->m_admin->select_table_orderby('semester ASC','setup_semester');
		$data['tahun'] = $this->m_admin->select_table_orderby('tahun ASC','setup_tahun');

		$post = $this->input->post();
		if(isset($post['submit']))
		{
			$setup_tahun = $this->m_admin->select_dataWhere('id_tahun='.$post['id_tahun'].'','setup_tahun')->row();
			$setup_semester = $this->m_admin->select_dataWhere('id_semester='.$post['id_semester'].'','setup_semester')->row();
			$id_pelajaran = $post['id_pelajaran'];
			$id_kelas = $post['id_kelas'];
			$id_semester = $post['id_semester'];
			$id_tahun = $post['id_tahun'];

			$where_pk1 = array(
				'id_pelajaran' => $id_pelajaran,
				'id_kelas' => $id_kelas,
				'semester' => $id_semester,
				'id_tahun' => $id_tahun
			);
			$nilai_pk = $this->m_admin->select_dataWhere($where_pk1,'tbl_nilai');
			//menyimpannya di session;
			$datases = array(
				'ses_edt_idpel' => $id_pelajaran,
				'ses_edt_idkel' => $id_kelas,
				'ses_edt_idsms' => $id_semester,
				'ses_edt_idthn' => $id_tahun
			);
			$this->session->set_userdata($datases);

			$where_pk = array(
				'nilai.id_pelajaran' => $id_pelajaran,
				'nilai.id_kelas' => $id_kelas,
				'nilai.semester' => $id_semester,
				'nilai.id_tahun' => $id_tahun
			);
		}
		else
		{
			//:Set default semester,tahun,dan kelas
			$setup_tahun = $this->m_admin->select_dataWhere('status_aktif=1','setup_tahun')->row();
			$setup_semester = $this->m_admin->select_dataWhere('status_semester=1','setup_semester')->row();
			$id_pelajaran = $data['mapel']->row('id_pelajaran');
			$id_kelas = $data['kelas']->row('id_kelas');
			$id_semester = $setup_semester->id_semester;
			$id_tahun = $setup_tahun->id_tahun;

			$where_pk1 = array(
				'id_pelajaran' => $id_pelajaran,
				'id_kelas' => $id_kelas,
				'semester' => $id_semester,
				'id_tahun' => $id_tahun
			);
			$nilai_pk = $this->m_admin->select_dataWhere($where_pk1,'tbl_nilai');

			$where_pk = array(
				'nilai.id_pelajaran' => $id_pelajaran,
				'nilai.id_kelas' => $id_kelas,
				'nilai.semester' => $id_semester,
				'nilai.id_tahun' => $id_tahun
			);
		}

		//-------------------------------------------------
		$id_admin = $this->session->userdata('id');
		$where = array('id_admin' => $id_admin);
		$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');
		$data['getmapel'] = $this->m_admin->select_dataWhere('id_pelajaran='.$id_pelajaran.'','setup_pelajaran');
		$data['getkelas'] = $this->m_admin->select_dataWhere('id_kelas='.$id_kelas.'','setup_kelas');
				
		$cek = $nilai_pk->num_rows();

		if($cek>0) //:tampilkan mode update jk data tidak kosong...
		{
			$data['page_title'] = '<h1>Update Nilai '.$setup_tahun->tahun.' Semester '.ucwords($setup_semester->semester).'</h1>';
			$data['mode_form'] = "update";
			$data['nilai_pk'] = $this->m_admin->get_nilai_pk($where_pk);
		}
		else //: Menampilkan mode input...
		{
			$data['page_title'] = '<h1>Input Nilai '.$setup_tahun->tahun.' Semester '.ucwords($setup_semester->semester).'</h1>';
			$data['mode_form'] = "input";
			$data['id_tahun'] = $id_tahun;
			$data['id_semester'] = $id_semester;
			$data['nilai_pk'] = $this->m_admin->get_siswa_pk($id_kelas,$id_tahun);
			$where = array(
				'jadwal.id_pelajaran' => $id_pelajaran,
				'jadwal.id_kelas' => $id_kelas,
				'jadwal.id_tahun' => $id_tahun,
				'jadwal.id_semester' => $id_semester
			);

			$data['guru'] = $this->m_admin->get_guru_sesuai($where);
			//$data['guru'] = $this->m_admin->select_table_orderby('nama_guru ASC','data_guru');
		}

		$data['content'] = "admin/v_edit_nilai_peng-ketr";
		
		$this->load->view('admin/index',$data);
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
			   
			   $input[$key]['id_tahun'] = trim($post['id_tahun']);
			   $input[$key]['semester'] = trim($post['id_semester']);
			}

			$this->m_admin->insert_batch('tbl_nilai',$input);
			$this->setmessage('Nilai berhasil disimpan!','success');
			redirect('admin_editnilai/edit_nilai_peng_ketr?m=data_induk&sm=guru');
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

			$this->m_admin->update_batch('tbl_nilai',$update,'id_nilai');

			$this->setmessage('Nilai berhasil diperbarui!','success');
			redirect('admin_editnilai/edit_nilai_peng_ketr?m=data_induk&sm=guru');
		}
	}

	/*
	| -----------------------------------------------------------------------------------------------
	| Edit Deskripsi Nilai
	| -----------------------------------------------------------------------------------------------
	*/
	public function edit_deskripsi_nilai()
	{
		$id_admin = $this->session->userdata('id');
		$where = array('id_admin' => $id_admin);
		$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');
		$data['mapel'] = $this->m_admin->select_table_orderby('nama_pelajaran ASC','setup_pelajaran');
		$data['kelas'] = $this->m_admin->select_table_orderby('nama_kelas ASC','setup_kelas');
		$data['semester'] = $this->m_admin->select_table_orderby('semester ASC','setup_semester');
		$data['tahun'] = $this->m_admin->select_table_orderby('tahun ASC','setup_tahun');
		$data['page_title'] = '<h1>Edit Deskripsi Nilai</h1>';
					
		
		$data['content'] = "admin/v_edit_deskripsi_nilai";
		
		$this->load->view('admin/index',$data);
	}

	public function form_edit_deskripsi()
	{
		$id_admin = $this->session->userdata('id');
		$where = array('id_admin' => $id_admin);
		$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');

		$post = $this->input->post();
		
			$setup_tahun = $this->m_admin->select_dataWhere('id_tahun='.$post['id_tahun'].'','setup_tahun')->row();
			$setup_semester = $this->m_admin->select_dataWhere('id_semester='.$post['id_semester'].'','setup_semester')->row();
			$id_pelajaran = $post['id_pelajaran'];
			$id_kelas = $post['id_kelas'];
			$id_semester = $post['id_semester'];
			$id_tahun = $post['id_tahun'];

			$where_desk1 = array(
				'id_pelajaran' => $id_pelajaran,
				'id_kelas' => $id_kelas,
				'semester' => $id_semester,
				'id_tahun' => $id_tahun
			);
			$deskripsi_nilai = $this->m_admin->select_dataWhere($where_desk1,'tbl_nilai');
			//menyimpannya di session;
			$datases = array(
				'ses_edt_idpel' => $id_pelajaran,
				'ses_edt_idkel' => $id_kelas,
				'ses_edt_idsms' => $id_semester,
				'ses_edt_idthn' => $id_tahun
			);
			$this->session->set_userdata($datases);

			$where_desk = array(
				'nilai.id_pelajaran' => $id_pelajaran,
				'nilai.id_kelas' => $id_kelas,
				'nilai.semester' => $id_semester,
				'nilai.id_tahun' => $id_tahun
			);

			$cek = $deskripsi_nilai->num_rows();

		if($cek>0) //:tampilkan mode update jk data tidak kosong...
		{
			$data['page_title'] = '<h1>Update Deskripsi Nilai '.$setup_tahun->tahun.' Semester '.ucwords($setup_semester->semester).'</h1>';
			$data['mode_form'] = "update";
			$data['id_semester'] = $id_semester;
			$data['id_tahun'] = $id_tahun;
			
			$data['nilai_deskripsi'] = $this->m_admin->list_deskripsi_nilai($where_desk);
			$data['nama_kelas'] = $this->m_admin->select_dataWhere('id_kelas='.$id_kelas.'','setup_kelas')->row('nama_kelas');
			$data['pelajaran'] = $this->m_admin->select_dataWhere('id_pelajaran='.$id_pelajaran.'','setup_pelajaran');
		}
		else //: Menampilkan pesan jika data kosong...
		{
			$this->setmessage('Maaf, input deskripsi nilai tidak dapat dilakukan, karena data nilai masih kosong. Silahkan isi data nilai terlebih dahulu!');
			redirect('admin_editnilai/edit_deskripsi_nilai?m=edit_nilai&sm=deskripsi_nilai');
		}

		$data['content'] = "admin/v_form_deskripsi_nilai";
		$this->load->view('admin/index',$data);
		
		
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
					'semester' => trim($post['id_semester']),
					'id_tahun' => trim($post['id_tahun']),
				);

				$this->m_admin->replace_data('tbl_deskripsi_nilai',$data);
			}
			
			$this->setmessage('Deskripsi nilai berhasil disimpan!','success');
			redirect('admin_editnilai/edit_deskripsi_nilai?m=edit_nilai&sm=deskripsi_nilai');
	}

	/*
	| -----------------------------------------------------------------------------------------------
	| Edit Nilai Sikap
	| -----------------------------------------------------------------------------------------------
	*/
	public function edit_sikap()
	{
		$id_admin = $this->session->userdata('id');
		$where = array('id_admin' => $id_admin);
		$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');
		$data['mapel'] = $this->m_admin->select_table_orderby('nama_pelajaran ASC','setup_pelajaran');
		$data['kelas'] = $this->m_admin->select_table_orderby('nama_kelas ASC','setup_kelas');
		$data['semester'] = $this->m_admin->select_table_orderby('semester ASC','setup_semester');
		$data['tahun'] = $this->m_admin->select_table_orderby('tahun ASC','setup_tahun');
		$data['page_title'] = '<h1>Edit Nilai Sikap</h1>';
					
		
		$data['content'] = "admin/v_edit_sikap";
		
		$this->load->view('admin/index',$data);
	}

	public function form_edit_sikap()
	{
		$id_admin = $this->session->userdata('id');
		$where = array('id_admin' => $id_admin);
		$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');

		$post = $this->input->post();
		
			$setup_tahun = $this->m_admin->select_dataWhere('id_tahun='.$post['id_tahun'].'','setup_tahun')->row();
			$setup_semester = $this->m_admin->select_dataWhere('id_semester='.$post['id_semester'].'','setup_semester')->row();
			$id_kelas = $post['id_kelas'];
			$id_semester = $post['id_semester'];
			$id_tahun = $post['id_tahun'];

			$where_sikap1 = array(
				'id_kelas' => $id_kelas,
				'id_semester' => $id_semester,
				'id_tahun' => $id_tahun
			);
			$nilai_sikap = $this->m_admin->select_dataWhere($where_sikap1,'tbl_nilai_sikap');
			//menyimpannya di session;
			$datases = array(
				'ses_edt_idkel' => $id_kelas,
				'ses_edt_idsms' => $id_semester,
				'ses_edt_idthn' => $id_tahun
			);
			$this->session->set_userdata($datases);
			
			$cek = $nilai_sikap->num_rows();

		if($cek>0) //:tampilkan mode update jk data tidak kosong...
		{
			$data['page_title'] = '<h1>Update Nilai Sikap '.$setup_tahun->tahun.' Semester '.ucwords($setup_semester->semester).'</h1>';
			$data['mode_form'] = "update";
			$data['id_semester'] = $id_semester;
			$data['id_tahun'] = $id_tahun;
			$data['id_kelas'] = $id_kelas;
			
			$data['nilai_sikap'] = $this->m_admin->list_nilai_sikap($id_kelas,$id_tahun,$id_semester);
			$data['nama_kelas'] = $this->m_admin->select_dataWhere('id_kelas='.$id_kelas.'','setup_kelas')->row('nama_kelas');
			$data['jumSis'] = $data['nilai_sikap']->num_rows();
		}
		else //: mode Input
		{
			$data['page_title'] = '<h1>Input Nilai Sikap '.$setup_tahun->tahun.' Semester '.ucwords($setup_semester->semester).'</h1>';
			$data['mode_form'] = "input";
			$data['id_semester'] = $id_semester;
			$data['id_tahun'] = $id_tahun;
			$data['id_kelas'] = $id_kelas;
			$data['wali'] = $this->m_admin->get_wali_sesuai($id_tahun,$id_kelas);
			
			$data['nilai_sikap'] = $this->m_admin->list_siswa_sikap($id_kelas,$id_tahun);
			$data['nama_kelas'] = $this->m_admin->select_dataWhere('id_kelas='.$id_kelas.'','setup_kelas')->row('nama_kelas');
			$data['jumSis'] = $data['nilai_sikap']->num_rows();
		}

		$data['content'] = "admin/v_form_edit_sikap";
		$this->load->view('admin/index',$data);
		
		
	}

	public function proses_input_sikap()
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

			$this->m_admin->insert_batch('tbl_nilai_sikap',$data);
			$this->setmessage('Data nilai sikap berhasil disimpan!','success');
			redirect('admin_editnilai/edit_sikap?m=edit_nilai&sm=nilai_sikap');
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

				$this->m_admin->update_dataTable($where,$data,'tbl_nilai_sikap');
			}

			$this->setmessage('Nilai Sikap berhasil diperbarui!','success');
			redirect('admin_editnilai/edit_sikap?m=edit_nilai&sm=nilai_sikap');
		}
	}

	public function edit_ekstrakurikuler()
	{
		$id_admin = $this->session->userdata('id');
		$where = array('id_admin' => $id_admin);
		$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');
		$data['mapel'] = $this->m_admin->select_table_orderby('nama_pelajaran ASC','setup_pelajaran');
		$data['kelas'] = $this->m_admin->select_table_orderby('nama_kelas ASC','setup_kelas');
		$data['semester'] = $this->m_admin->select_table_orderby('semester ASC','setup_semester');
		$data['tahun'] = $this->m_admin->select_table_orderby('tahun ASC','setup_tahun');
		$data['page_title'] = '<h1>Edit Nilai Ekstra Kurikuler<small>Sort nilai berdasarkan kelas, semester dan tahun ajaran</small></h1>';
					
		
		$data['content'] = "admin/v_edit_ekstra";
		
		$this->load->view('admin/index',$data);
	}


	public function form_edit_ekstrakurikuler()
	{
		//*Head*
		//get data post
		//menyimpan data post ke session;
		$post = $this->input->post();
		if(isset($post['submit']))
		{
			$idkelas = $post['id_kelas'];
			$idsemester = $post['id_semester'];
			$idtahun = $post['id_tahun'];

		$datases = array(
			'ses_eks_idkelas' => $idkelas,
			'ses_eks_idsms' => $idsemester,
			'ses_eks_idthn' => $idtahun
		);

		$this->session->set_userdata($datases);
		}
		else
		{
			//cek_session;
			$sesidkls = $this->session->userdata('ses_eks_idkelas');
			$sesidsms = $this->session->userdata('ses_eks_idsms');
			$sesidthn = $this->session->userdata('ses_eks_idthn');
			if($sesidkls!=''&&$sesidsms!=''&&$sesidthn!='')
			{
				$idkelas = $sesidkls;
				$idsemester = $sesidsms;
				$idtahun = $sesidthn;
			}
			else
			{
				redirect('admin_editnilai/edit_ekstrakurikuler?m=edit_nilai&sm=nilai_ekstra');
			}
		}
		//ooo
		$setup_tahun = $this->m_admin->select_dataWhere('id_tahun='.$idtahun.'','setup_tahun')->row();
		$setup_semester = $this->m_admin->select_dataWhere('id_semester='.$idsemester.'','setup_semester')->row();

		$data['viewtahun'] = $setup_tahun->tahun;
		$data['idtahun'] = $setup_tahun->id_tahun;
		$data['viewsemester'] = ucwords($setup_semester->semester);
		$data['idsemester'] = $setup_semester->id_semester;
		$data['kelas'] = $this->m_admin->select_dataWhere('id_kelas='.$idkelas.'','setup_kelas');
		$nama_kelas = $data['kelas']->row('nama_kelas');

		$id_admin = $this->session->userdata('id');
		$where = array('id_admin' => $id_admin);
		$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');
		$data['page_title'] = '<h1>Nilai Ekstra Kurikuler '.$nama_kelas.' - '.$setup_tahun->tahun.' Semester '.$data['viewsemester'].'</h1>';
		

		//refensi from db
		$data['kegiatan_ekstra'] = $this->m_admin->select_table_orderby('nama_ekstra ASC','ekstrakurikuler');
		$data['siswadikelas'] = $this->m_admin->data_siswa_dikelas($idkelas,$idtahun);
		$data['wali_kelas'] = $this->m_admin->get_wali_sesuai($idkelas,$idtahun);
		
		$data['nilai_ekstra'] = $this->m_admin->get_nilai_ekstra($idkelas,$idtahun,$idsemester);
			
		$data['content'] = "admin/v_siswa_nilai_ekstra";
		
		$this->load->view('admin/index',$data);
	}

	public function edit_nilai_ekstra()
	{
		//*GetURI*/
		$get = $this->input->get();
		if($get['set']=='update'){
		
			$nis = $this->uri->segment(3);
			$idkelas = $this->uri->segment(4);
			$geturi5 = explode("-", $this->uri->segment(5));
				$idwali = $geturi5['0'];
				$idsemester = $geturi5['1'];
				$idtahun = $geturi5['2'];
		}

		//tahun ajaran
		$setup_tahun = $this->m_admin->select_dataWhere('id_tahun='.$idtahun.'','setup_tahun')->row();
		//semester 
		$setup_semester = $this->m_admin->select_dataWhere('id_semester='.$idsemester.'','setup_semester')->row();

		$data['thn_aktif'] = $setup_tahun->tahun;
		$data['idtahun'] = $setup_tahun->id_tahun;
		$data['semester_aktif'] = ucwords($setup_semester->semester);
		$data['idsemester'] = $setup_semester->id_semester;

		$id_admin = $this->session->userdata('id');
		$where = array('id_admin' => $id_admin);
		$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');

		//refensi from db
		$data['kegiatan_ekstra'] = $this->m_admin->select_table_orderby('nama_ekstra ASC','ekstrakurikuler');

		$where = "siswa.nis=$nis AND ekstra.id_kelas=$idkelas AND ekstra.id_wali=$idwali AND ekstra.id_semester=$idsemester AND ekstra.id_tahun=$idtahun";
		$data['nilai_ekstra'] = $this->m_admin->lihat_nilai_ekstra($where);
		$data['page_title'] = '<h1>Nilai Ekstra Kurikuler '.$setup_tahun->tahun.' Semester '.$data['semester_aktif'].'</h1>';
		$data['type_form'] = "update";
		$data['content'] = "admin/v_form_in_nilai_ekstra";
	
		$this->load->view('admin/index',$data);
	}

	public function simpan_nilai_ekstra()
	{
		$post = $this->input->post();

		if(isset($post['insert']))
		{
			$data = array(
				'nis' => trim($post['nis']),
				'id_kelas' => trim($post['idkelas']),
				'id_wali' => trim($post['id_wali']),
				'id_semester' => trim($post['idsemester']),
				'id_tahun' => trim($post['idtahun']),
				'id_ekstra' => trim($post['ekstra']),
				'nilai' => trim(strip_tags($post['nilai'])),
				'deskripsi' => trim(strip_tags($post['deskripsi']))
			);
			if($post['nilai']!='' && $post['deskripsi']!='')
			{
				$this->m_admin->insert_dataTo($data,'tbl_nilai_ekstra');
			}
			else
			{
				$this->setmessage('Ups! Gagal menambahkan nilai ekstra kurikuler. Form isian tidak boleh kosong. Periksa lagi!','danger');
			redirect('admin_editnilai/form_edit_ekstrakurikuler?m=edit_nilai&sm=nilai_ekstra');
			}

			$this->setmessage('Data nilai ekstra berhasil disimpan!','success');
			redirect('admin_editnilai/form_edit_ekstrakurikuler?m=edit_nilai&sm=nilai_ekstra');
			  
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
				   	$this->m_admin->update_dataTable($where,$data,'tbl_nilai_ekstra');
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
					   	$this->m_admin->insert_dataTo($data,'tbl_nilai_ekstra');
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
		$this->m_admin->delete_dataTable('id_ekst='.$id_ekst.'','tbl_nilai_ekstra');
		$back_url = $this->input->get('back');
		$get2 = $this->input->get('m');
		$get3 = $this->input->get('sm');
		$get = "&m=$get2&sm=$get3";

		$this->setmessage('Data berhasil dihapus!','success');
		redirect($back_url.$get);
	}

	//--------------
	// PRESTASI
	//-------------

	public function edit_prestasi()
	{
		$id_admin = $this->session->userdata('id');
		$where = array('id_admin' => $id_admin);
		$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');
		$data['mapel'] = $this->m_admin->select_table_orderby('nama_pelajaran ASC','setup_pelajaran');
		$data['kelas'] = $this->m_admin->select_table_orderby('nama_kelas ASC','setup_kelas');
		$data['semester'] = $this->m_admin->select_table_orderby('semester ASC','setup_semester');
		$data['tahun'] = $this->m_admin->select_table_orderby('tahun ASC','setup_tahun');
		$data['page_title'] = '<h1>Edit Prestasi Siswa<small>Sort berdasarkan kelas, semester dan tahun ajaran</small></h1>';
					
		
		$data['content'] = "admin/v_edit_prestasi";
		
		$this->load->view('admin/index',$data);
	}

public function form_edit_prestasi()
	{
		$post = $this->input->post();
		if(isset($post['submit']))
		{
			$idkelas = $post['id_kelas'];
			$idsemester = $post['id_semester'];
			$idtahun = $post['id_tahun'];

		$datases = array(
			'ses_pres_idkelas' => $idkelas,
			'ses_pres_idsms' => $idsemester,
			'ses_pres_idthn' => $idtahun
		);

		$this->session->set_userdata($datases);
		}
		else
		{
			//cek_session;
			$sesidkls = $this->session->userdata('ses_pres_idkelas');
			$sesidsms = $this->session->userdata('ses_pres_idsms');
			$sesidthn = $this->session->userdata('ses_pres_idthn');
			if($sesidkls!=''&&$sesidsms!=''&&$sesidthn!='')
			{
				$idkelas = $sesidkls;
				$idsemester = $sesidsms;
				$idtahun = $sesidthn;
			}
			else
			{
				redirect('admin_editnilai/edit_prestasi?m=edit_nilai&sm=prestasi');
			}
		}
		$setup_tahun = $this->m_admin->select_dataWhere('id_tahun='.$idtahun.'','setup_tahun')->row();
		$setup_semester = $this->m_admin->select_dataWhere('id_semester='.$idsemester.'','setup_semester')->row();

		$data['thn_aktif'] = $setup_tahun->tahun;
		$data['idtahun'] = $setup_tahun->id_tahun;
		$data['semester_aktif'] = ucwords($setup_semester->semester);
		$data['idsemester'] = $setup_semester->id_semester;
		$data['kelas'] = $this->m_admin->select_dataWhere('id_kelas='.$idkelas.'','setup_kelas');
		$nama_kelas = $data['kelas']->row('nama_kelas');
		

		$id_admin = $this->session->userdata('id');
		$where = array('id_admin' => $id_admin);
		$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');
		$data['page_title'] = '<h1>Input Prestasi Siswa '.$setup_tahun->tahun.' Semester '.$data['semester_aktif'].'</h1>';
		//$data['input_type'] = "deskripsi";

		//*Body*
		
		//refensi from db
		$data['siswadikelas'] = $this->m_admin->data_siswa_dikelas($idkelas,$idtahun);
		$data['wali_kelas'] = $this->m_admin->get_wali_sesuai($idkelas,$idtahun);
	
		$data['prestasi_siswa'] = $this->m_admin->get_prestasi_siswa($idkelas,$idtahun,$idsemester);
		
		$data['content'] = "admin/v_prestasi_list_siswa";
		
		$this->load->view('admin/index',$data);
	}

	function set_prestasi_siswa()
	{
		$this->form_validation->set_rules('jenis','Jenis Kegiatan','required');
		$this->form_validation->set_rules('ket','Keterangan','required');

		$post = $this->input->post();

		if($this->form_validation->run()==FALSE){
			$this->setmessage(validation_errors(),'warning');
			redirect('admin_editnilai/form_edit_prestasi?m=edit_nilai&sm=prestasi');
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

			$this->m_admin->insert_dataTo($data,'tbl_prestasi_siswa');
			$this->setmessage('Prestasi siswa berhasil disimpan!','success');
			redirect('admin_editnilai/form_edit_prestasi?m=edit_nilai&sm=prestasi');
		}
		
	}

	public function edit_prestasi_siswa()
	{
		//*GetURI*/
		$get = $this->input->get();
		if($get['set']=='update'){
		
			$nis = $this->uri->segment(3);
			$idkelas = $this->uri->segment(4);
			$geturi5 = explode("-", $this->uri->segment(5));
				$idwali = $geturi5['0'];
				$idsemester = $geturi5['1'];
				$idtahun = $geturi5['2'];
		}

		//tahun ajaran
		$setup_tahun = $this->m_admin->select_dataWhere('id_tahun='.$idtahun.'','setup_tahun')->row();
		//semester 
		$setup_semester = $this->m_admin->select_dataWhere('id_semester='.$idsemester.'','setup_semester')->row();

		$data['thn_aktif'] = $setup_tahun->tahun;
		$data['idtahun'] = $setup_tahun->id_tahun;
		$data['semester_aktif'] = ucwords($setup_semester->semester);
		$data['idsemester'] = $setup_semester->id_semester;

		$id_admin = $this->session->userdata('id');
		$where = array('id_admin' => $id_admin);
		$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');
						
		$where = "prestasi.nis=$nis AND prestasi.id_kelas=$idkelas AND prestasi.id_wali=$idwali AND prestasi.id_semester=$idsemester AND prestasi.id_tahun=$idtahun";
		$data['prestasi_siswa'] = $this->m_admin->lihat_prestasi_persiswa($where);
		$data['page_title'] = '<h1>Update Prestasi Siswa '.$setup_tahun->tahun.' Semester '.$data['semester_aktif'].'</h1>';
		$data['type_form'] = "update";
		$data['content'] = "admin/v_form_input_prestasi";
		
			

		$this->load->view('admin/index',$data);
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
			   	$this->m_admin->insert_dataTo($data,'tbl_prestasi_siswa');
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
				   	$this->m_admin->update_dataTable($where,$data,'tbl_prestasi_siswa');
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
					   	$this->m_admin->insert_dataTo($data,'tbl_prestasi_siswa');
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
		$this->m_admin->delete_dataTable('id_prestasi='.$idp.'','tbl_prestasi_siswa');
		$back_url = $this->input->get('back');
		$get2 = $this->input->get('m');
		$get3 = $this->input->get('sm');
		$get = "&m=$get2&sm=$get3";

		$this->setmessage('Data berhasil dihapus!','success');
		redirect($back_url.$get);
	}

	//----------
	// KEHADIRAN
	//-------------
	public function edit_data_kehadiran()
		{
			$id_admin = $this->session->userdata('id');
			$where = array('id_admin' => $id_admin);
			$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');
			$data['mapel'] = $this->m_admin->select_table_orderby('nama_pelajaran ASC','setup_pelajaran');
			$data['kelas'] = $this->m_admin->select_table_orderby('nama_kelas ASC','setup_kelas');
			$data['semester'] = $this->m_admin->select_table_orderby('semester ASC','setup_semester');
			$data['tahun'] = $this->m_admin->select_table_orderby('tahun ASC','setup_tahun');
			$data['page_title'] = '<h1>Edit Kehadiran Siswa<small>Sort berdasarkan kelas, semester dan tahun ajaran</small></h1>';
						
			
			$data['content'] = "admin/v_edit_kehadiran";
			
			$this->load->view('admin/index',$data);
		}

	public function form_kehadiran()
	{
		$post = $this->input->post();
		if(isset($post['submit']))
		{
			$idkelas = $post['id_kelas'];
			$idsemester = $post['id_semester'];
			$idtahun = $post['id_tahun'];

		$datases = array(
			'ses_hdr_idkelas' => $idkelas,
			'ses_hdr_idsms' => $idsemester,
			'ses_hdr_idthn' => $idtahun
		);

		$this->session->set_userdata($datases);
		}
		else
		{
			//cek_session;
			$sesidkls = $this->session->userdata('ses_hdr_idkelas');
			$sesidsms = $this->session->userdata('ses_hdr_idsms');
			$sesidthn = $this->session->userdata('ses_hdr_idthn');
			if($sesidkls!=''&&$sesidsms!=''&&$sesidthn!='')
			{
				$idkelas = $sesidkls;
				$idsemester = $sesidsms;
				$idtahun = $sesidthn;
			}
			else
			{
				redirect('admin_editnilai/edit_data_kehadiran?m=edit_nilai&sm=data_kehadiran');
			}
		}
		$setup_tahun = $this->m_admin->select_dataWhere('id_tahun='.$idtahun.'','setup_tahun')->row();
		$setup_semester = $this->m_admin->select_dataWhere('id_semester='.$idsemester.'','setup_semester')->row();


		$data['thn_aktif'] = $setup_tahun->tahun;
		$data['idtahun'] = $setup_tahun->id_tahun;
		$data['semester_aktif'] = ucwords($setup_semester->semester);
		$data['idsemester'] = $setup_semester->id_semester;

		$id_admin = $this->session->userdata('id');
		$where = array('id_admin' => $id_admin);
		$data['user'] = $this->m_admin->select_dataWhere($where,'user_admin');
			
		$data['kelas'] = $this->m_admin->select_dataWhere('id_kelas='.$idkelas.'','setup_kelas');
		$data['id_kelas'] = $idkelas;
		//*Body*

		//CEK DATA
		$data_kehadiran = $this->m_admin->get_data_bkhadir($idkelas,$idtahun,$idsemester);
		$cekdata = $data_kehadiran->num_rows();
		
		if($cekdata==0){
			$data['page_title'] = '<h1>Input Kehadiran Siswa '.$setup_tahun->tahun.' Semester '.$data['semester_aktif'].'</h1>';

			$data['data_kehadiran'] = $this->m_admin->get_siswa_bkhadir($idkelas,$idtahun);
			$data['jumSis'] = $data['data_kehadiran']->num_rows();
			$data['content'] = "guru/v_form_kehadiran";
		}elseif($cekdata>0)
		{
			$data['page_title'] = '<h1>Update Kehadiran Siswa '.$setup_tahun->tahun.' Semester '.$data['semester_aktif'].'</h1>';
			$data['data_kehadiran'] = $data_kehadiran;
			$data['jumSis'] = $data['data_kehadiran']->num_rows();
			$data['content'] = "guru/v_form_up_kehadiran";
		}
		$this->load->view('admin/index',$data);
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

			$this->m_admin->insert_batch('tbl_kehadiran',$data);
			$this->setmessage('Data Kehadiran berhasil disimpan!','success');
			redirect('admin_editnilai/form_kehadiran?m=edit_nilai&sm=data_kehadiran');
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
				$this->m_admin->update_dataTable($where,$data,'tbl_kehadiran');
			}

			$this->setmessage('Data Kehadiran berhasil diperbarui!','success');
			redirect('admin_editnilai/form_kehadiran?m=edit_nilai&sm=data_kehadiran');
		}
	}



	//------------

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