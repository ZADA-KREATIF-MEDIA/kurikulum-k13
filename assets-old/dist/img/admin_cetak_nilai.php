<html><head>
<script language="Javascript1.2">
  <!--
  function printpage() {
  window.print();
  }
  //-->
</script>
</head>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<style rel="stylesheet" type="text/css">
td {
	padding:2px;
	padding-left:4px;
}
 font-color:#000;
.garis {
	 border:3px solid #000;
	padding:2px;
 }
</style>
<body onload="printpage()">
<?php
include "conn.php";
include "id_tahun.php";
		  //bio siswa sesuai get ID
			$id = $_GET['id'];
			$semester = $_GET['semester'];
			$id=strip_tags($id);
			$data_siswa=mysql_fetch_array(mysql_query("select * from data_siswa where nis='$id'"));
			$data_kelamin=$data_siswa['kelamin'];
			$data_nama_lengkap =$data_siswa['nama_siswa'];
			$data_nis =$data_siswa['nis'];
			$data_nisn =$data_siswa['nisn'];
			$data_alamat_siswa =$data_siswa['alamat_siswa'];
			$data_telpon_siswa =$data_siswa['telpon_siswa'];
			$data_status_alumni =$data_siswa['status'];
			
			if($data_kelamin=='L'){
			$img="dist/img/pria.png";
			}else{
			$img="dist/img/putri.jpg";
			}
			echo"<title>Cetak Siswa ".$id."</title>";
			//kelas siswa sesuai tahun aktif sekarang
			$view_kls=mysql_query("select setup_kelas.id_kelas, setup_kelas.nama_kelas, setup_kelas.kategori_kls, tbl_ruangan.nis, tbl_ruangan.id_kelas, tbl_ruangan.id_tahun from setup_kelas, tbl_ruangan where tbl_ruangan.nis='$id' and tbl_ruangan.id_kelas=setup_kelas.id_kelas and tbl_ruangan.id_tahun=$id_tahun");
			$row_kls=mysql_fetch_row($view_kls);
			$data_tampil_kelas = $row_kls[1];
			$data_tampil_id_kelas = $row_kls[0];
			$kategori_kls = "$row_kls[2]";
?>

<section class="content">
<!-- Content Header (Page header) -->
<div class="row">
		<div class="col-md-12">
            <table style="border-bottom:3px solid #000;">
			<tr><td width=15%>
			<img src="dist/img/logo_muhammadiyah.jpg" width=100%>
			</td>
			<td><center>
			<b>PIMPIPINAN DAERAH MUHAMMADIYAH KOTA YOGYAKARTA<BR>
			MAJELIS PENDIDIKAN DASAR DAN MENENGAH</b>
			<h3>SMA MUHAMMADIYAH 3 YOGYAKARTA</h3>
			<b>TERAKREDITASI A TAHUN 2013</b><br>
			<small>
			Kampus I : Jalan Kapten Piere Tedean 58, Wirobrajan, Yogyakarta 55252<br>
			Kampus II : Jalan Wates Km.2 Kadipiro, Kasihan, Bantul, Yogyakarta<br>
			Kampus III : Jalan Kapten Piere Tedean, Gang Sadewa No.6, Ketanggunangan, Wirobrajan Yogyakarta 55252<br>
			Telp. (0274) 376901, Telp/Fax (0274) 389976, Web : www.smamuh3jogja.sch.id E-mail : smamuh3yogya@yahoo.com
			</small><br><br>
			</center>
			</td>
			</tr>
			</table>
			 </div>
</div>
<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">
		 <center><h4>LAPORAN</h4>
		 <b>HASIL ULANGAN SEMESTER</b>
		 </center><br>
		<table border=0 align=center width=100%>
			<tr>
			<td width=10%>Nama</td><td width=40%>: <?php echo $data_nama_lengkap;?> </td><td width=15%>Kelas/Semester</td><td width=35%>: <?php echo $data_tampil_kelas; ?> / <?php  echo $semester; ?></td>
			</tr>
			<tr>
			<td width=10%>No. Induk</td><td width=40%>: <?php echo $data_nis; ?></td><td width=15%>Tahun pelajaran</td><td width=35%>: <?php echo $tahun_ajaran; ?></td>
			</tr>
			</table>
		 
		</div>
		<div class="col-md-1"></div>
		<br> 
