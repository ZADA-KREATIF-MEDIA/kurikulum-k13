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
			<h3 class="card-title mb-0">DATA TINGGI DAN BERAT SISWA SD SANTA MARIA TIMIKA</h3>
			<a href="<?= base_url('guru/tambah_berat_tinggi') ?>" class="btn btn-success"><small>TAMBAH DATA TINGGI DAN BERAT</small></a>
    	</div>
        <div class="box-body">
            <div class="col-md-12">
				<table id="myTable" class="table table-bordered">
					<thead>
						<tr>
							<th style="width:5%;">No</th>
							<th>Nama Siswa</th>
							<th>Tinggi</th>
							<th>Berat</th>
							<th style="width:15%;">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$i = 1;
							foreach($siswa as $sw):?>
							<tr>
								<td><?= $i ?></td>
								<td><?= $sw['nama_siswa'] ?></td>
								<td><?= $sw['tinggi_badan'].' Kg' ?></td>
								<td><?= $sw['berat_badan'].' Cm' ?></td>
								<td>
									<a href="<?= base_url('guru/edit_berat_tinggi/')?><?= $sw['id']?>" class="btn btn-primary text-center"><i class="fa fa-edit"></i></a>
									<a href="<?= base_url('guru/hapus_berat_tinggi/')?><?= $sw['id']?>" class="btn btn-danger text-center"><i class="fa fa-trash"></i></a>
								</td>
							</tr>
						<?php
							$i++;
							endforeach;?>
					</tbody>
				</table>
			</div>
        </div><!-- /.box-body -->
    </div>
</section>	

