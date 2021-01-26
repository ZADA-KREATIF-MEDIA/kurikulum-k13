<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Form Tambah Siswa</h3>
                    <hr>
                </div>
                <br>
                <div class="box-body">
                    <form action="<?php echo base_url('admin/proses_tambah_siswa');?>" method="post" class="row" enctype="multipart/form-data">
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="nama">Nama Siswa</label>
                            <input type="text" class="form-control" name="nama_siswa" value="<?php echo set_value('nama_siswa');?>" placeholder="Masukkan Nama Siswa">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="nis">NIS</label>
                            <input type="text" class="form-control" name="nis" value="<?php echo set_value('nis');?>" placeholder="Masukkan NIS">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="nisn">NISN</label>
                            <input type="text" class="form-control" name="nisn" value="<?php echo set_value('nisn');?>" placeholder="Masukkan NISN">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="ttl">Tempat Lahir</label>
                            <input type="text" class="form-control" id="ttl" name="tempat_lahir" value="<?php echo set_value('tempat_lahir');?>" placeholder="Masukkan Tempat Lahir">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="tgl_lahir">Tanggal Lahir</label>
                            <input type="text" class="form-control datepicker" id="tgl_lahir" name="tgl_lahir" value="<?php echo set_value('tgl_lahir');?>" readonly>
                        </div>            
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="kelamin">Jenis Kelamin</label>
                            <select name="kelamin"  class="form-control" >
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="agama">Agama</label>
                            <select name="agama" id="" class="form-control">
                                <option value="islam">Islam</option>
                                <option value="kristen">Kristen</option>
                                <option value="katholik">Katholik</option>
                                <option value="budha">Budha</option>
                                <option value="hindu">Hindu</option>
                                <option value="konghucu">Konghucu</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="stts_dlm_kel">Status dalam Keluarga</label>
                            <select name="status_dlm_kel"  class="form-control" >
                                <option value="Anak Kandung">Anak Kandung</option>
                                <option value="Anak Angkat">Anak Angkat</option>
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
                            <textarea class="form-control" name="alamat_siswa" placeholder="alamat lengkap"><?php echo set_value('alamat_siswa');?></textarea>
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="telepon">Telpon Siswa</label>
                            <input type="text" class="form-control" name="telpon_siswa" value="<?php echo set_value('telpon_siswa');?>" placeholder="Masukkan Nomor Telpon Siswa">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="asal_sekolah">Asal Sekolah</label>
                            <input type="text" class="form-control" name="asal_sekolah" value="<?php echo set_value('asal_sekolah');?>" placeholder="Masukkan Asal Sekolah">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="kelas">Diterima di Kelas</label>
                            <select name="kelas"  class="form-control" >
                            <?php
                                $i=1;
                                for($i;$i<=6;$i++)
                                {
                                echo "<option value='$i'>$i</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="tgl_diterima">Diterima Tanggal</label>
                            <input type="text" class="form-control datepicker" name="diterima_tgl" value="<?php echo set_value('diterima_tgl');?>" placeholder="Masukkan Tanggal Diterima">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="ayah">Nama Ayah</label>
                            <input type="text" class="form-control" name="nama_ayah" value="<?php echo set_value('nama_ayah');?>" placeholder="Masukkan Nama Ayah">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="kerja_ayah">Pekerjaan Ayah</label>
                            <input type="text" class="form-control" name="kerja_ayah" value="<?php echo set_value('kerja_ayah');?>" placeholder="Masukkan Pekerjaan Ayah">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="ibu">Nama Ibu</label>
                            <input type="text" class="form-control" name="nama_ibu" value="<?php echo set_value('nama_ibu');?>" placeholder="Masukkan Nama Ibu">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="kerja_ibu">Kerja Ibu</label>
                            <input type="text" class="form-control" name="kerja_ibu" value="<?php echo set_value('kerja_ibu');?>" placeholder="Masukkan Pekerjaan Ibu">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="telepon_ortu">Telpon Ortu</label>
                            <input type="text" class="form-control" name="telpon_ortu" value="<?php echo set_value('telpon_ortu');?>" placeholder="Masukkan Nomor Telephone Ortu">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="almt_ortu">Alamat Ortu</label>
                            <input type="text" class="form-control" name="alamat_ortu" value="<?php echo set_value('alamat_ortu');?>" placeholder="Masukkan Alamat Orang Tua">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="nama_wali">Nama Wali</label>
                            <input type="text" class="form-control" name="nama_wali" value="<?php echo set_value('nama_wali');?>" placeholder="Masukkan Nama Wali">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="kerja_wali">Pekerjaan Wali</label>
                            <input type="text" class="form-control" name="kerja_wali" value="<?php echo set_value('kerja_wali');?>" placeholder="Masukkan Pekerjaan Wali">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="telpon_wali">Telpon Wali</label>
                            <input type="text" class="form-control" name="telpon_wali" value="<?php echo set_value('telpon_wali');?>" placeholder="Masukkan Nomor Telephone Wali">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="alamat_wali">Alamat Wali</label>
                            <input type="text" class="form-control" name="alamat_wali" value="<?php echo set_value('alamat_wali');?>" placeholder="Masukkan Alamat Wali">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="ta">Tahun Ajaran</label>
                            <select name="tahun_ajaran"  class="form-control" >
                            <?php
                            
                            foreach($tahunajaran->result() as $ta)
                            {
                            echo "<option value='$ta->tahun'>$ta->tahun</option>";
                            }
                            ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" value="<?php echo set_value('username');?>" placeholder="Masukkan Username">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="pwd">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Masukkan Password">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="repwd">Konfirmasi Password</label>
                            <input type="password" class="form-control" name="repassword" placeholder="Ulangi Masukkan Password">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="foto">Foto siswa</label>
                            <input type="file" name="userfile" class="form-control">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="foto">Status Siswa</label>
                            <select name="status"  class="form-control" >
                                <option value="1">Aktif</option>
                                <option value="0">Alumni</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="aksi"></label>
                            <div class="col-md-5">
                                <input type="submit" name="submit" value="Tambah" class="btn btn-primary" />
                                <input type="reset" value="Reset"  class="btn btn-danger" />
                            </div>
                        </div>
                    </form>
                    <hr>		
                </div>
            </div>
        </div><!-- .col-md-8-->
    </div>
</section>
