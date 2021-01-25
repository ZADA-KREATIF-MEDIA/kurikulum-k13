
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
              <h3 class="box-title">Set KKM</h3>
             
            </div>
            <div class="box-body">
              <div class="col-md-8 col-md-offset-2">
								<form action="<?php echo base_url('admin/set_kkm');?>" method="post" class="form-inline">
                  <div class="form-group">
                    <label>Tahun Ajaran</label>
                      
                  <select class="form-control input-sm" name="idtahun">
                    <?php foreach($tahun_ajaran->result() as $ta){
                    echo "<option value='$ta->id_tahun'>$ta->tahun</option>";
                    }
                    ?>
                  </select>
                  </div>
              <div class="form-group">
                    <label>Kategori Kelas</label>
                     
                  <select class="form-control input-sm" name="kategori_kls">
                    <option value='10-ipa'>10-ipa</option>
                    <option value='10-ips'>10-ips</option>Daftar KKM 2018/2019 per mapel & kategori kelas
TOTAL : 0 DATA
                    <option value='11-ipa'>11-ipa</option>
                    <option value='11-ips'>11-ips</option>
                    <option value='12-ipa'>12-ipa</option>
                    <option value='12-ips'>12-ips</option>
                  </select>
               
              </div>
                  
                      <input type="submit" name="submit" value="Set KKM" class="btn btn-primary btn-sm" />
              
        </form>
      </div>
            </div>
          
          </div>
		  <!-- /data kelas -->
		 <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Daftar KKM <?php echo $pd_tahun;?> per mapel & kategori kelas</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
             
            </div>
            <div class="box-body">
              
            	<div class="col-md-12">
               <?php
               if(!empty($type_form) && $type_form=="update"){?>
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
					
				</tr>
				</thead>
				
				<?php
				//$no=$this->uri->segment(3)+1;
				$no=1;
				foreach($matapelajaran->result_array() as $row){
				?>	
				<tr>
					<td><div class="checkbox icheck"><input type="checkbox" name="check[]" value="<?php echo $row['id_kkm'] ;?>"></div></td>
					<td><?php echo $no++;?></td>
					<td><?php echo $row['nama_pelajaran'];?></td>
          <td><?php echo $row['kategori_kls'];?></td>
          <td><input type="text" name="kkm" value="<?php echo $row['kkm'];?>" class="form-control"/></td>
				
				</tr>
				<?php
				}
				?>
				</table>
				
				<hr>
			
				<button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-save"></i> SIMPAN PERUBAHAN</button>
				<br><br>
				</div>
				<!--  end product-table................................... --> 
				</form>
        <?php 
        }
        else
        {
          echo "kosong.....";
        }
        ?>

				</div>
				
            </div><!-- /.box-body -->
          
          </div>
 </section>		  
