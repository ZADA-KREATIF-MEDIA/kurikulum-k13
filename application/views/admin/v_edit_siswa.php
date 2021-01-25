  <!-- Content Header (Page header) -->
          <?php include('application/views/section_header.php');?>
<?php
$row = $data_siswa->row();?>
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
                function go_siswa()
                {
                  document.location.href="<?php echo base_url('admin/data_siswa');?>";
                }
              </script>

              <h3 class="box-title"><button onclick="return go_siswa();" type="button" class="btn btn-primary btn-sm"><i class="fa fa-arrow-circle-left"></i> Kembali</button> Edit Data Siswa</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-plus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              	<form action="<?php echo base_url('admin/update_siswa');?>" method="post" class="form-horizontal" enctype="multipart/form-data">
              		<div class="form-group">
                    <label for="nama" class="col-md-3 control-label">Nama Siswa</label>
                    <div class="col-md-5">
                      <input type="hidden" name="id_siswa" value="<?php echo $row->id_siswa;?>">
                      <input type="text" class="form-control" name="nama_siswa" value="<?php echo $row->nama_siswa;?>">
                    </div>
                  </div>
                   <div class="form-group">
                    <label for="nis" class="col-md-3 control-label">NIS</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="nis" value="<?php echo $row->nis;?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="nisn" class="col-md-3 control-label">NISN</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="nisn" value="<?php echo $row->nisn;?>">
                    </div>
                  </div>
                  <!--<div class="form-group">
                <label>Date masks:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                </div>
                <!-- /.input group 
              </div>-->
              <!-- /.form group -->
              <div class="form-group">
                    <label for="tgl_lahir" class="col-md-3 control-label">Tempat Lahir</label>
                    <div class="col-md-5">
                       
                      <input type="text" class="form-control" name="tempat_lahir" value="<?php echo $row->tempat_lahir;?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="tgl_lahir" class="col-md-3 control-label">Tanggal Lahir</label>
                    <div class="col-md-5">
                       
                      <input type="text" class="form-control" name="tgl_lahir" value="<?php echo $row->tgl_lahir;?>" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
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
                    <label for="agama" class="col-md-3 control-label">Agama</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="agama" value="<?php echo $row->agama;?>">
                    </div>
                  </div>

                   <div class="form-group">
                    <label for="stts_dlm_kel" class="col-md-3 control-label">Status dalam Keluarga</label>
                    <div class="col-md-5">
                      <select name="status_dlm_kel"  class="form-control" >
                      <option value="Anak Kandung" <?php if($row->status_dlm_kel=="Anak Kandung"){echo "selected";}?>>Anak Kandung</option>
                      <option value="Anak Angkat" <?php if($row->status_dlm_kel=="Anak Angkat"){echo "selected";}?>>Anak Angkat</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="anakke" class="col-md-3 control-label">Anak ke</label>
                    <div class="col-md-5">
                      <select name="anakke"  class="form-control" >
                      <?php
                      $i=1;
                      for($i;$i<=10;$i++)
                      {
                        echo "<option value='$i' ";
                        if($row->anakke==$i){echo "selected";}
                        echo ">$i</option>";
                      }
                      ?>
                      </select>
                    </div>
                  </div>
                

                  <div class="form-group">
                    <label for="alamat" class="col-md-3 control-label">Alamat</label>
                    <div class="col-md-5">
                      <textarea class="form-control" name="alamat_siswa" placeholder="alamat lengkap"><?php echo $row->alamat_siswa;?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="telepon" class="col-md-3 control-label">Telpon Siswa</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="telpon_siswa" value="<?php echo $row->telpon_siswa;?>">
                    </div>
                  </div>
                   <div class="form-group">
                    <label for="asal_sekolah" class="col-md-3 control-label">Asal Sekolah</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="asal_sekolah" value="<?php echo $row->asal_sekolah;?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="kelas" class="col-md-3 control-label">Diterima di Kelas</label>
                    <div class="col-md-5">
                      <select name="kelas"  class="form-control" >
                      <?php
                      
                      foreach($datakelas->result() as $dkls)
                      {
                        echo "<option value='$dkls->id_kelas'";
                        if($row->id_kelas==$dkls->id_kelas){echo "selected";}
                        echo ">$dkls->nama_kelas</option>";
                      }
                      ?>
                      </select>
                    </div>
                  </div>

                   <div class="form-group">
                    <label for="tgl_diterima" class="col-md-3 control-label">Diterima Tanggal</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="diterima_tgl" value="<?php echo $row->diterima_tanggal;?>">
                    </div>
                  </div>

                   <div class="form-group">
                    <label for="ayah" class="col-md-3 control-label">Nama Ayah</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="nama_ayah" value="<?php echo $row->nama_ayah;?>">
                    </div>
                  </div>
                   <div class="form-group">
                    <label for="kerja_ayah" class="col-md-3 control-label">Pekerjaan Ayah</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="kerja_ayah" value="<?php echo $row->kerja_ayah;?>">
                    </div>
                  </div>

                   <div class="form-group">
                    <label for="ibu" class="col-md-3 control-label">Nama Ibu</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="nama_ibu" value="<?php echo $row->nama_ibu;?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="kerja_ibu" class="col-md-3 control-label">Kerja Ibu</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="kerja_ibu" value="<?php echo $row->kerja_ibu;?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="telepon_ortu" class="col-md-3 control-label">Telpon Ortu</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="telpon_ortu" value="<?php echo $row->telpon_ortu;?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="almt_ortu" class="col-md-3 control-label">Alamat Ortu</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="alamat_ortu" value="<?php echo $row->alamat_ortu;?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="nama_wali" class="col-md-3 control-label">Nama Wali</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="nama_wali" value="<?php echo $row->nama_wali;?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="kerja_wali" class="col-md-3 control-label">Pekerjaan Wali</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="kerja_wali" value="<?php echo $row->kerja_wali;?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="telpon_wali" class="col-md-3 control-label">Telpon Wali</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="telpon_wali" value="<?php echo $row->telpon_wali;?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="alamat_wali" class="col-md-3 control-label">Alamat Wali</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="alamat_wali" value="<?php echo $row->alamat_wali;?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="ta" class="col-md-3 control-label">Tahun Ajaran</label>
                    <div class="col-md-5">
                      <select name="tahun_ajaran"  class="form-control" >
                      <?php
                      
                      foreach($tahunajaran->result() as $ta)
                      {
                        echo "<option value='$ta->tahun'";
                        if($row->tahun_ajaran==$ta->tahun){echo "selected";}
                        echo ">$ta->tahun</option>";
                      }
                      ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="username" class="col-md-3 control-label">Username</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="username" value="<?php echo $row->username;?>">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="foto" class="col-md-3 control-label">Foto siswa</label>
                    <div class="col-md-5">
                      <?php if($row->foto_siswa!='')
                      {
                        echo "<img src='".base_url('assets/photos/'.$row->foto_siswa.'')."' class='img-responsive img-rounded' alt='foto_siswa'><br><br>";
                      }
                      ?>
                     
                      <input type="file" name="userfile">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="foto" class="col-md-3 control-label">Status Siswa</label>
                    <div class="col-md-5">
                     <select name="status"  class="form-control" >
                      <option value="1" <?php if($row->status==1){echo "selected";}?>>Aktif</option>
                      <option value="0" <?php if($row->status==0){echo "selected";}?>>Alumni</option>
                      </select>
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
                   <form method="post" action="<?php echo base_url('admin/reset_password_siswa');?>" class="form-horizontal">
                  <div class="form-group">
                    <label for="pwd-now" class="col-md-3 control-label">Reset Password Siswa</label>
                    <div class="col-md-5">
                      <input type="hidden" name="id_siswa" value="<?php echo $row->id_siswa;?>">
                      <input type="hidden" name="back_url" value="<?php echo uri_string();?>">
                      <button class="btn btn-danger" type="submit"><i class="fa fa-refresh"></i> Reset Password</button>
                    </div>
                  </div>
                </form>

								
            </div>
          
          </div>
		  <!-- /data kelas -->
		 
 </section>		  
