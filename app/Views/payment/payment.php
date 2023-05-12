<?php $session = session(); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" ng-controller="payment">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pembayaran</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pembayaran</li>
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
                        <h6 class="m-0 font-weight-bold text-primary">Tabel Data Piutang</h6>
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
                        <div class="col-sm-6" style="float: left;">
                            <div class="col-sm-12" ng-init="dataRekPenerima()" style="margin-bottom: 10px;">
                                <select style="width: 100%;" id="selectRekPenerima" select2="" class="form-control"
                                    name="selectRekPenerima" ng-model="selectRekPenerima"
                                    ng-options="selectRekPenerima.id as selectRekPenerima.select_show for selectRekPenerima in getRekPenerima"
                                    ng-required="false" ng-disabled="readOnly" ng-change="selectRekPenerimaChange()">
                                    <option value="">---SEMUA---</option>
                                </select>
                            </div>
                            <div class="col-sm-12" style="margin-bottom: 50px;">
                                <input type="date" class="form-control col-sm-6" style="float: left;" name="tgl_awal" ng-model="tgl_awal"
                                    ng-required="true" ng-change="selectRekPenerimaChange()"
                                    ng-style="tgl_awal.$dirty && tgl_awal.$invalid && {'border':'solid red'}">
                                <input type="date" class="form-control col-sm-6" style="float: left;" name="tgl_akhir" ng-model="tgl_akhir"
                                    ng-required="true" ng-change="selectRekPenerimaChange()"
                                    ng-style="tgl_akhir.$dirty && tgl_akhir.$invalid && {'border':'solid red'}">
                            </div>
                        </div>
                        <div style="float: right;"><button type="button" ng-click="printFormVerifikasi()" class="btn btn-primary" style="margin-bottom: 5px;"><i class="fas fa-download"> Download Form Verifikasi</i></button></div>
                        <div class="table-responsive">
                            <table datatable="ng" dt-options="vm.dtOptions" class="table table-bordered" width="100%"
                                cellspacing="0" ng-init="getPayment()">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th style="width: 20px;">No</th>
                                        <th>Nomor Pembayaran</th>
                                        <th>Rekening Penerima</th>
                                        <th>Nomor Rekening</th>
                                        <th>Keterangan</th>
                                        <th>Nama Pemilik</th>
                                        <th>Ket Payment</th>
                                        <th>Nominal Pembayaran</th>
                                        <th>Tanggal Pembayaran</th> 
                                        <th>Verifikasi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr style="text-align: center;">
                                        <th style="width: 20px;">No</th>
                                        <th>Nomor Pembayaran</th>
                                        <th>Rekening Penerima</th>
                                        <th>Nomor Rekening</th>
                                        <th>Keterangan Rekening</th>
                                        <th>Nama Pemilik</th>
                                        <th>Ket Payment</th>
                                        <th>Nominal Pembayaran</th>
                                        <th>Tanggal Pembayaran</th>
                                        <th>Verifikasi</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <tr ng-repeat="d in datas">
                                        <td>{{ $index +1 }}</td>
                                        <td>{{ d.no_payment }}</td>
                                        <td>{{ d.nama_rekening }}</td>
                                        <td>{{ d.nomor_rekening }}</td>
                                        <td>{{ d.keterangan_penerima }}</td>
                                        <td>{{ d.nama_cstmr }}</td>
                                        <td ng-if="d.keterangan_payment == '0'"><button class="btn btn-light">Cash</button></td>
                                        <td ng-if="d.keterangan_payment == '1'"><button class="btn btn-light">Transfer</button></td>
                                        <td>Rp. {{ d.nominal_payment }}</td>
                                        <td>{{d.tgl_pembayaran }}</td>
                                        <td ng-if="d.verifikasi == '0'"><button class="btn btn-light">Belum</button></td>
                                        <td ng-if="d.verifikasi == '1'"><button class="btn btn-success">Terverifikasi</button></td>
                                        <td style="text-align: center; width: 150px;">
                                            <button type="button" title="Detail" style="margin-top: 5px;" class="btn btn-info" ng-click="getDetail(d.id, d.id_rekening_penerima, d.nama_cstmr, d.nama_usaha)"><i
                                                class="fa fa-edit"></i></button>
                                            <button type="button" title="Verifikasi Pembayaran" style="margin-top: 5px;" class="btn btn-warning" ng-click="verification(d.id)"><i
                                                class="fa fa-check"></i></button>
                                                <?php 
                                            if ($session->has('username') && $session->get('role') == 1) :
                                                # code...
                                                ?>
                                            <button type="button" title="delete" style="margin-top: 5px;" class="btn btn-danger" ng-click="deleteData(d.id)"><i
                                                class="fa fa-trash"></i></button>
                                                <?php
                                            endif;
                                                ?>
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
    <div class="modal fade" role="dialog" id="detailPayment" style="overflow-y:auto;">
        <div class="modal-dialog modal-lg" role="document">
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
                        <div class="col"><label>Nomor Rek Penerima</label><br>
                            <small style="color: red;"
                                ng-show="fomUser.nomor_rekening.$touched && fomUser.nomor_rekening.$error.required">Masukan
                                Nomor Rek Penerima</small>
                        </div>
                        <div class="form-group row" ng-init="dataRekPenerima()" style="margin-bottom: 10px;">
                            <select style="width: 100%;" id="id_rekening_penerima" select2="" class="form-control"
                                name="id_rekening_penerima" ng-model="formModel.id_rekening_penerima"
                                ng-options="id_rekening_penerima.id as id_rekening_penerima.select_show for id_rekening_penerima in getRekPenerima"
                                ng-required="false" ng-disabled="readOnly" ng-change="idRekPenerimaChange()">
                                <!-- <option value="">---Select Here---</option> -->
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-6 mb-sm-0">
                        <div class="col"><label>Nomor Rek Penerima</label><br>
                            <small style="color: red;"
                                ng-show="fomUser.nomor_rekening.$touched && fomUser.nomor_rekening.$error.required">Masukan
                                Nomor Rek Penerima</small>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="form-group row">
                                <input type="text" class="form-control" name="nomor_rekening" ng-model="formModel.nomor_rekening"
                                    ng-required="true" ng-disabled="true"
                                    ng-style="fomUser.nomor_rekening.$dirty && fomUser.nomor_rekening.$invalid && {'border':'solid red'}">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-6 mb-sm-0">
                        <div class="col"><label>Nominal Pembayaran</label><br>
                            <small style="color: red;"
                                ng-show="nominal_payment.$touched && nominal_payment.$error.required">Masukan
                                Nominal Pembayaran</small>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="form-group row">
                                <input type="text" number-input class="form-control" name="nominal_payment" ng-model="formModel.nominal_payment"
                                    ng-required="true" ng-disabled="true"
                                    ng-style="nominal_payment.$dirty && nominal_payment.$invalid && {'border':'solid red'}">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-6 mb-sm-0">
                        <div class="col"><label>Tanggal Pembayaran</label><br>
                            <small style="color: red;"
                                ng-show="tgl_pembayaran.$touched && tgl_pembayaran.$error.required">Masukan
                                Tanggal Pembayaran</small>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="form-group row">
                                <input type="date" class="form-control" name="tgl_pembayaran" ng-model="formModel.tgl_pembayaran"
                                    ng-required="true" ng-disabled="true"
                                    ng-style="tgl_pembayaran.$dirty && tgl_pembayaran.$invalid && {'border':'solid red'}">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-6 mb-sm-0">
                        <div class="col"><label>Keterangan Verifikasi</label><br>
                            <small style="color: red;"
                                ng-show="fomUser.nomor_rekening.$touched && fomUser.nomor_rekening.$error.required">Masukan
                                Keterangan Verifikasi</small>
                        </div>
                        <div class="form-group row" style="margin-bottom: 10px;">
                            <select style="width: 100%;" id="keterangan_payment" select2="" class="form-control"
                                name="keterangan_payment" ng-model="formModel.keterangan_payment"
                                ng-required="false" ng-disabled="readOnly">
                                <option value="">---Select Here---</option>
                                <option value="1">Transfer</option>
                                <option value="0">Cash</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-6 mb-sm-0">
                        <div class="col"><label>Nama Customer</label><br>
                            <small style="color: red;"
                                ng-show="nama_cstmr.$touched && nama_cstmr.$error.required">Masukan
                                Nama Customer</small>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="form-group row">
                                <input type="text" number_format class="form-control" name="nama_cstmr" ng-model="formModel.nama_cstmr"
                                    ng-required="true" ng-disabled="true"
                                    ng-style="nama_cstmr.$dirty && nama_cstmr.$invalid && {'border':'solid red'}">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-6 mb-sm-0">
                        <div class="col"><label>Nama Usaha</label><br>
                            <small style="color: red;"
                                ng-show="nama_usaha.$touched && nama_usaha.$error.required">Masukan
                                Nama Usaha</small>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="form-group row">
                                <input type="text" number_format class="form-control" name="nama_usaha" ng-model="formModel.nama_usaha"
                                    ng-required="true" ng-disabled="true"
                                    ng-style="nama_usaha.$dirty && nama_usaha.$invalid && {'border':'solid red'}">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-6 mb-sm-0">
                        <div class="col"><label>Keterangan Verifikasi</label><br>
                            <small style="color: red;"
                                ng-show="fomUser.nomor_rekening.$touched && fomUser.nomor_rekening.$error.required">Masukan
                                Keterangan Verifikasi</small>
                        </div>
                        <div class="form-group row" style="margin-bottom: 10px;">
                            <select style="width: 100%;" id="verifikasi" select2="" class="form-control"
                                name="verifikasi" ng-model="formModel.verifikasi"
                                ng-required="false" ng-disabled="readOnly">
                                <option value="">---Select Here---</option>
                                <option value="1">Sudah Terverifikasi</option>
                                <option value="0">Belum Terverifikasi</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-6 mb-sm-0">
                        <div class="col"><label>Bukti Transaksi</label><br>
                            <small style="color: red;"
                                ng-show="atas_nama_pembayar.$touched && atas_nama_pembayar.$error.required">Masukan
                                Bukti Transaksi</small>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="form-group row">
                                <img style="width: 100px; height: 100px;" src="/bukti_transfer/{{ formModel.file_bukti_tf}}" ng-hide="false"
                                    class="img-thumbnail">
                                    <!-- <input ng-model="formModel.file_bukti_tf"> -->
                                <button type="button" class="btn btn-secondary" ng-click="showBuktiTransaksi()" style="margin-left: 10px; height: 50px;">Lihat Bukti Transaksi</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-6 mb-sm-0" ng-hide="false">
                        <div class="col"><label>Invoice</label></div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col-sm-12 mb-6 mb-sm-0 table-responsive">
                                <table datatable="ng" dt-options="vm.dtOptions" class="table table-bordered" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th style="width: 20px;">No</th>
                                            <th>No Invoice</th>
                                            <th>Nilai Invoice</th>
                                            <th>Tanggal Invoice</th>
                                            <th>Nominal Dibayarkan /Invoice</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr style="text-align: center;">
                                            <th style="width: 20px;">No</th>
                                            <th>No Invoice</th>
                                            <th>Nilai Invoice</th>
                                            <th>Tanggal Invoice</th>
                                            <th>Nominal Dibayarkan /Invoice</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <tr ng-repeat="d in invoiceDetail">
                                            <td>{{ $index +1 }}</td>
                                            <td>{{ d.no_invoice }}</td>
                                            <td>{{ d.nilai_invoice }}</td>
                                            <td>{{ d.tgl_invoice }}</td>
                                            <td>{{ d.nominal_payment_invoice }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="modal-footer">
                    <button type="submit" class="btn btn-success col-sm-3 mb-6"><i class="fas fa-save">
                        </i></button>
                    <button type="button" class="btn btn-danger col-sm-3 mb-6"
                        ng-click="closeModal('#detailPayment')"><i class="fas fa-chevron-circle-left">
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