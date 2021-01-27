<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="col-md-12 d-flex justify-content-between mb-4">
          <h3 class="card-title">DATA TAHUN AJARAN SD SANTA MARIA TIMIKA</h3>
          <button class="btn btn-success" data-toggle="modal" data-target="#tambahModal"><small>TAMBAH TAHUN AJARAN</small></button>
        </div>
        <div class="box-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered">
              <thead>
                <tr>
                  <th style="width:5%;">No</th>
                  <th style="width:45%;">Tahun Pelajaran</th>
                  <th style="width:45%;">Status</th>
                  <th style="width:15%;">Aksi</th>
                </tr>
              </thead>
                <?php
                  $no=1;
                  foreach($thn_pelajaran->result_array() as $row){
                ?>  
                  <tr>
                    <td><?php echo $no++;?></td>
                    <td><?php echo $row['tahun'];?></td>
                    <td><?php if($row['status_aktif']==1){echo "Aktif";}else{echo "Tidak Aktif";}?></td>
                    <td class="text-center">
                      <button type="button"  class="btn btn-primary" title="Edit" data-toggle="modal" data-target="#editModal<?= $row['id_tahun'] ?>"> <i class="fa fa-edit"></i></button> &nbsp; 
                      <a href="<?php echo base_url('admin/drop_tahun/'.$row['id_tahun']);?>"  class="btn btn-danger" title="Hapus" onclick="return konfirmasi();"> <i class="fa fa-trash"></i> </a>
                    </td>
                  </tr>
                <?php
                  }
                ?>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>		  
<!-- Modal -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Tahun Ajaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo base_url('admin/create_tahun_pelajaran');?>" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <label>Tahun Pelajaran</label>
            <input type="text" class="form-control" name="tahun"/>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php foreach($thn_pelajaran->result_array() as $row):?>
  <div class="modal fade" id="editModal<?= $row['id_tahun'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Tahun Ajaran</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?php echo base_url('admin/update_tahun');?>" method="POST">
          <input type="hidden" name="id" value="<?= $row['id_tahun'] ?>" >
          <div class="modal-body">
            <div class="form-group">
              <label>Tahun Pelajaran</label>
              <input type="text" class="form-control" name="tahun" value="<?= $row['tahun'];?>"/>
            </div>
            <div class="form-group">
              <label for="status">Status</label>
              <select name="status" id="status" class="form-control">
                <option value="1" <?php if($row['status_aktif'] == 1){ echo "selected"; }?>>Aktif</option>
                <option value="0" <?php if($row['status_aktif'] == 0){ echo "selected"; }?>>Tidak</option>
              </select>      
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach;?>