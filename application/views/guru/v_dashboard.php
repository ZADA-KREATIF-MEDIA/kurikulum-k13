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

   echo $nama_lengkap;?> 