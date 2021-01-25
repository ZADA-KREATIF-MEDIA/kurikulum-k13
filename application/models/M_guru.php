<?php

class M_guru extends CI_Model{
	/**
	| -----------------------------------------------------------------------------------
	| SINO 2018 - WATULINTANG.COM
	| -----------------------------------------------------------------------------------
	**/
	function select_cols($cols,$where,$table)
	{
		$this->db->select($cols);
		$this->db->where($where);
		return $this->db->get($table);
	}

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

	function get_ref_thn_aktif()
	{
		$sql = "SELECT * FROM setup_tahun WHERE status_aktif = ?";
    	$query = $this->db->query($sql,array(1));
    	return $query;
	}

	function input_nilai_perkelas($id_guru,$id_semester,$id_tahun)
	{
		$this->db->select('*');
		$this->db->from('tbl_jadwal AS jadwal');
		$this->db->join('setup_kelas AS kelas', 'jadwal.id_kelas=kelas.id_kelas');
		$this->db->join('setup_pelajaran AS pelajaran', 'jadwal.id_pelajaran=pelajaran.id_pelajaran');
		$this->db->where('jadwal.id_guru',$id_guru);
		$this->db->where('jadwal.id_semester',$id_semester);
		$this->db->where('jadwal.id_tahun',$id_tahun);
		$this->db->order_by('jadwal.id_pelajaran','ASC');
		$this->db->order_by('jadwal.id_kelas','ASC');
		return $this->db->get();
	}

	function kategori_nilai()
	{
		$this->db->order_by('id_kategori','ASC');
		return $this->db->get('tbl_kategori_nilai');
	}

	function list_siswa_dikelas($idkelas,$idtahun)
	{
		$sql = "SELECT * FROM tbl_ruangan ruangan, data_siswa siswa WHERE ruangan.nis=siswa.nis and ruangan.id_kelas=? and ruangan.id_tahun=? order by siswa.nis ASC";
		return $this->db->query($sql,array($idkelas,$idtahun));
	}

	/*function list_nilai_siswa($idguru,$idkelas,$idpelajaran,$idtahun,$semester)
	{
		$sql = "SELECT * FROM tbl_nilai nilai, data_siswa siswa WHERE nilai.nis=siswa.nis and nilai.id_guru=? and nilai.id_kelas=? and nilai.id_pelajaran=? and nilai.id_tahun=? and nilai.semester=? order by siswa.nis asc";
		return $this->db->query($sql,array($idguru,$idkelas,$idpelajaran,$idtahun,$semester));
	}*/

	function list_nilai_siswa($idguru,$idkelas,$idpelajaran,$idtahun,$semester)
	{
		$sql = "SELECT nilai.id_nilai,nilai.nis,nilai.id_pelajaran,nilai.id_kelas,nilai.id_guru,nilai.nilai_pengetahuan,nilai.nilai_ketrampilan,nilai.id_tahun,nilai.semester,siswa.nama_siswa FROM tbl_nilai nilai, data_siswa siswa WHERE nilai.nis=siswa.nis and nilai.id_guru=? and nilai.id_kelas=? and nilai.id_pelajaran=? and nilai.id_tahun=? and nilai.semester=? order by siswa.nis asc";
		return $this->db->query($sql,array($idguru,$idkelas,$idpelajaran,$idtahun,$semester));
	}

	function list_deskripsi_nilai($idguru,$idkelas,$idpelajaran,$idtahun,$semester)
	{
		$sql = "SELECT deskripsi.id_deskripsi,nilai.id_nilai AS idnilai,nilai.nis AS nilai_nis,nilai.id_pelajaran AS idpelajaran,siswa.nama_siswa,nilai.nilai_pengetahuan,nilai.nilai_ketrampilan,deskripsi.pengetahuan,deskripsi.ketrampilan,nilai.semester AS sms,nilai.id_tahun AS thn FROM tbl_nilai nilai JOIN data_siswa siswa ON nilai.nis=siswa.nis LEFT JOIN tbl_deskripsi_nilai deskripsi ON nilai.id_nilai=deskripsi.id_nilai WHERE nilai.id_guru=? and nilai.id_kelas=? and nilai.id_pelajaran=? and nilai.id_tahun=? and nilai.semester=? order by siswa.nis asc";
		return $this->db->query($sql,array($idguru,$idkelas,$idpelajaran,$idtahun,$semester));
	}

