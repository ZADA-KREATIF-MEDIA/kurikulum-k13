
<!--  start page-heading -->
   <?php include('application/views/section_header.php');?>
<!-- end page-heading -->
<?php
$catatan = $cek_catatan->num_rows();
$nama_kelas = $kelas->row('nama_kelas');
$idkelas = $kelas->row('id_kelas');
?>
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <?php echo $this->session->flashdata('notif');?>
        </div>
      </div>
      <div class="row">
            <div class="col-xs-12">
              <div class="box">
		
                <div class="box-header">
                  <h3 class="box-title">Pilih sesuai semester</h3>
                </div><!-- /.box-header -->
				
                <div class="box-body">
                  
                  	<form class="form-inline" method="post" action="<?php echo base_url();?>guru/form_isi_catatanwk?m=catatan_wali_kelas">
                      <div class="form-group">
                      	<input type="hidden" name="idwali" value="<?php echo $wali_id_wali;?>">
                        <input type="hidden" name="idkelas" value="<?php echo $idkelas;?>">
                        <input type="hidden" name="idtahun" value="<?php echo $idtahun;?>">
                        <label>Kelas : </label>
                      <p class="form-control-static"><?php echo $nama_kelas;?></p>
                    </div>
                    <div class="form-group">
                      <label>Semester : </label>
                      <select class="form-control" name="semester">
                        <option value="<?php echo $idsemester;?>"><?php echo $semester_aktif;?></option>
                      </select>
                    </div>
                    <?php
                    if($catatan>0)
                    {
                      echo "<button class='btn btn-warning' type='submit' name='update'>Update Catatan</button>";
                    }
                    else
                    {
                     echo "<button class='btn btn-primary' type='submit' name='input'>Input Catatan</button>";
                    }
                    ?>
                  </form>

                  
          
				  <br><br>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
			
          </div>
</section>
