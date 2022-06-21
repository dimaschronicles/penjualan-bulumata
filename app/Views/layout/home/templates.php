<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <title><?= $title; ?></title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>/css/bootstrap.min.css" />
    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>/css/slick.css" />
    <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>/css/slick-theme.css" />
    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>/css/nouislider.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="<?= base_url(); ?>/css/font-awesome.min.css">
    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>/css/style.css" />

</head>

<body>
    <!-- Header -->
    <?= $this->include('layout/home/header'); ?>
    <!-- End Header -->

    <!-- Navigation-->
    <?= $this->include('layout/home/navbar'); ?>
    <!-- End Navigation -->

    <!-- Section-->
    <?= $this->renderSection('content'); ?>
    <!-- End Section -->

    <!-- Footer-->
    <?= $this->include('layout/home/footer'); ?>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="<?= base_url(); ?>/assets/home/js/myscript.js"></script>
    <script src="<?= base_url(); ?>/js/jquery.min.js"></script>
    <script src="<?= base_url(); ?>/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>/js/slick.min.js"></script>
    <script src="<?= base_url(); ?>/js/nouislider.min.js"></script>
    <script src="<?= base_url(); ?>/js/jquery.zoom.min.js"></script>
    <script src="<?= base_url(); ?>/js/main.js"></script>
</body>

</html>