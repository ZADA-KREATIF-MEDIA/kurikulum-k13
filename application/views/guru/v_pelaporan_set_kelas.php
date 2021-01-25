<?php
//referensi:
if($input_type=="nilai"){
  $action = "guru/aksi_input_nilai?m=input_nilai&sm=pengetahuan_&_ketrampilan";
  $text_btn = "Isi / Update Nilai";
}
else
{
  $action = "guru/aksi_input_deskripsi?m=input_nilai&sm=pengetahuan_&_ketrampilan";
  $text_btn = "Isi / Update Deskripsi";
}

$id_guru = $this->session->userdata('id');
?>
<!--  start page-heading -->
<?php include('application/views/section_header.php');?>
<!-- end page-heading -->
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <?php echo $this->session->flashdata('notif');?>
        </div>
      </div>
      <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Pilih sesuai kelas yang anda ampu </h3>
                
                </div><!-- /.box-header -->
				
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th style="width: 12px">No.urut</th>
                      <th  style="width: 205px">Mata Pelajaran</th>
                      <th  style="width: 105px">Kelas</th>
                      
					  <th  style="width: 115px">Semester</th>
                      <th> </th>
                    </tr>
					  <?php
										
					$no=1;
					foreach($input_nilai_perkelas->result_array() as $row){
					?>	
					<form id="mainform" action="<?php echo base_url($action);?>" method="post">
            <input type="hidden" name="id_tahun" value="<?php echo $thn_aktif;?>">
                    <tr>
                      <td><center><?php echo $no++;?></center></td>
                      <td><?php echo $row['nama_pelajaran'];?></td>
                      <td><?php echo $row['nama_kelas'];?></td>
                      
                      	
					  
					 
					  <td>
					  <select class="form-control" name="semester">
              <?php 
              if($semester==1){
                echo "<option value='1'>Ganjil</option>";
              }
              else
              {
                echo "<option value='2'>Genap</option>";   
              }
              ?> 
						 
	                 </select>
						<input type='hidden' name='id_guru' value='<?php echo $id_guru;?>'>
						<input type='hidden' name='id_pelajaran' value='<?php echo $row['id_pelajaran'];?>'>
						<input type='hidden' name='id_kelas' value='<?php echo $row['id_kelas'];?>'>
					  </td>
                      <td><button name="submit" type="submit" class="btn btn-primary"><?php echo $text_btn;?></button></td>
                    </tr> </form>
					<?php
					}
					?>
                
                  </table>
				  <br><br>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
			
          </div>
</section>
