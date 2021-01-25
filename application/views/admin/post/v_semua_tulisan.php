
  <!-- Content Header (Page header) -->
          <?php include('application/views/section_header.php');?>

 <section class="content">
 	 <div class="row">
            <div class="col-sm-12">
              <?php
              echo $this->session->flashdata('notif');?>
            </div>
          </div>
   
		 <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Tulisan</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
            	<div class="col-md-12">
				<form action="<?php echo base_url('admin/aksi_tulisan');?>" method="post">
					<div class="table-responsive">
				<table id="example1" class="table table-bordered">
				<thead>
				<tr>
					<th style="width:5%;">#</th>
					<th style="width:5%;">No</th>
					<th style="width:15%;">Tanggal</th>
          <th style="width:15%;">Kategori</th>
					<th style="width:35%;">Judul</th>
          <th style="width:15%;">Pemirsa</th>
          <th style="width:15%;">Penulis</th>
					<th style="width:30%;">Aksi</th>
				</tr>
				</thead>
				
				<?php
				$no=1;
				foreach($data_tulisan->result_array() as $row){
				?>	
				<tr>
					<td><div class="checkbox icheck"><input type="checkbox" name="check[]" value="<?php echo $row['id_post'] ;?>"></div></td>
					<td><?php echo $no++;?></td>
          <td><center><?php echo tgl_indoo($row['tgl_post']);?></center></td>
          <td><?php echo ucwords($row['type_post']);?></td>
					<td><?php echo $row['judul_post'];?></td>
          <td><?php echo ucwords(str_replace("_", " ", $row['privacy_post']));?></td>
          <td><?php echo $row['author'];?></td>
					
					<td align="center"><a href="<?php echo base_url('admin/edit_tulisan/'.$row['id_post'].'?m=post&sm=edit_tulisan');?>"  class="btn btn-primary" title="Edit"> <i class="fa fa-pencil-square"></i> </a> &nbsp; 
              <a href="<?php echo base_url('admin/aksi_tulisan/'.$row['id_post'].'?aksi=delete');?>"  class="btn btn-danger" title="Hapus" onclick="return konfirmasi();"> <i class="fa fa-trash"></i> </a>
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
				<button class="btn btn-danger btn-sm" type="submit" name="multidelete" onclick="return konfirmasi();"><i class="fa fa-trash"></i> Hapus Tulisan</button>
				<!--<button class="btn btn-primary btn-sm" type="submit" name="multiedit"><i class="fa fa-pencil-square"></i> Edit Kelas</button>-->
				<br><br>
				</div>
				<!--  end product-table................................... --> 
				</form>
				</div>
				
            </div><!-- /.box-body -->
          
          </div>
 </section>		  
