
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
              	<form action="<?php echo base_url('admin/update_kkm');?>" method="post" class="form-horizontal">
                  <input type="hidden" name="back_url" value="<?php echo uri_string();?>?m=setup&sm=kkm">
                    <?php
                    $form=1;
                    foreach ($select_kkm->result() as $row){?>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Tahun Aajaran</label>
                      <div class="col-md-5">
                        <input type="hidden" name="id_kkm[]" value="<?php echo $row->id_kkm;?>">
                  <select class="form-control" name="tahunajaran[]">
                <?php foreach($tahun_ajaran->result() as $ta){
                echo "<option value='$ta->id_tahun'";
                      if($ta->id_tahun==$row->id_tahun){echo 'selected';}
                echo ">$ta->tahun</option>";
                }
                ?>
              </select>
                </div>
              </div>
               <div class="form-group">
                    <label class="col-md-3 control-label">Mata Pelajaran</label>
                      <div class="col-md-5">
                  <select class="form-control select2" style="width: 100%;" name="mapel[]">
                <?php foreach($mapel->result() as $mp){
                echo "<option value='$mp->id_pelajaran'";
                       if($mp->id_pelajaran==$row->id_pelajaran){echo 'selected';}
                echo ">$mp->nama_pelajaran</option>";
                }
                ?>
              </select>
                </div>
              </div>
              <div class="form-group">
                    <label class="col-md-3 control-label">Kategori Kelas</label>
                      <div class="col-md-5">
                  <select class="form-control" name="katkel[]">
                    <option value='10-umum' <?php if($row->kategori_kls=="10-umum"){echo "selected";}?>>10-umum</option>
                    <option value='11-ipa' <?php if($row->kategori_kls=="11-ipa"){echo "selected";}?>>11-ipa</option>
                    <option value='11-ips' <?php if($row->kategori_kls=="11-ips"){echo "selected";}?>>11-ips</option>
                    <option value='12-ipa' <?php if($row->kategori_kls=="12-ipa"){echo "selected";}?>>12-ipa</option>
                    <option value='12-ips' <?php if($row->kategori_kls=="12-ips"){echo "selected";}?>>12-ips</option>
                  </select>
                </div>
              </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">KKM</label>
                    <div class="col-md-5">
                      <input type="text" class="form-control" name="kkm[]" value="<?php echo $row->kkm;?>" placeholder="00" />
                    </div>
                  </div>
                  <hr>
                <?php
                }
                ?>

                  <div class="form-group">
                    <script type="text/javascript">
                      function go_kkm()
                      {
                        document.location.href="<?php echo base_url('admin/setup_kkm?m=setup&sm=kkm');?>";
                      }
                    </script>
                    <label for="aksi" class="col-md-3 control-label"></label>
                    <div class="col-md-5">
                      <input type="submit" name="submit" value="Simpan" class="btn btn-primary" /> <input type="reset" value="Reset"  class="btn btn-danger" />
                      <button type="button" class="btn btn-info" onclick="return go_kkm();">Kembali</button>
                    </div>
                  </div>
              
        </form>
								
            </div>
          
          </div>
		  <!-- /data kelas -->
		 
 </section>		  
