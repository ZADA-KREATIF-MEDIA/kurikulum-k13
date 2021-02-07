<?php

$nama_guru = $guru->row('nama_guru');
$id_guru = $guru->row('id_guru');
$nama_kelas = $kelas->row('nama_kelas');
$id_kelas = $kelas->row('id_kelas');
$nama_pelajaran = $pelajaran->row('nama_pelajaran');
$id_pelajaran = $pelajaran->row('id_pelajaran');
//$nama_kategori=$kategori->row('kategori');
//$id_kategori=$kategori->row('id_kategori');
$id_tahun = $tahun;
$id_semester = $semester->row('id_semester');
?>
<!--  start step-holder -->
<!--  start page-heading -->
<?php include('application/views/section_header.php'); ?>
<!-- end page-heading -->

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h3>Petunjuk Import Nilai</h3>
        <ol>
          <li>Pilih tombol <b>Download Template Excel</b></li>
          <li>Guru tidak diizinkan mengubah data pada file kecuali pada nilai Pengetahuan dan nilai Ketrampilan</li>
          <li>Simpan dan Import dengan memilih tombol <b>Upload Excel</b></li>
        </ol>
      </div>
    </div>
  </div>

  <?php
  if ($mode_form == "input") { ?>


    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title text-blue">
              <?php echo $nama_pelajaran; ?> <small class=" glyphicon glyphicon-chevron-right"></small> Kelas: <?php echo $nama_kelas; ?> </h3>

            <button class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#modal-default-in"><i class="fa fa-upload"></i> Upload Excel</button>
            <a href="<?php echo base_url('export_file/down_templateup_nilai/' . $id_kelas . '/' . $id_pelajaran . '/' . $id_semester . ''); ?>" class="btn btn-success btn-sm pull-right" style="margin-right: 5px;"><i class="fa fa-file-excel-o"></i> Download Template Excel</a>

          </div><!-- /.box-header -->
          <form id="mainform" action="<?php echo base_url('guru/proses_input_nilai'); ?>" method="post">
            <div class="box-body no-padding table-responsive">
              <table class="table table-striped table-hover">
                <tr>
                  <th>No</th>
                  <th>NIS</th>
                  <th>Nama Siswa</th>
                  <th> &nbsp; &nbsp; Nilai Pengetahuan</th>
                  <th> &nbsp; &nbsp; Nilai Ketrampilan</th>
                </tr>
                <?php

                $i = 1;
                foreach ($list_siswa->result_array() as $row) {
                ?>
                  <input type="hidden" name="tahun" value="<?php echo $id_tahun; ?>">
                  <input type="hidden" name="id_guru" value="<?php echo $id_guru; ?>" />
                  <input type="hidden" name="id_pelajaran" value="<?php echo $id_pelajaran; ?>" />
                  <input type="hidden" name="id_kelas" value="<?php echo $id_kelas; ?>" />
                  <!--<input type="hidden" name="id_kategori" value="<?php //echo $id_kategori;
                                                                      ?>" />-->
                  <input type="hidden" name="semester" value="<?php echo $id_semester; ?>" />
                  <?php echo "<input type='hidden' name='nis[]' value='" . $row['nis'] . "' />"; ?>
                  <tr>
                    <td>&nbsp; <?php echo $i++; ?></td>
                    <td><?php echo $row['nis']; ?></td>
                    <td><?php echo $row['nama_siswa']; ?></td>
                    <td align=left><?php echo "<input type='text' name='nilai_pengetahuan[]' size='4' class=\"form-control\" placeholder=\"0\" />"; ?></td>
                    <td align=left><?php echo "<input type='text' name='nilai_ketrampilan[]' size='4' class=\"form-control\" placeholder=\"0\" />"; ?></td>
                  </tr>
                <?php

                }
                $i++;
                $jumSis = $list_siswa->num_rows();
                ?>


                <tr>
                  <td> </td>
                  <td> </td>
                  <td> </td>
                  <td> </td>
                  <td> &nbsp; &nbsp; <input type="hidden" name="jumlah" value="<?php echo $jumSis ?>" /><input type="submit" value="Simpan" name="input_nilai" class="btn btn-primary" />
                    &nbsp; - &nbsp;<a onclick="return confirm('Data belum disimpan,apakah Anda yakin batal?')" href="<?php echo base_url('guru/input_nilai'); ?>" button class="btn btn-danger" /><small class="glyphicon glyphicon-chevron-left"></small> Batal</a>
                  </td>
                </tr>

              </table>
            </div><!-- /.box-body -->
          </form>
        </div><!-- /.box -->
      </div>
    </div>

  <?php
  } else { ?>

    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title text-blue">
              <?php echo $nama_pelajaran; ?> <small class=" glyphicon glyphicon-chevron-right"></small> Kelas: <?php echo $nama_kelas; ?> </h3>

            <button class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#modal-default-up"><i class="fa fa-upload"></i> Upload Excel</button>
            <a href="<?php echo base_url('export_file/down_templateup_nilai/' . $id_kelas . '/' . $id_pelajaran . '/' . $id_semester . ''); ?>" class="btn btn-success btn-sm pull-right" style="margin-right: 5px;"><i class="fa fa-file-excel-o"></i> Download Template Excel</a>

          </div><!-- /.box-header -->
          <form id="mainform" action="<?php echo base_url('guru/proses_input_nilai'); ?>" method="post">
            <div class="box-body no-padding table-responsive">
              <table class="table table-striped table-hover">
                <tr>
                  <th>No</th>
                  <th>NIS</th>
                  <th>Nama Siswa</th>
                  <th> &nbsp; &nbsp;Ubah Nilai Pengetahuan</th>
                  <th> &nbsp; &nbsp;Ubah Nilai Ketrampilan</th>
                </tr>
                <?php
                $i = 1;
                foreach ($list_siswa->result_array() as $row) {
                ?>
                  <?php echo "<input type='hidden' name='id_nilai[]' value='" . $row['id_nilai'] . "' />"; ?>

                  <tr>
                    <td>
                      <center><?php echo $i++; ?></center>
                    </td>
                    <td><?php echo $row['nis']; ?></td>
                    <td><?php echo $row['nama_siswa']; ?></td>
                    <td><?php echo "<input  class=\"form-control\" type='text' name='nilai_pengetahuan[]' size='4' value='" . $row['nilai_pengetahuan'] . "'/>"; ?></td>
                    <td><?php echo "<input  class=\"form-control\" type='text' name='nilai_ketrampilan[]' size='4' value='" . $row['nilai_ketrampilan'] . "'/>"; ?></td>
                  </tr>
                <?php

                }
                $jumSis = $list_siswa->num_rows();
                ?>


                <tr>
                  <td> </td>
                  <td> </td>
                  <td> </td>
                  <td> </td>
                  <td> &nbsp; &nbsp; <input type="hidden" name="jumlah" value="<?php echo $jumSis ?>" /><input type="submit" value="Simpan Perubahan" name="update_nilai" class="btn btn-primary" />
                    &nbsp; - &nbsp;<a onclick="return confirm('Perubahan belum disimpan,apakah Anda yakin batal mengubah?')" href="<?php echo base_url('guru/input_nilai'); ?>" button class="btn btn-danger" /><small class="glyphicon glyphicon-chevron-left"></small> Batal</a>
                  </td>
                </tr>

              </table>
              <br>
            </div><!-- /.box-body -->
          </form>
        </div><!-- /.box -->
      </div>
    </div>


  <?php
  }
  ?>
