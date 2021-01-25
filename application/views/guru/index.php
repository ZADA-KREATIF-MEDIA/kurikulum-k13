  <?php 
  $username=$this->session->userdata('nama');
  $id_guru=$this->session->userdata('id');
  
  $data = $user->row_array();
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
  $infosekolah = $this->db->query("SELECT * FROM info_sekolah")->row();
  //tulisan
  $halaman_public = $this->db->query("SELECT id_post,judul_post FROM tbl_post WHERE type_post='halaman' AND privacy_post='publik' ORDER BY judul_post ASC");
   $halaman_guru = $this->db->query("SELECT id_post,judul_post FROM tbl_post WHERE type_post='halaman' AND privacy_post='guru' ORDER BY judul_post ASC");
  $halaman_wk = $this->db->query("SELECT id_post,judul_post FROM tbl_post WHERE type_post='halaman' AND privacy_post='wali_kelas' ORDER BY judul_post ASC");
 
  $tahun_aktif = $this->db->query("SELECT id_tahun FROM setup_tahun WHERE status_aktif=1")->row('id_tahun');
  $sbg_wali_kelas = $this->db->query("SELECT id_guru FROM tbl_wali WHERE id_guru='$id_guru' AND id_tahun='$tahun_aktif'");


?>

    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $infosekolah->nama_aplikasi;?></title>
    <link rel="shortcut icon" href="<?php echo base_url();?>favicon.ico" type="image/x-icon">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/font-awesome/css/font-awesome.min.css">
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">-->
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/select2/select2.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/skins/skin-green.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/iCheck/square/blue.css">
    

     <script type="text/javascript" language="javascript">
    function konfirmasi(){
      tanya = confirm("Yakin akan menghapus data ini ?");
      if (tanya == true)return true;
      else return false;
    }
    </script>
    
  </head>
  <body class="hold-transition skin-green fixed sidebar-mini">
  <div class="wrapper">
		<!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="#" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini">CP</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><?php echo $infosekolah->nama_sekolah;?></span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

              <!-- Notifications Menu -->
              <li class="dropdown notifications-menu">
                <!-- Menu toggle button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-file-o"></i> Halaman
                </a>
                <ul class="dropdown-menu">
                  <!--<li class="header">Ada 10 pembaruan aktifitas</li>-->
                  <li>
                    <!-- Inner Menu: contains the notifications -->
                    <ul class="menu">
                      <?php 
                     if($halaman_public->num_rows()>0){
                      foreach($halaman_public->result() as $hal_public){?>
                      <li><!-- start notification -->
                        <a href="<?php echo base_url('guru/readmore/'.$hal_public->id_post.'/'.url_title($hal_public->judul_post, 'underscore', TRUE).'');?>">
                          <?php echo $hal_public->judul_post;?>
                        </a>
                      </li><!-- end notification -->
                    <?php }
                    }
                    if($halaman_guru->num_rows()>0){
                      foreach($halaman_guru->result() as $hal_guru){?>
                        <li><!-- start notification -->
                          <a href="<?php echo base_url('guru/readmore/'.$hal_guru->id_post.'/'.url_title($hal_guru->judul_post, 'underscore', TRUE).'');?>">
                            <?php echo $hal_guru->judul_post;?>
                          </a>
                        </li>
                      <?php 
                      }
                    }
                    //Periksa apakah sebagai wali_kelas pada tahun yang aktif?
                    if($sbg_wali_kelas->num_rows()>0)
                    {
                      foreach($halaman_wk->result() as $hal_wk){
                      echo "<li><a href='".base_url('guru/readmore/'.$hal_wk->id_post.'/'.url_title($hal_wk->judul_post, 'underscore', TRUE).'')."'>$hal_wk->judul_post</a></li>";
                      }
                    }

                    
                    ?>

                    </ul>
                  </li>
                
                </ul>
              </li>

              <?php /*
              <!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown messages-menu">
                <!-- Menu toggle button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-success">4</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">Ada 4 pesan baru belum dibaca</li>
                  <li>
                    <!-- inner menu: contains the messages -->
                    <ul class="menu">
                      <li><!-- start message -->
                        <a href="#">
                          <div class="pull-left">
                            <!-- User Image -->
                            <img src="<?php echo base_url();?>assets/dist/img/user1-128x128.jpg" class="img-circle" alt="User Image">
                          </div>
                          <!-- Message title and timestamp -->
                          <h4>
                            Suwali Sugriwo-Wali 
                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                          </h4>
                          <!-- The message -->
                          <p>Tolong awasi anak saya lebih..</p>
                        </a>
                      </li><!-- end message -->
					     <li><!-- start message -->
                        <a href="#">
                          <div class="pull-left">
                            <!-- User Image -->
                            <img src="<?php echo base_url();?>assets/dist/img/user8-128x128.jpg" class="img-circle" alt="User Image">
                          </div>
                          <!-- Message title and timestamp -->
                          <h4>
                            Pak anwari SH-Wali 
                            <small><i class="fa fa-clock-o"></i> 8 mins</small>
                          </h4>
                          <!-- The message -->
                          <p>Saya sudah mendidik anak saya untuk..</p>
                        </a>
                      </li><!-- end message -->
                    </ul><!-- /.menu -->
                  </li>
                  <li class="footer"><a href="#">Lihat semua pesan.</a></li>
                </ul>
              </li><!-- /.messages-menu -->

              <!-- Notifications Menu -->
              <li class="dropdown notifications-menu">
                <!-- Menu toggle button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning">10</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">Ada 10 pembaruan aktifitas</li>
                  <li>
                    <!-- Inner Menu: contains the notifications -->
                    <ul class="menu">
                      <li><!-- start notification -->
                        <a href="#">
                          <i class="fa fa-users text-aqua"></i> Pak Setia sangat mengomentari status anda
                        </a>
                      </li><!-- end notification -->
					  <li><!-- start notification -->
                        <a href="#">
                          <i class="fa fa-users text-aqua"></i> Bu aulia membuat status baru
                        </a>
                      </li><!-- end notification -->
					  <li><!-- start notification -->
                        <a href="#">
                          <i class="fa fa-users text-aqua"></i> 5 guru juga menomentari status pak sangat
                        </a>
                      </li><!-- end notification -->
                    </ul>
                  </li>
                  <li class="footer"><a href="#">Lihat semua..</a></li>
                </ul>
              </li>*/?>
            
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <img src="<?php echo base_url('assets/photos/'.$data['foto_guru'].'');?>" class="user-image" alt="User Image">
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs"><?php echo $nama_lengkap;?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <img src="<?php echo base_url('assets/photos/'.$data['foto_guru'].'');?>" class="img-circle" alt="User Image">
                    <p>
                      <?php echo $nama_lengkap;?> <br>
					  Anda login sebagai <?php echo $status_sebagai; ?>
                      
                    </p>
                  </li>
               
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?php echo base_url();?>" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a class="btn btn-default btn-flat" href="<?php echo base_url();?>login/logout" id="logout" onclick="return confirm('Apakah Anda yakin?')">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo base_url('assets/photos/'.$data['foto_guru'].'');?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $nama_lengkap;?> </p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-success"></i> <?php echo $status_sebagai; ?></a>
            </div>
          </div>
          <br><br>
          <!-- search form (Optional) -->
          <!--<form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>-->
          <!-- /.search form -->
		  <!-- Sidebar Menu -->
		  <?php 
			$domain=$this->session->userdata('status');
			
			if($domain=='admin'){
				$this->load->view('admin/menu-admin');
			}
			if($domain=='guru'){
				$this->load->view('guru/menu-guru');
			}
			?>
			
         <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
          <!-- Your Page Content Here -->
			 <?php 
     $this->load->view($content);
      ?>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
          <small>Web by <a href="http://www.watulintang.com" target="_blank">www.watulintang.com</a></small>
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2015 <a href="<?php echo base_url();?>"><?php echo $infosekolah->nama_sekolah;?></a>.</strong> All rights reserved.
      </footer>
 <!-- Add the sidebar's background. This div must be placed
    immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->
<!-- REQUIRED JS SCRIPTS -->
<!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- Select2 -->
    <script src="<?php echo base_url();?>assets/plugins/select2/select2.full.min.js"></script>
	     <!-- DataTables -->
    <script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="<?php echo base_url();?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url();?>assets/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>assets/dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url();?>assets/dist/js/demo.js"></script>

<!-- ICheck-->
      <script src="<?php echo base_url();?>assets/plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        
        //Initialize Select2 Elements
        $('.select2').select2()

        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>


<script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": false,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
    </body>
    </html>
