<?php
$cek_tbl_kehadiran = $cek_hadir->num_rows();
$nama_kelas = $kelas->row('nama_kelas');
$idkelas = $kelas->row('id_kelas');
?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php echo $this->session->flashdata('notif');?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-primary" role="alert">
                <h4>Data Kelas : (Anda memiliki tanggung jawab input data Saran/Nasihat sebagai wali kelas)</h4>
            </div>
            <div class="box">
                <div class="box-body">
                    <form class="form-inline" method="post"
                        action="<?php echo base_url();?>guru/form_kehadiran?m=input_kehadiran">
                        <div class="form-group">
                            <input type="hidden" name="idkelas" value="<?php echo $idkelas;?>">
                            <input type="hidden" name="idtahun" value="<?php echo $idtahun;?>">
                            <label>Kelas : </label>
                            <input class="form-control ml-3" type="text" value="<?php echo $nama_kelas;?>" readonly>
                        </div>
                        <div class="form-group ml-5">
                            <label>Semester : </label>
                            <select class="form-control form-control-sm ml-3" name="semester">
                                <option value="<?php echo $idsemester;?>"><?php echo $semester_aktif;?></option>
                            </select>
                        </div>
                        <?php
                    if($cek_tbl_kehadiran>0)
                    {
                      echo "<button class='btn btn-primary ml-3' type='submit' name='update'>Perbarui/Input Kehadiran</button>";
                    }
                    else
                    {
                     echo "<button class='btn btn-primary ml-3' type='submit' name='input'>Perbarui/Input Kehadiran</button>";
                    }
                    ?>
                    </form>
                    <br><br>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</section>