</section>
<!-- modal update nilai-->
<div class="modal fade" id="modal-default-up">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Upload File Excel Nilai Siswa</h4>
      </div>
      <form method="post" action="<?php echo base_url('import_excel/do_importup_nilai_siswa'); ?>" enctype="multipart/form-data" accept-charset="utf-8">
        <div class="modal-body">
          <div class="form-group">
            <label class="control-label col-md-3">File Upload</label>
            <div class="col-md-5">
              <input type="hidden" name="tahun" value="<?php echo $id_tahun; ?>">
              <input type="hidden" name="id_guru" value="<?php echo $id_guru; ?>" />
              <input type="hidden" name="id_pelajaran" value="<?php echo $id_pelajaran; ?>" />
              <input type="hidden" name="id_kelas" value="<?php echo $id_kelas; ?>" />
              <input type="hidden" name="semester" value="<?php echo $id_semester; ?>" />
              <input type="hidden" name="back_url" value="guru/input_nilai?m=input_nilai&sm=pengetahuan-ketrampilan">
              <input type="file" name="userfile">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary"> <i class="fa fa-upload"></i> Upload File</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- modal input nilai-->
<div class="modal fade" id="modal-default-in">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Upload File Excel Nilai Siswa</h4>
      </div>
      <form method="post" action="<?php echo base_url('import_excel/do_importin_nilai_siswa'); ?>" enctype="multipart/form-data" accept-charset="utf-8">
        <div class="modal-body">
          <div class="form-group">
            <label class="control-label col-md-3">File Upload</label>
            <div class="col-md-5">
              <input type="hidden" name="tahun" value="<?php echo $id_tahun; ?>">
              <input type="hidden" name="id_guru" value="<?php echo $id_guru; ?>" />
              <input type="hidden" name="id_pelajaran" value="<?php echo $id_pelajaran; ?>" />
              <input type="hidden" name="id_kelas" value="<?php echo $id_kelas; ?>" />
              <input type="hidden" name="semester" value="<?php echo $id_semester; ?>" />
              <input type="hidden" name="back_url" value="guru/input_nilai?m=input_nilai&sm=pengetahuan-ketrampilan">
              <input type="file" name="userfile">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary"> <i class="fa fa-upload"></i> Upload File</button>
        </div>
      </form>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->