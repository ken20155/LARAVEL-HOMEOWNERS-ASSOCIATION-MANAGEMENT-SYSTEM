<input type="hidden" class="form-control" id="validationDefault01" name = "action" value = "<?= $data ? 'edit' : 'add' ?>">
<input type="hidden" class="form-control" id="validationDefault01" name = "client_id" value = "<?= $data ? $data->client_id : '' ?>">

<div class="row">
  <div class="col-md-4">
    <label for="validationDefault01" class="form-label">First name</label>
    <input type="text" class="form-control" id="validationDefault01" name = "first_name" value = "<?= $data ? $data->first_name : '' ?>" required>
  </div>
  <div class="col-md-4">
    <label for="validationDefault02" class="form-label">Middle name</label>
    <input type="text" class="form-control" id="validationDefault02" name = "middle_name" value = "<?= $data ? $data->middle_name : '' ?>" required>
  </div>
  <div class="col-md-4">
    <label for="validationDefault02" class="form-label">Last name</label>
    <input type="text" class="form-control" id="validationDefault02" name = "last_name" value = "<?= $data ? $data->last_name : '' ?>" required>
  </div>
</div>
<div class="row">
  <div class="col-md-4">
    <label for="validationDefault01" class="form-label">Email</label>
    <input type="email" class="form-control" id="validationDefault01" name = "email" value = "<?= $data ? $data->email : '' ?>" required>
  </div>
  <div class="col-md-8">
    <label for="validationDefault02" class="form-label">Contact Number</label>
    <input type="text" class="form-control" id="validationDefault02" name = "phone_number" value = "<?= $data ? $data->contact_no : '' ?>" required>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <label for="validationDefault02" class="form-label">Address</label>
    <input type="text" class="form-control" id="validationDefault02" name = "address" value = "<?= $data ? $data->address : '' ?>" required>
  </div>
</div>
