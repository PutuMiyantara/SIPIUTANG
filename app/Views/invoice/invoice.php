
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" ng-controller="invoice">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Invoice</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Invoice</li>
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
                        <h6 class="m-0 font-weight-bold text-primary">Tabel Data Invoice</h6>
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
                                cellspacing="0" ng-init="getInvoice()">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th style="width: 20px;">No</th>
                                        <th>No Invoice</th>
                                        <th>Nilai Invoice</th>
                                        <th>Nama Debitur</th>
                                        <th>Atas Nama</th>
                                        <th>Nama Usaha</th>
                                        <th>Jatuh Tempo</th>
                                        <th>Status Piutang</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr style="text-align: center;">
                                        <th style="width: 20px;">No</th>
                                        <th>No Invoice</th>
                                        <th>Nilai Invoice</th>
                                        <th>Nama Debitur</th>
                                        <th>Atas Nama</th>
                                        <th>Nama Usaha</th>
                                        <th>Jatuh Tempo</th>
                                        <th>Status Piutang</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <tr ng-repeat="d in datas">
                                        <td>{{ $index +1 }}</td>
                                        <td>{{ d.no_invoice }}</td>
                                        <td>Rp. {{ d.nilai_invoice }}</td>
                                        <td>{{ d.nama_cstmr }}</td>
                                        <td>{{ d.atas_nama }}</td>
                                        <td>{{ d.nama_usaha }}</td>
                                        <td ng-if="d.sts_jth_tmpo == true && d.sisa_hutang != '0'"><button class="btn btn-outline-danger">{{ d.jth_tmpo }}</button></td>
                                        <td ng-if="d.sts_jth_tmpo == true && d.sisa_hutang == '0'"><button class="btn btn-outline-primary">{{ d.jth_tmpo }}</button></td>
                                        <td ng-if="d.sts_jth_tmpo == false && d.sisa_hutang != '0'"><button class="btn btn-outline-primary">{{ d.jth_tmpo }}</button></td>
                                        <td ng-if="d.sts_jth_tmpo == false && d.sisa_hutang == '0'"><button class="btn btn-outline-primary">{{ d.jth_tmpo }}</button></td>
                                        <td ng-if="d.sisa_hutang != '0'"><button class="btn btn-danger">Belum</button></td>
                                        <td ng-if="d.sisa_hutang == '0'"><button class="btn btn-success">Lunas</button></td>
                                        <td style="text-align: center; width: 150px;">
                                            <button type="submit" style="margin-top: 5px;" class="btn btn-info" ng-click="getDetail(d.id)"><i
                                                    class="fa fa-edit"></i></button>
                                            <button type="submit" style="margin-top: 5px;" class="btn btn-danger" ng-click="deleteData(d.id, d.id_retur, d.potongan_retur)"><i
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
    <div class="modal fade" role="dialog" id="detailInvoice">
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
                        <div class="col"><label>No Invoice</label><br>
                            <small style="color: red;"
                                ng-show="formInvoice.no_invoice.$touched && formInvoice.no_invoice.$error.required">Masukan
                                No Invoice</small>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="form-group row">
                                <input type="text" class="form-control" name="no_invoice" ng-model="formModel.no_invoice"
                                    ng-required="false"
                                    ng-style="formInvoice.no_invoice.$dirty && formInvoice.no_invoice.$invalid && {'border':'solid red'}">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-6 mb-sm-0">
                        <div class="col"><label>Nilai Invoice</label><br>
                            <small style="color: red;"
                                ng-show="formInvoice.nilai_invoice.$touched && formInvoice.nilai_invoice.$error.required">Masukan
                                Nilai Invoice</small>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="form-group row">
                                <input type="text" class="form-control" number-input name="nilai_invoice" ng-model="formModel.nilai_invoice"
                                    ng-required="false" ng-disabled="true"
                                    ng-style="formInvoice.nilai_invoice.$dirty && formInvoice.nilai_invoice.$invalid && {'border':'solid red'}">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-6 mb-sm-0">
                        <div class="col"><label>Tanggal invoice</label><br>
                            <small style="color: red;"
                                ng-show="tgl_invoice.$touched && tgl_invoice.$error.required">Masukan
                                Tanggal invoice</small>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="form-group row">
                                <input type="date" class="form-control" name="tgl_invoice" ng-model="tgl_invoice"
                                    ng-required="true" ng-change="terminChange()"
                                    ng-style="tgl_invoice.$dirty && tgl_invoice.$invalid && {'border':'solid red'}">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-6 mb-sm-0" ng-hide="hidetermin">
                        <div class="col"><label>Termin</label><br>
                            <small style="color: red;"
                                ng-show="formInvoice.termin.$touched && formInvoice.termin.$error.required">Masukan
                                Termin</small>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="form-group row">
                                <input type="text" class="form-control" name="termin" ng-model="formModel.termin"
                                    ng-required="true" ng-change="terminChange()"
                                    ng-style="formInvoice.termin.$dirty && formInvoice.termin.$invalid && {'border':'solid red'}">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-6 mb-sm-0">
                        <div class="col"><label>Jatuh Tempo</label><br>
                            <small style="color: red;"
                                ng-show="jth_tmpo.$touched && jth_tmpo.$error.required">Masukan
                                Jatuh Tempo</small>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="form-group row">
                                <input type="date" class="form-control" name="jth_tmpo" ng-model="formModel.jth_tmpo"
                                    ng-required="false" ng-disable="true" ng-readonly="true"
                                    ng-style="jth_tmpo.$dirty && jth_tmpo.$invalid && {'border':'solid red'}">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-6 mb-sm-0" ng-hide="false">
                        <div class="col"><label>Nama Debitur</label></div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="form-group row" ng-init="dataCustomer()">
                                <select style="width: 100%;" id="id_customer" select2="" class="form-control"
                                    name="id_customer" ng-model="formModel.id_customer"
                                    ng-options="id_customer.id as id_customer.selectarray for id_customer in getCustomer"
                                    ng-required="true" ng-disabled="readOnly">
                                    <option value="">---select here---</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-6 mb-sm-0" ng-hide="false">
                        <div class="col"><label>Keterangan Invoice</label></div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="form-group row">
                                <select style="width: 100%;" id="ket_invoice" select2="" class="form-control"
                                    name="ket_invoice" ng-model="formModel.ket_invoice"
                                    ng-required="true" ng-disabled="readOnly">
                                    <option value="">---select here---</option>
                                    <option value="1">Pembelian</option>
                                    <option value="0">Ekspedisi</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-6 mb-sm-0" ng-hide="false">
                        <div class="col"><label>Nomor Retur</label></div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="form-group row" ng-init="dataRetur()">
                                <select style="width: 100%;" id="id_retur" select2="" class="form-control"
                                    name="id_retur" ng-model="formModel.id_retur" ng-change="returChange()"
                                    ng-options="id_retur.id as id_retur.no_retur for id_retur in getRetur"
                                    ng-required="false" ng-disabled="true">
                                    <option value="">---select here---</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-sm-12 mb-6 mb-sm-0" ng-hide="hidetermin">
                        <div class="col"><label>Nominal Retur</label><br>
                            <small style="color: red;"
                                ng-show="formInvoice.nilai_sisa_retur.$touched && formInvoice.nilai_sisa_retur.$error.required">Masukan
                                Nominal Retur</small>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="form-group row">
                                <input type="text" class="form-control" name="nilai_sisa_retur" ng-model="formModel.nilai_sisa_retur"
                                    ng-required="false" number-input ng-disabled="true"
                                    ng-style="formInvoice.nilai_sisa_retur.$dirty && formInvoice.nilai_sisa_retur.$invalid && {'border':'solid red'}">
                            </div>
                        </div>
                    </div> -->
                    <div class="col-sm-12 mb-6 mb-sm-0">
                        <div class="col"><label>Sisa Hutang</label><br>
                            <small style="color: red;"
                                ng-show="formInvoice.sisa_hutang.$touched && formInvoice.sisa_hutang.$error.required">Masukan
                                Sisa Hutang</small>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="form-group row">
                                <input type="text" class="form-control" number-input name="sisa_hutang" ng-model="formModel.sisa_hutang"
                                    ng-required="false"
                                    ng-style="formInvoice.sisa_hutang.$dirty && formInvoice.sisa_hutang.$invalid && {'border':'solid red'}" ng-readonly="true">
                            </div>
                        </div>
                    </div>
                </div>
                <input type="text" ng-model="formModel.id" ng-hide="false" disabled>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success col-sm-3 mb-6"><i class="fas fa-save">
                        </i></button>
                    <button type="button" class="btn btn-danger col-sm-3 mb-6"
                        ng-click="closeModal('#detailInvoice')"><i class="fas fa-chevron-circle-left">
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