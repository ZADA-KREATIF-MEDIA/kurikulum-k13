<h3>LAPORAN NILAI SISWA</h3>
<hr>
<div class="box-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group col-md-12 col-sm-12">
                <label for="nama">Nama Siswa</label>
                <input type="text" class="form-control" name="nama_siswa" value="<?= $siswa['nama_siswa'] ;?>" readonly>
            </div>
            <div class="form-group col-md-12 col-sm-12">
                <label for="nis">NIS</label>
                <input type="text" class="form-control" name="nis" value="<?= $siswa['nis'] ?>" readonly>
            </div>
            <div class="form-group col-md-12 col-sm-12">
                <label for="nisn">NISN</label>
                <input type="text" class="form-control" name="nisn" value="<?= $siswa['nisn'];?>" readonly>
            </div>
            <div class="form-group col-md-12 col-sm-12">
                <label for="ttl">Tempat Lahir</label>
                <input type="text" class="form-control" id="ttl" name="tempat_lahir"
                    value="<?= $siswa['tempat_lahir'];?>" readonly>
            </div>
            <div class="form-group col-md-12 col-sm-12">
                <label for="tgl_lahir">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir"
                    value="<?= $siswa['tgl_lahir'];?>" readonly>
            </div>
            <div class="form-group col-md-12 col-sm-12">
                <label for="kelamin">Jenis Kelamin</label>
                <select name="kelamin" class="form-control" disabled>
                    <option value="L" <?php if($siswa['kelamin'] == "L"){ echo "selected"; }?>>Laki-laki</option>
                    <option value="P" <?php if($siswa['kelamin'] == "P"){ echo "selected"; }?>>Perempuan</option>
                </select>
            </div>
            <div class="form-group col-md-12 col-sm-12">
                <label for="agama">Agama</label>
                <select name="agama" id="" class="form-control" disabled>
                    <option value="islam" <?php if($siswa['agama'] == "islam"){echo "selected";}?>>Islam</option>
                    <option value="kristen" <?php if($siswa['agama'] == "kristen"){echo "selected";}?>>Kristen</option>
                    <option value="katholik" <?php if($siswa['agama'] == "katholik"){echo "selected";}?>>Katholik
                    </option>
                    <option value="budha" <?php if($siswa['agama'] == "budha"){echo "selected";}?>>Budha</option>
                    <option value="hindu" <?php if($siswa['agama'] == "hindu"){echo "selected";}?>>Hindu</option>
                    <option value="konghucu" <?php if($siswa['agama'] == "konghucu"){echo "selected";}?>>Konghucu
                    </option>
                </select>
            </div>
            <div class="form-group col-md-12 col-sm-12">
                <label for="stts_dlm_kel">Status dalam Keluarga</label>
                <select name="status_dlm_kel" class="form-control" disabled>
                    <option value="Anak Kandung"
                        <?php if($siswa['status_dlm_kel'] == "Anak Kandung"){ echo "selected"; }?>>
                        Anak Kandung</option>
                    <option value="Anak Angkat"
                        <?php if($siswa['status_dlm_kel'] == "Anak Angkat"){ echo "selected"; }?>>
                        Anak Angkat</option>
                </select>
            </div>
            <div class="form-group col-md-12 col-sm-12">
                <label for="anakke">Anak ke</label>
                <select name="anakke" class="form-control" disabled>
                    <?php
                                $i=1;
                                for($i;$i<=10;$i++)
                                {
                                echo "<option value='$i'>$i</option>";
                                }
                                ?>
                </select>
            </div>
            <div class="form-group col-md-12 col-sm-12">
                <label for="alamat">Alamat</label>
                <textarea class="form-control" name="alamat_siswa" readonly><?= $siswa['alamat_siswa'];?></textarea>
            </div>
            <div class="form-group col-md-12 col-sm-12">
                <label for="telepon">Telpon Siswa</label>
                <input type="text" class="form-control" name="telpon_siswa" value="<?= $siswa['telpon_siswa'];?>"
                    readonly>
            </div>
            <div class="form-group col-md-12 col-sm-12">
                <label for="asal_sekolah">Asal Sekolah</label>
                <input type="text" class="form-control" name="asal_sekolah" value="<?= $siswa['asal_sekolah'];?>"
                    readonly>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group col-md-12 col-sm-12">
                <label for="asal_sekolah">Asal Sekolah</label>
                <input type="text" class="form-control" name="asal_sekolah" value="<?= $siswa['asal_sekolah'];?>"
                    readonly>
            </div>
            <div class="form-group col-md-12 col-sm-12">
                <label for="ayah">Nama Ayah</label>
                <input type="text" class="form-control" name="nama_ayah" value="<?= $siswa['nama_ayah'] ?>" readonly>
            </div>
            <div class="form-group col-md-12 col-sm-12">
                <label for="kerja_ayah">Pekerjaan Ayah</label>
                <input type="text" class="form-control" name="kerja_ayah" value="<?= $siswa['kerja_ayah'];?>" readonly>
            </div>
            <div class="form-group col-md-12 col-sm-12">
                <label for="ibu">Nama Ibu</label>
                <input type="text" class="form-control" name="nama_ibu" value="<?= $siswa['nama_ibu'];?>" readonly>
            </div>
            <div class="form-group col-md-12 col-sm-12">
                <label for="kerja_ibu">Kerja Ibu</label>
                <input type="text" class="form-control" name="kerja_ibu" value="<?= $siswa['kerja_ibu'];?>" readonly>
            </div>
            <div class="form-group col-md-12 col-sm-12">
                <label for="telepon_ortu">Telpon Ortu</label>
                <input type="text" class="form-control" name="telpon_ortu" value="<?= $siswa['telpon_ortu'];?>"
                    readonly>
            </div>
            <div class="form-group col-md-12 col-sm-12">
                <label for="almt_ortu">Alamat Ortu</label>
                <input type="text" class="form-control" name="alamat_ortu" value="<?= $siswa['alamat_ortu'];?>"
                    readonly>
            </div>
            <div class="form-group col-md-12 col-sm-12">
                <label for="nama_wali">Nama Wali</label>
                <input type="text" class="form-control" name="nama_wali" value="<?= $siswa['nama_wali'];?>" readonly>
            </div>
            <div class="form-group col-md-12 col-sm-12">
                <label for="kerja_wali">Pekerjaan Wali</label>
                <input type="text" class="form-control" name="kerja_wali" value="<?= $siswa['kerja_wali'];?>" readonly>
            </div>
            <div class="form-group col-md-12 col-sm-12">
                <label for="telpon_wali">Telpon Wali</label>
                <input type="text" class="form-control" name="telpon_wali" value="<?= $siswa['telpon_wali'];?>"
                    readonly>
            </div>
            <div class="form-group col-md-12 col-sm-12">
                <label for="alamat_wali">Alamat Wali</label>
                <input type="text" class="form-control" name="alamat_wali" value="<?= $siswa['alamat_wali'];?>"
                    readonly>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
    <div class="col-md-12">
    <h4> RAPOT PESERTA DIDIK</h4>
    <?php
