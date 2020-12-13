<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
Gallary
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Gallary</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manage Gallary</li>
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
                        <h3 class="card-title">Manage Gallary</h3>
                      </div>
                      <div class="col-sm-6 text-right">
                        <a href="<?= base_url('gallary/upload') ?>" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="bottom" title="Upload More Image"><i class="fa fa-plus"></i> Upload More Image</a>
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
                    <th>Image</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($gallaries as $key => $gallary) { ?>
                    <tr>
                      <td><?= $gallary->id ?></td>
                      <td>
                        <img src="<?= base_url(). "/public/images/gallary/". $gallary->image; ?>" width="80" height="80">
                      </td>
                      <td>      
                      	<button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="bottom" title="Delete image" onclick="delete_gallary(<?= $gallary->id ?>)"><i class="fa fa-trash" style="font-size: 12px"></i> Delete</button>              	
                      </td>
                    </tr>
                  <?php } ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Id</th>
                    <th>Image</th>
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
  function delete_gallary(id)
  {
    swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover this image!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        var url = "<?= base_url('gallary/delete') ?>"+'/'+id;
        $.ajax({
          type: 'POST',
          url: url,
          success: function (data)
          {
            swal("Poof! Your image record has been deleted successfully!", {
              icon: "success",
            });
            setInterval(function(){ location.reload() }, 1000);
          }
        });
      } else {
        swal("Your image record is safe!");
      }
    });  
  }
</script>

<?= $this->endSection() ?>