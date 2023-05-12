
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" ng-controller="customer">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Customer</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Customer</li>
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
                        <h6 class="m-0 font-weight-bold text-primary">Tabel Data Customer</h6>
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
                                style="margin-bottom: 10px;" ng-click="addBtn()"><i class="fas fa-plus fa-sm text-white-50"></i>Tambah
                                Data</button>
                            <table datatable="ng" dt-options="vm.dtOptions" class="table table-bordered" width="100%"
                                cellspacing="0" ng-init="getCustomer()">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th style="width: 20px;">No</th>
                                        <th>Nama Customer</th>
                                        <th>Alamat Customer</th>
                                        <th>No Telepon</th>
                                        <th>Nama Usaha</th>
                                        <th>Atas Nama</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr style="text-align: center;">
                                        <th style="width: 20px;">No</th>
                                        <th>Nama Customer</th>
                                        <th>Alamat Customer</th>
                                        <th>No Telepon</th>
                                        <th>Nama Usaha</th>
                                        <th>Atas Nama</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <tr ng-repeat="d in datas">
                                        <td>{{ $index +1 }}</td>
                                        <td>{{ d.nama_cstmr }}</td>
                                        <td>{{ d.alamat_cstmr }}</td>
                                        <td>{{ d.telepon }}</td>
                                        <td>{{ d.nama_usaha }}</td>
                                        <td>{{ d.atas_nama }}</td>
                                        <td style="text-align: center; width: 150px;">
                                            <button type="submit" style="margin-top: 5px;" class="btn btn-info" ng-click="getDetail(d.id)"><i
                                                    class="fa fa-edit"></i></button>
                                            <button type="submit" style="margin-top: 5px;" class="btn btn-danger" ng-click="deleteData(d.id)"><i
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
    <div class="modal fade" role="dialog" id="detailCustomer">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <form method="POST" name="formDetCustomer" id="formDetCustomer" ng-submit="updateData()">
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
                </div>
                <input type="text" ng-model="formModel.id" ng-hide="false" disabled>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success col-sm-3 mb-6"><i class="fas fa-save">
                        </i></button>
                    <button type="button" class="btn btn-danger col-sm-3 mb-6"
                        ng-click="closeModal('#detailCustomer')"><i class="fas fa-chevron-circle-left">
                        </i></button>
                </div>
            </form>
            </div>
        </div>
    </div>
  <!-- Modal -->
  </div>
  <!-- /.content-wrapper -->