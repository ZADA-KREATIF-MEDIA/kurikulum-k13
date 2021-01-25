
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
   <div class="box collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Kelas</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-plus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              	<form action="<?php echo base_url('admin/create_kelas');?>" method="post" class="form-horizontal">
              		<div class="form-group">
              			<label for="nama" class="col-md-3 control-label">Nama Kelas</label>
              			<div class="col-md-5">
              				<input type="text" class="form-control" name="nama_kelas"/>
              			</div>
              		</div>
              		<div class="form-group">
              			<label for="kategori" class="col-md-3 control-label">Kategori Kelas</label>
              			<div class="col-md-5">
              				<select name="kategori_kls"  class="form-control" >
							<option>10-ipa</option>
              <option>10-ips</option>
							<option>11-ipa</option>
							<option>11-ips</option>
							<option>12-ipa</option>
							<option>12-ips</option>
							</select>
              			</div>
              		</div>
              		<div class="form-group">
              			<label for="aksi" class="col-md-3 control-label"></label>
              			<div class="col-md-5">
              				<input type="submit" name="submit" value="Tambah" class="btn btn-primary" />
                           <input type="reset" value="Reset"  class="btn btn-danger" />
              			</div>
              		</div>
 	         		
           
				</form>
								
            </div>
          
          </div>
		  <!-- /data kelas -->
		 <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Daftar Kelas</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
            	<div class="col-md-6">
				<form action="<?php echo base_url('admin/aksi_kelas/?m=setup&sm=kelas');?>" method="post">
					<div class="table-responsive">
				<table id="example2" class="table table-bordered">
				<thead>
				<tr>
					<th style="width:5%;">#</th>
					<th style="width:5%;">No</th>
					<th style="width:30%;">Nama Kelas</th>
					<th style="width:35%;">Kategori Kelas</th>
					<th style="width:30%;">Aksi</th>
				</tr>
				</thead>
				
				<?php
				$no=$this->uri->segment(3)+1;
				foreach($data->result_array() as $row){
				?>	
				<tr>
					<td><div class="checkbox icheck"><input type="checkbox" name="check[]" value="<?php echo $row['id_kelas'] ;?>"></div></td>
					<td><?php echo $no++;?></td>
					<td><center><?php echo $row['nama_kelas'];?></center></td>
					<td><?php echo $row['kategori_kls'];?></td>
					<td align="center"><a href="<?php echo base_url('admin/edit_kelas/'.$row['id_kelas'].'?m=setup&sm=kelas');?>"  class="btn btn-primary" title="Edit"> <i class="fa fa-pencil-square"></i> </a> &nbsp; 
                           <?php /*<a href="<?php echo base_url('admin/drop_kelas/'.$row['id_kelas'].'');?>"  class="btn btn-danger" title="Hapus" onclick="return konfirmasi();"> <i class="fa fa-trash"></i> </a>*/?>
					</td>
				</tr>
				<?php
				}
				?>
				</table>
        <br>
        <center><?php echo $pagination;?></center>

				<hr>
				<h4>Aksi dengan data yang dipilih :</h4>
				<!--<button class="btn btn-danger btn-sm" type="submit" name="multidelete" onclick="return konfirmasi();"><i class="fa fa-trash"></i> Hapus Kelas</button>-->
				<button class="btn btn-primary btn-sm" type="submit" name="multiedit"><i class="fa fa-pencil-square"></i> Edit Kelas</button>
				<br><br>
				</div>
				<!--  end product-table................................... --> 
				</form>
				</div>
				
            </div><!-- /.box-body -->
          
          </div>
 </section>		  
		  
<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
 
<tr>
    <td id="tbl-border-left"></td>
    <td>
    <!--  start content-table-inner ...................................................................... START -->
    <div id="content-table-inner">
    		

      	<!--  start product-table ..................................................................................... -->
       
        
        
	<div class="clear"></div>
     
    </div>
    <!--  end content-table-inner ............................................END  -->
    </td>
    <td id="tbl-border-right"></td>
</tr>
<tr>
    <th class="sized bottomleft"></th>
    <td id="tbl-border-bottom">&nbsp;</td>
    <th class="sized bottomright"></th>
</tr>
</table>
