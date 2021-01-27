<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php
              echo $this->session->flashdata('notif');?>
        </div>
    </div>

    <div class="box">
        <div class="box-header with-border">
            <div class="d-flex justify-content-between">
                <h3 class="card-title mb-0">DATA MATA PELAJAYAN YANG DI AMPU GURU <?php echo $pd_tahun; ?></h3>
                <a href="<?= base_url() ?>admin/form_tambah_jadwalguru" class="btn btn-success"><small>TAMBAH DATA
                        MAPEL</small></a>
            </div>
            <br>

        </div>
        <div class="box-body">
            <div class="col-md-12">
                <form class="form-inline" method="post"
                    action="<?php echo base_url('admin/jadwal_guru?m=penjadwalan&sm=guru_mengajar');?>">

                    <div class="form-group">
                        <label><i class="fa fa-filter"></i> Filter : </label>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <select name="kelas" class="form-control input-sm">

                            <!-- data kelas -->
                            <?php foreach($kelas->result() as $row_kelas){?>
                            <option value="<?php echo $row_kelas->id_kelas;?>"
                                <?php if($this->session->userdata('ses_mengajar_kelas')==$row_kelas->id_kelas){echo "selected";}?>>
                                <?php echo $row_kelas->nama_kelas;?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <select name="semester" class="form-control input-sm">

                            <?php foreach($semester->result() as $sm){?>
                            <option value="<?php echo $sm->id_semester;?>"
                                <?php if($this->session->userdata('ses_mengajar_semes')==$sm->id_semester){echo "selected";}?>>
                                <?php echo ucwords($sm->semester);?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tahun">Tahun</label>
                        <select name="tahun" class="form-control input-sm">

                            <?php foreach($tahun->result() as $tp){?>
                            <option value="<?php echo $tp->id_tahun;?>"
                                <?php if($this->session->userdata('ses_mengajar_thn')==$tp->id_tahun){echo "selected";}?>>
                                <?php echo $tp->tahun;?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="total_rows">Data per halaman</label>
                        <select name="rows" class="form-control input-sm">

                            <option value="5"
                                <?php if($this->session->userdata('ses_mengajar_rows')=="5"){echo "selected";}?>>5
                            </option>
                            <option value="10"
                                <?php if($this->session->userdata('ses_mengajar_rows')=="10"){echo "selected";}?>>10
                            </option>
                            <option value="25"
                                <?php if($this->session->userdata('ses_mengajar_rows')=="25"){echo "selected";}?>>25
                            </option>
                            <option value="50"
                                <?php if($this->session->userdata('ses_mengajar_rows')=="50"){echo "selected";}?>>50
                            </option>
                            <option value="100"
                                <?php if($this->session->userdata('ses_mengajar_rows')=="100"){echo "selected";}?>>100
                            </option>
                        </select>
                    </div>
                    <button type="submit" name="sort_jadwal_mengajar" class="btn btn-primary btn-sm">Tampilkan</button>
                </form>
                <br>
                <form action="<?php echo base_url('admin/jadwal_guru');?>" method="post">
                    <div class="table-responsive">
                        <table id="example2" class="table table-bordered table-hover no-padding">
                            <thead>
                                <tr bgcolor=#fafafa>

                                    <th>No </th>
                                    <th>Nama Guru</th>
                                    <th>NIP</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Kelas</th>
                                    <th>Semester</th>
                                    <th>Tahun</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
        $no=$this->uri->segment(3)+1;
        foreach($data->result_array() as $row){
        ?>
                                <tr>

                                    <td><?php echo $no++;?></td>
                                    <td><?php echo $row['nama_guru'];?></td>
                                    <td><?php echo $row['nip'];?></td>
                                    <td><?php echo $row['nama_pelajaran'];?></td>
                                    <td><?php echo $row['nama_kelas'];?></td>
                                    <td><?php echo ucwords($row['semester']);?></td>
                                    <td><?php echo $row['tahun'];?></td>

                                    <td><a href="<?php echo base_url('admin/edit_jadwal_guru/'.$row['id_jadwal'].'?m=penjadwalan&sm=guru_mengajar');?>"
                                            class="btn btn-primary" title="Edit"> <i class="fa fa-edit"></i>
                                        </a> &nbsp;
                                        <a href="<?php echo base_url('admin/drop_jadwal_guru/'.$row['id_jadwal'].'');?>"
                                            class="btn btn-danger" title="Hapus" onclick="return konfirmasi();"> <i
                                                class="fa fa-trash"></i> </a>
                                    </td>
                                </tr>
                                <?php
        }
        ?>
                            </tbody>
                        </table>
                        <br>
                        <center><?php echo $pagination;?></center>


                    </div>
                    <!--  end product-table................................... -->
                </form>
            </div>

        </div><!-- /.box-body -->

    </div>
</section>