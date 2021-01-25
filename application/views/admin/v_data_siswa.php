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
   <div class="box collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">Form Tambah Siswa</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-plus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              	<form action="<?php echo base_url('admin/tambah_siswa');?>" method="post" class="form-horizontal" enctype="multipart/form-data">
              		<div class="form-group">
              			<label for="nama" class="col-md-3 control-label">Nama Siswa</label>
              			<div class="col-md-5">
              				<input type="text" class="form-control" name="nama_siswa" value="<?php echo set_value('nama_siswa');?>">
              			</div>
              		</div>
                   <div class="form-group">
                    <label for="nis" class="col-md-3 control-label">NIS</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="nis" value="<?php echo set_value('nis');?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="nisn" class="col-md-3 control-label">NISN</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="nisn" value="<?php echo set_value('nisn');?>">
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
                       
                      <input type="text" class="form-control" name="tempat_lahir" value="<?php echo set_value('tempat_lahir');?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="tgl_lahir" class="col-md-3 control-label">Tanggal Lahir</label>
                    <div class="col-md-5">
                       
                      <input type="text" class="form-control" name="tgl_lahir" value="<?php echo set_value('tgl_lahir');?>" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
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
                    <label for="agama" class="col-md-3 control-label">Agama</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="agama" value="<?php echo set_value('agama');?>">
                    </div>
                  </div>

                   <div class="form-group">
                    <label for="stts_dlm_kel" class="col-md-3 control-label">Status dalam Keluarga</label>
                    <div class="col-md-5">
                      <select name="status_dlm_kel"  class="form-control" >
                      <option value="Anak Kandung">Anak Kandung</option>
                      <option value="Anak Angkat">Anak Angkat</option>
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
                        echo "<option value='$i'>$i</option>";
                      }
                      ?>
                      </select>
                    </div>
                  </div>
                

                  <div class="form-group">
                    <label for="alamat" class="col-md-3 control-label">Alamat</label>
                    <div class="col-md-5">
                      <textarea class="form-control" name="alamat_siswa" placeholder="alamat lengkap"><?php echo set_value('alamat_siswa');?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="telepon" class="col-md-3 control-label">Telpon Siswa</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="telpon_siswa" value="<?php echo set_value('telpon_siswa');?>">
                    </div>
                  </div>
                   <div class="form-group">
                    <label for="asal_sekolah" class="col-md-3 control-label">Asal Sekolah</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="asal_sekolah" value="<?php echo set_value('asal_sekolah');?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="kelas" class="col-md-3 control-label">Diterima di Kelas</label>
                    <div class="col-md-5">
                      <select name="kelas"  class="form-control" >
                      <?php
                      
                      foreach($datakelas->result() as $dkls)
                      {
                        echo "<option value='$dkls->id_kelas'>$dkls->nama_kelas</option>";
                      }
                      ?>
                      </select>
                    </div>
                  </div>

                   <div class="form-group">
                    <label for="tgl_diterima" class="col-md-3 control-label">Diterima Tanggal</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="diterima_tgl" value="<?php echo set_value('diterima_tgl');?>">
                    </div>
                  </div>

                   <div class="form-group">
                    <label for="ayah" class="col-md-3 control-label">Nama Ayah</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="nama_ayah" value="<?php echo set_value('nama_ayah');?>">
                    </div>
                  </div>
                   <div class="form-group">
                    <label for="kerja_ayah" class="col-md-3 control-label">Pekerjaan Ayah</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="kerja_ayah" value="<?php echo set_value('kerja_ayah');?>">
                    </div>
                  </div>

                   <div class="form-group">
                    <label for="ibu" class="col-md-3 control-label">Nama Ibu</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="nama_ibu" value="<?php echo set_value('nama_ibu');?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="kerja_ibu" class="col-md-3 control-label">Kerja Ibu</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="kerja_ibu" value="<?php echo set_value('kerja_ibu');?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="telepon_ortu" class="col-md-3 control-label">Telpon Ortu</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="telpon_ortu" value="<?php echo set_value('telpon_ortu');?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="almt_ortu" class="col-md-3 control-label">Alamat Ortu</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="alamat_ortu" value="<?php echo set_value('alamat_ortu');?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="nama_wali" class="col-md-3 control-label">Nama Wali</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="nama_wali" value="<?php echo set_value('nama_wali');?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="kerja_wali" class="col-md-3 control-label">Pekerjaan Wali</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="kerja_wali" value="<?php echo set_value('kerja_wali');?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="telpon_wali" class="col-md-3 control-label">Telpon Wali</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="telpon_wali" value="<?php echo set_value('telpon_wali');?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="alamat_wali" class="col-md-3 control-label">Alamat Wali</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="alamat_wali" value="<?php echo set_value('alamat_wali');?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="ta" class="col-md-3 control-label">Tahun Ajaran</label>
                    <div class="col-md-5">
                      <select name="tahun_ajaran"  class="form-control" >
                      <?php
                      
                      foreach($tahunajaran->result() as $ta)
                      {
                        echo "<option value='$ta->tahun'>$ta->tahun</option>";
                      }
                      ?>
                      </select>
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
                    <label for="foto" class="col-md-3 control-label">Foto siswa</label>
                    <div class="col-md-5">
                      <input type="file" name="userfile">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="foto" class="col-md-3 control-label">Status Siswa</label>
                    <div class="col-md-5">
                     <select name="status"  class="form-control" >
                      <option value="1">Aktif</option>
                      <option value="0">Alumni</option>
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
        <hr>
        
								
            </div>
          
          </div>
        </div><!-- .col-md-8-->
        <div class="col-md-4">
            <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Import Data Siswa</h3>
            </div>
            <div class="box-body">
              <small>Untuk import data siswa, silahkan download file excel format import data siswa di bawah ini!</small><br>
        <a href="<?php echo base_url('assets/files/format_excel_siswa.xlsx');?>" class="btn btn-success"><i class="fa fa-download"></i> Download Format Import Siswa (Excel)</a>
        <hr>
        <form action="<?php echo base_url();?>excel/do_upload_siswa/" method="post" enctype="multipart/form-data" accept-charset="utf-8">
    <input type="file" name="userfile"/>
    <input type="submit" name="name" value="Upload file" class="btn btn-sm btn-primary" />
