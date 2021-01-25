  <!-- Content Header (Page header) -->
<?php 
include('application/views/section_header.php');
$info = $identitas_sekolah->row();
          ?>

 <section class="content">
 	 <div class="row">
            <div class="col-sm-12">
              <?php
              echo $this->session->flashdata('notif');?>
            </div>
          </div>
   <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Info Sekolah</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              	<form action="<?php echo base_url('admin/update_infosekolah');?>" method="post" class="form-horizontal" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="nama" class="col-md-3 control-label">Nama Aplikasi</label>
                    <div class="col-md-5">
                      
                      <input type="text" class="form-control" name="nama_aplikasi" value="<?php echo $info->nama_aplikasi;?>">
                    </div>
                  </div>
              		<div class="form-group">
              			<label for="nama" class="col-md-3 control-label">Nama Sekolah</label>
              			<div class="col-md-5">
                      <input type="hidden" name="id" value="<?php echo $info->id;?>">
              				<input type="text" class="form-control" name="nama_sekolah" value="<?php echo $info->nama_sekolah;?>">
              			</div>
              		</div>
                  <div class="form-group">
                    <label for="nis" class="col-md-3 control-label">NPSN / NSS</label>
                    <div class="col-md-3">
                      <input type="text" class="form-control" name="npsn" value="<?php echo $info->npsn;?>" title="npsn">
                    </div>
                    <div class="col-md-3">
                      <input type="text" class="form-control" name="nss" value="<?php echo $info->nss;?>" title="nss">
                    </div>
                  </div>
                   <div class="form-group">
                    <label for="nis" class="col-md-3 control-label">Alamat Sekolah</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="alamat" value="<?php echo $info->alamat_sekolah;?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="nis" class="col-md-3 control-label">Kode Pos</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="kode_pos" value="<?php echo $info->kode_pos;?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="telepon" class="col-md-3 control-label">Telepon</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="telpon" value="<?php echo $info->telpon;?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="" class="col-md-3 control-label">Kelurahan</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="kelurahan" value="<?php echo $info->kelurahan;?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="nis" class="col-md-3 control-label">Kecamatan</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="kecamatan" value="<?php echo $info->kecamatan;?>">
                    </div>
                  </div>
                <div class="form-group">
                    <label for="" class="col-md-3 control-label">Kabupaten</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="kabupaten" value="<?php echo $info->kabupaten;?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="" class="col-md-3 control-label">Provinsi/Daerah</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="provinsi" value="<?php echo $info->provinsi;?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="" class="col-md-3 control-label">Website</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="website" value="<?php echo $info->website;?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="username" class="col-md-3 control-label">Email</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="email" value="<?php echo $info->email;?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="logo" class="col-md-3 control-label">Logo Sekolah</label>
                    <div class="col-md-5">
                      <input type="file" name="file"><br><br>
                      <input type="hidden" name="fotolama" value="<?php echo $info->logo;?>">
                      <?php
                      if($info->logo!='')
                      {
                        echo "<img src='".base_url('assets/photos/'.$info->logo.'')."' class='img-responsive img-rounded' alt='logo-sekolah'/>";
                      }
                      ?>
                    </div>
                   
                  </div>
                
              		<div class="form-group">
              			<label for="aksi" class="col-md-3 control-label"></label>
              			<div class="col-md-5">
              				<input type="submit" name="submit" value="Simpan" class="btn btn-primary" />
                           <input type="reset" value="Reset"  class="btn btn-danger" />
              			</div>
              		</div>
 	         		
           
				</form>
								
            </div>
          
          </div>
		  <!-- /data kelas -->
		 
 </section>		  
