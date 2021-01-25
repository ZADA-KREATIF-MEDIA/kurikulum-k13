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
              <h3 class="box-title">Sorting Legger Tahun Ajaran <?php echo $pd_tahun." Semester ".ucwords($pd_semester); ?></h3><br> 
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
           
            </div>
            
            <div class="box-body">
            	<div class="col-md-12">
                <form class="form-inline" method="post" action="<?php echo base_url('cetak/legger_semua?m=pelaporan&sm=legger_semua/');?>">

                <div class="form-group">
                  <label><i class="fa fa-filter"></i> Filter : </label>
                </div>
                <div class="form-group">
          <label for="kelas">Kelas</label>
          <select name="kelas" class="form-control input-sm">
            
            <!-- data kelas -->
            <?php foreach($kelas->result() as $row_kelas){?>
              <option value="<?php echo $row_kelas->id_kelas;?>" <?php if($this->session->userdata('ses_lapnilai_kelas')==$row_kelas->id_kelas){echo "selected";}?>><?php echo $row_kelas->nama_kelas;?></option>
            <?php } ?>
          </select>
        </div>
         <div class="form-group">
                  <label for="tahun">Pilih Semester</label>
                  <select name="semester" class="form-control input-sm">
                    
                    <?php foreach($semester->result() as $sms){?>
                    <option value="<?php echo $sms->id_semester;?>" <?php if($this->session->userdata('ses_legger_sms')==$sms->id_semester){echo "selected";}?>><?php echo $sms->semester;?></option>
                  <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="tahun">Pilih Tahun</label>
                  <select name="tahun" class="form-control input-sm">
                    
                    <?php foreach($tahun->result() as $tp){?>
                    <option value="<?php echo $tp->id_tahun;?>" <?php if($this->session->userdata('ses_legger_thn')==$tp->id_tahun){echo "selected";}?>><?php echo $tp->tahun;?></option>
                  <?php } ?>
                  </select>
                </div>
               
                <button type="submit" name="sort_legger" class="btn btn-primary btn-sm">Tampil</button>
                <button type="submit" name="export_excel" class="btn btn-success btn-sm"><i class="fa fa-file-excel-o"></i> Export Excel</button>
              </form>
              <br>

            <?php
            echo '<div class="callout callout-success"> Menampilkan Legger Kelas '.$nama_kelas.' Semester '.ucwords($pd_semester).' TA '.$pd_tahun.'</div>';
            ?>

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
            $nilai_siswa = $this->m_admin->get_nilai_mapel($row['nis'],$mpl->id_pelajaran,$post_idkelas,$post_idsemester,$post_idtahun)->row('nilai_pengetahuan');
              if($nilai_siswa!='' && $nilai_siswa!=0){
                echo "<td align='center'>$nilai_siswa</td>";
              }
              else
              {
               echo "<td align='center' bgcolor='yellow'>$nilai_siswa</td>"; 
              }
            }
            
          
          //jumlah nilai siswa
          $jml_nilai = $this->m_admin->get_jml_nilai($row['nis'],$post_idkelas,$post_idsemester,$post_idtahun)->row('jumlah_nilai');
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
            $nilai_siswa2 = $this->m_admin->get_nilai_mapel2($row['nis'],$mpl->id_pelajaran,$post_idkelas,$post_idsemester,$post_idtahun)->row('nilai_ketrampilan');
              if($nilai_siswa2!='' && $nilai_siswa2!=0){
                echo "<td align='center'>$nilai_siswa2</td>";
              }
              else
              {
               echo "<td align='center' bgcolor='yellow'>$nilai_siswa2</td>"; 
              }
            }
            
          
          //jumlah nilai siswa
          $jml_nilai2 = $this->m_admin->get_jml_nilai2($row['nis'],$post_idkelas,$post_idsemester,$post_idtahun)->row('jumlah_nilai');
          echo "<td align='center' bgcolor='#fafafa'>$jml_nilai2</td>";
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
