<section class="content">
    <div class="row">
        <div class="col-sm-12">
            <?php
            echo $this->session->flashdata('notif'); ?>
        </div>
    </div>
    <div class="box">
        <div class="box-header with-border">
            <div class="d-flex justify-content-between">
                <h3 class="card-title mb-0">DATA KKM KELAS SD SANTA MARIA TIMIKA TAHUN <?php echo $pd_tahun; ?></h3>
                <hr>

            </div>
        </div>
        <div class="box-body">
            <div class="col-md-12 col-md-offset-2">
                <form action="<?php echo base_url('admin/set_kkm'); ?>" method="post" class="form-inline">
                    <div class="form-group">
                        <label>Tahun Ajaran</label>
                        <select class="form-control input-sm" name="idtahun">
                            <?php foreach ($tahun_ajaran->result() as $ta) {
                                echo "<option value='$ta->id_tahun'>$ta->tahun</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <input type="submit" name="submit" value="Set KKM" class="btn btn-primary btn-sm" />
                </form>
            </div>
        </div>
    </div>
    <!-- /data kelas -->
    <br>
    <div class="box">

        <div class="box-body">
            <div class="col-md-12">
                <?php
                if (!empty($type_form) && $type_form == "update") { ?>
                    <form action="<?php echo base_url('admin/aksi_kkm/?m=setup&sm=kkm'); ?>" method="post">
                        <div>
                            <table class="table table-striped table-bordered table-responsive">
                                <thead>
                                    <tr class="bg-primary text-white text-center">
                                        <th style="width:10%;">No</th>
                                        <th style="width:20%;">Mata Pelajaran</th>
                                        <th style="width:20%;">KKM</th>
                                    </tr>
                                </thead>
                                <?php
                                //$no=$this->uri->segment(3)+1;
                                $no = 1;
                                foreach ($tbl_kkm->result_array() as $row) {
                                ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <input type="hidden" name="idkkm[]" value="<?php echo $row['id_kkm']; ?>">
                                        <input type="hidden" name="idtahun[]" value="<?php echo $row['id_tahun']; ?>">
                                        <td><input type="hidden" name="idpelajaran[]" value="<?php echo $row['id_pelajaran']; ?>"><?php echo $row['nama_pelajaran']; ?>
                                        </td>
                                        <td><input type="text" name="kkm[]" value="<?php echo $row['kkm']; ?>" class="form-control" /></td>
                                    </tr>
                                <?php
                                }
                                $ib = $no++;
                                ?>
                                <?php
                                if ($mapel_notset->num_rows() > 0) {
                                    foreach ($mapel_notset->result() as $mpl) { ?>
                                        <tr bgcolor="#f3f3f3">
                                            <td><?php echo $ib++; ?></td>
                                            <input type="hidden" name="idtahun2[]" value="<?php echo $id_tahun; ?>">
                                            <td><input type="hidden" class="form-control" name="idpelajaran2[]" value="<?php echo $mpl->id_pelajaran; ?>"><?php echo $mpl->nama_pelajaran; ?></td>
                                            <td><input type="hidden" name="kategori_kls2[]" value="<?php echo $kategori_kls; ?>"><?php echo $kategori_kls; ?></td>
                                            <td><input type="text" name="kkm2[]" class="form-control" /></td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </table>
                            <hr>
                            <button class="btn btn-primary btn-sm" type="submit" name="update"><i class="fa fa-save"></i>
                                SIMPAN PERUBAHAN</button>
                            <br><br>
                        </div>
                        <!--  end product-table................................... -->
                    </form>
                <?php
                } else { ?>
                    <form action="<?php echo base_url('admin/aksi_kkm/?m=setup&sm=kkm'); ?>" method="post">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width:10%;">No</th>
                                        <th style="width:30%;">Mata Pelajaran</th>
                                        <th style="width:20%;">Kategori Kelas</th>
                                        <th style="width:30%;">KKM</th>
                                    </tr>
                                </thead>
                                <?php
                                //$no=$this->uri->segment(3)+1;
                                $no = 1;
                                foreach ($tbl_kkm->result_array() as $row) {
                                ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <input type="hidden" name="idtahun[]" value="<?php echo $id_tahun; ?>">
                                        <td><input type="hidden" name="idpelajaran[]" value="<?php echo $row['id_pelajaran']; ?>"><?php echo $row['nama_pelajaran']; ?>
                                        </td>
                                        <td><input type="hidden" name="kategori_kls[]" value="<?php echo $kategori_kls; ?>"><?php echo $kategori_kls; ?></td>
                                        <td><input type="text" name="kkm[]" class="form-control" /></td>
                                    </tr>
                                <?php
                                }
                                ?>
                                <hr>
                                <button class="btn btn-primary btn-sm" type="submit" name="input"><i class="fa fa-save"></i>
                                    SIMPAN</button>
                                <br><br>
                            </table>
                        </div>
                        <!--  end product-table................................... -->
                    </form>
                <?php
                }
                ?>
            </div>
        </div><!-- /.box-body -->
    </div>
</section>