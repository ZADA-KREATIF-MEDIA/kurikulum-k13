<?php

$predikat_spiritual = strip_tags(strtoupper($nilai_sikap2->row('predikat_spiritual')));
$sikap_spiritual = strip_tags($nilai_sikap2->row('sikap_spiritual'));
$predikat_sosial = strip_tags(strtoupper($nilai_sikap2->row('predikat_sosial')));
$sikap_sosial = strip_tags($nilai_sikap2->row('sikap_sosial'));

?>


    
  <center><b>CAPAIAN HASIL BELAJAR</b></center>
 <b>A. Sikap</b><br><br>
 <b>1. Sikap Spiritual</b><br>
  <table class="table table-condensed table-bordered">
  <tr>
    <td align="center" width="100px"><b>Predikat</b></td><td align="center"><b>Deskripsi</b></td>
  </tr>
  <tr>
    <td align="center">&nbsp;<?php echo $predikat_spiritual;?></td><td><?php echo $sikap_spiritual;?></td>
  </tr>
</table>
<br>
<b>2. Sikap Sosial</b><br>
  <table class="table table-condensed table-bordered">
  
  <tr>
    <td align="center" width="100px"><b>Predikat</b></td><td align="center"><b>Deskripsi</b></td>
  </tr>
  <tr>
    <td align="center"><?php echo $predikat_sosial;?></td><td><?php echo $sikap_sosial;?></td>
  </tr>
</table>

