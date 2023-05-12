<?php $session = session(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

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
  <script type="text/javascript" src="<?php echo base_url('asset/sipiutang/user.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('asset/sipiutang/customer.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('asset/sipiutang/invoice.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('asset/sipiutang/piutang.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('asset/sipiutang/payment.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('asset/sipiutang/retur.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('asset/sipiutang/laporan.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('asset/sipiutang/dashboard.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('asset/sipiutang/bank.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('asset/sipiutang/rekpenerima.js'); ?>"></script>
  
</head>
<body class="hold-transition sidebar-mini layout-fixed" ng-app="sipiutang">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?= base_url('/asset/img/agungyama.png') ?>" alt="AdminLTELogo" height="200" width="200">
    <h1>Agung Yama Abadi</h1>
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto" ng-controller="piutang" >
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge" ng-init="getNotification()">{{ jml_data }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" ng-init="getNotification()">
          <span class="dropdown-item dropdown-header">Notifikasi Jatuh Tempo</span>
          <div class="dropdown-divider"></div>
          <div ng-repeat="d in datas">
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2" style="overflow: hidden; width: 170px;"> {{ d.nama_cstmr }}</i>
              <span class="float-right text-muted text-sm"><p style="font-size: x-small; font-weight: bold; color: red;">Jatuh Tempo</p></span>
            </a>
            <div class="dropdown-divider"></div>
          </div>
          <a href="<?= base_url('/piutang/') ?>" class="dropdown-item dropdown-footer">Lihat Semua Data</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item" ng-controller="user" ng-init="getDetailHeaderData(<?= $session->get('id') ?>)">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ formModel.nama }}</span>
            <img class="img-profile rounded-circle" style="height: 20px; wight:20px;"
                src="{{ foto }}">
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="userDropdown">
            <a class="dropdown-item" href="#" ng-click="getDetailHeader(<?= $session->get('id') ?>)" data-toggle="modal" data-target="#detailEditUserHeader">
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                Profile
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Logout
            </a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
   <!-- Modal -->
   <div class="modal fade" role="dialog" id="detailUserHeader" ng-controller="user" ng-init="getDetailHeaderData(<?= $session->get('id') ?>)">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" name="formDetUser" id="formDetUser" ng-submit="updateData()">
                <div class="modal-header">
                    <h4 class="modal-title" ng-model="modalTitle">{{modalTitle}}</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="alert alert-danger alert-dismissable" ng-show="error">
                            <a href="#" class="close" data-dismiss="alert"
                                aria-label="close">&times;</a>{{message}}
                        </div>
                        <div class="alert alert-success alert-dismissable" ng-show="success">
                            <a href="#" class="close" data-dismiss="alert"
                                aria-label="close">&times;</a>{{message}}
                        </div>
                    </div>
                    <div class="col-sm-12 mb-6 mb-sm-0">
                        <div class="col"><label>Nama</label></div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="form-group row">
                                <input type="text" class="form-control" name="nama" ng-model="formModel.nama"
                                    ng-required="true" ng-readonly="false">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-6 mb-sm-0">
                        <div class="col"><label>Username</label><br>
                            <small style="color: red;"
                                ng-show="fomUser.username.$touched && fomUser.username.$error.required">Masukan
                                Username</small>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="form-group row">
                                <input type="text" class="form-control" name="username" ng-model="formModel.username"
                                    ng-required="true" 
                                    ng-style="fomUser.username.$dirty && fomUser.username.$invalid && {'border':'solid red'}">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-6 mb-sm-0">
                        <div class="col">
                            <label>Password</label><br>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <small style="color: red;"
                                    ng-show="fomUser.password.$touched && fomUser.password.$error.required">Masukan
                                    Password</small>
                                <small style="color: red;"
                                    ng-show="fomUser.password.$touched && fomUser.password.$error.minlength">Minimal
                                    8 Karakter</small>
                            </div>
                            <div class="col-sm-6"><small ng-style="s_msg">{{msg}}</small></div>
                            <div class="col-sm-6">
                                <input type="{{typepass}}" name="password" class="form-control"
                                    placeholder="Password" ng-model="formModel.password" ng-change="check()"
                                    ng-style="spassword" ng-required="false" ng-minlength="8">
                            </div>
                            <div class="col-sm-6">
                                <input type="{{typepass}}" class="form-control" name="repass"
                                    placeholder="Repeat Password" ng-required="false" ng-model="formModel.repass"
                                    ng-change="check()" ng-style="srepass">
                            </div>
                            <div><span class="{{showHide}}" style="cursor: pointer; margin-top: 10px"
                                    ng-click="showPassword()" style="align-content: center"></span></div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-6 mb-sm-0" ng-hide="false">
                        <div class="col"><label>Role</label></div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="form-group row" ng-init="dataRole()">
                                <select style="width: 100%;" id="userrole" select2="" class="form-control"
                                    name="role" ng-model="formModel.role"
                                    ng-options="role.id as role.role for role in getRole"
                                    ng-required="true" ng-disabled="readOnly">
                                    <option value="">---select here---</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-6 mb-sm-0" ng-hide="false">
                        <div class="col"><label>Status</label></div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="form-group row" ng-init="dataStatus()">
                                <select style="width: 100%;" id="userstatus" select2="" class="form-control"
                                    name="status" ng-model="formModel.status"
                                    ng-options="status.id as status.status for status in getStatus"
                                    ng-required="true" ng-disabled="readOnly">
                                    <option value="">---select here---</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-6 mb-sm-0">
                        <div class="col"><label>Foto</label></div>
                        <div class="form-group row">
                            <div class="col-3">
                                <img style="width: 80px; height: 100px;" src="{{foto}}" ng-hide="false"
                                    class="img-thumbnail">
                            </div>
                            <div class="col-9">
                                <input type="file" class="form-control" ng-required="false" name="files"
                                    file-input="files" ng-model="files">
                            </div>
                        </div>
                    </div>
                </div>
                <input type="text" ng-model="formModel.id" ng-hide="true" disabled>
                <div class="modal-footer">
                <button type="submit" class="btn btn-success col-sm-3 mb-6"><i class="fas fa-save">
                    </i></button>
                <button type="button" class="btn btn-danger col-sm-3 mb-6"
                    ng-click="closeModal('#detailUser')"><i class="fas fa-chevron-circle-left">
                        </i></button>
                </div>
            </form>
        </div>
      </div>
    </div>
  <!-- Modal -->

  
