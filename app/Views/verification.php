<?= $this->extend('layouts/auth') ?>

<?= $this->section('title') ?>
Verification
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="login-box">
  <div class="login-logo">
    <a href="<?= base_url('emailVerification') ?>"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Your email verified successfully, Now you can login with your account!.</p>

      <div class="row">
        <div class="col-12">
          <a href="<?= base_url('/login') ?>" class="btn btn-info btn-sm btn-block">Login</a>
        </div>
        <!-- /.col -->
       </div>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<?= $this->endSection() ?>
