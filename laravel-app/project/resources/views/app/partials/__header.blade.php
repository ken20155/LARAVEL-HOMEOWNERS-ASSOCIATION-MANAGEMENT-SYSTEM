


<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?= $title ?> | <?= env('PROJECTTITLE') ?></title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="stylesheet" href="<?= env('APP_URL') ?>public/plugins/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="<?= env('APP_URL') ?>public/plugins/vendors/typicons.font/font/typicons.css">
    <link rel="stylesheet" href="<?= env('APP_URL') ?>public/plugins/vendors/css/vendor.bundle.base.css">
    <!-- endinject --> 
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?= env('APP_URL') ?>public/plugins/css/vertical-layout-light/style.css">
    <link rel="stylesheet" href="<?= env('APP_URL') ?>public/plugins/vendors/mdi/css/materialdesignicons.min.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?= env('APP_URL') ?>public/plugins/images/favicon.png" />

  </head>
  <body>
{{-- 
    <div id="preloader">
        <div class="spinner-border text-secondary" style="width: 3rem; height: 3rem;"  role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div id="preloader-text">Loading...</div>
    </div> --}}