	function get_siswa_bkhadir($id_kelas,$id_tahun)
	{
		$sql = "SELECT tbl_ruangan.nis, tbl_ruangan.id_kelas, tbl_ruangan.id_tahun, data_siswa.nis, data_siswa.nama_siswa, data_siswa.kelamin, setup_kelas.nama_kelas FROM tbl_ruangan, data_siswa, setup_kelas WHERE tbl_ruangan.id_kelas=? AND  tbl_ruangan.id_tahun=? AND tbl_ruangan.nis=data_siswa.nis AND tbl_ruangan.id_kelas=setup_kelas.id_kelas ORDER BY data_siswa.nis ASC";

		return $this->db->query($sql,array($id_kelas,$id_tahun));
	}

	function get_data_bkhadir($id_kelas,$id_tahun,$semester)
	{
		$sql = "SELECT data_siswa.nis, data_siswa.nama_siswa, data_siswa.kelamin, tbl_kehadiran.nis, tbl_kehadiran.id_kelas, tbl_kehadiran.id_tahun, tbl_kehadiran.semester, tbl_kehadiran.sakit, tbl_kehadiran.izin, tbl_kehadiran.tnp_ket, tbl_kehadiran.terlambat, tbl_kehadiran.meninggalkan_sek, tbl_kehadiran.tdk_upacara, tbl_kehadiran.pm_s, tbl_kehadiran.pm_i, tbl_kehadiran.pm_a, tbl_kehadiran.pm_t FROM  data_siswa,tbl_kehadiran WHERE data_siswa.nis=tbl_kehadiran.nis AND  tbl_kehadiran.id_kelas=? AND tbl_kehadiran.id_tahun=? AND tbl_kehadiran.semester=? ORDER BY data_siswa.nis ASC";

		return $this->db->query($sql,array($id_kelas,$id_tahun,$semester));
	}

	function get_nilai_sikap1($id_kelas,$id_tahun)
	{
		$sql = "SELECT tbl_ruangan.nis, tbl_ruangan.id_kelas, tbl_ruangan.id_tahun, data_siswa.nis, data_siswa.nama_siswa, data_siswa.kelamin, setup_kelas.nama_kelas FROM tbl_ruangan, data_siswa, setup_kelas WHERE tbl_ruangan.id_kelas=? AND  tbl_ruangan.id_tahun=? AND tbl_ruangan.nis=data_siswa.nis AND tbl_ruangan.id_kelas=setup_kelas.id_kelas ORDER by data_siswa.nis ASC";

		return $this->db->query($sql,array($id_kelas,$id_tahun));
	}


	function get_nilai_sikap2($id_kelas,$id_tahun,$semester)
	{
		$sql = "SELECT siswa.nama_siswa, siswa.kelamin, sikap.nis, sikap.id_kelas,sikap.id_wali, sikap.id_tahun, sikap.id_semester, sikap.predikat_spiritual, sikap.sikap_spiritual, sikap.predikat_sosial, sikap.sikap_sosial FROM  data_siswa AS siswa,tbl_nilai_sikap AS sikap WHERE siswa.nis=sikap.nis AND  sikap.id_kelas=? AND sikap.id_tahun=? AND sikap.id_semester=? ORDER BY siswa.nis ASC";

		return $this->db->query($sql,array($id_kelas,$id_tahun,$semester));
	}

