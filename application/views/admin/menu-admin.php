<?php
$cek_mstatus = $this->input->get('m');
$sub = $this->input->get('sm');
$sub2 = $this->input->get('ssm');
?>

<ul class="sidebar-menu">
	<li class="header">MENU ADMIN</li>
			<li class="<?php if($cek_mstatus=='dashboard'){ echo 'active';}?>"><a href="<?php echo base_url('admin');?>?m=dashboard"><i class="fa fa-home"></i> <span>Halaman awal</span></a></li>
            <li class="treeview <?php if($cek_mstatus=='setup'){ echo 'active';}?>">
              <a href="#"><i class="fa fa-cog"></i><span>SETUP</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
				<li class="<?php if($sub=='kelas'){ echo 'active';}?>"><a href="<?php echo base_url();?>admin/setup_kelas?m=setup&sm=kelas"><i class="fa fa-home"></i> <span>Kelas</span></a></li>
				<li class="<?php if($sub=='pelajaran'){ echo 'active';}?>"><a href="<?php echo base_url();?>admin/setup_pelajaran?m=setup&sm=pelajaran"><i class="fa fa-file-powerpoint-o"></i> <span>Pelajaran</span></a></li>
				<li class="<?php if($sub=='tahun_pelajaran'){ echo 'active';}?>"><a href="<?php echo base_url();?>admin/setup_tahun_pelajaran?m=setup&sm=tahun_pelajaran"><i class="fa fa-calendar-o"></i> <span>Tahun Pelajaran</span></a></li>
				<li class="<?php if($sub=='kkm'){ echo 'active';}?>"><a href="<?php echo base_url();?>admin/setup_kkm?m=setup&sm=kkm"><i class="fa fa-bar-chart"></i> <span>KKM</span></a></li>
				<li class="<?php if($sub=='ekstra_kurikuler'){ echo 'active';}?>"><a href="<?php echo base_url();?>admin/setup_ekstra?m=setup&sm=ekstra_kurikuler"><i class="fa fa-bar-chart"></i> <span>Ekstra Kurikuler</span></a></li>
				<li class="<?php if($sub=='kepsek'){ echo 'active';}?>"><a href="<?php echo base_url();?>admin/setup_kepsek?m=setup&sm=kepsek"><i class="fa fa-users"></i> <span>Ref. Kepala Sekolah & Tanggal</span></a></li>
				<li class="<?php if($sub=='identitas_sekolah'){ echo 'active';}?>"><a href="<?php echo base_url();?>admin/identitas_sekolah?m=setup&sm=identitas_sekolah"><i class="fa fa-info-circle"></i> <span>Identitas Sekolah</span></a></li>
				
			  </ul>
			</li>
			<li class="treeview <?php if($cek_mstatus=='data_induk'){ echo 'active';}?>">
              <a href="#"><i class="fa fa-users"></i><span>DATA INDUK</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
				<li class="<?php if($sub=='guru'){ echo 'active';}?>"><a href="<?php echo base_url();?>admin/data_guru?m=data_induk&sm=guru"><i class="fa fa-user-secret"></i> <span>Guru</span></a></li>
				<li class="<?php if($sub=='siswa'){ echo 'active';}?>"><a href="<?php echo base_url();?>admin/data_siswa?m=data_induk&sm=siswa"><i class="fa fa-user"></i> <span>Siswa</span></a></li>
			  </ul>
			</li>
			<li class="treeview <?php if($cek_mstatus=='edit_nilai'){ echo 'active';}?>">
              <a href="#"><i class="fa fa-edit"></i><span>EDIT NILAI</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
				<li class="<?php if($sub=='pengetahuan_ketrampilan'){ echo 'active';}?>"><a href="<?php echo base_url();?>admin_editnilai/edit_nilai_peng_ketr?m=edit_nilai&sm=pengetahuan_ketrampilan"><i class="fa fa-circle-o"></i> <span>Nilai Pengetahuan/Ketrampilan</span></a></li>
				<li class="<?php if($sub=='deskripsi_nilai'){ echo 'active';}?>"><a href="<?php echo base_url();?>admin_editnilai/edit_deskripsi_nilai?m=edit_nilai&sm=deskripsi_nilai"><i class="fa fa-circle-o"></i> <span>Deskripsi Nilai</span></a></li>
				<li class="<?php if($sub=='edit_sikap'){ echo 'active';}?>"><a href="<?php echo base_url();?>admin_editnilai/edit_sikap?m=edit_nilai&sm=edit_sikap"><i class="fa fa-circle-o"></i> <span>Nilai Sikap</span></a></li>
				<li class="<?php if($sub=='nilai_ekstra'){ echo 'active';}?>"><a href="<?php echo base_url();?>admin_editnilai/edit_ekstrakurikuler?m=edit_nilai&sm=nilai_ekstra"><i class="fa fa-circle-o"></i> <span>Nilai Ekstra</span></a></li>
				<li class="<?php if($sub=='prestasi'){ echo 'active';}?>"><a href="<?php echo base_url();?>admin_editnilai/edit_prestasi?m=edit_nilai&sm=prestasi"><i class="fa fa-circle-o"></i> <span>Prestasi</span></a></li>
				<li class="<?php if($sub=='data_kehadiran'){ echo 'active';}?>"><a href="<?php echo base_url();?>admin_editnilai/edit_data_kehadiran?m=edit_nilai&sm=data_kehadiran"><i class="fa fa-circle-o"></i> <span>Data Kehadiran</span></a></li>
			  </ul>
			</li>
			<li class="treeview <?php if($cek_mstatus=='penjadwalan'){ echo 'active';}?>">
              <a href="#"><i class="fa fa-sitemap"></i><span>PENJADWALAN</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu"> 
              	<li class="<?php if($sub=='set_kelas_siswa_baru'){ echo 'active';}?>"><a href="<?php echo base_url();?>admin/ruangkelas_siswa_baru?m=penjadwalan&sm=set_kelas_siswa_baru"><i class="fa fa-user-plus"></i> <span>Set Kelas - Siswa Baru</span></a></li>
				<li class="<?php if($sub=='ruang_kelas'){ echo 'active';}?>"><a href="<?php echo base_url();?>admin/jadwal_ruangkelas?m=penjadwalan&sm=ruang_kelas"><i class="fa fa-random"></i> <span>Ruang Kelas</span></a></li>
				<li class="<?php if($sub=='guru_mengajar'){ echo 'active';}?>"><a href="<?php echo base_url();?>admin/jadwal_guru?m=penjadwalan&sm=guru_mengajar"><i class="fa fa-user"></i> <span>Guru Mengajar</span></a></li>
				<li class="<?php if($sub=='wali_kelas'){ echo 'active';}?>"><a href="<?php echo base_url();?>admin/penjadwalan_wali_kelas?m=penjadwalan&sm=wali_kelas"><i class="fa fa-user-secret"></i> <span>Wali Kelas</span></a></li>
			  </ul>
			</li>
			<li class="treeview <?php if($cek_mstatus=='pelaporan'){ echo 'active';}?>">
              <a href="#"><i class="fa fa-file-text"></i><span>PELAPORAN</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">  
				<li class="<?php if($sub=='legger_semua'){ echo 'active';}?>"><a href="<?php echo base_url();?>cetak/legger_semua?m=pelaporan&sm=legger_semua"><i class="fa fa-file-text-o"></i> <span>Legger Semua</span></a></li>
				 <li class="<?php if($sub=='cetak_rapor'){ echo 'active';}?>"><a href="<?php echo base_url();?>cetak/cetak_rapor?m=pelaporan&sm=cetak_rapor"><i class="fa fa-mortar-board"></i> <span>Cetak Rapor</span></a></li>
				 <li class="treeview <?php if($sub=='cetak_sampul'){ echo 'active';}?>"><a href="#"><i class="fa fa-print"></i> <span>Cetak Sampul</span> <i class="fa fa-angle-left pull-right"></i></a>
				 	 <ul class="treeview-menu">
                <li class="<?php if($sub2=='sampul_depan'){ echo 'active';}?>"><a href="<?php echo base_url();?>cetak/cetak_sampul/depan?m=pelaporan&sm=cetak_sampul&ssm=sampul_depan"><i class="fa fa-circle-o"></i> Sampul Depan</a></li>
                <li class="<?php if($sub2=='identitas'){ echo 'active';}?>"><a href="<?php echo base_url();?>cetak/cetak_sampul/identitas?m=pelaporan&sm=cetak_sampul&ssm=identitas"><i class="fa fa-circle-o"></i> Identitas</a></li>
               
              </ul>
				 	
				 </li>
				</ul>
			</li>
				  
			
			<li class="treeview <?php if($cek_mstatus=='post'){ echo 'active';}?>">
              <a href="#"><i class="fa fa-pencil"></i> <span>POST</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">  
				<li class="<?php if($sub=='new_post'){ echo 'active';}?>"><a href="<?php echo base_url();?>admin/tulisan_baru?m=post&sm=new_post"><i class="fa fa-file-o"></i> <span>Tulisan Baru</span></a></li>
				 <li class="<?php if($sub=='semua_tulisan'){ echo 'active';}?>"><a href="<?php echo base_url();?>admin/semua_tulisan?m=post&sm=semua_tulisan"><i class="fa fa-book"></i> <span>Semua Tulisan</span></a></li>	
				</ul>
			</li>
			<!--<li class="treeview">
              <a href="#"><i class="fa fa-envelope"></i> <span>Interaktif</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="?page=blank">Pesan Masuk</a></li>
                <li><a href="?page=blank">Pesan Keluar</a></li>
              </ul>
			</li>-->
						
</ul>

 			<p></p>
		  <center><a  href="<?php echo base_url('login/logout');?>" id="logout" onclick="return confirm('Apakah Anda yakin?')" button class="btn btn-danger"><i class="glyphicon glyphicon-off"></i> Sign out</a></center>
		  
