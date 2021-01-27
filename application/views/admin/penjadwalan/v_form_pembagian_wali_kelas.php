<div class="box">
    <div class="box-body">
        <h4>FORM PENAMBAHAN WALI KELAS</h4>
        <hr>
       
        <form action="<?php echo base_url('admin/set_wali_kelas');?>" method="post" class="form-horizontal"
            enctype="multipart/form-data">
            <div class="form-group">
                <label class="col-md-3 control-label">Guru</label>
                <div class="col-md-8">
                    <select class="form-control select2" style="width: 100%;" name="id_guru">
                        <!--<option selected="selected">Pilih Guru</option>-->
                        <?php
                    foreach($guru->result() as $row_guru){?>
                        <option value="<?php echo $row_guru->id_guru;?>"><?php echo $row_guru->nama_guru;?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <!-- /.form-group -->
            <div class="form-group">
                <label class="col-md-3 control-label">Tahun Pelajaran</label>
                <div class="col-md-8">
                    <select class="form-control select2" style="width: 100%;" name="id_tahun">
                        <!--<option selected="selected">Pilih Mata Pelajaran</option>-->
                        <?php
                    foreach($tahun_pelajaran->result() as $row_tahun){?>
                        <option value="<?php echo $row_tahun->id_tahun;?>"><?php echo $row_tahun->tahun;?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="kelas" class="col-md-3 control-label">Kelas</label>
                <div class="col-md-8">
                    <select name="id_kelas" class="form-control">
                        <?php
                      foreach($kelas->result() as $k){
                        echo "<option value='".$k->id_kelas."'>".$k->nama_kelas."</option>";
                      }?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="aksi" class="col-md-3 control-label"></label>
                <div class="col-md-8">
                    <input type="submit" name="submit" value="Tambah" class="btn btn-primary" />
                    <input type="reset" value="Reset" class="btn btn-danger" />
                </div>
            </div>
        </form>
    </div>
</div>