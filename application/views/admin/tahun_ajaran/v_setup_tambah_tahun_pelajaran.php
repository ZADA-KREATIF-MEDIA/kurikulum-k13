<section class="content">
    <div class="row">
        <div class="col-sm-12">
        <?php
        echo $this->session->flashdata('notif');?>
        </div>
    </div>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Tambah Tahun Pelajaran</h3>
            <hr>
        </div>
        <div class="box-body">
            <form action="<?php echo base_url('admin/create_tahun_pelajaran');?>" method="post" class="form-horizontal">
                <div class="form-group">
                    <label>Tahun Pelajaran</label>
                    <input type="text" class="form-control" name="tahun"/>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Tambah" class="btn btn-primary" /> <input type="reset" value="Reset"  class="btn btn-danger" />
                </div>
            </form>						
        </div>        
    </div>
</section>