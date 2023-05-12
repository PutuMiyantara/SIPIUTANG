
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" ng-controller="customer">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Customer</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Customer</a></li>
                    <li class="breadcrumb-item active">Tambah Customer</li>
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
                                        <form class="user" method="POST" enctype="multipart/form-data" name="formCustomer"
                                            ng-submit="insertData()" id="formTambahUser">
                                            <div>
                                                <div class="alert alert-danger alert-dismissable" ng-show="error">
                                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>{{message}}
                                                </div>
                                                <div class="alert alert-success alert-dismissable" ng-show="success">
                                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>{{message}}
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mb-6 mb-sm-0">
                                                <div class="col"><label>Nama Customer</label><br>
                                                    <small style="color: red;"
                                                        ng-show="formCustomer.nama_cstmr.$touched && formCustomer.nama_cstmr.$error.required">Masukan
                                                        Nama Customer</small>
                                                </div>
                                                <div class="col-sm-12 mb-6 mb-sm-0">
                                                    <div class="form-group row">
                                                        <input type="text" class="form-control" name="nama_cstmr" ng-model="formModel.nama_cstmr"
                                                            ng-required="true"
                                                            ng-style="formCustomer.nama_cstmr.$dirty && formCustomer.nama_cstmr.$invalid && {'border':'solid red'}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mb-6 mb-sm-0">
                                                <div class="col"><label>Alamat Customer</label><br>
                                                    <small style="color: red;"
                                                        ng-show="formCustomer.alamat_cstmr.$touched && formCustomer.alamat_cstmr.$error.required">Masukan
                                                        Alamat Customer</small>
                                                </div>
                                                <div class="col-sm-12 mb-6 mb-sm-0">
                                                    <div class="form-group row">
                                                        <input type="text" class="form-control" name="alamat_cstmr" ng-model="formModel.alamat_cstmr"
                                                            ng-required="true"
                                                            ng-style="formCustomer.alamat_cstmr.$dirty && formCustomer.alamat_cstmr.$invalid && {'border':'solid red'}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mb-6 mb-sm-0" ng-hide="false">
                                                <div class="col"><label>Bank</label></div>
                                                <div class="col-sm-12 mb-6 mb-sm-0">
                                                    <div class="form-group row" ng-init="dataBank()">
                                                        <select style="width: 100%;" id="id_bank" select2="" class="form-control"
                                                            name="id_bank" ng-model="formModel.id_bank"
                                                            ng-options="id_bank.id as id_bank.nama_bank for id_bank in getBank"
                                                            ng-required="true" ng-disabled="readOnly">
                                                            <option value="">---select here---</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mb-6 mb-sm-0">
                                                <div class="col"><label>Nomor Rekening</label><br>
                                                    <small style="color: red;"
                                                        ng-show="formCustomer.rekening.$touched && formCustomer.rekening.$error.required">Masukan
                                                        Nomor Rekening</small>
                                                </div>
                                                <div class="col-sm-12 mb-6 mb-sm-0">
                                                    <div class="form-group row">
                                                        <input type="text" class="form-control" name="rekening" ng-model="formModel.rekening"
                                                            ng-required="true"
                                                            ng-style="formCustomer.rekening.$dirty && formCustomer.rekening.$invalid && {'border':'solid red'}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mb-6 mb-sm-0">
                                                <div class="col"><label>Nomor KTP</label><br>
                                                    <small style="color: red;"
                                                        ng-show="formCustomer.ktp.$touched && formCustomer.ktp.$error.required">Masukan
                                                        Nomor KTP</small>
                                                </div>
                                                <div class="col-sm-12 mb-6 mb-sm-0">
                                                    <div class="form-group row">
                                                        <input type="number" class="form-control" name="ktp" ng-model="formModel.ktp"
                                                            ng-required="true"
                                                            ng-style="formCustomer.ktp.$dirty && formCustomer.ktp.$invalid && {'border':'solid red'}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mb-6 mb-sm-0">
                                                <div class="col"><label>Nomor Telepon</label><br>
                                                    <small style="color: red;"
                                                        ng-show="formCustomer.telepon.$touched && formCustomer.telepon.$error.required">Masukan
                                                        Nomor Telepon</small>
                                                </div>
                                                <div class="col-sm-12 mb-6 mb-sm-0">
                                                    <div class="form-group row">
                                                        <input type="number" class="form-control" name="telepon" ng-model="formModel.telepon"
                                                            ng-required="true"
                                                            ng-style="formCustomer.telepon.$dirty && formCustomer.telepon.$invalid && {'border':'solid red'}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mb-6 mb-sm-0">
                                                <div class="col"><label>Alamat Email</label><br>
                                                    <small style="color: red;"
                                                        ng-show="formCustomer.email.$touched && formCustomer.email.$error.required">Masukan
                                                        Alamat Email</small>
                                                </div>
                                                <div class="col-sm-12 mb-6 mb-sm-0">
                                                    <div class="form-group row">
                                                        <input type="email" class="form-control" name="email" ng-model="formModel.email"
                                                            ng-required="true"
                                                            ng-style="formCustomer.email.$dirty && formCustomer.email.$invalid && {'border':'solid red'}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mb-6 mb-sm-0">
                                                <div class="col"><label>Atas Nama</label><br>
                                                    <small style="color: red;"
                                                        ng-show="formCustomer.atas_nama.$touched && formCustomer.atas_nama.$error.required">Masukan
                                                        Atas Nama</small>
                                                </div>
                                                <div class="col-sm-12 mb-6 mb-sm-0">
                                                    <div class="form-group row">
                                                        <input type="text" class="form-control" name="atas_nama" ng-model="formModel.atas_nama"
                                                            ng-required="true"
                                                            ng-style="formCustomer.atas_nama.$dirty && formCustomer.atas_nama.$invalid && {'border':'solid red'}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mb-6 mb-sm-0">
                                                <div class="col"><label>Nama Usaha</label><br>
                                                    <small style="color: red;"
                                                        ng-show="formCustomer.nama_usaha.$touched && formCustomer.nama_usaha.$error.required">Masukan
                                                        Nama Usaha</small>
                                                </div>
                                                <div class="col-sm-12 mb-6 mb-sm-0">
                                                    <div class="form-group row">
                                                        <input type="text" class="form-control" name="nama_usaha" ng-model="formModel.nama_usaha"
                                                            ng-required="true"
                                                            ng-style="formCustomer.nama_usaha.$dirty && formCustomer.nama_usaha.$invalid && {'border':'solid red'}">
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