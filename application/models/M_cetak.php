<?php
class M_cetak extends CI_Model{

	function insert_batch($table,$data)
	{
		return $this->db->insert_batch($table,$data);
	}

	function update_batch($table,$data,$where)
	{
		return $this->db->update_batch($table,$data,$where);
	}

	function replace_data($table,$data)
		{
			return $this->db->replace($table,$data);
		}	

	function select_data($colom,$order,$table,$limit)
	{
		$sql = "SELECT $colom FROM $table ORDER BY ? LIMIT ?";
		return $this->db->query($sql,array($order,$limit));
	}

	function select_dataWhere($where,$table){
		return $this->db->get_where($table,$where);
	}

	function get_data_sekolah()
	{
		$this->db->select('*');
		$this->db->from('info_sekolah');
		return $this->db->get();
	}

	function get_data_siswa($nis)
	{
		$this->db->select('*');
		$this->db->from('data_siswa');
		$this->db->join('setup_kelas','setup_kelas.id_kelas=data_siswa.kelas','left');
		$this->db->where('data_siswa.nis=',$nis);
		return $this->db->get();
	}

	function get_nilai_sikap($nis,$idkelas,$id_tahun,$semester)
	{
		$sql = "SELECT predikat_spiritual,sikap_spiritual,predikat_sosial,sikap_sosial FROM tbl_nilai_sikap WHERE nis=? AND id_kelas=? AND id_tahun=? AND id_semester=?";

		return $this->db->query($sql,array($nis,$idkelas,$id_tahun,$semester));
	}

	/*
	//VERSI LAMA
	function get_nilai_rapor($nis,$idkelas,$id_tahun,$semester,$kategori_kls)
	{
		//setup_pelajaran, tbl_kkm, tbl_nilai, tbl_kategori_mapel,
		$sql = "SELECT katmap.id_kat_mapel,katmap.kategori_mapel,pelajaran.nama_pelajaran,kkm.kkm,nilai.nilai_pengetahuan,nilai.nilai_ketrampilan FROM tbl_nilai AS nilai JOIN setup_pelajaran AS pelajaran ON nilai.id_pelajaran=pelajaran.id_pelajaran JOIN tbl_kategori_mapel AS katmap ON katmap.id_kat_mapel=pelajaran.id_kat_mapel JOIN (SELECT id_kkm,kkm,id_pelajaran FROM tbl_kkm WHERE id_tahun=? AND kategori_kls=?) AS kkm ON nilai.id_pelajaran=kkm.id_pelajaran WHERE nilai.nis=? AND nilai.id_kelas=? AND nilai.id_tahun=? AND nilai.semester=? ORDER BY nilai.id_pelajaran ASC";

		return $this->db->query($sql,array($id_tahun,$kategori_kls,$nis,$idkelas,$id_tahun,$semester));
	}*/

	// VERSI MUTU YOGYAKARTA

	function get_nilai_rapor($nis,$idkelas,$id_tahun,$semester,$kategori_kls)
	{
		//setup_pelajaran, tbl_kkm, tbl_nilai, tbl_kategori_mapel,
		$sql = "SELECT katmap.id_kat_mapel,katmap.kategori_mapel,pelajaran.id_pelajaran,pelajaran.nama_pelajaran,kkm.kkm,nilai.nilai_pengetahuan,nilai.nilai_ketrampilan,deskripsi.pengetahuan,deskripsi.ketrampilan 
		FROM tbl_nilai AS nilai 
		JOIN setup_pelajaran AS pelajaran ON nilai.id_pelajaran=pelajaran.id_pelajaran 
		JOIN tbl_kategori_mapel AS katmap ON katmap.id_kat_mapel=pelajaran.id_kat_mapel 
		LEFT JOIN tbl_deskripsi_nilai AS deskripsi ON deskripsi.id_nilai=nilai.id_nilai 
		LEFT JOIN (SELECT id_kkm,kkm,id_pelajaran 
		FROM tbl_kkm WHERE id_tahun=? AND kategori_kls=?) AS kkm ON nilai.id_pelajaran=kkm.id_pelajaran WHERE nilai.nis=? AND nilai.id_kelas=? AND nilai.id_tahun=? AND nilai.semester=? ORDER BY nilai.id_pelajaran ASC";

		return $this->db->query($sql,array($id_tahun,$kategori_kls,$nis,$idkelas,$id_tahun,$semester));
	}

