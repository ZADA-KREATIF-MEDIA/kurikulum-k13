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
<div class="alert alert-primary" role="alert">
    <h4>Data mata pelajaran di ampu</h4>
</div>
<div class="row">
    <div class="col-md-12">
        <?php echo $this->session->flashdata('notif');?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body table-responsive no-padding">
                <table class="table table-bordered table-hover">
                    <tr class="bg-primary text-white text-center">
                        <th>No </th>
                        <th>Mata Pelajaran</th>
                        <th>Kelas</th>
                        <th style="width: 115px">Semester</th>
                        <th>Aksi</th>
                    </tr>
                    <?php
					$no=1;
					foreach($input_nilai_perkelas->result_array() as $row){
					?>
                    <form id="mainform" action="<?php echo base_url($action);?>" method="post">
                        <input type="hidden" name="id_tahun" value="<?php echo $thn_aktif;?>">
                        <tr>
                            <td>
                                <center><?php echo $no++;?></center>
                            </td>
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
                            <td><button name="submit" type="submit" class="btn btn-success btn-block">Perbarui</button>
                            </td>
                        </tr>
                    </form>
                    <?php
					}
					?>
                </table>
                <br><br>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>