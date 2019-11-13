<div class="panel">
  <div class="records--list" data-title="Providers">
    <table id="recordsListView">
      <thead>
        <tr>
          <th>Name</th>
          <th>Url</th>
          <th>Status</th>
          <th>Created</th>
          <th class="not-sortable">Actions</th>
        </tr>
      </thead>
      <tbody>

        <?php static $i = 1; foreach($providers as $provider): ?>
        <tr <?=$provider->disabled == 1 ? 'style="background-color: #8080802e;"' : ''?>>
          <td><?=$provider->name?></td>
          <td><?=$provider->url?></td>
          <td> <span
              <?=$provider->disabled == 0 ? 'class="label label-success"':'class="label label-danger"'?>><?=$provider->disabled == 0 ? 'Active':'Disabled'?></span>
          </td>
          <td><?=date('d-m-Y, H:i', strtotime($provider->created_at))?></td>
          <td colspan="2">
            <a href="#editProvider<?=$i?>" data-toggle="modal"><button class="btn btn-success fa fa-pen"></button></a>

            <div id="editProvider<?=$i?>" class="modal fade">
              <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Edit Provider</h5> <button type="button" class="close"
                      data-dismiss="modal">×</button>
                  </div>
                  <div class="modal-body pt-4">
                    <form method="POST"
                      action="<?=base_url()?>1dama3na/providers/edit/<?=base64_encode($provider->id)?>">
                      <div class="form-group col-md-6" style="float: left"> <label> <span class="label-text">Name</span>
                          <input type="text" name="name" value="<?=$provider->name?>" placeholder="Provider Name"
                            required class="form-control">
                        </label> </div>
                      <div class="form-group col-md-6" style="float: left"> <label> <span class="label-text">Url</span>
                          <input type="text" name="url" placeholder="Provider URL" value="<?=$provider->url?>" required
                            class="form-control"> </label></div>
                      <div class="col-md-12" style="float: left">
                        <input type="submit" value="Update Provider" style="width: inherit;"
                          class="btn btn-rounded btn-success"></div>
                    </form>
                  </div>
                </div>
              </div>
            </div>

            <a
              href="<?=base_url()?>1dama3na/providers/status/<?=$provider->disabled.'/'.base64_encode($provider->id)?>"><button
                class="btn btn-danger fa fa-power-off"></button></a>
          </td>
        </tr>
        <?php $i++; endforeach ?>

      </tbody>
    </table>
    <div style="margin-left: 30px;"><a href="#addProvider" class="btn btn-primary" data-toggle="modal">Add Provider</a>
    </div>
  </div>
</div>

<div id="addProvider" class="modal fade">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Provider</h5> <button type="button" class="close" data-dismiss="modal">×</button>
      </div>
      <div class="modal-body pt-4">
        <form method="POST" action="<?=base_url()?>1dama3na/providers/add">
          <div class="form-group col-md-6" style="float: left"> <label> <span class="label-text">Name</span> <input
                type="text" name="name" placeholder="Provider Name" required
                class="form-control">
            </label> </div>
          <div class="form-group col-md-6" style="float: left"> <label> <span class="label-text">Url</span> <input
                type="text" name="url" placeholder="Provider URL" required
                class="form-control"> </label></div>
          <div class="col-md-12" style="float: left">
            <input type="submit" value="Add Provider" style="width: inherit;" class="btn btn-rounded btn-success">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>