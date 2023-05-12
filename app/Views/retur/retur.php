
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" ng-controller="retur">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Retur</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Retur</li>
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
                        <h6 class="m-0 font-weight-bold text-primary">Tabel Data Retur</h6>
                    </div>
                    <div class="card-body">
                        <div>
                            <div class="alert alert-danger alert-dismissable" ng-show="error">
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
                                cellspacing="0" ng-init="getRetur()">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th style="width: 20px;">No</th>
                                        <th>No Retur</th>
                                        <th>Tanggal Retur</th>
                                        <th>Nilai Retur</th>
                                        <th>Nilai Sisa Retur</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr style="text-align: center;">
                                        <th style="width: 20px;">No</th>
                                        <th>No Retur</th>
                                        <th>Tanggal Retur</th>
                                        <th>Nilai Retur</th>
                                        <th>Nilai Sisa Retur</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <tr ng-repeat="d in datas">
                                        <td>{{ $index +1 }}</td>
                                        <td>{{ d.no_retur }}</td>
                                        <td>{{ d.tgl_retur }}</td>
                                        <td>Rp. {{ d.nilai_retur }}</td>
                                        <td>Rp. {{ d.nilai_sisa_retur }}</td>
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
    <div class="modal fade" role="dialog" id="detailRetur">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <form method="POST" name="formDetUser" id="formDetUser" ng-submit="updateData()">
                <div class="modal-header">
                    <h4 class="modal-title" ng-model="modalTitle">{{modalTitle}}</h4>
                </div>
                <div class="modal-body">
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
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="form-group row">
                                <input type="text" class="form-control" name="no_retur" ng-model="formModel.no_retur"
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
                                <input type="date" class="form-control" name="tgl_retur" ng-model="formModel.tgl_retur"
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
                                <input type="text" class="form-control" number-input name="nilai_retur" ng-model="formModel.nilai_retur"
                                    ng-required="false" ng-disabled="true" ng-readonly="true"
                                    ng-style="formRetur.nilai_retur.$dirty && formRetur.nilai_retur.$invalid && {'border':'solid red'}">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-6 mb-sm-0" ng-hide="hideretur">
                        <div class="col"><label>Nilai Sisa Retur</label><br>
                            <small style="color: red;"
                                ng-show="formRetur.nilai_sisa_retur.$touched && formRetur.nilai_sisa_retur.$error.required">Masukan
                                Nilai Sisa Retur</small>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="form-group row">
                                <input type="text" class="form-control" number-input name="nilai_sisa_retur" ng-model="formModel.nilai_sisa_retur"
                                    ng-required="false" ng-disabled="true" ng-readonly="true"
                                    ng-style="formRetur.nilai_sisa_retur.$dirty && formRetur.nilai_sisa_retur.$invalid && {'border':'solid red'}">
                            </div>
                        </div>
                    </div>
                </div>
                <input type="text" ng-model="formModel.id" ng-hide="false" disabled>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success col-sm-3 mb-6"><i class="fas fa-save">
                        </i></button>
                    <button type="button" class="btn btn-danger col-sm-3 mb-6"
                        ng-click="closeModal('#detailRetur')"><i class="fas fa-chevron-circle-left">
                        </i></button>
                </div>
            </form>
            </div>
        </div>
    </div>
  <!-- Modal -->
  </div>
  <!-- /.content-wrapper -->

  <script>
    // function formatRupiah(angka, rupiah){
    //     var number_string = angka.replace(/[^,\d]/g, '').toString(),
    //     split   		= number_string.split(','),
    //     sisa     		= split[0].length % 3,
    //     rupiah     		= split[0].substr(0, sisa),
    //     ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
    
    //     // tambahkan titik jika yang di input sudah menjadi angka ribuan
    //     if(ribuan){
    //         separator = sisa ? '.' : '';
    //         rupiah += separator + ribuan.join('.');
    //     }
    
    //     rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    //     return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    // }
  </script>