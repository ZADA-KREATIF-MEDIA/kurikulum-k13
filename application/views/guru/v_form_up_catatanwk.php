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
          <div class="box">
                <div class="box-header">
                  <h3 class="box-title text-blue"> Catatan Wali Kelas
				  <small class=" glyphicon glyphicon-chevron-right"></small> Kelas:  <?php echo $nama_kelas;?> </h3> 
	 
                </div><!-- /.box-header -->
				<form id="mainform" action="<?php echo base_url('guru/simpan_catatanwk');?>" method="post">
                <div class="box-body no-padding table-responsive">
                  <table class="table table-striped table-condensed table-bordered">
                    <tr>
                      <th class="text-center">No</th>
					  <th class="text-center">NIS</th>
                      <th class="text-center">Nama Siswa</th>
                       <th class="text-center">Catatan</th>
                    </tr>
                    
                    <input type="hidden" name="idkelas" value="<?php echo $id_kelas;?>"/>
                    <input type="hidden" name="idwali" value="<?php echo $wali_id_wali;?>"/>
                    <input type="hidden" name="idsemester" value="<?php echo $id_semester;?>"/>
                    <input type="hidden" name="idtahun" value="<?php echo $id_tahun;?>"/>
					
					
					
				   <?php
						$i = 1;
						foreach($catatanwk->result_array() as $row){
							?>
							
							<?php echo "<input type='hidden' name='nis".$i."' value='".$row['nis']."' />"; ?>
							
							<tr>
								<td>&nbsp; <?php echo $i;?></td>
								<td><?php echo $row['nis'];?></td>
								<td><?php echo $row['nama_siswa'];?></td>
								
								<td><?php echo "<textarea class=\"form-control\" cols='50' name='catatanwk".$i."' placeholder='Berikan catatan'>".$row['catatanwk']."</textarea>";?></td>
							</tr>
							
							<?php
							$i++;
						}
							
						?>
		
		
                    <tr>
                      
                      <td> </td>
                      <td> </td>
                      <td></td>
                      
                      <td> &nbsp; &nbsp;   <input type="hidden" name="jumlah" value="<?php echo $jumSis ?>" /><input type="submit" value="Simpan" name="update" class="btn btn-primary"/> 
					  &nbsp;  -  &nbsp;<a  onclick="return confirm('Perubahan belum disimpan,apakah Anda yakin batal mengubah?')" href="<?php echo base_url('guru/input_catatanwk?m=catatan_wali_kelas');?>" button class="btn btn-danger"/><small class="glyphicon glyphicon-chevron-left"></small> Batal</a>
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

