<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<?php echo $this->session->flashdata('sukses');?>
		</div>
    </div>
	<div class="box">
		<div class="d-flex justify-content-between col-12 mb-3">
			<h3 class="card-title mb-0">EDIT TINGGI DAN BERAT SISWA SD SANTA MARIA TIMIKA</h3>
    	</div>
        <div class="box-body">
            <div class="col-md-12">
				<form action="<?= base_url('admin/update_berat_tinggi')?>" method="POST">
					<div class="form-group">
						<input type="hidden" name="id_siswa" value="<?= $siswa['id']?>">
						<label for="nama_siswa">Nama Siswa</label>
						<input type="text" class="form-control" id="nama_siswa" value="<?= $siswa['nama_siswa'] ?>" readonly>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="berat">Berat Badan</label>
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Masukkan berat badan siswa" id="berat" name="berat" value="<?= $siswa['berat_badan'] ?>" onkeyup="this.value=this.value.replace(/[^\d]/,'')" required>
								<div class="input-group-append">
									<span class="input-group-text">Kg</span>
								</div>
							</div>
						</div>
						<div class="form-group col-md-6">
							<label for="tinggi">Tinggi Badan</label>
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Masukkan tinggi badan siswa" id="tinggi" name="tinggi" value="<?= $siswa['tinggi_badan'] ?>" onkeyup="this.value=this.value.replace(/[^\d]/,'')" required>
								<div class="input-group-append">
									<span class="input-group-text">cm</span>
								</div>
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
					<a href="<?= base_url('admin/tinggi_berat') ?>" class="btn btn-info">Kembali</a>
				</form>
			</div>
        </div><!-- /.box-body -->
    </div>
</section>	

