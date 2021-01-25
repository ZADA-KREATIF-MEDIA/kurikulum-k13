<?php 
    $nama_guru=$guru->row('nama_guru');
    $id_guru=$guru->row('id_guru');
    $nama_kelas=$kelas->row('nama_kelas');
    $id_kelas=$kelas->row('id_kelas');
    $nama_pelajaran=$pelajaran->row('nama_pelajaran');
    $id_pelajaran=$pelajaran->row('id_pelajaran');
    //$nama_kategori=$kategori->row('kategori');
    //$id_kategori=$kategori->row('id_kategori');
    $id_tahun = $tahun;
    $id_semester = $semester->row('id_semester');
    $pd_semester = $semester->row('semester');
  ?>

<html>
<head>

<title>Template Excel - Nilai Siswa</title>

</head>
<body>

<!--<center> <font style="font-weight:bold; font-size:14pt; font-family:Geneva, Arial, Helvetica, sans-serif;"><?php echo $page_title;?> KELAS <?php echo $nama_kelas;?><br>
Semester <?php echo ucwords($pd_semester);?> TA <?php echo $pd_tahun;?>
</font></center>
<br>
<b>Keterangan :</b> Kolom yang berwarna merah jangan dirubah! Sudah terisi secara otomatis dari system
-->
<?php if($mode_form=="input"){?>

        <table border="1">
          <thead>
             <tr>
                      <th>No</th>
                      <th>NIS</th>
                      <th>ID PELAJARAN</th>
                      <th>ID KELAS</th>
                      <th>ID GURU</th>
                      <th> &nbsp; &nbsp;Ubah Nilai Pengetahuan</th>
                      <th> &nbsp; &nbsp;Ubah Nilai Ketrampilan</th>
                      <th>ID TAHUN</th>
                      <th>ID SEMESTER</th>
                     
                    </tr>
                  </thead>
                  <tbody>
            <?php
            $i = 1;
            foreach($list_siswa->result_array() as $row){?>
             
            <tr>
                <td>&nbsp; <?php echo $i++;?></td>
                <td><?php echo $row['nis'];?></td>
                <td><?php echo $id_pelajaran;?></td>
                <td><?php echo $id_kelas;?></td>
                <td><?php echo $id_guru;?></td>
                <td></td>
                <td></td>
                 <td><?php echo $id_tahun;?></td>
                <td><?php echo $id_semester;?></td>
                
            </tr>
          <?php
          }
          ?>
         </tbody>
    </table>
   

<?php
//Data nilai sudah terisi
}else{?>

    
                  <table border="1">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>ID NILAI</th>
                      <th>NIS</th>
                      <th>ID PELAJARAN</th>
                      <th>ID KELAS</th>
                      <th>ID GURU</th>
                      <th>Ubah Nilai Pengetahuan</th>
                      <th>Ubah Nilai Ketrampilan</th>
                      <th>ID TAHUN</th>
                      <th>ID SEMESTER</th>

                    </tr>
                  </thead>
                  <tbody>
           <?php
            $i = 1;
            foreach($list_siswa->result_array() as $row){
              ?>
              <tr>
                <td><?php echo $i++;?></td>
                <td bgcolor="red"><?php echo $row['id_nilai'];?></td>
                <td><?php echo $row['nis'];?></td>
                <td><?php echo $id_pelajaran;?></td>
                <td><?php echo $id_kelas;?></td>
                <td><?php echo $id_guru;?></td>
                <td><?php echo $row['nilai_pengetahuan']; ?></td>
                <td><?php echo $row['nilai_ketrampilan']; ?></td>
                <td><?php echo $id_tahun;?></td>
                <td><?php echo $id_semester;?></td>
               

              </tr>
              <?php
              
            }

            ?>
            </tbody>
    
    
                  
                    
                  </table> 
                
<?php
}
?>
      

 </body>
 </html>