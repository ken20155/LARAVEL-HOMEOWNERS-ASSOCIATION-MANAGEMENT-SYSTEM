<input type="hidden" class="form-control" id="validationDefault01" name = "action" value = "<?= $data ? 'edit' : 'add' ?>">
<input type="hidden" class="form-control" id="validationDefault01" name = "primary_id" value = "<?= $data ? $data->complain_id : '' ?>">

<div class="row">
  <div class="col-md-12">
    <label for="validationDefault01" class="form-label">Complainant Name</label>
    <input type="text" class="form-control" value="<?= $my_name->first_name.' '.$my_name->middle_name.' '.$my_name->last_name ?>" readonly>
  </div>
  <div class="col-md-12">
    <label for="validationDefault01" class="form-label">Respondent Name</label>
    <input type="text" name = "respondent_name" value = "<?= $data ? $data->respondent_name : '' ?>" class="form-control" required>
  </div>
  <div class="col-md-12">
    <label for="validationDefault01" class="form-label">Descripton/Reason For Complains</label>
    <textarea name="desc" class="form-control" id="" cols="30" rows="10" required><?= $data ? $data->desc : '' ?></textarea>
  </div>

</div>

