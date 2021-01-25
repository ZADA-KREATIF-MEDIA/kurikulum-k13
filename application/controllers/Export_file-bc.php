<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Export_file extends CI_Controller {

	/*
	| -----------------------------------------------------------------------
	| SINO 2018 - COPYRIGHTS - WATULINTANG.COM
	| -----------------------------------------------------------------------
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


public function down_templateup_nilai()
	{
		//referensi::
		$setup_tahun = $this->m_guru->get_ref_thn_aktif()->row();
		//get_data::
		$id_guru = $this->session->userdata('id');
		$id_kelas = $this->uri->segment(3);
		$id_pelajaran = $this->uri->segment(4);
		//$id_kategori = trim($this->input->post('id_kategori'));
		$semester = $this->uri->segment(5);
		//data::
		//$data['guru'] = $this->m_guru->select_dataWhere('id_guru='.$id_guru.'', 'data_guru');
		//$data['kelas'] = $this->m_guru->select_dataWhere('id_kelas='.$id_kelas.'', 'setup_kelas');
		//$data['pelajaran'] = $this->m_guru->select_dataWhere('id_pelajaran='.$id_pelajaran.'', 'setup_pelajaran');
		//$nama_pelajaran = $data['pelajaran']->row('nama_pelajaran');
		//$data['kategori'] = $this->m_guru->select_dataWhere('id_kategori='.$id_kategori.'', 'tbl_kategori_nilai');
		//$data['tahun'] = $setup_tahun->id_tahun;
		//$data['semester'] = $this->m_guru->select_dataWhere('id_semester='.$semester.'', 'setup_semester');
		//$data['pd_tahun'] = $setup_tahun->tahun;

		$where = array(
				'id_guru' => $id_guru,
				'id_kelas' => $id_kelas,
				'id_pelajaran' => $id_pelajaran,
				//'id_kategori' => $id_kategori,
				'id_tahun' => $setup_tahun->id_tahun,
				'semester' => $semester
			);

		$data['tbl_nilai'] = $this->m_guru->select_dataWhere($where,'tbl_nilai');
		$ceknilai = $data['tbl_nilai']->num_rows();

		//end referensi::


		// Panggil class PHPExcel nya
		$excel = new PHPExcel();

		// Settingan awal file excel
		$excel->getProperties()->setCreator('Author')
		             ->setLastModifiedBy('Author')
		             ->setTitle("Data Nilai Siswa")
		             ->setSubject("Siswa")
		             ->setDescription("Lembar Import Data Nilai Siswa")
		             ->setKeywords("Nilai Siswa");

		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = array(
		  'font' => array('bold' => true), // Set font nya jadi bold
		  'alignment' => array(
		    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
		    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		  ),
		  'borders' => array(
		    'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
		    'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
		    'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
		    'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		  )
		);

		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = array(
		  'alignment' => array(
		    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		  ),
		  'borders' => array(
		    'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
		    'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
		    'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
		    'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		  )
		);

		if($ceknilai>0){

		$excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA NILAI SISWA"); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A1:J1'); // Set Merge Cell pada kolom A1 sampai F1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

		// Buat header tabel nya pada baris ke 3
		$excel->setActiveSheetIndex(0)->setCellValue('A3', "NO");
		$excel->setActiveSheetIndex(0)->setCellValue('B3', "ID NILAI");
		$excel->setActiveSheetIndex(0)->setCellValue('C3', "NIS");
		//$excel->setActiveSheetIndex(0)->setCellValue('D3', "ID PELAJARAN");
		//$excel->setActiveSheetIndex(0)->setCellValue('E3', "ID KELAS");
		//$excel->setActiveSheetIndex(0)->setCellValue('F3', "ID GURU");
		$excel->setActiveSheetIndex(0)->setCellValue('D3', "NILAI PENGETAHUAN");
		$excel->setActiveSheetIndex(0)->setCellValue('E3', "NILAI KETRAMPILAN");
		//$excel->setActiveSheetIndex(0)->setCellValue('I3', "ID TAHUN");
		//$excel->setActiveSheetIndex(0)->setCellValue('J3', "ID SEMESTER");

		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
		//$excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
		//$excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
		//$excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
		//$excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
		//$excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);

		// Set height baris ke 1, 2 dan 3
		$excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
		$excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
		$excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);

		// Buat query untuk menampilkan semua data siswa
		$sql = $this->m_guru->list_nilai_siswa($id_guru,$id_kelas,$id_pelajaran,$setup_tahun->id_tahun,$semester);
		$numRows = $sql->num_rows()+3;
		//$sql->execute(); // Eksekusi querynya

		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach($sql->result_array() as $data){ // Ambil semua data dari hasil eksekusi $sql
		  $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
		  $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data['id_nilai']);
		  $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data['nis']);
		  //$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data['id_pelajaran']);
		  //$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data['id_kelas']);
		  //$excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data['id_guru']);
		  $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data['nilai_pengetahuan']);
		  $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data['nilai_ketrampilan']);
		  //$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data['id_tahun']);
		  //$excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $data['semester']);
		  
		  // Khusus untuk no telepon. kita set type kolom nya jadi STRING
		  //$excel->setActiveSheetIndex(0)->setCellValueExplicit('E'.$numrow, $data['telp'], PHPExcel_Cell_DataType::TYPE_STRING);

		  // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
		  $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);
		  
		  $excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);
		  
		  $no++; // Tambah 1 setiap kali looping
		  $numrow++; // Tambah 1 setiap kali looping
		}


		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(15); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(15); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(15); // Set width kolom E
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(15); // Set width kolom F
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(15); // Set width kolom F
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(15); // Set width kolom F
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(15); // Set width kolom F
		$excel->getActiveSheet()->getColumnDimension('J')->setWidth(15); // Set width kolom F

		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("Lembar Import Nilai Siswa");
		$excel->setActiveSheetIndex(0);
		
		$excel->getActiveSheet()->getProtection()->setPassword('4dm1n1');
		$excel->getActiveSheet()->getProtection()->setSheet(true);
		$excel->getActiveSheet()->getProtection()->setSort(true);
		$excel->getActiveSheet()->getProtection()->setInsertRows(true);
		$excel->getActiveSheet()->getProtection()->setFormatCells(true);
		$excel->getActiveSheet()->getStyle('G4:H'.$numRows.'')->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
	}else{
		//jalankan jika data siswa tidak ditemukan di tbl_nilai
		$excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA NILAI SISWA"); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A1:J1'); // Set Merge Cell pada kolom A1 sampai F1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

		// Buat header tabel nya pada baris ke 3
		$excel->setActiveSheetIndex(0)->setCellValue('A3', "NO");
		$excel->setActiveSheetIndex(0)->setCellValue('B3', "NIS");
		$excel->setActiveSheetIndex(0)->setCellValue('C3', "ID PELAJARAN");
		$excel->setActiveSheetIndex(0)->setCellValue('D3', "ID KELAS");
		$excel->setActiveSheetIndex(0)->setCellValue('E3', "ID GURU");
		$excel->setActiveSheetIndex(0)->setCellValue('F3', "NILAI PENGETAHUAN");
		$excel->setActiveSheetIndex(0)->setCellValue('G3', "NILAI KETRAMPILAN");
		$excel->setActiveSheetIndex(0)->setCellValue('H3', "ID TAHUN");
		$excel->setActiveSheetIndex(0)->setCellValue('I3', "ID SEMESTER");

		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);

		// Set height baris ke 1, 2 dan 3
		$excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
		$excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
		$excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);

		// Buat query untuk menampilkan semua data siswa
		$sql = $this->m_guru->list_siswa_dikelas($id_kelas,$setup_tahun->id_tahun,$semester);
		//$sql->execute(); // Eksekusi querynya
		$numRows = $sql->num_rows()+3;

		$nilai_pengetahuan = 0;
		$nilai_ketrampilan = 0;
		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach($sql->result_array() as $data){ // Ambil semua data dari hasil eksekusi $sql
		  $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
		  $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data['nis']);
		  $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $id_pelajaran);
		  $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $id_kelas);
		  $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $id_guru);
		  $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $nilai_pengetahuan);
		  $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $nilai_ketrampilan);
		  $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $setup_tahun->id_tahun);
		  $excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $semester);
		  
		  // Khusus untuk no telepon. kita set type kolom nya jadi STRING
		  //$excel->setActiveSheetIndex(0)->setCellValueExplicit('E'.$numrow, $data['telp'], PHPExcel_Cell_DataType::TYPE_STRING);

		  // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
		  $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
		  
		  $excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);
		  
		  $no++; // Tambah 1 setiap kali looping
		  $numrow++; // Tambah 1 setiap kali looping
		}

		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);

		// Set orientasi kertas jadi LANDSCAPE
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("Lembar Import Nilai Siswa");
		$excel->setActiveSheetIndex(0);
		
		$excel->getActiveSheet()->getProtection()->setPassword('4dm1n1');
		$excel->getActiveSheet()->getProtection()->setSheet(true);
		$excel->getActiveSheet()->getProtection()->setSort(true);
		$excel->getActiveSheet()->getProtection()->setInsertRows(true);
		$excel->getActiveSheet()->getProtection()->setFormatCells(true);
		$excel->getActiveSheet()->getStyle('F4:G'.$numRows.'')->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
	}

		

		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="template_import_nilai_siswa.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');

		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	}

	//eksport template deskripsi nilai::

	public function down_templateup_deskripsi()
	{
		//referensi::
		$setup_tahun = $this->m_guru->get_ref_thn_aktif()->row();
		//get_data::
		$id_guru = $this->session->userdata('id');
		$id_kelas = $this->uri->segment(3);
		$id_pelajaran = $this->uri->segment(4);
		//$id_kategori = trim($this->input->post('id_kategori'));
		$semester = $this->uri->segment(5);
	

		// Panggil class PHPExcel nya
		$excel = new PHPExcel();

		// Settingan awal file excel
		$excel->getProperties()->setCreator('Author')
		             ->setLastModifiedBy('Author')
		             ->setTitle("Data Deskripsi Nilai")
		             ->setSubject("Siswa")
		             ->setDescription("Lembar Import Deskripsi Pengetahuan dan Ketrampilan Siswa")
		             ->setKeywords("Deskripsi Pengetahuan dan Ketrampilan");

		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = array(
		  'font' => array('bold' => true), // Set font nya jadi bold
		  'alignment' => array(
		    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
		    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		  ),
		  'borders' => array(
		    'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
		    'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
		    'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
		    'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		  )
		);

		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = array(
		  'alignment' => array(
		    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		  ),
		  'borders' => array(
		    'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
		    'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
		    'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
		    'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		  )
		);

		$excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA DESKRIPSI PENGETAHUAN DAN KETRAMPILAN"); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A1:K1'); // Set Merge Cell pada kolom A1 sampai F1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

		// Buat header tabel nya pada baris ke 3
		$excel->setActiveSheetIndex(0)->setCellValue('A3', "NO");
		$excel->getActiveSheet()->mergeCells('A3:A4'); // Set Merge Cell
		$excel->setActiveSheetIndex(0)->setCellValue('B3', "ID DESKRIPSI");
		$excel->getActiveSheet()->mergeCells('B3:B4'); // Set Merge Cell
		$excel->setActiveSheetIndex(0)->setCellValue('C3', "ID NILAI");
		$excel->getActiveSheet()->mergeCells('C3:C4'); // Set Merge Cell
		$excel->setActiveSheetIndex(0)->setCellValue('D3', "ID PELAJARAN");
		$excel->getActiveSheet()->mergeCells('D3:D4'); // Set Merge Cell
		$excel->setActiveSheetIndex(0)->setCellValue('E3', "NIS");
		$excel->getActiveSheet()->mergeCells('E3:E4'); // Set Merge Cell
		$excel->setActiveSheetIndex(0)->setCellValue('F3', "ASPEK PENGETAHUAN");
		$excel->getActiveSheet()->mergeCells('F3:G3'); // Set Merge Cell
		$excel->setActiveSheetIndex(0)->setCellValue('F4', "Nilai");
		$excel->setActiveSheetIndex(0)->setCellValue('G4', "Deskripsi");
		$excel->setActiveSheetIndex(0)->setCellValue('H3', "ASPEK KETRAMPILAN");
		$excel->getActiveSheet()->mergeCells('H3:I3'); // Set Merge Cell
		$excel->setActiveSheetIndex(0)->setCellValue('H4', "Nilai");
		$excel->setActiveSheetIndex(0)->setCellValue('I4', "Deskripsi");
		$excel->setActiveSheetIndex(0)->setCellValue('J3', "ID SEMESTER");
		$excel->getActiveSheet()->mergeCells('J3:J4'); // Set Merge Cell
		$excel->setActiveSheetIndex(0)->setCellValue('K3', "ID TAHUN");
		$excel->getActiveSheet()->mergeCells('K3:K4'); // Set Merge Cell

		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$excel->getActiveSheet()->getStyle('A3:A4')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B3:B4')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C3:C4')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D3:D4')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E3:E4')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('F3:F4')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G3:G4')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('H3:H4')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('I3:I4')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('J3:J4')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('K3:K4')->applyFromArray($style_col);

		// Set height baris ke 1, 2 dan 3
		$excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
		$excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
		$excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);

		// Buat query untuk menampilkan semua data siswa
		$sql = $this->m_guru->list_deskripsi_nilai($id_guru,$id_kelas,$id_pelajaran,$setup_tahun->id_tahun,$semester);
		$numRows = $sql->num_rows()+4;
		//$sql->execute(); // Eksekusi querynya

		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 5; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach($sql->result_array() as $data){ // Ambil semua data dari hasil eksekusi $sql
		  $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
		  $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data['id_deskripsi']);
		  $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data['idnilai']);
		  $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data['idpelajaran']);
		  $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data['nilai_nis']);
		  $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data['nilai_pengetahuan']);
		  $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data['pengetahuan']);
		  $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data['nilai_ketrampilan']);
		  $excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data['ketrampilan']);
		  $excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $data['sms']);
		  $excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $data['thn']);
		  
		  // Khusus untuk no telepon. kita set type kolom nya jadi STRING
		  //$excel->setActiveSheetIndex(0)->setCellValueExplicit('E'.$numrow, $data['telp'], PHPExcel_Cell_DataType::TYPE_STRING);

		  // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
		  $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row);
		  
		  $excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);
		  
		  $no++; // Tambah 1 setiap kali looping
		  $numrow++; // Tambah 1 setiap kali looping
		}


		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); 
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(15); 
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(15); 
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(15); 
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(15); 
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(15); 
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(15); 
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(15); 
		$excel->getActiveSheet()->getColumnDimension('J')->setWidth(15); 
		$excel->getActiveSheet()->getColumnDimension('K')->setWidth(15); 

		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("Lembar Import Deskripsi");
		$excel->setActiveSheetIndex(0);
		
		$excel->getActiveSheet()->getProtection()->setPassword('4dm1n1');
		$excel->getActiveSheet()->getProtection()->setSheet(true);
		$excel->getActiveSheet()->getProtection()->setSort(true);
		$excel->getActiveSheet()->getProtection()->setInsertRows(true);
		$excel->getActiveSheet()->getProtection()->setFormatCells(true);
		$excel->getActiveSheet()->getStyle('G5:G'.$numRows.'')->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
		$excel->getActiveSheet()->getStyle('I5:I'.$numRows.'')->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
	

		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="template_import_deskripsi_nilai.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');

		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	}

	//eksport template nilai sikap::

	public function down_templateup_sikap()
	{
		//referensi::
		
		//get_data::
		$id_guru = $this->session->userdata('id');
		$id_kelas = $this->uri->segment(3);
		$id_tahun = $this->uri->segment(4);
		$id_semester = $this->uri->segment(5);
		include "include/id_wali_kelas.php";
		$id_wali_kls = $wali_id_wali;
	

		// Panggil class PHPExcel nya
		$excel = new PHPExcel();

		// Settingan awal file excel
		$excel->getProperties()->setCreator('Author')
		             ->setLastModifiedBy('Author')
		             ->setTitle("Data Nilai Sikap Siswa")
		             ->setSubject("Siswa")
		             ->setDescription("Lembar Import Nilai Sikap Siswa")
		             ->setKeywords("Nilai sikap siswa");

		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = array(
		  'font' => array('bold' => true), // Set font nya jadi bold
		  'alignment' => array(
		    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
		    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		  ),
		  'borders' => array(
		    'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
		    'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
		    'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
		    'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		  )
		);

		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = array(
		  'alignment' => array(
		    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		  ),
		  'borders' => array(
		    'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
		    'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
		    'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
		    'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		  )
		);
		$nama_kelas = $this->db->query("SELECT nama_kelas FROM setup_kelas WHERE id_kelas = ".$this->db->escape($id_kelas)."")->row('nama_kelas');
		$pd_tahun = $this->m_guru->select_dataWhere('id_tahun='.$id_tahun.'','setup_tahun')->row('tahun');
		
		$data_nilai_sikap = $this->m_guru->get_nilai_sikap2($id_kelas,$id_tahun,$id_semester);
		$cek_data = $data_nilai_sikap->num_rows();

		$excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA NIAI SIKAP KELAS $nama_kelas TA $pd_tahun SEMESTER $id_semester"); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A1:K1'); // Set Merge Cell pada kolom A1 sampai F1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

		if($cek_data>0)
		{
		// Buat header tabel nya pada baris ke 3
		$excel->setActiveSheetIndex(0)->setCellValue('A3', "NO");
		$excel->getActiveSheet()->mergeCells('A3:A4'); // Set Merge Cell
		$excel->setActiveSheetIndex(0)->setCellValue('B3', "NIS");
		$excel->getActiveSheet()->mergeCells('B3:B4'); // Set Merge Cell
		$excel->setActiveSheetIndex(0)->setCellValue('C3', "ID KELAS");
		$excel->getActiveSheet()->mergeCells('C3:C4'); // Set Merge Cell
		$excel->setActiveSheetIndex(0)->setCellValue('D3', "ID WALI");
		$excel->getActiveSheet()->mergeCells('D3:D4'); // Set Merge Cell
		$excel->setActiveSheetIndex(0)->setCellValue('E3', "ID SEMESTER");
		$excel->getActiveSheet()->mergeCells('E3:E4'); // Set Merge Cell
		$excel->setActiveSheetIndex(0)->setCellValue('F3', "ID TAHUN");
		$excel->getActiveSheet()->mergeCells('F3:F4'); // Set Merge Cell
		$excel->setActiveSheetIndex(0)->setCellValue('G3', "SIKAP SPIRITUAL");
		$excel->getActiveSheet()->mergeCells('G3:H3'); // Set Merge Cell
		$excel->setActiveSheetIndex(0)->setCellValue('G4', "Predikat");
		$excel->setActiveSheetIndex(0)->setCellValue('H4', "Deskripsi");
		$excel->setActiveSheetIndex(0)->setCellValue('I3', "SIKAP SOSIAL");
		$excel->getActiveSheet()->mergeCells('I3:J3'); // Set Merge Cell
		$excel->setActiveSheetIndex(0)->setCellValue('I4', "Predikat");
		$excel->setActiveSheetIndex(0)->setCellValue('J4', "Deskripsi");
		
		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$excel->getActiveSheet()->getStyle('A3:A4')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B3:B4')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C3:C4')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D3:D4')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E3:E4')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('F3:F4')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G3:G4')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('H3:H4')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('I3:I4')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('J3:J4')->applyFromArray($style_col);

		// Set height baris ke 1, 2 dan 3
		$excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
		$excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
		$excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);

		// Buat query untuk menampilkan semua data siswa
		$sql = $data_nilai_sikap;
		$numRows = $sql->num_rows()+4;
		//$sql->execute(); // Eksekusi querynya

		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 5; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach($sql->result_array() as $data){ // Ambil semua data dari hasil eksekusi $sql
		  $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
		  $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data['nis']);
		  $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data['id_kelas']);
		  $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data['id_wali']);
		  $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data['id_semester']);
		  $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data['id_tahun']);
		  $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data['predikat_spiritual']);
		  $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data['sikap_spiritual']);
		  $excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data['predikat_sosial']);
		  $excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $data['sikap_sosial']);
		  
		  // Khusus untuk no telepon. kita set type kolom nya jadi STRING
		  //$excel->setActiveSheetIndex(0)->setCellValueExplicit('E'.$numrow, $data['telp'], PHPExcel_Cell_DataType::TYPE_STRING);

		  // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
		  $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);
		  
		  $excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);
		  
		  $no++; // Tambah 1 setiap kali looping
		  $numrow++; // Tambah 1 setiap kali looping
		}

		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); 
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(15); 
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(15); 
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(15); 
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(15); 
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(15); 
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(15); 
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(15); 
		$excel->getActiveSheet()->getColumnDimension('J')->setWidth(15); 

		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("Lembar Import Nilai Sikap");
		$excel->setActiveSheetIndex(0);
		
		$excel->getActiveSheet()->getProtection()->setPassword('4dm1n1');
		$excel->getActiveSheet()->getProtection()->setSheet(true);
		$excel->getActiveSheet()->getProtection()->setSort(true);
		$excel->getActiveSheet()->getProtection()->setInsertRows(true);
		$excel->getActiveSheet()->getProtection()->setFormatCells(true);
		$excel->getActiveSheet()->getStyle('G5:J'.$numRows.'')->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
		}
		else
		{
		// Buat header tabel nya pada baris ke 3
		$excel->setActiveSheetIndex(0)->setCellValue('A3', "NO");
		$excel->getActiveSheet()->mergeCells('A3:A4'); // Set Merge Cell
		$excel->setActiveSheetIndex(0)->setCellValue('B3', "NIS");
		$excel->getActiveSheet()->mergeCells('B3:B4'); // Set Merge Cell
		$excel->setActiveSheetIndex(0)->setCellValue('C3', "ID KELAS");
		$excel->getActiveSheet()->mergeCells('C3:C4'); // Set Merge Cell
		$excel->setActiveSheetIndex(0)->setCellValue('D3', "ID WALI");
		$excel->getActiveSheet()->mergeCells('D3:D4'); // Set Merge Cell
		$excel->setActiveSheetIndex(0)->setCellValue('E3', "ID SEMESTER");
		$excel->getActiveSheet()->mergeCells('E3:E4'); // Set Merge Cell
		$excel->setActiveSheetIndex(0)->setCellValue('F3', "ID TAHUN");
		$excel->getActiveSheet()->mergeCells('F3:F4'); // Set Merge Cell
		$excel->setActiveSheetIndex(0)->setCellValue('G3', "SIKAP SPIRITUAL");
		$excel->getActiveSheet()->mergeCells('G3:H3'); // Set Merge Cell
		$excel->setActiveSheetIndex(0)->setCellValue('G4', "Predikat");
		$excel->setActiveSheetIndex(0)->setCellValue('H4', "Deskripsi");
		$excel->setActiveSheetIndex(0)->setCellValue('I3', "SIKAP SOSIAL");
		$excel->getActiveSheet()->mergeCells('I3:J3'); // Set Merge Cell
		$excel->setActiveSheetIndex(0)->setCellValue('I4', "Predikat");
		$excel->setActiveSheetIndex(0)->setCellValue('J4', "Deskripsi");
		
		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$excel->getActiveSheet()->getStyle('A3:A4')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B3:B4')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C3:C4')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D3:D4')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E3:E4')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('F3:F4')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G3:G4')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('H3:H4')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('I3:I4')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('J3:J4')->applyFromArray($style_col);

		// Set height baris ke 1, 2 dan 3
		$excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
		$excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
		$excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);

		// Buat query untuk menampilkan semua data siswa
		$sql = $this->m_guru->get_nilai_sikap1($id_kelas,$id_tahun);
		$numRows = $sql->num_rows()+4;
		//$sql->execute(); // Eksekusi querynya

		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 5; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach($sql->result_array() as $data){ // Ambil semua data dari hasil eksekusi $sql
		  $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
		  $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data['nis']);
		  $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data['id_kelas']);
		  $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $id_wali_kls);
		  $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $id_semester);
		  $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data['id_tahun']);
		  //$excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data['predikat_spiritual']);
		  //$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data['sikap_spiritual']);
		  //$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data['predikat_sosial']);
		  //$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data['sikap_sosial']);
		  
		  // Khusus untuk no telepon. kita set type kolom nya jadi STRING
		  //$excel->setActiveSheetIndex(0)->setCellValueExplicit('E'.$numrow, $data['telp'], PHPExcel_Cell_DataType::TYPE_STRING);

		   // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
		  $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
		  $excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);
		  
		  $excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);
		  
		  $no++; // Tambah 1 setiap kali looping
		  $numrow++; // Tambah 1 setiap kali looping
		}

		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); 
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(15); 
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(15); 
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(15); 
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(15); 
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(15); 
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(15); 
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(15); 
		$excel->getActiveSheet()->getColumnDimension('J')->setWidth(15); 

		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("Lembar Import Nilai Sikap");
		$excel->setActiveSheetIndex(0);
		
		$excel->getActiveSheet()->getProtection()->setPassword('4dm1n1');
		$excel->getActiveSheet()->getProtection()->setSheet(true);
		$excel->getActiveSheet()->getProtection()->setSort(true);
		$excel->getActiveSheet()->getProtection()->setInsertRows(true);
		$excel->getActiveSheet()->getProtection()->setFormatCells(true);
		$excel->getActiveSheet()->getStyle('G5:J'.$numRows.'')->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
	
		}
	

		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="template_import_nilai_sikap.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');

		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	}
}