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
		$nis = $nilai_ekstra->row('nis');
		$nama_siswa = $nilai_ekstra->row('nama_siswa');
		$gidtahun = $nilai_ekstra->row('id_tahun');
		$gidsemester = $nilai_ekstra->row('id_semester');
		$gidkelas = $nilai_ekstra->row('id_kelas');
		$gidwali = $nilai_ekstra->row('id_wali');
		$nama_kelas = $nilai_ekstra->row('nama_kelas');
	}
		?>
<!--  start step-holder -->
<div class="row">
    <div class="col-md-12">
        <?php echo $this->session->flashdata('notif');?>
    </div>
</div>
<div class="alert alert-primary" role="alert">
    <h4 class="box-title text-blue">DATA EKSTRAKURIKULER SISWA :
        <strong> - <?= $nis ?>- <?= $nama_siswa ?> - <?= $nama_kelas ?></strong></h3>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                <form method="post" action="<?php echo base_url('guru/simpan_nilai_ekstra');?>" class="form-horizontal">
                    <input type="hidden" name="idtahun" value="<?php echo $gidtahun;?>">
                    <input type="hidden" name="idsemester" value="<?php echo $gidsemester;?>" />
                    <input type="hidden" name="nis" value="<?php echo $nis;?>" />
                    <input type="hidden" name="idkelas" value="<?php echo $gidkelas;?>" />
                    <input type="hidden" name="idwali" value="<?php echo $gidwali;?>" />
                    <input type="hidden" name="back_url"
                        value="<?php echo uri_string().'/?set=update&m=input_nilai&sm=ekstra_kurikuler';?>" />
                    <?php
	                	if($type_form=="input")
	                	{
	                		for($i=1;$i<=10;$i++)
	                		{
	                			echo "<div class=\"form-group\">";
	                			echo "<label class=\"col-md-3 control-label\">Ekstra Kurikuler $i :</label>
	                					<div class=\"col-md-5\">";
	                			echo "<select name='ekstra".$i."' class=\"form-control\">";
	                			foreach($kegiatan_ekstra->result() as $ke)
	                			{
	                				echo "<option value='$ke->id_ekstra'>$ke->nama_ekstra</option>";
	                			}
	                			echo "</select>";
	                			echo "<input type='text' name='nilai".$i."' class='form-control' placeholder='nilai'/>
	                				<textarea class=\"form-control\" name='deskripsi".$i."' placeholder='Deskripsi...'></textarea>
	                			</div></div>";//.col-md-5 & .form-group
	                		}
	                	}
	                	else
	                	{
	                		$i=1;
	                		foreach($nilai_ekstra->result() as $ne)
	                		{
	                			echo "<div class=\"form-group\">";
	                			echo "<label class=\"col-md-3 control-label\">Ekstra Kurikuler $i :</label>
	                					<div class=\"col-md-5\">";
	                			echo "<input type='hidden' name='idekst[]' value='$ne->id_ekst'/>";
	                			echo "<select name='ekstra[]' class=\"form-control\">";
	                			foreach($kegiatan_ekstra->result() as $ke)
	                			{
	                				echo "<option value='$ke->id_ekstra' "; 
	                					if($ke->id_ekstra==$ne->id_ekstra){ echo "selected";}
	                				echo " >$ke->nama_ekstra</option>";
	                			}
	                			echo "</select>";
	                			echo "<input type='text' name='nilai[]' value='$ne->nilai' class='form-control' placeholder='nilai'/>
	                				<textarea class=\"form-control\" name='deskripsi[]' placeholder='Deskripsi...'>$ne->deskripsi</textarea>
	                			</div>
	                			<div class=\"col-md-4\"><a href='".base_url('guru/hapus_ekstra_siswa/'.$ne->id_ekst.'/?back='.uri_string().'?set=update&m=input_nilai&sm=ekstra_kurikuler')."' class='btn btn-md btn-danger' onclick='return konfirmasi();'><i class='fa fa-trash'></i> Hapus Ekstra Kurikuler $i</a></div>
	                			</div>";//.col-md-5 & .form-group
	                		$i++;	
	                		}
	                		echo "<hr>";
	                			echo "<div class=\"form-group\">";
	                			echo "<label class=\"col-md-3 control-label\">Tambah Ekstra Kurikuler :</label>
	                					<div class=\"col-md-5\">";
	                			echo "<select name='ekstra2' class=\"form-control\">";
	                			echo "<option value=''>Pilih kegiatan</option>";
	                			foreach($kegiatan_ekstra->result() as $ke)
	                			{
	                				echo "<option value='$ke->id_ekstra'>$ke->nama_ekstra</option>";
	                			}
	                			echo "</select>";
	                			echo "<input type='text' name='nilai2' class='form-control' placeholder='nilai'/>
	                				<textarea class=\"form-control\" name='deskripsi2' placeholder='Deskripsi...'></textarea>
	                			</div></div>";//.col-md-5 & .form-group
	                	}
	                	?>
                    <div class="form-group">
                        <label class="control-label col-md-3"></label>
                        <div class="col-md-5">
                            <?php echo $btnSubmit;?><br>
                            <a href="<?php echo base_url('guru/ekstra_kurikuler?m=input_nilai&sm=ekstra_kurikuler');?>"
                                class="btn btn-primary btn-md">Kembali</a>
                        </div>
                    </div>
                </form>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>
</section>