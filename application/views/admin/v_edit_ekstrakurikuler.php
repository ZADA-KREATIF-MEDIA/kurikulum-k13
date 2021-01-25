
  <!-- Content Header (Page header) -->
          <?php include('application/views/section_header.php');?>

 <section class="content">
 	 <div class="row">
            <div class="col-sm-12">
              <?php echo $this->session->flashdata('notif');?>
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
              	<form action="<?php echo base_url('admin/update_ekstra');?>" method="post" class="form-horizontal">
 	         	
                  	<?php
                  	$form=1;
                  	foreach ($select_ekstra->result() as $row){?>
                <div class="form-group">
								<label class="col-md-3 control-label"><?php echo "Form ".$form++;?></label>
                </div>
           
              <div class="form-group">
                <label class="col-md-3 control-label">Ekstra Kurikuler</label>
                <div class="col-md-5">
                <input type="hidden" name="id_ekstra[]" value="<?php echo $row->id_ekstra;?>">
                <input type="text" class="form-control" name="nama_ekstra[]" value="<?php echo  $row->nama_ekstra;?>" size="30"/>
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
