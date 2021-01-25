                 
        <!-- Content Header (Page header) -->
          <?php include('application/views/section_header.php');?>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-sm-12">
              <?php echo $this->session->flashdata('notif');?>
            </div>
          </div>
          <div class="row">
          <div class="col-md-12">
            <?php
            $rowtulisan = $tulisan->row();
            $rows_data = $tulisan->num_rows();
            ?>

              <div class="box box-primary">
                <div class="box-body box-profile">
                  <?php if($rows_data>0){?>
                <small><i class="fa fa-calendar"></i> <?php echo tgl_indoo($rowtulisan->tgl_post)." ".date('H:i', strtotime($rowtulisan->tgl_post));?> &nbsp;&nbsp; <i class="fa fa-user"></i> <?php echo $rowtulisan->author;?></small><hr>
                <?php
                echo $rowtulisan->isi_post;
                }
                else
                {
                  echo "halaman kosong...";
                }
                ?>


               
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              

          </div>
        </div>
          

        </section><!-- /.content -->
     
      