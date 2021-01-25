<?php 
//session
$sidkel = $this->session->userdata('ses_edt_idkel');
$sidsms = $this->session->userdata('ses_edt_idsms');
$sidthn = $this->session->userdata('ses_edt_idthn');
?>
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
              <h3 class="box-title"></h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              	<form action="<?php echo base_url('admin_editnilai/form_edit_ekstrakurikuler');?>" method="post" class="form-horizontal">
                 
              		<div class="form-group">
              			<label for="kelas" class="col-md-3 control-label">Kelas</label>
              			<div class="col-md-5">
              				<select name="id_kelas"  class="form-control" >
                        <?php
                        foreach($kelas->result() as $kls)
                        {
                          echo "<option value='$kls->id_kelas'";
                          if($kls->id_kelas==$sidkel){echo "selected";}
                          echo ">$kls->nama_kelas</option>";
							
                        }?>
							           </select>
              			</div>
              		</div>
                  <div class="form-group">
                    <label for="semester" class="col-md-3 control-label">Semester</label>
                    <div class="col-md-5">
                      <select name="id_semester"  class="form-control" >
                        <?php
                        foreach($semester->result() as $sms)
                        {
                          echo "<option value='$sms->id_semester'";
                          if($sms->id_semester==$sidsms){echo "selected";}
                          echo ">$sms->semester</option>";
                        }
                        ?>
                         </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="tahun" class="col-md-3 control-label">Tahun</label>
                    <div class="col-md-5">
                      <select name="id_tahun"  class="form-control" >
                        <?php
                        foreach($tahun->result() as $thn)
                        {
                          echo "<option value='$thn->id_tahun'";
                          if($thn->id_tahun==$sidthn){echo "selected";}
                          echo ">$thn->tahun</option>";
                        }
                        ?>
                         </select>
                    </div>
                  </div>
              		<div class="form-group">
              			<label for="aksi" class="col-md-3 control-label"></label>
              			<div class="col-md-5">
              				<input type="submit" name="submit" value="Tampilkan" class="btn btn-primary" />
              			</div>
              		</div>
 	         		
           
				</form>
								
            </div>
          
          </div>
		  <!-- /form set data -->
    </section>
