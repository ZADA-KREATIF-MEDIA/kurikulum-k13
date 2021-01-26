<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Formulir Penambahan Data Guru</h3>
                    <hr>
                </div>
                <div class="box-body">
                    <form action="<?php echo base_url('admin/tambah_guru');?>" method="post" class="form-horizontal"
                        enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nama" class="col-md-3 control-label">Nama Guru</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="nama_guru"
                                    value="<?php echo set_value('nama_guru');?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="niy/nigk" class="col-md-3 control-label">NIY/NIGK</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="niy"
                                    value="<?php echo set_value('niy');?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="niy/nigk" class="col-md-3 control-label">NIK (Nomor Induk Kependudukan)</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="nik"
                                    value="<?php echo set_value('nik');?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kelamin" class="col-md-3 control-label">Kelmain</label>
                            <div class="col-md-5">
                                <select name="kelamin" class="form-control">
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="alamat" class="col-md-3 control-label">Alamat</label>
                            <div class="col-md-5">
                                <textarea class="form-control" name="alamat"
                                    placeholder="alamat lengkap"><?php echo set_value('alamat');?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="telepon" class="col-md-3 control-label">Telepon</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="telpon"
                                    value="<?php echo set_value('telpon');?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-md-3 control-label">Username</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="username"
                                    value="<?php echo set_value('username');?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pwd" class="col-md-3 control-label">Password</label>
                            <div class="col-md-5">
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="repwd" class="col-md-3 control-label">Konfirmasi Password</label>
                            <div class="col-md-5">
                                <input type="password" class="form-control" name="repassword">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="foto" class="col-md-3 control-label">Foto guru</label>
                            <div class="col-md-5">
                                <input type="file" name="userfile">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="aksi" class="col-md-3 control-label"></label>
                            <div class="col-md-5">
                                <input type="submit" name="submit" value="Tambah" class="btn btn-primary" />
                                <input type="reset" value="Reset" class="btn btn-danger" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>