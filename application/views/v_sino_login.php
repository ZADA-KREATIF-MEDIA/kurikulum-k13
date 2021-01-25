<?php
$sekolah = $this->db->query("SELECT * FROM info_sekolah")->row();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title> Login - <?php echo $sekolah->nama_aplikasi;?> </title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/skins/skin-green.min.css">
	   <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/iCheck/square/blue.css">
</head>
<body id="login-bg" onLoad="document.postform.elements['username'].focus();"  class="hold-transition login-page" > 
 
<!-- Start: login-holder -->




<!-- End: login-holder -->
    <div class="login-box">
	
      <div align=center>
	  <table>
		<tr>
		<td><img src="<?php echo base_url('assets/photos/'.$sekolah->logo.'');?>"  width=85%></td><td valign=top width=80%><h3> <B>Halaman login</B> <br><small>Sistem Informasi Nilai Online Siswa</small><br><?php echo $sekolah->nama_sekolah;?></h3></td>
		</tr>
	 </table>
         
      </div><!-- /.login-logo -->
	  <span class="btn btn-block btn-success btn-flat"></span> 
      <div class="login-box-body">
        <?php echo $this->session->flashdata('notif'); ?>
		 
        <p class="login-box-msg">Masukan Username dan Password anda</p>
        <form  action="<?php echo base_url('login/aksi_login');?>" method="post">
          <div class="form-group has-feedback">
            <input type="text" name="username" class="form-control" placeholder="Username" autofocus="">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control"  name="password" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
		  <div class="form-group has-feedback">
		     <select name="level" class="form-control">
            	
            <!--<option value="siswa"> SISWA </option>-->
				    <option value="guru"> GURU </option>
            <option value="admin"> ADMIN </option>
            </select>
		  </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Remember Me
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" name="login" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>

       <!-- <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
          <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
        </div><!-- /.social-auth-links -->

        <a href="#">Lupa akun masuk?</a><br>
       <!-- <a href="register.html" class="text-center">Register a new membership</a>!-->

      </div><!-- /.login-box-body -->
	  <span class="btn btn-block btn-success btn-flat"> <small>Copyright  &#169; 2018 <?php echo $infosekolah->nama_sekolah;?></small></span> 
    </div>
	<script src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
	
	
	<script src="<?php echo base_url();?>assets/plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
	

</body>

</html>