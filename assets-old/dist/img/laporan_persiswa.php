<?php
include "id_tahun.php";
?>
<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Detail Siswa
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Laporan Nilai</a></li>
             <li><a href="?page=laporan_sort_persiswa">Sort Siswa</a></li>
            <li class="active">Detail Siswa</li>
          </ol>
        </section>
			<?php
			//bio siswa sesuai get ID
			$id = $_GET['id'];
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
			//kelas siswa sesuai tahun aktif sekarang
			$view_kls=mysql_query("select setup_kelas.id_kelas, setup_kelas.nama_kelas, setup_kelas.kategori_kls, tbl_ruangan.nis, tbl_ruangan.id_kelas, tbl_ruangan.id_tahun from setup_kelas, tbl_ruangan where tbl_ruangan.nis='$id' and tbl_ruangan.id_kelas=setup_kelas.id_kelas and tbl_ruangan.id_tahun=$id_tahun");
			$row_kls=mysql_fetch_array($view_kls);
			$data_tampil_kelas = $row_kls[1];
			$data_tampil_id_kelas = $row_kls[0];
			$kategori_kls = $row_kls[2];
?>
        <!-- Main content -->
        <section class="content">
		<div class="row">
            <div class="col-md-3">

              <!-- Profile Image -->
              <div class="box box-success">
                <div class="box-body box-profile">
                  <img class="profile-user-img img-responsive img-circle" src="<?php echo $img; ?>" alt="User siswa picture">
                  <h3 class="profile-username text-center"><?php echo $data_nama_lengkap;?> </h3>
                  <p class="text-muted text-center">Status : <?php if($data_status_alumni==0){ echo"Alumni";} else { echo"Siswa Aktif";}?></small></p>

                  <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                      <b>NIS</b> <a class="pull-right"><b><?php echo $data_nis; ?></b></a>
                    </li>
					 <li class="list-group-item">
                      <b>NISN</b> <a class="pull-right"><b><?php echo $data_nisn; ?></b></a>
                    </li>
                    <li class="list-group-item">
                      <b>Kelas</b> <a class="pull-right"><b><?php echo $data_tampil_kelas; ?></b></a>
                    </li>
                    <li class="list-group-item">
                      <b>Tahun Pelajaran</b> <a class="pull-right"><b><?php echo $tahun_ajaran; ?></b></a>
                    </li>
                  </ul>
				  </div><!-- /.box-body -->
              </div><!-- /.box -->

              <!-- About Me Box -->
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Biodata siswa</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				  <strong><i class="fa fa-map-marker margin-r-5"></i>Alamat</strong>
                  <p class="text-muted">
                    <?php echo $data_alamat_siswa; ?> 
                  </p>
				  <strong><i class="fa fa-tty margin-r-5"></i>Nomor Telp </strong>
                  <p class="text-muted"><?php echo $data_telpon_siswa; ?> </p>
				 <strong><i class="fa fa-sitemap margin-r-5"></i> Riwayat Kelas</strong>
                  <p>
                <?php    
			//Riwayat kelas
			$riwayat_kls=mysql_query("select setup_kelas.id_kelas, setup_kelas.nama_kelas,tbl_ruangan.nis, tbl_ruangan.id_kelas, tbl_ruangan.id_tahun, setup_tahun.id_tahun, setup_tahun.tahun from setup_kelas, tbl_ruangan, setup_tahun where tbl_ruangan.nis='$id' and tbl_ruangan.id_kelas=setup_kelas.id_kelas and tbl_ruangan.id_tahun=setup_tahun.id_tahun order by tbl_ruangan.id_kelas asc");
			while($row_kls_rwy=mysql_fetch_array($riwayat_kls))
			{
				echo"Tahun  $row_kls_rwy[6] : <b class='text-green'> $row_kls_rwy[1] </b>  <br>";
			}
			 
			?>
                  </p>
				  </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
            <div class="col-md-9">
			<h4 class="box-title text-blue"> 
				 Tahun Pelajaran : <?php echo $tahun_ajaran; ?>, Kelas: <?php echo $data_tampil_kelas; ?>  </h4>
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#semester1" data-toggle="tab"><b><i class="fa fa-sticky-note-o"></i> Nilai Sem 1</b></a></li>
				  <li><a href="#semester2" data-toggle="tab"><i class="fa fa-sticky-note-o"></i>  Nilai Sem 2 </a></li>
                  <li><a href="#kehadiran" data-toggle="tab"><i class="fa fa-medkit"></i> Riwayat Ketidakhadiran </a></li>
                  <li><a href="#settings" data-toggle="tab"><i class="fa fa-envelope-o"></i> Kirimkan Pesan </a></li>
                </ul>
                <div class="tab-content">
                  <div class="active tab-pane" id="semester1">
				<!-- hasil nilai mulai -->
				
				<h4>Semester 1 (Ganjil) </h4>
				<?php
				//untuk judul kategori nilai
				$tabel_jdl_kat=mysql_query("select id_kategori, kategori from tbl_kategori_nilai order by id_kategori asc");
				$jum_colspan = mysql_num_rows($tabel_jdl_kat);
				 ?>
				<table class="table table-bordered">
				<thead>
				 <tr bgcolor=#ddd>
				  <th rowspan=2>
				   No. 
				  </th>
				  <th rowspan=2>
				   Mata Pelajaran 
				  </th>
				  <th rowspan=2>
				   KKM 
				  </th>
				  <th colspan=<?php echo $jum_colspan;?>>
				   Nilai 
				  </th>
				  <th  rowspan=2>
				   Keterangan 
				  </th>
				 </tr>
				
				 <tr bgcolor=#fafafa>
				   <?php
					  	//menampilkan judul kategori
						while($jdl_kat=mysql_fetch_array($tabel_jdl_kat)){
						echo "<th>".$jdl_kat['kategori']."</th>"; 
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
				  <td>
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
					$sql_kat_nilai = mysql_query("select id_kategori, kategori from tbl_kategori_nilai order by id_kategori asc");
					while($row_kat_nilai = mysql_fetch_array($sql_kat_nilai)){
						//sub cari nilai di tabel nilai dgn id kategori dan semester
						$view_nilai = mysql_query("SELECT nis, id_pelajaran, id_kelas, nilai, id_kategori, id_tahun,semester  FROM tbl_nilai WHERE nis='$data_nis' and id_pelajaran='$row_mapel[id_pelajaran]' and id_kelas='$data_tampil_id_kelas' and id_kategori='$row_kat_nilai[0]' and id_tahun='$id_tahun'  and semester='1'");
						$nilai_ok = mysql_fetch_array($view_nilai);
						$nilai_fik = $nilai_ok['3'];
						echo "<td>".$nilai_fik."  </td>"; 
						} 
								?>				  

				  <td>
				   &nbsp; 
				  </td>
				 </tr>
				<?php
				$i++;
				}
				?>
				 <tr>
				  <td colspan=3>
				   Jumlah 
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
				  <td>
				   &nbsp; 
				  </td>
				  <td>
				   &nbsp; 
				  </td>
				 </tr>
				</table>
		</div><!-- akhir sem 1 nilai -->
		
        <div class="tab-pane" id="semester2"> 
			<!-- semester -->
				 <h4>Semester 2 (Genap) </h4>
				<?php
				//untuk judul kategori nilai
				$tabel_jdl_kat=mysql_query("select id_kategori, kategori from tbl_kategori_nilai order by id_kategori asc");
				$jum_colspan = mysql_num_rows($tabel_jdl_kat);
				 ?>
				<table class="table table-bordered">
				<thead>
				 <tr bgcolor=#ddd>
				  <th rowspan=2>
				   No. 
				  </th>
				  <th rowspan=2>
				   Mata Pelajaran 
				  </th>
				  <th rowspan=2>
				   KKM 
				  </th>
				  <th colspan=<?php echo $jum_colspan;?>>
				   Nilai 
				  </th>
				  <th  rowspan=2>
				   Keterangan 
				  </th>
				 </tr>
				
				 <tr bgcolor=#fafafa>
				   <?php
					  	//menampilkan judul kategori
						while($jdl_kat=mysql_fetch_array($tabel_jdl_kat)){
						echo "<th>".$jdl_kat['kategori']."</th>"; 
						}
					  ?>
				 </tr>
				  </thead>
			 <?php
			 //perulangan nilai
				$view_mapel2=mysql_query("select id_pelajaran,nama_pelajaran  from setup_pelajaran order by id_pelajaran asc");
				$ii = 1;
				while($row_mapel2=mysql_fetch_array($view_mapel2)){	  
				?>
				 <tr>
				  <td>
				   <?php echo"$ii";?>
				  </td>
				  <td>
				   <?php echo"$row_mapel2[nama_pelajaran]";?>
				  </td>
				  <td><center>
				  <?php 
				  //KKM
				   $view_kkm2=mysql_query("select tbl_kkm.id_tahun, tbl_kkm.id_pelajaran, tbl_kkm.kategori_kls, tbl_kkm.kkm from tbl_kkm where tbl_kkm.id_pelajaran=$row_mapel2[id_pelajaran] and tbl_kkm.id_tahun='$id_tahun' and tbl_kkm.kategori_kls like '$kategori_kls'");
					$tot_jum_kkm2 = mysql_num_rows($view_kkm2);
					if ($tot_jum_kkm2 <= 0)
					{
						echo"-";
					}
					else{
					$data_kkm2 = mysql_fetch_row($view_kkm2);
					echo $data_kkm2[3];
					}
					?>
				  </td>
<?php
					//sub query cari id per kategori
					$sql_kat_nilai2 = mysql_query("select id_kategori, kategori from tbl_kategori_nilai order by id_kategori asc");
					while($row_kat_nilai2 = mysql_fetch_row($sql_kat_nilai2)){
						//sub cari nilai di tabel nilai dgn id kategori dan semester
						$view_nilai2 = mysql_query("SELECT nis, id_pelajaran, id_kelas, nilai, id_kategori, id_tahun,semester  FROM tbl_nilai WHERE nis='$data_nis' and id_pelajaran='$row_mapel2[id_pelajaran]' and id_kelas='$data_tampil_id_kelas' and id_kategori='$row_kat_nilai2[0]' and id_tahun='$id_tahun'  and semester='2'");
						$nilai_ok2 = mysql_fetch_array($view_nilai2);
						$nilai_fik2 = $nilai_ok2['3'];
						echo "<td>".$nilai_fik2."  </td>"; 
						} 
						?>	 
				  <td>
				   &nbsp; 
				  </td>
				 </tr>
				<?php
				$ii++;
				}
				?>
				 <tr>
				  <td colspan=3>
				   Jumlah 
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
				  <td>
				   &nbsp; 
				  </td>
				  <td>
				   &nbsp; 
				  </td>
				 </tr>
				</table>
		</div><!-- akhir sem 2 nilai -->
				  
		 <!-- /.tab-pane kehadiran -->
		<div class="tab-pane" id="kehadiran">
	<!-- KEHADIRAN semester 1!-->
	<?php
	$view_kehadiran=mysql_query("SELECT tbl_kehadiran.nis, tbl_kehadiran.id_kelas, tbl_kehadiran.id_tahun, tbl_kehadiran.semester, tbl_kehadiran.sakit, tbl_kehadiran.izin, tbl_kehadiran.tnp_ket, tbl_kehadiran.terlambat, tbl_kehadiran.meninggalkan_sek, tbl_kehadiran.tdk_upacara, tbl_kehadiran.pm_s, tbl_kehadiran.pm_i, tbl_kehadiran.pm_a, tbl_kehadiran.pm_t FROM tbl_kehadiran WHERE tbl_kehadiran.nis='$id' AND  tbl_kehadiran.id_kelas='$data_tampil_id_kelas' AND tbl_kehadiran.id_tahun='$id_tahun' AND tbl_kehadiran.semester='1'");
	$cek_kehadiran=mysql_num_rows($view_kehadiran);
	if($cek_kehadiran <=0){
		echo"<h5>Data kehadiran semeser 1 siswa ini belum di entry</h5>";
	}
	else {
	while($row_hadir=mysql_fetch_array($view_kehadiran)){
	?>
 <b>KETIDAKHADIRAN SEMESTER 1</b> 
  <br><table class='table table-bordered'>
				 <tr bgcolor=#f4f4f4>
				  <td  align=center>
				   No. 
				  </td>
				  <td>
				   &nbsp; Alasan Ketidakhadiran 
				  </td>
				  <td>
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
		  
				 <table class='table table-bordered'>
				 <tr bgcolor=#f4f4f4>
				  <td colspan=4>
				   Ketidakhadiran Pendalaman Materi 
				  </td>
				 </tr>
				 <tr>
				  <td align=center>
				   Sakit
				  </td>
				  <td align=center>
				   Izin 
				  </td>
				  <td align=center>
				   Alfa
				  </td>
				  <td align=center>
				   Tanpa keterangan
				  </td>
				 </tr>
				 <tr>
				  <td align=center>
				   <?php echo $row_hadir['pm_s']; ?>
				  </td>
				  <td align=center>
				   <?php echo $row_hadir['pm_i']; ?>
				  </td>
				  <td align=center>
				   <?php echo $row_hadir['pm_a']; ?>
				  </td>
				  <td align=center>
				   <?php echo $row_hadir['pm_t']; ?>
				  </td>
				 </tr>
				</table>
				
<?php
		}
	}
	?>
			
		<hr>	
			<!-- KEHADIRAN SEMESTER 2!-->
	<?php
	$view_kehadiran2=mysql_query("SELECT tbl_kehadiran.nis, tbl_kehadiran.id_kelas, tbl_kehadiran.id_tahun, tbl_kehadiran.semester, tbl_kehadiran.sakit, tbl_kehadiran.izin, tbl_kehadiran.tnp_ket, tbl_kehadiran.terlambat, tbl_kehadiran.meninggalkan_sek, tbl_kehadiran.tdk_upacara, tbl_kehadiran.pm_s, tbl_kehadiran.pm_i, tbl_kehadiran.pm_a, tbl_kehadiran.pm_t FROM tbl_kehadiran WHERE tbl_kehadiran.nis='$id' AND  tbl_kehadiran.id_kelas='$data_tampil_id_kelas' AND tbl_kehadiran.id_tahun='$id_tahun' AND tbl_kehadiran.semester='2'");
	$cek_kehadiran2=mysql_num_rows($view_kehadiran2);
	if($cek_kehadiran2 <=0){
		echo"<h5>Data kehadiran semeser 2 siswa ini belum di entry</h5>";
	}
	else {
	while($row_hadir2=mysql_fetch_array($view_kehadiran2)){
	?>
	
 <b>KETIDAKHADIRAN SEMESTER 2</b> 
 <br><table class='table table-bordered'>
				 <tr bgcolor=#f4f4f4>
				  <td  align=center>
				   No. 
				  </td>
				  <td>
				   &nbsp; Alasan Ketidakhadiran 
				  </td>
				  <td>
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
				     <?php echo $row_hadir2['sakit']; ?>
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
				     <?php echo $row_hadir2['izin']; ?>
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
				   <?php echo $row_hadir2['tnp_ket']; ?>
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
				   <?php echo $row_hadir2['terlambat']; ?>
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
				   <?php echo $row_hadir2['meninggalkan_sek']; ?>
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
				   <?php echo $row_hadir2['tdk_upacara']; ?>
				  </td>
				 </tr>
				</table>
		  
				 <table class='table table-bordered'>
				 <tr bgcolor=#f4f4f4>
				  <td colspan=4>
				   Ketidakhadiran Pendalaman Materi 
				  </td>
				 </tr>
				 <tr>
				  <td align=center>
				   Sakit
				  </td>
				  <td align=center>
				   Izin 
				  </td>
				  <td align=center>
				   Alfa
				  </td>
				  <td align=center>
				   Tanpa keterangan
				  </td>
				 </tr>
				 <tr>
				  <td align=center>
				   <?php echo $row_hadir2['pm_s']; ?>
				  </td>
				  <td align=center>
				   <?php echo $row_hadir2['pm_i']; ?>
				  </td>
				  <td align=center>
				   <?php echo $row_hadir2['pm_a']; ?>
				  </td>
				  <td align=center>
				   <?php echo $row_hadir2['pm_t']; ?>
				  </td>
				 </tr>
				</table>
	<?php
		}
	}
	?>	 
	</div><!-- /.tab-pane -->
	<div class="tab-pane" id="settings">
                    <form class="form-horizontal">
                      <div class="form-group">
					  <h5>&nbsp; Sistem pesan dalam pengembangan</h5>
                        <label for="inputName" class="col-sm-2 control-label">Judul</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputName" placeholder="Perihal pesan">
                        </div>
                      </div>
                     
                       
                      <div class="form-group">
                        <label for="inputExperience" class="col-sm-2 control-label">Isi Pesan</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputExperience" placeholder="isikan pesan anda disini,pesan ini bersifat privat dan hanya bisa di baca oleh penerima pesan"></textarea>
                        </div>
                      </div>
                  
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" checked> <small>Pesan ini bersifat privat.<br>Dengan ini saya menyatakan data saya adalah valid dan dapat dipertanggung jawabkan. <a href="#">baca terms and conditions</a></small>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                      </div>
                    </form>
                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div><!-- /.nav-tabs-custom -->
            </div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->