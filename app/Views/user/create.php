<?= $this->extend('layouts/main.php') ?>

<?= $this->section('title') ?>
Create User
<?= $this->endSection() ?>

<?= $this->section('content'); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('user') ?>">Manage Users</a></li>
              <li class="breadcrumb-item active">Create User</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Create User</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?= base_url('user/store') ?>" enctype="multipart/form-data" method="post" role="form">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label>First Name <span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="firstname" placeholder="Enter firstname" value="<?= old('firstname') ?>">
                        <span class="validation_error"><?= $validation->getError('firstname') ?></span>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label>Last Name <span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="lastname" placeholder="Enter lastname" value="<?= old('lastname') ?>">
                        <span class="validation_error"><?= $validation->getError('lastname') ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label>Email <span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="email" placeholder="Enter email address" value="<?= old('email') ?>">
                        <span class="validation_error"><?= $validation->getError('email') ?></span>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label>Password <span style="color: red">*</span></label>
                        <input type="password" class="form-control" name="password" placeholder="Enter email address">
                        <span class="validation_error"><?= $validation->getError('password') ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label>Confirm Password <span style="color: red">*</span></label>
                        <input type="password" class="form-control" name="cpassword" placeholder="Enter email address">
                        <span class="validation_error"><?= $validation->getError('cpassword') ?></span>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                          <label>Gender <span style="color: red">*</span></label>
                         <div class="input-group">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="male" checked="">
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
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label>Phone No. <span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="phone_no" placeholder="+91" value="<?= old('phone_no') ?>">
                        <span class="validation_error"><?= $validation->getError('phone_no') ?></span>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label>Role <span style="color: red">*</span></label>
                        <select class="form-control" name="role">
                          <option value=" "> Select role..</option>
                          <?php foreach ($roles as $key => $role) { ?>
                            <option value="<?= $role['id'] ?>"><?= $role['role']; ?></option>
                          <?php } ?>
                        </select>
                        <span class="validation_error"><?= $validation->getError('role') ?></span>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group mb-3">
                        <label>Profile <span style="color: red">*</span></label>
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
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="reset" class="btn btn-default">Cancel</button>
                  <button type="submit" class="btn btn-info float-right">Create User</button>
                </div>
              </form>
            </div>
          </div>
          <!--/.col (left) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?= $this->endSection(); ?>