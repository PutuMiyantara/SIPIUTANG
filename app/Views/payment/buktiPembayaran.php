<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SI PIUTANG</title>

  
  <!-- angularjs -->
  <script src="<?= base_url('asset/angularjs/jquery.min.js') ?>"></script>
  <script src="<?= base_url('asset/angularjs/angular.js') ?>"></script>
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('/asset/plugins/fontawesome-free/css/all.min.css') ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url('/asset/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') ?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url('/asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('/asset/dist/css/adminlte.min.css') ?>">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url('/asset/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') ?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= base_url('/asset/plugins/daterangepicker/daterangepicker.css') ?>">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url('/asset/plugins/summernote/summernote-bs4.min.css') ?>">

  <!-- chart -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/angular.chartjs/latest/angular-chart.min.js"></script>


  <!-- <script src="<?= base_url('/asset/angularjs/chart/Chart.min.js') ?>"></script>
  <script src="<?= base_url('/asset/angularjs/chart/angular-chart.min.js') ?>"></script> -->
  <!-- chart -->

  <!-- search select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.2.0/dist/select2-bootstrap-5-theme.min.css" />
  <!-- search select2 -->

  <!-- data table -->
  <!-- <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script> -->
  <!-- <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet"> -->
  <script src="<?= base_url('asset/angularjs/angular-datatables.min.js') ?>"></script>
  <script src="<?= base_url('asset/angularjs/dataTable/jquery.dataTables.min.js') ?>"></script>
  <link href="<?= base_url('asset/angularjs/dataTable/css/jquery.dataTables.min.css') ?>" rel="stylesheet">
  <!-- data table -->
    
  <!-- js -->
  <script type="text/javascript" src="<?php echo base_url('asset/sipiutang/sipiutang.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('asset/sipiutang/auth.js'); ?>"></script>
</head>
<body class="hold-transition login-page" ng-app="sipiutang">
<img src="<?= base_url("/foto/") ?>">
<!-- /.login-box -->

<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('/asset/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('/asset/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<!-- ChartJS -->
<script src="<?= base_url('/asset/plugins/chart.js/Chart.min.js') ?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url('/asset/plugins/jquery-knob/jquery.knob.min.js') ?>"></script>
<!-- daterangepicker -->
<script src="<?= base_url('/asset/plugins/moment/moment.min.js') ?>"></script>
<script src="<?= base_url('/asset/plugins/daterangepicker/daterangepicker.js') ?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url('/asset/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') ?>"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('/asset/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('/asset/dist/js/adminlte.js') ?>"></script>

</body>
</html>
