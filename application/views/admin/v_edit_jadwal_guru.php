  <!-- Content Header (Page header) -->
          <?php include('application/views/section_header.php');?>

 <section class="content">
 	 <div class="row">
            <div class="col-sm-12">
              <?php
              echo $this->session->flashdata('notif');?>
            </div>
          </div>
  <?php
  $row_jadwal = $jadwalguru->row();?>
  <script type="text/javascript">
    function go_jadwal_guru()
    {
      document.location.href="<?php echo base_url('admin/jadwal_guru');?>";
    }
  </script>
   <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="button" class="btn btn-primary btn-sm" onclick="go_jadwal_guru();"><i class="fa fa-arrow-circle-left"></i> Kembali</button> Set Jadwal Guru</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              	<form action="<?php echo base_url('admin/update_jadwal_guru');?>" method="post" class="form-horizontal" enctype="multipart/form-data">
              		<div class="form-group">
                    <label class="col-md-3 control-label">Guru <?php echo $row_jadwal->id_jadwal;?></label>
                    <div class="col-md-5">
                      <input type="hidden" name="id_jadwal" value="<?php echo $row_jadwal->id_jadwal;?>">
                    <select class="form-control select2" style="width: 100%;" name="id_guru">
                      <!--<option selected="selected">Pilih Guru</option>-->
                      <?php
                      foreach($guru->result() as $row_guru){?>
                      <option value="<?php echo $row_guru->id_guru;?>" <?php if($row_jadwal->id_guru==$row_guru->id_guru){echo "selected";}?>><?php echo $row_guru->nama_guru;?></option>
                    <?php } ?>
                    </select>
                  </div>
              </div>
              <!-- /.form-group -->
                  <div class="form-group">
                    <label class="col-md-3 control-label">Pelajaran</label>
                    <div class="col-md-5">
                    <select class="form-control select2" style="width: 100%;" name="id_pelajaran">
                      <!--<option selected="selected">Pilih Mata Pelajaran</option>-->
                      <?php
                      foreach($mapel->result() as $row_mapel){?>
                      <option value="<?php echo $row_mapel->id_pelajaran;?>" <?php if($row_jadwal->id_pelajaran==$row_mapel->id_pelajaran){echo "selected";}?>><?php echo $row_mapel->nama_pelajaran;?></option>
                    <?php } ?>
                    </select>
                  </div>
              </div>
                
                  
                  <div class="form-group">
              			<label for="kelas" class="col-md-3 control-label">Kelas</label>
              			<div class="col-md-5">
              				<select name="id_kelas"  class="form-control" >
                        <?php
                        foreach($kelas->result() as $k){
                          echo "<option value='".$k->id_kelas."'";
                          if($row_jadwal->id_kelas==$k->id_kelas){echo "selected";}
                          echo ">".$k->nama_kelas."</option>";
                        }?>
        						
        							</select>
              			</div>
              		</div>

                   <div class="form-group">
                    <label for="tahun" class="col-md-3 control-label">Tahun</label>
                    <div class="col-md-5">
                      <select name="tahun"  class="form-control" >
                        <?php
                        foreach($tahun->result() as $t){
                          echo "<option value='".$t->id_tahun."'";
                          if($row_jadwal->id_tahun==$t->id_tahun){echo "selected";}
                          echo ">".$t->tahun."</option>";
                        }?>
                    
                      </select>
                    </div>
                  </div>

                   <div class="form-group">
                    <label for="semester" class="col-md-3 control-label">Semester</label>
                    <div class="col-md-5">
                      <select name="semester"  class="form-control" >
                        <?php
                        foreach($semester->result() as $sem){
                          echo "<option value='".$sem->id_semester."'";
                          if($row_jadwal->id_semester==$sem->id_semester){echo "selected";}
                          echo ">".ucwords($sem->semester)."</option>";
                        }?>
                    
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
								
            </div>
          
          </div>
		  <!-- /data kelas -->
		
 </section>		  
