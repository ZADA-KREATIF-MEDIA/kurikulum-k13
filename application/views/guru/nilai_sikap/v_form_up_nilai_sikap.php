<?php
		$nama_kelas=$kelas->row('nama_kelas');
		$id_kelas=$kelas->row('id_kelas');
		$id_tahun = $idtahun;
		$id_semester = $idsemester;
		?>
<!--  start step-holder -->

<section class="content">

    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-primary" role="alert">
                <h5 class="box-title text-blue">
                    <small class=" glyphicon glyphicon-chevron-right"></small> Kelas: <?php echo $nama_kelas;?>
                </h5>
            </div>
            <div class="box">
              
                <form id="mainform" action="<?php echo base_url('guru/simpan_nilai_sikap');?>" method="post">
                    <div class="box-body no-padding">
                        <table class="table table-striped table-responsive table-bordered">
                            <tr>
                                <th rowspan="2" class="text-center">No</th>
                                <th rowspan="2" class="text-center">NIS</th>
                                <th rowspan="2" class="text-center">Nama Siswa</th>
                                <th colspan="2" class="text-center"> &nbsp; &nbsp; Sikap Spiritual</th>
                                <th colspan="2" class="text-center"> &nbsp; &nbsp; Sikap Sosial</th>
                            </tr>
                            <tr>
                                <th class="text-center >Predikat</th>
                                <th class="text-center">Deskripsi</th>
                                <th class="text-center">Predikat</th>
                                <th class="text-center">Deskripsi</th>
                            </tr>
                            <input type="hidden" name="idkelas" value="<?php echo $id_kelas;?>" />
                            <input type="hidden" name="idwali" value="<?php echo $wali_id_wali;?>" />
                            <input type="hidden" name="idsemester" value="<?php echo $id_semester;?>" />
                            <input type="hidden" name="idtahun" value="<?php echo $id_tahun;?>" />
                            <?php
						$i = 1;
						foreach($nilai_sikap->result_array() as $row){
							?>
                            <?php echo "<input type='hidden' name='nis".$i."' value='".$row['nis']."' />"; ?>
                            <tr>
                                <td>&nbsp; <?php echo $i;?></td>
                                <td><?php echo $row['nis'];?></td>
                                <td><?php echo $row['nama_siswa'];?></td>
                                <td width="75"><?php echo "<select class=\"form-control\" name='a".$i."'>"; ?>
                                    <option value="A" <?php if($row['predikat_spiritual']=="A"){echo "selected";}?>>A
                                    </option>
                                    <option value="B"
                                        <?php if($row['predikat_spiritual']=="B" OR $row['predikat_spiritual']==""){echo "selected";}?>>
                                        B</option>
                                    <option <?php if($row['predikat_spiritual']=="C"){echo "selected";}?>>C</option>
                                    <option <?php if($row['predikat_spiritual']=="D"){echo "selected";}?>>D</option>
                                    </select>
                                </td>
                                <td><?php echo "<textarea class=\"form-control\" cols='50' name='b".$i."' placeholder='deskripsi spiritual'>".$row['sikap_spiritual']."</textarea>";?>
                                </td>
                                <td width="75"><?php echo "<select class=\"form-control\" name='c".$i."'>"; ?>
                                    <option value="A" <?php if($row['predikat_sosial']=="A"){echo "selected";}?>>A
                                    </option>
                                    <option value="B"
                                        <?php if($row['predikat_sosial']=="B" OR $row['predikat_sosial']==""){echo "selected";}?>>
                                        B</option>
                                    <option <?php if($row['predikat_sosial']=="C"){echo "selected";}?>>C</option>
                                    <option <?php if($row['predikat_sosial']=="D"){echo "selected";}?>>D</option>
                                    </select>
                                </td>
                                <td><?php echo "<textarea class=\"form-control\" cols='50' name='d".$i."' placeholder='deskripsi sosial'>".$row['sikap_sosial']."</textarea>";?>
                                </td>
                            </tr>
                            <?php
							$i++;
						}
						?>
                            <tr>
                                
                                <td colspan="7"> &nbsp; &nbsp; <input type="hidden" name="jumlah"
                                        value="<?php echo $jumSis ?>" /><input type="submit" value="Simpan"
                                        name="update" class="btn btn-primary" />
                                    &nbsp; - &nbsp;<a
                                        onclick="return confirm('Perubahan belum disimpan,apakah Anda yakin batal mengubah?')"
                                        href="<?php echo base_url('guru/input_nilai_sikap?m=input_nilai&sm=input_nilai_sikap');?>"
                                        button class="btn btn-danger" /><small
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
<!-- modal update nilai-->
<div class="modal fade" id="modal-default-up">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Upload File Excel Nilai Sikap</h4>
            </div>
            <form method="post" action="<?php echo base_url('import_excel/do_importup_sikap');?>"
                enctype="multipart/form-data" accept-charset="utf-8">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">File Upload</label>
                        <div class="col-md-5">
                            <input type="hidden" name="id_kelas" value="<?php echo $id_kelas;?>" />
                            <input type="hidden" name="id_wali" value="<?php echo $wali_id_wali;?>" />
                            <input type="hidden" name="semester" value="<?php echo $id_semester;?>" />
                            <input type="hidden" name="tahun" value="<?php echo $id_tahun;?>" />
                            <input type="hidden" name="back_url"
                                value="guru/input_nilai_sikap?m=input_nilai&sm=input_nilai_sikap">
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