	function get_nilai_ekstra($id_kelas,$id_tahun,$semester)
	{
		$sql = "SELECT DISTINCT(ekstra.nis), siswa_dikelas.nama_siswa, siswa_dikelas.id_kelas, ekstra.id_wali, ekstra.id_tahun, ekstra.id_semester FROM tbl_nilai_ekstra AS ekstra JOIN (SELECT tbl_ruangan.nis, tbl_ruangan.id_kelas, tbl_ruangan.id_tahun, data_siswa.nama_siswa FROM tbl_ruangan, data_siswa WHERE tbl_ruangan.id_kelas=? AND  tbl_ruangan.id_tahun=? AND tbl_ruangan.nis=data_siswa.nis) AS siswa_dikelas ON siswa_dikelas.nis=ekstra.nis WHERE ekstra.id_kelas=? AND ekstra.id_tahun=? AND ekstra.id_semester=? ORDER BY ekstra.nis ASC";

		return $this->db->query($sql,array($id_kelas,$id_tahun,$id_kelas,$id_tahun,$semester));
	}

	function lihat_nilai_ekstra($where)
	{
		$sql = $this->db->query("SELECT ekstra.id_ekst, ekstra.nis, siswa.nama_siswa, ekstra.id_kelas, ekstra.id_wali, ekstra.id_tahun, ekstra.id_semester, ekstra.id_ekstra, ekstrakurikuler.nama_ekstra, ekstra.nilai, ekstra.deskripsi, kelas.nama_kelas FROM  data_siswa AS siswa,tbl_nilai_ekstra AS ekstra,ekstrakurikuler,setup_kelas AS kelas WHERE siswa.nis=ekstra.nis AND ekstra.id_ekstra=ekstrakurikuler.id_ekstra AND ekstra.id_kelas=kelas.id_kelas AND $where ORDER BY ekstra.id_ekstra ASC");
		return $sql;
	}

	function data_siswa_dikelas($id_kelas,$id_tahun)
	{
		$sql = "SELECT tbl_ruangan.nis, tbl_ruangan.id_kelas, tbl_ruangan.id_tahun, data_siswa.nama_siswa FROM tbl_ruangan, data_siswa WHERE tbl_ruangan.id_kelas=? AND  tbl_ruangan.id_tahun=? AND tbl_ruangan.nis=data_siswa.nis ORDER by data_siswa.nis ASC";

		return $this->db->query($sql,array($id_kelas,$id_tahun));
	}

	function get_prestasi_siswa($id_kelas,$id_tahun,$semester)
	{
		$sql = "SELECT DISTINCT(prestasi.nis), siswa_dikelas.nama_siswa, siswa_dikelas.id_kelas, prestasi.id_wali, prestasi.id_tahun, prestasi.id_semester FROM tbl_prestasi_siswa AS prestasi JOIN (SELECT tbl_ruangan.nis, tbl_ruangan.id_kelas, tbl_ruangan.id_tahun, data_siswa.nama_siswa, setup_kelas.nama_kelas FROM tbl_ruangan, data_siswa, setup_kelas WHERE tbl_ruangan.id_kelas=? AND  tbl_ruangan.id_tahun=? AND tbl_ruangan.nis=data_siswa.nis AND tbl_ruangan.id_kelas=setup_kelas.id_kelas) AS siswa_dikelas ON siswa_dikelas.nis=prestasi.nis WHERE prestasi.id_kelas=? AND prestasi.id_semester=? AND prestasi.id_tahun=? ORDER BY prestasi.nis ASC";

		return $this->db->query($sql,array($id_kelas,$id_tahun,$id_kelas,$semester,$id_tahun));
	}

	function lihat_prestasi_persiswa($where)
	{
		$sql = $this->db->query("SELECT prestasi.id_prestasi, prestasi.nis, siswa.nama_siswa, prestasi.id_kelas, prestasi.id_wali, prestasi.id_tahun, prestasi.id_semester, prestasi.jenis_kegiatan, prestasi.keterangan, kelas.nama_kelas FROM  data_siswa AS siswa,tbl_prestasi_siswa AS prestasi,setup_kelas AS kelas WHERE siswa.nis=prestasi.nis AND prestasi.id_kelas=kelas.id_kelas AND $where ORDER BY prestasi.id_prestasi ASC");
		return $sql;
	}

