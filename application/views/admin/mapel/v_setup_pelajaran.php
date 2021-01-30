<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<?php
			echo $this->session->flashdata('error_open').$this->session->flashdata('validation_errors').$this->session->flashdata('error_close');
			echo $this->session->flashdata('sukses');?>
		</div>
    </div>
	<div class="box">
		<div class="d-flex justify-content-between col-12 mb-3">
			<h3 class="card-title mb-0">DATA MATA PELAJARAN SD SANTA MARIA TIMIKA</h3>
			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambahMapelModal"><small>TAMBAH DATA MATA PELAJARAN</small></button>
    	</div>
        <div class="box-body">
            <div class="col-md-12">
				<table id="myTable" class="table table-bordered">
					<thead>
						<tr>
							<th style="width:5%;">No</th>
							<th style="width:45%;">Nama Pelajaran</th>
							<th style="width:15%;">Aksi</th>
						</tr>
					</thead>
					<?php
						$no=1;
						foreach($datamapel->result_array() as $row){
					?>	
						<tr>
							<td><?php echo $no++;?></td>
							<td><?php echo ucwords($row['nama_pelajaran']);?></td>
							<td class="text-center">
								<button type="button" data-toggle="modal" data-target="#mapelModal<?= $row['id_pelajaran']?>"  class="btn btn-primary" title="Edit"> <i class="fa fa-edit"></i> </button> &nbsp; 
								<a href="<?php echo base_url('admin/drop_mapel/'.$row['id_pelajaran']);?>"  class="btn btn-danger" title="Hapus" onclick="return konfirmasi();"> <i class="fa fa-trash"></i> </a>
							</td>
						</tr>
					<?php
					}
					?>
				</table>
			</div>
        </div><!-- /.box-body -->
    </div>
</section>	
<!-- Modal -->
<div class="modal fade" id="tambahMapelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Mata Pelajaran</h5>
			</div>
			<form action="<?php echo base_url('admin/create_mapel');?>" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label for="kat_mapel">Kategori Mata Pelajaran</label>
						<select name="kat_mapel" id="kat_mapel" class="form-control">
							<?php foreach($kat_mapel->result_array() as $km):?>
								<option value="<?= $km['id_kat_mapel']?>"><?= $km['kategori_mapel'] ?></option>
							<?php endforeach;?>
						</select>
					</div>
					<div class="form-group">
						<label for="nama_pelajaran">Nama Mata Pelajaran</label>
						<input type="text" class="form-control" id="nama_pelajaran" name="nama_pelajaran">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>	 
<?php foreach($datamapel->result_array() as $dm):?>
	<div class="modal fade" id="mapelModal<?= $dm['id_pelajaran'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Tambah Mata Pelajaran</h5>
				</div>
				<form action="<?php echo base_url('admin/update_mapel');?>" method="POST">
					<input type="hidden" name="id_pelajaran" value="<?= $dm['id_pelajaran']?>">
					<div class="modal-body">
						<div class="form-group">
							<label for="kat_mapel">Kategori Mata Pelajaran</label>
							<select name="kat_mapel" id="kat_mapel" class="form-control">
								<?php foreach($kat_mapel->result_array() as $km):?>
									<option value="<?= $km['id_kat_mapel']?>" <?php if($dm['id_kat_mapel'] == $km['id_kat_mapel']){echo "selected"; }?>><?= $km['kategori_mapel'] ?></option>
								<?php endforeach;?>
							</select>
						</div>
						<div class="form-group">
							<label for="nama_pelajaran">Nama Mata Pelajaran</label>
							<input type="text" class="form-control" id="nama_pelajaran" name="nama_pelajaran" value="<?= $dm['nama_pelajaran']?>">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
						<button type="submit" class="btn btn-primary">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>	  
<?php endforeach; ?>
