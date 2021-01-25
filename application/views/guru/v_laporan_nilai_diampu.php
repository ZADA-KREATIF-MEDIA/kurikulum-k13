  <!-- Content Header (Page header) -->
          <?php include('application/views/section_header.php');?>

 <section class="content">
 	 <div class="row">
            <div class="col-sm-12">
              <?php
              echo $this->session->flashdata('notif');?>
            </div>
          </div>
      <!-- Sortir Data-->
      
      
		  <!-- /data pembagian kelas -->
      
		 <div class="box">
            <div class="box-header with-border">
              <form method="post" class="form-inline" action="<?php echo base_url('guru/laporan_per_mapel?m=laporan_nilai&sm=per_mapel');?>">
                <div class="form-group">
                  <label>Sort Kelas : </label>
                  <select name="idkelas" class="form-control">
                    <?php foreach($kelas->result() as $kls){
                      echo "<option value='$kls->id_kelas'>$kls->nama_kelas</option>";
                    }?>
                  </select>
                </div>
                <input type="submit" name="submit" value="Tampilkan" class="btn btn-sm btn-primary">
              </form>
              <br>
              <?php
            echo '<div class="callout callout-success"> Menampilkan Nilai Kelas '.$nama_kelas.' Semester '.ucwords($pd_semester).' TA '.$pd_tahun.'</div>';
            ?>
          
			    
					<div class="table-responsive">
				<table class="table table-bordered table-hover no-padding" >
          <thead>
                    <tr bgcolor=#fafafa>
            
          <th width="5%" align="center" rowspan="3">No </th>
          <th width="10%" align="center" rowspan="3">NIS</th>
          <th width="20%" align="center" rowspan="3">Nama Siswa</th>
          <?php $jml_mapel = $list_mapel->num_rows(); $sum = $jml_mapel*2;?>
          <th width="10%" align="center" colspan="<?php echo $sum;?>">Mata Pelajaran</th>
          <th width="15%" align="center" rowspan="3">Jumlah</th>
          </tr>
          <tr>
            <?php foreach($list_mapel->result() as $mapel){?>
          <th width="10%" align="center" colspan="2"><?php echo $mapel->nama_pelajaran;?></th>
            <?php } ?>
          </tr>
          <tr>
            <?php foreach($list_mapel->result() as $mapel){?>
            <th>Pengetahuan</th>
            <th>Ketrampilan</th>
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
          <?php
          foreach($list_mapel->result() as $mpl){
            $nilai_siswa = $this->m_guru->get_nilai_mapel($row['nis'],$mpl->id_pelajaran,$post_idkelas,$idsemester,$idtahun)->row();
            if($nilai_siswa->nilai_pengetahuan!='' && $nilai_siswa->nilai_pengetahuan!=0)
            {
            echo "<td align='center'>$nilai_siswa->nilai_pengetahuan</td>";
            }
            else
            {
              echo "<td align='center' bgcolor='yellow'>$nilai_siswa->nilai_pengetahuan</td>";
            }

            if($nilai_siswa->nilai_ketrampilan!='' && $nilai_siswa->nilai_ketrampilan!=0)
            {
              echo "<td>$nilai_siswa->nilai_ketrampilan</td>";
            }
            else
            {
              echo "<td align='center' bgcolor='yellow'>$nilai_siswa->nilai_ketrampilan</td>"; 
            }

          }

          $jml_nilai = $this->m_guru->get_jml_nilai($row['nis'],$post_idkelas,$idsemester,$idtahun)->row('jumlah_nilai');
          echo "<td>$jml_nilai</td>";
          echo "</tr>";
          
        }

          ?>
         </tbody>
    </table>
   
				</div>

       
				
				</div>
				
            </div><!-- /.box-body -->
          
          </div>
    
      

 </section>		  
