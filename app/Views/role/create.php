<?= $this->extend('layouts/main.php') ?>

<?= $this->section('title') ?>
Create Role
<?= $this->endSection() ?>

<?= $this->section('content'); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create Role</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('role') ?>">Manage Roles</a></li>
              <li class="breadcrumb-item active">Create Role</li>
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
                <h3 class="card-title">Create Role</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?= base_url('role/store') ?>" enctype="multipart/form-data" method="post" role="form">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label>Role <span style="color: red">*</span></label>
                        <input type="text" class="form-control" name="role" placeholder="Enter Role Name" value="<?= old('role') ?>">
                        <span class="validation_error"><?= $validation->getError('role') ?></span>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="reset" class="btn btn-default">Cancel</button>
                  <button type="submit" class="btn btn-info float-right">Create Role</button>
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