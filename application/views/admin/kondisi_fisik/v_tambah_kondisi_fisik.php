<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<?php echo $this->session->flashdata('sukses'); ?>
		</div>
	</div>
	<div class="box">
		<div class="d-flex justify-content-between col-12 mb-3">
			<h3 class="card-title mb-0">TAMBAH KONDISI FISIk SISWA SD SANTA MARIA TIMIKA</h3>
		</div>
		<div class="box-body">
			<div class="col-md-12">
				<form action="<?= base_url('admin/store_kondisi_fisik') ?>" method="POST">
					<div class="form-group">
						<label for="nama_siswa">Nama Siswa</label>
						<select name="nama_siswa" id="nama_siswa" class="form-control inputSiswa" required>
							<?php foreach ($siswa as $sw) : ?>
								<option value="<?= $sw['id_siswa'] ?>"><?= $sw['nama_siswa'] ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="berat">Penglihatan</label>
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Masukkan Kondisi Penglihatan siswa" id="penglihatan" name="penglihatan" required>
								
							</div>
						</div>
						<div class="form-group col-md-6">
							<label for="tinggi">Pendengaran</label>
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Masukkan Kondisi Pendengaran Siswa" id="pendengaran" name="pendengaran" required>
								
							</div>
						</div>
						<div class="form-group col-md-6">
							<label for="tinggi">Gigi</label>
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Masukkan Kondisi Gigi Siswa" id="gigi" name="gigi" required>
								
							</div>
						</div>
						<div class="form-group col-md-6">
							<label for="semester">Semester</label>
							<select name="semester" id="semester" class="form-control">
								<?php foreach($semester as $smt):?>
									<option value="<?= $smt['id_semester']?>"><?= ucwords($smt['semester'])?></option>
								<?php endforeach;?>
							</select>
						</div>
						<div class="form-group col-md-6">
							<label for="tahun">Tahun</label>
							<select name="tahun" id="tahun" class="form-control">
								<?php foreach($tahun as $thn):?>
									<option value="<?= $thn['id_tahun']?>"><?= $thn['tahun'] ?></option>
								<?php endforeach;?>
							</select>
						</div>
					</div>
					<button type="submit" class="btn btn-success">Simpan</button>
					<a href="<?= base_url('admin/kondisi_fisik') ?>" class="btn btn-info">Kembali</a>
				</form>
			</div>
		</div><!-- /.box-body -->
	</div>
</section>