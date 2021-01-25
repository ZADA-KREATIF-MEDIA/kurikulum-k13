<?php

	$username=ucwords($this->session->userdata('nama'));
  $id_guru=$this->session->userdata('id');
	
	$data=$user->row_array();
  $status_sebagai ="Guru";
	$kelamin=$data['kelamin'];
	$nama_lengkap =$data['nama_guru'];
	$nip_lengkap =$data['nip'];
	$alamat_pengguna =$data['alamat_guru'];
	$telpon_pengguna =$data['telpon_guru'];
	if($kelamin=='L'){
		$sapaan='Pak ';
	}else{
		$sapaan='Ibu ';
	}
	
	$pengguna=$sapaan.$username;
  $waktu_akses = $this->session->userdata('waktu');

?>

 
                 
        <!-- Content Header (Page header) -->
          <?php include('application/views/section_header.php');?>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-sm-12">
              <?php echo $this->session->flashdata('notif');?>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">

              <!-- Profile Image -->
              <div class="box box-primary">
                <div class="box-body box-profile">
                  <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url('assets/photos/'.$data['foto_guru'].'');?>" alt="User profile picture">
                  <h3 class="profile-username text-center"><?php echo $nama_lengkap;?> </h3>
                  <p class="text-muted text-center"><small>Waktu Akses <br>[ <?php echo $waktu_akses;?> ]</small></p>

                  <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                      <b>Pesan Masuk</b> <a class="pull-right">32</a>
                    </li>
                    <li class="list-group-item">
                      <b>Pesan Keluar</b> <a class="pull-right">27</a>
                    </li>
                    <!--<li class="list-group-item">
                      <b>Friends</b> <a class="pull-right">13,287</a>
                    </li>-->
                  </ul>

                  <a href="<?php echo base_url('login/logout');?>" class="btn btn-danger btn-block" onclick="return confirm('Apakah Anda yakin?')"><b>Keluar Aplikasi</b></a>
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
                    <?php echo $nip_lengkap;?> 
                  </p>
  
                  <strong><i class="fa fa-map-marker margin-r-5"></i>Alamat</strong>
                  <p class="text-muted">
                    <?php echo $alamat_pengguna;?> 
                  </p>
  

                  <strong><i class="fa fa-tty margin-r-5"></i>Nomor Telp</strong>
                  <p class="text-muted"><?php echo $telpon_pengguna;?> </p>

                  <!--<hr>

                  <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>
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

            <?php $this->load->view($content_utama);?> 

          </div><!-- /.row -->

        </section><!-- /.content -->
     
      <div class="modal fade" id="ubahsandi">
          <div class="modal-dialog">
            <div class="modal-content">
              <form method="post" action="<?php echo base_url('guru/change_password');?>" class="form-horizontal">
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
                    <input type="password" name="pwd_baru" class="form-control"/>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-md-4 control-label">Password Konfirmasi</label>
                  <div class="col-md-8">
                    <input type="password" name="pwd_confirm" class="form-control"/>
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