<div class="panel">
  <div class="records--list" data-title="FAQs">
    <table id="recordsListView">
      <thead>
        <tr>
          <th>Question</th>
          <th>Answer</th>
          <th>Status</th>
          <th>Created</th>
          <th class="not-sortable">Actions</th>
        </tr>
      </thead>
      <tbody>

        <?php static $i = 1; foreach($faqs as $faq): ?>
        <tr <?=$faq->disabled == 1 ? 'style="background-color: #8080802e;"' : ''?>>
          <td><?=$faq->question?></td>
          <td><?=$faq->answer?></td>
          <td> <span
              <?=$faq->disabled == 0 ? 'class="label label-success"':'class="label label-danger"'?>><?=$faq->disabled == 0 ? 'Active':'Disabled'?></span>
          </td>
          <td><?=date('d-m-Y, H:i', strtotime($faq->created_at))?></td>
          <td colspan="2">
            <a href="#editProvider<?=$i?>" data-toggle="modal"><button class="btn btn-success fa fa-pen"></button></a>

            <div id="editProvider<?=$i?>" class="modal fade">
              <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Edit FAQ</h5> <button type="button" class="close"
                      data-dismiss="modal">×</button>
                  </div>
                  <div class="modal-body pt-4">
                    <form method="POST" action="<?=base_url()?>1dama3na/faqs/edit/<?=base64_encode($faq->id)?>">
                      <div class="form-group col-md-6" style="float: left"> <label> <span
                            class="label-text">Question</span>
                          <textarea name="question" placeholder="Question" required
                            class="form-control"><?=$faq->question?></textarea>
                        </label> </div>
                      <div class="form-group col-md-6" style="float: left"> <label> <span
                            class="label-text">Answer</span>
                          <textarea name="answer" placeholder="Answer"
                            class="form-control"><?=$faq->answer?></textarea>
                        </label> </div>
                      <div class="col-md-12" style="float: left">
                        <input type="submit" value="Update FAQ" style="width: inherit;"
                          class="btn btn-rounded btn-success"></div>
                    </form>
                  </div>
                </div>
              </div>
            </div>

            <a href="<?=base_url()?>1dama3na/faqs/status/<?=$faq->disabled.'/'.base64_encode($faq->id)?>"><button
                class="btn btn-danger fa fa-power-off"></button></a>
          </td>
        </tr>
        <?php $i++; endforeach ?>

      </tbody>
    </table>
    <div style="margin-left: 30px;"><a href="#addProvider" class="btn btn-primary" data-toggle="modal">Add FAQ</a>
    </div>
  </div>
</div>

<div id="addProvider" class="modal fade">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add FAQ</h5> <button type="button" class="close" data-dismiss="modal">×</button>
      </div>
      <div class="modal-body pt-4">
        <form method="POST" action="<?=base_url()?>1dama3na/faqs/add">
          <div class="form-group col-md-6" style="float: left"> <label> <span class="label-text">Question</span>
              <textarea name="question" placeholder="Question" required class="form-control"></textarea>
            </label> </div>
          <div class="form-group col-md-6" style="float: left"> <label> <span class="label-text">Answer</span>
              <textarea name="answer" placeholder="Answer" class="form-control"></textarea>
            </label> </div>
          <div class="col-md-12" style="float: left">
            <input type="submit" value="Add FAQ" style="width: inherit;" class="btn btn-rounded btn-success">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>