<input type="hidden" class="form-control" id="validationDefault01" name = "action" value = "<?= $data ? 'edit' : 'add' ?>">
<input type="hidden" class="form-control" id="validationDefault01" name = "primary_id" value = "<?= $data ? $data->maintinance_id : '' ?>">

<div class="row">
  <div class="col-md-12">
    <label for="validationDefault02" class="form-label">Date Request</label>
    <input type="date" class="form-control" id="validationDefault02" name = "date_requested" value = "<?= $data ? $data->date_requested : '' ?>" required>
  </div>
  <div class="col-md-12">
    <label for="validationDefault01" class="form-label">Descripton/Reason For Maintinance</label>
    <textarea name="desc" class="form-control" id="" cols="30" rows="10" required><?= $data ? $data->desc : '' ?></textarea>
  </div>

</div>

