<?php 
//session
$sidkel = $this->session->userdata('ses_eks_idkelas');
$sidsms = $this->session->userdata('ses_eks_idsms');
$sidthn = $this->session->userdata('ses_eks_idthn');
?>
<section class="content">
  <div class="row">
    <div class="col-sm-12">
      <?php
      echo $this->session->flashdata('notif');?>
    </div>
  </div>
  <div class="box">
      <h3 class="box-title">Kehadiran Siswa</h3>
    <div class="box-body">
      <form action="<?php echo base_url('admin_editnilai/form_kehadiran');?>" method="post">
        <div class="row">
          <div class="form-group col">
            <label for="kelas">Kelas</label>
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
          <div class="form-group col">
            <label for="semester">Semester</label>
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
          <div class="form-group col">
            <label for="tahun">Tahun</label>
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
        <button type="submit" name="submit" class="btn btn-primary btn-block">Tampilkan</button>
      </form>
    </div>        
  </div>
	<!-- /form set data -->
</section>
