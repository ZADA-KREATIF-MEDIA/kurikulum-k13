<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Formulir Penambahan Data Guru</h3>
                    <hr>
                </div>
                <div class="box-body">
                    <form action="<?php echo base_url('admin/tambah_guru'); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nama">Nama Guru</label>
                            <input type="text" class="form-control" name="nama_guru" value="<?php echo set_value('nama_guru'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="niy/nigk">NIY/NIGK</label>
                            <input type="text" class="form-control" name="niy" value="<?php echo set_value('niy'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="niy/nigk">NIK (Nomor Induk Kependudukan)</label>
                            <input type="text" class="form-control" name="nik" value="<?php echo set_value('nik'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="kelamin">Jenis Kelamin</label>
                            <select name="kelamin" class="form-control">
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" name="alamat" placeholder="alamat lengkap"><?php echo set_value('alamat'); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="telepon">Telepon</label>
                            <input type="text" class="form-control" name="telpon" value="<?php echo set_value('telpon'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" value="<?php echo set_value('username'); ?>">
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="pwd">Password</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="repwd">Konfirmasi Password</label>
                                    <input type="password" class="form-control" name="repassword">
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <label for="foto" class="col-md-3 control-label">Foto guru</label>
                            <div class="col-md-5">
                                <input type="file" name="userfile">
                            </div>
                        </div> -->
                        <div class="form-group">
                            <input type="submit" name="submit" value="Tambah" class="btn btn-primary" />
                            <a href="<?= base_url('admin/data_guru') ?>" class="btn btn-danger">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>