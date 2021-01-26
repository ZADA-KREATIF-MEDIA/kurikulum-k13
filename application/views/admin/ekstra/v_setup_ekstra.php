<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<?php echo $this->session->flashdata('notif');?>
		</div>
    </div>
	<div class="box">
		<div class="d-flex justify-content-between">
            <h3 class="card-title mb-0">DATA EKSTRA KULIKULER SD SANTA MARIA TIMIKA</h3>
            <a href="<?= base_url() ?>admin/tambah_ekstra" class="btn btn-success"><small>TAMBAH DATA EKSTRAKULIKULER</small></a>
        </div>
		<br>
		<div class="box-body">
            <div class="col-md-12">
				<div class="table-responsive">
					<table id="example1" class="table table-bordered">
						<thead>
							<tr>
								<th style="width:5%;">No</th>
								<th style="width:45%;">Kegiatan Ekstra Kurikuler</th>
								<th style="width:15%;">Aksi</th>
							</tr>
						</thead>
						<?php
						$no=1;
						foreach($dataekstra->result_array() as $row){
						?>	
						<tr>
							<td><?php echo $no++;?></td>
							<td><?php echo $row['nama_ekstra'];?></td>
							<td align="center">
								<a href="<?php echo base_url('admin/edit_ekstra/'.$row['id_ekstra']);?>" class="btn btn-primary" title="Edit"> <i class="fa fa-edit"></i> </a> &nbsp; 
								<a href="<?php echo base_url('admin/drop_ekstra/'.$row['id_ekstra']);?>"  class="btn btn-danger" title="Hapus" onclick="return konfirmasi();"> <i class="fa fa-trash"></i></a>
							</td>
						</tr>
						<?php
						}
						?>
					</table>
				</div>
			</div>
				
        </div>
    </div>
</section>		  
