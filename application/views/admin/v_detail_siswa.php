
			<?php
			$data_siswa=$data_siswa->row_array();
			$data_kelamin=$data_siswa['kelamin'];
			$data_nama_lengkap =$data_siswa['nama_siswa'];
			$data_id = $data_siswa['id_siswa'];
			$data_nis =$data_siswa['nis'];
			$data_nisn =$data_siswa['nisn'];
			$data_alamat_siswa =$data_siswa['alamat_siswa'];
			$data_telpon_siswa =$data_siswa['telpon_siswa'];
			$data_status_alumni =$data_siswa['status'];
			$data_foto_siswa = $data_siswa['foto_siswa'];
			
			if($data_foto_siswa!='')
			{
				$img = base_url()."assets/photos/".$data_foto_siswa;
			}
			elseif($data_kelamin=='L')
			{
				$img=base_url()."assets/dist/img/pria.png";
			}
			else
			{
				$img=base_url()."assets/dist/img/putri.jpg";
			}

			//kelas siswa sesuai tahun aktif sekarang
			$row_kls=$viewkls->row_array();
			$data_tampil_kelas = $row_kls['nama_kelas'];
			$data_tampil_id_kelas = $row_kls['id_kelas'];
			$kategori_kls = $row_kls['kategori_kls'];
			
			
?>

<?php include('application/views/section_header.php');?>
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
			
			foreach($riwayat_kelas->result_array() as $row)
			{
				echo"Tahun  $row[tahun] : <b class='text-green'> $row[nama_kelas] </b>  <br>";
			}
			 
			?>
                  </p>
                  <?php if($this->session->userdata('admin')){?>
                  <a href="<?php echo base_url('admin/edit_siswa/'.$data_id.'?m=data_induk&sm=siswa');?>" class="btn btn-primary btn-sm btn-block" title="Edit Biodata Siswa"> <i class="fa fa-pencil-square"></i> Edit Biodata Siswa</a><?php } ?>
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
					<?php include('application/views/guru/v_nilai_rapor_siswa.php');?>
				</div><!-- akhir sem 1 nilai -->
		
        <div class="tab-pane" id="semester2"> 
			<!-- semester -->
				 <h4>Semester 2 (Genap) </h4>
					<?php include('application/views/guru/v_nilai_rapor_siswa2.php');?>
		</div><!-- akhir sem 2 nilai -->
				  
		 <!-- /.tab-pane kehadiran -->
		<div class="tab-pane" id="kehadiran">
	<!-- KEHADIRAN semester 1!-->
	
 <b>KETIDAKHADIRAN SEMESTER 1</b>
  <table class="table table-condensed table-bordered">
  <tbody>
    <tr>
      <td width="170px">Sakit</td><td width="200px">: <?php echo strip_tags($kehadiran->row('sakit'));?> hari</td>
    </tr>
    <tr>
      <td>Ijin</td><td>: <?php echo strip_tags($kehadiran->row('izin'));?> hari</td>
    </tr>
    <tr>
      <td>Tanpa Keterangan</td><td>: <?php echo strip_tags($kehadiran->row('tnp_ket'));?> hari</td>
    </tr>
  
  </tbody>
</table>

<br>
			
		<hr>	
			<!-- KEHADIRAN SEMESTER 2!-->
	
	
 <b>KETIDAKHADIRAN SEMESTER 2</b>
  <table class="table table-condensed table-bordered">
  <tbody>
    <tr>
      <td width="170px">Sakit</td><td width="200px">: <?php echo strip_tags($kehadiran2->row('sakit'));?> hari</td>
    </tr>
    <tr>
      <td>Ijin</td><td>: <?php echo strip_tags($kehadiran2->row('izin'));?> hari</td>
    </tr>
    <tr>
      <td>Tanpa Keterangan</td><td>: <?php echo strip_tags($kehadiran2->row('tnp_ket'));?> hari</td>
    </tr>
  
  </tbody>
</table>

<br>
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