</form>
            </div>
          </div>
        </div>
      </div><!-- .row-->
		  <!-- /data kelas -->
      <div class="row">
		 <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Daftar Nama Semua Siswa</h3>
              <br><small>JUMLAH DATA : <?php echo number_format($jml_data);?></small>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
              <br>

              <form class="form-inline pull-right" method="post" action="<?php echo base_url('admin/data_siswa');?>">
                 <div class="form-group">
                  <label for="tahun"><i class="fa fa-filter"></i> Filter : </label>
                 
                </div>
                <div class="form-group">
                  <label for="status">Pilih Status</label>
                  <select name="status_siswa" class="form-control input-sm">
                   <option value="1" <?php if($this->session->userdata('ses_stat_siswa')=="1"){echo "selected";}?>>Aktif</option> 
                   <option value="0" <?php if($this->session->userdata('ses_stat_siswa')=="0"){echo "selected";}?>>Alumni</option> 
                   
                  </select>
                </div>
                <div class="form-group">
                  <label for="jml_hlm">Data per halaman</label>
                  <select name="jml_hlm" class="form-control input-sm">
                    
                    <option value="5" <?php if($this->session->userdata('ses_siswa_rows')=="5"){echo "selected";}?>>5</option>
                    <option value="10" <?php if($this->session->userdata('ses_siswa_rows')=="10"){echo "selected";}?>>10</option>
                    <option value="25" <?php if($this->session->userdata('ses_siswa_rows')=="25"){echo "selected";}?>>25</option>
                    <option value="50" <?php if($this->session->userdata('ses_siswa_rows')=="50"){echo "selected";}?>>50</option>
                    <option value="100" <?php if($this->session->userdata('ses_siswa_rows')=="100"){echo "selected";}?>>100</option>
                  </select>
                </div>
                <button type="submit" name="sort_siswa" class="btn btn-primary btn-sm">Tampilkan</button>
              </form>
              <br>
            </div>
            <div class="box-body">
            	<div class="col-md-12">
				<form action="<?php echo base_url('admin/aksi_siswa');?>" method="post">
					<div class="table-responsive">
				<table  id="example2" class="table table-bordered table-hover no-padding" >
          <thead>
                    <tr bgcolor=#fafafa>
                      <th width="5%">#</th>
          <th width="5%">No </th>
          <th width="20%">Nama Siswa</th>
          <th width="5%">NIS</th>
          <th width="5%">Kelamin</th>
          <th width="20%">Alamat</th>
          <th width="10%">Telepon</th>
          <th width="10%">Username</th>
          <th width="10%">Status</th>
           
          <th width="10%">Aksi</th>
        </tr>
         </thead>
        <tbody>
        <?php
        $no=$this->uri->segment(3)+1;
        foreach($data->result_array() as $row){
        ?>  
        <tr>
          <td><div class="checkbox icheck"><input type="checkbox" name="check[]" value="<?php echo $row['id_siswa'] ;?>"></div></td>
          <td><?php echo $no++;?></td>
          <td><?php echo $row['nama_siswa'];?></td>
          <td><?php echo $row['nis'];?></td>
          <td><?php echo $row['kelamin'];?></td>
          <td><?php echo $row['alamat_siswa'];?></td>
          <td><?php echo $row['telpon_siswa'];?></td>
          <td><?php echo $row['username'];?></td>
          <td><?php
          if($row['status']==1){echo "Aktif";}else{echo "<em>Alumni</em>";}?></td>
          <td><a href="<?php echo base_url('admin/detail_siswa/'.$row['nis'].'?m=data_induk&sm=siswa');?>" class="btn btn-primary" title="Detail Siswa"> <i class="fa fa-file"></i> </a> &nbsp; 
              <a href="<?php echo base_url('admin/drop_siswa/'.$row['id_siswa'].'');?>"  class="btn btn-danger" title="Hapus" onclick="return konfirmasi();"> <i class="fa fa-trash"></i> </a>     
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
				<button class="btn btn-danger btn-sm" type="submit" name="multidelete" onclick="return konfirmasi();"><i class="fa fa-trash"></i> Hapus Data Siswa</button>
				
				<br><br>
				</div>
				<!--  end product-table................................... --> 
				</form>
				</div>
				
            </div><!-- /.box-body -->
          
          </div>
        </div><!-- .row-->

 </section>		  
