<?php 
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
        <div class="box-header with-border">
            <h3 class="box-title">Data Nilai Sikap Siswa</h3>
            <hr>
        </div>
        <div class="box-body">
            <div class="alert alert-primary" role="alert">
                <form action="<?php echo base_url('admin_editnilai/form_edit_sikap');?>" method="post"
                    class="form-horizontal">
                    <div class="form-group">
                        <label for="kelas" class="col-md-3 control-label">Kelas</label>
                        <div class="col-md-8">
                            <select name="id_kelas" class="form-control">
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
                        <div class="col-md-8">
                            <select name="id_semester" class="form-control">
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
                        <div class="col-md-8">
                            <select name="id_tahun" class="form-control">
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
                        <label for="aksi" class="col-md-8 control-label"></label>
                        <div class="col-md-8">
                            <input type="submit" name="submit" value="FILTER DATA" class="btn btn-block btn-danger" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /form set data -->
</section>