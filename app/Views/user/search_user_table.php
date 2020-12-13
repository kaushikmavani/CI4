<table class="table table-bordered dataTable table-striped">
  <thead>
  <tr>
    <th class="sorting" id="user_id" onclick="users_sorting('user_id')" data-sort="id">Id</th>
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