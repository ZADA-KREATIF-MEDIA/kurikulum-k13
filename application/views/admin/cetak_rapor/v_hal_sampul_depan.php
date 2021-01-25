<?php
$sekolah = $identitas_sekolah->row();
$siswa = $identitas_siswa->row();
$datakepsek = $kepsek->row();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Cetak Sampul Depan</title>
<style type="text/css">
.font_raport {
	font-family: Arial, Helvetica, sans-serif;
	font-size:12pt;
}

.font_raport_tebal {
	font-family: Arial, Helvetica, sans-serif;
	font-size:12pt;
	font-weight:bold;
}

.font_raport_bold {
	font-family: Arial, Helvetica, sans-serif;
	font-size:14pt;
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
    <td align="center"><table width="90%" cellspacing="0" cellpadding="2" border="0" align="center">
      <tbody><tr>
        <td align="center">&nbsp;</td>
      </tr>
      <tr>
        <td height="46" align="center"><span class="font_raport_bold">LAPORAN</span></td>
      </tr>
      <tr>
        <td height="35" align="center"><span class="font_raport_bold">CAPAIAN KOMPETENSI PESERTA DIDIK</span></td>
      </tr>
      <tr>
        <td height="35" align="center"><span class="font_raport_bold">SEKOLAH MENENGAH ATAS</span></td>
      </tr>
      <tr>
        <td height="37" align="center"><span class="font_raport_bold">( SMA )</span></td>
      </tr>
      <tr>
        <td align="center"><p>&nbsp;</p>
          <p>&nbsp;</p></td>
      </tr>
      <tr>
        <td align="center"><img src="Cetak%20Identitas%20Sekolah_files/TUT_WURI.png" alt="logo" width="184" height="196"></td>
      </tr>
      <tr>
        <td height="34" align="center">&nbsp;</td>
      </tr>
    </tbody></table>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <table width="90%" cellspacing="0" cellpadding="2" border="0">
        <tbody><tr>
          <td class="font_raport" height="36" align="center">Nama Peserta Didik</td>
        </tr>
        <tr>
          <td height="36" align="center"><table width="100%" cellspacing="0" cellpadding="2" border="1">
            <tbody><tr>
              <td class="font_raport_bold" align="center"><?php echo strip_tags($siswa->nama_siswa);?></td>
            </tr>
          </tbody></table></td>
        </tr>
        <tr>
          <td height="39" align="center"><table width="25%" cellspacing="0" cellpadding="2" border="1">
            <tbody><tr>
              <td class="font_raport_bold" align="center">NIS : <?php echo strip_tags(strtoupper($siswa->nis));?></td>
            </tr>
          </tbody></table></td>
        </tr>
      </tbody></table>
      <p>&nbsp;</p>
      <table width="90%" cellspacing="0" cellpadding="2" border="0">
        <tbody><tr>
          <td height="36" align="center"><span class="font_raport_bold">KEMENTRIAN PENDIDIKAN DAN KEBUDAYAAN</span></td>
        </tr>
        <tr>
          <td height="36" align="center"><span class="font_raport_bold">REPUBLIK INDONESIA</span></td>
        </tr>
      </tbody></table>
      </td>
  </tr>
</tbody></table>
<div style="page-break-before: always;"></div>



</body></html>