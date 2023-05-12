
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" ng-controller="retur">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Retur</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Retur</a></li>
                    <li class="breadcrumb-item active">Tambah Retur</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- CONTENT -->
                        <div class="card">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <form class="user" method="POST" enctype="multipart/form-data" name="formRetur"
                                            ng-submit="insertData()" id="formTambahRetur">
                                            <div>
                                                <div class="alert alert-danger alert-dismissable" ng-show="error">
                                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>{{message}}
                                                </div>
                                                <div class="alert alert-success alert-dismissable" ng-show="success">
                                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>{{message}}
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mb-6 mb-sm-0">
                                                <div class="col"><label>No Retur</label><br>
                                                    <small style="color: red;"
                                                        ng-show="formRetur.no_retur.$touched && formRetur.no_retur.$error.required">Masukan
                                                        No Retur</small>
                                                </div>
                                                <div class="col-sm-12 mb-6 mb-sm-0" ng-init="getNoRetur()">
                                                    <div class="form-group row">
                                                        <input type="text" class="form-control" name="no_retur" ng-model="no_retur"
                                                            ng-required="true" ng-disabled="true"
                                                            ng-style="formRetur.no_retur.$dirty && formRetur.no_retur.$invalid && {'border':'solid red'}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mb-6 mb-sm-0">
                                                <div class="col"><label>Tanggal Retur</label><br>
                                                    <small style="color: red;"
                                                        ng-show="formRetur.tgl_retur.$touched && formRetur.tgl_retur.$error.required">Masukan
                                                        Tanggal Retur</small>
                                                </div>
                                                <div class="col-sm-12 mb-6 mb-sm-0">
                                                    <div class="form-group row">
                                                        <input type="date" class="form-control" name="tgl_retur" ng-model="tgl_retur"
                                                            ng-required="true"
                                                            ng-style="formRetur.tgl_retur.$dirty && formRetur.tgl_retur.$invalid && {'border':'solid red'}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mb-6 mb-sm-0" ng-hide="hideretur">
                                                <div class="col"><label>Nilai Retur</label><br>
                                                    <small style="color: red;"
                                                        ng-show="formRetur.nilai_retur.$touched && formRetur.nilai_retur.$error.required">Masukan
                                                        Nilai Retur</small>
                                                </div>
                                                <div class="col-sm-12 mb-6 mb-sm-0">
                                                    <div class="form-group row">
                                                        <input type="text" class="form-control" number-input name="nilai_retur" ng-model="nilai_retur"
                                                            ng-required="true"
                                                            ng-style="formRetur.nilai_retur.$dirty && formRetur.nilai_retur.$invalid && {'border':'solid red'}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-6 col-lg-12"></div>
                                                <div class="col-xl-6 col-lg-12">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <a class="btn btn-danger btn-block text-white" href="/retur/" title="Kembali"><i class="fas fa-chevron-circle-left"></i></a>
                                                        </div>
                                                        <div class="col-6">
                                                            <button type="submit" name="btnInsert"
                                                                class="btn btn-success col-md-12" title="Simpan Data"><i class="fas fa-save"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- CONTENT -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->