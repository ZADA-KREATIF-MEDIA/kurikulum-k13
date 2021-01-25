
  <!-- Content Header (Page header) -->
          <?php include('application/views/section_header.php');?>

 <section class="content">
 	 <div class="row">
            <div class="col-sm-12">
              <?php
              echo $this->session->flashdata('error_open').$this->session->flashdata('validation_errors').$this->session->flashdata('error_close');
              echo $this->session->flashdata('sukses');?>
            </div>
          </div>
   <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              	<form action="<?php echo base_url('admin/update_mapel');?>" method="post" class="form-horizontal">
 	         	
                  	<?php
                  	$form=1;
                  	foreach ($select_mapel->result() as $row){?>
                <div class="form-group">
								<label class="col-md-3 control-label"><?php echo "Form ".$form++;?></label>
                </div>
              
             <div class="form-group">
                <label class="col-md-3 control-label">Kategori Mata Pelajaran</label>
                <div class="col-md-5">
							   <input type="hidden" name="id_pelajaran[]" value="<?php echo $row->id_pelajaran;?>">
							   <select class="form-control" name="kat_mapel[]">
                <?php foreach($kat_mapel->result() as $km){
                  echo "<option value='$km->id_kat_mapel'"; if($km->id_kat_mapel==$row->id_kat_mapel){echo "selected";} echo ">$km->kategori_mapel</option>";
                }
                ?>
                </select>
              </div>
            </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Nama Mata Pelajaran</label>
                <div class="col-md-5">
                
                <input type="text" class="form-control" name="nama_pelajaran[]" value="<?php echo  $row->nama_pelajaran;?>" size="30"/>
              </div>
            </div>
           <div class="form-group">
                    <label class="col-md-3 control-label">Sub Mata Pelajaran di</label>
                    <div class="col-md-5">
                      <select class="form-control" name="sub_mapel[]">
              <option value="" selected=""><em>Null</em></option>
              <?php foreach($datamapel->result() as $mpl){
                 echo "<option value='$mpl->id_pelajaran'";
                  if($mpl->id_pelajaran==$row->sub_mapel){ echo "selected";}
                 echo ">$mpl->nama_pelajaran</option>";
                  }
                

              ?>
              </select>
              <span class="help-block">Pilih <em>Null</em> jika tidak menjadi sub mata pelajaran</span>
                    </div>
                  </div>
													
						<?php } ?>
            <div class="form-group">
                
                <div class="col-md-5">
					
							<input type="submit" name="update" value="Simpan" class="btn btn-primary" />
            </div>
          </div>
                    
				</form>
								
            </div>
          
          </div>
		  <!-- /data kelas -->
		 
 </section>		  
