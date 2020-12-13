<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
Roles
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Roles</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manage Roles</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="row">
                      <div class="col-sm-6">
                        <h3 class="card-title">Manage Roles</h3>
                      </div>
                      <div class="col-sm-6 text-right">
                        <?php if($permission->check('roles_create')) { ?>
                        <a href="<?= base_url('role/create') ?>" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="bottom" title="Create Role"><i class="fa fa-plus"></i> Create Role</a>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="roles" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Role</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($roles as $key => $role) { ?>
                    <tr>
                      <td><?= $role['id'] ?></td>
                      <td><?= ucwords($role['role']) ?></td>
                      <td>
                        <?php if($permission->check('roles_create')) { ?>
                        <a href="<?= base_url('role/edit/'.$role['id']); ?>" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="bottom" title="Edit role"><i class="fa fa-edit" style="font-size: 12px"></i></a>
                        <?php } ?>
                        <?php if($permission->check('roles_create')) { ?>
                        <button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="bottom" title="Delete role" onclick="delete_role(<?= $role['id'] ?>)"><i class="fa fa-trash" style="font-size: 12px"></i></button>
                        <?php } ?>
                      </td>
                    </tr>
                  <?php } ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Id</th>
                    <th>Role</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?= $this->endSection() ?>

<?= $this->section('footer_script') ?>

<script type="text/javascript">
  function delete_role(id)
  {
    swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover this role record!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        var url = "<?= base_url('role/delete') ?>"+'/'+id;
        $.ajax({
          type: 'POST',
          url: url,
          success: function (data)
          {
            swal("Poof! Your role record has been deleted successfully!", {
              icon: "success",
            });
            setInterval(function(){ location.reload() }, 1000);
          }
        });
      } else {
        swal("Your role record is safe!");
      }
    });  
  }
</script>

<?= $this->endSection() ?>