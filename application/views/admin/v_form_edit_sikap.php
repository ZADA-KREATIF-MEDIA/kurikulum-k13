
    <!--  start step-holder -->

  <!-- Content Header (Page header) -->
          <?php include('application/views/section_header.php');?>

<section class="content">
      <div class="row">
          <div class="col-xs-12">

 <?php if($mode_form=="input"){?>
          <div class="box">
                <div class="box-header">
                  <h3 class="box-title text-blue"></small> Kelas:  <?php echo $nama_kelas;?> </h3> 
	 
                </div><!-- /.box-header -->
				<form id="mainform" action="<?php echo base_url('admin_editnilai/proses_input_sikap');?>" method="post" class="form-inline">
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
								<td><?php echo "<input  class=\"form-control\" type='text' name='a".$i."' size='4'/>"; ?></td>
								
								<td><?php echo "<textarea class=\"form-control\" cols='50' name='b".$i."' placeholder='Deskripsi Spiritual'></textarea>";?></td>
								<td><?php echo "<input  class=\"form-control\" type='text' name='c".$i."' size='4'/>"; ?></td>
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
                      
                      <td>
                      	<select class="form-control select2" name="idwali" required="">
                      		<option value="">Pilih Wali Kelas</option>
                      		<?php
                      		foreach($wali->result() as $rowwali){
                      			echo "<option value='$rowwali->id_wali'>$rowwali->nama_guru</option>";
                      		}
                      		?>
                      	</select>
                      	&nbsp; &nbsp;   <input type="hidden" name="jumlah" value="<?php echo $jumSis ?>" /><input type="submit" value="Simpan" name="insert" class="btn btn-primary"/> 
					  &nbsp;  -  &nbsp;<a  onclick="return confirm('Perubahan belum disimpan,apakah Anda yakin batal mengubah?')" href="<?php echo base_url('admin_editnilai/edit_sikap?m=edit_nilai&sm=nilai_sikap');?>" button class="btn btn-danger"/><small class="glyphicon glyphicon-chevron-left"></small> Batal</a>
					  </td>
                    </tr>
                    
                  </table>
				  <br>	
                </div><!-- /.box-body -->
				</form>
              </div><!-- /.box -->
<?php
}
else
{
	//mode UPDATE
?>
 <div class="box">
                <div class="box-header">
                  <h3 class="box-title text-blue">
				  <small class=" glyphicon glyphicon-chevron-right"></small> Kelas:  <?php echo $nama_kelas;?> </h3> 
	 
                </div><!-- /.box-header -->
				<form id="mainform" action="<?php echo base_url('admin_editnilai/proses_input_sikap');?>" method="post">
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
								<td><?php echo "<input  class=\"form-control\" type='text' name='a".$i."' size='4' value='".$row['predikat_spiritual']."'/>"; ?></td>
								
								<td><?php echo "<textarea class=\"form-control\" cols='50' name='b".$i."' placeholder='deskripsi spiritual'>".$row['sikap_spiritual']."</textarea>";?></td>
								<td><?php echo "<input  class=\"form-control\" type='text' name='c".$i."' size='4' value='".$row['predikat_sosial']."' />"; ?></td>
								<td><?php echo "<textarea class=\"form-control\" cols='50' name='d".$i."' placeholder='deskripsi sosial'>".$row['sikap_sosial']."</textarea>";?></td>
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
                      
                      <td> &nbsp; &nbsp;   <input type="hidden" name="jumlah" value="<?php echo $jumSis ?>" /><input type="submit" value="Simpan" name="update" class="btn btn-primary"/> 
					  &nbsp;  -  &nbsp;<a  onclick="return confirm('Perubahan belum disimpan,apakah Anda yakin batal mengubah?')" href="<?php echo base_url('admin_editnilai/edit_sikap?m=edit_nilai&sm=nilai_sikap');?>" button class="btn btn-danger"/><small class="glyphicon glyphicon-chevron-left"></small> Batal</a>
					  </td>
                    </tr>
                    
                  </table>
				  <br>	
                </div><!-- /.box-body -->
				</form>
              </div><!-- /.box -->
<?php
}
?>
		</div>
	</div>		  
</section>	