$predikat_spiritual = strip_tags(strtoupper($nilai_sikap->row('predikat_spiritual')));
$sikap_spiritual = strip_tags($nilai_sikap->row('sikap_spiritual'));
$predikat_sosial = strip_tags(strtoupper($nilai_sikap->row('predikat_sosial')));
$sikap_sosial = strip_tags($nilai_sikap->row('sikap_sosial'));
// //SET HEADER:
// $SET_HEADER = "";
// $SET_HEADER .= "<TABLE WIDTH='100%' CELLSPACING='0' CELLPADDING='2' BORDER='0'>";
// $SET_HEADER .= "<TBODY><TR><TD WIDTH='120PX'>NAMA SEKOLAH</TD><TD>:</TD><TD><B>" . $SEKOLAH['ALAMAT_SEKOLAH']. "</B></TD><TD></TD><TD WIDTH='120PX'>KELAS</TD><TD>:</TD><TD><B>" . $KELAS->NAMA_KELAS . "</B></TD></TR>";
// $SET_HEADER .= "<TR><TD>ALAMAT</TD><TD>:</TD><TD><B>" . $SEKOLAH['ALAMAT_SEKOLAH'] . "</B></TD><TD></TD><TD WIDTH='150PX'>SEMESTER</TD><TD>:</TD><TD><B>" . $SEMESTER->ID_SEMESTER . " / " . UCWORDS($SEMESTER->SEMESTER) . "</B></TD></TR>";
// $SET_HEADER .= "<TR><TD>NAMA</TD><TD>:</TD><TD><B>" . $SISWA['NAMA_SISWA'] . "</B></TD><TD></TD><TD WIDTH='150PX'>TAHUN PELAJARAN</TD><TD>:</TD><TD><B>" . $TAHUN_AJARAN->TAHUN . "</B></TD></TR>";
// $SET_HEADER .= "<TR><TD>NOMOR INDUK/NISN</TD><TD>:</TD><TD><B>" . $SISWA['NIS'] . " / " . $SISWA['NISN']. "</B></TD><TD></TD><TD>&NBSP;</TD><TD></TD><TD>&NBSP;</TD></TR>";
// $SET_HEADER .= "<TR><TD>&NBSP;</TD><TD>&NBSP;</TD><TD>&NBSP;</TD><TD>&NBSP;</TD><TD>&NBSP;</TD><TD>&NBSP;</TD><TD>&NBSP;</TD></TR>";
// $SET_HEADER .= "</TBODY></TABLE><BR>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Cetak Nilai Rapor</title>
  <style type="text/css">
    body {
      font-family: Arial;
      font-size: 10pt;
    }
    .font_raport {
      font-family: Arial, Helvetica, sans-serif;
      font-size: 12pt;
    }
    .font_raport_tebal {
      font-family: Arial, Helvetica, sans-serif;
      font-size: 12pt;
      font-weight: bold;
    }
    .font_raport_bold {
      font-family: Arial, Helvetica, sans-serif;
      font-size: 14pt;
      font-weight: bold;
    }
  </style>
  <style type="text/css" media="print">
    .page-break {
      display: block;
      page-break-before: always;
    }
  </style>
