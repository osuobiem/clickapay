<div class="panel">
  <div class="records--list" data-title="Users">
    <table id="recordsListView">
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Balance</th>
          <th>Status</th>
          <th>Created</th>
          <th class="not-sortable">Actions</th>
        </tr>
      </thead>
      <tbody>

        <?php static $i = 1; foreach($users as $user): ?>
        <tr <?=$user->disabled == 1 ? 'style="background-color: #8080802e;"' : ''?>>
          <td><?=$user->firstname.' '.$user->lastname?></td>
          <td><?=$user->email?></td>
          <td><?=$user->phone?></td>
          <td>₦<?=$user->balance?></td>
          <td> <span
              <?=$user->disabled == 0 ? 'class="label label-success"':'class="label label-danger"'?>><?=$user->disabled == 0 ? 'Active':'Disabled'?></span>
          </td>
          <td><?=date('d-m-Y, H:i', strtotime($user->created_at))?></td>
          <td colspan="2">
            <a href="#editUser<?=$i?>" data-toggle="modal"><button class="btn btn-success fa fa-pen"></button></a>

            <div id="editUser<?=$i?>" class="modal fade">
              <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5> <button type="button" class="close"
                      data-dismiss="modal">×</button>
                  </div>
                  <div class="modal-body pt-4">
                    <form method="POST" action="<?=base_url()?>1dama3na/users/edit/<?=base64_encode($user->id)?>">
                      <div class="form-group col-md-6" style="float: left"> <label> <span
                            class="label-text">Firstname</span> <input type="text"  name="fname" value="<?=$user->firstname?>"
                            placeholder="Firstname" required class="form-control">
                        </label> </div>
                      <div class="form-group col-md-6" style="float: left"> <label> <span
                            class="label-text">Lastname</span> <input type="text" name="lname" placeholder="Lastname"
                            value = "<?=$user->lastname?>" required class="form-control"> </label> </div>
                      <div class="form-group col-md-4" style="float: left"> <label> <span
                            class="label-text">Email</span> <input type="email" name="email" placeholder="User Email"
                            value = "<?=$user->email?>" required class="form-control"> </label> </div>
                      <div class="form-group col-md-4" style="float: left"> <label> <span
                            class="label-text">Phone</span> <input type="text" name="phone" placeholder="Phone number"
                            value="<?=$user->phone?>" required class="form-control"> </label> </div>
                      <div class="form-group col-md-4" style="float: left"> <label> <span
                            class="label-text">Password</span> <input type="password" name="password"
                            placeholder="Password" class="form-control"> </label> </div>
                      <div class="col-md-12" style="float: left">
                        <input type="submit" value="Update User" style="width: inherit;"
                          class="btn btn-rounded btn-success"></div>
                  
                  </form>
                  </div>
                </div>
              </div>
            </div>

            <a href="<?=base_url()?>1dama3na/users/status/<?=$user->disabled.'/'.base64_encode($user->id)?>"><button
                class="btn btn-danger fa fa-power-off"></button></a>
          </td>
        </tr>
        <?php $i++; endforeach ?>

      </tbody>
    </table>
    <div style="margin-left: 30px;"><a href="#addUser" class="btn btn-primary" data-toggle="modal">Add User</a></div>
  </div>
</div>

<div id="addUser" class="modal fade">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add User</h5> <button type="button" class="close" data-dismiss="modal">×</button>
      </div>
      <div class="modal-body pt-4">
        <form method="POST" action="<?=base_url()?>1dama3na/users/add">
          <div class="form-group col-md-6" style="float: left"> <label> <span class="label-text">Firstname</span> <input
                type="text" name="fname" placeholder="Firstname" required class="form-control"> </label> </div>
          <div class="form-group col-md-6" style="float: left"> <label> <span class="label-text">Lastname</span> <input
                type="text" name="lname" placeholder="Lastname" required class="form-control"> </label> </div>
          <div class="form-group col-md-4" style="float: left"> <label> <span class="label-text">Email</span> <input
                type="email" name="email" placeholder="User Email" required class="form-control"> </label> </div>
          <div class="form-group col-md-4" style="float: left"> <label> <span class="label-text">Phone</span> <input
                type="text" name="phone" placeholder="Phone number" required class="form-control"> </label> </div>
          <div class="form-group col-md-4" style="float: left"> <label> <span class="label-text">Password</span> <input
                type="password" name="password" placeholder="Password" required class="form-control"> </label> </div>
          <div class="col-md-12" style="float: left">
            <input type="submit" value="Add User" style="width: inherit;" class="btn btn-rounded btn-success"></div>
      
      </form>
      </div>
    </div>
  </div>
</div>