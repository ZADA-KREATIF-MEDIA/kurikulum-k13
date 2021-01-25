<?php
$sekolah = $identitas_sekolah->row();
$siswa = $identitas_siswa->row();
$datakepsek = $kepsek->row();
$numdatakepsek = $kepsek->num_rows();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Cetak Sampul Identitas</title>
<style type="text/css">
.font_raport {
	font-family: Arial, Helvetica, sans-serif;
	font-size:11pt;
}

.font_raport_tebal {
	font-family: Arial, Helvetica, sans-serif;
	font-size:11pt;
	font-weight:bold;
}

.font_raport_bold {
	font-family: Arial, Helvetica, sans-serif;
	font-size:11pt;
	font-weight:bold;
}
</style>

<style type="text/css" media="print">
    .page-break  { display:block; page-break-before:always; }
</style>

</head>

<body>

<table width="100%" cellspacing="0" cellpadding="2" border="0">
  <tbody><tr>
    <td align="center"><table width="60%" cellspacing="0" cellpadding="2" border="0" align="center">
      <tbody><tr>
        <td height="34" align="center"><span class="font_raport_bold">LAPORAN</span></td>
      </tr>
      <tr>
        <td height="35" align="center"><span class="font_raport_bold">CAPAIAN KOMPETENSI PESERTA DIDIK</span></td>
      </tr>
      <tr>
        <td height="35" align="center"><span class="font_raport_bold">SEKOLAH MENENGAH ATAS</span></td>
      </tr>
      <tr>
        <td align="center"><span class="font_raport_bold">( SMA )</span></td>
      </tr>
    </tbody></table>
      <p>&nbsp;</p>
      <table width="80%" cellspacing="0" cellpadding="2" border="0" align="center">
        <tbody><tr>
          <td width="24%" valign="middle" height="29"><span class="font_raport">Nama Sekolah</span></td>
          <td width="4%" valign="middle" align="center">:</td>
          <td colspan="2" class="font_raport" valign="middle"><?php echo strip_tags($sekolah->nama_sekolah);?></td>
        </tr>
        <tr>
          <td valign="middle" height="31"><span class="font_raport">NPSN/NSS</span></td>
          <td valign="middle" align="center">:</td>
          <td colspan="2" class="font_raport" valign="middle"><?php echo strip_tags($sekolah->npsn);?> / <?php echo strip_tags($sekolah->nss);?></td>
        </tr>
        <tr>
          <td valign="top" height="28" align="left"><span class="font_raport">Alamat Sekolah</span></td>
          <td valign="top" align="center">:</td>
          <td colspan="2" class="font_raport" valign="top" align="left"><?php echo strip_tags($sekolah->alamat_sekolah);?></td>
        </tr>
        <tr>
          <td valign="middle" height="23">&nbsp;</td>
          <td valign="middle" align="center">&nbsp;</td>
          <td class="font_raport" width="37%" valign="middle">Kodepos : <?php echo strip_tags($sekolah->kode_pos);?></td>
          <td class="font_raport" width="35%" valign="middle">Telp. <?php echo strip_tags($sekolah->telpon);?></td>
        </tr>
        <tr>
          <td valign="middle" height="31"><span class="font_raport">Kelurahan</span></td>
          <td valign="middle" align="center">:</td>
          <td colspan="2" class="font_raport" valign="middle"><?php echo strip_tags($sekolah->kelurahan);?></td>
        </tr>
        <tr>
          <td valign="middle" height="30"><span class="font_raport">Kecamatan</span></td>
          <td valign="middle" align="center">:</td>
          <td colspan="2" class="font_raport" valign="middle"><?php echo strip_tags($sekolah->kecamatan);?></td>
        </tr>
        <tr>
          <td valign="middle" height="31"><span class="font_raport">Kabupaten</span></td>
          <td valign="middle" align="center">:</td>
          <td colspan="2" class="font_raport" valign="middle"><?php echo strip_tags($sekolah->kabupaten);?></td>
        </tr>
        <tr>
          <td valign="middle" height="32">&nbsp;</td>
          <td valign="middle" align="center">:</td>
          <td colspan="2" class="font_raport" valign="middle"><?php echo strip_tags($sekolah->provinsi);?></td>
        </tr>
        <tr>
          <td valign="middle" height="29"><span class="font_raport">Website</span></td>
          <td valign="middle" align="center">:</td>
          <td colspan="2" class="font_raport" valign="middle"><?php echo htmlentities($sekolah->website);?></td>
        </tr>
        <tr>
          <td valign="middle" height="30"><span class="font_raport">Email</span></td>
          <td valign="middle" align="center">:</td>
          <td colspan="2" class="font_raport" valign="middle"><?php echo htmlentities($sekolah->email);?></td>
        </tr>
      </tbody></table>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p></td>
  </tr>