</div>
<!-- Main content -->
<div class="row">
			<div class="col-md-1"></div>
            <div class="col-md-10">
				<!-- hasil nilai mulai --><?php
				//untuk judul kategori nilai
				$tabel_jdl_kat=mysql_query("select id_kategori, kategori from tbl_kategori_nilai where id_kategori=1 or id_kategori=4 order by id_kategori asc");
				$jum_colspan = mysql_num_rows($tabel_jdl_kat);
				 ?>
				<table border=1 cellspacing=0 cellpadding=0 width=100%>
				<thead>
				 <tr bgcolor=#fafafa>
				  <th rowspan=2>
				   <center>No. 
				  </th>
				  <th rowspan=2>
				    <center>Mata Pelajaran 
				  </th>
				  <th rowspan=2>
				    <center>KKM 
				  </th>
				  <th colspan=<?php echo $jum_colspan;?>>
				    <center>Nilai 
				  </th>
				  <th  rowspan=2>
				   <center> Keterangan 
				  </th>
				 </tr>
				
				 <tr>
				   <?php
					  	//menampilkan judul kategori
						while($jdl_kat=mysql_fetch_array($tabel_jdl_kat)){
						echo "<th bgcolor=#f4f4f4> <center>".$jdl_kat['kategori']."</th>"; 
						}
					  ?>
				 </tr>
				  </thead>
			 <?php
			 //perulangan nilai
				$view_mapel=mysql_query("select id_pelajaran,nama_pelajaran  from setup_pelajaran order by id_pelajaran asc");
				$i = 1;
				while($row_mapel=mysql_fetch_array($view_mapel)){	  
				?>
				 <tr>
				  <td> <center>
				   <?php echo"$i";?>
				  </td>
				  <td>
				   <?php echo"$row_mapel[nama_pelajaran]";?>
				  </td>
				  <td><center>
				  <?php 
				  //KKM
				   $view_kkm=mysql_query("select tbl_kkm.id_tahun, tbl_kkm.id_pelajaran, tbl_kkm.kategori_kls, tbl_kkm.kkm from tbl_kkm where tbl_kkm.id_pelajaran=$row_mapel[id_pelajaran] and tbl_kkm.id_tahun='$id_tahun' and tbl_kkm.kategori_kls like '$kategori_kls'");
					$tot_jum_kkm = mysql_num_rows($view_kkm);
					if ($tot_jum_kkm <= 0)
					{
						echo"-";
					}
					else{
					$data_kkm = mysql_fetch_row($view_kkm);
					echo $data_kkm[3];
					}
					?>
				  </td>
<?php
					//sub query cari id per kategori
					$sql_kat_nilai = mysql_query("select id_kategori, kategori from tbl_kategori_nilai  where id_kategori=1 or id_kategori=4 order by id_kategori asc");
					while($row_kat_nilai = mysql_fetch_array($sql_kat_nilai)){
						//sub cari nilai di tabel nilai dgn id kategori dan semester
						$view_nilai = mysql_query("SELECT nis, id_pelajaran, id_kelas, nilai, id_kategori, id_tahun,semester  FROM tbl_nilai WHERE nis='$data_nis' and id_pelajaran='$row_mapel[id_pelajaran]' and id_kelas='$data_tampil_id_kelas' and id_kategori='$row_kat_nilai[0]' and id_tahun='$id_tahun'  and semester='$semester'");
						$nilai_ok = mysql_fetch_array($view_nilai);
						$nilai_fik = $nilai_ok['3'];
						echo "<td align=center>".$nilai_fik."  </td>"; 
						}
						 
								?>				  

				  <td>
				   
				  </td>
				 </tr>
				<?
				$i++;
				}
				?>
				 <tr>
				  <td colspan=3>
				   JUMLAH
				  </td>
				  <td>
				   &nbsp; 
				  </td>
				  <td>
				   &nbsp; 
				  </td>
				  <td>
				   &nbsp; 
				  </td>
				
				 
				 </tr>
				</table>
		</div>
		<div class="col-md-1"></div>
