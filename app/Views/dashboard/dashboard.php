<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" ng-controller="dashboard">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row" ng-init="getDataBoxDash()">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ count_invoice }}</h3>
                <p>Transaksi</p>
                <p>Rp. {{ sum_nilai_invoice }}</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="<?= base_url('/invoice') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ count_payment }}</h3>
                <p>Pembayaran</p>
                <p>Rp. {{ sum_nominal_payment }}</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?= base_url('/payment') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ count_cstmr }}</h3>
                <p>Jumlah Customer</p>
                <p>{{ count_cstmr }} Orang</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="<?= base_url('/customer') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ count_sisa_hutang }}</h3>
                <p>Sisa Hutang</p>
                <p>Rp. {{ sum_sisa_hutang }}</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="<?= base_url('/invoice') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-4 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card" ng-init="getChartPiutang()">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Data Piutang  
                </h3>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                    </li>
                  </ul>
                </div>
              </div><!-- /.card-header -->
            <div class="card-body">
                <div ng-init="getChartPiutang()">
                    <!-- <canvas id="myPieChart"></canvas> -->
                    <canvas id="doughnut" class="chart chart-doughnut" chart-data="data" chart-labels="label"
                        chart-colors="colorchart">
                    </canvas>
                </div>
                <div class="mt-4 text-center small">Total Transaksi {{ sum_nilai_invoice }}</div>
                <div class="mt-4 text-center small">{{ range_date }}</div>
                <div class="mt-4 text-center small">
                    <span class="mr-2">
                        <i class="fas fa-circle text-success"></i>Hutang Terbayar
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-danger"></i>Belum Bayar
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-primary"></i>Retur
                    </span>
                </div>
            </div>
            <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-8 connectedSortable">
          <div class="col-lg-12" ng-init="getChartTransaksi()">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Tingkat Transaksi Per Bulan</h3>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex" ng-init="getDataBoxDash()">
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg">Rp. {{ sum_nilai_invoice }}</span>
                  </p>
                </div>
                <!-- /.d-flex -->
                <div class="position-relative mb-4" ng-init="getChartTransaksi()">
                  <canvas id="barchart" chart-data="data" chart-labels="labels" chart-series="series" height="200"></canvas>
                </div>
                <!-- <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> This year
                  </span>
                  <span>
                    <i class="fas fa-square text-gray"></i> Last year
                  </span>
                </div> -->
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->