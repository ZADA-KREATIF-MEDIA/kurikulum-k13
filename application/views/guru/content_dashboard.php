<div class="col-md-9">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#activity" data-toggle="tab"><span class="visible-lg visible-md visible-sm">Pengumduman</span><span class="visible-xs text-center"><i class="fa fa-globe"></i><br><small style="font-size: 8pt;">Pengumuman</small></span></a> </li>
                  
                  <li><a href="#profil" data-toggle="tab"><span class="visible-lg visible-md visible-sm">Profil</span><span class="visible-xs text-center"><i class="fa fa-user"></i><br><small style="font-size: 8pt;">Profil</small></span></a></li>
                </ul>
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                    <?php 
                   
                    foreach($pengumuman->result() as $pgm){?>

                    <div class="post">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="<?php echo base_url();?>assets/photos/<?php echo $pgm->foto_admin;?>" alt="user image">
                        <span class='username'>
                          <a href="#"><?php echo $pgm->author;?></a>
                          <!--<a href='#' class='pull-right btn-box-tool'><i class='fa fa-times'></i></a>-->
                        </span>
                        <span class='description'><?php echo tgl_indoo($pgm->tgl_post)." ".date('H:i',strtotime($pgm->tgl_post));?> </span>
                      </div><!-- /.user-block -->
                     <?php echo $pgm->isi_post;?>
                      <!--<ul class="list-inline">
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
                      </form> -->
                    </div> <!--/.post -->
                  <?php }?>
                 
					<hr>
					<strong><a href=<?php echo base_url('guru/index_pgm?=dashboard');?>>Lihat semua pengumuman..</a></strong>
                  </div><!-- /.tab-pane -->
                  
                  <?php $data=$user->row_array();?>
                  <div class="tab-pane" id="profil">
                    <form method="post" action="<?php echo base_url('guru/set_profile');?>" class="form-horizontal" enctype="multipart/form-data">
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Nama</label>
                        <div class="col-sm-10">
                          <input type="hidden" name="id_guru" value="<?php echo $data['id_guru'];?>">
                          <input type="text" name="nama" value="<?php echo $data['nama_guru'];?>" class="form-control" id="inputName" placeholder="Nama">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputNIP" class="col-sm-2 control-label">NIP</label>
                        <div class="col-sm-10">
                          <input type="text" name="nip" value="<?php echo $data['nip'];?>" class="form-control" id="inputNIP" placeholder="NIP">
                        </div>
                      </div>
                       <div class="form-group">
                        <label for="inputNIK" class="col-sm-2 control-label">NIK</label>
                        <div class="col-sm-10">
                          <input type="text" name="nik" value="<?php echo $data['nik'];?>" class="form-control" id="inputNIK" placeholder="NIK">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputJK" class="col-sm-2 control-label">Jenis Kelamin</label>
                        <div class="col-sm-10">
                          <select name="jk" class="form-control">
                            <option value="L" <?php if($data['kelamin']=='L'){echo 'selected';}?>>Laki-laki</option>
                            <option value="P" <?php if($data['kelamin']=='P'){echo 'selected';}?>>Perempuan</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputAlamat" class="col-sm-2 control-label">Alamat</label>
                        <div class="col-sm-10">
                          <textarea name="alamat_guru"" class="form-control" id="inputAlamat" placeholder="Alamat"><?php echo $data['alamat_guru'];?></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputTelpon" class="col-sm-2 control-label">Telepon</label>
                        <div class="col-sm-10">
                          <input type="text" name="telpon"  value="<?php echo $data['telpon_guru'];?>" class="form-control" id="inputTelpon" placeholder="Telepon">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputTelpon" class="col-sm-2 control-label">Username</label>
                        <div class="col-sm-10">
                          <input type="text" name="username"  value="<?php echo $data['username'];?>" class="form-control" id="inputUsername" placeholder="Username">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputFile" class="col-sm-2 control-label">Foto</label>
                        <div class="col-sm-5">
                          <input type="file" name="userfile">
                          <input type="hidden" name="fotolm" value="<?php echo $data['foto_guru'];?>">
                        </div>
                        <div class="col-sm-5">
                          <img src="<?php echo base_url('assets/photos/'.$data['foto_guru'].'');?>" class="img-responsive" alt="(foto guru)"/>
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