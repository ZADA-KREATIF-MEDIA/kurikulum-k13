<section class="content">
  <div class="row">
    <div class="col-sm-12">
      <?php
      echo $this->session->flashdata('notif');?>
    </div>
  </div>

  <div class="box">
    <div class="box-header with-border col-12">
      <h3 class="box-title">Daftar Siswa Baru - Belum Mendapatkan Kelas</h3>
    </div>
    <br>

    <form action="<?php echo base_url('admin/proses_pembagian_kelas');?>" method="post">
      <div class="box-body">
        <div class="col-md-12">
          <div class="table-responsive">
            <table  class="table table-bordered table-hover no-padding" >
              <thead>
                <tr class="bg-secondary">
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
            <hr>
            <h4>Pembagian Kelas</h4>
            <div class="row pt-2">
              <div class="col-5">
                <div class="form-group>
                  <label for="aksi_set_kelas"></label>
                  <select name="kelas" class="form-control input-sm">
                    <!-- data kelas -->
                    <?php foreach($kelas->result() as $row_kelas){?>
                      <option value="<?php echo $row_kelas->id_kelas;?>"><?php echo $row_kelas->nama_kelas;?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col-5">
                <div class="form-group ">
                  <select name="tahun" class="form-control input-sm">
                    <?php foreach($tahun_pelajaran->result() as $row_tahun){?>
                      <option value="<?php echo $row_tahun->id_tahun;?>"><?php echo $row_tahun->tahun;?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col-2">
                <button class="btn btn-primary btn-sm " type="submit" name="set_new_kelas" style="margin-left: 10px;"><i class="fa fa-save"></i> Set Kelas</button>
              </div>
            </div>
            <br><br>
          </div>
        </div>
      </div><!-- /.box-body -->
    </form>
  </div>
</section>
