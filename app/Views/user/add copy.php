<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" ng-controller="user">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah User</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">User</a></li>
                    <li class="breadcrumb-item active">Tambah User</li>
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
                                        <form class="user" method="POST" enctype="multipart/form-data" name="fomUser"
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
                                                            ng-style="spassword" ng-required="true" ng-minlength="8">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="{{typepass}}" class="form-control" name="repass"
                                                            placeholder="Repeat Password" ng-required="true" ng-model="formModel.repass"
                                                            ng-change="check()" ng-style="srepass">
                                                    </div>
                                                    <div><span class="{{showHide}}" style="cursor: pointer; margin-top: 10px"
                                                            ng-click="showPassword()" style="align-content: center"></span></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mb-6 mb-sm-0">
                                                <div class="col"><label>Nama</label><br>
                                                    <small style="color: red;"
                                                        ng-show="fomUser.nama.$touched && fomUser.nama.$error.required">Masukan
                                                         Nama</small>
                                                </div>
                                                <div class="col-sm-12 mb-6 mb-sm-0">
                                                    <div class="form-group row">
                                                        <input type="nama" class="form-control" name="nama" ng-model="formModel.nama"
                                                            ng-required="true"
                                                            ng-style="fomUser.nama.$dirty && fomUser.nama.$invalid && {'border':'solid red'}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mb-6 mb-sm-0" ng-hide="false">
                                                <div class="col"><label>Role</label></div>
                                                <div class="col-sm-12 mb-6 mb-sm-0">
                                                    <div class="form-group row" ng-init="dataRole()">
                                                        <select style="width: 100%;" id="role" select2="" class="form-control"
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
                                                        <select style="width: 100%;" id="status" select2="" class="form-control"
                                                            name="status" ng-model="formModel.status"
                                                            ng-options="status.id as status.status for status in getStatus"
                                                            ng-required="true" ng-disabled="readOnly">
                                                            <option value="">---select here---</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mb-6 mb-sm-0">
                                                <div class="col"><label>Foto</label><small style="color: red;"
                                                        ng-show="fomUser.file_foto.$touched && fomUser.file_foto.$error.required">Pilih
                                                        Foto Pegawai</small></div>
                                                <div class="form-group row">
                                                    <input type="file" class="form-control" ng-required="false" name="file_foto"
                                                        file-input="files"
                                                        onchange="angular.element(this).scope().filesChanged(this)" multiple>
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