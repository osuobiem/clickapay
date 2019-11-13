<div class="panel">
  <div class="records--list" data-title="Ads">
    <table id="recordsListView">
      <thead>
        <tr>
          <th>Provider</th>
          <th>Integration Medium</th>
          <th>Status</th>
          <th>Created</th>
          <th class="not-sortable">Actions</th>
        </tr>
      </thead>
      <tbody>

        <?php static $i = 1; foreach($ads as $ad): ?>
        <tr <?=$ad->disabled == 1 ? 'style="background-color: #8080802e;"' : ''?>>
          <td><?=$ad->provider->name?></td>
          <td><!--<?=$ad->i_medium?>--></td>
          <td> <span
              <?=$ad->disabled == 0 ? 'class="label label-success"':'class="label label-danger"'?>><?=$ad->disabled == 0 ? 'Active':'Disabled'?></span>
          </td>
          <td><?=date('d-m-Y, H:i', strtotime($ad->created_at))?></td>
          <td colspan="2">
            <a href="#editAd<?=$i?>" data-toggle="modal"><button class="btn btn-success fa fa-pen"></button></a>

            <div id="editAd<?=$i?>" class="modal fade">
              <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Edit Ad</h5> <button type="button" class="close"
                      data-dismiss="modal">×</button>
                  </div>
                  <div class="modal-body pt-4">
                    <form method="POST" action="<?=base_url()?>1dama3na/ads/edit/<?=base64_encode($ad->id)?>">
                      <div class="form-group col-md-12" style="float: left"> <label> <span
                            class="label-text">Provider</span>
                          <select class="form-control" name="provider">
                            <?php foreach($providers as $provider): ?>
                            <option value="<?=base64_encode($provider->id)?>"
                              <?=$provider->id == $ad->provider->id ? 'selected':''?>><?=$provider->name?></option>
                            <?php endforeach ?>
                          </select>
                        </label> </div>
                      <div class="form-group col-md-12" style="float: left"> <label> <span class="label-text">Integration
                    Medium</span>
                    <textarea name="medium" placeholder="Ad Integration Medium" required
                    class="form-control"><?=$ad->i_medium?></textarea></label></div>
                      <div class="col-md-12" style="float: left">
                        <input type="submit" value="Update Ad" style="width: inherit;"
                          class="btn btn-rounded btn-success"></div>
                    </form>
                  </div>
                </div>
              </div>
            </div>

            <a href="<?=base_url()?>1dama3na/ads/status/<?=$ad->disabled.'/'.base64_encode($ad->id)?>"><button
                class="btn btn-danger fa fa-power-off"></button></a>
          </td>
        </tr>
        <?php $i++; endforeach ?>

      </tbody>
    </table>
    <div style="margin-left: 30px;"><a href="#addAd" class="btn btn-primary" data-toggle="modal">Add Ad</a>
    </div>
  </div>
</div>

<div id="addAd" class="modal fade">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Ad</h5> <button type="button" class="close" data-dismiss="modal">×</button>
      </div>
      <div class="modal-body pt-4">
        <form method="POST" action="<?=base_url()?>1dama3na/ads/add">
          <div class="form-group col-md-12" style="float: left"> <label> <span class="label-text">Provider</span>
              <select class="form-control" name="provider">
                <?php foreach($providers as $provider): ?>
                  <option value="<?=base64_encode($provider->id)?>"><?=$provider->name?></option>
                <?php endforeach ?>
              </select>
            </label> </div>
          <div class="form-group col-md-12" style="float: left"> <label> <span class="label-text">Integration
                Medium</span>
              <textarea name="medium" placeholder="Ad Integration Medium" required
                class="form-control"></textarea></label></div>
          <div class="col-md-12" style="float: left">
            <input type="submit" value="Add Ad" style="width: inherit;" class="btn btn-rounded btn-success">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>