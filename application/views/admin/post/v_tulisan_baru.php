
  <!-- Content Header (Page header) -->
          <?php include('application/views/section_header.php');?>

 <section class="content">
 	 <div class="row">
            <div class="col-sm-12">
              <?php
              echo $this->session->flashdata('notif');?>
            </div>
          </div>
    <div class="row"> 

          <form action="<?php echo base_url('admin/proses_simpan_tulisan');?>" method="post" class="form-horizontal">
           <div class="col-md-8">
   <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Buat Tulisan Baru</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              	
                  <div class="form-group">

                    <div class="col-md-12"> 
                       <input type="text" name="judul" class="form-control" placeholder="Judul" value="<?php echo set_value('judul');?>" required="">
                     </div>

                  </div>
                 
              		<div class="form-group">
                      <div class="col-md-12"> 
              			<textarea id="editor1" class="form-control" name="isi" placeholder="Tuliskan konten disini!" required=""><?php echo set_value('isi');?></textarea>
                  </div>
              		</div>
           		
 	         		
				         
            </div>
          </div>
        </div>
          <div class="col-md-3 pull-right">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-cog"></i> Pengaturan</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <div class="col-md-12">
                    <label class="control-label">Kategori</label>
                  </div>
                     <div class="col-md-12">
                       <select name="kategori" class="form-control" required="">
                        <option value="halaman">Halaman</option>
                        <!--<option value="siswa">Siswa</option>-->
                        <option value="pengumuman">Pengumuman</option>
                        
                       </select>
                     </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-12">
                    <label class="control-label">Pemirsa</label>
                  </div>
                     <div class="col-md-12">
                       <select name="privacy" class="form-control" required="">
                        <option value="publik">Publik</option>
                        <!--<option value="siswa">Siswa</option>-->
                        <option value="guru">Guru</option>
                        <option value="wali_kelas">Wali Kelas</option>
                       </select>
                     </div>
                  </div>
                 
               

                  <div class="form-group">
                   
                    <div class="col-md-12">
                      <input type="submit" name="insert" value="Simpan" class="btn btn-primary btn-sm" />
                    </div>
                  </div>
              
                
            </div>
          </div>
        </div>
						</form>
          </div>
		  <!-- /data kelas -->
 </section>		  
