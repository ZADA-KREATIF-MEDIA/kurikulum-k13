<?php

$nama_kelas = $kelas->row('nama_kelas');
$id_kelas = $kelas->row('id_kelas');
?>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <?php echo $this->session->flashdata('notif'); ?>
        </div>
    </div>
    <div class="alert alert-primary" role="alert">
        <h4 class="box-title text-blue">Data Prestasi Siswa Kelas
            <strong><?php echo $nama_kelas; ?></strong> </h3>
    </div>
    <div class="row">
        <div class="col-md-6 ">
            <div class="box">
                <div class="box-header">

                    <div class="box-body">
                        <form method="post" class="form-horizontal" action="<?php echo base_url('admin_editnilai/set_prestasi_siswa'); ?>">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Nama Siswa</label>
                                <div class="col-md-12">
                                    <?php
                                    echo "<input type=\"hidden\" name=\"idkelas\" value=\"$id_kelas\">
										<input type=\"hidden\" name=\"idsemester\" value=\"$idsemester\">
										<input type=\"hidden\" name=\"idtahun\" value=\"$idtahun\">"; ?>
                                    <select name="nis" class="form-control select2" style="width: 100%;">
                                        <?php
                                        foreach ($siswadikelas->result() as $s) {
                                            echo "<option value='$s->nis'>$s->nis - $s->nama_siswa</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Jenis Kegiatan</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="jenis">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Keterangan</label>
                                <div class="col-md-12">
                                    <textarea class="form-control" name="ket"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Wali Kelas</label>
                                <div class="col-md-12">
                                    <select name="idwali" class="form-control select2" required="">
                                        <option value="">Pilih Wali</option>
                                        <?php
                                        foreach ($wali_kelas->result() as $wali) {
                                            echo "<option value='$wali->id_wali'>$wali->nama_guru";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"></label>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-md">Simpan</button>
                                    <a href="<?= base_url('admin/edit_prestasi') ?>" class="btn btn-info">Kembali</a>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box">
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
                                    <a href="<?php echo base_url('admin_editnilai/edit_prestasi_siswa/' . $row['nis'] . '/' . $row['id_kelas'] . '/' . $row['id_wali'] . '-' . $row['id_semester'] . '-' . $row['id_tahun'] . '/?set=update&m=edit_nilai&sm=prestasi'); ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Update Prestasi</a>
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