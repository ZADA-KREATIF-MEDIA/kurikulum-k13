<?php
/*
| KETERANGAN:
| - View ini menampilkan list data siswa pada kelas dan semester juga tahun pelajaran yang aktif
|   Ekstra.
*/
		$nama_kelas=$kelas->row('nama_kelas');
		$id_kelas=$kelas->row('id_kelas');
			
		?>
    <!--  start step-holder -->

  <!-- Content Header (Page header) -->
          <?php include('application/views/section_header.php');?>

<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<?php echo $this->session->flashdata('notif');?>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Set Prestasi Siswa</h3>
						<div class="box-body">
							<form method="post" class="form-horizontal" action="<?php echo base_url('guru/set_prestasi_siswa');?>">
								<div class="form-group">
									<label class="col-md-3 control-label">Nama Siswa</label>
									<div class="col-md-5">
										<?php 
										echo "<input type=\"hidden\" name=\"idkelas\" value=\"$id_kelas\">
										<input type=\"hidden\" name=\"idsemester\" value=\"$idsemester\">
										<input type=\"hidden\" name=\"idtahun\" value=\"$idtahun\">
										<input type=\"hidden\" name=\"idwali\" value=\"$wali_id_wali\">";?>
										<select name="nis" class="form-control select2" style="width: 100%;">
											<?php
											foreach($siswadikelas->result() as $s)
											{
												echo "<option value='$s->nis'>$s->nis - $s->nama_siswa</option>";
											}
											?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Jenis Kegiatan</label>
									<div class="col-md-5">
										<input type="text" class="form-control" name="jenis">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Keterangan</label>
									<div class="col-md-5">
										<textarea class="form-control" name="ket"></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label"></label>
									<div class="col-md-5">
										<button type="submit" class="btn btn-primary btn-md">Simpan</button>
									</div>
								</div>
						</div>
					</div>
				</div>
			</div>
		</div>
      <div class="row">
          <div class="col-xs-12">
          <div class="box">
                <div class="box-header">
                  <h3 class="box-title text-blue">
				  Data Prestasi Siswa <small class=" glyphicon glyphicon-chevron-right"></small> Kelas:  <?php echo $nama_kelas;?> </h3> 
	 
                </div><!-- /.box-header -->
				
                <div class="box-body no-padding table-responsive">
                  <table class="table table-striped table-condensed table-hover">
                    <tr>
                      <th>No</th>
					  <th>NIS</th>
                      <th>Nama Siswa</th>
                      <th>Aksi</th>
                    </tr>
                   					
				   <?php
						$i = 1;
						foreach($prestasi_siswa->result_array() as $row){
							?>							
							<tr>
								<td>&nbsp; <?php echo $i++;?></td>
								<td><?php echo $row['nis'];?></td>
								<td><?php echo $row['nama_siswa'];?></td>
								
								<td>
								
								<a href="<?php echo base_url('guru/edit_prestasi_siswa/'.$row['nis'].'/'.$row['id_kelas'].'/'.$row['id_wali'].'-'.$row['id_semester'].'-'.$row['id_tahun'].'/?set=update&m=input_nilai&sm=prestasi');?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Update Prestasi</a>


								</td>
								
							</tr>
							
							<?php
							
						}
							
						?>
		                 
                    
                  </table>
				  <br>	
                </div><!-- /.box-body -->
				
              </div><!-- /.box -->
		</div>
	</div>		  
</section>	