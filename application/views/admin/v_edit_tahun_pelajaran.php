
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
              <h3 class="box-title"></h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              	<form action="<?php echo base_url('admin/update_tahun');?>" method="post">
 	         		<div class="table-responsive">
                  <table border="0" cellpadding="0" cellspacing="0" >
                  	<?php
                  	$form=1;
                  	foreach ($select_tahun->result() as $row){?>
                  		<tr>
								<td colspan="2"><b><?php echo "Form ".$form++;?></b></td>
							</tr>
                    <tr>
							<td valign="top">Tahun Pelajaran &nbsp; </td><td>
								<input type="hidden" name="id_tahun[]" value="<?php echo $row->id_tahun;?>">
							<input type="text" class="form-control" name="tahun[]" value="<?php echo  $row->tahun;?>" size="30"/></td></tr>
													
						<?php } ?>
						<tr>
							<td><br></td><td> &nbsp;<br> 
							<input type="submit" name="update" value="Simpan" class="btn btn-primary" />
                      </td>
                       
                    </tr>
                  </table>
              		</div>
           
				</form>
								
            </div>
          
          </div>
		  <!-- /data kelas -->
		 
 </section>		  
