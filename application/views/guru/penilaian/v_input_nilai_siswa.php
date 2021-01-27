<?php
		$nama_guru=$guru->row('nama_guru');
		$id_guru=$guru->row('id_guru');
		$nama_kelas=$kelas->row('nama_kelas');
		$id_kelas=$kelas->row('id_kelas');
		$nama_pelajaran=$pelajaran->row('nama_pelajaran');
		$id_pelajaran=$pelajaran->row('id_pelajaran');
		$id_tahun = $tahun;
		$id_semester = $semester->row('id_semester');
if($mode_form=="input"){?>
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-primary" role="alert">
            <h4>Data Nilai Siswa</h4 </div>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title text-blue">
                </div><!-- /.box-header -->
                <form id="mainform" action="<?php echo base_url('guru/proses_input_nilai');?>" method="post">
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
						foreach($list_siswa->result_array() as $row){
							?>
                            <input type="hidden" name="tahun" value="<?php echo $id_tahun;?>">
                            <input type="hidden" name="id_guru" value="<?php echo $id_guru;?>" />
                            <input type="hidden" name="id_pelajaran" value="<?php echo $id_pelajaran;?>" />
                            <input type="hidden" name="id_kelas" value="<?php echo $id_kelas;?>" />
                            <!--<input type="hidden" name="id_kategori" value="<?php //echo $id_kategori;?>" />-->
                            <input type="hidden" name="semester" value="<?php echo $id_semester;?>" />
                            <?php echo "<input type='hidden' name='nis[]' value='".$row['nis']."' />"; ?>
                            <tr>
                                <td>&nbsp; <?php echo $i++;?></td>
                                <td><?php echo $row['nis'];?></td>
                                <td><?php echo $row['nama_siswa'];?></td>
                                <td align=left>
                                    <?php echo "<input type='text' name='nilai_pengetahuan[]' size='4' class=\"form-control\" placeholder=\"0\" />"; ?>
                                </td>
                                <td align=left>
                                    <?php echo "<input type='text' name='nilai_ketrampilan[]' size='4' class=\"form-control\" placeholder=\"0\" />"; ?>
                                </td>
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
                                <td> &nbsp; &nbsp; <input type="hidden" name="jumlah"
                                        value="<?php echo $jumSis ?>" /><input type="submit" value="Simpan"
                                        name="input_nilai" class="btn btn-primary" />
                                    &nbsp; - &nbsp;<a
                                        onclick="return confirm('Data belum disimpan,apakah Anda yakin batal?')"
                                        href="<?php echo base_url('guru/input_nilai');?>" button
                                        class="btn btn-danger" /><small
                                        class="glyphicon glyphicon-chevron-left"></small>
                                    Batal</a>
                                </td>
                            </tr>
                        </table>
                    </div><!-- /.box-body -->
                </form>
            </div><!-- /.box -->
        </div>
    </div>
    <?php
}else{?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-primary" role="alert">
                <h4>Data Nilai Siswa</h4>
            </div>
            <div class="box">
                <div class="box-header">
                </div><!-- /.box-header -->
                <form id="mainform" action="<?php echo base_url('guru/proses_input_nilai');?>" method="post">
                    <div class="box-body no-padding table-responsive">
                        <table class="table table-bordered table-hover">
                            <tr class="bg-primary text-white">
                                <th>No</th>
                                <th>NIS</th>
                                <th>Nama Siswa</th>
                                <th>Nilai Pengetahuan</th>
                                <th>Nilai Ketrampilan</th>
                            </tr>
                            <?php
						$i = 1;
						foreach($list_siswa->result_array() as $row){
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
							$jumSis = $list_siswa->num_rows();
						?>
                            <tr>
                                <td colspan="6 "> &nbsp; &nbsp; <input type="hidden" name="jumlah"
                                        value="<?php echo $jumSis ?>" /><input type="submit" value="Simpan Perubahan"
                                        name="update_nilai" class="btn btn-primary" />
                                    &nbsp; - &nbsp;<a
                                        onclick="return confirm('Perubahan belum disimpan,apakah Anda yakin batal mengubah?')"
                                        href="<?php echo base_url('guru/input_nilai');?>" button
                                        class="btn btn-danger" /><small
                                        class="glyphicon glyphicon-chevron-left"></small>
                                    Batal</a>
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