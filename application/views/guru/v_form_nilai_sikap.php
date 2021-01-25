<?php
		
		
		$nama_kelas=$kelas->row('nama_kelas');
		$id_kelas=$kelas->row('id_kelas');
		
		$id_tahun = $idtahun;
		$id_semester = $idsemester;
		

		?>
    <!--  start step-holder -->

  <!-- Content Header (Page header) -->
          <?php include('application/views/section_header.php');?>

<section class="content">
	<div class="row">
          <div class="col-xs-12">
          	<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h3>Petunjuk Import Nilai Sikap</h3>
          		<ol>
          			<li>Pilih tombol <b>Download Template Excel</b></li>
          			<li>Guru tidak diizinkan mengubah data pada file kecuali pada Predikat dan Deskripsi</li>
                <li>Guru memberikan nilai A,B,C atau D pada kolom Predikat</li>
          			<li>Simpan dan Import dengan memilih tombol <b>Upload Excel</b></li>
          		</ol> </div>
          </div>
     </div>
      <div class="row">
          <div class="col-xs-12">
          <div class="box">
                <div class="box-header">
                  <h3 class="box-title text-blue">
				  <small class=" glyphicon glyphicon-chevron-right"></small> Kelas:  <?php echo $nama_kelas;?> </h3> 
	 				  <button class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#modal-default-in"><i class="fa fa-upload"></i> Upload Excel</button>
          <a href="<?php echo base_url('export_file/down_templateup_sikap/'.$id_kelas.'/'.$id_tahun.'/'.$id_semester.'');?>" class="btn btn-success btn-sm pull-right" style="margin-right: 5px;"><i class="fa fa-file-excel-o"></i> Download Template Excel</a>
                </div><!-- /.box-header -->
				<form id="mainform" action="<?php echo base_url('guru/simpan_nilai_sikap');?>" method="post">
                <div class="box-body no-padding table-responsive">
                  <table class="table table-striped table-condensed table-bordered">
                    <tr>
                      <th rowspan="2" class="text-center">No</th>
					  <th rowspan="2" class="text-center">NIS</th>
                      <th rowspan="2" class="text-center">Nama Siswa</th>
                       <th colspan="2" class="text-center"> &nbsp; &nbsp; Sikap Spiritual</th>
                       <th colspan="2" class="text-center"> &nbsp; &nbsp; Sikap Sosial</th>
                    </tr>
                    <tr>
                    	
                    	<th class="text-center">Predikat</th><th class="text-center">Deskripsi</th>
                    	<th class="text-center">Predikat</th><th class="text-center">Deskripsi</th>
                    </tr>
                    <input type="hidden" name="idkelas" value="<?php echo $id_kelas;?>"/>
                    <input type="hidden" name="idwali" value="<?php echo $wali_id_wali;?>"/>
                    <input type="hidden" name="idsemester" value="<?php echo $id_semester;?>"/>
                    <input type="hidden" name="idtahun" value="<?php echo $id_tahun;?>"/>
					
					
					
				   <?php
						$i = 1;
						foreach($nilai_sikap->result_array() as $row){
							?>
							
							<?php echo "<input type='hidden' name='nis".$i."' value='".$row['nis']."' />"; ?>
							
							<tr>
								<td>&nbsp; <?php echo $i;?></td>
								<td><?php echo $row['nis'];?></td>
								<td><?php echo $row['nama_siswa'];?></td>
								<td><?php echo "<select class=\"form-control\" name='a".$i."'>"; ?>
									<option value="A">A</option>
									<option value="B" selected="">B</option>
									<option value="C">C</option>
									<option value="D">D</option>
								</select>
								</td>
								
								<td><?php echo "<textarea class=\"form-control\" cols='50' name='b".$i."' placeholder='Deskripsi Spiritual'></textarea>";?></td>
								<td><?php echo "<select class=\"form-control\" name='c".$i."'>"; ?>
									<option value="A">A</option>
									<option value="B" selected="">B</option>
									<option value="C">C</option>
									<option value="D">D</option>
								</select>
								</td>
								<td><?php echo "<textarea class=\"form-control\" cols='50' name='d".$i."' placeholder='Deskripsi Sosial'></textarea>";?></td>
							</tr>
							
							<?php
							$i++;
						}
							
						?>
		
		
                    <tr>
                      
                      <td> </td>
                      <td> </td>
                      <td> </td>
                      <td> </td>
                      <td> </td>
                      <td></td>
                      
                      <td> &nbsp; &nbsp;   <input type="hidden" name="jumlah" value="<?php echo $jumSis ?>" /><input type="submit" value="Simpan" name="insert" class="btn btn-primary"/> 
					  &nbsp;  -  &nbsp;<a  onclick="return confirm('Perubahan belum disimpan,apakah Anda yakin batal mengubah?')" href="<?php echo base_url('guru/input_nilai_sikap?m=input_nilai&sm=input_nilai_sikap');?>" button class="btn btn-danger"/><small class="glyphicon glyphicon-chevron-left"></small> Batal</a>
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
  <div class="modal fade" id="modal-default-in">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Upload File Excel Nilai Sikap</h4>
              </div>
              <form method="post" action="<?php echo base_url('import_excel/do_importin_sikap');?>" enctype="multipart/form-data" accept-charset="utf-8">
              <div class="modal-body">
                <div class="form-group">
                	<label class="control-label col-md-3">File Upload</label>
                	<div class="col-md-5">
                    <input type="hidden" name="id_kelas" value="<?php echo $id_kelas;?>"/>
                    <input type="hidden" name="id_wali" value="<?php echo $wali_id_wali;?>"/>
                    <input type="hidden" name="semester" value="<?php echo $id_semester;?>"/>
                    <input type="hidden" name="tahun" value="<?php echo $id_tahun;?>"/>
                		<input type="hidden" name="back_url" value="guru/input_nilai_sikap?m=input_nilai&sm=input_nilai_sikap">
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