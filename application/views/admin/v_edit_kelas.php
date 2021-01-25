
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
              	<form action="<?php echo base_url('admin/update_kelas');?>" method="post">
 	         		<div class="table-responsive">
                  <table border="0" cellpadding="0" cellspacing="0" >
                  	<?php
                  	$form=1;
                  	foreach ($select_kelas->result() as $row){?>
                  		<tr>
								<td colspan="2"><b><?php echo "Form ".$form++;?></b></td>
							</tr>
                    <tr>
							<td valign="top">Nama Kelas &nbsp; </td><td>
								<input type="hidden" name="id_kelas[]" value="<?php echo $row->id_kelas;?>">
							<input type="text" class="form-control" name="nama_kelas[]" value="<?php echo  $row->nama_kelas;?>" /><br> </td></tr>
							<tr>
							<td valign="top">Kategori Kelas &nbsp; </td>
							<td valign="top">
							<select name="kategori_kls[]"  class="form-control" >
							<option <?php if($row->kategori_kls=="10-ipa"){echo "selected";}?>>10-ipa</option>
              <option <?php if($row->kategori_kls=="10-ips"){echo "selected";}?>>10-ips</option>
							<option <?php if($row->kategori_kls=="11-ipa"){echo "selected";}?>>11-ipa</option>
							<option <?php if($row->kategori_kls=="11-ips"){echo "selected";}?>>11-ips</option>
							<option <?php if($row->kategori_kls=="12-ipa"){echo "selected";}?>>12-ipa</option>
							<option <?php if($row->kategori_kls=="12-ips"){echo "selected";}?>>12-ips</option>
							</select><br>
							</td></tr>
							
						<?php } ?>
						<tr>
							<td></td><td> &nbsp; 
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
		  
<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
 
<tr>
    <td id="tbl-border-left"></td>
    <td>
    <!--  start content-table-inner ...................................................................... START -->
    <div id="content-table-inner">
    		

      	<!--  start product-table ..................................................................................... -->
       
        
        
	<div class="clear"></div>
     
    </div>
    <!--  end content-table-inner ............................................END  -->
    </td>
    <td id="tbl-border-right"></td>
</tr>
<tr>
    <th class="sized bottomleft"></th>
    <td id="tbl-border-bottom">&nbsp;</td>
    <th class="sized bottomright"></th>
</tr>
</table>