<div class="page-break"></div>

   
 <b>B. Pengetahuan dan Ketrampilan</b><br><br>
  <table class="table table-condensed table-bordered">
  <tbody>
    <tr>
      
      <td rowspan="2" align="center" valign="middle" width="5px"><b>No</b></td>
      <td rowspan="2" align="center" valign="middle" width="300px"><b>Mata Pelajaran</b></td>
      <td rowspan="2" align="center" valign="middle" width="30px"><b>KKM</b></td>
      <td colspan="2" align="center" valign="middle" width="180px"><b>Pengetahuan</b></td>
      <td colspan="2" align="center" valign="middle" width="180px"><b>Ketrampilan</b></td>
    </tr>
      <tr>
      <td align="center" valign="middle" width="90px"><b>Nilai</b></td>
      <td align="center" valign="middle" width="90px"><b>Predikat</b></td>
      <td align="center" valign="middle" width="90px"><b>Nilai</b></td>
      <td align="center" valign="middle" width="90px"><b>Predikat</b></td>
    </tr>
    <tr>
      <td colspan="7" align="left" valign="middle"><b>Kelompok A (WAJIB)</b></td>
    </tr>
    <?php 
    
    $no=1;
    foreach($nilai_rapor2->result() as $rownilai){
      if($rownilai->id_kat_mapel==1){
    ?>

    <tr>
      <td align="center" valign="middle"><?php echo $no++;?></td>
      <td align="left" valign="middle"><?php echo ucwords($rownilai->nama_pelajaran);?></td>
      <td align="center" valign="middle"><?php echo $rownilai->kkm;?></td>
      <td align="center" valign="middle"><?php echo $rownilai->nilai_pengetahuan;?></td>
      <td align="center" valign="middle">
        <?php if($rownilai->nilai_pengetahuan<71){echo "D";}
        elseif($rownilai->nilai_pengetahuan>=71&&$rownilai->nilai_pengetahuan<80){echo "C";}
        elseif($rownilai->nilai_pengetahuan>=80&&$rownilai->nilai_pengetahuan<91){echo "B";}
        elseif($rownilai->nilai_pengetahuan>=91&&$rownilai->nilai_pengetahuan<=100){echo "A";}
        ?></td>
      <td align="center" valign="middle"><?php echo $rownilai->nilai_ketrampilan;?></td>
      <td align="center" valign="middle">
        <?php if($rownilai->nilai_ketrampilan<71){echo "D";}
        elseif($rownilai->nilai_ketrampilan>=71&&$rownilai->nilai_ketrampilan<80){echo "C";}
        elseif($rownilai->nilai_ketrampilan>=80&&$rownilai->nilai_ketrampilan<91){echo "B";}
        elseif($rownilai->nilai_ketrampilan>=91&&$rownilai->nilai_ketrampilan<=100){echo "A";}
        ?></td>
    </tr>
  <?php }
  
  }
  $noA = $no++;
  ?>

  <tr>
      <td colspan="7" align="left" valign="middle"><b>Kelompok B (WAJIB)</b></td>
    </tr>
    <?php 
    
    $nob=$noA;
    foreach($nilai_rapor2->result() as $rownilai){
      if($rownilai->id_kat_mapel==2){
    ?>

    <tr>
      <td align="center" valign="middle"><?php echo $nob++;?></td>
      <td align="left" valign="middle"><?php echo ucwords($rownilai->nama_pelajaran);?></td>
      <td align="center" valign="middle"><?php echo $rownilai->kkm;?></td>
      <td align="center" valign="middle"><?php echo $rownilai->nilai_pengetahuan;?></td>
      <td align="center" valign="middle">
        <?php if($rownilai->nilai_pengetahuan<71){echo "D";}
        elseif($rownilai->nilai_pengetahuan>=71&&$rownilai->nilai_pengetahuan<80){echo "C";}
        elseif($rownilai->nilai_pengetahuan>=80&&$rownilai->nilai_pengetahuan<91){echo "B";}
        elseif($rownilai->nilai_pengetahuan>=91&&$rownilai->nilai_pengetahuan<=100){echo "A";}
        ?></td>
      <td align="center" valign="middle"><?php echo $rownilai->nilai_ketrampilan;?></td>
      <td align="center" valign="middle">
        <?php if($rownilai->nilai_ketrampilan<71){echo "D";}
        elseif($rownilai->nilai_ketrampilan>=71&&$rownilai->nilai_ketrampilan<80){echo "C";}
        elseif($rownilai->nilai_ketrampilan>=80&&$rownilai->nilai_ketrampilan<91){echo "B";}
        elseif($rownilai->nilai_ketrampilan>=91&&$rownilai->nilai_ketrampilan<=100){echo "A";}
        ?></td>
    </tr>
  <?php }
  
  }
  $noB=$nob++;
  ?>

   <tr>
      <td colspan="7" align="left" valign="middle"><b>Kelompok C (PEMINATAN)</b></td>
    </tr>
    <?php 
    
    $noc=$noB;
    foreach($nilai_rapor2->result() as $rownilai){
      if($rownilai->id_kat_mapel==3){
    ?>

    <tr>
      <td align="center" valign="middle"><?php echo $noc++;?></td>
      <td align="left" valign="middle"><?php echo ucwords($rownilai->nama_pelajaran);?></td>
      <td align="center" valign="middle"><?php echo $rownilai->kkm;?></td>
      <td align="center" valign="middle"><?php echo $rownilai->nilai_pengetahuan;?></td>
      <td align="center" valign="middle">
        <?php if($rownilai->nilai_pengetahuan<71){echo "D";}
        elseif($rownilai->nilai_pengetahuan>=71&&$rownilai->nilai_pengetahuan<80){echo "C";}
        elseif($rownilai->nilai_pengetahuan>=80&&$rownilai->nilai_pengetahuan<91){echo "B";}
        elseif($rownilai->nilai_pengetahuan>=91&&$rownilai->nilai_pengetahuan<=100){echo "A";}
        ?></td>
      <td align="center" valign="middle"><?php echo $rownilai->nilai_ketrampilan;?></td>
      <td align="center" valign="middle">
        <?php if($rownilai->nilai_ketrampilan<71){echo "D";}
        elseif($rownilai->nilai_ketrampilan>=71&&$rownilai->nilai_ketrampilan<80){echo "C";}
        elseif($rownilai->nilai_ketrampilan>=80&&$rownilai->nilai_ketrampilan<91){echo "B";}
        elseif($rownilai->nilai_ketrampilan>=91&&$rownilai->nilai_ketrampilan<=100){echo "A";}
        ?></td>
    </tr>
  <?php }
  
  }
  $noC=$noc++;
  ?>

   <tr>
      <td colspan="7" align="left" valign="middle"><b>Kelompok D (LINTAS KELOMPOK PEMINATAN)</b></td>
    </tr>
    <?php 
    
    $nod=$noC;
    foreach($nilai_rapor2->result() as $rownilai){
      if($rownilai->id_kat_mapel==4){
    ?>

    <tr>
      <td align="center" valign="middle"><?php echo $nod++;?></td>
      <td align="left" valign="middle"><?php echo ucwords($rownilai->nama_pelajaran);?></td>
      <td align="center" valign="middle"><?php echo $rownilai->kkm;?></td>
      <td align="center" valign="middle"><?php echo $rownilai->nilai_pengetahuan;?></td>
      <td align="center" valign="middle">
        <?php if($rownilai->nilai_pengetahuan<71){echo "D";}
        elseif($rownilai->nilai_pengetahuan>=71&&$rownilai->nilai_pengetahuan<80){echo "C";}
        elseif($rownilai->nilai_pengetahuan>=80&&$rownilai->nilai_pengetahuan<91){echo "B";}
        elseif($rownilai->nilai_pengetahuan>=91&&$rownilai->nilai_pengetahuan<=100){echo "A";}
        ?></td>
      <td align="center" valign="middle"><?php echo $rownilai->nilai_ketrampilan;?></td>
      <td align="center" valign="middle">
        <?php if($rownilai->nilai_ketrampilan<71){echo "D";}
        elseif($rownilai->nilai_ketrampilan>=71&&$rownilai->nilai_ketrampilan<80){echo "C";}
        elseif($rownilai->nilai_ketrampilan>=80&&$rownilai->nilai_ketrampilan<91){echo "B";}
        elseif($rownilai->nilai_ketrampilan>=91&&$rownilai->nilai_ketrampilan<=100){echo "A";}
        ?></td>
    </tr>
  <?php }
  
  }
  $noD=$nod++;
  ?>

   <tr>
      <td colspan="7" align="left" valign="middle"><b>Kelompok E (MUATAN LOKAL)</b></td>
    </tr>
    <?php 
    
    $noe=$noD;
    foreach($nilai_rapor2->result() as $rownilai){
      if($rownilai->id_kat_mapel==5){
    ?>

    <tr>
      <td align="center" valign="middle"><?php echo $noe++;?></td>
      <td align="left" valign="middle"><?php echo ucwords($rownilai->nama_pelajaran);?></td>
      <td align="center" valign="middle"><?php echo $rownilai->kkm;?></td>
      <td align="center" valign="middle"><?php echo $rownilai->nilai_pengetahuan;?></td>
      <td align="center" valign="middle">
        <?php if($rownilai->nilai_pengetahuan<71){echo "D";}
        elseif($rownilai->nilai_pengetahuan>=71&&$rownilai->nilai_pengetahuan<80){echo "C";}
        elseif($rownilai->nilai_pengetahuan>=80&&$rownilai->nilai_pengetahuan<91){echo "B";}
        elseif($rownilai->nilai_pengetahuan>=91&&$rownilai->nilai_pengetahuan<=100){echo "A";}
        ?></td>
      <td align="center" valign="middle"><?php echo $rownilai->nilai_ketrampilan;?></td>
      <td align="center" valign="middle">
        <?php if($rownilai->nilai_ketrampilan<71){echo "D";}
        elseif($rownilai->nilai_ketrampilan>=71&&$rownilai->nilai_ketrampilan<80){echo "C";}
        elseif($rownilai->nilai_ketrampilan>=80&&$rownilai->nilai_ketrampilan<91){echo "B";}
        elseif($rownilai->nilai_ketrampilan>=91&&$rownilai->nilai_ketrampilan<=100){echo "A";}
        ?></td>
    </tr>
  <?php }
  }
  ?>

  </tbody>
