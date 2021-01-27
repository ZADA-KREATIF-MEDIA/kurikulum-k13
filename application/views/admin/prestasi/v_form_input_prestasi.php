<?php
			
		
		
	if($type_form=="input")
	{
		$btnSubmit = "<input type='submit' class='btn btn-primary btn-md' name='insert' value='Simpan'";
		$nis = $siswa->row('nis');
		$nama_siswa = $siswa->row('nama_siswa');
		$gidtahun = $idtahun;
		$gidsemester = $idsemester;
		$gidkelas = $idkelas;
		$gidwali = $idwali;
		$nama_kelas = $nama_kelas;
	}
	else
	{
		$btnSubmit = "<input type='submit' class='btn btn-primary btn-md' name='update' value='Simpan Perubahan'";
		$nis = $prestasi_siswa->row('nis');
		$nama_siswa = $prestasi_siswa->row('nama_siswa');
		$gidtahun = $prestasi_siswa->row('id_tahun');
		$gidsemester = $prestasi_siswa->row('id_semester');
		$gidkelas = $prestasi_siswa->row('id_kelas');
		$gidwali = $prestasi_siswa->row('id_wali');
		$nama_kelas = $prestasi_siswa->row('nama_kelas');

	}
	
		?>


<div class="row">
    <div class="col-md-12">
        <?php echo $this->session->flashdata('notif');?>
    </div>
</div>
<div class="alert alert-primary" role="alert">
    <h4 class="box-title text-blue">DATA PRESTASI SISWA :
        <strong> - <?= $nis ?>- <?= $nama_siswa ?> - <?= $nama_kelas ?></strong></h3>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">

            </div><!-- /.box-header -->

            <div class="box-body">
                <form method="post" action="<?php echo base_url('admin_editnilai/simpan_prestasi_siswa');?>"
                    class="form-horizontal">
                    <div class="form-group">

                        <div class="col-md-12">
                            <input type="hidden" name="idtahun" value="<?php echo $gidtahun;?>">
                            <input type="hidden" name="idsemester" value="<?php echo $gidsemester;?>" />
                            <input type="hidden" name="nis" value="<?php echo $nis;?>" />
                            <input type="hidden" name="idkelas" value="<?php echo $gidkelas;?>" />
                            <input type="hidden" name="idwali" value="<?php echo $gidwali;?>" />
                            <input type="hidden" name="back_url"
                                value="<?php echo uri_string().'/?set=update&m=edit_nilai&sm=prestasi';?>" />
                        </div>
                    </div>

                    <?php
	                	if($type_form=="input")
	                	{
	                		for($i=1;$i<=10;$i++)
	                		{
	                			echo "<div class=\"form-group\">";
	                			echo "<label class=\"col-md-3 control-label\">Prestasi $i :</label>
	                					<div class=\"col-md-12\">";
	                			echo "<input type='text' name='jenis".$i."' class=\"form-control\" placeholder='Jenis Kegiatan'>";
	                			echo "<textarea class=\"form-control\" name='ket".$i."' placeholder='Keterangan...'></textarea>
	                			</div></div>";//.col-md-8 & .form-group
	                		}
	                	}
	                	else
	                	{
	                		$i=1;
	                		foreach($prestasi_siswa->result() as $ps)
	                		{
	                			echo "<div class=\"form-group\">";
	                			echo "<label class=\"col-md-3 control-label\">Prestasi $i :</label>
	                					<div class=\"col-md-8\">";
	                			echo "<input type='hidden' name='idp[]' value='$ps->id_prestasi'/>";
	                			echo "<input type='text' name='jenis[]' value='$ps->jenis_kegiatan' class=\"form-control\">";
	                			echo "<textarea class=\"form-control\" name='ket[]' placeholder='Keterangan...'>$ps->keterangan</textarea>
	                			</div>
	                			<div class=\"col-md-4\"><a href='".base_url('admin_editnilai/hapus_prestasi_siswa/'.$ps->id_prestasi.'/?back='.uri_string().'?set=update&m=edit_nilai&sm=prestasi')."' class='btn btn-md btn-danger' onclick='return konfirmasi();'><i class='fa fa-trash'></i> Hapus Prestasi $i</a></div>
	                			</div>";//.col-md-8 & .form-group
	                		$i++;	
	                		}
	                		echo "<hr>";

	                			echo "<div class=\"form-group\">";
	                			echo "<label class=\"col-md-3 control-label\">Tambah Prestasi Siswa :</label>
	                					<div class=\"col-md-8\">";
	                			echo "<input type='text' name='jenis2' class=\"form-control\" placeholder='Jenis Kegiatan'>";
	                			echo "<textarea class=\"form-control\" name='ket2' placeholder='Keterangan...'></textarea>
	                			</div></div>";//.col-md-8 & .form-group

	                	}
	                	?>

                    <div class="form-group">
                        <label class="control-label col-md-3"></label>
                        <div class="col-md-12">
                            <?php echo $btnSubmit;?><br>

                            <a href="<?php echo base_url('admin_editnilai/edit_prestasi?m=edit_nilai&sm=prestasi');?>"
                                class="btn btn-primary btn-md">Kembali</a>
                        </div>
                    </div>

                </form>

            </div><!-- /.box-body -->

        </div><!-- /.box -->
    </div>
</div>