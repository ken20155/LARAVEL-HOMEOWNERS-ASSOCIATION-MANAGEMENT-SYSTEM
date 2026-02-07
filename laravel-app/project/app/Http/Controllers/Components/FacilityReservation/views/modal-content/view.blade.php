<input type="hidden" class="form-control" id="validationDefault01" name = "action" value = "<?= $data ? 'edit' : 'add' ?>">
<input type="hidden" class="form-control" id="validationDefault01" name = "primary_id" value = "<?= $data ? $data->book_id : '' ?>">
<?php 
$facility_type = $data ? $data->facility_type : '';
?>
<div class="row">
  <div class="mb-3 col-md-12">
    <label for="validationDefault02" class="form-label">Facility Type</label>
    <select name="facility_type" class="form-control" required>
      <option value="Gym" <?= $facility_type == 'Gym' ? 'selected' : ''?>>Gym</option>
      <option value="Gazebo" <?= $facility_type == 'Gazebo' ? 'selected' : ''?>>Gazebo</option>
      <option value="Court" <?= $facility_type == 'Court' ? 'selected' : ''?>>Court</option>
    </select>
  </div>
  <div class="mb-3 col-md-12">
    <label for="validationDefault02" class="form-label">Date Request</label>
    <input type="date" class="form-control" id="validationDefault02" name = "date" value = "<?= $data ? $data->date : '' ?>" min = "<?= date(SQLDATE) ?>" required>
  </div>
  <div class="mb-3 col-md-6">
    <label for="validationDefault02" class="form-label">Time Start</label>
    <input type="time" class="form-control" id="validationDefault02" name = "time_start" value = "<?= $data ? $data->time_start : '' ?>" required>
  </div>
  <div class="mb-3 col-md-6">
    <label for="validationDefault02" class="form-label">Time End</label>
    <input type="time" class="form-control" id="validationDefault02" name = "time_end" value = "<?= $data ? $data->time_end : '' ?>" required>
  </div>
  <div class="mb-3 col-md-12">
    <label for="validationDefault01" class="form-label">Description/Reason For Book</label>
    <textarea name="desc" class="form-control" id="" cols="30" rows="10" required><?= $data ? $data->desc : '' ?></textarea>
  </div>

</div>

