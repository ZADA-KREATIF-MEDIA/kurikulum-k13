<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<?php echo $this->session->flashdata('notif');?>
		</div>
    </div>
    <div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">Tambah Ekstra Kurikuler</h3>
            <hr>
		</div>
		<div class="box-body">
			<form action="<?php echo base_url('admin/create_ekstra');?>" method="post" class="form-horizontal">
				<div class="form-group">
					<label class="col-md-3 control-label">Ekstra Kurikuler</label>
					<div class="col-md-5">
						<input type="text" class="form-control" name="nama_ekstra"/>
					</div>
				</div>
				<div class="form-group">
					<label for="aksi" class="col-md-3 control-label"></label>
					<div class="col-md-5">
						<input type="submit" name="submit" value="Tambah" class="btn btn-primary" /> <input type="reset" value="Reset"  class="btn btn-danger" />
					</div>
				</div>
			</form>
		</div>
    </div>
</section>