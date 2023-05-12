
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" ng-controller="rekpenerima">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Bank</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('/dashboard') ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('/bank') ?>">Bank</a></li>
                    <li class="breadcrumb-item active">Tambah Bank</li>
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
                                        <form class="user" method="POST" enctype="multipart/form-data" name="formBank"
                                            ng-submit="insertData()">
                                            <div>
                                                <div class="alert alert-danger alert-dismissable" ng-show="error">
                                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>{{message}}
                                                </div>
                                                <div class="alert alert-success alert-dismissable" ng-show="success">
                                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>{{message}}
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mb-6 mb-sm-0">
                                                <div class="col"><label>Nama Rekening Penerima</label><br>
                                                    <small style="color: red;"
                                                        ng-show="formRekPenerima.nama_rekening.$touched && formRekPenerima.nama_rekening.$error.required">Masukan
                                                        Nama Rekening Penerima</small>
                                                </div>
                                                <div class="col-sm-12 mb-6 mb-sm-0">
                                                    <div class="form-group row">
                                                        <input type="text" class="form-control" name="nama_rekening" ng-model="formModel.nama_rekening"
                                                            ng-required="true"
                                                            ng-style="formRekPenerima.nama_rekening.$dirty && formRekPenerima.nama_rekening.$invalid && {'border':'solid red'}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mb-6 mb-sm-0">
                                                <div class="col"><label>Nomor Rekening</label><br>
                                                    <small style="color: red;"
                                                        ng-show="formRekPenerima.nomor_rekening.$touched && formRekPenerima.nomor_rekening.$error.required">Masukan
                                                        Nomor Rekening</small>
                                                </div>
                                                <div class="col-sm-12 mb-6 mb-sm-0">
                                                    <div class="form-group row">
                                                        <input type="number" class="form-control" name="nomor_rekening" ng-model="formModel.nomor_rekening"
                                                            ng-required="true"
                                                            ng-style="formRekPenerima.nomor_rekening.$dirty && formRekPenerima.nomor_rekening.$invalid && {'border':'solid red'}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mb-6 mb-sm-0" ng-hide="false">
                                                <div class="col"><label>Bank</label></div>
                                                <div class="col-sm-12 mb-6 mb-sm-0">
                                                    <div class="form-group row" ng-init="dataBank()">
                                                        <select style="width: 100%;" id="id_bank_penerima" select2="" class="form-control"
                                                            name="id_bank_penerima" ng-model="formModel.id_bank_penerima"
                                                            ng-options="id_bank_penerima.id as id_bank_penerima.nama_bank for id_bank_penerima in getBank"
                                                            ng-required="true" ng-disabled="readOnly">
                                                            <option value="">---select here---</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mb-6 mb-sm-0">
                                                <div class="col"><label>Keterangan</label><br>
                                                    <small style="color: red;"
                                                        ng-show="formRekPenerima.keterangan.$touched && formRekPenerima.keterangan.$error.required">Masukan
                                                        Keterangan</small>
                                                </div>
                                                <div class="col-sm-12 mb-6 mb-sm-0">
                                                    <div class="form-group row">
                                                        <input type="text" class="form-control" name="keterangan" ng-model="formModel.keterangan"
                                                            ng-required="true"
                                                            ng-style="formRekPenerima.keterangan.$dirty && formRekPenerima.keterangan.$invalid && {'border':'solid red'}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-6 col-lg-12"></div>
                                                <div class="col-xl-6 col-lg-12">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <a class="btn btn-danger btn-block text-white" href="/user/" title="Kembali"><i class="fas fa-chevron-circle-left"></i></a>
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