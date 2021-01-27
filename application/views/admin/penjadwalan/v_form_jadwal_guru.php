<div class="box">
    <div class="box-header with-border">
    <h4>FORM PENAMBAHAN JADWAL GURU</h4>
        <hr>
       
    </div>
    <div class="box-body">
        <form action="<?php echo base_url('admin/set_jadwal_guru');?>" method="post" class="form-horizontal"
            enctype="multipart/form-data">
            <div class="form-group">
                <label class="col-md-3 control-label">Guru</label>
                <div class="col-md-5">
                    <select class="form-control select2" style="width: 100%;" name="id_guru">
                        <!--<option selected="selected">Pilih Guru</option>-->
                        <?php
                      foreach($guru->result() as $row_guru){?>
                        <option value="<?php echo $row_guru->id_guru;?>"><?php echo $row_guru->nama_guru;?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <!-- /.form-group -->
            <div class="form-group">
                <label class="col-md-3 control-label">Pelajaran</label>
                <div class="col-md-5">
                    <select class="form-control select2" style="width: 100%;" name="id_pelajaran">
                        <!--<option selected="selected">Pilih Mata Pelajaran</option>-->
                        <?php
                      foreach($mapel->result() as $row_mapel){?>
                        <option value="<?php echo $row_mapel->id_pelajaran;?>">
                            <?php echo $row_mapel->nama_pelajaran;?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="kelas" class="col-md-3 control-label">Kelas</label>
                <div class="col-md-5">
                    <select name="id_kelas" class="form-control">
                        <?php
                        foreach($kelas->result() as $k){
                          echo "<option value='".$k->id_kelas."'>".$k->nama_kelas."</option>";
                        }?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="tahun" class="col-md-3 control-label">Tahun</label>
                <div class="col-md-5">
                    <select name="tahun" class="form-control">
                        <?php
                        foreach($tahun->result() as $t){
                          echo "<option value='".$t->id_tahun."'>".$t->tahun."</option>";
                        }?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="semester" class="col-md-3 control-label">Semester</label>
                <div class="col-md-5">
                    <select name="semester" class="form-control">
                        <?php
                        foreach($semester->result() as $sem){
                          echo "<option value='".$sem->id_semester."'>".ucwords($sem->semester)."</option>";
                        }?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="aksi" class="col-md-3 control-label"></label>
                <div class="col-md-5">
                    <input type="submit" name="submit" value="Tambah" class="btn btn-primary" />
                    <input type="reset" value="Reset" class="btn btn-danger" />
                </div>
            </div>
        </form>
    </div>
</div>
<!-- /data kelas -->