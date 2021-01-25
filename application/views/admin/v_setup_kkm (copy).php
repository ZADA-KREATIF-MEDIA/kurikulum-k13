
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
              <h3 class="box-title">Tambah KKM</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              	<form action="<?php echo base_url('admin/create_kkm');?>" method="post" class="form-horizontal">
                  <div class="form-group">
                    <label class="col-md-3 control-label">Tahun Aajaran</label>
                      <div class="col-md-5">
                  <select class="form-control" name="tahunajaran">
                <?php foreach($tahun_ajaran->result() as $ta){
                echo "<option value='$ta->id_tahun'>$ta->tahun</option>";
                }
                ?>
              </select>
                </div>
              </div>
               <div class="form-group">
                    <label class="col-md-3 control-label">Mata Pelajaran</label>
                      <div class="col-md-5">
                  <select class="form-control select2" style="width: 100%;" name="mapel">
                <?php foreach($mapel->result() as $mp){
                echo "<option value='$mp->id_pelajaran'>$mp->nama_pelajaran</option>";
                }
                ?>
              </select>
                </div>
              </div>
              <div class="form-group">
                    <label class="col-md-3 control-label">Kategori Kelas</label>
                      <div class="col-md-5">
                  <select class="form-control" name="katkel">
                    <option value='10-ipa'>10-ipa</option>
                    <option value='10-ips'>10-ips</option>
                    <option value='11-ipa'>11-ipa</option>
                    <option value='11-ips'>11-ips</option>
                    <option value='12-ipa'>12-ipa</option>
                    <option value='12-ips'>12-ips</option>
                  </select>
                </div>
              </div>
              		<div class="form-group">
              			<label class="col-md-3 control-label">KKM</label>
              			<div class="col-md-5">
              				<input type="text" class="form-control" name="kkm" placeholder="00" />
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
		 <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Daftar KKM <?php echo $pd_tahun;?> per mapel & kategori kelas</h3>
              <br>
              TOTAL : <small><?php echo number_format($jml_data);?></small> DATA
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
             
            </div>
            <div class="box-body">
              <div class="col-md-7 col-xs-12 pull-right">
                 <form class="form-inline" method="post" action="<?php echo base_url('admin/setup_kkm');?>">
                 <div class="form-group">
                  <label for="tahun"><i class="fa fa-filter"></i> Filter : </label>
                 
                </div>
                <div class="form-group">
                  <label for="status">Pilih Tahun</label>
                  <select name="tahun" class="form-control input-sm">
                    <?php
                    foreach($tahun_ajaran->result() as $ta){?>
                      <option value="<?php echo $ta->id_tahun;?>" <?php if($ta->id_tahun==$this->session->userdata('ses_kkm_thn')){ echo "selected";}?>><?php echo $ta->tahun;?></option>
                    <?php
                    }
                    ?>                   
                  </select>
                </div>
                <div class="form-group">
                  <label for="jml_hlm">Data per halaman</label>
                  <select name="rows" class="form-control input-sm">
                    
                    <option value="5" <?php if($this->session->userdata('ses_kkm_rows')=="5"){echo "selected";}?>>5</option>
                    <option value="10" <?php if($this->session->userdata('ses_kkm_rows')=="10"){echo "selected";}?>>10</option>
                    <option value="25" <?php if($this->session->userdata('ses_kkm_rows')=="25"){echo "selected";}?>>25</option>
                    <option value="50" <?php if($this->session->userdata('ses_kkm_rows')=="50"){echo "selected";}?>>50</option>
                    <option value="100" <?php if($this->session->userdata('ses_kkm_rows')=="100"){echo "selected";}?>>100</option>
                  </select>
                </div>
                <button type="submit" name="sort_kkm" class="btn btn-primary btn-sm">Tampilkan</button>
              </form>
              <br>
              </div>
            	<div class="col-md-12">
               
				<form action="<?php echo base_url('admin/aksi_kkm/?m=setup&sm=kkm');?>" method="post">
					<div class="table-responsive">
				<table class="table table-bordered">
				<thead>
				<tr>
					<th style="width:5%;">#</th>
          <th style="width:10%;">No</th>
					<th style="width:5%;">Mata Pelajaran</th>
					<th style="width:45%;">Kategori Kelas</th>
          <th style="width:20%;">KKM</th>
					<th style="width:15%;">Aksi</th>
				</tr>
				</thead>
				
				<?php
				//$no=$this->uri->segment(3)+1;
				$no=1;
				foreach($data->result_array() as $row){
				?>	
				<tr>
					<td><div class="checkbox icheck"><input type="checkbox" name="check[]" value="<?php echo $row['id_kkm'] ;?>"></div></td>
					<td><?php echo $no++;?></td>
					<td><?php echo $row['nama_pelajaran'];?></td>
          <td><?php echo $row['kategori_kls'];?></td>
          <td><?php echo $row['kkm'];?></td>
					<td align="center"><a href="<?php echo base_url('admin/edit_kkm/'.$row['id_kkm'].'?m=setup&sm=kkm');?>"  class="btn btn-primary" title="Edit"> <i class="fa fa-pencil-square"></i> </a> &nbsp; 
           <a href="<?php echo base_url('admin/drop_kkm/'.$row['id_kkm'].'');?>"  class="btn btn-danger" title="Hapus" onclick="return konfirmasi();"> <i class="fa fa-trash"></i> </a>
					</td>
				</tr>
				<?php
				}
				?>
				</table>
				<br>
        <center><?php echo $pagination;?></center>

				<hr>
				<h4>Aksi dengan data yang dipilih :</h4>
				<button class="btn btn-danger btn-sm" type="submit" name="multidelete" onclick="return konfirmasi();"><i class="fa fa-trash"></i> Hapus KKM</button>
				<button class="btn btn-primary btn-sm" type="submit" name="multiedit"><i class="fa fa-pencil-square"></i> Edit KKM</button>
				<br><br>
				</div>
				<!--  end product-table................................... --> 
				</form>
				</div>
				
            </div><!-- /.box-body -->
          
          </div>
 </section>		  
