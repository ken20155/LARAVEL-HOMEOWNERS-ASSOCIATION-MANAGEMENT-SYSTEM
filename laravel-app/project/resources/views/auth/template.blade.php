<!DOCTYPE html>
    <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - <?= env('PROJECTTITLE') ?></title>

      <!-- base:css -->
      <link rel="stylesheet" href="<?= env('APP_URL') ?>public/plugins/vendors/typicons.font/font/typicons.css">
      <link rel="stylesheet" href="<?= env('APP_URL') ?>public/plugins/vendors/css/vendor.bundle.base.css">
      <!-- endinject -->
      <!-- plugin css for this page -->
      <!-- End plugin css for this page -->
      <!-- inject:css -->
      <link rel="stylesheet" href="<?= env('APP_URL') ?>public/plugins/css/vertical-layout-light/style.css">
      <!-- endinject -->
      <link rel="shortcut icon" href="<?= env('APP_URL') ?>public/plugins/images/favicon.png" />
  </head>
  <body>

        <?= $content ?>

    <!-- JS -->
    <script>
        var baseUrl = "<?= env('APP_URL') ?>";
    </script>
    <script src="<?= env('APP_URL') ?>public/plugins/js2/sweetalert.min.js"></script>
    <script src="<?= env('APP_URL') ?>public/plugins/js2/jquery.min.js"></script>


    {{-- main --}}
    <script src="<?= env('APP_URL') ?>public/main/js/main.js"></script>
    <script src="<?= env('APP_URL') ?>public/main/js/common.js"></script>
</body>
</html>
