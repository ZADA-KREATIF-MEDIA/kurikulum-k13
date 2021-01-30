<?php
/**
| Application Name : SINO 2018
| By : watulintang.com
*/
class M_admin extends CI_Model{

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

function set_on_semester($id_semester)
{
	$dataon = array('status_semester' => 1);
	$dataoff = array('status_semester' => 0);
	$where1 = "id_semester=$id_semester";
	$where2 = "id_semester!=$id_semester";

	$this->db->update('setup_semester',$dataon,$where1);
	$this->db->update('setup_semester',$dataoff,$where2);
}

function pembagian_wali_kelas($id_tahun)
{
	$this->db->select('tbl_wali.id_wali, tbl_wali.id_guru, tbl_wali.id_tahun, tbl_wali.id_kelas, data_guru.id_guru, data_guru.nama_guru, data_guru.nip, setup_tahun.id_tahun, setup_tahun.tahun, setup_kelas.id_kelas, setup_kelas.nama_kelas');
	 $this->db->from('tbl_wali');
	 $this->db->join('data_guru', 'tbl_wali.id_guru=data_guru.id_guru');
	 $this->db->join('setup_tahun', 'tbl_wali.id_tahun=setup_tahun.id_tahun');
	 $this->db->join('setup_kelas', 'tbl_wali.id_kelas=setup_kelas.id_kelas');
	 $this->db->where('tbl_wali.id_tahun',$id_tahun);
	 $this->db->order_by('setup_kelas.nama_kelas','ASC');
	 return $this->db->get();
}

function wali_kelas_wp($id_tahun,$limit,$start)
{
	$this->db->select('tbl_wali.id_wali, tbl_wali.id_guru, tbl_wali.id_tahun, tbl_wali.id_kelas, data_guru.id_guru, data_guru.nama_guru, data_guru.nip, setup_tahun.id_tahun, setup_tahun.tahun, setup_kelas.id_kelas, setup_kelas.nama_kelas');
	 $this->db->from('tbl_wali');
	 $this->db->join('data_guru', 'tbl_wali.id_guru=data_guru.id_guru');
	 $this->db->join('setup_tahun', 'tbl_wali.id_tahun=setup_tahun.id_tahun');
	 $this->db->join('setup_kelas', 'tbl_wali.id_kelas=setup_kelas.id_kelas');
	 $this->db->where('tbl_wali.id_tahun',$id_tahun);
	 $this->db->order_by('setup_kelas.nama_kelas','ASC');
	 $this->db->limit($limit, $start);
	 return $this->db->get();
}

function jadwal_guru_mengajar($where)
{
	$this->db->select('jadwal.id_jadwal,guru.nama_guru,guru.nip,pelajaran.nama_pelajaran,kelas.nama_kelas,semester.semester,tahun.tahun');
	$this->db->from('tbl_jadwal AS jadwal');
	$this->db->join('setup_kelas AS kelas', 'kelas.id_kelas=jadwal.id_kelas');
	$this->db->join('setup_pelajaran AS pelajaran', 'pelajaran.id_pelajaran=jadwal.id_pelajaran'); 
	$this->db->join('data_guru AS guru', 'guru.id_guru=jadwal.id_guru');
	$this->db->join('setup_tahun AS tahun','tahun.id_tahun=jadwal.id_tahun','left');
	$this->db->join('setup_semester AS semester','semester.id_semester=jadwal.id_semester','left');
	$this->db->where($where);
	$this->db->order_by('jadwal.id_jadwal', 'ASC');
	return $this->db->get();
}

function jadwal_guru_wp($where,$limit,$start)
{
	$this->db->select('jadwal.id_jadwal,guru.nama_guru,guru.nip,pelajaran.nama_pelajaran,kelas.nama_kelas,semester.semester,tahun.tahun');
	$this->db->from('tbl_jadwal AS jadwal');
	$this->db->join('setup_kelas AS kelas', 'kelas.id_kelas=jadwal.id_kelas');
	$this->db->join('setup_pelajaran AS pelajaran', 'pelajaran.id_pelajaran=jadwal.id_pelajaran'); 
	$this->db->join('data_guru AS guru', 'guru.id_guru=jadwal.id_guru');
	$this->db->join('setup_tahun AS tahun','tahun.id_tahun=jadwal.id_tahun','left');
	$this->db->join('setup_semester AS semester','semester.id_semester=jadwal.id_semester','left');
	$this->db->where($where);
	$this->db->order_by('jadwal.id_jadwal', 'ASC');
	$this->db->limit($limit,$start);
	return $this->db->get();
}

function get_mapel_persiswa($urut_kat_kelas)
{
	$this->db->select('id_pelajaran,nama_pelajaran');
	$this->db->from('setup_pelajaran');
	//$this->db->where($urut_kat_kelas.' !=0');
	//$this->db->order_by($urut_kat_kelas,'ASC');
	return $this->db->get();
}

function view_kkm_mapel_bysiswa($row_mapel,$id_tahun,$kategori_kls)
{
	$this->db->select('tbl_kkm.id_tahun, tbl_kkm.id_pelajaran, tbl_kkm.kategori_kls, tbl_kkm.kkm');
	$this->db->from('tbl_kkm');
	$this->db->where('tbl_kkm.id_pelajaran='.$row_mapel.' and tbl_kkm.id_tahun='.$id_tahun.'');
	$this->db->like('tbl_kkm.kategori_kls',$kategori_kls);
	return $this->db->get();
}

function get_kelas_siswa($nis,$id_thn)
{
	$this->db->select('setup_kelas.id_kelas, setup_kelas.nama_kelas, setup_kelas.kategori_kls, tbl_ruangan.nis, tbl_ruangan.id_kelas, tbl_ruangan.id_tahun');
	$this->db->from('setup_kelas');
	$this->db->join('tbl_ruangan','tbl_ruangan.id_kelas=setup_kelas.id_kelas');
	$this->db->where('tbl_ruangan.nis='.$this->db->escape($nis).'');
	$this->db->where('tbl_ruangan.id_tahun='.$this->db->escape($id_thn).'');
	return $this->db->get();
}

function get_riwayat_kelas($nis)
{
	$this->db->select('setup_kelas.id_kelas, setup_kelas.nama_kelas,tbl_ruangan.nis, tbl_ruangan.id_kelas, tbl_ruangan.id_tahun, setup_tahun.id_tahun, setup_tahun.tahun');
	$this->db->from('setup_kelas');
	$this->db->join('tbl_ruangan','tbl_ruangan.id_kelas=setup_kelas.id_kelas');
	$this->db->join('setup_tahun','tbl_ruangan.id_tahun=setup_tahun.id_tahun');
	$this->db->where('tbl_ruangan.nis='.$this->db->escape($nis).'');
	$this->db->order_by('tbl_ruangan.id_kelas','ASC');
	return $this->db->get();
}

function data_pembagian_kelas($id_tahun_aktif,$id_kelas)
{
	$this->db->select('tbl_ruangan.id_ruangan, tbl_ruangan.nis, tbl_ruangan.id_kelas, tbl_ruangan.id_tahun, data_siswa.nis, data_siswa.nama_siswa, data_siswa.kelamin, setup_kelas.id_kelas, setup_kelas.nama_kelas');
	$this->db->from('tbl_ruangan');
	$this->db->join('data_siswa', 'tbl_ruangan.nis = data_siswa.nis');
	$this->db->join('setup_kelas', 'tbl_ruangan.id_kelas = setup_kelas.id_kelas');
	$this->db->where('tbl_ruangan.id_tahun='.$this->db->escape($id_tahun_aktif).'');
	$this->db->where('tbl_ruangan.id_kelas='.$this->db->escape($id_kelas).'');
	$this->db->order_by('tbl_ruangan.id_kelas','ASC');
	$this->db->order_by('data_siswa.nama_siswa','ASC');
	$query = $this->db->get();
	return $query;
}

function pembagian_kelas_wp($key1,$key2,$limit,$start)
{
	$this->db->select('tbl_ruangan.id_ruangan, tbl_ruangan.nis, tbl_ruangan.id_kelas, tbl_ruangan.id_tahun, data_siswa.nis, data_siswa.nama_siswa, data_siswa.kelamin, setup_kelas.id_kelas, setup_kelas.nama_kelas');
	$this->db->from('tbl_ruangan');
	$this->db->join('data_siswa', 'tbl_ruangan.nis = data_siswa.nis');
	$this->db->join('setup_kelas', 'tbl_ruangan.id_kelas = setup_kelas.id_kelas');
	$this->db->where('tbl_ruangan.id_tahun='.$this->db->escape($key1).'');
	$this->db->where('tbl_ruangan.id_kelas='.$this->db->escape($key2).'');
	$this->db->order_by('tbl_ruangan.id_kelas','ASC');
	$this->db->order_by('data_siswa.nama_siswa','ASC');
	$this->db->limit($limit, $start);
	$query = $this->db->get();
	return $query;
}


/*function data_mapel_wp($limit,$start)
{
	$this->db->order_by('id_pelajaran','ASC');
	return $this->db->get('setup_pelajaran',$limit,$start);
}*/

function data_kelas_wp($limit,$start)
{
	$this->db->order_by('nama_kelas','ASC');
	return $this->db->get('setup_kelas',$limit,$start);
}

function data_guru_wp($limit,$start)
{
	$this->db->order_by('nama_guru','ASC');
	return $this->db->get('data_guru',$limit,$start);
}

function data_siswa($status)
{
	$this->db->where('status',$status);
	$this->db->order_by('nama_siswa','ASC');
	return $this->db->get('data_siswa');	
}

function data_siswa_wp($key,$limit,$start)
{
	$this->db->where('status',$key);
	$this->db->order_by('nama_siswa','ASC');
	return $this->db->get('data_siswa',$limit,$start);
}

function belum_punya_kelas()
{
	/*$this->db->where('nis', 'NOT IN SELECT nis FROM tbl_ruangan');
	$this->db->order_by('nama_siswa','ASC');
	return $this->db->get('data_siswa');*/
	return $this->db->query("SELECT id_siswa,nis,nama_siswa,kelamin,status FROM data_siswa WHERE nis NOT IN (SELECT nis FROM tbl_ruangan) ORDER BY nama_siswa ASC");
}

function get_data_kepsek($idtahun)
{
	$this->db->select('kepsek.id_kepsek,guru.nama_guru,guru.nip,thn.tahun,sms.semester');
	$this->db->from('tbl_kepsek kepsek');
	$this->db->join('data_guru guru','guru.id_guru=kepsek.id_guru');
	$this->db->join('setup_tahun thn','thn.id_tahun=kepsek.id_tahun');
	$this->db->join('setup_semester sms','sms.id_semester=kepsek.id_semester');
	return $this->db->get();
}

function data_kepsek_wp($key,$limit,$start)
{
	$this->db->select('kepsek.id_kepsek,guru.nama_guru,guru.nip,thn.tahun,sms.semester');
	$this->db->from('tbl_kepsek kepsek');
	$this->db->join('data_guru guru','guru.id_guru=kepsek.id_guru');
	$this->db->join('setup_tahun thn','thn.id_tahun=kepsek.id_tahun');
	$this->db->join('setup_semester sms','sms.id_semester=kepsek.id_semester');
	$this->db->where('kepsek.id_tahun',$key);
	$this->db->limit($limit,$start);
	return $this->db->get();
}

/*function ref_data_siswa_wp($key,$limit,$start)
{
	$this->db->where('status',$key);
	$this->db->order_by('nama_siswa','ASC');
	return $this->db->get('data_siswa',$limit,$start);
}*/


function search_product($what){
			$where = "";
			$key_split = preg_split('/[\s]+/', $what);
			$tot_key = count($key_split);

			foreach($key_split as $key=>$kunci){
				$where .= "nm_produk LIKE '%$kunci%'";
				if($key != ($tot_key - 1)){
					$where .= " AND ";
				}
				}
				return $this->db->query("SELECT * FROM produk WHERE $where ");
}


function get_selected_data($post = array(),$table,$cols)
	{
		$total_array = count($post);
		if($total_array != 0)
		{
			$this->db->select("*");
			$this->db->where_in($cols, $post['check']);
			return $this->db->get($table);
		}
	}

function del_selected_data($post = array(),$table,$cols)
	{
		$total_array = count($post);
		if($total_array != 0)
		{
			$this->db->where_in($cols, $post['check']);
			return $this->db->delete($table);
		}
	}

function update_selected_data($post = array(),$table,$cols,$data)
	{
		$total_array = count($post);
		if($total_array != 0)
		{
			$this->db->where_in($cols, $post['check']);
			return $this->db->update($table,$data);
		}
	}

function set_tahun_on($post = array())
{
	$total_array = count($post);
		if($total_array != 0)
		{
			$check = $post['check'];
			$jml = count($check);
			$id_tahun = $check['0']; //array dimulai dari 0, ambil data ke-0

			$sql = "UPDATE setup_tahun SET status_aktif=1 WHERE id_tahun=?";
			$sql2 = "UPDATE setup_tahun SET status_aktif=0 WHERE id_tahun!=?";
					
			if($this->db->query($sql,array($id_tahun))){echo $this->db->error();}
			if($this->db->query($sql2,array($id_tahun))){echo $this->db->error();}
			
		}
}

function select_pembagian_kelas($post = array())
{
	$total_array = count($post);
	if($total_array != 0)
		{

			$check = $post['check'];
			$jml = count($check);
			//////////////////////////////////////////
			//Memecah data dan mengambil data nis saja 
			//[0]:id_ruangan | [1]:nis
			/////////////////////////////////////////
			//mengambil data array 1;
			$pisah = explode('-',$check['0']);
			$where = "nis='$pisah[1]' AND id_kelas='$post[kelas]' AND id_tahun='$post[tahun]'";
			$this->db->where($where);
			
			//mengambil data array 2, dst;
			for($i=1;$i<$jml;$i++)
			{
				$pisah = explode('-',$check[$i]);
				$where = "nis='$pisah[1]' AND id_kelas='$post[kelas]' AND id_tahun='$post[tahun]'";
				$this->db->or_where($where);
			}
			
			return $this->db->get('tbl_ruangan');
	}
}

function set_pembagian_kelas($post = array())
{
	$total_array = count($post);
	if($total_array != 0)
		{
			
			$check = $post['check'];
			$jml = count($check);
			
			for($i=0;$i<$jml;$i++)
			{
				//Memecah data dan menyimpannya ke dalam array yang berisi nis saja
				$pisah = explode('-',$check[$i]);
				$data[$i]['nis'] = $pisah['1']; //[0]:id_ruangan, [1]:nis
				$data[$i]['id_kelas'] = $post['kelas'];
				$data[$i]['id_tahun'] = $post['tahun'];
			}
			
			return $this->db->insert_batch('tbl_ruangan',$data);
			
		}
}

function hapus_siswa_dari_kelas($post = array(),$table,$cols)
	{
		$total_array = count($post);
		$check = $post['check'];
		if($total_array != 0)
		{
			for($i=0;$i<$total_array;$i++)
			{
				//Memecah data dan menyimpannya ke dalam array yang berisi id_ruangan saja
				$pisah = explode('-',$check[$i]);
				$dataid[$i] = $pisah['0']; //[0]:id_ruangan, [1]:nis
			}

			$this->db->where_in($cols, $dataid);
			return $this->db->delete($table);
		}
}

function get_list_mapel()
{
	$this->db->select('*');
	$this->db->from('setup_pelajaran');
	return $this->db->get();
}

function select_mapel_notset_kkm($idthn,$katkel)
{
	$sql = "SELECT * FROM setup_pelajaran WHERE id_pelajaran NOT IN (SELECT id_pelajaran FROM tbl_kkm WHERE id_tahun=? AND kategori_kls=?)";
	return $this->db->query($sql,array($idthn,$katkel));
}

function select_tbl_kkm($idthn,$kat_kls)
{
	$this->db->select('kkm.id_kkm,kkm.id_tahun,kkm.id_pelajaran,pelajaran.nama_pelajaran,kkm.kategori_kls,kkm.kkm');
	$this->db->from('tbl_kkm kkm');
	$this->db->join('setup_pelajaran pelajaran','kkm.id_pelajaran=pelajaran.id_pelajaran','right');
	$this->db->where("kkm.id_tahun=$idthn AND kkm.kategori_kls='$kat_kls'");
	return $this->db->get();
}


