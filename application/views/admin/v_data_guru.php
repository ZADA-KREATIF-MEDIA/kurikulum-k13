  <!-- Content Header (Page header) -->
          <?php include('application/views/section_header.php');?>

 <section class="content">
 	 <div class="row">
            <div class="col-sm-12">
              <?php
              echo $this->session->flashdata('notif');?>
            </div>
          </div>
    <div class="row">
      <div class="col-md-8">
   <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Form Tambah Guru</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-plus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              	<form action="<?php echo base_url('admin/tambah_guru');?>" method="post" class="form-horizontal" enctype="multipart/form-data">
              		<div class="form-group">
              			<label for="nama" class="col-md-3 control-label">Nama Guru</label>
              			<div class="col-md-5">
              				<input type="text" class="form-control" name="nama_guru" value="<?php echo set_value('nama_guru');?>">
              			</div>
              		</div>
                   <div class="form-group">
                    <label for="niy/nigk" class="col-md-3 control-label">NIY/NIGK</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="niy" value="<?php echo set_value('niy');?>">
                    </div>
                  </div>
                
                   <div class="form-group">
                    <label for="niy/nigk" class="col-md-3 control-label">NIK (Nomor Induk Kependudukan)</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="nik" value="<?php echo set_value('nik');?>">
                    </div>
                  </div>
                  <div class="form-group">
              			<label for="kelamin" class="col-md-3 control-label">Kelmain</label>
              			<div class="col-md-5">
              				<select name="kelamin"  class="form-control" >
        							<option value="L">Laki-laki</option>
        							<option value="P">Perempuan</option>
        							</select>
              			</div>
              		</div>
                

                  <div class="form-group">
                    <label for="alamat" class="col-md-3 control-label">Alamat</label>
                    <div class="col-md-5">
                      <textarea class="form-control" name="alamat" placeholder="alamat lengkap"><?php echo set_value('alamat');?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="telepon" class="col-md-3 control-label">Telepon</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="telpon" value="<?php echo set_value('telpon');?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="username" class="col-md-3 control-label">Username</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="username" value="<?php echo set_value('username');?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="pwd" class="col-md-3 control-label">Password</label>
                    <div class="col-md-5">
                      <input type="password" class="form-control" name="password">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="repwd" class="col-md-3 control-label">Konfirmasi Password</label>
                    <div class="col-md-5">
                      <input type="password" class="form-control" name="repassword">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="foto" class="col-md-3 control-label">Foto guru</label>
                    <div class="col-md-5">
                      <input type="file" name="userfile">
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
        </div>
        <div class="col-md-4">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Import Data Guru</h3>
            </div>
            <div class="box-body">
              <small>Untuk import data guru, silahkan download file excel format import data guru di bawah ini!</small><br>
        <a href="<?php echo base_url('assets/files/format_excel_guru.xlsx');?>" class="btn btn-success"><i class="fa fa-download"></i> Download Format Import Guru (Excel)</a>
        <hr>
        <form action="<?php echo base_url();?>excel/do_upload_guru/" method="post" enctype="multipart/form-data" accept-charset="utf-8">
    <input type="file" name="userfile"/>
    <input type="submit" name="name" value="Upload file" class="btn btn-sm btn-primary" />
</form>
            </div>
          </div>
        </div>
      </div>
		  <!-- /data kelas -->
		 <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Daftar Nama Semua Guru</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
            	<div class="col-md-12">
				<form action="<?php echo base_url('admin/aksi_guru');?>" method="post">
					<div class="table-responsive">
				<table  id="example2" class="table table-bordered table-hover no-padding" >
          <thead>
                    <tr bgcolor=#fafafa>
                      <th>#</th>
          <th>No </th>
          <th width="24%">Nama Guru</th>
          <th width="10%">NIY/NIGK</th>
          <th width="7%">Kelamin</th>
          <th width="22%">Alamat</th>
          <th width="13%">Telpon</th>
          <th width="11%">Username</th>
           
          <th width="15%">Aksi</th>
        </tr>
         </thead>
        <tbody>
        <?php
        $no=$this->uri->segment(3)+1;
        foreach($data->result_array() as $row){
        ?>  
        <tr>
          <td><div class="checkbox icheck"><input type="checkbox" name="check[]" value="<?php echo $row['id_guru'] ;?>"></div></td>
          <td><?php echo $no++;?></td>
          <td><?php echo $row['nama_guru'];?></td>
          <td><?php echo $row['nip'];?></td>
          <td><?php echo $row['kelamin'];?></td>
          <td><?php echo $row['alamat_guru'];?></td>
          <td><?php echo $row['telpon_guru'];?></td>
          <td><?php echo $row['username'];?></td>
          <td><a href="<?php echo base_url('admin/edit_guru/'.$row['id_guru'].'?m=data_induk&sm=guru');?>"  class="btn btn-primary" title="Edit"> <i class="fa fa-pencil-square"></i> </a> &nbsp; 
              <a href="<?php echo base_url('admin/drop_guru/'.$row['id_guru'].'');?>"  class="btn btn-danger" title="Hapus" onclick="return konfirmasi();"> <i class="fa fa-trash"></i> </a>     
          </td>
        </tr>
        <?php
        }
        ?>
        </tbody>
        </table>
        <br>
        <center><?php echo $pagination;?></center>

				<hr>
				<h4>Aksi dengan data yang dipilih :</h4>
				<button class="btn btn-danger btn-sm" type="submit" name="multidelete" onclick="return konfirmasi();"><i class="fa fa-trash"></i> Hapus Data Guru</button>
				
				<br><br>
				</div>
				<!--  end product-table................................... --> 
				</form>
				</div>
				
            </div><!-- /.box-body -->
          
          </div>
 </section>		  
