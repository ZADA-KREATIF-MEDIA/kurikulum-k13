<html>
<head>

<title>Laporan Legger Semua Mapel</title>

</head>
<body>

<center> <font style="font-weight:bold; font-size:14pt; font-family:Geneva, Arial, Helvetica, sans-serif;">LAPORAN LEGGER SEMUA MAPEL</font><br>
<font style="font-weight:bold; font-size:16pt; font-family:Geneva, Arial, Helvetica, sans-serif;">
KELAS <?php echo $nama_kelas;?><br>
Semester <?php echo ucwords($pd_semester);?> TA <?php echo $pd_tahun;?>
</font></center>
<br><br>

<h3>Nilai Pengetahuan</h3>
          <div class="table-responsive">
        <table class="table table-bordered table-hover no-padding" >
          <thead>
                    <tr bgcolor=#fafafa>
            
          <th width="5%" align="center" rowspan="2">No </th>
          <th width="10%" align="center" rowspan="2">NIS</th>
          <th width="20%" align="center" rowspan="2">Nama Siswa</th>
          <?php $jml_mapel = $list_mapel->num_rows();?>
          <th width="10%" align="center" colspan="<?php echo $jml_mapel;?>">Mata Pelajaran</th>
          <th width="15%" align="center" rowspan="2">Jumlah</th>
          </tr>
          <tr>
            <?php foreach($list_mapel->result() as $mapel){?>
          <th width="10%" align="center"><?php echo $mapel->nama_pelajaran;?></th>
            <?php } ?>
          
          
          </tr>
         </thead>
        <tbody>
        <?php
        $no=1;
        foreach($list_siswa->result_array() as $row){
        ?>  
        <tr>
        
          <td align="center"><?php echo $no++;?></td>
          <td align="center"><?php echo $row['nis'];?></td>
          <td><?php echo $row['nama_siswa'];?></td>
          <?php foreach($list_mapel->result() as $mpl){
            //mendapatkan nilai berdasarkan id_pel
            $nilai_siswa = $this->m_guru->get_nilai_mapel_leg($row['nis'],$mpl->id_pelajaran,$post_idkelas,$post_idsemester,$post_idtahun)->row('nilai_pengetahuan');
              if($nilai_siswa!='' && $nilai_siswa!=0){
                echo "<td align='center'>$nilai_siswa</td>";
              }
              else
              {
               echo "<td align='center' bgcolor='yellow'>$nilai_siswa</td>"; 
              }
            }
            
          
          //jumlah nilai siswa
          $jml_nilai = $this->m_guru->get_jml_nilai_leg($row['nis'],$post_idkelas,$post_idsemester,$post_idtahun)->row('jumlah_nilai');
          echo "<td align='center' bgcolor='#fafafa'>$jml_nilai</td>";
          echo "</tr>";
        }

          ?>
         </tbody>
    </table>
   
        </div>

        <h3>Nilai Ketrampilan</h3>
          <div class="table-responsive">
        <table class="table table-bordered table-hover no-padding" >
          <thead>
                    <tr bgcolor=#fafafa>
            
          <th width="5%" align="center" rowspan="2">No </th>
          <th width="10%" align="center" rowspan="2">NIS</th>
          <th width="20%" align="center" rowspan="2">Nama Siswa</th>
          <?php $jml_mapel = $list_mapel->num_rows();?>
          <th width="10%" align="center" colspan="<?php echo $jml_mapel;?>">Mata Pelajaran</th>
          <th width="15%" align="center" rowspan="2">Jumlah</th>
          </tr>
          <tr>
            <?php foreach($list_mapel->result() as $mapel){?>
          <th width="10%" align="center"><?php echo $mapel->nama_pelajaran;?></th>
            <?php } ?>
          
          
          </tr>
         </thead>
        <tbody>
        <?php
        $no=1;
        foreach($list_siswa->result_array() as $row){
        ?>  
        <tr>
        
          <td align="center"><?php echo $no++;?></td>
          <td align="center"><?php echo $row['nis'];?></td>
          <td><?php echo $row['nama_siswa'];?></td>
          <?php foreach($list_mapel->result() as $mpl){
            //mendapatkan nilai berdasarkan id_pel
            $nilai_siswa2 = $this->m_guru->get_nilai_mapel2($row['nis'],$mpl->id_pelajaran,$post_idkelas,$post_idsemester,$post_idtahun)->row('nilai_ketrampilan');
              if($nilai_siswa2!='' && $nilai_siswa2!=0){
                echo "<td align='center'>$nilai_siswa2</td>";
              }
              else
              {
               echo "<td align='center' bgcolor='yellow'>$nilai_siswa2</td>"; 
              }
            }
            
          
          //jumlah nilai siswa
          $jml_nilai2 = $this->m_guru->get_jml_nilai2($row['nis'],$post_idkelas,$post_idsemester,$post_idtahun)->row('jumlah_nilai');
          echo "<td align='center' bgcolor='#fafafa'>$jml_nilai2</td>";
          echo "</tr>";
        }

          ?>
         </tbody>
    </table>
   
        </div>

 </body>
 </html>