<div class="login-box">
  <div class="sub-header text-center">
    <img src="assets/dist/img/logo_febunismuh.png" height="100px">
  </div>
  <div class="login-logo">
    <b>ADMIN</b>Resorces
  </div>
  <!-- /.login-logo -->

  <div class="login-box-body">
    <p class="login-box-msg">Login Admin</p>
    <?php if ($this->session->flashdata('konfirm')): ?>
      <div class="alert alert-info alert-dismissible" id="success-alert">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-info"></i> Konfirmasi !</h4>
        <?php echo $this->session->flashdata('konfirm'); ?>
      </div>
    <?php endif; ?>
    <form action="<?php echo base_url();?>login/doLogin" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="User Name" name="nm_user" required>
        <span class="fa fa-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="ps_user" required>
        <span class="fa fa-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Log In</button>
        </div>
        <!-- /.col -->
      </div>
      <br>
      <p class="login-box-msg">FEB-Universitas Muhammadiyah Makassar <?php echo date("Y");?></p>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
