<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<?php echo $this->session->flashdata('notif');?>
		</div>
    </div>
    <div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">Edit Ekstra Kurikuler</h3>
            <hr>
		</div>
		<div class="box-body">
			<form action="<?php echo base_url('admin/update_ekstra');?>" method="post" class="form-horizontal">
				<div class="form-group">
					<label class="col-md-3 control-label">Ekstra Kurikuler</label>
					<div class="col-md-5">
						<input type="text" class="form-control" name="nama_ekstra" value="<?= $ekstra['nama_ekstra']?>"/>
					</div>
				</div>
				<div class="form-group">
					<label for="aksi" class="col-md-3 control-label"></label>
					<div class="col-md-5">
						<input type="hidden" name="id_ekstra" value="<?= $ekstra['id_ekstra']; ?>">
						<button type="submit" name="submit" value="Tambah" class="btn btn-primary">Update</button>
						<button type="reset" value="Reset"  class="btn btn-danger">Reset</button>
					</div>
				</div>
			</form>
		</div>
    </div>
</section>