
  <!-- Content Header (Page header) -->
<?php
include('application/views/section_header.php');


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
              <h3 class="box-title"></h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              	<form action="<?php echo base_url('admin/update_kepsek');?>" method="post" class="form-horizontal">
                  <input type="hidden" name="back_url" value="<?php echo uri_string();?>?m=setup&sm=data_kepala_sekolah">
                    <?php
                    $form=1;
                    foreach ($select_kepsek->result() as $row){?>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Tahun Ajaran</label>
                      <div class="col-md-5">
                        <input type="hidden" name="id_kepsek" value="<?php echo $row->id_kepsek;?>">
                  <select class="form-control" name="tahunajaran">
                <?php foreach($tahun->result() as $ta){
                echo "<option value='$ta->id_tahun'";
                      if($ta->id_tahun==$row->id_tahun){echo 'selected';}
                echo ">$ta->tahun</option>";
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
                echo "<option value='$sem->id_semester'";
                      if($sem->id_semester==$row->id_semester){echo 'selected';}
                echo ">$sem->semester</option>";
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
                echo "<option value='$gr->id_guru'";
                       if($gr->id_guru==$row->id_guru){echo 'selected';}
                echo ">$gr->nama_guru</option>";
                }
                ?>
              </select>
                </div>
              </div>

               <div class="form-group">
                  <label class="col-md-3 control-label">Tanggal TTD Rapor</label>
                  <div class="col-md-5">
                  <input type="text" name="tgl_rapor" value="<?php echo $row->tgl_rapor;?>" class="form-control" placeholder="Tempat, Tanggal">
                  <small class="help-block">Isikan tempat beserta tanggl ttd rapor yang disesuaikan dengan Semester</small>
                  </div>
              </div>

              <div class="form-group">
                  <label class="col-md-3 control-label">Tanggal TTD Siswa Diterima</label>
                  <div class="col-md-5">
                  <input type="text" name="tgl_siswa_diterima" value="<?php echo $row->tgl_siswa_diterima;?>" class="form-control" placeholder="Tempat, Tanggal">
                  <small class="help-block">Isikan tempat beserta tanggl ttd siswa diterima</small>
                  </div>
              </div>
                  <hr>
                <?php
                }
                ?>

                  <div class="form-group">
                    <script type="text/javascript">
                      function go_kepsek()
                      {
                        document.location.href="<?php echo base_url('admin/setup_kepsek?m=setup&sm=data_kepala_sekolah');?>";
                      }
                    </script>
                    <label for="aksi" class="col-md-3 control-label"></label>
                    <div class="col-md-5">
                      <input type="submit" name="submit" value="Simpan" class="btn btn-primary" /> <input type="reset" value="Reset"  class="btn btn-danger" />
                      <button type="button" class="btn btn-info" onclick="return go_kepsek();">Kembali</button>
                    </div>
                  </div>
              
        </form>
								
            </div>
          
          </div>
		  <!-- /data kelas -->
		 
 </section>		  
