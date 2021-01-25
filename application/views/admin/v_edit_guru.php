  <!-- Content Header (Page header) -->
          <?php include('application/views/section_header.php');?>
<?php
$row = $data_guru->row();?>
 <section class="content">
 	 <div class="row">
            <div class="col-sm-12">
              <?php
              echo $this->session->flashdata('notif');?>
            </div>
          </div>
   <div class="box">
            <div class="box-header with-border">
              <script type="text/javascript">
                function go_guru()
                {
                  document.location.href="<?php echo base_url('admin/data_guru');?>";
                }
              </script>

              <h3 class="box-title"><button onclick="return go_guru();" type="button" class="btn btn-primary btn-sm"><i class="fa fa-arrow-circle-left"></i> Kembali</button> Edit Data Guru</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-plus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              	<form action="<?php echo base_url('admin/update_guru');?>" method="post" class="form-horizontal" enctype="multipart/form-data">
              		<div class="form-group">
              			<label for="nama" class="col-md-3 control-label">Nama Guru</label>
              			<div class="col-md-5">
                      <input type="hidden" name="id_guru" value="<?php echo $row->id_guru;?>">
              				<input type="text" class="form-control" name="nama_guru" value="<?php echo $row->nama_guru;?>">
              			</div>
              		</div>
                   <div class="form-group">
                    <label for="niy/nigk" class="col-md-3 control-label">NIY/NIGK</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="niy" value="<?php echo $row->nip;?>">
                    </div>
                  </div>
                
                   <div class="form-group">
                    <label for="niy/nigk" class="col-md-3 control-label">NIK (Nomor Induk Kependudukan)</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="nik" value="<?php echo $row->nik;?>">
                    </div>
                  </div>
                  <div class="form-group">
              			<label for="kelamin" class="col-md-3 control-label">Kelmain</label>
              			<div class="col-md-5">
              				<select name="kelamin"  class="form-control" >
        							<option value="L" <?php if($row->kelamin=="L"){echo "selected";}?>>Laki-laki</option>
        							<option value="P" <?php if($row->kelamin=="P"){echo "selected";}?>>Perempuan</option>
        							</select>
              			</div>
              		</div>
                

                  <div class="form-group">
                    <label for="alamat" class="col-md-3 control-label">Alamat</label>
                    <div class="col-md-5">
                      <textarea class="form-control" name="alamat" placeholder="alamat lengkap"><?php echo $row->alamat_guru;?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="telepon" class="col-md-3 control-label">Telepon</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="telpon" value="<?php echo $row->telpon_guru;?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="username" class="col-md-3 control-label">Username</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="username" value="<?php echo $row->username;?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="foto" class="col-md-3 control-label">Foto guru</label>
                    <div class="col-md-5">
                      <?php
                      if($row->foto_guru!=''){
                        echo "<img src='".base_url('assets/photos/'.$row->foto_guru.'')."' alt='---' class='img-rounded' width='50%'/><br>";
                      }?>
                      <input type="hidden" name="fotolama" value="<?php echo $row->foto_guru;?>">
                      <input type="file" name="userfile">
                      <small class="help-block">File : jpg/png, Max.500Kb</small>
                    </div>
                  </div>

                  

              		<div class="form-group">
              			<label for="aksi" class="col-md-3 control-label"></label>
              			<div class="col-md-5">
              				<input type="submit" name="submit" value="Update" class="btn btn-primary" />
                           <input type="reset" value="Reset"  class="btn btn-danger" />
              			</div>
              		</div>
                </form>
                  <hr><hr>
                  
                  <form method="post" action="<?php echo base_url('admin/reset_password_guru');?>" class="form-horizontal">
                  <div class="form-group">
                    <label for="pwd-now" class="col-md-3 control-label">Reset Password Guru</label>
                    <div class="col-md-5">
                      <input type="hidden" name="id_guru" value="<?php echo $row->id_guru;?>">
                      <input type="hidden" name="back_url" value="<?php echo uri_string();?>">
                      <button class="btn btn-danger" type="submit"><i class="fa fa-refresh"></i> Reset Password</button>
                    </div>
                  </div>
                </form>

								
            </div>
          
          </div>
		  <!-- /data kelas -->
		 
 </section>		  
