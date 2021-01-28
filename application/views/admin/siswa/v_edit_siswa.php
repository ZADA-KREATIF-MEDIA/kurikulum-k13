<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Form Edit Siswa</h3>
                    <hr>
                </div>
                <br>
                <?php  echo $this->session->flashdata('notif');?>
                <div class="box-body">
                    <form action="<?php echo base_url('admin/update_siswa');?>" method="post" class="row" enctype="multipart/form-data">
                        <input type="hidden" name="id_siswa" value="<?= $siswa['id_siswa']?>">
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="nama">Nama Siswa</label>
                            <input type="text" class="form-control" name="nama_siswa" value="<?= $siswa['nama_siswa'] ;?>" placeholder="Masukkan Nama Siswa">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="nis">NIS</label>
                            <input type="text" class="form-control" name="nis" value="<?= $siswa['nis'] ?>" placeholder="Masukkan NIS">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="nisn">NISN</label>
                            <input type="text" class="form-control" name="nisn" value="<?= $siswa['nisn'];?>" placeholder="Masukkan NISN">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="ttl">Tempat Lahir</label>
                            <input type="text" class="form-control" id="ttl" name="tempat_lahir" value="<?= $siswa['tempat_lahir'];?>" placeholder="Masukkan Tempat Lahir">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="tgl_lahir">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?= $siswa['tgl_lahir'];?>">
                        </div>            
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="kelamin">Jenis Kelamin</label>
                            <select name="kelamin"  class="form-control" >
                                <option value="L" <?php if($siswa['kelamin'] == "L"){ echo "selected"; }?>>Laki-laki</option>
                                <option value="P" <?php if($siswa['kelamin'] == "P"){ echo "selected"; }?>>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="agama">Agama</label>
                            <select name="agama" id="" class="form-control">
                                <option value="islam" <?php if($siswa['agama'] == "islam"){echo "selected";}?>>Islam</option>
                                <option value="kristen" <?php if($siswa['agama'] == "kristen"){echo "selected";}?>>Kristen</option>
                                <option value="katholik" <?php if($siswa['agama'] == "katholik"){echo "selected";}?>>Katholik</option>
                                <option value="budha" <?php if($siswa['agama'] == "budha"){echo "selected";}?>>Budha</option>
                                <option value="hindu" <?php if($siswa['agama'] == "hindu"){echo "selected";}?>>Hindu</option>
                                <option value="konghucu" <?php if($siswa['agama'] == "konghucu"){echo "selected";}?>>Konghucu</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="stts_dlm_kel">Status dalam Keluarga</label>
                            <select name="status_dlm_kel"  class="form-control" >
                                <option value="Anak Kandung" <?php if($siswa['status_dlm_kel'] == "Anak Kandung"){ echo "selected"; }?>>Anak Kandung</option>
                                <option value="Anak Angkat" <?php if($siswa['status_dlm_kel'] == "Anak Angkat"){ echo "selected"; }?>>Anak Angkat</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="anakke">Anak ke</label>
                                <select name="anakke"  class="form-control" >
                                <?php
                                $i=1;
                                for($i;$i<=10;$i++)
                                {
                                echo "<option value='$i'>$i</option>";
                                }
                                ?>
                                </select>
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" name="alamat_siswa" placeholder="alamat lengkap"><?= $siswa['alamat_siswa'];?></textarea>
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="telepon">Telpon Siswa</label>
                            <input type="text" class="form-control" name="telpon_siswa" value="<?= $siswa['telpon_siswa'];?>" placeholder="Masukkan Nomor Telpon Siswa">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="asal_sekolah">Asal Sekolah</label>
                            <input type="text" class="form-control" name="asal_sekolah" value="<?= $siswa['asal_sekolah'];?>" placeholder="Masukkan Asal Sekolah">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="kelas">Diterima di Kelas</label>
                            <select name="kelas"  class="form-control" >
                                <?php foreach($kelas as $kls): ?>
                                    <option value="<?= $kls['id_kelas'] ?>" <?php if($siswa['kelas'] == $kls['id_kelas'])?>><?= $kls['nama_kelas'] ?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="tgl_diterima">Diterima Tanggal</label>
                            <input type="date" class="form-control" name="diterima_tgl" value="<?= $siswa['diterima_tanggal'] ?>" placeholder="Masukkan Tanggal Diterima">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="ayah">Nama Ayah</label>
                            <input type="text" class="form-control" name="nama_ayah" value="<?= $siswa['nama_ayah'] ?>" placeholder="Masukkan Nama Ayah">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="kerja_ayah">Pekerjaan Ayah</label>
                            <input type="text" class="form-control" name="kerja_ayah" value="<?= $siswa['kerja_ayah'];?>" placeholder="Masukkan Pekerjaan Ayah">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="ibu">Nama Ibu</label>
                            <input type="text" class="form-control" name="nama_ibu" value="<?= $siswa['nama_ibu'];?>" placeholder="Masukkan Nama Ibu">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="kerja_ibu">Kerja Ibu</label>
                            <input type="text" class="form-control" name="kerja_ibu" value="<?= $siswa['kerja_ibu'];?>" placeholder="Masukkan Pekerjaan Ibu">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="telepon_ortu">Telpon Ortu</label>
                            <input type="text" class="form-control" name="telpon_ortu" value="<?= $siswa['telpon_ortu'];?>" placeholder="Masukkan Nomor Telephone Ortu">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="almt_ortu">Alamat Ortu</label>
                            <input type="text" class="form-control" name="alamat_ortu" value="<?= $siswa['alamat_ortu'];?>" placeholder="Masukkan Alamat Orang Tua">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="nama_wali">Nama Wali</label>
                            <input type="text" class="form-control" name="nama_wali" value="<?= $siswa['nama_wali'];?>" placeholder="Masukkan Nama Wali">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="kerja_wali">Pekerjaan Wali</label>
                            <input type="text" class="form-control" name="kerja_wali" value="<?= $siswa['kerja_wali'];?>" placeholder="Masukkan Pekerjaan Wali">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="telpon_wali">Telpon Wali</label>
                            <input type="text" class="form-control" name="telpon_wali" value="<?= $siswa['telpon_wali'];?>" placeholder="Masukkan Nomor Telephone Wali">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="alamat_wali">Alamat Wali</label>
                            <input type="text" class="form-control" name="alamat_wali" value="<?= $siswa['alamat_wali'];?>" placeholder="Masukkan Alamat Wali">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="ta">Tahun Ajaran</label>
                            <select name="tahun_ajaran"  class="form-control" >
                            <?php foreach($tahunajaran as $ta):?>
                                <option value="<?= $ta['id_tahun'] ?>"><?= $ta['tahun'] ?></option>
                            <?php endforeach;?>
                            </select>
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" value="<?= $siswa['username'];?>" placeholder="Masukkan Username">
                        </div>
                        <button type="submit" name="submit" value="Tambah" class="btn btn-primary">Update</button>
                        &nbsp;
                        <button type="reset" value="Reset"  class="btn btn-danger">Reset</button>
                    </form>
                    <hr>		
                </div>
            </div>
        </div><!-- .col-md-8-->
    </div>
</section>
