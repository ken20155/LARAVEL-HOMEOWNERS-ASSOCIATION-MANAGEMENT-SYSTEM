

<script>
  var baseUrl = "<?= env('APP_URL') ?>";
  var myModule = "<?= $params ?>";
  var user_role = "<?= $session['session']['user_role'] ?>";
</script>

<script src="<?= env('APP_URL') ?>public/plugins/js2/sweetalert.min.js"></script>
<script src="<?= env('APP_URL') ?>public/plugins/js2/jquery.min.js"></script>
<script src="<?= env('APP_URL') ?>public/plugins/vendors/js/vendor.bundle.base.js"></script>

<script src="<?= env('APP_URL') ?>public/plugins/js2/jquery.dataTables.js"></script>
<script src="<?= env('APP_URL') ?>public/plugins/js2/dataTables.bootstrap4.js"></script>
<script src="<?= env('APP_URL') ?>public/plugins/js2/jquery.blockUI.min.js"></script>



<!-- endinject -->
<!-- Plugin js for this page-->
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="<?= env('APP_URL') ?>public/plugins/js1/off-canvas.js"></script>
<script src="<?= env('APP_URL') ?>public/plugins/js1/hoverable-collapse.js"></script>
<script src="<?= env('APP_URL') ?>public/plugins/js1/template.js"></script>
<script src="<?= env('APP_URL') ?>public/plugins/js1/settings.js"></script>
<script src="<?= env('APP_URL') ?>public/plugins/js1/todolist.js"></script>
<!-- endinject -->
<!-- plugin js for this page -->
<script src="<?= env('APP_URL') ?>public/plugins/vendors/progressbar.js/progressbar.min.js"></script>
<script src="<?= env('APP_URL') ?>public/plugins/vendors/chart.js/Chart.min.js"></script>
<!-- End plugin js for this page -->
<!-- Custom js for this page-->
<script src="<?= env('APP_URL') ?>public/plugins/js1/dashboard.js"></script>



<script src="<?= env('APP_URL') ?>public/main/js/main.js"></script>
<script src="<?= env('APP_URL').$params ?>/js/custom"></script>
<script src="<?= env('APP_URL') ?>public/main/js/common.js"></script>

</body>
</html>
