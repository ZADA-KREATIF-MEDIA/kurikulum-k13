<?php 
$nama_pelajaran = $getmapel->row('nama_pelajaran');
$id_pelajaran = $getmapel->row('id_pelajaran');
$nama_kelas = $getkelas->row('nama_kelas');
$id_kelas = $getkelas->row('id_kelas');
//session
$sidpel = $this->session->userdata('ses_edt_idpel');
$sidkel = $this->session->userdata('ses_edt_idkel');
$sidsms = $this->session->userdata('ses_edt_idsms');
$sidthn = $this->session->userdata('ses_edt_idthn');
?>
<section class="content">
    <div class="row">
        <div class="col-sm-12">
            <?php
              echo $this->session->flashdata('notif');?>
        </div>
    </div>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Data Nilai Sikap Siswa</h3>
            <hr>
        </div>
        <div class="box-body">
            <div class="alert alert-primary" role="alert">
                <form action="<?php echo base_url('admin_editnilai/edit_nilai_peng_ketr');?>" method="post"
                    class="form-horizontal">
                    <div class="form-group">
                        <label for="mapel" class="col-md-3 control-label">Mata Pelajaran</label>
                        <div class="col-md-8">
                            <select name="id_pelajaran" class="form-control">
                                <?php
                        foreach($mapel->result() as $mpl)
                        {
                          echo "<option value='$mpl->id_pelajaran'";
                          if($mpl->id_pelajaran==$sidpel){echo "selected";}
                          echo ">$mpl->nama_pelajaran</option>";
                        }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kelas" class="col-md-3 control-label">Kelas</label>
                        <div class="col-md-8">
                            <select name="id_kelas" class="form-control">
                                <?php
                        foreach($kelas->result() as $kls)
                        {
                          echo "<option value='$kls->id_kelas'";
                          if($kls->id_kelas==$sidkel){echo "selected";}
                          echo ">$kls->nama_kelas</option>";
                        }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="semester" class="col-md-3 control-label">Semester</label>
                        <div class="col-md-8">
                            <select name="id_semester" class="form-control">
                                <?php
                        foreach($semester->result() as $sms)
                        {
                          echo "<option value='$sms->id_semester'";
                          if($sms->id_semester==$sidsms){echo "selected";}
                          echo ">$sms->semester</option>";
                        }
                        ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tahun" class="col-md-3 control-label">Tahun</label>
                        <div class="col-md-8">
                            <select name="id_tahun" class="form-control">
                                <?php
                        foreach($tahun->result() as $thn)
                        {
                          echo "<option value='$thn->id_tahun'";
                          if($thn->id_tahun==$sidthn){echo "selected";}
                          echo ">$thn->tahun</option>";
                        }
                        ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="aksi" class="col-md-3 control-label"></label>
                        <div class="col-md-8">
                            <input type="submit" name="submit" value="FILTER DATA" class="btn btn-block btn-danger" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /form set data -->
    <?php