</head>
<body>
  <center><b>CAPAIAN HASIL BELAJAR</b></center>
  <b>A. Sikap</b><br><br>
  <b>1. Sikap Spiritual</b><br>
  <table width="100%" cellspacing="0" cellpadding="2" border="1">
    <tr>
      <td align="center" width="100px"><b>Predikat</b></td>
      <td align="center"><b>Deskripsi</b></td>
    </tr>
    <tr>
      <td align="center" valign="middle">&nbsp;<?php echo $predikat_spiritual; ?></td>
      <td align="left" valign="middle"><?php echo $sikap_spiritual; ?></td>
    </tr>
  </table>
  <br>
  <b>2. Sikap Sosial</b><br>
  <table width="100%" cellspacing="0" cellpadding="2" border="1">
    <tr>
      <td align="center" width="100px"><b>Predikat</b></td>
      <td align="center"><b>Deskripsi</b></td>
    </tr>
    <tr>
      <td align="center" valign="middle"><?php echo $predikat_sosial; ?></td>
      <td align="left" valign="middle"><?php echo $sikap_sosial; ?></td>
    </tr>
  </table>
  <div class="page-break"></div>
  <br>
  <b>B. Pengetahuan</b><br><br>
  Kriteria Ketuntasan Minimal : 73
  <br>
  <table width="100%" cellspacing="0" cellpadding="2" border="1">
    <tbody>
      <tr>
        <td align="center" valign="middle" width="5px"><b>No</b></td>
        <td align="center" valign="middle" width="300px"><b>Mata Pelajaran</b></td>
        <td align="center" valign="middle" width="30px"><b>Nilai</b></td>
        <td align="center" valign="middle" width="30px"><b>Predikat</b></td>
        <td align="center" valign="middle" width="300px"><b>Deskripsi</b></td>
      </tr>
      <tr>
        <td colspan="5" align="left" valign="middle"><b>Kelompok A (WAJIB)</b></td>
      </tr>
      <?php
      $noA = 1;
      foreach ($nilai_rapor->result() as $rownilai) {
        if ($rownilai->id_kat_mapel == 1) {
      ?>
            <!-- Cek Apakah ini Mapel Utama?? -->
            <tr>
              <td align="center" valign="middle"><?php echo $noA++; ?></td>
              <td align="left" valign="middle"><?php echo ucwords($rownilai->nama_pelajaran); ?></td>
              <td align="center" valign="middle"><?php echo $rownilai->nilai_pengetahuan; ?></td>
              <td align="center" valign="middle">
                <?php if ($rownilai->nilai_pengetahuan < 73) {
                  echo "D";
                } elseif ($rownilai->nilai_pengetahuan >= 73 && $rownilai->nilai_pengetahuan <= 81) {
                  echo "C";
                } elseif ($rownilai->nilai_pengetahuan >= 82 && $rownilai->nilai_pengetahuan <= 90) {
                  echo "B";
                } elseif ($rownilai->nilai_pengetahuan >= 91 && $rownilai->nilai_pengetahuan <= 100) {
                  echo "A";
                }
                ?></td>
              <td valign="middle"><?php echo $rownilai->pengetahuan; ?></td>
            </tr>
            <!-- Cek Apakah ada sub Mapel -->
            <?php
            //perulangan nilai;;;
            //Untuk penomoran sub mapel, memanfaatkan pengkodean ASSCI (Karakter ASCII Huruf) <---
            $s = 'a';
            foreach ($nilai_rapor->result() as $subrownilai) {
              ?>
                <tr>
                  <td align="center" valign="middle"></td>
                  <td align="left" valign="middle"><?php echo "$s. " . ucwords($subrownilai->nama_pelajaran); ?></td>
                  <?php $s = chr(ord($s) + 1); //Kode ASCII huruf<<--
                  ?>
                  <td align="center" valign="middle"><?php echo $subrownilai->nilai_pengetahuan; ?></td>
                  <td align="center" valign="middle">
                    <?php if ($subrownilai->nilai_pengetahuan < 73) {
                      echo "D";
                    } elseif ($subrownilai->nilai_pengetahuan >= 73 && $subrownilai->nilai_pengetahuan <= 81) {
                      echo "C";
                    } elseif ($subrownilai->nilai_pengetahuan >= 82 && $subrownilai->nilai_pengetahuan <= 90) {
                      echo "B";
                    } elseif ($subrownilai->nilai_pengetahuan >= 91 && $subrownilai->nilai_pengetahuan <= 100) {
                      echo "A";
                    }
                    ?></td>
                  <td valign="middle"><?php echo $subrownilai->pengetahuan; ?></td>
                </tr>
      <?php
            }
        }
      }
      //$noA = $no++;
      ?>
      <tr>
        <td colspan="5" align="left" valign="middle"><b>Kelompok B (WAJIB)</b></td>
      </tr>
      <?php
      $noB = 1;
      foreach ($nilai_rapor->result() as $rownilai) {
        if ($rownilai->id_kat_mapel == 2) {
          if ($rownilai->sub_mapel == 0) {
      ?>
            <!-- Cek Apakah ini Mapel Utama?? -->
            <tr>
              <td align="center" valign="middle"><?php echo $noB++; ?></td>
              <td align="left" valign="middle"><?php echo ucwords($rownilai->nama_pelajaran); ?></td>
              <td align="center" valign="middle"><?php echo $rownilai->nilai_pengetahuan; ?></td>
              <td align="center" valign="middle">
                <?php if ($rownilai->nilai_pengetahuan < 73) {
                  echo "D";
                } elseif ($rownilai->nilai_pengetahuan >= 73 && $rownilai->nilai_pengetahuan <= 81) {
                  echo "C";
                } elseif ($rownilai->nilai_pengetahuan >= 82 && $rownilai->nilai_pengetahuan <= 90) {
                  echo "B";
                } elseif ($rownilai->nilai_pengetahuan >= 91 && $rownilai->nilai_pengetahuan <= 100) {
                  echo "A";
                }
                ?></td>
              <td valign="middle"><?php echo $rownilai->pengetahuan; ?></td>
            </tr>
            <!-- Cek Apakah ada sub Mapel -->
            <?php
            //perulangan nilai;;;
            //Untuk penomoran sub mapel, memanfaatkan pengkodean ASSCI (Karakter ASCII Huruf) <---
            $s2 = 'a';
            foreach ($nilai_rapor->result() as $subrownilai) {
              if ($subrownilai->sub_mapel == $rownilai->id_pelajaran) { ?>
                <tr>
                  <td align="center" valign="middle"></td>
                  <td align="left" valign="middle"><?php echo "$s2. " . ucwords($subrownilai->nama_pelajaran); ?></td>
                  <?php $s2 = chr(ord($s2) + 1); //Kode ASCII huruf<<--
                  ?>
                  <td align="center" valign="middle"><?php echo $subrownilai->nilai_pengetahuan; ?></td>
                  <td align="center" valign="middle">
                    <?php if ($subrownilai->nilai_pengetahuan < 73) {
                      echo "D";
                    } elseif ($subrownilai->nilai_pengetahuan >= 73 && $subrownilai->nilai_pengetahuan <= 81) {
                      echo "C";
                    } elseif ($subrownilai->nilai_pengetahuan >= 82 && $subrownilai->nilai_pengetahuan <= 90) {
                      echo "B";
                    } elseif ($subrownilai->nilai_pengetahuan >= 91 && $subrownilai->nilai_pengetahuan <= 100) {
                      echo "A";
                    }
                    ?></td>
                  <td valign="middle"><?php echo $subrownilai->pengetahuan; ?></td>
                </tr>
      <?php
              }
            }
          }
        }
      }
      //$noA = $no++;
      ?>
      <tr>
        <td colspan="5" align="left" valign="middle"><b>Kelompok C (PEMINATAN)</b></td>
      </tr>
      <?php
      $noC = 1;
      foreach ($nilai_rapor->result() as $rownilai) {
        if ($rownilai->id_kat_mapel == 3) {
      ?>
            <!-- Cek Apakah ini Mapel Utama?? -->
            <tr>
              <td align="center" valign="middle"><?php echo $noC++; ?></td>
              <td align="left" valign="middle"><?php echo ucwords($rownilai->nama_pelajaran); ?></td>
              <td align="center" valign="middle"><?php echo $rownilai->nilai_pengetahuan; ?></td>
              <td align="center" valign="middle">
                <?php if ($rownilai->nilai_pengetahuan < 73) {
                  echo "D";
                } elseif ($rownilai->nilai_pengetahuan >= 73 && $rownilai->nilai_pengetahuan <= 81) {
                  echo "C";
                } elseif ($rownilai->nilai_pengetahuan >= 82 && $rownilai->nilai_pengetahuan <= 90) {
                  echo "B";
                } elseif ($rownilai->nilai_pengetahuan >= 91 && $rownilai->nilai_pengetahuan <= 100) {
                  echo "A";
                }
                ?></td>
              <td valign="middle"><?php echo $rownilai->pengetahuan; ?></td>
            </tr>
            <!-- Cek Apakah ada sub Mapel -->
            <?php
            //perulangan nilai;;;
            //Untuk penomoran sub mapel, memanfaatkan pengkodean ASSCI (Karakter ASCII Huruf) <---
            $s3 = 'a';
            foreach ($nilai_rapor->result() as $subrownilai) {
             ?>
                <tr>
                  <td align="center" valign="middle"></td>
                  <td align="left" valign="middle"><?php echo "$s3. " . ucwords($subrownilai->nama_pelajaran); ?></td>
                  <?php $s3 = chr(ord($s3) + 1); //Kode ASCII huruf<<--
                  ?>
                  <td align="center" valign="middle"><?php echo $subrownilai->nilai_pengetahuan; ?></td>
                  <td align="center" valign="middle">
                    <?php if ($subrownilai->nilai_pengetahuan < 73) {
                      echo "D";
                    } elseif ($subrownilai->nilai_pengetahuan >= 73 && $subrownilai->nilai_pengetahuan <= 81) {
                      echo "C";
                    } elseif ($subrownilai->nilai_pengetahuan >= 82 && $subrownilai->nilai_pengetahuan <= 90) {
                      echo "B";
                    } elseif ($subrownilai->nilai_pengetahuan >= 91 && $subrownilai->nilai_pengetahuan <= 100) {
                      echo "A";
                    }
                    ?></td>
                  <td valign="middle"><?php echo $subrownilai->pengetahuan; ?></td>
                </tr>
      <?php
          }
        }
      }
      //$noA = $no++;
      ?>
      <tr>
        <td colspan="5" align="left" valign="middle"><b>LINTAS KELOMPOK PEMINATAN</b></td>
      </tr>
      <?php
      $noD = 1;
      foreach ($nilai_rapor->result() as $rownilai) {
        if ($rownilai->id_kat_mapel == 4) {
          if ($rownilai->sub_mapel == 0) {
      ?>
            <!-- Cek Apakah ini Mapel Utama?? -->
            <tr>
              <td align="center" valign="middle"><?php echo $noD++; ?></td>
              <td align="left" valign="middle"><?php echo ucwords($rownilai->nama_pelajaran); ?></td>
              <td align="center" valign="middle"><?php echo $rownilai->nilai_pengetahuan; ?></td>
              <td align="center" valign="middle">
                <?php if ($rownilai->nilai_pengetahuan < 73) {
                  echo "D";
                } elseif ($rownilai->nilai_pengetahuan >= 73 && $rownilai->nilai_pengetahuan <= 81) {
                  echo "C";
                } elseif ($rownilai->nilai_pengetahuan >= 82 && $rownilai->nilai_pengetahuan <= 90) {
                  echo "B";
                } elseif ($rownilai->nilai_pengetahuan >= 91 && $rownilai->nilai_pengetahuan <= 100) {
                  echo "A";
                }
                ?></td>
              <td valign="middle"><?php echo $rownilai->pengetahuan; ?></td>
            </tr>
            <!-- Cek Apakah ada sub Mapel -->
            <?php
            //perulangan nilai;;;
            //Untuk penomoran sub mapel, memanfaatkan pengkodean ASSCI (Karakter ASCII Huruf) <---
            $s4 = 'a';
            foreach ($nilai_rapor->result() as $subrownilai) {
              if ($subrownilai->sub_mapel == $rownilai->id_pelajaran) { ?>
                <tr>
                  <td align="center" valign="middle"></td>
                  <td align="left" valign="middle"><?php echo "$s4. " . ucwords($subrownilai->nama_pelajaran); ?></td>
                  <?php $s4 = chr(ord($s4) + 1); //Kode ASCII huruf<<--
                  ?>
                  <td align="center" valign="middle"><?php echo $subrownilai->nilai_pengetahuan; ?></td>
                  <td align="center" valign="middle">
                    <?php if ($subrownilai->nilai_pengetahuan < 73) {
                      echo "D";
                    } elseif ($subrownilai->nilai_pengetahuan >= 73 && $subrownilai->nilai_pengetahuan <= 81) {
                      echo "C";
                    } elseif ($subrownilai->nilai_pengetahuan >= 82 && $subrownilai->nilai_pengetahuan <= 90) {
                      echo "B";
                    } elseif ($subrownilai->nilai_pengetahuan >= 91 && $subrownilai->nilai_pengetahuan <= 100) {
                      echo "A";
                    }
                    ?></td>
                  <td valign="middle"><?php echo $subrownilai->pengetahuan; ?></td>
                </tr>
      <?php
              }
            }
          }
        }
      }
      //$noA = $no++;
      ?>
    </tbody>
  </table>
  <br>
  <div class="page-break"></div>
  <br>
  <b>C. Ketrampilan</b><br><br>
  Kriteria Ketuntasan Minimal : 73
  <br>
  <table width="100%" cellspacing="0" cellpadding="2" border="1">
    <tbody>
      <tr>
        <td align="center" valign="middle" width="5px"><b>No</b></td>
        <td align="center" valign="middle" width="300px"><b>Mata Pelajaran</b></td>
        <td align="center" valign="middle" width="30px"><b>Nilai</b></td>
        <td align="center" valign="middle" width="30px"><b>Predikat</b></td>
        <td align="center" valign="middle" width="300px"><b>Deskripsi</b></td>
      </tr>
      <tr>
        <td colspan="5" align="left" valign="middle"><b>Kelompok A (WAJIB)</b></td>
      </tr>
      <?php
      $noE = 1;
      foreach ($nilai_rapor->result() as $rownilai) {
        if ($rownilai->id_kat_mapel == 1) {
      ?>
            <!-- Cek Apakah ini Mapel Utama?? -->
            <tr>
              <td align="center" valign="middle"><?php echo $noE++; ?></td>
              <td align="left" valign="middle"><?php echo ucwords($rownilai->nama_pelajaran); ?></td>
              <td align="center" valign="middle"><?php echo $rownilai->nilai_ketrampilan; ?></td>
              <td align="center" valign="middle">
                <?php if ($rownilai->nilai_ketrampilan < 73) {
                  echo "D";
                } elseif ($rownilai->nilai_ketrampilan >= 73 && $rownilai->nilai_ketrampilan <= 81) {
                  echo "C";
                } elseif ($rownilai->nilai_ketrampilan >= 82 && $rownilai->nilai_ketrampilan <= 90) {
                  echo "B";
                } elseif ($rownilai->nilai_ketrampilan >= 91 && $rownilai->nilai_ketrampilan <= 100) {
                  echo "A";
                }
                ?></td>
              <td valign="middle"><?php echo $rownilai->ketrampilan; ?></td>
            </tr>
            <!-- Cek Apakah ada sub Mapel -->
            <?php
            //perulangan nilai;;;
            //Untuk penomoran sub mapel, memanfaatkan pengkodean ASSCI (Karakter ASCII Huruf) <---
            $s11 = 'a';
            foreach ($nilai_rapor->result() as $subrownilai) {
             ?>
                <tr>
                  <td align="center" valign="middle"></td>
                  <td align="left" valign="middle"><?php echo "$s11. " . ucwords($subrownilai->nama_pelajaran); ?></td>
                  <?php $s11 = chr(ord($s11) + 1); //Kode ASCII huruf<<--
                  ?>
                  <td align="center" valign="middle"><?php echo $subrownilai->nilai_ketrampilan; ?></td>
                  <td align="center" valign="middle">
                    <?php if ($subrownilai->nilai_ketrampilan < 73) {
                      echo "D";
                    } elseif ($subrownilai->nilai_ketrampilan >= 73 && $subrownilai->nilai_ketrampilan <= 81) {
                      echo "C";
                    } elseif ($subrownilai->nilai_ketrampilan >= 82 && $subrownilai->nilai_ketrampilan <= 90) {
                      echo "B";
                    } elseif ($subrownilai->nilai_ketrampilan >= 91 && $subrownilai->nilai_ketrampilan <= 100) {
                      echo "A";
                    }
                    ?></td>
                  <td valign="middle"><?php echo $subrownilai->ketrampilan; ?></td>
                </tr>
      <?php
            }
        }
      }
      //$noA = $no++;
      ?>
      <tr>
        <td colspan="5" align="left" valign="middle"><b>Kelompok B (WAJIB)</b></td>
      </tr>
      <?php
      $noF = 1;
      foreach ($nilai_rapor->result() as $rownilai) {
        if ($rownilai->id_kat_mapel == 2) {
          if ($rownilai->sub_mapel == 0) {
      ?>
            <!-- Cek Apakah ini Mapel Utama?? -->
            <tr>
              <td align="center" valign="middle"><?php echo $noF++; ?></td>
              <td align="left" valign="middle"><?php echo ucwords($rownilai->nama_pelajaran); ?></td>
              <td align="center" valign="middle"><?php echo $rownilai->nilai_ketrampilan; ?></td>
              <td align="center" valign="middle">
                <?php if ($rownilai->nilai_ketrampilan < 73) {
                  echo "D";
                } elseif ($rownilai->nilai_ketrampilan >= 73 && $rownilai->nilai_ketrampilan <= 81) {
                  echo "C";
                } elseif ($rownilai->nilai_ketrampilan >= 82 && $rownilai->nilai_ketrampilan <= 90) {
                  echo "B";
                } elseif ($rownilai->nilai_ketrampilan >= 91 && $rownilai->nilai_ketrampilan <= 100) {
                  echo "A";
                }
                ?></td>
              <td valign="middle"><?php echo $rownilai->ketrampilan; ?></td>
            </tr>
            <!-- Cek Apakah ada sub Mapel -->
            <?php
            //perulangan nilai;;;
            //Untuk penomoran sub mapel, memanfaatkan pengkodean ASSCI (Karakter ASCII Huruf) <---
            $s12 = 'a';
            foreach ($nilai_rapor->result() as $subrownilai) {
              if ($subrownilai->sub_mapel == $rownilai->id_pelajaran) { ?>
                <tr>
                  <td align="center" valign="middle"></td>
                  <td align="left" valign="middle"><?php echo "$s12. " . ucwords($subrownilai->nama_pelajaran); ?></td>
                  <?php $s12 = chr(ord($s12) + 1); //Kode ASCII huruf<<--
                  ?>
                  <td align="center" valign="middle"><?php echo $subrownilai->nilai_ketrampilan; ?></td>
                  <td align="center" valign="middle">
                    <?php if ($subrownilai->nilai_ketrampilan < 73) {
                      echo "D";
                    } elseif ($subrownilai->nilai_ketrampilan >= 73 && $subrownilai->nilai_ketrampilan <= 81) {
                      echo "C";
                    } elseif ($subrownilai->nilai_ketrampilan >= 82 && $subrownilai->nilai_ketrampilan <= 90) {
                      echo "B";
                    } elseif ($subrownilai->nilai_ketrampilan >= 91 && $subrownilai->nilai_ketrampilan <= 100) {
                      echo "A";
                    }
                    ?></td>
                  <td valign="middle"><?php echo $subrownilai->ketrampilan; ?></td>
                </tr>
      <?php
              }
            }
          }
        }
      }
      //$noA = $no++;
      ?>
      <tr>
        <td colspan="5" align="left" valign="middle"><b>Kelompok C (Peminatan)</b></td>
      </tr>
      <?php
      $noG = 1;
      foreach ($nilai_rapor->result() as $rownilai) {
        if ($rownilai->id_kat_mapel == 3) {
      ?>
            <!-- Cek Apakah ini Mapel Utama?? -->
            <tr>
              <td align="center" valign="middle"><?php echo $noG++; ?></td>
              <td align="left" valign="middle"><?php echo ucwords($rownilai->nama_pelajaran); ?></td>
              <td align="center" valign="middle"><?php echo $rownilai->nilai_ketrampilan; ?></td>
              <td align="center" valign="middle">
                <?php if ($rownilai->nilai_ketrampilan < 73) {
                  echo "D";
                } elseif ($rownilai->nilai_ketrampilan >= 73 && $rownilai->nilai_ketrampilan <= 81) {
                  echo "C";
                } elseif ($rownilai->nilai_ketrampilan >= 82 && $rownilai->nilai_ketrampilan <= 90) {
                  echo "B";
                } elseif ($rownilai->nilai_ketrampilan >= 91 && $rownilai->nilai_ketrampilan <= 100) {
                  echo "A";
                }
                ?></td>
              <td valign="middle"><?php echo $rownilai->ketrampilan; ?></td>
            </tr>
            <!-- Cek Apakah ada sub Mapel -->
            <?php
            //perulangan nilai;;;
            //Untuk penomoran sub mapel, memanfaatkan pengkodean ASSCI (Karakter ASCII Huruf) <---
            $s13 = 'a';
            foreach ($nilai_rapor->result() as $subrownilai) {
              ?>
                <tr>
                  <td align="center" valign="middle"></td>
                  <td align="left" valign="middle"><?php echo "$s13. " . ucwords($subrownilai->nama_pelajaran); ?></td>
                  <?php $s13 = chr(ord($s13) + 1); //Kode ASCII huruf<<--
                  ?>
                  <td align="center" valign="middle"><?php echo $subrownilai->nilai_ketrampilan; ?></td>
                  <td align="center" valign="middle">
                    <?php if ($subrownilai->nilai_ketrampilan < 73) {
                      echo "D";
                    } elseif ($subrownilai->nilai_ketrampilan >= 73 && $subrownilai->nilai_ketrampilan <= 81) {
                      echo "C";
                    } elseif ($subrownilai->nilai_ketrampilan >= 82 && $subrownilai->nilai_ketrampilan <= 90) {
                      echo "B";
                    } elseif ($subrownilai->nilai_ketrampilan >= 91 && $subrownilai->nilai_ketrampilan <= 100) {
                      echo "A";
                    }
                    ?></td>
                  <td valign="middle"><?php echo $subrownilai->ketrampilan; ?></td>
                </tr>
      <?php
            }
        }
      }
      //$noA = $no++;
      ?>
      <tr>
        <td colspan="5" align="left" valign="middle"><b>LINTAS KELOMPOK PEMINATAN</b></td>
      </tr>
      <?php
      $noH = 1;
      foreach ($nilai_rapor->result() as $rownilai) {
        if ($rownilai->id_kat_mapel == 3) {
      ?>
            <!-- Cek Apakah ini Mapel Utama?? -->
            <tr>
              <td align="center" valign="middle"><?php echo $noH++; ?></td>
              <td align="left" valign="middle"><?php echo ucwords($rownilai->nama_pelajaran); ?></td>
              <td align="center" valign="middle"><?php echo $rownilai->nilai_ketrampilan; ?></td>
              <td align="center" valign="middle">
                <?php if ($rownilai->nilai_ketrampilan < 73) {
                  echo "D";
                } elseif ($rownilai->nilai_ketrampilan >= 73 && $rownilai->nilai_ketrampilan <= 81) {
                  echo "C";
                } elseif ($rownilai->nilai_ketrampilan >= 82 && $rownilai->nilai_ketrampilan <= 90) {
                  echo "B";
                } elseif ($rownilai->nilai_ketrampilan >= 91 && $rownilai->nilai_ketrampilan <= 100) {
                  echo "A";
                }
                ?></td>
              <td valign="middle"><?php echo $rownilai->ketrampilan; ?></td>
            </tr>
            <!-- Cek Apakah ada sub Mapel -->
            <?php
            //perulangan nilai;;;
            //Untuk penomoran sub mapel, memanfaatkan pengkodean ASSCI (Karakter ASCII Huruf) <---
            $s14 = 'a';
            foreach ($nilai_rapor->result() as $subrownilai) {
             ?>
                <tr>
                  <td align="center" valign="middle"></td>
                  <td align="left" valign="middle"><?php echo "$s14. " . ucwords($subrownilai->nama_pelajaran); ?></td>
                  <?php $s14 = chr(ord($s14) + 1); //Kode ASCII huruf<<--
                  ?>
                  <td align="center" valign="middle"><?php echo $subrownilai->nilai_ketrampilan; ?></td>
                  <td align="center" valign="middle">
                    <?php if ($subrownilai->nilai_ketrampilan < 73) {
                      echo "D";
                    } elseif ($subrownilai->nilai_ketrampilan >= 73 && $subrownilai->nilai_ketrampilan <= 81) {
                      echo "C";
                    } elseif ($subrownilai->nilai_ketrampilan >= 82 && $subrownilai->nilai_ketrampilan <= 90) {
                      echo "B";
                    } elseif ($subrownilai->nilai_ketrampilan >= 91 && $subrownilai->nilai_ketrampilan <= 100) {
                      echo "A";
                    }
                    ?></td>
                  <td valign="middle"><?php echo $subrownilai->ketrampilan; ?></td>
                </tr>
      <?php
            }
        }
      }
      //$noA = $no++;
      ?>
    </tbody>
  </table>
  <br>
  <b>Tabel interval predikat berdasarkan KKM</b><br>
  <table width="100%" cellspacing="0" cellpadding="2" border="1">
    <tbody>
      <tr>
        <td rowspan="2" align="center"><b>KKM</b></td>
        <td colspan="4" align="center"><b>Predikat</b></td>
      </tr>
      <tr>
        <td align="center"><b>D = Kurang</b></td>
        <td align="center"><b>C = Cukup</b></td>
        <td align="center"><b>B = Baik</b></td>
        <td align="center"><b>A = Sangat Baik</b></td>
      </tr>
      <tr>
        <td align="center">73</td>
        <td align="center">
          < 73</td>
        <td align="center">73 <= C <=81 </td>
        <td align="center">82 <= B <=90 </td>
        <td align="center"> 91 <= A <=100 </td>
      </tr>
    </tbody>
  </table>
  <div class="page-break"></div>
  <br>
  <b>D. Ekstra Kurikuler</b><br>
  <table width="100%" cellspacing="0" cellpadding="2" border="1">
    <tbody>
      <tr>
        <td width="20px" align="center"><b>No.</b></td>
        <td width="250px" align="center"><b>Kegiatan Ekstra Kurikuler</b></td>
        <td width="50px" align="center"><b>Nilai</b></td>
        <td width="400px" align="center"><b>Deskripsi</b></td>
      </tr>
      <?php
      if ($nilai_ekstra->num_rows() > 0) {
        $iek = 1;
        foreach ($nilai_ekstra->result() as $rowek) { ?>
          <tr>
            <td><?php echo $iek++; ?></td>
            <td><?php echo strip_tags($rowek->nama_ekstra); ?></td>
            <?php
            //mendapatkan nilai ekstra:
            $idekstra = $this->db->escape($rowek->id_ekstra);
            $nis = $this->db->escape($siswa['nis']);
            $idkelas = $this->db->escape($kelas->id_kelas);
            $idtahun = $this->db->escape($tahun_ajaran->id_tahun);
            $idsms = $this->db->escape($semester->id_semester);
            $data_ekstra = $this->db->query("SELECT nilai,deskripsi FROM tbl_nilai_ekstra WHERE id_ekstra=$idekstra AND nis=$nis AND id_kelas=$idkelas AND id_tahun=$idtahun AND id_semester=$idsms");
            $cek_ekstra = $data_ekstra->num_rows();
            $ekstra = $data_ekstra->row();
            ?>
            <td align="center">
              <?php if ($cek_ekstra > 0 && $ekstra->nilai != "") {
                echo strip_tags(strtoupper($ekstra->nilai));
              } else {
                echo "-";
              }
              ?>
            </td>
            <td>
              <?php if ($cek_ekstra > 0 && $ekstra->deskripsi != "") {
                echo strip_tags($ekstra->deskripsi);
              } else {
                echo "-";
              }
              ?></td>
          </tr>
      <?php
        }
      } else {
        echo "<tr><td align='center'>1</td><td></td><td></td><td></td></tr>";
      } ?>
    </tbody>
  </table>
  <br>
  <b>E. Prestasi</b><br>
  <table width="100%" cellspacing="0" cellpadding="2" border="1">
    <tbody>
      <tr>
        <td width="20px" align="center"><b>No.</b></td>
        <td align="center" width="250px"><b>Jenis Kegiatan</b></td>
        <td align="center"><b>Keterangan</b></td>
      </tr>
      <?php
      if ($nilai_prestasi->num_rows() > 0) {
        $ipr = 1;
        foreach ($nilai_prestasi->result() as $rowpr) { ?>
          <tr>
            <td><?php echo $ipr++; ?></td>
            <td width="250px"><?php echo strip_tags($rowpr->jenis_kegiatan); ?></td>
            <td><?php echo strip_tags($rowpr->keterangan); ?></td>
          </tr>
      <?php
        }
      } else {
        echo "<tr><td>1</td><td width='250px' align='center'>-</td><td align='center'>-</td></tr>";
        echo "<tr><td>2</td><td width='250px' align='center'>-</td><td align='center'>-</td></tr>";
        echo "<tr><td>3</td><td width='250px' align='center'>-</td><td align='center'>-</td></tr>";
      }
      ?>
    </tbody>
  </table>
  <br>
  <b>F. Ketidakhadiran</b><br>
  <table width="" cellspacing="0" cellpadding="2" border="1">
    <tbody>
      <tr>
        <td width="170px">Sakit</td>
        <td width="200px">:
          <?php if ($kehadiran->row('sakit') != '') {
            echo strip_tags($kehadiran->row('sakit'));
          } else {
            echo "-";
          } ?> hari</td>
      </tr>
      <tr>
        <td>Ijin</td>
        <td>:
          <?php if ($kehadiran->row('izin') != '') {
            echo strip_tags($kehadiran->row('izin'));
          } else {
            echo "-";
          } ?> hari</td>
      </tr>
      <tr>
        <td>Tanpa Keterangan</td>
        <td>:
          <?php if ($kehadiran->row('tnp_ket') != '') {
            echo strip_tags($kehadiran->row('tnp_ket'));
          } else {
            echo "-";
          } ?> hari</td>
      </tr>
    </tbody>
  </table>
  <br>
  <b>G. Tinggi dan Berat</b><br>
  <table width="" cellspacing="0" cellpadding="2" border="1">
    <tbody>
      <tr>
        <td width="170px">Berat</td>
        <td width="200px">Tinggi</td>
      </tr>
      <tr>
        <td><?= $tinggi_berat['berat_badan'] ."cm"?></td>
        <td><?= $tinggi_berat['tinggi_badan'] ."kg"?></td>
      </tr>
    </tbody>
  </table>
  <br>
  <b>H. Catatan Wali Kelas</b><br>
  <table width="100%" cellspacing="0" cellpadding="2" border="1">
    <tbody>
      <tr>
        <td><br><?php echo strip_tags($catatan_wk->row('catatanwk')); ?><br>&nbsp;<br></td>
      </tr>
    </tbody>
  </table>
  <br>
  <b>I. Tanggapan Orang Tua/Wali</b><br>
  <table width="100%" cellspacing="0" cellpadding="2" border="1">
    <tbody>
      <tr>
        <td><br>&nbsp;<br>&nbsp;<br></td>
      </tr>
    </tbody>
  </table>
  <br>
  <table width="100%" cellspacing="0" cellpadding="2" border="1">
    <tbody>
      <tr>
        <td><br><b>Keterangan Kenaikan Kelas</b> : Naik/Tidak Naik *) ke kelas X/XI *)<br>&nbsp;<br></td>
      </tr>
    </tbody>
  </table>
</body>
</html>
    </div>
    </div>
    <hr>
</div>