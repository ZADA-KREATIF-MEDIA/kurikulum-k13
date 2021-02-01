<?php
$nama_kelas = $kelas->row('nama_kelas');
$id_kelas = $kelas->row('id_kelas');
$id_tahun = $idtahun;
$id_semester = $idsemester;
?>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-primary" role="alert">
                <h4>Saran/Catatan Wali kelas pada Kelas: <strong><?php echo $nama_kelas;?></strong></h4>
            </div>
            <div class="box">

                <form id="mainform" action="<?php echo base_url('guru/simpan_catatanwk'); ?>" method="post">
                    <div class="box-body no-padding table-responsive">
                        <table class="table table-striped table-condensed table-bordered">
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">NIS</th>
                                <th class="text-center">Nama Siswa</th>
                                <th class="text-center">Catatan</th>
                            </tr>
                            <input type="hidden" name="idkelas" value="<?php echo $id_kelas; ?>" />
                            <input type="hidden" name="idwali" value="<?php echo $wali_id_wali; ?>" />
                            <input type="hidden" name="idsemester" value="<?php echo $id_semester; ?>" />
                            <input type="hidden" name="idtahun" value="<?php echo $id_tahun; ?>" />
                            <?php
$i = 1;
foreach ($catatanwk->result_array() as $row) {
    ?>
                            <?php echo "<input type='hidden' name='nis" . $i . "' value='" . $row['nis'] . "' />"; ?>
                            <tr>
                                <td>&nbsp; <?php echo $i; ?></td>
                                <td><?php echo $row['nis']; ?></td>
                                <td><?php echo $row['nama_siswa']; ?></td>
                                <td><?php echo "<textarea class=\"form-control\" cols='50' name='catatanwk" . $i . "' placeholder='Berikan catatan'></textarea>"; ?>
                                </td>
                            </tr>
                            <?php
$i++;
}
?>
                            <tr>

                                <td colspan="4"> &nbsp; &nbsp; <input type="hidden" name="jumlah"
                                        value="<?php echo $jumSis ?>" /><input type="submit" value="Simpan"
                                        name="insert" class="btn btn-primary" />
                                    &nbsp; - &nbsp;<a
                                        onclick="return confirm('Perubahan belum disimpan,apakah Anda yakin batal mengubah?')"
                                        href="<?php echo base_url('guru/input_catatanwk?m=catatan_wali_kelas'); ?>"
                                        button class="btn btn-danger" /><small
                                        class="glyphicon glyphicon-chevron-left"></small> Batal</a>
                                </td>
                            </tr>
                        </table>
                        <br>
                    </div><!-- /.box-body -->
                </form>
            </div><!-- /.box -->
        </div>
    </div>
</section>