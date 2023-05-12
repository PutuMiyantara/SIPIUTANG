
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" ng-controller="laporan">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Laporan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('/dashboard/') ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('/laporan/') ?>">Laporan</a></li>
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
                        <h6 class="m-0 font-weight-bold text-primary">Tabel Data Laporan Pembayaran</h6>
                        <a href="<?= base_url('/laporan') ?>" class="btn btn-outline-primary"><i class="fas fa-file"> Laporan Pembayaran</i></a>
                        <a href="<?= base_url('/laporan/invoice') ?>" class="btn btn-primary"><i class="fas fa-file"> Laporan Invoice</i></a>
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
                        <div class="col-sm-12">
                            <div class="col-sm-6" style="float: left;">
                                <div class="col-sm-12" style="margin-bottom: 10px;">
                                Keterangan Pembayaran
                                    <select style="width: 100%;" id="ketPembayaran" select2="" class="form-control"
                                        name="ketPembayaran" ng-model="ketPembayaran" ng-change="laporanInvoiceChange()"
                                        ng-required="false" ng-disabled="readOnly">
                                        <option value="">---SEMUA---</option>
                                        <option value="1">LUNAS</option>
                                        <option value="0">BELUM LUNAS</option>
                                    </select>
                                </div>
                                <div class="col-sm-12" style="margin-bottom: 10px;">
                                Keterangan Invoice
                                    <select style="width: 100%;" id="ketInvoice" select2="" class="form-control"
                                        name="ketInvoice" ng-model="ketInvoice" ng-change="laporanInvoiceChange()"
                                        ng-required="false" ng-disabled="readOnly">
                                        <option value="">---SEMUA---</option>
                                        <option value="1">BARANG</option>
                                        <option value="0">EKSPEDISI</option>
                                    </select>
                                </div>
                                <div class="col-sm-12" style="margin-bottom: 55px;">
                                Tanggal Invoice
                                    <div>
                                      <input type="date" class="form-control col-sm-6" style="float: left;" name="tgl_awal" ng-model="tgl_awal"
                                          ng-required="true" ng-change="laporanInvoiceChange()"
                                          ng-style="tgl_awal.$dirty && tgl_awal.$invalid && {'border':'solid red'}">
                                      <input type="date" class="form-control col-sm-6" style="float: left;" name="tgl_akhir" ng-model="tgl_akhir"
                                          ng-required="true" ng-change="laporanInvoiceChange()"
                                          ng-style="tgl_akhir.$dirty && tgl_akhir.$invalid && {'border':'solid red'}">
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-sm-6" style="float: right;">
                                <button type="button" ng-click="printLaporanInvoice()" class="btn btn-primary" style="margin-bottom: 5px; margin-left: 10px;"><i class="fas fa-download"> Download Laporan</i></button>
                                <div style="float: left;">
                                    <table style="border: 1px solid; margin-bottom: 5px;">
                                        <tr>
                                            <td>Total Invoice</td>
                                            <td>: </td>
                                            <td>Rp. {{ total_invoice }}</td>
                                        </tr>
                                        <tr>
                                            <td>Total Hutang Invoice</td>
                                            <td>: </td>
                                            <td>Rp. {{ total_hutang }}</td>
                                        </tr>
                                        <tr>
                                            <td>Total Potongan Retur</td>
                                            <td>: </td>
                                            <td>Rp. {{ potongan_retur }}</td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table datatable="ng" dt-options="vm.dtOptions" class="table table-bordered" width="100%"
                                cellspacing="0" ng-init="getLapInvoice()">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th style="width: 20px;">No</th>
                                        <th>No Invoice</th>
                                        <th>Nilai Invoice</th>
                                        <th>Tanggal Invoice</th>
                                        <th>Tgl Jatuh Tempo</th>
                                        <th>Sisa Hutang</th>
                                        <th>Keterangan Invoice</th>
                                        <th>Nama Customer</th>
                                        <th>Nama Usaha</th>
                                        <th>Nomor Retur</th> 
                                        <th>Potongan Retur</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr style="text-align: center;">
                                        <th style="width: 20px;">No</th>
                                        <th>No Invoice</th>
                                        <th>Nilai Invoice</th>
                                        <th>Tanggal Invoice</th>
                                        <th>Tgl Jatuh Tempo</th>
                                        <th>Sisa Hutang</th>
                                        <th>Keterangan Invoice</th>
                                        <th>Nama Customer</th>
                                        <th>Nama Usaha</th>
                                        <th>Nomor Retur</th>
                                        <th>Potongan Retur</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <tr ng-repeat="d in dataLapInvoice">
                                        <td>{{ $index +1 }}</td>
                                        <td>{{ d.no_invoice }}</td>
                                        <td>Rp. {{ d.nilai_invoice }}</td>
                                        <td>{{ d.tgl_invoice }}</td>
                                        <td>{{ d.jth_tmpo }}</td>
                                        <td>Rp. {{ d.sisa_hutang }}</td>
                                        <td ng-if="d.ket_invoice == 1">Barang</td>
                                        <td ng-if="d.ket_invoice == 0">Ekspedisi</button></td>
                                        <td>{{ d.nama_cstmr }}</td>
                                        <td>{{ d.nama_usaha }}</td>
                                        <td>{{ d.no_retur }}</td>
                                        <td>Rp. {{ d.potongan_retur }}</td>
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
  </div>
  <!-- /.content-wrapper -->