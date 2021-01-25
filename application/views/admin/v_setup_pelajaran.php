
  <!-- Content Header (Page header) -->
          <?php include('application/views/section_header.php');?>

 <section class="content">
 	 <div class="row">
            <div class="col-sm-12">
              <?php
              echo $this->session->flashdata('error_open').$this->session->flashdata('validation_errors').$this->session->flashdata('error_close');
              echo $this->session->flashdata('sukses');?>
            </div>
          </div>
   <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Mata Pelajaran</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              	<form action="<?php echo base_url('admin/create_mapel');?>" method="post" class="form-horizontal">
                  <div class="form-group">
                    <label class="col-md-3 control-label">Kategori Mata Pelajaran</label>
                      <div class="col-md-5">
                  <select class="form-control" name="kat_mapel">
                <?php foreach($kat_mapel->result() as $km){
                echo "<option value='$km->id_kat_mapel'>$km->kategori_mapel</option>";
              }
                ?>
              </select>
                </div>
              </div>
              		<div class="form-group">
              			<label class="col-md-3 control-label">Nama Mata Pelajaran</label>
              			<div class="col-md-5">
              				<input type="text" class="form-control" name="nama_pelajaran"/>
              			</div>
              		</div>
					<div class="form-group">
              			<label class="col-md-3 control-label">Sub Mata Pelajaran di</label>
              			<div class="col-md-5">
              				<select class="form-control" name="sub_mapel">
							<option value="" selected=""><em>Null</em></option>
              <?php foreach($datamapel->result() as $mpl){
							   echo "<option value='$mpl->id_pelajaran'>$mpl->nama_pelajaran</option>";
               }
              ?>
							</select>
							<span class="help-block">Pilih <em>Null</em> jika tidak menjadi sub mata pelajaran</span>
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
		  <!-- /data kelas -->
		 <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Daftar Mata Pelajaran</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
            	<div class="col-md-8">
				<form action="<?php echo base_url('admin/aksi_mapel/?m=setup&sm=pelajaran');?>" method="post">
					<div class="table-responsive">
				<table id="example1" class="table table-bordered">
				<thead>
				<tr>
					<th style="width:5%;">#</th>
					<th style="width:5%;">No</th>
					<th style="width:45%;">Nama Pelajaran</th>
					<th style="width:15%;">Aksi</th>
				</tr>
				</thead>
				
				<?php
				//$no=$this->uri->segment(3)+1;
				$no=1;
				foreach($datamapel->result_array() as $row){
				?>	
				<tr>
					<td><div class="checkbox icheck"><input type="checkbox" name="check[]" value="<?php echo $row['id_pelajaran'] ;?>"></div></td>
					<td><?php echo $no++;?></td>
					<td><?php echo $row['nama_pelajaran'];?></td>
					<td align="center"><a href="<?php echo base_url('admin/edit_mapel/'.$row['id_pelajaran'].'?m=setup&sm=pelajaran');?>"  class="btn btn-primary" title="Edit"> <i class="fa fa-pencil-square"></i> </a> &nbsp; 
                           <?php /*<a href="<?php echo base_url('admin/drop_mapel/'.$row['id_pelajaran'].'');?>"  class="btn btn-danger" title="Hapus" onclick="return konfirmasi();"> <i class="fa fa-trash"></i> </a>*/?>
					</td>
				</tr>
				<?php
				}
				?>
				</table>
				<br>
        <!--<center><?php //echo $pagination;?></center>-->

				<hr>
				<h4>Aksi dengan data yang dipilih :</h4>
				<!--<button class="btn btn-danger btn-sm" type="submit" name="multidelete" onclick="return konfirmasi();"><i class="fa fa-trash"></i> Hapus Mata Pelajaran</button>-->
				<button class="btn btn-primary btn-sm" type="submit" name="multiedit"><i class="fa fa-pencil-square"></i> Edit Mata Pelajaran</button>
				<br><br>
				</div>
				<!--  end product-table................................... --> 
				</form>
				</div>
				
            </div><!-- /.box-body -->
          
          </div>
 </section>		  