</table>
<br>
<b>Tabel interval predikat berdasarkan KKM</b><br>
    <table class="table table-condensed table-bordered">
    <tbody>
      <tr>
        <td rowspan="2" align="center"><b>KKM</b></td>
        <td colspan="4" align="center"><b>Predikat</b></td>
      </tr>
      <tr>
        <td align="center"><b>D = Kurang</b></td><td align="center"><b>C = Cukup</b></td><td align="center"><b>B = Baik</b></td><td align="center"><b>A = Sangat Baik</b></td>
      </tr>
      <tr>
        <td align="center">71.00</td><td align="center">< 71</td><td align="center">71 <= n < 80 </td><td align="center">80 <= n < 91 </td><td align="center"> 91 <= n <= 100 </td>
      </tr>
    </tbody>
  </table>

<div class="page-break"></div>

    
 <b>Deskripsi Pengetahuan dan Ketrampilan</b><br><br>


  <table class="table table-condensed table-bordered">
  <tbody>
    <tr>
      <td width="20px"><b>No</b></td><td><b>Mata Pelajaran</b></td><td><b>Aspek</b></td><td><b>Deskripsi</b></td>
    </tr>
    <tr>
      <td colspan="4"><b>KELOMPOK A (WAJIB)</b></td>
    </tr>
    <?php 
      $iA = 1;
    foreach($deskripsi_nilai2->result() as $rowdes){
      if($rowdes->id_kat_mapel==1){
      ?>
    <tr>
      <td rowspan="2"><?php echo $iA++;?></td>
      <td rowspan="2"><?php echo strip_tags($rowdes->nama_pelajaran);?></td>
      <td>Pengetahuan</td>
      <td><?php echo strip_tags($rowdes->pengetahuan);?></td>
    </tr>
    <tr>
      <td>Ketrampilan</td>
      <td><?php echo strip_tags($rowdes->ketrampilan);?></td>
    </tr>
    <?php
    }
  }
  $iB=$iA++;
    ?>
    <tr>
      <td colspan="4"><b>KELOMPOK B (WAJIB)</b></td>
    </tr>
    <?php 
      
    foreach($deskripsi_nilai2->result() as $rowdes){
      if($rowdes->id_kat_mapel==2){
      ?>
    <tr>
      <td rowspan="2"><?php echo $iB++;?></td>
      <td rowspan="2"><?php echo strip_tags($rowdes->nama_pelajaran);?></td>
      <td>Pengetahuan</td>
      <td><?php echo strip_tags($rowdes->pengetahuan);?></td>
    </tr>
    <tr>
      <td>Ketrampilan</td>
      <td><?php echo strip_tags($rowdes->ketrampilan);?></td>
    </tr>
    <?php
    }
  }
  $iC=$iB++;
    ?>
    <tr>
      <td colspan="4"><b>KELOMPOK C (PEMINATAN)</b></td>
    </tr>
    <?php 
      
    foreach($deskripsi_nilai2->result() as $rowdes){
      if($rowdes->id_kat_mapel==3){
      ?>
    <tr>
      <td rowspan="2"><?php echo $iC++;?></td>
      <td rowspan="2"><?php echo strip_tags($rowdes->nama_pelajaran);?></td>
      <td>Pengetahuan</td>
      <td><?php echo strip_tags($rowdes->pengetahuan);?></td>
    </tr>
    <tr>
      <td>Ketrampilan</td>
      <td><?php echo strip_tags($rowdes->ketrampilan);?></td>
    </tr>
    <?php
    }
  }
  $iD=$iC++;
    ?>
    <tr>
      <td colspan="4"><b>KELOMPOK D (LINTAS KELOMPOK PEMINATAN)</b></td>
    </tr>
    <?php 
      
    foreach($deskripsi_nilai2->result() as $rowdes){
      if($rowdes->id_kat_mapel==4){
      ?>
    <tr>
      <td rowspan="2"><?php echo $iD++;?></td>
      <td rowspan="2"><?php echo strip_tags($rowdes->nama_pelajaran);?></td>
      <td>Pengetahuan</td>
      <td><?php echo strip_tags($rowdes->pengetahuan);?></td>
    </tr>
    <tr>
      <td>Ketrampilan</td>
      <td><?php echo strip_tags($rowdes->ketrampilan);?></td>
    </tr>
    <?php
    }
  }
  $iE=$iD++;
    ?>
    <tr>
      <td colspan="4"><b>KELOMOK E (MUATAN LOKAL)</b></td>
    </tr>
    <?php 
      
    foreach($deskripsi_nilai2->result() as $rowdes){
      if($rowdes->id_kat_mapel==5){
      ?>
    <tr>
      <td rowspan="2"><?php echo $iE++;?></td>
      <td rowspan="2"><?php echo strip_tags($rowdes->nama_pelajaran);?></td>
      <td>Pengetahuan</td>
      <td><?php echo strip_tags($rowdes->pengetahuan);?></td>
    </tr>
    <tr>
      <td>Ketrampilan</td>
      <td><?php echo strip_tags($rowdes->ketrampilan);?></td>
    </tr>
    <?php
    }
  }
    ?>
  </tbody>
