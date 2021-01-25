<?php
$m = $this->input->get('m');
$sub = $this->input->get('sm');
$sub2 = $this->input->get('ssm');
$geturl = "?m=$m&sm=$sub&ssm=$sub2";
?>
  <!-- Content Header (Page header) -->
          <?php include('application/views/section_header.php');?>

 <section class="content">
 	 <div class="row">
            <div class="col-sm-12">
              <?php
              echo $this->session->flashdata('notif');?>
            </div>
          </div>
      <!-- Sortir Data-->
      
      
		  <!-- /data pembagian kelas -->
      
		 <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Sorting Data Tahun Ajaran <?php echo $pd_tahun." Semester ".ucwords($pd_semester); ?></h3><br> 
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
           
            </div>
            
            <div class="box-body">
            	<div class="col-md-12">
                
                <form class="form-inline" method="post" action="<?php echo base_url(uri_string().$geturl);?>">

                <div class="form-group">
                  <label><i class="fa fa-filter"></i> Filter : </label>
                </div>
                <div class="form-group">
          <label for="kelas">Kelas</label>
          <select name="kelas" class="form-control input-sm">
            
            <!-- data kelas -->
            <?php foreach($kelas->result() as $row_kelas){?>
              <option value="<?php echo $row_kelas->id_kelas;?>" <?php if($this->session->userdata('ses_lapnilai_kelas')==$row_kelas->id_kelas){echo "selected";}?>><?php echo $row_kelas->nama_kelas;?></option>
            <?php } ?>
          </select>
        </div>
         <div class="form-group">
                  <label for="tahun">Pilih Semester</label>
                  <select name="semester" class="form-control input-sm">
                    
                    <?php foreach($semester->result() as $sms){?>
                    <option value="<?php echo $sms->id_semester;?>" <?php if($this->session->userdata('ses_lapnilai_sms')==$sms->id_semester){echo "selected";}?>><?php echo $sms->semester;?></option>
                  <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="tahun">Pilih Tahun</label>
                  <select name="tahun" class="form-control input-sm">
                    
                    <?php foreach($tahun->result() as $tp){?>
                    <option value="<?php echo $tp->id_tahun;?>" <?php if($this->session->userdata('ses_lapnilai_thn')==$tp->id_tahun){echo "selected";}?>><?php echo $tp->tahun;?></option>
                  <?php } ?>
                  </select>
                </div>
               
                <button type="submit" name="sort_lap_nilai" class="btn btn-primary btn-sm">Tampil</button>
              </form>
              <br>
			
					<div class="table-responsive">
				<table id="example1" class="table table-bordered table-hover no-padding" >
          <thead>
                    <tr bgcolor=#fafafa>
            
          <th width="5%" align="center">No </th>
          <th width="10%" align="center">NIS</th>
          <th width="20%" align="center">Nama Siswa</th>
          <th width="10%" align="center">Kelamin</th>
          <th width="15%" align="center">Kelas</th>
           <th width="20%" align="center">Cetak</th>
        </tr>
         </thead>
        <tbody>
        <?php
        $no=1;
        foreach($rapor_siswa->result_array() as $row){
        ?>  
        <tr>
        
          <td align="center"><?php echo $no++;?></td>
          <td align="center"><?php echo $row['nis'];?></td>
          <td><?php echo $row['nama_siswa'];?></td>
          <td align="center"><?php echo $row['kelamin'];?></td>
          <td align="center"><?php echo $row['nama_kelas'];?></td>
                   
          <td align="center">
            <?php if($halaman=="depan"){?>
            <a href="<?php echo base_url('cetak/sampul_depan/'.$row['nis']);?>" class="btn btn-success btn-sm" target="_blank"> <i class="fa fa-print"></i> Cetak Sampul</a>   
          <?php }else{?>
            <a href="<?php echo base_url('cetak/identitas/'.$row['nis']);?>" class="btn btn-success btn-sm" target="_blank"> <i class="fa fa-print"></i> Cetak Identitas</a>   
          <?php } ?>
          </td>
        </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
   
				</div>

				
				</div>
				
            </div><!-- /.box-body -->
          
          </div>
    
      

 </section>		  
