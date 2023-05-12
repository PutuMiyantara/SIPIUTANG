
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" ng-controller="invoice">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Invoice</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Invoice</a></li>
                        <li class="breadcrumb-item active">Tambah Invoice</li>
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
                                        <form class="user" method="POST" enctype="multipart/form-data" name="formInvoice"
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
                                                <div class="col"><label>No Invoice</label><br>
                                                    <small style="color: red;"
                                                        ng-show="formInvoice.no_invoice.$touched && formInvoice.no_invoice.$error.required">Masukan
                                                        No Invoice</small>
                                                </div>
                                                <div class="col-sm-12 mb-6 mb-sm-0">
                                                    <div class="form-group row">
                                                        <input type="text" class="form-control" name="no_invoice" ng-model="no_invoice"
                                                            ng-required="true"
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
                                                        <input type="text" class="form-control" number-input name="nilai_invoice" ng-model="nilai_invoice"
                                                            ng-required="true"
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
                                                            ng-required="true"
                                                            ng-style="tgl_invoice.$dirty && tgl_invoice.$invalid && {'border':'solid red'}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mb-6 mb-sm-0" ng-hide="false">
                                                <div class="col"><label>Nama Debitur</label></div>
                                                <div class="col-sm-12 mb-6 mb-sm-0">
                                                    <div class="form-group row" ng-init="dataCustomer()">
                                                        <select style="width: 100%;" id="id_customer" select2="" class="form-control"
                                                            name="id_customer" ng-model="id_customer"
                                                            ng-options="id_customer.id as id_customer.selectarray for id_customer in getCustomer"
                                                            ng-required="true" ng-disabled="readOnly">
                                                            <option value="">---select here---</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mb-6 mb-sm-0" ng-hide="hideretur">
                                                <div class="col"><label>Termin</label><br>
                                                    <small style="color: red;"
                                                        ng-show="formInvoice.termin.$touched && formInvoice.termin.$error.required">Masukan
                                                        Termin</small>
                                                </div>
                                                <div class="col-sm-12 mb-6 mb-sm-0">
                                                    <div class="form-group row" ng-init="setTermin()">
                                                        <input type="text" class="form-control" name="termin" ng-model="termin"
                                                            ng-required="true"
                                                            ng-style="formInvoice.termin.$dirty && formInvoice.termin.$invalid && {'border':'solid red'}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mb-6 mb-sm-0" ng-hide="false">
                                                <div class="col"><label>Keterangan Invoice</label></div>
                                                <div class="col-sm-12 mb-6 mb-sm-0">
                                                    <div class="form-group row" ng-init="dataCustomer()">
                                                        <select style="width: 100%;" id="ket_invoice" select2="" class="form-control"
                                                            name="ket_invoice" ng-model="ket_invoice"
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
                                                            name="id_retur" ng-model="id_retur" ng-change="returChange()"
                                                            ng-options="id_retur.id as id_retur.no_retur for id_retur in getRetur"
                                                            ng-required="false" ng-disabled="readOnly">
                                                            <option value="">---select here---</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 mb-6 mb-sm-0" ng-hide="hidetermin">
                                                <div class="col"><label>Nominal Retur</label><br>
                                                    <small style="color: red;"
                                                        ng-show="formInvoice.nilai_sisa_retur.$touched && formInvoice.nilai_sisa_retur.$error.required">Masukan
                                                        Nominal Retur</small>
                                                </div>
                                                <div class="col-sm-12 mb-6 mb-sm-0">
                                                    <div class="form-group row">
                                                        <input type="text" number-input class="form-control" name="nilai_sisa_retur" ng-model="nilai_sisa_retur"
                                                            ng-required="false" ng-readonly="true"
                                                            ng-style="formInvoice.nilai_sisa_retur.$dirty && formInvoice.nilai_sisa_retur.$invalid && {'border':'solid red'}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-6 col-lg-12"></div>
                                                <div class="col-xl-6 col-lg-12">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <a class="btn btn-danger btn-block text-white" href="/invoice/" title="Kembali"><i class="fas fa-chevron-circle-left"></i></a>
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