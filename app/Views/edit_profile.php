<?= $this->extend('layouts/main.php') ?>

<?= $this->section('title') ?>
Edit Profile
<?= $this->endSection() ?>

<?= $this->section('content'); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('profile') ?>">Profile</a></li>
              <li class="breadcrumb-item active">Edit</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
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
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Edit Profile</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?= base_url('updateProfile') ?>" enctype="multipart/form-data" method="post" role="form">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label>First Name <span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="firstname" placeholder="Enter firstname" value="<?= $user['firstname'] ?>">
                        <span class="validation_error"><?= $validation->getError('firstname') ?></span>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label>Last Name <span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="lastname" placeholder="Enter lastname" value="<?= $user['lastname'] ?>">
                        <span class="validation_error"><?= $validation->getError('lastname') ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label>Email <span style="color: red">*</span></label>
                        <input type="Email" class="form-control" name="email" placeholder="Enter email address" readonly="" value="<?= $user['email'] ?>">
                        <span class="validation_error"><?= $validation->getError('email') ?></span>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                          <label>Gender <span style="color: red">*</span></label>
                         <div class="input-group">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" value="male" <?= ($user['gender'] == 'male') ? 'checked' : '' ?>>
                            <label class="form-check-label">Male</label>
                          </div>
                          <div class="form-check ml-3">
                            <input class="form-check-input" type="radio" name="gender" value="female" <?= ($user['gender'] == 'female') ? 'checked' : '' ?>>
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
                        <input type="text" class="form-control" name="phone_no" placeholder="+91" value="<?= $user['phone_no'] ?>">
                        <span class="validation_error"><?= $validation->getError('phone_no') ?></span>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label>Role <span style="color: red">*</span></label>
                        <select class="form-control" name="role">
                          <option value=" "> Select role..</option>
                          <option value="1" <?php if($user['role'] == "1") echo 'selected'; ?>>Admin</option>
                          <option value="2" <?php if($user['role'] == "2") echo 'selected'; ?>>User</option>
                        </select>
                        <span class="validation_error"><?= $validation->getError('role') ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
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
                    <div class="col-lg-6">
                      <img src="<?php echo ($user['profile'] != '') ? (file_exists(FCPATH."public\images\userProfile\\".$user['profile'])) ? base_url()."/public/images/userProfile/".$user['profile'] : base_url()."/public/dist/img/default.png" : base_url()."/public/dist/img/default.png" ?>" width="70" height="70">
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <a href="<?= base_url('user'); ?>" class="btn btn-default">Cancel</a>
                  <button type="submit" class="btn btn-info float-right">Update Profile</button>
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