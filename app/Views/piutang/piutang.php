  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" ng-controller="piutang">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Piutang Invoice</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Piutang Invoice</li>
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
                        <div class="table-responsive">
                            <!-- <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                                style="margin-bottom: 10px;" ng-click="addBtn()"><i class="fas fa-plus fa-sm text-white-50"></i>Tambah
                                Data</button> -->
                            <table datatable="ng" dt-options="vm.dtOptions" class="table table-bordered" width="100%"
                                cellspacing="0" ng-init="getPiutang(null)">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th style="width: 20px;">No</th>
                                        <th>Nama Usaha</th>
                                        <th>Nama Pemilik</th>
                                        <th>No Telepon</th>
                                        <th>Atas Nama</th>
                                        <th>Hutang Invoice</th>
                                        <!-- <th>Tanggal Invoice</th>
                                        <th>Tanggal Jatuh Tempo</th> -->
                                        <th>Status Piutang</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr style="text-align: center;">
                                        <th style="width: 20px;">No</th>
                                        <th>Nama Usaha</th>
                                        <th>Nama Pemilik</th>
                                        <th>No Telepon</th>
                                        <th>Atas Nama</th>
                                        <th>Hutang Invoice</th>
                                        <!-- <th>Tanggal Invoice</th>
                                        <th>Tanggal Jatuh Tempo</th> -->
                                        <th>Status Piutang</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <tr ng-repeat="d in datas">
                                        <td>{{ $index +1 }}</td>
                                        <td>{{ d.nama_usaha }}</td>
                                        <td>{{ d.nama_cstmr }}</td>
                                        <td>{{ d.telepon }}</td>
                                        <td>{{ d.atas_nama }}</td>
                                        <td>Rp. {{d.hutang_invoice }}</td>
                                        <!-- <td>{{ d.tgl_invoice }}</td>
                                        <td>{{ d.jth_tmpo }}</td> -->
                                        <td ng-if="d.hutang_invoice == '0'"><button class="btn btn-success">Lunas</button></td>
                                        <td ng-if="d.hutang_invoice != '0'"><button class="btn btn-danger">Belum</button></td>
                                        <td style="text-align: center; width: 150px;">
                                            <button type="submit" title="detail" style="margin-top: 5px;" class="btn btn-info" ng-click="getDetailHutang(d.id_customer, d.nama_usaha, d.nama_cstmr, d.telepon, d.hutang_invoice)"><i
                                                class="fa fa-edit"></i></button>
                                            <button type="submit" title="Bayar Sekaligus" style="margin-top: 5px;" class="btn btn-warning" ng-click="paymentAll(d.id_customer, d.nama_usaha, d.nama_cstmr, d.hutang_invoice)"><i
                                                class="fa fa-donate"></i></button>
                                            <!-- <button type="submit" title="delete" style="margin-top: 5px;" class="btn btn-danger" ng-click="deleteData(d.id_customer, d.id_invoice_ekspedisi)"><i
                                                class="fa fa-trash"></i></button> -->
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
    <div class="modal fade" role="dialog" id="detailPiutang" style="overflow-y:auto;">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <form method="POST" name="formDetUser" id="formDetUser" ng-submit="updateData()">
                <div class="modal-header">
                    <h4 class="modal-title" ng-model="modalTitle">{{modalTitle}}</h4>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12 mb-6 mb-sm-0">
                        <div class="col"><label>Nama Usaha</label><br>
                            <small style="color: red;"
                                ng-show="fomUser.nama_usaha.$touched && fomUser.nama_usaha.$error.required">Masukan
                                Nama Usaha</small>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="form-group row">
                                <input type="text" class="form-control" name="nama_usaha" ng-model="nama_usaha"
                                    ng-required="true" ng-disabled="true"
                                    ng-style="fomUser.nama_usaha.$dirty && fomUser.nama_usaha.$invalid && {'border':'solid red'}">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-6 mb-sm-0">
                        <div class="col"><label>Nama Customer</label><br>
                            <small style="color: red;"
                                ng-show="fomUser.nama_cstmr.$touched && fomUser.nama_cstmr.$error.required">Masukan
                                Nama Customer</small>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="form-group row">
                                <input type="text" class="form-control" name="nama_cstmr" ng-model="nama_cstmr"
                                    ng-required="true" ng-disabled="true"
                                    ng-style="fomUser.nama_cstmr.$dirty && fomUser.nama_cstmr.$invalid && {'border':'solid red'}">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-6 mb-sm-0">
                        <div class="col"><label>No Telepon</label><br>
                            <small style="color: red;"
                                ng-show="telepon.$touched && telepon.$error.required">Masukan
                                No Telepon</small>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="form-group row">
                                <input type="text" class="form-control" name="telepon" ng-model="telepon"
                                    ng-required="true" ng-disabled="true"
                                    ng-style="telepon.$dirty && telepon.$invalid && {'border':'solid red'}">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-6 mb-sm-0">
                        <div class="col"><label>Hutang Invoice</label><br>
                            <small style="color: red;"
                                ng-show="hutang_invoice.$touched && hutang_invoice.$error.required">Masukan
                                Hutang Invoice</small>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="form-group row">
                                <input type="text" number_format class="form-control" name="hutang_invoice" ng-model="hutang_invoice"
                                    ng-required="true" ng-disabled="true"
                                    ng-style="hutang_invoice.$dirty && hutang_invoice.$invalid && {'border':'solid red'}">
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
                                            <th>Sisa Hutang Invoice</th>
                                            <th>Tanggal Invoice</th>
                                            <th>Keterangan Invoice</th>
                                            <th>Tanggal Jatuh Tempo</th>
                                            <th>Status Piutang</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr style="text-align: center;">
                                            <th style="width: 20px;">No</th>
                                            <th>No Invoice</th>
                                            <th>Nilai Invoice</th>
                                            <th>Sisa Hutang Invoice</th>
                                            <th>Tanggal Invoice</th>
                                            <th>Keterangan Invoice</th>
                                            <th>Tanggal Jatuh Tempo</th>
                                            <th>Status Piutang</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <tr ng-repeat="d in invoiceDetail">
                                            <td>{{ $index +1 }}</td>
                                            <td>{{ d.no_invoice }}</td>
                                            <td>Rp. {{ d.nilai_invoice }}</td>
                                            <td>Rp. {{ d.sisa_hutang }}</td>
                                            <td>{{ d.tgl_invoice }}</td>
                                            <td ng-if="d.ket_invoice == '1'">Barang</td>
                                            <td ng-if="d.ket_invoice == '0'">Ekspedisi</td>

                                            <td ng-if="d.sts_jth_tmpo == true && d.sisa_hutang != '0'"><button class="btn btn-outline-danger">{{ d.jth_tmpo }}</button></td>
                                            <td ng-if="d.sts_jth_tmpo == true && d.sisa_hutang == '0'"><button class="btn btn-outline-primary">{{ d.jth_tmpo }}</button></td>
                                            <td ng-if="d.sts_jth_tmpo == false && d.sisa_hutang != '0'"><button class="btn btn-outline-primary">{{ d.jth_tmpo }}</button></td>
                                            <td ng-if="d.sts_jth_tmpo == false && d.sisa_hutang == '0'"><button class="btn btn-outline-primary">{{ d.jth_tmpo }}</button></td>

                                            <td ng-if="d.sisa_hutang == '0'"><button class="btn btn-success">Lunas</button></td>
                                            <td ng-if="d.sisa_hutang != '0'"><button class="btn btn-danger">Belum</button></td>
                                            <td style="text-align: center; width: 150px;">
                                                <button type="submit" title="bayar" style="margin-top: 5px;" class="btn btn-success" ng-click="payment(d.id_customer, d.id, nama_usaha, nama_cstmr, d.sisa_hutang)"><i
                                                    class="fa fa-donate"></i></button>
                                                <!-- <button type="submit" title="delete" style="margin-top: 5px;" class="btn btn-danger" ng-click="deleteDetailPiutang(d.id, d.id_customer, d.id_invoice_ekspedisi)"><i
                                                    class="fa fa-trash"></i></button> -->
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <input ng-model="id_customer">
                </div>
                    <div class="modal-footer">
                    <!-- <button type="submit" class="btn btn-success col-sm-3 mb-6"><i class="fas fa-save">
                            </i></button> -->
                    <button type="button" class="btn btn-danger col-sm-3 mb-6"
                        ng-click="closeModal('#detailPiutang')"><i class="fas fa-chevron-circle-left">
                            </i></button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <!-- Modal Payment -->
    <div class="modal" id="paymentModal" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" name="formPayment" id="formPayment" ng-submit="paymentSubmit()">
                    <div class="modal-header">
                        <h5 class="modal-title">Pembayaran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
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
                            <div class="col"><label>Nomor Pembayaran</label><br>
                                <small style="color: red;"
                                    ng-show="no_payment.$touched && no_payment.$error.required">Masukan
                                    Nomor Pembayaran</small>
                            </div>
                            <div class="col-sm-12 mb-6 mb-sm-0" ng-init="getNoPayment()">
                                <div class="form-group row">
                                    <input type="text" class="form-control" name="no_payment" ng-model="no_payment"
                                        ng-required="true" ng-disabled="true"
                                        ng-style="no_payment.$dirty && no_payment.$invalid && {'border':'solid red'}">
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
                                    <input type="text" class="form-control" name="nama_usaha" ng-model="formModel.nama_usaha"
                                        ng-required="true" ng-disabled="true"
                                        ng-style="nama_usaha.$dirty && nama_usaha.$invalid && {'border':'solid red'}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Nama Debitur</label><br>
                                <small style="color: red;"
                                    ng-show="nama_cstmr.$touched && nama_cstmr.$error.required">Masukan
                                    Nama Debitur</small>
                            </div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <input type="text" class="form-control" name="nama_cstmr" ng-model="formModel.nama_cstmr"
                                        ng-required="true" ng-disabled="true"
                                        ng-style="nama_cstmr.$dirty && nama_cstmr.$invalid && {'border':'solid red'}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Total Hutang Invoice</label><br>
                                <small style="color: red;"
                                    ng-show="hutang_invoice.$touched && hutang_invoice.$error.required">Masukan
                                    Total Hutang Invoice</small>
                            </div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <input type="text" class="form-control" name="hutang_invoice" ng-model="formModel.hutang_invoice"
                                        ng-required="true" ng-disabled="true"
                                        ng-style="hutang_invoice.$dirty && hutang_invoice.$invalid && {'border':'solid red'}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Nominal Diterima</label><br>
                                <small style="color: red;"
                                    ng-show="nominal_payment.$touched && nominal_payment.$error.required">Masukan
                                    Nominal Diterima</small>
                            </div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <input type="text" number-input class="form-control" name="nominal_payment" ng-model="formModel.nominal_payment"
                                        ng-required="false"
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
                                        ng-required="false"
                                        ng-style="tgl_pembayaran.$dirty && tgl_pembayaran.$invalid && {'border':'solid red'}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0" ng-hide="false">
                            <div class="col"><label>Keterangan Pembayaran</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <select style="width: 100%;" id="keterangan" select2="" class="form-control"
                                        name="keterangan" ng-model="formModel.keterangan"
                                        ng-required="false" ng-disabled="readOnly">
                                        <option value="">---select here---</option>
                                        <option value="0">Cash</option>
                                        <option value="1">Transfer</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0" ng-hide="false">
                            <div class="col"><label>Rekening Penerima</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row" ng-init="dataRekPenerima()">
                                    <select style="width: 100%;" id="id_rekening_penerima" select2="" class="form-control"
                                        name="id_rekening_penerima" ng-model="formModel.id_rekening_penerima"
                                        ng-options="id_rekening_penerima.id as id_rekening_penerima.select_show for id_rekening_penerima in getRekPenerima"
                                        ng-required="true" ng-disabled="readOnly">
                                        <option value="">---select here---</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Bukti Pembayaran</label><br>
                                <small style="color: red;"
                                    ng-show="atas_nama_pembayar.$touched && atas_nama_pembayar.$error.required">Masukan
                                    Bukti Pembayaran</small>
                            </div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <input type="file" class="form-control" ng-required="false" name="files"
                                        file-input="files" ng-model="files">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <p style="color: red;">Isi Jika Nama Pembayar Tidak Sesuai Dengan Nama Pemilik</p>
                        <div class="col-sm-12 mb-6 mb-sm-0" ng-hide="false">
                            <div class="col"><label>Nama Bank</label></div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row" ng-init="dataBank()">
                                    <select style="width: 100%;" id="nama_bank" select2="" class="form-control"
                                        name="nama_bank" ng-model="formModel.nama_bank"
                                        ng-options="nama_bank.nama_bank as nama_bank.nama_bank for nama_bank in getBank"
                                        ng-required="false" ng-disabled="readOnly">
                                        <option value="">---select here---</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Nomor Rekening</label><br>
                                <small style="color: red;"
                                    ng-show="rekening_pembayar.$touched && rekening_pembayar.$error.required">Masukan
                                    Nomor Rekening</small>
                            </div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <input type="text" class="form-control" name="rekening_pembayar" ng-model="formModel.rekening_pembayar"
                                        ng-required="false"
                                        ng-style="rekening_pembayar.$dirty && rekening_pembayar.$invalid && {'border':'solid red'}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <div class="col"><label>Atas Nama Pembayar</label><br>
                                <small style="color: red;"
                                    ng-show="atas_nama_pembayar.$touched && atas_nama_pembayar.$error.required">Masukan
                                    Atas Nama Pembayar</small>
                            </div>
                            <div class="col-sm-12 mb-6 mb-sm-0">
                                <div class="form-group row">
                                    <input type="text" class="form-control" name="atas_nama_pembayar" ng-model="formModel.atas_nama_pembayar"
                                        ng-required="false"
                                        ng-style="atas_nama_pembayar.$dirty && atas_nama_pembayar.$invalid && {'border':'solid red'}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="text" ng-model="formModel.id_customer">
                        <input type="text" ng-model="formModel.typePayment">
                        <input type="text" ng-model="formModel.id">
                        <button type="submit" class="btn btn-primary">Bayar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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