<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
Module
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Modules</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manage Modules</li>
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
                        <h3 class="card-title">Manage Modules</h3>
                      </div>
                      <?php if($permission->check('models_create')) { ?>
                      <div class="col-sm-6 text-right">
                        <a href="<?= base_url('module/create') ?>" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="bottom" title="Create Module"><i class="fa fa-plus"></i> Create Module</a>
                      </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="modules" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Module</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($modules as $key => $module) { ?>
                    <tr>
                      <td><?= $module['id'] ?></td>
                      <td><?= ucwords($module['module']) ?></td>
                      <td>
                        <?php if($permission->check('models_edit')) { ?>
                        <a href="<?= base_url('module/edit/'.$module['id']); ?>" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="bottom" title="Edit module"><i class="fa fa-edit" style="font-size: 12px"></i></a>
                        <?php } ?>
                        <?php if($permission->check('models_delete')) { ?>
                        <button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="bottom" title="Delete module" onclick="delete_module(<?= $module['id'] ?>)"><i class="fa fa-trash" style="font-size: 12px"></i></a>
                        <?php } ?>
                      </td>
                    </tr>
                  <?php } ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Id</th>
                    <th>Module</th>
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
  function delete_module(id)
  {
    swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover this module record!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        var url = "<?= base_url('module/delete') ?>"+'/'+id;
        $.ajax({
          type: 'POST',
          url: url,
          success: function (data)
          {
            swal("Poof! Your module record has been deleted successfully!", {
              icon: "success",
            });
            setInterval(function(){ location.reload() }, 1000);
          }
        });
      } else {
        swal("Your module record is safe!");
      }
    });  
  }
</script>

<?= $this->endSection() ?>