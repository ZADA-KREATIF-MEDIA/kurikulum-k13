<section class="content">
    <div class="row">
		<div class="col-sm-12">
        <?php
			echo $this->session->flashdata('error_open').$this->session->flashdata('validation_errors').$this->session->flashdata('error_close');
		?>
        </div>
    </div>
    <div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">Update Kelas</h3>
		</div>
        <hr>
		<div class="box-body">
			<form action="<?php echo base_url('admin/update_kelas');?>" method="post" class="form-horizontal">
				<div class="form-group">
					<label for="nama">Nama Kelas</label>
					<input type="text" class="form-control" name="nama_kelas" value="<?= $kelas['nama_kelas'] ?>"/>
				</div>
				<div class="form-group">
					<input type="hidden" name="id" value="<?= $kelas['id_kelas']?>">
                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
                    <button type="reset" value="Reset"  class="btn btn-danger">Reset</button>
				</div>
			</form>
		</div>
    </div>
</section>