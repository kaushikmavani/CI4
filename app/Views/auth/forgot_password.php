<?= $this->extend('layouts/auth') ?>

<?= $this->section('title') ?>
Forgot Password
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="login-box">
  <div class="login-logo">
    <a href="<?= base_url('forgotPassword') ?>"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

      <form action="<?php echo base_url('resetPassword') ?>" method="post">
        <?php if(\Config\Services::session()->getFlashdata('error')) { ?>
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong></strong> <?= \Config\Services::session()->getFlashdata('error') ?>
          </div>
        <?php } ?>
        <?php if(\Config\Services::session()->getFlashdata('success')) { ?>
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong></strong> <?= \Config\Services::session()->getFlashdata('success') ?>
          </div>
        <?php } ?>
        <div class="form-group mb-3">
          <div class="input-group">
            <input type="text" name="email" class="form-control" placeholder="Enter email address" value="<?= old('email') ?>">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <span class="validation_error"><?= $validation->getError('email') ?></span>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Request new password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="<?= base_url('/login') ?>">Login</a>
      </p>
      <p class="mb-0">
        <a href="<?= base_url('/register') ?>" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<?= $this->endSection() ?>
