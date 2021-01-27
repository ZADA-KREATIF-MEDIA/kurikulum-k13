  <section class="content">
      <div class="row">
          <div class="col-md-12">
              <?php
              echo $this->session->flashdata('notif');?>
          </div>
      </div>
      <!-- /data pembagian wali kelas -->
      <div class="box">
          <div class="box-header with-border">
              <div class="d-flex justify-content-between">
                  <h3 class="card-title mb-0">DATA WALI KELAS SD SANTA MARIA TIMIKA TAHUN <?php echo $pd_tahun; ?></h3>
                  <a href="<?= base_url() ?>admin/form_tambah_walikelas" class="btn btn-success"><small>TAMBAH DATA
                          WALI KELAS</small></a>
              </div>
              <br>
          </div>
          <div class="box-body">
              <div class="col-md-12">
                  <form class="form-inline pull-center" method="post"
                      action="<?php echo base_url('admin/penjadwalan_wali_kelas');?>">
                      <div class="form-group">
                          <label><i class="fa fa-filter"></i> Filter : </label>
                      </div>
                      <div class="form-group">
                          <label for="tahun">Pilih Tahun</label>
                          <select name="tahun" class="form-control input-sm">
                              <?php foreach($tahun_pelajaran->result() as $tp){?>
                              <option value="<?php echo $tp->id_tahun;?>"
                                  <?php if($this->session->userdata('ses_wali_thn')==$tp->id_tahun){echo "selected";}?>>
                                  <?php echo $tp->tahun;?></option>
                              <?php } ?>
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="total_rows">Data per halaman</label>
                          <select name="rows" class="form-control input-sm">
                              <option value="5"
                                  <?php if($this->session->userdata('ses_wali_rows')=="5"){echo "selected";}?>>5
                              </option>
                              <option value="10"
                                  <?php if($this->session->userdata('ses_wali_rows')=="10"){echo "selected";}?>>10
                              </option>
                              <option value="25"
                                  <?php if($this->session->userdata('ses_wali_rows')=="25"){echo "selected";}?>>25
                              </option>
                              <option value="50"
                                  <?php if($this->session->userdata('ses_wali_rows')=="50"){echo "selected";}?>>50
                              </option>
                              <option value="100"
                                  <?php if($this->session->userdata('ses_wali_rows')=="100"){echo "selected";}?>>100
                              </option>
                          </select>
                      </div>
                      <button type="submit" name="sort_wali_kelas" class="btn btn-primary btn-sm">Tampilkan</button>
                  </form>
                  <br>
                  <form action="<?php echo base_url('admin/penjadwalan_wali_kelas');?>" method="post"
                      class="form-inline">
                      <div class="table-responsive">
                          <table id="example2" class="table table-bordered table-hover no-padding">
                              <thead>
                                  <tr bgcolor=#fafafa>

                                      <th width="5%">No </th>
                                      <th width="30%">Nama Guru</th>
                                      <th width="10%">NIP</th>
                                      <th width="10%">Wali Kelas</th>
                                      <th width="10%">Tahun Ajaran</th>
                                      <th width="10%">Aksi</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php
        $no=$this->uri->segment(3)+1;
        foreach($data->result_array() as $row){
        ?>
                                  <tr>

                                      <td><?php echo $no++;?></td>
                                      <td><a href="<?php echo base_url('admin/detail_guru/'.$row['id_guru'].'?m=data_induk&sm=guru');?>"
                                              title="Lihat detail guru"><?php echo $row['nama_guru'];?></a></td>
                                      <td><?php echo $row['nip'];?></td>
                                      <td><?php echo $row['nama_kelas'];?></td>
                                      <td><?php echo $row['tahun'];?></td>
                                      <td><a href="<?php echo base_url('admin/drop_wali/'.$row['id_wali'].'/'.$row['nama_guru'].'/'.$row['nama_kelas'].'');?>"
                                              class="btn btn-danger" title="Hapus wali pada kelas ini"
                                              onclick="return konfirmasi();"> <i class="fa fa-trash"></i> </a>
                                      </td>
                                  </tr>
                                  <?php
        }
        ?>
                              </tbody>
                          </table><br>
                          <center><?php echo $pagination;?></center>

                      </div>
                  </form>
                  <!--  end product-table................................... -->
              </div>
          </div><!-- /.box-body -->
      </div>
  </section>