</tbody></table>
<p>&nbsp;</p>
<div class="page-break"></div>
<p>&nbsp;</p>
<table width="100%" cellspacing="0" cellpadding="2" border="0">
  <tbody><tr>
    <td align="center"><table width="100%" cellspacing="0" cellpadding="2" border="0">
      <tbody><tr>
        <td class="font_raport_bold" align="center">KETERANGAN TENTANG DIRI PESERTA DIDIK</td>
      </tr>
      <tr>
        <td class="font_raport_bold" align="center">&nbsp;</td>
      </tr>
    </tbody></table>
      <table width="90%" cellspacing="0" cellpadding="2" border="0">
        <tbody><tr>
          <td class="font_raport" width="4%" align="center">1.</td>
          <td class="font_raport" width="36%">Nama Peserta Didik (Lengkap)</td>
          <td class="font_raport" width="3%" align="center">:</td>
          <td class="font_raport" width="57%"><?php echo strip_tags($siswa->nama_siswa);?></td>
        </tr>
        <tr>
          <td class="font_raport" align="center">2.</td>
          <td class="font_raport">Nomor Induk Siswa</td>
          <td class="font_raport" align="center">:</td>
          <td class="font_raport"><?php echo strip_tags($siswa->nis);?></td>
        </tr>
        <tr>
          <td class="font_raport" align="center">3.</td>
          <td class="font_raport">Tempat Tanggal Lahir</td>
          <td class="font_raport" align="center">:</td>
          <td class="font_raport"><?php echo strip_tags($siswa->tempat_lahir);?> , <?php echo tgl_indoo($siswa->tgl_lahir);?></td>
        </tr>
        <tr>
          <td class="font_raport" align="center">4.</td>
          <td class="font_raport">Jenis kelamin</td>
          <td class="font_raport" align="center">:</td>
          <td class="font_raport"><?php if($siswa->kelamin=="L"){echo "Laki-laki";}else{echo "Perempuan";}?></td>
        </tr>
        <tr>
          <td class="font_raport" align="center">5.</td>
          <td class="font_raport">Agama</td>
          <td class="font_raport" align="center">:</td>
          <td class="font_raport"><?php echo strip_tags($siswa->agama);?></td>
        </tr>
        <tr>
          <td class="font_raport" align="center">6.</td>
          <td class="font_raport">Status dalam keluarga</td>
          <td class="font_raport" align="center">:</td>
          <td class="font_raport"><?php echo strip_tags($siswa->status_dlm_kel);?></td>
        </tr>
        <tr>
          <td class="font_raport" align="center">7.</td>
          <td class="font_raport">Anak ke</td>
          <td class="font_raport" align="center">:</td>
          <td class="font_raport"><?php echo strip_tags($siswa->anakke);?></td>
        </tr>
        <tr>
          <td class="font_raport" valign="top" height="46" align="center">8.</td>
          <td class="font_raport" valign="top">Alamat Peserta Didik</td>
          <td class="font_raport" valign="top" align="center">:</td>
          <td class="font_raport" valign="top"><?php echo strip_tags($siswa->alamat_siswa);?></td>
        </tr>
        <tr>
          <td class="font_raport" align="center">9.</td>
          <td class="font_raport">Nomor Telepon Rumah</td>
          <td class="font_raport" align="center">:</td>
          <td class="font_raport"><?php echo strip_tags($siswa->telpon_siswa);?></td>
        </tr>
        <tr>
          <td class="font_raport" align="center">10.</td>
          <td class="font_raport">Sekolah Asal</td>
          <td class="font_raport" align="center">:</td>
          <td class="font_raport"><?php echo strip_tags($siswa->asal_sekolah);?></td>
        </tr>
        <tr>
          <td class="font_raport" align="center">11.</td>
          <td class="font_raport">Diterima di sekolah ini </td>
          <td class="font_raport" align="center">&nbsp;</td>
          <td class="font_raport">&nbsp;</td>
        </tr>
        <tr>
          <td class="font_raport" align="center">&nbsp;</td>
          <td class="font_raport">Di kelas</td>
          <td class="font_raport" align="center">:</td>
          <td class="font_raport"><?php echo strip_tags($siswa->nama_kelas);?></td>
        </tr>
        <tr>
          <td class="font_raport" align="center">&nbsp;</td>
          <td class="font_raport">Pada tanggal </td>
          <td class="font_raport" align="center">:</td>
          <td class="font_raport"><?php echo tgl_indoo($siswa->diterima_tanggal);?></td>
        </tr>
        <tr>
          <td class="font_raport" align="center">12.</td>
          <td class="font_raport">Nama Orang Tua</td>
          <td class="font_raport" align="center">&nbsp;</td>
          <td class="font_raport">&nbsp;</td>
        </tr>
        <tr>
          <td class="font_raport" align="center">&nbsp;</td>
          <td class="font_raport">a. Ayah</td>
          <td class="font_raport" align="center">:</td>
          <td class="font_raport"><?php echo strip_tags($siswa->nama_ayah);?></td>
        </tr>
        <tr>
          <td class="font_raport" align="center">&nbsp;</td>
          <td class="font_raport">b. Ibu</td>
          <td class="font_raport" align="center">:</td>
          <td class="font_raport"><?php echo strip_tags($siswa->nama_ibu);?></td>
        </tr>
        <tr>
          <td class="font_raport" valign="top" height="46" align="center">13.</td>
          <td class="font_raport" valign="top">Alamat Orang Tua</td>
          <td class="font_raport" valign="top" align="center">:</td>
          <td class="font_raport" valign="top"><?php echo strip_tags($siswa->alamat_ortu);?></td>
        </tr>
        <tr>
          <td class="font_raport" align="center">&nbsp;</td>
          <td class="font_raport">Nomor Telepon Rumah</td>
          <td class="font_raport" align="center">:</td>
          <td class="font_raport"><?php echo strip_tags($siswa->telpon_ortu);?></td>
        </tr>
        <tr>
          <td class="font_raport" align="center">14.</td>
          <td class="font_raport">Pekerjaan Orang Tua</td>
          <td class="font_raport" align="center">&nbsp;</td>
          <td class="font_raport">&nbsp;</td>
        </tr>
        <tr>
          <td class="font_raport" align="center">&nbsp;</td>
          <td class="font_raport">a. Ayah</td>
          <td class="font_raport" align="center">:</td>
          <td class="font_raport"><?php echo strip_tags($siswa->kerja_ayah);?></td>
        </tr>
        <tr>
          <td class="font_raport" align="center">&nbsp;</td>
          <td class="font_raport">b. Ibu</td>
          <td class="font_raport" align="center">:</td>
          <td class="font_raport"><?php echo strip_tags($siswa->kerja_ibu);?></td>
        </tr>
        <tr>
          <td class="font_raport" align="center">15.</td>
          <td class="font_raport">Nama Wali Peserta Didik </td>
          <td class="font_raport" align="center">:</td>
          <td class="font_raport"><?php echo strip_tags($siswa->nama_wali);?></td>
        </tr>
        <tr>
          <td class="font_raport" valign="top" height="45" align="center">16.</td>
          <td class="font_raport" valign="top">Alamat Wali Peserta Didik</td>
          <td class="font_raport" valign="top" align="center">:</td>
          <td class="font_raport" valign="top"><?php echo strip_tags($siswa->alamat_wali);?></td>
        </tr>
        <tr>
          <td class="font_raport" align="center">&nbsp;</td>
          <td class="font_raport">Nomor Telepon Rumah</td>
          <td class="font_raport" align="center">:</td>
          <td class="font_raport"><?php echo strip_tags($siswa->telpon_wali);?></td>
        </tr>

        <tr>
          <td class="font_raport" align="center">17.</td>
          <td class="font_raport">Pekerjaan Wali Peserta Didik</td>
          <td class="font_raport" align="center">:</td>
          <td class="font_raport"><?php echo strip_tags($siswa->kerja_wali);?></td>
        </tr>
      </tbody></table>
      <table width="90%" cellspacing="0" cellpadding="2" border="0">
        <tbody><tr>
          <td width="25%">&nbsp;</td>
          <td width="16%">&nbsp;</td>
          <td width="11%">&nbsp;</td>
          <td width="48%">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td align="center"><table width="90%" cellspacing="0" cellpadding="2" border="1">
            <tbody><tr>
              <td height="123" align="center"><p>&nbsp;</p>
                <p class="font_raport">Pas Foto</p>
                <p class="font_raport">3 X 4</p>
                </td>
            </tr>
          </tbody></table></td>
          <td>&nbsp;</td>
          <td><table width="100%" cellspacing="0" cellpadding="2" border="0">
            <tbody>
              <tr>
              <td><span class="font_raport">
                <?php 
                if($numdatakepsek>0){
                if($datakepsek->tgl_siswa_diterima!=''){ echo strip_tags($datakepsek->tgl_siswa_diterima);}else{ echo "..........., .................";}
                }else{ echo "..........., .................";} ?>
                  
                </span></td>
            </tr>
            <tr>
              <td><span class="font_raport">Kepala Sekolah</span></td>
            </tr>
            <tr>
              <td height="57">&nbsp;</td>
            </tr>
            <tr>
              <td class="font_raport_tebal">
                <?php
                if($numdatakepsek>0){
                if($datakepsek->nama_guru!=''){echo strip_tags($datakepsek->nama_guru);}else{ echo ".................................";}
                }else{ echo ".................................";}
                ?></td>
            </tr>
            <tr>
              <td><span class="font_raport">NBM <?php 
              if($numdatakepsek>0){
                if($datakepsek->nip!=''){echo strip_tags($datakepsek->nip);}else{ echo "............................";}
              }else{echo ".................................";}?></span></td>
            </tr>
          </tbody></table></td>
        </tr>
      </tbody></table>
      </td>
  </tr>
</tbody></table>


</body></html>