	function get_catatan_walikelas1($id_kelas,$id_tahun)
	{
		$sql = "SELECT tbl_ruangan.nis, tbl_ruangan.id_kelas, tbl_ruangan.id_tahun, data_siswa.nis, data_siswa.nama_siswa, data_siswa.kelamin, setup_kelas.nama_kelas FROM tbl_ruangan, data_siswa, setup_kelas WHERE tbl_ruangan.id_kelas=? AND  tbl_ruangan.id_tahun=? AND tbl_ruangan.nis=data_siswa.nis AND tbl_ruangan.id_kelas=setup_kelas.id_kelas ORDER by data_siswa.nis ASC";

		return $this->db->query($sql,array($id_kelas,$id_tahun));
	}

	function get_catatan_walikelas2($id_kelas,$id_tahun,$semester)
	{
		$sql = "SELECT siswa.nis, siswa.nama_siswa, catatan.id_catwk, catatan.id_kelas, catatan.id_tahun, catatan.id_semester, catatan.catatanwk FROM  data_siswa AS siswa,tbl_catatanwk AS catatan WHERE siswa.nis=catatan.nis AND  catatan.id_kelas=? AND catatan.id_tahun=? AND catatan.id_semester=? ORDER BY siswa.nis ASC";

		return $this->db->query($sql,array($id_kelas,$id_tahun,$semester));
	}



	function select_table_orderby($order,$table)
	{
		$this->db->select('*');
		$this->db->order_by($order);
		$result = $this->db->get($table);
		return $result;
	}


	function select_dataFrom($table){
		return $this->db->get($table);
	}

	function select_dataWhere($where,$table){
		return $this->db->get_where($table,$where);
	}

	function delete_dataTable($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
	}

	function insert_dataTo($data,$table){
		$this->db->insert($table,$data);
	}

	function update_dataTable($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}


	function get_list()
	{
		$this->db->select("id, nama, umur, kelas");
		$this->db->from("tbl_murid");
		$this->db->order_by('id', 'DESC');
		$q = $this->db->get();
			return $q;

	}

	function get_edit($post){
		$this->db->select("id, nama, umur, kelas");
		$this->db->from("tbl_murid");
		$this->db->where_in('id', $post['check']);
		$this->db->order_by('id', 'DESC');
		$q = $this->db->get();
			return $q;
	}

	function post_add($result = array())
	{
		$total_array = count($result);
		if($total_array != 0){
			$this->db->insert_batch('tbl_murid', $result);
		}
	}

	function post_edit($result = array())
	{
		$total_array = count($result);
		if($total_array != 0)
		{
			$this->db->update_batch('tbl_murid', $result, 'id');
		}
	}

	function post_delete($post = array())
	{
		$total_array = count($post);

		if($total_array != 0)
		{
			$this->db->where_in('id', $post['check']);
			$this->db->delete('tbl_murid');
		}
	}

	//PELAPORAN NILAI
	//Per Mapel yg diampu----------------------------------------------------------
	function get_kelas_mengajar($id_guru,$id_semester,$id_tahun)
	{
		$this->db->select('DISTINCT(jadwal.id_kelas),kelas.nama_kelas');
		$this->db->from('tbl_jadwal AS jadwal');
		$this->db->join('setup_kelas AS kelas', 'jadwal.id_kelas=kelas.id_kelas');
		
		$this->db->where('jadwal.id_guru',$id_guru);
		$this->db->where('jadwal.id_semester',$id_semester);
		$this->db->where('jadwal.id_tahun',$id_tahun);
		$this->db->order_by('kelas.nama_kelas','ASC');
		return $this->db->get();
	}

	function get_siswa_dikelas($id_kelas,$id_tahun)
	{
		$sql = "SELECT tbl_ruangan.nis, tbl_ruangan.id_kelas, tbl_ruangan.id_tahun, data_siswa.nis, data_siswa.nama_siswa, data_siswa.kelamin, setup_kelas.nama_kelas FROM tbl_ruangan, data_siswa, setup_kelas WHERE tbl_ruangan.id_kelas=? AND  tbl_ruangan.id_tahun=? AND tbl_ruangan.nis=data_siswa.nis AND tbl_ruangan.id_kelas=setup_kelas.id_kelas ORDER BY data_siswa.nis ASC";

		return $this->db->query($sql,array($id_kelas,$id_tahun));
	}

