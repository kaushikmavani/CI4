<?= $this->extend('layouts/main.php') ?>

<?= $this->section('title') ?>
Change Password
<?= $this->endSection() ?>

<?= $this->section('content'); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Change Password</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
              <li class="breadcrumb-item active">Change Password</li>
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
                <h3 class="card-title">Change Password</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?= base_url('updatePassword') ?>" class="form-horizontal" method="post">
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Password <span style="color: red">*</span></label>
                    <div class="col-sm-9">
                      <input type="password" name="password" class="form-control" placeholder="Enter current password">
                    	<span class="validation_error"><?= $validation->getError('password'); ?></span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">New Password  <span style="color: red">*</span></label>
                    <div class="col-sm-9">
                      <input type="password" name="newpassword" class="form-control" placeholder="Enter new password">
                    	<span class="validation_error"><?= $validation->getError('newpassword'); ?></span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Confirm New Password  <span style="color: red">*</span></label>
                    <div class="col-sm-9">
                      <input type="password" name="newcpassword" class="form-control" placeholder="Enter confirm new password">
                    	<span class="validation_error"><?= $validation->getError('newcpassword'); ?></span>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="reset" class="btn btn-default">Cancel</button>
                  <button type="submit" class="btn btn-info float-right">Change Password</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card -->

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