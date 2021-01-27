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
              <h3 class="box-title">Set Wali Kelas</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
                <form action="<?php echo base_url('admin/set_wali_kelas');?>" method="post" class="form-horizontal" enctype="multipart/form-data">
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
                    <label class="col-md-3 control-label">Tahun Pelajaran</label>
                    <div class="col-md-5">
                    <select class="form-control select2" style="width: 100%;" name="id_tahun">
                      <!--<option selected="selected">Pilih Mata Pelajaran</option>-->
                      <?php
                      foreach($tahun_pelajaran->result() as $row_tahun){?>
                      <option value="<?php echo $row_tahun->id_tahun;?>"><?php echo $row_tahun->tahun;?></option>
                    <?php } ?>
                    </select>
                  </div>
              </div>
                
                  
                  <div class="form-group">
                    <label for="kelas" class="col-md-3 control-label">Kelas</label>
                    <div class="col-md-5">
                      <select name="id_kelas"  class="form-control" >
                        <?php
                        foreach($kelas->result() as $k){
                          echo "<option value='".$k->id_kelas."'>".$k->nama_kelas."</option>";
                        }?>
                    
                      </select>
                    </div>
                  </div>
                


                  <div class="form-group">
                    <label for="aksi" class="col-md-3 control-label"></label>
                    <div class="col-md-5">
                      <input type="submit" name="submit" value="Tambah" class="btn btn-primary" />
                           <input type="reset" value="Reset"  class="btn btn-danger" />
                    </div>
                  </div>
              
           
        </form>
                
            </div>
          
          </div>
      

		  <!-- /data pembagian wali kelas -->
      
		 <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Daftar Pembagian Wali Kelas Tahun <?php echo $pd_tahun; ?></h3><br>
              <small>Data Sejumlah <?php echo number_format($jml_data);?></small>      
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>

              
            </div>
            
            <div class="box-body">
            	<div class="col-md-12">

                <form class="form-inline pull-center" method="post" action="<?php echo base_url('admin/penjadwalan_wali_kelas');?>">
                <div class="form-group">
                  <label><i class="fa fa-filter"></i> Filter : </label>
                </div>
                <div class="form-group">
                  <label for="tahun">Pilih Tahun</label>
                  <select name="tahun" class="form-control input-sm">
                    
                    <?php foreach($tahun_pelajaran->result() as $tp){?>
                    <option value="<?php echo $tp->id_tahun;?>" <?php if($this->session->userdata('ses_wali_thn')==$tp->id_tahun){echo "selected";}?>><?php echo $tp->tahun;?></option>
                  <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="total_rows">Data per halaman</label>
                  <select name="rows" class="form-control input-sm">
                    
                    <option value="5" <?php if($this->session->userdata('ses_wali_rows')=="5"){echo "selected";}?>>5</option>
                    <option value="10" <?php if($this->session->userdata('ses_wali_rows')=="10"){echo "selected";}?>>10</option>
                    <option value="25" <?php if($this->session->userdata('ses_wali_rows')=="25"){echo "selected";}?>>25</option>
                    <option value="50" <?php if($this->session->userdata('ses_wali_rows')=="50"){echo "selected";}?>>50</option>
                    <option value="100" <?php if($this->session->userdata('ses_wali_rows')=="100"){echo "selected";}?>>100</option>
                  </select>
                </div>
                <button type="submit" name="sort_wali_kelas" class="btn btn-primary btn-sm">Tampilkan</button>
              </form>
              <br>

				<form action="<?php echo base_url('admin/penjadwalan_wali_kelas');?>" method="post" class="form-inline">
					<div class="table-responsive">
				<table id="example2" class="table table-bordered table-hover no-padding" >
          <thead>
                    <tr bgcolor=#fafafa>
                      <th width="5%">#</th>
          <th width="5%">No </th>
          <th width="30%">Nama Guru</th>
          <th width="10%">NIP</th>
          <th width="10%">Wali Kelas</th>
          <th width="10%">Tahun Ajaran</th>
          <th width="10%">Aksi</th>
        </tr>
         </thead>
        <tbody>
        <?php
        $no=$this->uri->segment(3)+1;
        foreach($data->result_array() as $row){
        ?>  
        <tr>
          <td><div class="checkbox icheck"><input type="checkbox" name="check[]" value="<?php echo $row['id_wali'] ;?>"></div></td>
          <td><?php echo $no++;?></td>
          <td><a href="<?php echo base_url('admin/detail_guru/'.$row['id_guru'].'?m=data_induk&sm=guru');?>" title="Lihat detail guru"><?php echo $row['nama_guru'];?></a></td>
          <td><?php echo $row['nip'];?></td>
          <td><?php echo $row['nama_kelas'];?></td>
          <td><?php echo $row['tahun'];?></td>
          
          <td><a href="<?php echo base_url('admin/drop_wali/'.$row['id_wali'].'/'.$row['nama_guru'].'/'.$row['nama_kelas'].'');?>"  class="btn btn-danger" title="Hapus wali pada kelas ini" onclick="return konfirmasi();"> <i class="fa fa-trash"></i> </a>     
          </td>
        </tr>
        <?php
        }
        ?>
        
         
       
        </tbody>
        </table><br>
        <center><?php echo $pagination;?></center><hr>
        <h4>Aksi dengan data yang dipilih :</h4>
				<button class="btn btn-danger btn-sm" type="submit" name="multidelete" onclick="return konfirmasi();" style="margin-left: 10px;"><i class="fa fa-trash"></i> Hapus Wali</button>
				
				<br><br>
				</div>
        </form>
				<!--  end product-table................................... --> 
				
				</div>
				
            </div><!-- /.box-body -->
          
          </div>
    
      

 </section>		  
