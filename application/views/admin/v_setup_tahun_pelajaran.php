
  <!-- Content Header (Page header) -->
          <?php include('application/views/section_header.php');?>

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
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-plus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              	<form action="<?php echo base_url('admin/create_tahun_pelajaran');?>" method="post" class="form-horizontal">
              		<div class="form-group">
              			<label class="col-md-3 control-label">Tahun Pelajaran</label>
              			<div class="col-md-5">
              				<input type="text" class="form-control" name="tahun"/>
              			</div>
              		</div>

              		<div class="form-group">
              			<label for="aksi" class="col-md-3 control-label"></label>
              			<div class="col-md-5">
              				<input type="submit" name="submit" value="Tambah" class="btn btn-primary" /> <input type="reset" value="Reset"  class="btn btn-danger" />
              			</div>
              		</div>
 	         		
				</form>
								
            </div>
          
          </div>
		  <!-- /data kelas -->
    </section>
    <section class="content">
      <div class="row">
       <div class="col-md-6">
        <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Daftar Tahun Pelajaran</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              
        <form action="<?php echo base_url('admin/aksi_tahun/?m=setup&sm=tahun_pelajaran');?>" method="post">
          <div class="table-responsive">
        <table id="example1" class="table table-bordered">
        <thead>
        <tr>
          <th style="width:5%;">#</th>
          <th style="width:5%;">No</th>
          <th style="width:45%;">Tahun Pelajaran</th>
          <th style="width:45%;">Status</th>
          <th style="width:15%;">Aksi</th>
        </tr>
        </thead>
        
        <?php
        //$no=$this->uri->segment(3)+1;
        $no=1;
        foreach($thn_pelajaran->result_array() as $row){
        ?>  
        <tr>
          <td><div class="checkbox icheck"><input type="checkbox" name="check[]" value="<?php echo $row['id_tahun'] ;?>"></div></td>
          <td><?php echo $no++;?></td>
          <td><?php echo $row['tahun'];?></td>
          <td><?php if($row['status_aktif']==1){echo "Aktif";}else{echo "Tidak Aktif";}?></td>
          <td align="center"><a href="<?php echo base_url('admin/edit_tahun/'.$row['id_tahun'].'?m=setup&sm=tahun_pelajaran');?>"  class="btn btn-primary" title="Edit"> <i class="fa fa-pencil-square"></i> </a> &nbsp; 
                           <?php /*<a href="<?php echo base_url('admin/drop_mapel/'.$row['id_pelajaran'].'');?>"  class="btn btn-danger" title="Hapus" onclick="return konfirmasi();"> <i class="fa fa-trash"></i> </a>*/?>
          </td>
        </tr>
        <?php
        }
        ?>
        </table>
        <br>
        <!--<center><?php //echo $pagination;?></center>-->

        <hr>
        <h4>Aksi dengan data yang dipilih :</h4>
        <!--<button class="btn btn-danger btn-sm" type="submit" name="multidelete" onclick="return konfirmasi();"><i class="fa fa-trash"></i> Hapus Mata Pelajaran</button>-->
        <button class="btn btn-primary btn-sm" type="submit" name="multiedit"><i class="fa fa-pencil-square"></i> Edit Tahun Pelajaran</button> <button class="btn btn-success btn-sm" type="submit" name="onkan"><i class="fa fa-check-circle"></i> Aktifkan Tahun Pelajaran</button>
        <br><br>
        </div>
        <!--  end product-table................................... --> 
        </form>
        
        
            </div><!-- /.box-body -->
          
          </div>
       </div>
       <div class="col-md-6">
        <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Set Semester Aktif</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
            
        <form action="<?php echo base_url('admin/set_semester');?>" method="post" class="form-horizontal">
        <div class="form-group">
          <label class="col-md-2">Semester</label>
          <div class="col-md-5">
            <select name="semester" class="form-control">
              <?php
              $rowsem = $semester->row();?>
              <option value="1" <?php if($rowsem->id_semester==1){echo "selected";}?>>Ganjil</option>
              <option value="2" <?php if($rowsem->id_semester==2){echo "selected";}?>>Genap</option>
              
            </select>
          </div>
        </div>
         <div class="form-group">
          <label class="col-md-2 control-label"></label>
          <div class="col-md-5">
            <button type="submit" name="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Simpan</button>  
            </select>
          </div>
        </div>
        
        </form>
        
            </div><!-- /.box-body -->
          
          </div>
       </div>
      </div>
		 
 </section>		  
