<!-- Content Header (Page header) -->
        <section class="content-header">
          <?php if($page_title!='')
          {
            echo $page_title;
          }
          else
          {
            echo "<h1><small> Assalamu'alaikum,</small><br>Selamat datang, $sapaan$nama_lengkap</h1>";
          }
          ?>
          <ol class="breadcrumb">
            
             <?php 
             /*
              | Membuat breadcrumbs dari hasil $_GET[];
             */
              $m = $this->input->get('m');
              $sm = $this->input->get('sm');
              if($m=='dashboard'&&$sm==''){ echo "<li><i class='fa fa-dashboard'></i> ".ucwords(humanize($m,'_'))."</li>";}
              if($m!=''&&$sm!='')
              { 
                echo "<li><a href='#'><i class='fa fa-dashboard'></i> Dashboard</a></li><li>".ucwords(humanize($m,'_'))."</li>";
              }
              elseif($m!='dashboard'&&$sm=='')
              {
                echo "<li><a href='#'><i class='fa fa-dashboard'></i> Dashboard</a></li><li class='active'>".ucwords(humanize($m,'_'))."</li>";
              }

              if($sm!=''){ echo "<li class='active'>".ucwords(humanize($sm,'_'))."</li>";}
            ?>
            
          </ol>
        </section>