	function select_dataFrom($table){
		return $this->db->get($table);
	}

	function select_dataWhere($where,$table){
		return $this->db->get_where($table,$where);
	}

	function select_table_orderby($order,$table)
	{
		$this->db->select('*');
		$this->db->order_by($order);
		$result = $this->db->get($table);
		return $result;
	}

	function update_dataTable($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	function delete_dataTable($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
	}

	function insert_dataTo($data,$table){
		$this->db->insert($table,$data);
	}

	function update_multi_data($data = array(),$table){
		$insert = $this->db->insert_batch($table,$data);
		return $insert?true:false;
	}

/* DATA POST */
function get_data_tulisan()
{
	$this->db->select('post.id_post,post.tgl_post,post.type_post,post.judul_post,post.privacy_post,author.nama_admin AS author');
	$this->db->from('tbl_post post');
	$this->db->join('user_admin author', 'author.id_admin=post.author_post','left');
	$this->db->order_by('post.tgl_post DESC');
	return $this->db->get();
}
	

/* == EDIT NILAI SISWA == */
function get_guru_sesuai($where)
{
	$this->db->select('jadwal.id_guru,guru.nama_guru');
	$this->db->from('tbl_jadwal jadwal');
	$this->db->join('data_guru guru','guru.id_guru=jadwal.id_guru');
	$this->db->where($where);
	$this->db->order_by('guru.nama_guru ASC');
	return $this->db->get();
}

function get_siswa_pk($idkelas,$idtahun)
{
	$sql = "SELECT * FROM tbl_ruangan ruangan, data_siswa siswa WHERE ruangan.nis=siswa.nis and ruangan.id_kelas=? and ruangan.id_tahun=? order by siswa.nis ASC";
		return $this->db->query($sql,array($idkelas,$idtahun));
}

function get_nilai_pk($where_pk)
{
	$this->db->select('*');
	$this->db->from('tbl_nilai nilai');
	$this->db->join('data_siswa siswa','nilai.nis=siswa.nis');
	$this->db->where($where_pk);
	$this->db->order_by('siswa.nis','ASC');
	return $this->db->get();
}

function list_deskripsi_nilai($where)
	{
		$this->db->select('nilai.id_nilai AS idnilai,nilai.nis,siswa.nama_siswa,nilai.nilai_pengetahuan,nilai.nilai_ketrampilan,deskripsi.pengetahuan,deskripsi.ketrampilan,nilai.id_kelas,nilai.id_pelajaran');
		$this->db->from('tbl_nilai nilai');
		$this->db->join('data_siswa siswa','nilai.nis=siswa.nis');
		$this->db->join('tbl_deskripsi_nilai deskripsi','nilai.id_nilai=deskripsi.id_nilai','left');
		$this->db->where($where);
		$this->db->order_by('siswa.nis', 'asc');
		return $this->db->get();
	}
//===============
	function get_wali_sesuai($idthn,$idkelas)
	{
		$this->db->select('wali.id_wali,guru.nama_guru');
		$this->db->from('tbl_wali wali');
		$this->db->join('data_guru guru','guru.id_guru=wali.id_guru');
		$this->db->where('wali.id_tahun='.$idthn.'');
		$this->db->where('wali.id_kelas='.$idkelas.'');
		$this->db->order_by('guru.nama_guru','ASC');
		return $this->db->get();
	}

	function list_siswa_sikap($id_kelas,$id_tahun)
	{
		$sql = "SELECT tbl_ruangan.nis, tbl_ruangan.id_kelas, tbl_ruangan.id_tahun, data_siswa.nis, data_siswa.nama_siswa, data_siswa.kelamin, setup_kelas.nama_kelas FROM tbl_ruangan, data_siswa, setup_kelas WHERE tbl_ruangan.id_kelas=? AND  tbl_ruangan.id_tahun=? AND tbl_ruangan.nis=data_siswa.nis AND tbl_ruangan.id_kelas=setup_kelas.id_kelas ORDER by data_siswa.nis ASC";

		return $this->db->query($sql,array($id_kelas,$id_tahun));
	}

	function list_nilai_sikap($id_kelas,$id_tahun,$semester)
	{
		$sql = "SELECT siswa.nis, siswa.nama_siswa, siswa.kelamin, sikap.id_sikap,sikap.nis, sikap.id_kelas, sikap.id_tahun, sikap.id_semester, sikap.predikat_spiritual, sikap.sikap_spiritual, sikap.predikat_sosial, sikap.sikap_sosial FROM  data_siswa AS siswa,tbl_nilai_sikap AS sikap WHERE siswa.nis=sikap.nis AND  sikap.id_kelas=? AND sikap.id_tahun=? AND sikap.id_semester=? ORDER BY siswa.nis ASC";

		return $this->db->query($sql,array($id_kelas,$id_tahun,$semester));
	}

	//=========EKSTRA
	function data_siswa_dikelas($id_kelas,$id_tahun)
	{
		$sql = "SELECT tbl_ruangan.nis, tbl_ruangan.id_kelas, tbl_ruangan.id_tahun, data_siswa.nama_siswa FROM tbl_ruangan, data_siswa WHERE tbl_ruangan.id_kelas=? AND  tbl_ruangan.id_tahun=? AND tbl_ruangan.nis=data_siswa.nis ORDER by data_siswa.nis ASC";

		return $this->db->query($sql,array($id_kelas,$id_tahun));
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

	//======PRESTASI
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

	//-----KEHADIRAN
	function get_siswa_bkhadir($id_kelas,$id_tahun)
	{
		$sql = "SELECT tbl_ruangan.nis, tbl_ruangan.id_kelas, tbl_ruangan.id_tahun, data_siswa.nis, data_siswa.nama_siswa, data_siswa.kelamin, setup_kelas.nama_kelas FROM tbl_ruangan, data_siswa, setup_kelas WHERE tbl_ruangan.id_kelas=? AND  tbl_ruangan.id_tahun=? AND tbl_ruangan.nis=data_siswa.nis AND tbl_ruangan.id_kelas=setup_kelas.id_kelas ORDER by data_siswa.nis ASC";

		return $this->db->query($sql,array($id_kelas,$id_tahun));
	}

	function get_data_bkhadir($id_kelas,$id_tahun,$semester)
	{
		$sql = "SELECT data_siswa.nis, data_siswa.nama_siswa, data_siswa.kelamin, tbl_kehadiran.nis, tbl_kehadiran.id_kelas, tbl_kehadiran.id_tahun, tbl_kehadiran.semester, tbl_kehadiran.sakit, tbl_kehadiran.izin, tbl_kehadiran.tnp_ket, tbl_kehadiran.terlambat, tbl_kehadiran.meninggalkan_sek, tbl_kehadiran.tdk_upacara, tbl_kehadiran.pm_s, tbl_kehadiran.pm_i, tbl_kehadiran.pm_a, tbl_kehadiran.pm_t FROM  data_siswa,tbl_kehadiran WHERE data_siswa.nis=tbl_kehadiran.nis AND  tbl_kehadiran.id_kelas=? AND tbl_kehadiran.id_tahun=? AND tbl_kehadiran.semester=? ORDER BY data_siswa.nis ASC";

		return $this->db->query($sql,array($id_kelas,$id_tahun,$semester));
	}

	
	//nilai pengethaun

	function get_nilai_mapel($nis,$id_pel,$idkelas,$idsms,$idtahun)
	{
		$sql = "SELECT nis, id_pelajaran, id_kelas, nilai_pengetahuan, id_tahun, semester  FROM tbl_nilai WHERE nis=? and id_pelajaran=? and id_kelas=? and id_tahun=? and semester=?";
		return $this->db->query($sql,array($nis,$id_pel,$idkelas,$idtahun,$idsms));
	}

	function get_jml_nilai($nis,$idkelas,$idsms,$idtahun)
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


//Laporan Legger Siswa
function laporan_legger_nilai()
{
	//tbl_nilai
	$this->db->select('siswa.nis,siswa.nama_siswa,nilai.nilai_pengetahuan,nilai.nilai_ketrampilan,pelajaran.nama_pelajaran');
	$this->db->from('tbl_nilai nilai');
	$this->db->join('data_siswa siswa','siswa.nis=nilai.nis');
	$this->db->join('setup_pelajaran pelajaran','pelajaran.id_pelajaran=nilai.id_pelajaran');
}

function laporan_nilai_siswa($idkelas,$idtahun,$idsms)
{
	$this->db->select('DISTINCT(nilai.nis),siswa.nama_siswa,siswa.kelamin,kelas.nama_kelas,nilai.id_kelas,nilai.id_tahun,nilai.semester');
	$this->db->from('tbl_nilai nilai');
	$this->db->join('data_siswa siswa','siswa.nis=nilai.nis');
	$this->db->join('setup_kelas kelas','kelas.id_kelas=nilai.id_kelas');
	$this->db->where('nilai.id_kelas='.$idkelas.' AND nilai.id_tahun='.$idtahun.' AND nilai.semester='.$idsms.'');
	$this->db->order_by('siswa.nama_siswa ASC');
	return $this->db->get();
}
/*----------- Siswa ----------*/
	public function detail_siswa($id)
	{
		$this->db->select()
			->from('data_siswa')
			->where('id_siswa',$id);
		$query = $this->db->get_compiled_select();
		$data = $this->db->query($query)->row_array();
		return $data;
	}
/*----------- Ekstrakulikuler -----------*/
	public function update_extra($post)
	{
		$this->db->select()
			->from('ekstrakurikuler')
			->where("id_ekstra", $post['id_ekstra']);
		$query = $this->db->set($post)->get_compiled_update();
		$this->db->query($query);
		return true;	
	}

	public function get_detail_ekstra($id)
	{
		$this->db->select()
			->from('ekstrakurikuler')
			->where("id_ekstra", $id);
		$query = $this->db->get_compiled_select();
		$data  = $this->db->query($query)->row_array();
		return $data;
	}

/*---------- Kelas ----------*/
	public function get_kelas()
	{
		$this->db->select()
			->from('setup_kelas')
			->order_by('nama_kelas');
		$query 	= $this->db->get_compiled_select();
		$data 	= $this->db->query($query)->result_array();
		return $data;

	}
	public function get_detail_kelas($id)
	{
		$this->db->select()
			->from('setup_kelas')
			->where("id_kelas", $id);
		$query = $this->db->get_compiled_select();
		$data  = $this->db->query($query)->row_array();
		return $data;
	}

	public function update_kelas($post)
	{
		$this->db->select()
			->from('setup_kelas')
			->where("id_kelas", $post['id_kelas']);
		$query = $this->db->set($post)->get_compiled_update();
		$this->db->query($query);
		return true;	
	}
/*--------- Tahun Ajaran ----------*/
	public function m_get_aktif_tahun_ajaran()
	{
		$this->db->select()
			->from('setup_tahun')
			->where("status_aktif",1);
		$query = $this->db->get_compiled_select();
		$data = $this->db->query($query)->result_array();
		return $data;
	}
	public function status_tahun_all_off()
	{
		$post = [
			'status_aktif' => 0
		];
		$this->db->select()
			->from('setup_tahun');
		$query = $this->db->set($post)->get_compiled_update();
		// print('<pre>');print_r($query);exit();
		$this->db->query($query);
		return true;	
	}

	public function update_tahun($post)
	{
		$this->db->select()
			->from('setup_tahun')
			->where("id_tahun", $post['id_tahun']);
		$query = $this->db->set($post)->get_compiled_update();
		$this->db->query($query);
		return true;
	}
/*---------- Mata Pelajaran ---------*/
	public function update_mata_pelajaran($post)
	{
		$this->db->select()
			->from('setup_pelajaran')
			->where('id_pelajaran', $post['id_pelajaran']);
		$query = $this->db->set($post)->get_compiled_update();
		$this->db->query($query);
		return true;
	}
/*---------- Tinggi dan Berat ----------*/
	public function m_get_siswa()
	{
		$this->db->select('id_siswa, nama_siswa')
			->from('data_siswa');
		$query = $this->db->get_compiled_select();
		$data = $this->db->query($query)->result_array();
		return $data;
	}

	public function m_get_siswa_tinggi_berat()
	{
		$this->db->select('a.id,a.tinggi_badan,a.berat_badan,b.nama_siswa')
			->from('tbl_berat_tinggi AS a')
			->join('data_siswa AS b','a.id_siswa=b.id_siswa');
		$query = $this->db->get_compiled_select();
		$data = $this->db->query($query)->result_array();
		return $data;	
	}

	public function m_store_berat_tinggi($post)
	{
		$this->db->insert('tbl_berat_tinggi', $post);
        return true;
	}

	public function m_get_detail_siswa($id)
	{
		$this->db->select('a.id, a.id_siswa, a.tinggi_badan, a.berat_badan, b.nama_siswa')
			->from('tbl_berat_tinggi AS a')
			->join('data_siswa AS b','a.id_siswa=b.id_siswa')
			->where('a.id',$id);
		$query = $this->db->get_compiled_select();
		$data = $this->db->query($query)->row_array();
		return $data;
	}

	public function m_update_berat_tinggi($post)
	{
		$this->db->select()
            ->from('tbl_berat_tinggi')
            ->where("id", $post['id']);
        $query = $this->db->set($post)->get_compiled_update();
        $this->db->query($query);
        return true;	
	}

	public function m_hapus_berat_tinggal($id)
	{
		$this->db->select()
			->from('tbl_berat_tinggi')
			->where("id", $id);
		$query = $this->db->get_compiled_delete();
		$this->db->query($query);
		return true;
	}
}
