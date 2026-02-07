<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title><?= $page ?> | <?= env('PROJECTTITLE') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Font Icon -->
    <link rel="stylesheet" href="<?= env('APP_URL') ?>public/main/login/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="<?= env('APP_URL') ?>public/main/login/css/style.css">
</head>
<body>

    <div class="main">
        <?= $content ?>
    </div>

    <!-- JS -->
    <script>
        var baseUrl = "<?= env('APP_URL') ?>";
    </script>
    <script src="<?= env('APP_URL') ?>public/plugins/assets/js/plugin/sweetalert/sweetalert.min.js"></script>
    <script src="<?= env('APP_URL') ?>public/main/login/vendor/jquery/jquery.min.js"></script>
    <script src="<?= env('APP_URL') ?>public/main/js/main.js"></script>
    <script src="<?= env('APP_URL') ?>public/main/js/common.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>