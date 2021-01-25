<?php

  $id_pelajaran = $pelajaran->row('id_pelajaran');
  $nama_pelajaran = $pelajaran->row('nama_pelajaran');
?>
  <!-- Content Header (Page header) -->
  <?php include('application/views/section_header.php');?>

 <section class="content">
 	 <div class="row">
            <div class="col-sm-12">
              <?php
              echo $this->session->flashdata('notif');?>
            </div>
          </div>

<?php
if($mode_form=='update'){?>

      <div class="box">
                <div class="box-header">
                  <h3 class="box-title text-blue">
          <?php echo $nama_pelajaran;?> <small class=" glyphicon glyphicon-chevron-right"></small> Kelas:  <?php echo $nama_kelas;?> </h3> 
   
                </div><!-- /.box-header -->
        <form id="mainform" action="<?php echo base_url('admin_editnilai/proses_input_deskripsi');?>" method="post">
                <div class="box-body no-padding table-responsive">
                  <table class="table table-striped table-condensed table-hover">
                    <tr>
                      <th>No</th>
            <th>NIS</th>
                      <th>Nama Siswa</th>
                       <th> &nbsp; &nbsp; Nilai</th>
                       <th> &nbsp; &nbsp; Aspek</th>
                       <th> &nbsp; &nbsp; Deskripsi</th>
                    </tr>
                    <input type="hidden" name="id_tahun" value="<?php echo $id_tahun;?>">
          <input type="hidden" name="id_semester" value="<?php echo $id_semester;?>" />
          <input type="hidden" name="id_pelajaran" value="<?php echo $id_pelajaran;?>">
          
           <?php
            $i = 1;
            foreach($nilai_deskripsi->result_array() as $row){
              ?>

              <?php echo "<input type='hidden' name='id_nilai[]' value='".$row['idnilai']."' />"; ?>
              <?php echo "<input type='hidden' name='nis[]' value='".$row['nis']."' />"; ?>
              
              <tr>
                <td rowspan="2">&nbsp; <?php echo $i++;?></td>
                <td rowspan="2"><?php echo $row['nis'];?></td>
                <td rowspan="2"><?php echo $row['nama_siswa'];?></td>
                <td><?php echo "<input  class=\"form-control\" type='text' name='nilai_pengetahuan[]' size='4' value='".$row['nilai_pengetahuan']."' disabled/>"; ?></td>
                <td>Pengetahuan</td>
                <td><textarea class="form-control" cols="50" name="desk_pengetahuan[]" placeholder="sedang diproses"><?php echo $row['pengetahuan'];?></textarea></td>
              </tr>
              <tr>
                
                <td><?php echo "<input  class=\"form-control\" type='text' name='nilai_ketrampilan[]' size='4' value='".$row['nilai_ketrampilan']."' disabled/>"; ?></td>
                <td>Ketrampilan</td>
                <td><textarea class="form-control" name="desk_ketrampilan[]" cols="50" placeholder="sedang diproses"><?php echo $row['ketrampilan'];?></textarea></td>
              </tr>
              <?php
              
            }
              $jumSis = $nilai_deskripsi->num_rows();
            ?>
    
    
                    <tr>
                      
                      <td> </td>
                      <td> </td>
                      <td> </td>
                      <td> </td>
                      <td> </td>
                      
                      <td> &nbsp; &nbsp;   <input type="hidden" name="jumlah" value="<?php echo $jumSis ?>" /><input type="submit" value="Simpan Perubahan" name="input_nilai" class="btn btn-primary"/> 
            &nbsp;  -  &nbsp;<a  onclick="return confirm('Perubahan belum disimpan,apakah Anda yakin batal mengubah?')" href="<?php echo base_url('admin_editnilai/edit_deskripsi_nilai?m=edit_nilai&sm=deskripsi_nilai');?>" button class="btn btn-danger"/><small class="glyphicon glyphicon-chevron-left"></small> Batal</a>
            </td>
                    </tr>
                    
                  </table>
          <br>  
                </div><!-- /.box-body -->
        </form>
              </div><!-- /.box -->
	<?php
  //Mode Input::
  }
 ?>
