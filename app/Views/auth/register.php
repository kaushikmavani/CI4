<?= $this->extend('layouts/auth') ?>

<?= $this->section('title') ?>
Register
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="register-box">
  <div class="register-logo">
    <a href="<?= base_url('register') ?>"><b>Admin</b>LTE</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form action="<?= base_url('/attemptregister') ?>" enctype="multipart/form-data" method="post">
        <div class="row">
          <div class="col-lg-6">
            <div class="form-group mb-3">
              <div class="input-group">
                <input type="text" name="firstname" class="form-control" placeholder="Enter firstname" value="<?= old('firstname') ?>">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-user"></span>
                  </div>
                </div>
              </div>
              <span class="validation_error"><?= $validation->getError('firstname') ?></span>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group mb-3">
              <div class="input-group">
                <input type="text" name="lastname" class="form-control" placeholder="Enter lastname" value="<?= old('lastname') ?>">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-user"></span>
                  </div>
                </div>
              </div>
              <span class="validation_error"><?= $validation->getError('lastname') ?></span>
            </div>
          </div>
          <div class="col-lg-6">
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
          </div>
          <div class="col-lg-6">
            <div class="form-group mb-3">
              <div class="input-group">
                <input type="password" name="password" class="form-control" placeholder="Enter password">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <span class="validation_error"><?= $validation->getError('password') ?></span>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group mb-3">
              <div class="input-group">
                <input type="password" name="cpassword" class="form-control" placeholder="Enter confirm password">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <span class="validation_error"><?= $validation->getError('cpassword') ?></span>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group mb-3">
              <div class="input-group">
                <label class="d-inline-block">Gender:</label>
                <div class="form-check ml-3">
                  <input class="form-check-input" type="radio" name="gender" checked="" value="male">
                  <label class="form-check-label">Male</label>
                </div>
                <div class="form-check ml-3">
                  <input class="form-check-input" type="radio" name="gender" value="female">
                  <label class="form-check-label">Female</label>
                </div>
              </div>
              <span class="validation_error"><?= $validation->getError('gender') ?></span>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group mb-3">
              <div class="input-group">
                <input type="text" name="phone_no" class="form-control" placeholder="+91" value="<?= old('phone_no') ?>">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-phone"></span>
                  </div>
                </div>
              </div>
              <span class="validation_error"><?= $validation->getError('phone_no') ?></span>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group mb-3">
              <select class="form-control" name="role">
                <option value=" "> Select role..</option>
                <option value="1" <?php if(old('role') == "1") echo 'selected'; ?>>Admin</option>
                <option value="2" <?php if(old('role') == "2") echo 'selected'; ?>>User</option>
              </select>
              <span class="validation_error"><?= $validation->getError('role') ?></span>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group mb-3">
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="exampleInputFile" name="profile">
                  <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                </div>
              </div>
              <span class="validation_error"><?= $validation->getError('profile') ?></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <a href="<?= base_url('/login') ?>" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<?= $this->endSection() ?>
