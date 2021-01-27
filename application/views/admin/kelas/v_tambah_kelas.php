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
			<h3 class="box-title">Tambah Kelas</h3>
		</div>
        <hr>
		<div class="box-body">
			<form action="<?php echo base_url('admin/create_kelas');?>" method="post" class="form-horizontal">
				<div class="form-group">
					<label for="nama">Nama Kelas</label>
					<input type="text" class="form-control" name="nama_kelas"/>
				</div>
				<div class="form-group">
                    <button type="submit" name="submit" value="Tambah" class="btn btn-primary">Tambah</button>
                    <button type="reset" value="Reset"  class="btn btn-danger">Reset</button>
				</div>
			</form>
		</div>
    </div>
</section>