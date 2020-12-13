<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
Users
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Users</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manage Users</li>
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
                        <h3 class="card-title">Manage Users</h3>
                      </div>
                      <div class="col-sm-6 text-right">
                        <?php if($permission->check('users_create')) { ?>
                          <a href="<?= base_url('user/create') ?>" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="bottom" title="Create User"><i class="fa fa-plus"></i> Create User</a>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="users" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Phone No.</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Profile</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($users as $key => $user) { ?>
                    <tr>
                      <td><?= $user['id'] ?></td>
                      <td><?= ucwords($user['firstname']) ?></td>
                      <td><?= ucwords($user['lastname']) ?></td>
                      <td><?= $user['email'] ?></td>
                      <td><?= ucwords($user['gender']) ?></td>
                      <td><?= $user['phone_no'] ?></td>
                      <td><?= ($user['role'] == 1) ? 'Admin' : 'User' ?></td>
                      <td><?= ($user['status'] == 1) ? 'Active' : 'Inactive' ?></td>
                      <td><img src="<?php echo ($user['profile'] != '') ? (file_exists(FCPATH."public\images\userProfile\\".$user['profile'])) ? base_url()."/public/images/userProfile/".$user['profile'] : base_url()."/public/dist/img/default.png" : base_url()."/public/dist/img/default.png" ?>" width="50" height="50"></td>
                      <td>
                        <?php if($permission->check('users_edit')) { ?>
                          <a href="<?= base_url('user/edit/'.$user['id']); ?>" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="bottom" title="Edit User"><i class="fa fa-edit" style="font-size: 12px"></i></a>
                        <?php } ?>
                        <?php if($permission->check('users_delete')) { ?>
                          <button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="bottom" title="Delete User" onclick="delete_user(<?= $user['id'] ?>)"><i class="fa fa-trash" style="font-size: 12px"></i></button>
                        <?php } ?>
                        <?php if($permission->check('users_permission')) { ?>
                          <a href="<?= base_url('user/permission/'.$user['id']); ?>" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="bottom" title="User Permission"><i class="fas fa-shield-alt" style="font-size: 12px"></i></a>
                        <?php } ?>
                      </td>
                    </tr>
                  <?php } ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Phone No.</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Profile</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="row">
                      <div class="col-sm-8">
                        <h3 class="card-title">Manage users with custome <span class="badge badge-success">Pagination</span>,  <span class="badge badge-info">Searching</span> and <span class="badge badge-danger ">Sorting</span></h3>
                      </div>
                      <div class="col-sm-4 text-right">
                        <?php if($permission->check('users_create')) { ?>
                          <a href="<?= base_url('user/create') ?>" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="bottom" title="Create User"><i class="fa fa-plus"></i> Create User</a>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row mb-3">
                  <div class="col-sm-12 col-md-6">
                    <div class="dataTables_length">
                      <span>Show Entries: </span>
                      <select name="users_limit" id="users_limit" onchange="users_search()">
                        <option value="10" selected="">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-6 text-right">
                    <div>
                      <span>Search: <input type="search" id="users_search" class="form-control-sm" placeholder="" aria-controls="users" onkeyup="users_search()">
                      </span>
                    </div>
                  </div>
                </div>
                <div id="custome_table">
                  <table class="table table-bordered dataTable table-striped">
                    <thead>
                    <tr>
                      <th class="sorting_asc" id="user_id" onclick="users_sorting('user_id')" data-sort="id">Id</th>
                      <th class="sorting" id="user_firstname" onclick="users_sorting('user_firstname')" data-sort="firstname">First Name</th>
                      <th class="sorting" id="user_lastname" onclick="users_sorting('user_lastname')" data-sort="lastname">Last Name</th>
                      <th class="sorting" id="user_email" onclick="users_sorting('user_email')" data-sort="email">Email</th>
                      <th class="sorting" id="user_gender" onclick="users_sorting('user_gender')" data-sort="gender">Gender</th>
                      <th class="sorting" id="user_phone_no" onclick="users_sorting('user_phone_no')" data-sort="phone_no">Phone No.</th>
                      <th class="sorting" id="user_role" onclick="users_sorting('user_role')" data-sort="role">Role</th>
                      <th class="sorting" id="user_status" onclick="users_sorting('user_status')" data-sort="status">Status</th>
                      <th>Profile</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($custom_users as $key => $user) { ?>
                      <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= ucwords($user['firstname']) ?></td>
                        <td><?= ucwords($user['lastname']) ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><?= ucwords($user['gender']) ?></td>
                        <td><?= $user['phone_no'] ?></td>
                        <td><?= ($user['role'] == 1) ? 'Admin' : 'User' ?></td>
                        <td><?= ($user['status'] == 1) ? 'Active' : 'Inactive' ?></td>
                        <td><img src="<?php echo ($user['profile'] != '') ? (file_exists(FCPATH."public\images\userProfile\\".$user['profile'])) ? base_url()."/public/images/userProfile/".$user['profile'] : base_url()."/public/dist/img/default.png" : base_url()."/public/dist/img/default.png" ?>" width="50" height="50"></td>
                        <td>
                          <?php if($permission->check('users_edit')) { ?>
                            <a href="<?= base_url('user/edit/'.$user['id']); ?>" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="bottom" title="Edit User"><i class="fa fa-edit" style="font-size: 12px"></i></a>
                          <?php } ?>
                          <?php if($permission->check('users_delete')) { ?>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="bottom" title="Delete User" onclick="delete_user(<?= $user['id'] ?>)"><i class="fa fa-trash" style="font-size: 12px"></i></button>
                          <?php } ?>
                          <?php if($permission->check('users_permission')) { ?>
                            <a href="<?= base_url('user/permission/'.$user['id']); ?>" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="bottom" title="User Permission"><i class="fas fa-shield-alt" style="font-size: 12px"></i></a>
                          <?php } ?>
                        </td>
                      </tr>
                    <?php } ?>
                    </tbody>
                    <tfoot>
                    <tr>
                      <th>Id</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Email</th>
                      <th>Gender</th>
                      <th>Phone No.</th>
                      <th>Role</th>
                      <th>Status</th>
                      <th>Profile</th>
                      <th>Action</th>
                    </tr>
                    </tfoot>
                  </table>
                  <div class="row">
                    <div class="col-sm-12 text-right">
                      <?= $pager->links('users','custom_pagination'); ?>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="row">
                      <div class="col-sm-6">
                        <h3 class="card-title">Manage Users with <span class="badge badge-success">Grid</span> (Use CodeIgniter4 Table Class)</h3>
                      </div>
                      <div class="col-sm-6 text-right">
                        <?php if($permission->check('users_create')) { ?>
                          <a href="<?= base_url('user/create') ?>" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="bottom" title="Create User"><i class="fa fa-plus"></i> Create User</a>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <?= $user_table->generate(); ?>

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
  function delete_user(id)
  {
    swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover this user record!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        var url = "<?= base_url('user/delete') ?>"+'/'+id;
        $.ajax({
          type: 'POST',
          url: url,
          success: function (data)
          {
            swal("Poof! Your user record has been deleted successfully!", {
              icon: "success",
            });
            setInterval(function(){ location.reload() }, 1000);
          }
        });
      } else {
        swal("Your user record is safe!");
      }
    });  
  }

  function users_search()
  {
    var search = $('#users_search').val();
    var limit = $('#users_limit').val();
    var url = '<?php echo base_url('user/search') ?>';
    $.ajax({
      type: 'POST',
      url: url,
      data: {
        'search': search,
        'limit': limit 
      },
      success: function (data)
      {
        $('#custome_table').html(data);
      }
    });
  }

  function users_sorting(elem)
  {
    var search = $('#users_search').val();
    var limit = $('#users_limit').val();
    var sorting = $('#'+elem).data("sort");
    var sorting_type = $('#'+elem).attr("class");
    var elem_id = $('#'+elem).attr("id");
    var url = '<?php echo base_url('user/sorting') ?>';
    $.ajax({
      type: 'POST',
      url: url,
      data: {
        'search': search,
        'limit': limit,
        'sorting': sorting,
        'sorting_type': sorting_type
      },
      success: function (data)
      {
        $('#custome_table').html(data);

        if(sorting_type=='sorting')
        {
          $('th[class="sorting_desc"]').addClass('sorting');
          $('th[class="sorting_asc"]').addClass('sorting');
          $('#'+elem).removeClass('sorting');
          $('#'+elem).addClass('sorting_desc');
        }
        else if(sorting_type=='sorting_desc')
        {
          $('#'+elem).removeClass('sorting_desc');
          $('th[class="sorting_desc"]').addClass('sorting');
          $('th[class="sorting_asc"]').addClass('sorting');
          $('#'+elem).removeClass('sorting');
          $('#'+elem).addClass('sorting_asc');
        }
        else if(sorting_type=='sorting_asc')
        {
          $('#'+elem).removeClass('sorting_asc');
          $('th[class="sorting_desc"]').addClass('sorting');
          $('th[class="sorting_asc"]').addClass('sorting');
          $('#'+elem).removeClass('sorting');
          $('#'+elem).addClass('sorting_desc');
        }
      }
    });
  }

</script>

<?= $this->endSection() ?>