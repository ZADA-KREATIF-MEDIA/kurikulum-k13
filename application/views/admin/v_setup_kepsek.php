
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
              <h3 class="box-title">Tambah Kepala Sekolah</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              	<form action="<?php echo base_url('admin/tambah_kepsek');?>" method="post" class="form-horizontal">
                  <div class="form-group">
                    <label class="col-md-3 control-label">Tahun Ajaran</label>
                      <div class="col-md-5">
                  <select class="form-control" name="tahunajaran">
                <?php foreach($tahun->result() as $ta){
                echo "<option value='$ta->id_tahun'>$ta->tahun</option>";
                }
                ?>
              </select>
                </div>
              </div>
              <div class="form-group">
                    <label class="col-md-3 control-label">Semester</label>
                      <div class="col-md-5">
                  <select class="form-control" name="semester">
                <?php foreach($semester->result() as $sem){
                echo "<option value='$sem->id_semester'>$sem->semester</option>";
                }
                ?>
              </select>
                </div>
              </div>
               <div class="form-group">
                    <label class="col-md-3 control-label">Nama</label>
                      <div class="col-md-5">
                  <select class="form-control select2" style="width: 100%;" name="nama">
                <?php foreach($guru->result() as $gr){
                echo "<option value='$gr->id_guru'>$gr->nama_guru</option>";
                }
                ?>
              </select>
                </div>
              </div>

               <div class="form-group">
                  <label class="col-md-3 control-label">Tanggal TTD Rapor</label>
                  <div class="col-md-5">
                  <input type="text" name="tgl_rapor" class="form-control" placeholder="Tempat, Tanggal">
                  <small class="help-block">Isikan tempat beserta tanggl ttd rapor yang disesuaikan dengan Semester</small>
                  </div>
              </div>

              <div class="form-group">
                  <label class="col-md-3 control-label">Tanggal TTD Siswa Diterima</label>
                  <div class="col-md-5">
                  <input type="text" name="tgl_siswa_diterima" class="form-control" placeholder="Tempat, Tanggal">
                  <small class="help-block">Isikan tempat beserta tanggl ttd siswa diterima</small>
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
              <h3 class="box-title">Daftar Kepala Sekolah <?php echo $pd_tahun;?> per tahun ajaran & semester</h3>
              <br>
              TOTAL : <small><?php echo number_format($jml_data);?></small> DATA
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
             
            </div>
            <div class="box-body">
              <div class="col-md-7 col-xs-12 pull-right">
                 <form class="form-inline" method="post" action="<?php echo base_url('admin/setup_kepsek?m=setup&sm=data_kepala_sekolah');?>">
                 <div class="form-group">
                  <label for="tahun"><i class="fa fa-filter"></i> Filter : </label>
                 
                </div>
                <div class="form-group">
                  <label for="status">Pilih Tahun</label>
                  <select name="tahun" class="form-control input-sm">
                    <?php
                    foreach($tahun->result() as $ta){?>
                      <option value="<?php echo $ta->id_tahun;?>" <?php if($ta->id_tahun==$this->session->userdata('ses_semes_thn')){ echo "selected";}?>><?php echo $ta->tahun;?></option>
                    <?php
                    }
                    ?>                   
                  </select>
                </div>
                <div class="form-group">
                  <label for="jml_hlm">Data per halaman</label>
                  <select name="rows" class="form-control input-sm">
                    
                    <option value="5" <?php if($this->session->userdata('ses_semes_rows')=="5"){echo "selected";}?>>5</option>
                    <option value="10" <?php if($this->session->userdata('ses_semes_rows')=="10"){echo "selected";}?>>10</option>
                    <option value="25" <?php if($this->session->userdata('ses_semes_rows')=="25"){echo "selected";}?>>25</option>
                    <option value="50" <?php if($this->session->userdata('ses_semes_rows')=="50"){echo "selected";}?>>50</option>
                    <option value="100" <?php if($this->session->userdata('ses_semes_rows')=="100"){echo "selected";}?>>100</option>
                  </select>
                </div>
                <button type="submit" name="sort_kepsek" class="btn btn-primary btn-sm">Tampilkan</button>
              </form>
              <br>
              </div>
            	<div class="col-md-12">
               
				<form action="<?php echo base_url('admin/aksi_kepsek/?m=setup&sm=data_kepala_sekolah');?>" method="post">
					<div class="table-responsive">
				<table class="table table-bordered">
				<thead>
				<tr>
					<th style="width:5%;">#</th>
          <th style="width:10%;">No</th>
					<th style="width:20%;">Kepala Sekolah</th>
					<th style="width:20%;">NIP</th>
          <th style="width:15%;">Tahun Ajaran</th>
          <th style="width:15%;">Semester</th>
					<th style="width:15%;">Aksi</th>
				</tr>
				</thead>
				
				<?php
				//$no=$this->uri->segment(3)+1;
				$no=1;
				foreach($data->result_array() as $row){
				?>	
				<tr>
					<td><div class="checkbox icheck"><input type="checkbox" name="check[]" value="<?php echo $row['id_kepsek'] ;?>"></div></td>
					<td><?php echo $no++;?></td>
					<td><?php echo $row['nama_guru'];?></td>
          <td><?php echo $row['nip'];?></td>
          <td><?php echo $row['tahun'];?></td>
          <td><?php echo $row['semester'];?></td>
					<td align="center"><a href="<?php echo base_url('admin/edit_kepsek/'.$row['id_kepsek'].'?m=setup&sm=data_kepala_sekolah');?>"  class="btn btn-primary" title="Edit"> <i class="fa fa-pencil-square"></i> </a> &nbsp; 
           <a href="<?php echo base_url('admin/drop_kepsek/'.$row['id_kepsek'].'');?>"  class="btn btn-danger" title="Hapus" onclick="return konfirmasi();"> <i class="fa fa-trash"></i> </a>
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
				<button class="btn btn-danger btn-sm" type="submit" name="multidelete" onclick="return konfirmasi();"><i class="fa fa-trash"></i> Hapus Data</button>
				<!--<button class="btn btn-primary btn-sm" type="submit" name="multiedit"><i class="fa fa-pencil-square"></i> Edit Data</button>-->
				<br><br>
				</div>
				<!--  end product-table................................... --> 
				</form>
				</div>
				
            </div><!-- /.box-body -->
          
          </div>
 </section>		  

