<?php $row = $data_guru->row(); ?>
<section class="content">
    <div class="row">
        <div class="col-sm-12">
            <?php
            echo $this->session->flashdata('notif'); ?>
        </div>
    </div>
    <div class="box">
        <div class="box-header with-border">
            <script type="text/javascript">
                function go_guru() {
                    document.location.href = "<?php echo base_url('admin/data_guru'); ?>";
                }
            </script>
            <h3 class="box-title">Formulir Edit Data Guru</h3>
            <hr>
        </div>
        <div class="box-body">
            <form action="<?php echo base_url('admin/update_guru'); ?>" method="post" class="form-horizontal" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nama">Nama Guru</label>
                    <input type="hidden" name="id_guru" value="<?php echo $row->id_guru; ?>">
                    <input type="text" class="form-control" name="nama_guru" value="<?php echo $row->nama_guru; ?>">
                </div>
                <div class="form-group">
                    <label for="niy/nigk">NIY/NIGK</label>
                    <input type="text" class="form-control" name="niy" value="<?php echo $row->nip; ?>">
                </div>
                <div class="form-group">
                    <label for="niy/nigk">NIK (Nomor Induk Kependudukan)</label>
                    <input type="text" class="form-control" name="nik" value="<?php echo $row->nik; ?>">
                </div>
                <div class="form-group">
                    <label for="kelamin">Kelmain</label>
                    <select name="kelamin" class="form-control">
                        <option value="L" <?php if ($row->kelamin == "L") {
                                                echo "selected";
                                            } ?>>Laki-laki</option>
                        <option value="P" <?php if ($row->kelamin == "P") {
                                                echo "selected";
                                            } ?>>Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control" name="alamat" placeholder="alamat lengkap"><?php echo $row->alamat_guru; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="telepon">Telepon</label>
                    <input type="text" class="form-control" name="telpon" value="<?php echo $row->telpon_guru; ?>">
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" value="<?php echo $row->username; ?>">
                </div>
                <!-- <div class="form-group">
                    <label for="foto" class="col-md-3 control-label">Foto guru</label>
                    <div class="col-md-5">
                        <?php
                        if ($row->foto_guru != '') {
                            echo "<img src='" . base_url('assets/photos/' . $row->foto_guru . '') . "' alt='---' class='img-rounded' width='50%'/><br>";
                        } ?>
                        <input type="hidden" name="fotolama" value="<?php echo $row->foto_guru; ?>">
                        <input type="file" name="userfile">
                        <small class="help-block">File : jpg/png, Max.500Kb</small>
                    </div>
                </div> -->
                <div class="form-group">
                    <input type="submit" name="submit" value="Update" class="btn btn-primary" />
                    <a href="<?= base_url('admin/data_guru') ?>" class="btn btn-danger">Kembali</a>
                </div>
            </form>
            <hr>
        </div>
    </div>
    <!-- /data kelas -->
</section>