	function get_mapel_diampu($id_guru,$idkelas,$idsms,$idthn)
	{
		$sql = "SELECT pelajaran.id_pelajaran,pelajaran.nama_pelajaran FROM tbl_jadwal AS jadwal JOIN setup_pelajaran AS pelajaran ON jadwal.id_pelajaran=pelajaran.id_pelajaran WHERE jadwal.id_guru=? AND jadwal.id_kelas=? AND jadwal.id_semester=? AND jadwal.id_tahun=? ORDER BY pelajaran.id_pelajaran ASC";

		return $this->db->query($sql,array($id_guru,$idkelas,$idsms,$idthn));
	}

	function get_nilai_mapel($nis,$id_pel,$idkelas,$idsms,$idtahun)
	{
		$sql = "SELECT nis, id_pelajaran, id_kelas, nilai_pengetahuan, nilai_ketrampilan, id_tahun, semester  FROM tbl_nilai WHERE nis=? and id_pelajaran=? and id_kelas=? and id_tahun=? and semester=?";
		return $this->db->query($sql,array($nis,$id_pel,$idkelas,$idtahun,$idsms));
	}

	function get_jml_nilai($nis,$idkelas,$idsms,$idtahun)
	{
		$sql = "SELECT SUM(nilai_pengetahuan+nilai_ketrampilan) AS jumlah_nilai FROM tbl_nilai WHERE nis=? and id_kelas=? and id_tahun=? and semester=?";
		return $this->db->query($sql,array($nis,$idkelas,$idtahun,$idsms));
	}

	function get_pengumuman()
	{
		$this->db->select('post.id_post,post.tgl_post,post.type_post,post.judul_post,post.isi_post,post.privacy_post,author.nama_admin AS author,author.foto_admin');
		$this->db->from('tbl_post post');
		$this->db->join('user_admin author', 'author.id_admin=post.author_post','left');
		$this->db->where('post.type_post','pengumuman');
		$this->db->order_by('post.tgl_post DESC');
		$this->db->limit(10);
		return $this->db->get();
	}

	//HAK AKSES GURU+SBG WALI KELAS
	function get_pengumuman_all()
	{
		$this->db->select('post.id_post,post.tgl_post,post.type_post,post.judul_post,post.isi_post,post.privacy_post,author.nama_admin AS author,author.foto_admin');
		$this->db->from('tbl_post post');
		$this->db->join('user_admin author', 'author.id_admin=post.author_post','left');
		$this->db->where('post.type_post','pengumuman');
		$this->db->order_by('post.tgl_post DESC');
		$this->db->limit(10);
		return $this->db->get();
	}

	function pengumuman_all_wp($limit,$start)
	{
		$this->db->select('post.id_post,post.tgl_post,post.type_post,post.judul_post,post.isi_post,post.privacy_post,author.nama_admin AS author,author.foto_admin');
		$this->db->from('tbl_post post');
		$this->db->join('user_admin author', 'author.id_admin=post.author_post','left');
		$this->db->where('post.type_post','pengumuman');
		$this->db->order_by('post.tgl_post DESC');
		$this->db->limit($limit,$start);
		
		return $this->db->get();
	}

	//HAK AKSES GURU SAJA
	function get_pengumuman_guru()
	{
		$sql = "SELECT post.id_post,post.tgl_post,post.type_post,post.judul_post,post.isi_post,post.privacy_post,author.nama_admin AS author,author.foto_admin FROM tbl_post post LEFT JOIN user_admin author ON author.id_admin=post.author_post WHERE post.type_post=? AND post.privacy_post=? UNION (SELECT post.id_post,post.tgl_post,post.type_post,post.judul_post,post.isi_post,post.privacy_post,author.nama_admin AS author,author.foto_admin FROM tbl_post post LEFT JOIN user_admin author ON author.id_admin=post.author_post WHERE post.type_post=? AND post.privacy_post=?) ORDER BY tgl_post DESC LIMIT 10";

		return $this->db->query($sql,array('pengumuman','guru','pengumuman','publik'));
	}

