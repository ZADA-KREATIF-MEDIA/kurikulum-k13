<section class="content">
    <div class="row">
		<div class="col-12">
			<div class="box">
                <div class="box-header row">
					<div class="col-8">
						<h3 class="box-title">Kelas  <?php echo $kelas->row('nama_kelas')." ".$kelas->row('id_kelas'); ?>, Semester <b><?php echo $semester_aktif; ?></b></h3>
					</div>
					<div class="col-4">
						<a href="<?= base_url('admin_editnilai/edit_data_kehadiran') ?>" class="btn btn-success float-right">Kembali</a>
					</div>
                </div><!-- /.box-header -->		
                <div class="box-body table-responsive no-padding">
					<table class="table table-hover table-bordered">
						<thead>
							<tr class="bg-secondary">
								<th rowspan=2>No</th>
								<th rowspan=2>NIS</th>
								<th rowspan=2>Nama</th>
								<th colspan=6>Ketidakhadiran<h6>S=sakit, I=ijin, TK=tanpa keterangan,</h6></th>
							</tr>
							<tr>
								<th bgcolor=#39CCCC>S</th> 
								<th bgcolor=#39CCCC>I</th> 
								<th bgcolor=#39CCCC>TK</th> 
							</tr>
						</thead>
						<?php 
							if($this->session->userdata('status')=="guru"){?>
								<form  action="<?php echo base_url('guru/proses_simpan_kehadiran');?>" method="post">
						<?php
							}elseif($this->session->userdata('status')=="admin"){?>
								<form  action="<?php echo base_url('admin_editnilai/proses_simpan_kehadiran');?>" method="post">
						<?php
							}
						?>
						<?php
							$ok = 1;
							foreach($data_kehadiran->result_array() as $row){
						?>	
							<input type="hidden" name="id_kelas" value="<?php echo $id_kelas;?>" />
							<input type="hidden" name="id_tahun" value="<?php echo $idtahun;?>" />	 
							<input type="hidden" name="semester" value="<?php echo $idsemester;?>" />
							<input type='hidden' name='nis<?=$ok?>' value='<?= $row['nis'] ?>" />
							<tr>
								<td><center><?php echo $ok;?></center></td>
								<td><?php echo $row['nis'];?> </td>
								<td> <?php echo $row['nama_siswa'];?></td>
								<td bgcolor=#fcfcfc><?php echo "<input type='text' name='a".$ok."' class='form-control input-sm' placeholder='0' />"; ?></td>
								<td bgcolor=#fcfcfc><?php echo "<input type='text' name='b".$ok."' class='form-control input-sm' placeholder='0' />"; ?></td>
								<td bgcolor=#fcfcfc><?php echo "<input type='text' name='c".$ok."' class='form-control input-sm' placeholder='0' />"; ?></td>
                    		</tr> 
						<?php
							$ok++;
						}
						?>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td colspan=3>
							<input type="hidden" name="jumlah" value="<?php echo $jumSis ?>" /><input type="submit" value="Simpan" name="insert" class="btn btn-primary"/> 
							&nbsp;  -  &nbsp;<a  href="<?php echo base_url('guru/input_kehadiran');?>" button class="btn btn-danger"/><small class="glyphicon glyphicon-chevron-left"></small> Batal</a>
							</td>
                
						</tr> 
						</form>
					</table>
                </div><!-- /.box-body -->
			</div><!-- /.box -->
        </div>
	</div>
</section>
