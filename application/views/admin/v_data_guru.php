<section>
    <div class="box">
        <div class="row">
            <div class="col-sm-12">
                <?php
                echo $this->session->flashdata('notif'); ?>
            </div>
        </div>
        <div class="box-body">
            <div class="d-flex justify-content-between">
                <h3 class="card-title mb-0">DATA GURU SD SANTA MARIA TIMIKA</h3>
                <a href="<?= base_url() ?>admin/form_tambah_guru" class="btn btn-success"><small>TAMBAH DATA
                        GURU</small></a>
            </div>
            <br>
            <div class="col-md-12 grid-margin">
                <form action="<?php echo base_url('admin/aksi_guru'); ?>" method="post">
                    <div>
                        <table id="example2" class="table table-bordered table-hover no-padding table-responsive">
                            <thead>
                                <tr bgcolor=#fafafa>

                                    <th>No </th>
                                    <th width="24%">Nama Guru</th>
                                    <th width="10%">NIY/NIGK</th>
                                    <th width="7%">Kelamin</th>

                                    <th width="13%">Telpon</th>
                                    <th width="11%">Username</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = $this->uri->segment(3) + 1;
                                foreach ($data->result_array() as $row) {
                                ?>
                                    <tr>

                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $row['nama_guru']; ?></td>
                                        <td><?php echo $row['nip']; ?></td>
                                        <td><?php echo $row['kelamin']; ?></td>
                                        <td><?php echo $row['telpon_guru']; ?></td>
                                        <td><?php echo $row['username']; ?></td>
                                        <td><a href="<?php echo base_url('admin/edit_guru/' . $row['id_guru'] . '?m=data_induk&sm=guru'); ?>" class="btn btn-dark" title="Edit"> <i class="fa fa-edit"></i> </a> &nbsp;
                                            <a href="<?php echo base_url('admin/drop_guru/' . $row['id_guru'] . ''); ?>" class="btn btn-danger" title="Hapus" onclick="return konfirmasi();"> <i class="fa fa-trash"></i> </a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!--  end product-table................................... -->
                </form>
            </div>
        </div><!-- /.box-body -->
    </div>
</section>