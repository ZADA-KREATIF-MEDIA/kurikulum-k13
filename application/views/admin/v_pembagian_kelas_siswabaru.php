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
      
<div class="box">
            <div class="box-header with-border">
               
              <h3 class="box-title">Daftar Siswa Baru - Belum Mendapatkan Kelas</h3><br>
              <small>Data Sejumlah <?php echo number_format($jml_siswa);?></small>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
              <br>

            </div><br>

          <form action="<?php echo base_url('admin/proses_pembagian_kelas');?>" method="post" class="form-inline">
            <div class="box-body">
              <div class="col-md-12">
        
          <div class="table-responsive">
        <table id="example1" class="table table-bordered table-hover no-padding" >
          <thead>
                    <tr bgcolor=#fafafa>
                      <th width="5%">#</th>
          <th width="5%">No </th>
          <th width="10%">NIS</th>
          <th width="30%">Nama Siswa</th>
          <th width="15%">Kelamin</th>
          <th width="15%">Status</th>
          
        </tr>
         </thead>
        <tbody>
        <?php
        //$no=$this->uri->segment(3)+1;
        $no=1;
        foreach($ref_siswa->result_array() as $row2){
        ?>  
        <tr>
          <td><div class="checkbox icheck"><input type="checkbox" name="check[]" value="<?php echo $row2['id_siswa']."-".$row2['nis'] ;?>"></div></td>
          <td><?php echo $no++;?></td>
          <td><?php echo $row2['nis'];?></td>
          <td><a href="<?php echo base_url('admin/detail_siswa/'.$row2['nis'].'?m=data_induk&sm=siswa');?>" title="Lihat detail siswa"><?php echo $row2['nama_siswa'];?></a></td>
          <td><?php echo $row2['kelamin'];?></td>
          <td><?php if($row2['status']=='0'){echo "<em>Alumni</em>";}else{echo "Aktif";}?></td>
        
        </tr>
        <?php
        }
        ?>
        </tbody>
        </table><br>
        <?php /*<center><?php echo $pagination2;?></center>*/?>
      <hr><hr>
      <h4 style="margin: 0px;">Aksi dengan data yang dipilih :</h4><hr>
        
        <small class="text-warning">*Penting: Untuk <b>Pembagian Kelas</b> satu siswa hanya untuk satu kelas pada tahun ajaran yang sama</small><br><br>
        <div class="form-group">
          <label for="aksi_set_kelas">Set Pembagian Kelas</label>
          <select name="kelas" class="form-control input-sm">
           
            <!-- data kelas -->
            <?php foreach($kelas->result() as $row_kelas){?>
              <option value="<?php echo $row_kelas->id_kelas;?>"><?php echo $row_kelas->nama_kelas;?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <select name="tahun" class="form-control input-sm">
            
            <!-- data tahun pelajaran -->
            <?php foreach($tahun_pelajaran->result() as $row_tahun){?>
              <option value="<?php echo $row_tahun->id_tahun;?>"><?php echo $row_tahun->tahun;?></option>
            <?php } ?>
          </select>
        </div>

        <button class="btn btn-primary btn-sm" type="submit" name="set_new_kelas" style="margin-left: 10px;"><i class="fa fa-save"></i> Set Kelas</button> <br><br>

        </div>
        <!--  end product-table................................... --> 
        
        </div>
        
            </div><!-- /.box-body -->
          </form>
          </div>
</section>
