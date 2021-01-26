
<section>
  <div class="box">
    <div class="col-sm-12">
      <?php
      echo $this->session->flashdata('notif');?>
    </div>
    <div class="box-body">
      <div class="d-flex justify-content-between">
          <h3 class="card-title mb-0">DATA SISWA SD SANTA MARIA TIMIKA</h3>
          <a href="<?= base_url() ?>admin/tambah_siswa" class="btn btn-success"><small>TAMBAH DATA SISWA</small></a>
      </div>
      <br>
      <div class="col-md-12">
        <form action="<?php echo base_url('admin/aksi_siswa');?>" method="post">
          <div class="table-responsive">
            <table  id="example2" class="table table-bordered table-hover no-padding" >
              <thead>
                <tr bgcolor=#fafafa>
                  <th width="5%">#</th>
                  <th width="5%">No </th>
                  <th width="20%">Nama Siswa</th>
                  <th width="5%">NIS</th>
                  <th width="5%">Kelamin</th>
                  <th width="10%">Telepon</th>
                  <th width="10%">Status</th>
                  <th width="10%">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no=$this->uri->segment(3)+1;
                foreach($data->result_array() as $row){
                ?>  
                  <tr>
                    <td><div class="checkbox icheck"><input type="checkbox" name="check[]" value="<?php echo $row['id_siswa'] ;?>"></div></td>
                    <td><?php echo $no++;?></td>
                    <td><?php echo $row['nama_siswa'];?></td>
                    <td><?php echo $row['nis'];?></td>
                    <td><?php echo $row['kelamin'];?></td>
                    <td><?php echo $row['telpon_siswa'];?></td>
                    <td><?php
                    if($row['status']==1){echo "Aktif";}else{echo "<em>Alumni</em>";}?></td>
                    <td><a href="<?php echo base_url('admin/detail_siswa/'.$row['nis'].'?m=data_induk&sm=siswa');?>" class="btn btn-primary" title="Detail Siswa"> <i class="fa fa-file"></i> </a> &nbsp; 
                        <a href="<?php echo base_url('admin/drop_siswa/'.$row['id_siswa'].'');?>"  class="btn btn-danger" title="Hapus" onclick="return konfirmasi();"> <i class="fa fa-trash"></i> </a>     
                    </td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
            <br>
            <center><?php echo $pagination;?></center>
            <hr>
            <h4>Aksi dengan data yang dipilih :</h4>
            <button class="btn btn-danger btn-sm" type="submit" name="multidelete" onclick="return konfirmasi();"><i class="fa fa-trash"></i> Hapus Data Siswa</button>
            <br><br>
          </div>
        </form>
      </div>
    </div><!-- /.box-body -->
  </div>
</section>		  