</table>

<div class="page-break"></div>

     
 <b>C. Ekstra Kurikuler</b><br>

  <table class="table table-condensed table-bordered">
  <tbody>
    <tr>
      <td width="20px" align="center"><b>No.</b></td><td width="250px" align="center"><b>Kegiatan Ekstra Kurikuler</b></td><td width="50px" align="center"><b>Nilai</b></td><td width="400px" align="center"><b>Deskripsi</b></td>
    </tr>
    <?php
    if($nilai_ekstra2->num_rows()>0){
    $iek = 1;
    foreach($nilai_ekstra2->result() as $rowek){?>
    <tr>
      <td><?php echo $iek++;?></td>
      <td><?php echo strip_tags($rowek->nama_ekstra);?></td>
      <td align="center"><?php echo strip_tags(strtoupper($rowek->nilai));?></td>
      <td><?php echo strip_tags($rowek->deskripsi);?></td>
    </tr>
    <?php
   }
  }else{
    echo "<tr><td align='center'>1</td><td></td><td></td><td></td></tr>";
  }?>
  </tbody>
</table>
<br>
<b>D. Prestasi</b><br>
  <table class="table table-condensed table-bordered">
  <tbody>
    <tr>
      <td width="20px" align="center"><b>No.</b></td><td align="center" width="250px"><b>Jenis Kegiatan</b></td><td align="center"><b>Keterangan</b></td>
    </tr>
    <?php
    if($nilai_prestasi2->num_rows()>0){
    $ipr = 1;
    foreach($nilai_prestasi2->result() as $rowpr){?>
    <tr>
      <td><?php echo $ipr++;?></td>
      <td width="250px"><?php echo strip_tags($rowpr->jenis_kegiatan);?></td>
      <td><?php echo strip_tags($rowpr->keterangan);?></td>
    </tr>
    <?php
    }
  }else{
    echo "<tr><td>1</td><td width='250px'>&nbsp;</td><td></td></tr>";
  }

  ?>
  </tbody>
