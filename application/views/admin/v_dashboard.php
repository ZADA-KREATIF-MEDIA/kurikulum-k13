<?php

$username = ucwords($this->session->userdata('nama'));

$data = $user->row_array();
$status_sebagai = "Administrator";
$kelamin = $data['kelamin'];
$nama_lengkap = $data['nama_admin'];
$nip_lengkap = $data['nip'];
$alamat_pengguna = $data['alamat_admin'];
$telpon_pengguna = $data['telpon_admin'];
if ($kelamin == 'L') {
  $sapaan = 'Mas ';
} else {
  $sapaan = 'Mbak ';
}

$pengguna = $sapaan . $username;
$waktu_akses = $this->session->userdata('waktu');

?>
<?php include('application/views/section_header.php'); ?>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <?php echo $this->session->flashdata('notif'); ?>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <?php
      echo $this->session->flashdata('profil_open') . $this->session->flashdata('validation_errors') . $this->session->flashdata('upload_errors') . $this->session->flashdata('profil_close');
      echo $this->session->flashdata('profil_sukses'); ?>
    </div>
  </div>
  <div class="row">
    <div class="col-md-3">

      <!-- Profile Image -->
      <div class="box box-primary">
        <div class="box-body box-profile">
          <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url('assets/photos/' . $data['foto_admin'] . ''); ?>" alt="User profile picture">
          <h3 class="profile-username text-center"><?php echo $nama_lengkap; ?> </h3>
          <p class="text-muted text-center"><small>Waktu Akses <br>[ <?php echo $waktu_akses; ?> ]</small></p>

          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <b>Pesan Masuk</b> <a class="pull-right">32</a>
            </li>
            <li class="list-group-item">
              <b>Pesan Keluar</b> <a class="pull-right">27</a>
            </li>

          </ul>

          <a onclick="return confirm('Apakah Anda yakin?');" href="<?php echo base_url('login/logout'); ?>" class="btn btn-danger btn-block"><b>Keluar Aplikasi</b></a>
        </div><!-- /.box-body -->
      </div><!-- /.box -->

      <!-- About Me Box -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Biodata Singkat</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <strong><i class="fa fa-book margin-r-5"></i>Nomor <?php echo $status_sebagai; ?></strong>
          <p class="text-muted">
            <?php echo $nip_lengkap; ?>
          </p>

          <strong><i class="fa fa-map-marker margin-r-5"></i>Alamat</strong>
          <p class="text-muted">
            <?php echo $alamat_pengguna; ?>
          </p>


          <strong><i class="fa fa-tty margin-r-5"></i>Nomor Telp</strong>
          <p class="text-muted"><?php echo $telpon_pengguna; ?> </p>

          <!--<strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>
                  <p>
                    <span class="label label-danger">UI Design</span>
                    <span class="label label-success">Coding</span>
                    <span class="label label-info">Javascript</span>
                    <span class="label label-warning">PHP</span>
                    <span class="label label-primary">Node.js</span>
                  </p>

                  <hr>

                  <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>-->
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
    <div class="col-md-9">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <?php /*<li class="active"><a href="#activity" data-toggle="tab"><span class="visible-lg visible-md visible-sm">Aktivitas Guru</span><span class="visible-xs text-center"><i class="fa fa-globe"></i><br><small style="font-size: 8pt;">Aktivitas Guru</small></span></a> </li>*/ ?>
          <li class="active"><a href="#timeline" data-toggle="tab"><span class="visible-lg visible-md visible-sm">Status System</span><span class="visible-xs text-center"><i class="fa fa-commenting"></i><br><small style="font-size: 8pt;">System Status</small></span></a></li>
          <li><a href="#profile" data-toggle="tab"><span class="visible-lg visible-md visible-sm">Profil</span><span class="visible-xs text-center"><i class="fa fa-user"></i><br><small style="font-size: 8pt;">Profil</small></span></a></li>
        </ul>
        <div class="tab-content">
          <?php /*<div class="active tab-pane" >
                    <!-- Post -->
                    <div class="post">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="<?php echo base_url();?>assets/dist/img/user1-128x128.jpg" alt="user image">
                        <span class='username'>
                          <a href="#">Admin</a>
                          <a href='#' class='pull-right btn-box-tool'><i class='fa fa-times'></i></a>
                        </span>
                        <span class='description'>Admin system - 7:30 PM today</span>
                      </div><!-- /.user-block -->
                      <ul class="list-inline">
                        <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                        <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a></li>
                        <li class="pull-right"><a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments (5)</a></li>
                      </ul>

                      <form class='form-horizontal'>
                        <div class='form-group margin-bottom-none'>
                          <div class='col-sm-10'>
                            <input class="form-control input-sm" placeholder="Beri komentar...">
                          </div>                          
                          <div class='col-sm-2'>
                            <button class='btn btn-primary pull-right btn-block btn-sm'>Kirim</button>
                          </div>                          
                        </div>                        
                      </form>
                    </div><!-- /.post -->

                    <!-- Post -->
					
					
                    <div class="post clearfix">
                      <div class='user-block'>
                        <img class='img-circle img-bordered-sm' src='<?php echo base_url();?>assets/dist/img/user7-128x128.jpg' alt='user image'>
                        <span class='username'>
                          <a href="#">Sarah Ross</a>
                          <a href='#' class='pull-right btn-box-tool'><i class='fa fa-times'></i></a>
                        </span>
                        <span class='description'>Guru Matematika - 3 hari lalu, 7:30 WIB</span>
                      </div><!-- /.user-block -->
                      <p>
                        Saya sudah mengentry nilainya,ayo bapak Ibu segera mengisi yaa. Untuk siswa kelas XI IPA-1 atas nama Andri Septian mohon dicermati kembali ya bapak Ibu karena siswa itu sangat aktif.Trims :))
                      </p>

                      <form class='form-horizontal'>
                        <div class='form-group margin-bottom-none'>
                          <div class='col-sm-10'>
                            <input class="form-control input-sm" placeholder="Beri komentar...">
                          </div>                          
                          <div class='col-sm-2'>
                            <button class='btn btn-primary pull-right btn-block btn-sm'>Kirim</button>
                          </div>                          
                        </div>                        
                      </form>
                    </div><!-- /.post -->

                    <!-- Post -->
                       <div class="post">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="<?php echo base_url();?>assets/dist/img/user6-128x128.jpg" alt="user image">
                        <span class='username'>
                          <a href="#">Setia Sangat</a>
                          <a href='#' class='pull-right btn-box-tool'><i class='fa fa-times'></i></a>
                        </span>
                        <span class='description'>Guru Bahasa Indonesia - 1 Minggu lalu,17:22 PM  </span>
                      </div><!-- /.user-block -->
                      <p>
                        Sisteme apik mas, Good Job :v
                      </p>
                      <ul class="list-inline">
                        <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                        <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a></li>
                        <li class="pull-right"><a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments (2)</a></li>
                      </ul>

                      <form class='form-horizontal'>
                        <div class='form-group margin-bottom-none'>
                          <div class='col-sm-10'>
                            <input class="form-control input-sm" placeholder="Beri komentar...">
                          </div>                          
                          <div class='col-sm-2'>
                            <button class='btn btn-primary pull-right btn-block btn-sm'>Kirim</button>
                          </div>                          
                        </div>                        
                      </form>
                    </div><!-- /.post -->
					<hr>
					<strong><a href=#>Lihat semua status...</a></strong>
                  </div><!-- /.tab-pane -->*/ ?>
          <div class="active tab-pane" id="timeline">
            <!-- The timeline -->
            <ul class="timeline timeline-inverse">
              <!-- timeline time label -->
              <li class="time-label">
                <span class="bg-red">
                  Tahun Ajaran <?php echo $tahun_aktif->row('tahun'); ?>
                </span>
              </li>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              <li>
                <?php if ($setup_tahun > 0 && $setup_semester > 0) { ?>
                  <i class="fa fa-check bg-green"></i>
                <?php
                } else { ?>
                  <i class="fa fa-times bg-red"></i>
                <?php } ?>
                <div class="timeline-item">
                  <!--<span class="time"><i class="fa fa-clock-o"></i> 12:05</span>-->
                  <h3 class="timeline-header">Pengaturan Tahun Ajaran & Semester</h3>
                  <p><small>Tahun Ajaran aktif (<?php echo $tahun_aktif->row('tahun'); ?>) - Semester Aktif (<?php echo $semester_aktif->row('semester'); ?>)</small></p>

                </div>
              </li>
              <!-- END timeline item -->
              <!-- timeline item -->
              <li>
                <?php if ($setup_kelas > 0) { ?>
                  <i class="fa fa-check bg-green"></i>
                <?php
                } else { ?>
                  <i class="fa fa-times bg-red"></i>
                <?php } ?>
                <div class="timeline-item">
                  <!--<span class="time"><i class="fa fa-clock-o"></i> 12:05</span>-->
                  <h3 class="timeline-header">Input Data Kelas</h3>

                </div>
              </li>
              <!-- END timeline item -->
              <!-- timeline item -->
              <li>
                <?php if ($setup_pelajaran > 0) { ?>
                  <i class="fa fa-check bg-green"></i>
                <?php
                } else { ?>
                  <i class="fa fa-times bg-red"></i>
                <?php } ?>
                <div class="timeline-item">
                  <!--<span class="time"><i class="fa fa-clock-o"></i> 12:05</span>-->
                  <h3 class="timeline-header">Input Data Mata Pelajaran

                </div>
              </li>
              <!-- END timeline item -->
              <!-- timeline item -->
              <li>
                <?php if ($kepsek > 0) { ?>
                  <i class="fa fa-check bg-green"></i>
                <?php
                } else { ?>
                  <i class="fa fa-times bg-red"></i>
                <?php } ?>
                <div class="timeline-item">
                  <!--<span class="time"><i class="fa fa-clock-o"></i> 12:05</span>-->
                  <h3 class="timeline-header">Input Data Kepala Sekolah & Referensi Tanggal

                </div>
              </li>
              <!-- END timeline item -->
              <!-- timeline item -->
              <li>
                <?php if ($input_ekstra > 0) { ?>
                  <i class="fa fa-check bg-green"></i>
                <?php
                } else { ?>
                  <i class="fa fa-times bg-red"></i>
                <?php } ?>
                <div class="timeline-item">
                  <!--<span class="time"><i class="fa fa-clock-o"></i> 12:05</span>-->
                  <h3 class="timeline-header">Input Data Ekstra Kurikuler

                </div>
              </li>
              <!-- END timeline item -->
              <!-- timeline item -->
              <li>
                <?php if ($kkm > 0) { ?>
                  <i class="fa fa-check bg-green"></i>
                <?php
                } else { ?>
                  <i class="fa fa-times bg-red"></i>
                <?php } ?>
                <div class="timeline-item">
                  <!--<span class="time"><i class="fa fa-clock-o"></i> 12:05</span>-->
                  <h3 class="timeline-header">Input Nilai KKM

                </div>
              </li>
              <!-- END timeline item -->
              <!-- timeline item -->
              <li>
                <?php if ($identitas_sekolah > 0) { ?>
                  <i class="fa fa-check bg-green"></i>
                <?php
                } else { ?>
                  <i class="fa fa-times bg-red"></i>
                <?php } ?>
                <div class="timeline-item">
                  <!--<span class="time"><i class="fa fa-clock-o"></i> 12:05</span>-->
                  <h3 class="timeline-header">Input Identitas Sekolah

                </div>
              </li>
              <!-- END timeline item -->
              <!-- timeline item -->
              <li>
                <?php if ($dataguru > 0) { ?>
                  <i class="fa fa-check bg-green"></i>
                <?php
                } else { ?>
                  <i class="fa fa-times bg-red"></i>
                <?php } ?>
                <div class="timeline-item">
                  <!--<span class="time"><i class="fa fa-clock-o"></i> 12:05</span>-->
                  <h3 class="timeline-header">Input Data Guru

                </div>
              </li>

              <!-- END timeline item -->
              <!-- timeline item -->
              <li>
                <?php if ($datasiswa > 0) { ?>
                  <i class="fa fa-check bg-green"></i>
                <?php
                } else { ?>
                  <i class="fa fa-times bg-red"></i>
                <?php } ?>
                <div class="timeline-item">
                  <!--<span class="time"><i class="fa fa-clock-o"></i> 12:05</span>-->
                  <h3 class="timeline-header">Input Data Siswa

                </div>
              </li>
              <!-- timeline item -->
              <li>
                <?php if ($tdk_punya_kls > 0) { ?>
                  <i class="fa fa-times bg-red"></i>
                <?php
                } else { ?>
                  <i class="fa fa-check bg-green"></i>
                <?php } ?>
                <div class="timeline-item">
                  <!--<span class="time"><i class="fa fa-clock-o"></i> 12:05</span>-->
                  <h3 class="timeline-header">Terdapat <?php echo $tdk_punya_kls; ?> Siswa belum mendapatkan kelas.

                </div>
              </li>
              <!-- END timeline item -->
              <!-- timeline item -->
              <li>
                <?php if ($pembagian_kelas > 0) { ?>
                  <i class="fa fa-check bg-green"></i>
                <?php
                } else { ?>
                  <i class="fa fa-times bg-red"></i>
                <?php } ?>
                <div class="timeline-item">
                  <!--<span class="time"><i class="fa fa-clock-o"></i> 12:05</span>-->
                  <h3 class="timeline-header">Pembagian Kelas

                </div>
              </li>
              <!-- END timeline item -->
              <!-- timeline item -->
              <li>
                <?php if ($tbjadwal > 0) { ?>
                  <i class="fa fa-check bg-green"></i>
                <?php
                } else { ?>
                  <i class="fa fa-times bg-red"></i>
                <?php } ?>
                <div class="timeline-item">
                  <!--<span class="time"><i class="fa fa-clock-o"></i> 12:05</span>-->
                  <h3 class="timeline-header">Pembagian Jadwal Guru

                </div>
              </li>
              <!-- END timeline item -->

              <!-- timeline item -->
              <li>
                <?php if ($wali_kelas > 0) { ?>
                  <i class="fa fa-check bg-green"></i>
                <?php
                } else { ?>
                  <i class="fa fa-times bg-red"></i>
                <?php } ?>
                <div class="timeline-item">
                  <!--<span class="time"><i class="fa fa-clock-o"></i> 12:05</span>-->
                  <h3 class="timeline-header">Pembagian Wali Kelas

                </div>
              </li>
              <!-- END timeline item -->

              <li>
                <i class="fa fa-clock-o bg-gray"></i>
              </li>
            </ul>
          </div><!-- /.tab-pane -->

          <div class="tab-pane" id="profile">
            <form method="post" action="<?php echo base_url('admin/set_profile'); ?>" class="form-horizontal" enctype="multipart/form-data">
              <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Nama</label>
                <div class="col-sm-10">
                  <input type="hidden" name="id_admin" value="<?php echo $data['id_admin']; ?>">
                  <input type="text" name="nama" value="<?php echo $data['nama_admin']; ?>" class="form-control" id="inputName" placeholder="Nama">
                </div>
              </div>
              <div class="form-group">
                <label for="inputNIP" class="col-sm-2 control-label">NIP</label>
                <div class="col-sm-10">
                  <input type="text" name="nip" value="<?php echo $data['nip']; ?>" class="form-control" id="inputNIP" placeholder="NIP">
                </div>
              </div>
              <div class="form-group">
                <label for="inputJK" class="col-sm-2 control-label">Jenis Kelamin</label>
                <div class="col-sm-10">
                  <select name="jk" class="form-control">
                    <option value="L" <?php if ($data['kelamin'] == 'L') {
                                        echo 'selected';
                                      } ?>>Laki-laki</option>
                    <option value="P" <?php if ($data['kelamin'] == 'P') {
                                        echo 'selected';
                                      } ?>>Perempuan</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="inputAlamat" class="col-sm-2 control-label">Alamat</label>
                <div class="col-sm-10">
                  <textarea name="alamat_admin"" class=" form-control" id="inputAlamat" placeholder="Alamat"><?php echo $data['alamat_admin']; ?></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="inputTelpon" class="col-sm-2 control-label">Telepon</label>
                <div class="col-sm-10">
                  <input type="text" name="telpon" value="<?php echo $data['telpon_admin']; ?>" class="form-control" id="inputTelpon" placeholder="Telepon">
                </div>
              </div>
              <div class="form-group">
                <label for="inputTelpon" class="col-sm-2 control-label">Username</label>
                <div class="col-sm-10">
                  <input type="text" name="username" value="<?php echo $data['username']; ?>" class="form-control" id="inputUsername" placeholder="Username">
                </div>
              </div>
              <div class="form-group">
                <label for="inputFile" class="col-sm-2 control-label">Foto</label>
                <div class="col-sm-5">
                  <input type="file" name="userfile">
                  <input type="hidden" name="fotolm" value="<?php echo $data['foto_admin']; ?>">
                </div>
                <div class="col-sm-5">
                  <img src="<?php echo base_url('assets/photos/' . $data['foto_admin'] . ''); ?>" class="img-responsive" alt="(foto admin)" />
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <div class="checkbox icheck">
                    <label>
                      <input type="checkbox" required=""> Saya menyatakan data saya adalah valid dan dapat dipertanggung jawabkan. <a href="#">baca terms and conditions</a>
                    </label>
                  </div>

                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </div>
            </form>
            <hr>
            <button class="btn btn-danger btn-md pull-right" data-toggle="modal" data-target="#ubahsandi"><i class="fa fa-key"></i> UBAH PASSWORD</button><br><br>
          </div><!-- /.tab-pane -->
        </div><!-- /.tab-content -->
      </div><!-- /.nav-tabs-custom -->
    </div><!-- /.col -->
  </div><!-- /.row -->

</section><!-- /.content -->
<div class="modal fade" id="ubahsandi">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" action="<?php echo base_url('admin/change_password'); ?>" class="form-horizontal">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Ubah Password!</h4>
        </div>

        <div class="modal-body">
          <div class="form-group">
            <label class="col-md-4 control-label">Password Saat Ini</label>
            <div class="col-md-8">
              <input type="password" name="pwd_saat_ini" class="form-control" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label">Password Baru</label>
            <div class="col-md-8">
              <input type="password" name="pwd_baru" class="form-control" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label">Password Konfirmasi</label>
            <div class="col-md-8">
              <input type="password" name="pwd_confirm" class="form-control" />
            </div>
          </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->