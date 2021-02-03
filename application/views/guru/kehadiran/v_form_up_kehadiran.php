<!-- end page-heading -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<?php echo $this->session->flashdata('notif');?>
		</div>
	</div>
    <div class="row">
    	<div class="col-md-12">
		<div class="alert alert-primary" role="alert">
		<h5 class="box-title">Kelas  <?php echo $kelas->row('nama_kelas'); ?>, Semester <b><?php echo $semester_aktif; ?></b></h5>
</div>
            <div class="box">
                <div class="box-header">
					
                </div><!-- /.box-header -->
                <div class="box-body ">
            		<table  class="table  table-bordered  table-responsive">
						<thead class="text-center">
							<tr class="">
								<th rowspan=2>No.</th>
								<th rowspan=2>Nis</th>
								<th rowspan=2>Nama</th>
							
							</tr>
							<tr class="">
								<th >Sakit</th> 
								<th >Ijin</th> 
								<th >Tanpa Keterangan</th> 
							</tr>
						</thead>
						<?php if($this->session->userdata('status')=="guru") : ?>
							<form action="<?php echo base_url('guru/proses_simpan_kehadiran');?>" method="post">
						<?php elseif($this->session->userdata('status')=="admin"):?>
							<form action="<?php echo base_url('admin_editnilai/proses_simpan_kehadiran');?>" method="post">
						<?php endif; ?>
						<?php
							$ok = 1;
							foreach($data_kehadiran->result_array() as $row):
						?>	
							<input type="hidden" name="id_kelas" value="<?php echo $id_kelas;?>" />
							<input type="hidden" name="id_tahun" value="<?php echo $idtahun;?>" />	 
							<input type="hidden" name="semester" value="<?php echo $idsemester;?>" />
							<input type='hidden' name='nis<?=$ok?>' value="<?= $row['nis'] ?>" >
						<tr>
							<td><center><?php echo $ok;?></center></td>
							<td><?php echo $row['nis'];?> </td>
							<td> <?php echo $row['nama_siswa'];?></td>
							<td  bgcolor=#fcfcfc><?php echo "<input type='text' name='a".$ok."' class='form-control input-sm' value='".$row['sakit']."' />"; ?></td>
							<td  bgcolor=#fcfcfc><?php echo "<input type='text' name='b".$ok."' class='form-control input-sm' value='".$row['izin']."'/>"; ?></td>
							<td  bgcolor=#fcfcfc><?php echo "<input type='text' name='c".$ok."' class='form-control input-sm' value='".$row['tnp_ket']."'/>"; ?></td>
						</tr> 
					<?php
						$ok++;
						endforeach;
					?>
						<tr>
							
							<td  colspan="6">
								<input type="hidden" name="jumlah" value="<?php echo $jumSis ?>" /><input type="submit" value="Simpan perubahan" name="update" class="btn btn-primary"/> 
								<?php if($this->session->userdata('status')=="admin"):?>
									&nbsp;  -  &nbsp;<a  onclick="return confirm('Data belum disimpan,apakah Anda yakin batal?')" href="<?php echo base_url('admin_editnilai/edit_data_kehadiran');?>" button class="btn btn-danger"/><small class="glyphicon glyphicon-chevron-left"></small> Batal</a>
								<?php elseif($this->session->userdata('status')=="guru") : ?>
									&nbsp;  -  &nbsp;<a  onclick="return confirm('Data belum disimpan,apakah Anda yakin batal?')" href="<?php echo base_url('guru/input_kehadiran');?>" button class="btn btn-danger"/><small class="glyphicon glyphicon-chevron-left"></small> Batal</a>
								<?php endif; ?>
							</td>
						</tr>  
						</form>
					</table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>		
    </div>
</section>