	function pengumuman_guru_wp($limit,$start)
	{
		$sql = "SELECT post.id_post,post.tgl_post,post.type_post,post.judul_post,post.isi_post,post.privacy_post,author.nama_admin AS author,author.foto_admin FROM tbl_post post LEFT JOIN user_admin author ON author.id_admin=post.author_post WHERE post.type_post=? AND post.privacy_post=? UNION (SELECT post.id_post,post.tgl_post,post.type_post,post.judul_post,post.isi_post,post.privacy_post,author.nama_admin AS author,author.foto_admin FROM tbl_post post LEFT JOIN user_admin author ON author.id_admin=post.author_post WHERE post.type_post=? AND post.privacy_post=?) ORDER BY tgl_post DESC LIMIT $start,$limit";

		return $this->db->query($sql,array('pengumuman','guru','pengumuman','publik'));
	}

	//HAK AKSES GURU SAJA
	function get_pengumuman_publik()
	{
		$this->db->select('post.id_post,post.tgl_post,post.type_post,post.judul_post,post.isi_post,post.privacy_post,author.nama_admin AS author,author.foto_admin');
		$this->db->from('tbl_post post');
		$this->db->join('user_admin author', 'author.id_admin=post.author_post','left');
		$this->db->where('post.type_post','pengumuman');
		$this->db->where('post.privacy_post','publik');
		$this->db->order_by('post.tgl_post DESC');
		$this->db->limit(10);
		return $this->db->get();
	}

	function pengumuman_publik_wp($limit,$start)
	{
		$this->db->select('post.id_post,post.tgl_post,post.type_post,post.judul_post,post.isi_post,post.privacy_post,author.nama_admin AS author,author.foto_admin');
		$this->db->from('tbl_post post');
		$this->db->join('user_admin author', 'author.id_admin=post.author_post','left');
		$this->db->where('post.type_post','pengumuman');
		$this->db->where('post.privacy_post','publik');
		$this->db->order_by('post.tgl_post DESC');
		$this->db->limit($limit,$start);
		
		return $this->db->get();
	}




	function data_pengumuman()
	{
		$this->db->select('post.id_post,post.tgl_post,post.type_post,post.judul_post,post.isi_post,post.privacy_post,author.nama_admin AS author,author.foto_admin');
		$this->db->from('tbl_post post');
		$this->db->join('user_admin author', 'author.id_admin=post.author_post','left');
		$this->db->where('post.type_post','pengumuman');
		$this->db->order_by('post.tgl_post DESC');
		
		return $this->db->get();
	}

	function data_pengumuman_wp($limit,$start)
	{
		$this->db->select('post.id_post,post.tgl_post,post.type_post,post.judul_post,post.isi_post,post.privacy_post,author.nama_admin AS author,author.foto_admin');
		$this->db->from('tbl_post post');
		$this->db->join('user_admin author', 'author.id_admin=post.author_post','left');
		$this->db->where('post.type_post','pengumuman');
		$this->db->order_by('post.tgl_post DESC');
		$this->db->limit($limit,$start);
		
		return $this->db->get();
	}

	function cek_guru_saja($idguru,$id_tahun)
	{
		$sql = "SELECT id_guru FROM data_guru WHERE id_guru=? AND id_guru NOT IN (SELECT id_guru FROM tbl_wali WHERE id_tahun=?)";
		return $this->db->query($sql,array($idguru,$id_tahun));

	}

	function cek_wali_kelas($idguru,$id_tahun)
	{
		$sql = "SELECT id_guru FROM tbl_wali WHERE id_guru=? AND id_tahun=?";
		return $this->db->query($sql,array($idguru,$id_tahun));

	}