</div>
<br>
<!-- KEHADIRAN !-->
	<?php
	$view_kehadiran=mysql_query("SELECT tbl_kehadiran.nis, tbl_kehadiran.id_kelas, tbl_kehadiran.id_tahun, tbl_kehadiran.semester, tbl_kehadiran.sakit, tbl_kehadiran.izin, tbl_kehadiran.tnp_ket, tbl_kehadiran.terlambat, tbl_kehadiran.meninggalkan_sek, tbl_kehadiran.tdk_upacara, tbl_kehadiran.pm_s, tbl_kehadiran.pm_i, tbl_kehadiran.pm_a, tbl_kehadiran.pm_t FROM tbl_kehadiran WHERE tbl_kehadiran.nis='$id' AND  tbl_kehadiran.id_kelas='$data_tampil_id_kelas' AND tbl_kehadiran.id_tahun='$id_tahun' AND tbl_kehadiran.semester='$semester'");
	$cek_kehadiran=mysql_num_rows($view_kehadiran);
	if($cek_kehadiran==0){
		echo"<h5>Data kehadiran siswa ini belum di entry</h5>";
	}
	else {
	while($row_hadir=mysql_fetch_array($view_kehadiran)){
	?>
<div class="row">	
		<div class="col-md-1"></div>
		<div class="col-md-10"><b>KETIDAKHADIRAN</b></div>
		<div class="col-md-1"></div>
</div>
<div class="row">

		<div class="col-md-1"></div>
		
		<div class="col-md-10">
		<table border=0 width=100%>
		<tr><td valign=top>
		<table border=1 width=100%>
				 <tr>
				  <td  align=center>
				   No. 
				  </td>
				  <td>
				   <center>Alasan Ketidakhadiran 
				  </td>
				  <td><center>
				   &nbsp; Jumlah 
				  </td>
				 </tr>
				 <tr>
				  <td align=center>
				  1 
				  </td>
				  <td>
				   &nbsp; Sakit 
				  </td>
				  <td align=center>
				     <?php echo $row_hadir['sakit']; ?>
				  </td>
				 </tr>
				 <tr>
				  <td  align=center>
				   2 
				  </td>
				  <td>
				   &nbsp; Izin 
				  </td>
				  <td align=center>
				     <?php echo $row_hadir['izin']; ?>
				  </td>
				 </tr>
				 <tr>
				  <td  align=center>
				   3 
				  </td>
				  <td>
				   &nbsp; Tanpa Keterangan 
				  </td>
				  <td align=center>
				   <?php echo $row_hadir['tnp_ket']; ?>
				  </td>
				 </tr>
				 <tr>
				  <td align=center>
				   4 
				  </td>
				  <td>
				   &nbsp; Terlambat Datang ke Sekolah 
				  </td>
				  <td  align=center>
				   <?php echo $row_hadir['terlambat']; ?>
				  </td>
				 </tr>
				 <tr>
				  <td align=center>
				   5 
				  </td>
				  <td>
				   &nbsp; Meninggalkan Sekolah 
				  </td>
				  <td align=center>
				   <?php echo $row_hadir['meninggalkan_sek']; ?>
				  </td>
				 </tr>
				 <tr>
				  <td align=center>
				   6 
				  </td>
				  <td>
				   &nbsp; Tidak Mengikuti Upacara Bendera 
				  </td>
				  <td align=center>
				   <?php echo $row_hadir['tdk_upacara']; ?>
				  </td>
				 </tr>
				</table>
			</td>
			<td> &nbsp; </td>
			<td valign=top>
				 <table border=1 cellspacing=0 cellpadding=0  width=100%>
				 <tr>
				  <td colspan=4>
				  <center> Ketidakhadiran <br>Pendalaman Materi 
				  </td>
				 </tr>
				 <tr>
				  <td align=center>
				   S 
				  </td>
				  <td align=center>
				   I 
				  </td>
				  <td align=center>
				   A 
				  </td>
				  <td align=center>
				   T 
				  </td>
				 </tr>
				 <tr>
				  <td>
				   <center><?php echo $row_hadir['pm_s']; ?> <br> 
				  </td>
				  <td>
				   <center><?php echo $row_hadir['pm_i']; ?> <br> 
				  </td>
				  <td>
				   <center><?php echo $row_hadir['pm_a']; ?> <br> 
				  </td>
				  <td>
				   <center><?php echo $row_hadir['pm_t']; ?> <br> 
				  </td>
				 </tr>
				</table>
				<small>S = Sakit &nbsp; I = Ijin &nbsp; A = Alpha &nbsp; T = Terlambat</small>
			</td>
			</tr>
			</table>
            </div> 
            <div class="col-md-1"></div>
</div>


<?php
		}
	}
	?>
<br>
<div class="row">	
		<div class="col-md-1"></div>
		<div class="col-md-10">
		Catatan Wali Kelas<br>
		<table border=1 cellspacing=0 cellpadding=0  width=100%>
				 <tr>
				  <td>
				   &nbsp; <br><br><br>
				  </td>
		</tr></table>
		</div>
		<div class="col-md-1"></div>
</div>
<div class="row">	
		<div class="col-md-2"></div>
		<div class="col-md-8">
		<center>
		<table border=0 width=100%>
		<tr><td valign=top>
		<br><br><center>
		Mengetahui,<br>
		Kepala Sekolah<br><br><br><br>
		Drs.H.Herynugroho, M.Pd.<br>
		NIP 19651221 199003 1 005
		 </td><td valign=top><center>
		<br> Yogyakarta, 24 Oktober 2015<br><br>
		Wali Kelas,<br><br><br><br>
		<?php
		$cetak_wali=mysql_fetch_array(mysql_query("select tbl_wali.id_guru, tbl_wali.id_tahun, tbl_wali.id_kelas, data_guru.id_guru, data_guru.nama_guru,data_guru.nip from tbl_wali,data_guru where tbl_wali.id_guru=data_guru.id_guru and tbl_wali.id_tahun=$id_tahun and tbl_wali.id_kelas=$data_tampil_id_kelas"));
		$cetak_wali_nama =$cetak_wali['4'];
		$cetak_wali_nik =$cetak_wali['5'];
		echo $cetak_wali_nama; ?>
		<br>
		NBM <?php echo $cetak_wali_nik;?>
		</td></tr></table>
		</center>
		</div>
		<div class="col-md-2"></div>
</div>
	
  </section><!-- /.content -->
     