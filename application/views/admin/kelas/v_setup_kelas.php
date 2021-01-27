<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<?php
			echo $this->session->flashdata('error_open').$this->session->flashdata('validation_errors').$this->session->flashdata('error_close');
			echo $this->session->flashdata('sukses');?>
		</div>
	</div>
	<div class="box">
		<div class="col-md-12 d-flex justify-content-between mb-4">
            <h3 class="card-title">DATA KELAS SD SANTA MARIA TIMIKA</h3>
            <a href="<?= base_url() ?>admin/tambah_kelas" class="btn btn-success"><small>TAMBAH DATA KELAS</small></a>
        </div>
		<div class="box-body">
			<div class="col-md-12">
				<div class="table-responsive">
					<table id="example2" class="table table-bordered">
						<thead>
							<tr class="text-center">
								<th style="width:5%;">No</th>
								<th style="width:30%;">Nama Kelas</th>
								<th style="width:30%;">Aksi</th>
							</tr>
						</thead>
						<?php
						$no=$this->uri->segment(3)+1;
						foreach($data->result_array() as $row){
						?>	
							<tr>
								<td><?php echo $no++;?></td>
								<td><?php echo $row['nama_kelas'];?></td>
								<td class="text-center">
									<a href="<?php echo base_url('admin/edit_kelas/'.$row['id_kelas']);?>"  class="btn btn-primary" title="Edit"><i class="fa fa-edit"></i> </a> &nbsp; 
									<a href="<?php echo base_url('admin/drop_kelas/'.$row['id_kelas']);?>"  class="btn btn-danger" title="Hapus"><i class="fa fa-trash"></i> </a> &nbsp; 
								</td>
							</tr>
						<?php
						}
						?>
					</table>
					<br>
					<center><?php echo $pagination;?></center>
					<hr>
				</div>
			</div>
        </div><!-- /.box-body -->
    </div>
</section>		  