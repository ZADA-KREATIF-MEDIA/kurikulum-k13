<section class="content">
  <div class="row">
    <div class="col-sm-12">
      <?php
      echo $this->session->flashdata('notif');?>
    </div>
  </div>
	<div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Daftar Pembagian Kelas Tahun <?php echo $pd_tahun; ?></h3><br>
    </div>
    <div class="box-body">
      <div class="col-md-12">
        <form class="row" method="post" action="<?php echo base_url('admin/jadwal_ruangkelas');?>">
          <div class="col">
            <div class="form-group">
              <label for="kelas">Kelas</label>
              <select name="kelas" class="form-control input-sm">
                <!-- data kelas -->
                <?php foreach($kelas->result() as $row_kelas){?>
                  <option value="<?php echo $row_kelas->id_kelas;?>" <?php if($this->session->userdata('ses_id_kelas')==$row_kelas->id_kelas){echo "selected";}?>><?php echo $row_kelas->nama_kelas;?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="tahun">Pilih Tahun</label>
              <select name="tahun" class="form-control input-sm">
                <?php foreach($tahun_pelajaran->result() as $tp){?>
                  <option value="<?php echo $tp->id_tahun;?>" <?php if($this->session->userdata('ses_idthn_pel')==$tp->id_tahun){echo "selected";}?>><?php echo $tp->tahun;?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="total_rows">Data per halaman</label>
              <select name="rows" class="form-control input-sm">
                <option value="5" <?php if($this->session->userdata('ses_tbl_rows')=="5"){echo "selected";}?>>5</option>
                <option value="10" <?php if($this->session->userdata('ses_tbl_rows')=="10"){echo "selected";}?>>10</option>
                <option value="25" <?php if($this->session->userdata('ses_tbl_rows')=="25"){echo "selected";}?>>25</option>
                <option value="50" <?php if($this->session->userdata('ses_tbl_rows')=="50"){echo "selected";}?>>50</option>
                <option value="100" <?php if($this->session->userdata('ses_tbl_rows')=="100"){echo "selected";}?>>100</option>
              </select>
            </div>
          </div>
          <div class="col-12">
            <button type="submit" name="sort_pembagian_kelas" class="btn btn-primary btn-sm btn-block">Tampilkan</button>
          </div>
        </form><br>
				<form action="<?php echo base_url('admin/proses_pembagian_kelas');?>" method="post">
          <div class="table-responsive">
            <table id="example2" class="table table-bordered table-hover no-padding" >
              <thead>
                <tr class="bg-secondary">
                  <th width="5%">#</th>
                  <th width="5%">No </th>
                  <th width="24%">Nama Siswa</th>
                  <th width="10%">NIS</th>
                  <th width="7%">Kelamin</th>
                  <th width="22%">Kelas</th>
                  <th width="15%">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no=$this->uri->segment(3)+1;
                foreach($data->result_array() as $row){
                ?>  
                  <tr>
                    <td><div class="checkbox icheck"><input type="checkbox" name="check[]" value="<?php echo $row['id_ruangan']."-".$row['nis'] ;?>"></div></td>
                    <td><?php echo $no++;?></td>
                    <td><a href="<?php echo base_url('admin/detail_siswa/'.$row['nis'].'?m=data_induk&sm=siswa');?>" title="Lihat detail siswa"><?php echo $row['nama_siswa'];?></a></td>
                    <td><?php echo $row['nis'];?></td>
                    <td><?php echo $row['kelamin'];?></td>
                    <td><?php echo $row['nama_kelas'];?></td>
                    <td><a href="<?php echo base_url('admin/drop_siswa_dari_kelas/'.$row['id_ruangan'].'/'.$row['nama_siswa'].'/'.$row['nama_kelas'].'');?>"  class="btn btn-danger" title="Hapus siswa pada kelas ini" onclick="return konfirmasi();"> <i class="fa fa-trash"></i> </a>     
                    </td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table><br>
            <div class="mx-auto">
              <?php echo $pagination;?>
            </div>
            <h4 >Set Pembagian Kelas</h4><hr>
            <div class="col-12 row">
              <div class="col-md-5">
                <div class="form-group">
                  <select name="kelas" class="form-control w-100">
                    <?php foreach($kelas->result() as $row_kelas){?>
                      <option value="<?php echo $row_kelas->id_kelas;?>"><?php echo $row_kelas->nama_kelas;?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <select name="tahun" class="form-control w-100">
                    <!-- data tahun pelajaran -->
                    <?php foreach($tahun_pelajaran->result() as $row_tahun){?>
                      <option value="<?php echo $row_tahun->id_tahun;?>"><?php echo $row_tahun->tahun;?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col-md-2">
                <button class="btn btn-primary btn-sm" type="submit" name="set_kelas" style="margin-left: 10px;"><i class="fa fa-save"></i> Set Kelas</button>
              </div>
            </div>
          </div>
        </form>
			</div>
    </div><!-- /.box-body -->
  </div>
</section>		  
