<input type="hidden" class="form-control" id="validationDefault01" name = "action" value = "<?= $data ? 'edit' : 'add' ?>">
<input type="hidden" class="form-control" id="validationDefault01" name = "primary_id" value = "<?= $data ? $data->complain_id : '' ?>">

<div class="row">

  <div class="col-md-12">
    <label for="validationDefault01" class="form-label">Descripton/Reason For Complains</label>
    <textarea name="desc" class="form-control" id="" cols="30" rows="10" required><?= $data ? $data->desc : '' ?></textarea>
  </div>

</div>

