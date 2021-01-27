<?php
		
		$nama_guru=$guru->row('nama_guru');
		$id_guru=$guru->row('id_guru');
		$nama_kelas=$kelas->row('nama_kelas');
		$id_kelas=$kelas->row('id_kelas');
		$nama_pelajaran=$pelajaran->row('nama_pelajaran');
		$id_pelajaran=$pelajaran->row('id_pelajaran');
		//$nama_kategori=$kategori->row('kategori');
		//$id_kategori=$kategori->row('id_kategori');
		$id_tahun = $tahun;
		$id_semester = $semester->row('id_semester');

		?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-primary" role="alert">
                <h4>Data Saran-Saran/Keterangan Nilai Siswa</h4>
            </div>
            <div class="box">
                <div class="box-header">

                </div><!-- /.box-header -->
                <form id="mainform" action="<?php echo base_url('guru/proses_input_deskripsi');?>" method="post">
                    <div class="box-body no-padding table-responsive">
                        <table class="table table-bordered">
                            <tr class="bg-primary text-white text-center">
                                <th>No</th>
                                <th>NIS</th>
                                <th>Nama Siswa</th>
                                <th> &nbsp; &nbsp; Nilai</th>
                                <th> &nbsp; &nbsp; Aspek</th>
                                <th> &nbsp; &nbsp; Deskripsi</th>
                            </tr>
                            <input type="hidden" name="tahun" value="<?php echo $id_tahun;?>">
                            <input type="hidden" name="semester" value="<?php echo $id_semester;?>" />
                            <input type="hidden" name="id_pelajaran" value="<?php echo $id_pelajaran;?>">

                            <?php
						$i = 1;
						foreach($list_siswa->result_array() as $row){
							?>

                            <?php echo "<input type='hidden' name='id_nilai[]' value='".$row['idnilai']."' />"; ?>
                            <?php echo "<input type='hidden' name='nis[]' value='".$row['nilai_nis']."' />"; ?>

                            <tr class="text-center">
                                <td rowspan="2">&nbsp; <?php echo $i++;?></td>
                                <td rowspan="2">d<?php echo $row['nilai_nis'];?></td>
                                <td rowspan="2"><?php echo $row['nama_siswa'];?></td>
                                <td><?php //echo "<input type='text' name='nilai_pengetahuan[]' size='1' value='".$row['nilai_pengetahuan']."' disabled/>"; ?>

                                <h3><?= $row['nilai_pengetahuan'] ?></h3>
                                </td>
                                <td class="bg-dark text-white">Pengetahuan</td>
                                <td><textarea class="form-control" cols="50" name="desk_pengetahuan[]"
                                        placeholder="Saran/Keterangan Nilai Pengetahuan"><?php echo $row['pengetahuan'];?></textarea></td>
                            </tr>
                            <tr class="text-center">

                                <td><?php //echo "<input type='text' name='nilai_ketrampilan[]' size='1' value='".$row['nilai_ketrampilan']."' disabled/>"; ?>
                                <h3><?= $row['nilai_ketrampilan'] ?></h3>
                                </td>
                                <td class="bg-success text-white">Ketrampilan</td>
                                <td><textarea class="form-control" name="desk_ketrampilan[]" cols="50"
                                        placeholder="Saran/Keterangan Nilai Ketrampilan"><?php echo $row['ketrampilan'];?></textarea></td>
                            </tr>
                            <?php
							
						}
							$jumSis = $list_siswa->num_rows();
						?>


                            <tr>

                               

                                <td colspan="6"> &nbsp; &nbsp; <input type="hidden" name="jumlah"
                                        value="<?php echo $jumSis ?>" /><input type="submit" value="Simpan Perubahan"
                                        name="input_nilai" class="btn btn-primary" />
                                    &nbsp; - &nbsp;<a
                                        onclick="return confirm('Perubahan belum disimpan,apakah Anda yakin batal mengubah?')"
                                        href="<?php echo base_url('guru/input_deskripsi_nilai');?>" button
                                        class="btn btn-danger" /><small
                                        class="glyphicon glyphicon-chevron-left"></small> Batal</a>
                                </td>
                            </tr>

                        </table>
                        <br>
                    </div><!-- /.box-body -->
                </form>
            </div><!-- /.box -->
        </div>
    </div>
</section>