if($mode_form=='update'){?>
    <div class="alert alert-secondary" role="alert">
        <h4>
            Data Nilai Dan Ketrampilan - Mata Pelajaran = <strong>
                <?php echo $nama_pelajaran;?>
            </strong> - Kelas:
            <strong> <?php echo $nama_kelas;?></strong>
        </h4>
    </div>
    <div class="box">
        <form id="mainform" action="<?php echo base_url('admin_editnilai/proses_input_nilai');?>" method="post">
            <div class="box-body no-padding">
                <table class="table table-responsive table-hover">
                    <tr class="bg-primary text-center text-white">
                        <th>No</th>
                        <th>Nomor Induk Siswa</th>
                        <th>Nama lengkap</th>
                        <th> &nbsp; &nbsp;Nilai Pengetahuan</th>
                        <th> &nbsp; &nbsp;Nilai Ketrampilan</th>
                    </tr>
                    <?php
            $i = 1;
            foreach($nilai_pk->result_array() as $row){
              ?>
                    <?php echo "<input type='hidden' name='id_nilai[]' value='".$row['id_nilai']."' />"; ?>
                    <tr>
                        <td>
                            <center><?php echo $i++;?></center>
                        </td>
                        <td><?php echo $row['nis'];?></td>
                        <td><?php echo $row['nama_siswa'];?></td>
                        <td><?php echo "<input  class=\"form-control\" type='text' name='nilai_pengetahuan[]' size='4' value='".$row['nilai_pengetahuan']."'/>"; ?>
                        </td>
                        <td><?php echo "<input  class=\"form-control\" type='text' name='nilai_ketrampilan[]' size='4' value='".$row['nilai_ketrampilan']."'/>"; ?>
                        </td>
                    </tr>
                    <?php
            }
              $jumSis = $nilai_pk->num_rows();
            ?>
                    <tr>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> &nbsp; &nbsp; <input type="hidden" name="jumlah" value="<?php echo $jumSis ?>" /><input
                                type="submit" value="Simpan Perubahan" name="update_nilai" class="btn btn-primary" />
                            &nbsp; - &nbsp;<a
                                onclick="return confirm('Perubahan belum disimpan,apakah Anda yakin batal mengubah?')"
                                href="<?php echo base_url('admin_editnilai/edit_nilai_peng_ketr?m=edit_nilai&sm=nilai_peng_ketr');?>"
                                button class="btn btn-danger" /><small class="glyphicon glyphicon-chevron-left"></small>
                            Batal</a>
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
  else
  {?>
    <div class="alert alert-secondary" role="alert">
        <h4>
            Data Nilai Dan Ketrampilan - Mata Pelajaran = <strong>
                <?php echo $nama_pelajaran;?>
            </strong> - Kelas:
            <strong> <?php echo $nama_kelas;?></strong>
        </h4>
    </div>
    <div class="box">
        <form id="mainform" action="<?php echo base_url('admin_editnilai/proses_input_nilai');?>" method="post"
            class="form-inline">
            <div class="box-body no-padding">
                <table class="table table-responsive table-hover">
                    <tr class="bg-primary text-center text-white">
                        <th>No</th>
                        <th>Nomor Induk Siswa</th>
                        <th>Nama lengkap</th>
                        <th> &nbsp; &nbsp;Nilai Pengetahuan</th>
                        <th> &nbsp; &nbsp;Nilai Ketrampilan</th>
                    </tr>
                    <input type="hidden" name="id_pelajaran" value="<?php echo $id_pelajaran;?>" />
                    <input type="hidden" name="id_kelas" value="<?php echo $id_kelas;?>" />
                    <input type="hidden" name="id_tahun" value="<?php echo $id_tahun;?>" />
                    <input type="hidden" name="id_semester" value="<?php echo $id_semester;?>" />
                    <?php
            $i = 1;
            foreach($nilai_pk->result_array() as $row){
              ?>
                    <input type="hidden" name="nis[]" value="<?php echo $row['nis'];?>" />
                    <tr>
                        <td>
                            <center><?php echo $i++;?></center>
                        </td>
                        <td><?php echo $row['nis'];?></td>
                        <td><?php echo $row['nama_siswa'];?></td>
                        <td><?php echo "<input  class=\"form-control\" type='text' name='nilai_pengetahuan[]' size='4' />"; ?>
                        </td>
                        <td><?php echo "<input  class=\"form-control\" type='text' name='nilai_ketrampilan[]' size='4' />"; ?>
                        </td>
                    </tr>
                    <?php
            }
              $jumSis = $nilai_pk->num_rows();
            ?>
                    <tr>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> &nbsp; &nbsp;
                            <select name="id_guru" class="form-control select2" required>
                                <option value="">Pilih Guru</option>
                                <?php foreach($guru->result() as $gr){
                            echo "<option value='$gr->id_guru'>$gr->nama_guru</option>";
                          }
                          ?>
                            </select>
                            <div class="form-group">
                                <input type="hidden" name="jumlah" value="<?php echo $jumSis ?>" /><input type="submit"
                                    value="Simpan" name="input_nilai" class="btn btn-primary" />
                            </div>
                            &nbsp; - &nbsp;<a
                                onclick="return confirm('Perubahan belum disimpan,apakah Anda yakin batal mengubah?')"
                                href="<?php echo base_url('admin_editnilai/edit_nilai_peng_ketr?m=edit_nilai&sm=nilai_peng_ketr');?>"
                                button class="btn btn-danger" /><small class="glyphicon glyphicon-chevron-left"></small>
                            Batal</a>
                        </td>
                    </tr>
                </table>
                <br>
            </div><!-- /.box-body -->
        </form>
    </div><!-- /.box -->
    <?php
  }
  ?>