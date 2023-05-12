
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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Laporan</li>
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
                        <a href="<?= base_url('/laporan') ?>" class="btn btn-primary"><i class="fas fa-file"> Laporan Pembayaran</i></a>
                        <a href="<?= base_url('/laporan/invoice') ?>" class="btn btn-outline-primary"><i class="fas fa-file"> Laporan Invoice</i></a>
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
                                <div class="col-sm-12" ng-init="dataRekPenerima()" style="margin-bottom: 10px;">
                                    <select style="width: 100%;" id="selectRekPenerima" select2="" class="form-control"
                                        name="selectRekPenerima" ng-model="selectRekPenerima"
                                        ng-options="selectRekPenerima.id as selectRekPenerima.select_show for selectRekPenerima in getRekPenerima"
                                        ng-required="false" ng-disabled="readOnly" ng-change="selectRekPenerimaChange()">
                                        <option value="">---SEMUA---</option>
                                    </select>
                                </div>
                                <div class="col-sm-12" style="margin-bottom: 55px;">
                                    <input type="date" class="form-control col-sm-6" style="float: left;" name="tgl_awal" ng-model="tgl_awal"
                                        ng-required="true" ng-change="selectRekPenerimaChange()"
                                        ng-style="tgl_awal.$dirty && tgl_awal.$invalid && {'border':'solid red'}">
                                    <input type="date" class="form-control col-sm-6" style="float: left;" name="tgl_akhir" ng-model="tgl_akhir"
                                        ng-required="true" ng-change="selectRekPenerimaChange()"
                                        ng-style="tgl_akhir.$dirty && tgl_akhir.$invalid && {'border':'solid red'}">
                                </div>
                                
                            </div>
                            <div class="col-sm-6" style="float: right;">
                                <button type="button" ng-click="printLaporanPayment()" class="btn btn-primary" style="margin-bottom: 5px; margin-left: 10px;"><i class="fas fa-download"> Download Laporan</i></button>
                                <div style="float: left;">
                                    <table style="border: 1px solid; margin-bottom: 5px;">
                                        <tr>
                                            <td>Total Hutang Terbayar</td>
                                            <td>: </td>
                                            <td>Rp. {{ total_payment }}</td>
                                        </tr>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table datatable="ng" dt-options="vm.dtOptions" class="table table-bordered" width="100%"
                                cellspacing="0" ng-init="getPayment()">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th style="width: 20px;">No</th>
                                        <th>Nomor Pembayaran</th>
                                        <th>Rekening Penerima</th>
                                        <th>Nomor Rekening</th>
                                        <th>Keterangan Rekening</th>
                                        <th>Nama Pemilik</th>
                                        <th>Atas Nama</th>
                                        <th>Nominal Pembayaran</th>
                                        <th>Tanggal Pembayaran</th> 
                                        <th>Verifikasi</th>
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
                                        <th>Atas Nama</th>
                                        <th>Nominal Pembayaran</th>
                                        <th>Tanggal Pembayaran</th>
                                        <th>Verifikasi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <tr ng-repeat="d in datasPayment">
                                        <td>{{ $index +1 }}</td>
                                        <td>{{ d.no_payment }}</td>
                                        <td>{{ d.nama_rekening }}</td>
                                        <td>{{ d.nomor_rekening }}</td>
                                        <td>{{ d.keterangan_penerima }}</td>
                                        <td>{{ d.nama_cstmr }}</td>
                                        <td>{{ d.atas_nama }}</td>
                                        <td>Rp. {{ d.nominal_payment }}</td>
                                        <td>{{d.tgl_pembayaran }}</td>
                                        <td ng-if="d.verifikasi == '0'"><button class="btn btn-light">Belum</button></td>
                                        <td ng-if="d.verifikasi == '1'"><button class="btn btn-success">Terverifikasi</button></td>
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