</table>

<br>

<b>Catatan Wali Kelas</b><br>
  <table class="table table-condensed table-bordered">
  <tbody>
    <tr>
      <td><?php echo strip_tags($catatan_wk2->row('catatanwk'));?><br><br></td>
    </tr>
  
  
  </tbody>
</table>

<br>
<?php /*
<b>H. Tanggapan Orang Tua/Wali</b><br>
  <table class="table table-condensed table-bordered">
  <tbody>
    <tr>
      <td><br>&nbsp;<br></td>
    </tr>  
  </tbody>
</table>
<br>
  <table class="table table-condensed table-bordered">
  <tbody>
    <tr>
      <td>Mengetahui:</td><td width="50%">&nbsp;</td><td><?php echo strip_tags($kepsek2->tgl_rapor);?></td>
    </tr>
    <tr>
      <td>Orang Tua/Wali</td><td>&nbsp;</td><td>Wali Kelas,</td>
    </tr>
     <tr>
      <td><br><br><br><br><br><br><br><br><br></td><td>&nbsp;</td><td><b><?php echo strip_tags($wali_kelas2->nama_guru);?></b><br>NBM. <?php echo strip_tags($wali_kelas2->nip);?></td>
    </tr>
   
    <tr>
      <td colspan="3" align="center">
        Mengetahui,<br>
        Kepala Sekolah
        <br><br><br><br><br><br>
        <b><?php echo $kepsek2->nama_guru;?></b><br>
        NIP <?php echo $kepsek2->nip;?>
      </td>
    </tr>
*/?>
  
  
  </tbody>
</table>
<div class="page-break"></div>
