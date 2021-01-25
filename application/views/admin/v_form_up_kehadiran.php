
<!--  start page-heading -->
<?php include('application/views/section_header.php');?>
<!-- end page-heading -->
<section class="content">
      <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Kelas  <?php echo $kelas->row('nama_kelas'); ?>, Semester <b><?php echo $semester_aktif; ?></b></h3>
                
                </div><!-- /.box-header -->
				
                <div class="box-body table-responsive no-padding">
               <table   class="table table-hover table-bordered">
                
				<thead>
				 <tr bgcolor=#ddd>
				  <th rowspan=2>
				   No. <?php echo $id_kelas;?>
				  </th>
				  <th rowspan=2>
				   Nis
				  </th>
				  <th rowspan=2>
				   Nama
				  </th>
				  <th colspan=6  valign=top>
				   Ketidakhadiran 
				   <h6 small>S=sakit, I=ijin, TK=tanpa keterangan<!--, TDS=terlambat datang sekolah, MS=meninggalkan sekolah, TMUB=tidak mengikuti upacara bendera--> </h6>
				  </th>
				  <!--<th colspan=4 valign=top>
				   Ketidakhadiran Pendalaman Materi
				   <h6 small>S=sakit, I=ijin, A=alfa, T=terlambat</h6>
				  </th>-->
				 </tr>
				
				 <tr>
				  
						 <th bgcolor=#39CCCC>S</th> 
						 <th bgcolor=#39CCCC>I</th> 
						 <th bgcolor=#39CCCC>TK</th> 
						 <!--<th bgcolor=#39CCCC>TDS</th> 
						 <th bgcolor=#39CCCC>MS</th> 
						 <th bgcolor=#39CCCC>TMUB</th> 
						 
				 
						 <th bgcolor=#39CCff>S</th> 
						 <th bgcolor=#39CCff>I</th> 
						 <th bgcolor=#39CCff>A</th> 
						 <th bgcolor=#39CCff>T</th>-->
						 
				 </tr>
				  </thead>
					<form action="<?php echo base_url('guru/proses_simpan_kehadiran');?>" method="post">
					<?php
					$ok = 1;
					foreach($data_kehadiran->result_array() as $row){
					?>	
					<input type="hidden" name="id_kelas" value="<?php echo $id_kelas;?>" />
					<input type="hidden" name="id_tahun" value="<?php echo $idtahun;?>" />	 
					<input type="hidden" name="semester" value="<?php echo $idsemester;?>" />
					<?php echo "<input type='hidden' name='nis".$ok."' value='".$row['nis']."' />"; ?>
                   
				   <tr>
                     <td><center><?php echo $ok;?></center></td>
					 <td><?php echo $row['nis'];?> </td>
					 <td> <?php echo $row['nama_siswa'];?></td>
                     <td  bgcolor=#fcfcfc><?php echo "<input type='text' name='a".$ok."' class='form-control input-sm' value='".$row['sakit']."' />"; ?></td>
					 <td  bgcolor=#fcfcfc><?php echo "<input type='text' name='b".$ok."' class='form-control input-sm' value='".$row['izin']."'/>"; ?></td>
					 <td  bgcolor=#fcfcfc><?php echo "<input type='text' name='c".$ok."' class='form-control input-sm' value='".$row['tnp_ket']."'/>"; ?></td>
					 <?php /*<td  bgcolor=#fcfcfc><?php echo "<input type='text' name='d".$ok."' class='form-control input-sm' value='".$row['terlambat']."'/>"; ?></td>
					 <td  bgcolor=#fcfcfc><?php echo "<input type='text' name='e".$ok."' class='form-control input-sm' value='".$row['meninggalkan_sek']."'/>"; ?></td>
					 <td  bgcolor=#fcfcfc><?php echo "<input type='text' name='f".$ok."' class='form-control input-sm' value='".$row['tdk_upacara']."'/>"; ?></td>
					 <td><?php echo "<input type='text' name='g".$ok."' class='form-control input-sm' value='".$row['pm_s']."'/>"; ?></td>
					 <td><?php echo "<input type='text' name='h".$ok."' class='form-control input-sm' value='".$row['pm_i']."'/>"; ?></td>
					 <td><?php echo "<input type='text' name='i".$ok."' class='form-control input-sm' value='".$row['pm_a']."'/>"; ?></td>
					 <td><?php echo "<input type='text' name='j".$ok."' class='form-control input-sm' value='".$row['pm_t']."'/>"; ?></td>*/?>
				 
					   
                       
                    </tr> 
					<?php
					$ok++;
					}
					
					?>
                <tr>
				<td></td>
				<td></td>
				<td></td>
				<td  colspan=3>
				<input type="hidden" name="jumlah" value="<?php echo $jumSis ?>" /><input type="submit" value="Simpan perubahan" name="update" class="btn btn-primary"/> 
				<?php
				if($this->session->userdata('status')=="admin")
					{?>
				 &nbsp;  -  &nbsp;<a  onclick="return confirm('Data belum disimpan,apakah Anda yakin batal?')" href="<?php echo base_url('admin_editnilai/edit_data_kehadiran?m=edit_nilai');?>" button class="btn btn-danger"/><small class="glyphicon glyphicon-chevron-left"></small> Batal</a>
				 <?php
					}elseif($this->session->userdata('status')=="guru")
					{?>
				&nbsp;  -  &nbsp;<a  onclick="return confirm('Data belum disimpan,apakah Anda yakin batal?')" href="<?php echo base_url('guru/input_kehadiran?m=input_kehadiran');?>" button class="btn btn-danger"/><small class="glyphicon glyphicon-chevron-left"></small> Batal</a>
				<?php
					}
				?>
				 </td>
                
				 </tr>  
				  </form>
				   </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
			
          </div>
</section>
