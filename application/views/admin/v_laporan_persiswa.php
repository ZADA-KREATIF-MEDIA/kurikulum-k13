<section class="content">
  <div class="row">
    <div class="col-sm-12">
      <?php
      echo $this->session->flashdata('notif'); ?>
    </div>
  </div>
  <!-- Sortir Data-->
  <!-- /data pembagian kelas -->

  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Sorting Nilai Rapor Tahun Ajaran <?php echo $pd_tahun . " Semester " . ucwords($pd_semester); ?></h3><br>
    </div>

    <div class="box-body">
      <div class="col-md-12">
        <form class="form-inline" method="post" action="<?php echo base_url('cetak/cetak_rapor?m=pelaporan&sm=cetak_rapor/'); ?>">
          <div class="form-group">
            <label for="kelas">Kelas</label>
            <select name="kelas" class="form-control input-sm">

              <!-- data kelas -->
              <?php foreach ($kelas->result() as $row_kelas) { ?>
                <option value="<?php echo $row_kelas->id_kelas; ?>" <?php if ($this->session->userdata('ses_lapnilai_kelas') == $row_kelas->id_kelas) {
                                                                      echo "selected";
                                                                    } ?>><?php echo $row_kelas->nama_kelas; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="tahun">Pilih Semester</label>
            <select name="semester" class="form-control input-sm">

              <?php foreach ($semester->result() as $sms) { ?>
                <option value="<?php echo $sms->id_semester; ?>" <?php if ($this->session->userdata('ses_lapnilai_sms') == $sms->id_semester) {
                                                                    echo "selected";
                                                                  } ?>><?php echo $sms->semester; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="tahun">Pilih Tahun</label>
            <select name="tahun" class="form-control input-sm">

              <?php foreach ($tahun->result() as $tp) { ?>
                <option value="<?php echo $tp->id_tahun; ?>" <?php if ($this->session->userdata('ses_lapnilai_thn') == $tp->id_tahun) {
                                                                echo "selected";
                                                              } ?>><?php echo $tp->tahun; ?></option>
              <?php } ?>
            </select>
          </div>

          <button type="submit" name="sort_lap_nilai" class="btn btn-primary btn-sm">Tampil</button>
        </form>
        <br>

        <div class="table-responsive">
          <table id="example1" class="table table-bordered table-hover no-padding">
            <thead>
              <tr bgcolor=#fafafa>

                <th width="5%" align="center">No </th>
                <th width="10%" align="center">NIS</th>
                <th width="20%" align="center">Nama Siswa</th>
                <th width="10%" align="center">Kelamin</th>
                <th width="15%" align="center">Kelas</th>
                <th width="20%" align="center">Cetak Nilai</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($rapor_siswa->result_array() as $row) {
              ?>
                <tr>

                  <td align="center"><?php echo $no++; ?></td>
                  <td align="center"><?php echo $row['nis']; ?></td>
                  <td><?php echo $row['nama_siswa']; ?></td>
                  <td align="center"><?php echo $row['kelamin']; ?></td>
                  <td align="center"><?php echo $row['nama_kelas']; ?></td>

                  <td align="center">
                    <a href="<?php echo base_url('cetak/print_nilai_rapor/' . $row['nis'] . '/' . $row['id_kelas'] . '/' . $row['id_tahun'] . '?semester=1'); ?>" class="btn btn-primary btn-sm" target="_blank"> Cetak Semester 1</a><br>
                    <a href="<?php echo base_url('cetak/print_nilai_rapor/' . $row['nis'] . '/' . $row['id_kelas'] . '/' . $row['id_tahun'] . '?semester=2'); ?>" class="btn btn-success btn-sm" target="_blank"> Cetak Semester 2</a>
                  </td>

                </tr>
              <?php
              }
              ?>
            </tbody>
          </table>

        </div>


      </div>

    </div><!-- /.box-body -->

  </div>



</section>