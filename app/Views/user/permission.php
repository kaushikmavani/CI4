<?= $this->extend('layouts/main.php') ?>

<?= $this->section('title') ?>
Role Permission
<?= $this->endSection() ?>

<?= $this->section('content'); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Role Permission</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('user') ?>">Manage Users</a></li>
              <li class="breadcrumb-item active">Manage Role Permission</li>
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
            <div class="card card-info">
              <!-- <form action="<?php //base_url('user/update_permission/'.$user['id']) ?>" method="post"> -->
                <div class="card-header">
                  <h3 class="card-title">Role Permission</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                      <i class="fas fa-minus"></i></button>
                  </div>
                </div>
                <div class="card-body p-0">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Module Name</th>
                        <th>Functionality Name</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Users</td>
                        <td>
                          <div class="custom-switch" style="display: inline-block;">
                            <input type="checkbox" class="custom-control-input" name="userIndex" id="userIndex" <?php if(in_array('users_index', $permission)) { echo 'checked'; } ?> value="users_index">
                            <label class="custom-control-label" for="userIndex">Listing</label>
                          </div>
                          <div class="custom-switch ml-4" style="display: inline-block;">
                            <input type="checkbox" class="custom-control-input" id="userCreate" <?php if(in_array('users_create', $permission)) { echo 'checked'; } ?> value="users_create">
                            <label class="custom-control-label" for="userCreate">Create</label>
                          </div>
                          <div class="custom-switch ml-4" style="display: inline-block;">
                            <input type="checkbox" class="custom-control-input" id="userEdit" <?php if(in_array('users_edit', $permission)) { echo 'checked'; } ?> value="users_edit">
                            <label class="custom-control-label" for="userEdit">Edit</label>
                          </div>
                          <div class="custom-switch ml-4" style="display: inline-block;">
                            <input type="checkbox" class="custom-control-input" id="userDelete" <?php if(in_array('users_delete', $permission)) { echo 'checked'; } ?> value="users_delete">
                            <label class="custom-control-label" for="userDelete">Delete</label>
                          </div>
                          <div class="custom-switch ml-4" style="display: inline-block;">
                            <input type="checkbox" class="custom-control-input" id="userPermission" <?php if(in_array('users_permission', $permission)) { echo 'checked'; } ?> value="users_permission">
                            <label class="custom-control-label" for="userPermission">Permission</label>
                          </div>
                        </td>
                        <td></td>
                      </tr>
                      <tr>
                        <td>Roles</td>
                        <td>
                          <div class="custom-switch" style="display: inline-block;">
                            <input type="checkbox" class="custom-control-input" id="roleIndex" <?php if(in_array('roles_index', $permission)) { echo 'checked'; } ?> value="roles_index">
                            <label class="custom-control-label" for="roleIndex">Listing</label>
                          </div>
                          <div class="custom-switch ml-4" style="display: inline-block;">
                            <input type="checkbox" class="custom-control-input" id="roleCreate" <?php if(in_array('roles_create', $permission)) { echo 'checked'; } ?> value="roles_create">
                            <label class="custom-control-label" for="roleCreate">Create</label>
                          </div>
                          <div class="custom-switch ml-4" style="display: inline-block;">
                            <input type="checkbox" class="custom-control-input" id="roleEdit" <?php if(in_array('roles_edit', $permission)) { echo 'checked'; } ?> value="roles_edit">
                            <label class="custom-control-label" for="roleEdit">Edit</label>
                          </div>
                          <div class="custom-switch ml-4" style="display: inline-block;">
                            <input type="checkbox" class="custom-control-input" id="roleDelete" <?php if(in_array('roles_delete', $permission)) { echo 'checked'; } ?> value="roles_delete">
                            <label class="custom-control-label" for="roleDelete">Delete</label>
                          </div>
                        </td>
                        <td></td>
                      </tr>
                      <tr>
                        <td>Modules</td>
                        <td>
                          <div class="custom-switch" style="display: inline-block;">
                            <input type="checkbox" class="custom-control-input" id="moduleIndex" <?php if(in_array('modules_index', $permission)) { echo 'checked'; } ?> value="modules_index">
                            <label class="custom-control-label" for="moduleIndex">Listing</label>
                          </div>
                          <div class="custom-switch ml-4" style="display: inline-block;">
                            <input type="checkbox" class="custom-control-input" id="moduleCreate" <?php if(in_array('modules_create', $permission)) { echo 'checked'; } ?> value="modules_create">
                            <label class="custom-control-label" for="moduleCreate">Create</label>
                          </div>
                          <div class="custom-switch ml-4" style="display: inline-block;">
                            <input type="checkbox" class="custom-control-input" id="moduleEdit" <?php if(in_array('modules_edit', $permission)) { echo 'checked'; } ?> value="modules_edit">
                            <label class="custom-control-label" for="moduleEdit">Edit</label>
                          </div>
                          <div class="custom-switch ml-4" style="display: inline-block;">
                            <input type="checkbox" class="custom-control-input" id="moduleDelete" <?php if(in_array('modules_delete', $permission)) { echo 'checked'; } ?> value="modules_delete">
                            <label class="custom-control-label" for="moduleDelete">Delete</label>
                          </div>
                        </td>
                        <td></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a href="<?= base_url('user'); ?>" class="btn btn-default">Cancel</a>
                  <button onclick="update_permission(<?= $user['id'] ?>)" type="button" class="btn btn-info float-right">Update Permission</button>
                </div>
                <!-- /.card-footer -->
              <!-- </form> -->
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

<?= $this->section('footer_script') ?>
  <script>
    function update_permission(id){
      var all_permission = [];
      $.each($("input:checked"), function(){
          var value = '"'+$(this).val()+'"';
          all_permission.push(value);
      });
      var permission = '['+all_permission.join(",")+']';
      var url = "<?php echo base_url('user/update_permission/') ?>"+'/'+id;

      $.ajax({
        type: 'POST',
        url: url,
        data: {
          'permission': permission
        },
        success: function (data)
        {
          toastr.success('User Permission Updated Successfully!');
        }
      });
    }
  </script>
<?= $this->endSection(); ?>