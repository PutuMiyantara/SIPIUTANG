
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" ng-controller="rekpenerima">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Rekening Penerima</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Rekening Penerima</li>
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
                        <h6 class="m-0 font-weight-bold text-primary">Tabel Data Rekening Penerima</h6>
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
                                cellspacing="0" ng-init="getRekPenerima()">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th style="width: 20px;">No</th>
                                        <th>Nama Penerima</th>
                                        <th>Nama Bank</th>
                                        <th>Nomor Rekening</th>
                                        <th>Keterangan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr style="text-align: center;">
                                        <th style="width: 20px;">No</th>
                                        <th>Nama Penerima</th>
                                        <th>Nama Bank</th>
                                        <th>Nomor Rekening</th>
                                        <th>Keterangan</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <tr ng-repeat="d in datas">
                                        <td>{{ $index +1 }}</td>
                                        <td>{{ d.nama_rekening }}</td>
                                        <td>{{ d.nama_bank }}</td>
                                        <td>{{ d.nomor_rekening }}</td>
                                        <td>{{ d.keterangan }}</td>
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
    <div class="modal fade" role="dialog" id="detailRekPenerima">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <form method="POST" name="formRekPenerima" id="formRekPenerima" ng-submit="updateData()">
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
                        <div class="col"><label>Nomor Rekening</label><br>
                            <small style="color: red;"
                                ng-show="formRekPenerima.nomor_rekening.$touched && formRekPenerima.nomor_rekening.$error.required">Masukan
                                Nomor Rekening</small>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="form-group row">
                                <input type="text" class="form-control" name="nomor_rekening" ng-model="formModel.nomor_rekening"
                                    ng-required="true"
                                    ng-style="formRekPenerima.nomor_rekening.$dirty && formRekPenerima.nomor_rekening.$invalid && {'border':'solid red'}">
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