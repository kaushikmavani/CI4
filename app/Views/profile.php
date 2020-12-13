<?= $this->extend('layouts/main.php') ?>

<?= $this->section('title') ?>
Profile
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- Profile Image -->
            <div class="card card-info card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                	<i class="fa fa-pencil"></i>
                  <img src="<?php echo (\Config\Services::session()->get('profile') != '') ? (file_exists(FCPATH."public\images\userProfile\\".\Config\Services::session()->get('profile'))) ? base_url()."/public/images/userProfile/".\Config\Services::session()->get('profile') : base_url()."/public/dist/img/default.png" : base_url()."/public/dist/img/default.png" ?>" class="profile-user-img img-fluid img-circle" alt="User profile picture" style="width: 100px; height: 100px">
                </div>

                <h3 class="profile-username text-center"><?= ucwords(\Config\Services::session()->get('firstname')).' '.ucwords(\Config\Services::session()->get('lastname')) ?></h3>

                <p class="text-muted text-center"><?= (\Config\Services::session()->get('role') == 1) ? 'Admin' : 'User'; ?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Firtname</b> <a class="float-right"><?= ucwords($user['firstname']) ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Lastname</b> <a class="float-right"><?= ucwords($user['lastname']) ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Email</b> <a class="float-right"><?= $user['email'] ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Gender</b> <a class="float-right"><?= ucwords($user['gender']) ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Phone No.</b> <a class="float-right"><?= $user['phone_no'] ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Role</b> <a class="float-right"><?= ($user['role'] == 1) ? 'Admin' : 'User'; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Status</b> <a class="float-right"><?= ($user['status'] == 1) ? 'Active' : 'Inactive' ?></a>
                  </li>
                </ul>

                <a href="<?= base_url('editProfile') ?>" class="btn btn-info btn-block"><b>Update Profile</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?= $this->endSection(); ?>