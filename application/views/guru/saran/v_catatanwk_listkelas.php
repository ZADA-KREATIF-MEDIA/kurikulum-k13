<?php
$catatan = $cek_catatan->num_rows();
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
                        action="<?php echo base_url();?>guru/form_isi_catatanwk?m=catatan_wali_kelas">
                        <div class="form-group">
                            <input type="hidden" name="idwali" value="<?php echo $wali_id_wali;?>">
                            <input type="hidden" name="idkelas" value="<?php echo $idkelas;?>">
                            <input type="hidden" name="idtahun" value="<?php echo $idtahun;?>">
                            <label><strong>Sebagai Wali Kelas :</strong> </label>
                            <input class="form-control ml-3" type="text" value="<?php echo $nama_kelas;?>" readonly>

                        </div>
                        <div class="form-group ml-5">
                            <label><strong>Pada Semester</strong> </label>
                            <select class="form-control form-control-sm ml-3" name="semester">
                                <option value="<?php echo $idsemester;?>"><?php echo $semester_aktif;?></option>
                            </select>
                        </div>
                        <?php
                    if($catatan>0)
                    {
                      echo "<button class='btn btn-primary ml-3' type='submit' name='update'>Perbarui/Input Catatan</button>";
                    }
                    else
                    {
                     echo "<button class='btn btn-primary ml-3' type='submit' name='input'>Perbarui/Input Catatan</button>";
                    }
                    ?>
                    </form>
                    <br><br>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</section>