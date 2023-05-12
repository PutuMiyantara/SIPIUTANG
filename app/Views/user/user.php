
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" ng-controller="user">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">User</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User</li>
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
                <!-- /.card-header -->
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Tabel Data User</h6>
                    </div>
                    <div class="card-body">
                        <div>
                            <div class="alert alert-danger alert-dismissable" ng-show="errror">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>{{message}}
                            </div>
                            <div class="alert alert-success alert-dismissable" ng-show="success">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>{{message}}
                            </div>
                        </div>
                        <div class="table-responsive">
                            <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                                style="margin-bottom: 10px;" ng-click="addUserBtn()"><i class="fas fa-plus fa-sm text-white-50"></i>Tambah
                                Data</button>
                            <table datatable="ng" dt-options="vm.dtOptions" class="table table-bordered" width="100%"
                                cellspacing="0" ng-init="getUser()">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th style="width: 20px;">No</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Peran</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr style="text-align: center;">
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Peran</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <tr ng-repeat="d in datas">
                                        <td>{{ $index +1 }}</td>
                                        <td>{{ d.nama }}</td>
                                        <td>{{ d.username }}</td>
                                        <td ng-if="d.role == '1'">Admin</td>
                                        <td ng-if="d.role == '2'">User</td>
                                        <td ng-if="d.status == '1'">Aktif</td>
                                        <td ng-if="d.status == '0'">Tidak Aktif</td>
                                        <td style="text-align: center; width: 150px;">
                                            <button type="submit" class="btn btn-info" ng-click="getDetail(d.id)"><i
                                                    class="fa fa-edit"></i></button>
                                            
                                            <button type="button" class="btn btn-danger" ng-click="deleteData(d.id)"><i
                                                class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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
    <!-- Modal -->
    <div class="modal fade" role="dialog" id="detailUser">
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
                                    <input type="password" name="password" class="form-control"
                                        placeholder="Password" ng-model="formModel.password" ng-change="check()"
                                        ng-style="spassword" ng-required="false" ng-minlength="8">
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control" name="repass"
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
  </div>
  <!-- /.content-wrapper -->