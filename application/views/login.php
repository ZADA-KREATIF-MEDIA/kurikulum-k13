<div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
        <div class="row w-100">
            <div class="col-lg-4 mx-auto">
                <div class="auto-form-wrapper">
                    <?php echo $this->session->flashdata('notif'); ?>
                    <form action="<?php echo base_url('login/aksi_login');?>" method="POST">
                        <div class="form-group">
                            <label class="label">Username</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Username" name="username" id="username">
                                <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="mdi mdi-check-circle-outline"></i>
                                </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" placeholder="*********" name="password" id="password">
                                <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="mdi mdi-check-circle-outline"></i>
                                </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <select name="level" class="form-control">
                                <option value="guru"> GURU </option>
                                <option value="admin"> ADMIN </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary submit-btn btn-block">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>