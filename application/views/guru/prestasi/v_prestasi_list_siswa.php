<?php
$nama_kelas = $kelas->row('nama_kelas');
$id_kelas = $kelas->row('id_kelas');
?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php echo $this->session->flashdata('notif'); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-primary" role="alert">
                Data Prestasi Siswa <strong>
                    <?php echo $nama_kelas; ?> </strong></h5>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">
                    <div class="box-body">
                        <form method="post" class="form-horizontal"
                            action="<?php echo base_url('guru/set_prestasi_siswa'); ?>">
                            <div class="form-group">
                                <label class="col-md-6 control-label">Nama Siswa</label>
                                <?php
echo "<input type=\"hidden\" name=\"idkelas\" value=\"$id_kelas\">
										<input type=\"hidden\" name=\"idsemester\" value=\"$idsemester\">
										<input type=\"hidden\" name=\"idtahun\" value=\"$idtahun\">
										<input type=\"hidden\" name=\"idwali\" value=\"$wali_id_wali\">"; ?>
                                <select name="nis" class="form-control select2" style="width: 100%;">
                                    <?php
foreach ($siswadikelas->result() as $s) {
    echo "<option value='$s->nis'>$s->nis - $s->nama_siswa</option>";
}
?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 control-label">Jenis Kegiatan</label>
                                <input type="text" class="form-control" name="jenis">
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 control-label">Keterangan</label>
                                <textarea class="form-control" name="ket"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">
                    <h5 class="box-title text-blue">
                </div><!-- /.box-header -->
                <div class="box-body no-padding table-responsive">
                    <table class="table table-striped table-condensed table-hover">
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Aksi</th>
                        </tr>
                        <?php
$i = 1;
foreach ($prestasi_siswa->result_array() as $row) {
    ?>
                        <tr>
                            <td>&nbsp; <?php echo $i++; ?></td>
                            <td><?php echo $row['nis']; ?></td>
                            <td><?php echo $row['nama_siswa']; ?></td>
                            <td>
                                <a href="<?php echo base_url('guru/edit_prestasi_siswa/' . $row['nis'] . '/' . $row['id_kelas'] . '/' . $row['id_wali'] . '-' . $row['id_semester'] . '-' . $row['id_tahun'] . '/?set=update&m=input_nilai&sm=prestasi'); ?>"
                                    class="btn btn-danger btn-sm"><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                        <?php
}
?>
                    </table>
                    <br>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</section>