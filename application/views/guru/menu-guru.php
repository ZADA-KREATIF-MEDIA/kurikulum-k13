<?php
$cek_mstatus = $this->input->get('m');
$sub = $this->input->get('sm');
?>
  	<ul class="sidebar-menu">
            <li class="header">MENU GURU</li>
            <!-- Optionally, you can add icons to the links -->
			
            <li class="<?php if($cek_mstatus=='dashboard'){ echo 'active';}?>"><a href="<?php echo base_url('guru');?>?m=dashboard"><i class="fa fa-home"></i> <span>Halaman awal</span></a></li>
            <li class="treeview <?php if($cek_mstatus=='input_nilai'){ echo 'active';}?>">
              <a href="#"><i class="fa fa-users"></i> <span>Input Nilai</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li class="<?php if($sub=='pengetahuan-ketrampilan'){ echo 'active';}?>"><a href="<?php echo base_url('guru/input_nilai?m=input_nilai&sm=pengetahuan-ketrampilan');?>"><i class="fa fa-circle-o"></i> Nilai Pengetahuan & Ketrampilan</a></li>
                <li class="<?php if($sub=='deskripsi_nilai'){ echo 'active';}?>"><a href="<?php echo base_url('guru/input_deskripsi_nilai?m=input_nilai&sm=deskripsi_nilai');?>"> <i class="fa fa-circle-o"></i> Deskripsi Nilai</a></li>
                <!--HANYA WALI-->
                <?php
                $id_guru = $this->session->userdata('id');
                include "include/id_wali_kelas.php";
                if($id_wali_kelas>0){
                echo'<li><a href="'.base_url('guru/input_nilai_sikap?m=input_nilai&sm=input_nilai_sikap').'"><i class="fa fa-circle-o"></i> <span>Input Nilai Sikap</span></a></li>';
                echo'<li><a href="'.base_url('guru/ekstra_kurikuler?m=input_nilai&sm=ekstra_kurikuler').'"><i class="fa fa-circle-o"></i> <span>Ekstra Kurikuler</span></a></li>';
                 echo'<li><a href="'.base_url('guru/input_prestasi?m=input_nilai&sm=prestasi').'"><i class="fa fa-circle-o"></i> <span>Input Prestasi</span></a></li>';
                }
                ?>
              </ul>
            </li>
           
<!--MENU WALI KELAS-->
			<?php
      $id_guru = $this->session->userdata('id');
			include "include/id_wali_kelas.php";
			if($id_wali_kelas>0){
			echo'<li class="'; if($cek_mstatus=='input_kehadiran'){ echo 'active';} echo '"><a href="'.base_url('guru/input_kehadiran?m=input_kehadiran').'"><i class="fa fa-hand-pointer-o"></i> <span>Input Kehadiran</span></a></li>';
      echo'<li><a href="'.base_url('guru/input_catatanwk?m=catatan_wali_kelas').'"><i class="fa fa-pencil-square"></i> <span>Catatan Wali Kelas</span></a></li>';
    
			}
			?>

			<li class="treeview <?php if($cek_mstatus=='laporan_nilai'){ echo 'active';}?>">
              <a href="?m=laporan_nilai"><i class="fa fa-sticky-note-o"></i> <span>Laporan Nilai</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li class="<?php if($sub=='per_mapel'){ echo 'active';}?>"><a href="<?php echo base_url('guru/laporan_per_mapel?m=laporan_nilai&sm=per_mapel');?>">Per Mapel</a></li>
                <?php
                include "include/id_wali_kelas.php";
                if($id_wali_kelas>0){?>
                <li class="<?php if($sub=='legger_semua'){ echo 'active';}?>"><a href="<?php echo base_url('guru/laporan_legger_semua?m=laporan_nilai&sm=legger_semua');?>">Legger Semua</a></li>
               
                <?php 
                }
                ?>
              </ul>
            </li>
              <?php
                include "include/id_wali_kelas.php";
                if($id_wali_kelas>0){?>
        <li class="treeview <?php if($cek_mstatus=='cetak_rapor'){ echo 'active';}?>">
              <a href="?m=cetak_rapor"><i class="fa fa-print"></i> <span>Cetak Rapor</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li class="<?php if($sub=='sampul_depan'){ echo 'active';}?>"><a href="<?php echo base_url();?>cetak/cetak_sampul/depan?m=cetak_rapor&sm=sampul_depan">Sampul Depan</a></li>
                
                <li class="<?php if($sub=='identias'){ echo 'active';}?>"><a href="<?php echo base_url();?>cetak/cetak_sampul/identitas?m=cetak_rapor&sm=identitas">Identias</a></li>
                 <li class="<?php if($sub=='nilai'){ echo 'active';}?>"><a href="<?php echo base_url('cetak/cetak_rapor?m=cetak_rapor&sm=nilai');?>">Nilai Rapor</a></li>
               
              
              </ul>
            </li>
              <?php 
                }
                ?>
			
			<!--<li><a href="?page=grafik"><i class="fa fa-link"></i> <span>Grafik Prestasi</span></a></li>
            <li class="treeview">
              <a href="#"><i class="fa fa-envelope"></i> <span>Interaktif</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="?page=blank">Pesan Masuk</a></li>
                <li><a href="?page=blank">Pesan Keluar</a></li>
              </ul>
            </li>-->
          </ul>
		  <br>
		  <center><a  href="<?php echo base_url('login/logout');?>" id="logout" onclick="return confirm('Apakah Anda yakin?')" button class="btn btn-danger"><i class="glyphicon glyphicon-off"></i> Sign out</a></center>
		  
