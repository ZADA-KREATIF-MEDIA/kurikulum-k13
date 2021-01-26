<?php 
include('application/views/head.php');
include('application/views/header.php');
include('application/views/sidebar.php');
?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <?php 
                            $this->load->view($content);
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include('application/views/footer.php'); ?>