	function get_tulisan($id_post)
	{
		$this->db->select('post.id_post,post.tgl_post,post.type_post,post.judul_post,post.isi_post,post.privacy_post,author.nama_admin AS author,author.foto_admin');
		$this->db->from('tbl_post post');
		$this->db->join('user_admin author', 'author.id_admin=post.author_post','left');
		$this->db->where('post.type_post','halaman');
		$this->db->where('post.id_post',$id_post);
		
		return $this->db->get();
	}

	/* INFO LEGGER*/
function get_list_mapel_sesuai($idkelas,$idtahun,$idsms)
{
	$sql = "SELECT DISTINCT(pelajaran.id_pelajaran),pelajaran.nama_pelajaran FROM setup_pelajaran AS pelajaran JOIN tbl_nilai nilai ON pelajaran.id_pelajaran=nilai.id_pelajaran WHERE nilai.id_kelas=? AND nilai.id_tahun=? AND nilai.semester=? ORDER BY pelajaran.id_pelajaran ASC";
		return $this->db->query($sql,array($idkelas,$idtahun,$idsms));
}

function get_list_siswa($id_kelas,$id_tahun)
	{
		$sql = "SELECT tbl_ruangan.nis, tbl_ruangan.id_kelas, tbl_ruangan.id_tahun, data_siswa.nis, data_siswa.nama_siswa, data_siswa.kelamin, setup_kelas.nama_kelas FROM tbl_ruangan, data_siswa, setup_kelas WHERE tbl_ruangan.id_kelas=? AND  tbl_ruangan.id_tahun=? AND tbl_ruangan.nis=data_siswa.nis AND tbl_ruangan.id_kelas=setup_kelas.id_kelas ORDER by data_siswa.nis ASC";

		return $this->db->query($sql,array($id_kelas,$id_tahun));
	}

	//nilai pengethaun

	function get_nilai_mapel_leg($nis,$id_pel,$idkelas,$idsms,$idtahun)
	{
		$sql = "SELECT nis, id_pelajaran, id_kelas, nilai_pengetahuan, id_tahun, semester  FROM tbl_nilai WHERE nis=? and id_pelajaran=? and id_kelas=? and id_tahun=? and semester=?";
		return $this->db->query($sql,array($nis,$id_pel,$idkelas,$idtahun,$idsms));
	}

	function get_jml_nilai_leg($nis,$idkelas,$idsms,$idtahun)
	{
		$sql = "SELECT SUM(nilai_pengetahuan) AS jumlah_nilai FROM tbl_nilai WHERE nis=? and id_kelas=? and id_tahun=? and semester=?";
		return $this->db->query($sql,array($nis,$idkelas,$idtahun,$idsms));
	}

	//nilai ketrampilan
	function get_nilai_mapel2($nis,$id_pel,$idkelas,$idsms,$idtahun)
	{
		$sql = "SELECT nis, id_pelajaran, id_kelas, nilai_ketrampilan, id_tahun, semester  FROM tbl_nilai WHERE nis=? and id_pelajaran=? and id_kelas=? and id_tahun=? and semester=?";
		return $this->db->query($sql,array($nis,$id_pel,$idkelas,$idtahun,$idsms));
	}

	function get_jml_nilai2($nis,$idkelas,$idsms,$idtahun)
	{
		$sql = "SELECT SUM(nilai_ketrampilan) AS jumlah_nilai FROM tbl_nilai WHERE nis=? and id_kelas=? and id_tahun=? and semester=?";
		return $this->db->query($sql,array($nis,$idkelas,$idtahun,$idsms));
	}

	function get_kelas_walikelas($idguru,$idthn)
	{
		$sql = "SELECT kelas.id_kelas,kelas.nama_kelas FROM setup_kelas kelas JOIN tbl_wali wali ON kelas.id_kelas=wali.id_kelas WHERE wali.id_guru=? AND wali.id_tahun=? ORDER BY kelas.nama_kelas ASC";
		return $this->db->query($sql,array($idguru,$idthn));
	}


	//-------------------------------------------------------------------------------

}
