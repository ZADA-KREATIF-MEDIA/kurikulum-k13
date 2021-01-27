<?php
		
		$nama_guru=$guru->row('nama_guru');
		$id_guru=$guru->row('id_guru');
		$nama_kelas=$kelas->row('nama_kelas');
		$id_kelas=$kelas->row('id_kelas');
		$nama_pelajaran=$pelajaran->row('nama_pelajaran');
		$id_pelajaran=$pelajaran->row('id_pelajaran');
		//$nama_kategori=$kategori->row('kategori');
		//$id_kategori=$kategori->row('id_kategori');
		$id_tahun = $tahun;
		$id_semester = $semester->row('id_semester');

		?>
    <!--  start step-holder -->

  <!-- Content Header (Page header) -->
          <?php include('application/views/section_header.php');?>

<section class="content">
	<div class="row">
          <div class="col-xs-12">
          	<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h3>Petunjuk Import Deskripsi</h3>
          		<ol>
          			<li>Pilih tombol <b>Download Template Excel</b></li>
          			<li>Guru <b>tidak diizinkan</b> mengubah data nilai pada file excel kecuali pada kolom Deskripsi Pengetahuan dan Ketrampilan</li>
                <li>Untuk mengedit nilai dapat dilakukan pada menu Nilai Pengetahuan & Ketrampilan</li>
          			<li>Simpan dan Import dengan memilih tombol <b>Upload Excel</b></li>
          		</ol> </div>
          </div>
     </div>
      <div class="row">
          <div class="col-xs-12">
          <div class="box">
                <div class="box-header">
                  <h3 class="box-title text-blue">
				  <?php echo $nama_pelajaran;?> <small class=" glyphicon glyphicon-chevron-right"></small> Kelas:  <?php echo $nama_kelas;?> </h3> 
				   <button class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#modal-default-up"><i class="fa fa-upload"></i> Upload Excel</button>
				  <a href="<?php echo base_url('export_file/down_templateup_deskripsi/'.$id_kelas.'/'.$id_pelajaran.'/'.$id_semester.'');?>" class="btn btn-success btn-sm pull-right" style="margin-right: 5px;"><i class="fa fa-file-excel-o"></i> Download Template Excel</a>
	 
                </div><!-- /.box-header -->
				<form id="mainform" action="<?php echo base_url('guru/proses_input_deskripsi');?>" method="post">
                <div class="box-body no-padding table-responsive">
                  <table class="table table-striped table-condensed table-hover">
                    <tr>
                      <th>No</th>
					  <th>NIS</th>
                      <th>Nama Siswa</th>
                       <th> &nbsp; &nbsp; Nilai</th>
                       <th> &nbsp; &nbsp; Aspek</th>
                       <th> &nbsp; &nbsp; Deskripsi</th>
                    </tr>
                    <input type="hidden" name="tahun" value="<?php echo $id_tahun;?>">
					<input type="hidden" name="semester" value="<?php echo $id_semester;?>" />
					<input type="hidden" name="id_pelajaran" value="<?php echo $id_pelajaran;?>">
					
				   <?php
						$i = 1;
						foreach($list_siswa->result_array() as $row){
							?>

							<?php echo "<input type='hidden' name='id_nilai[]' value='".$row['idnilai']."' />"; ?>
							<?php echo "<input type='hidden' name='nis[]' value='".$row['nilai_nis']."' />"; ?>
							
							<tr>
								<td rowspan="2">&nbsp; <?php echo $i++;?></td>
								<td rowspan="2"><?php echo $row['nilai_nis'];?></td>
								<td rowspan="2"><?php echo $row['nama_siswa'];?></td>
								<td><?php echo "<input type='text' name='nilai_pengetahuan[]' size='1' value='".$row['nilai_pengetahuan']."' disabled/>"; ?></td>
								<td>Pengetahuan</td>
								<td><textarea class="form-control" cols="50" name="desk_pengetahuan[]" placeholder="sedang diproses"><?php echo $row['pengetahuan'];?></textarea></td>
							</tr>
							<tr>
								
								<td><?php echo "<input type='text' name='nilai_ketrampilan[]' size='1' value='".$row['nilai_ketrampilan']."' disabled/>"; ?></td>
								<td>Ketrampilan</td>
								<td><textarea class="form-control" name="desk_ketrampilan[]" cols="50" placeholder="sedang diproses"><?php echo $row['ketrampilan'];?></textarea></td>
							</tr>
							<?php
							
						}
							$jumSis = $list_siswa->num_rows();
						?>
		
		
                    <tr>
                      
                      <td> </td>
                      <td> </td>
                      <td> </td>
                      <td> </td>
                      <td> </td>
                      
                      <td> &nbsp; &nbsp;   <input type="hidden" name="jumlah" value="<?php echo $jumSis ?>" /><input type="submit" value="Simpan Perubahan" name="input_nilai" class="btn btn-primary"/> 
					  &nbsp;  -  &nbsp;<a  onclick="return confirm('Perubahan belum disimpan,apakah Anda yakin batal mengubah?')" href="<?php echo base_url('guru/input_deskripsi_nilai');?>" button class="btn btn-danger"/><small class="glyphicon glyphicon-chevron-left"></small> Batal</a>
					  </td>
                    </tr>
                    
                  </table>
				  <br>	
                </div><!-- /.box-body -->
				</form>
              </div><!-- /.box -->
		</div>
	</div>		  
</section>	

<!-- modal update nilai-->
  <div class="modal fade" id="modal-default-up">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Upload File Excel Deskripsi Nilai</h4>
              </div>
              <form method="post" action="<?php echo base_url('import_excel/do_importup_deskripsi');?>" enctype="multipart/form-data" accept-charset="utf-8">
              <div class="modal-body">
                <div class="form-group">
                	<label class="control-label col-md-3">File Upload</label>
                	<div class="col-md-5">
                   <input type="hidden" name="tahun" value="<?php echo $id_tahun;?>">
                    <input type="hidden" name="semester" value="<?php echo $id_semester;?>" />
                    <input type="hidden" name="id_pelajaran" value="<?php echo $id_pelajaran;?>">
                    <input type="hidden" name="id_kelas" value="<?php echo $id_kelas;?>">
                    <input type="hidden" name="id_guru" value="<?php echo $id_guru;?>">
                		<input type="hidden" name="back_url" value="guru/input_deskripsi_nilai?m=input_nilai&sm=deskripsi_nilai">
                		<input type="file" name="userfile">
                	</div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary"> <i class="fa fa-upload"></i> Upload File</button>
              </div>
          </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