	function get_deskripsi_nilai($nis,$idkelas,$id_tahun,$semester)
	{
		$sql = "SELECT deskripsi.pengetahuan,deskripsi.ketrampilan,mapel.id_kat_mapel,mapel.nama_pelajaran,nilai.id_kelas FROM tbl_deskripsi_nilai AS deskripsi, setup_pelajaran AS mapel, tbl_nilai AS nilai WHERE deskripsi.id_pelajaran=mapel.id_pelajaran AND deskripsi.id_nilai=nilai.id_nilai AND deskripsi.nis=? AND nilai.id_kelas=? AND deskripsi.id_tahun=? AND deskripsi.semester=? ORDER BY nilai.id_pelajaran ASC";
		return $this->db->query($sql,array($nis,$idkelas,$id_tahun,$semester));
	}

	/*
	// VERSI LAMA
	function get_nilai_ekstra($nis,$idkelas,$id_tahun,$semester)
	{
		$sql = "SELECT kegiatan.nama_ekstra,ekstra.nilai,ekstra.deskripsi FROM ekstrakurikuler AS kegiatan JOIN tbl_nilai_ekstra AS ekstra ON kegiatan.id_ekstra=ekstra.id_ekstra WHERE ekstra.nis=? AND ekstra.id_kelas=? AND ekstra.id_tahun=? AND ekstra.id_semester=?";
		return $this->db->query($sql,array($nis,$idkelas,$id_tahun,$semester));
	}*/

	//VERSI MUTU YOGYAKARTA
	function get_nilai_ekstra()
	{
		$this->db->order_by('nama_ekstra','ASC');
		return $this->db->get('ekstrakurikuler');
	}

	function get_nilai_prestasi($nis,$idkelas,$id_tahun,$semester)
	{
		$sql = "SELECT jenis_kegiatan,keterangan FROM tbl_prestasi_siswa WHERE nis='$nis' AND id_kelas='$idkelas' AND id_tahun='$id_tahun' AND id_semester='$semester' ";
		return $this->db->query($sql,array($nis,$idkelas,$id_tahun,$semester));
	}

	function get_kehadiran_siswa($nis,$idkelas,$id_tahun,$semester)
	{
		$sql = "SELECT sakit,izin,tnp_ket FROM tbl_kehadiran WHERE nis='$nis' AND id_kelas='$idkelas' AND id_tahun='$id_tahun' AND semester='$semester' ";
		return $this->db->query($sql,array($nis,$idkelas,$id_tahun,$semester));
	}

	function get_cttnwk($nis,$idkelas,$id_tahun,$semester)
	{
		$sql = "SELECT catatanwk FROM tbl_catatanwk WHERE nis='$nis' AND id_kelas='$idkelas' AND id_tahun='$id_tahun' AND id_semester='$semester' ";
		return $this->db->query($sql,array($nis,$idkelas,$id_tahun,$semester));
	}

	function get_wk_saat_ini($idthn,$idkelas)
	{
		$sql = "SELECT guru.nama_guru,guru.nip FROM tbl_wali AS wali JOIN data_guru AS guru WHERE wali.id_guru=guru.id_guru AND wali.id_tahun='$idthn' AND wali.id_kelas='$idkelas' ";
		return $this->db->query($sql,array($idthn,$idkelas));
	}


	function get_ref_kepsek($idthn,$idsms)
	{
		$sql = "SELECT guru.nama_guru,guru.nip,kepsek.tgl_rapor FROM tbl_kepsek AS kepsek JOIN data_guru AS guru ON kepsek.id_guru=guru.id_guru WHERE kepsek.id_tahun='$idthn' AND kepsek.id_semester='$idsms' ";
		// echo $sql;
		return $this->db->query($sql,array($idthn,$idsms));
	}

	function get_ttd_kepsek_sampul($idthn,$idsms)
	{
		$sql = "SELECT guru.nama_guru,guru.nip,kepsek.tgl_siswa_diterima FROM tbl_kepsek AS kepsek JOIN data_guru AS guru ON kepsek.id_guru=guru.id_guru WHERE kepsek.id_tahun=? AND kepsek.id_semester=?";
		return $this->db->query($sql,array($idthn,$idsms));	
	}

	public function get_tinggi_berat($post)
	{
		$this->db->select('id_siswa')
			->from('data_siswa')
			->where('nis',$post['nis']);
		$query = $this->db->get_compiled_select();
		$data_siswa = $this->db->query($query)->row_array();
		$this->db->select()
			->from('tbl_berat_tinggi')
			->where('id_siswa',$data_siswa['id_siswa'])
			->where('id_semester', $post['semester'])
			->where('id_tahun',$post['id_tahun']);
		$query = $this->db->get_compiled_select();
		// print('<pre>');print_r($query);exit();
		$data = $this->db->query($query)->row_array();
		return $data;
	}


}