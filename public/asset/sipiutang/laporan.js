sipiutang.controller("laporan", function ($scope, $http, $window, $timeout) {
  $scope.openModal = function (id) {
    // console.log('berhasil');
    var modal_popup = angular.element(id);
    modal_popup.modal("show");
  };

  $scope.closeModal = function (id) {
    var modal_popup = angular.element(id);
    modal_popup.modal("hide");
  };

  $scope.btnBack = function () {
    $window.location.href = "/invoice";
  }
  
  $scope.addBtn = function () {
    $window.location.href = "/invoice/add";
  };

  $scope.dataRekPenerima = function () {
    $scope.hideRekRef = false;
    $http.get("/rekpenerima/getRekPenerima/null").then(function (data) {
      $scope.getRekPenerima = data.data;
    });
  };
  
  $scope.getPayment = function () {
    $http.get("/payment/getPayment/null/null/null").then(function (data) {
      $scope.datasPayment = data.data;
      console.log(data);
    });

    $http.get("/laporan/getLaporanSum/null/null/null").then(function (data) {
      $scope.datasLaporanSum = data.data;
      console.log(data);
      $scope.total_invoice = data.data.total_invoice;
      $scope.total_hutang = data.data.total_hutang;
      $scope.total_payment = data.data.total_payment;
      $scope.total_retur = data.data.total_retur;
      $scope.potongan_retur = data.data.potongan_retur;
    });
  };
    
  $scope.selectRekPenerimaChange = function () {
    var tgl_awal = null;
    var tgl_akhir = null;

    // console.log($scope.selectRekPenerima);
    // console.log($scope.tgl_awal);
    // console.log($scope.tgl_akhir);
    if ($scope.tgl_awal != undefined && $scope.tgl_akhir != undefined) {
      mnth = ("0" + ($scope.tgl_awal.getMonth() + 1)).slice(-2),
      day = ("0" + $scope.tgl_awal.getDate()).slice(-2);
      tgl_awal = [$scope.tgl_awal.getFullYear(), mnth, day].join("-");

      mnth = ("0" + ($scope.tgl_akhir.getMonth() + 1)).slice(-2),
      day = ("0" + $scope.tgl_akhir.getDate()).slice(-2);
      tgl_akhir = [$scope.tgl_akhir.getFullYear(), mnth, day].join("-");
      $scope.tgl_awal = new Date(tgl_awal);
      $scope.tgl_akhir = new Date(tgl_akhir);
      
    } 
    if ($scope.selectRekPenerima == "") {
      $scope.selectRekPenerima = undefined;
    }

    $http.get("/payment/getPayment/" + $scope.selectRekPenerima + "/" + tgl_awal + "/" + tgl_akhir).then(function (data) {
      $scope.datasPayment = data.data;
      console.log(data);
    });

    $http.get("/laporan/getLaporanSum/" + $scope.selectRekPenerima + "/" + tgl_awal + "/" + tgl_akhir).then(function (data) {
      $scope.datasLaporanSum = data.data;
      console.log(data);
      $scope.total_invoice = data.data.total_invoice;
      $scope.total_hutang = data.data.total_hutang;
      $scope.total_payment = data.data.total_payment;
      $scope.total_retur = data.data.total_retur;
      $scope.potongan_retur = data.data.potongan_retur;
    });
  };

  $scope.getLapInvoice = function () {
    $http.get("/laporan/getLapinvoice/null/null/null/null").then(function (data) {
      $scope.dataLapInvoice = data.data;
      console.log(data);
    });

    $http.get("/laporan/getLaporanSumInvoice/null/null/null/null").then(function (data) {
      $scope.datasLaporanSum = data.data;
      console.log(data);
      $scope.total_invoice = data.data.total_invoice;
      $scope.total_hutang = data.data.total_hutang;
      $scope.total_payment = data.data.total_payment;
      $scope.total_retur = data.data.total_retur;
      $scope.potongan_retur = data.data.potongan_retur;
    });
  };

  $scope.printLaporanPayment = function () {
    if ($scope.tgl_awal && $scope.tgl_akhir != null) {
      mnth = ("0" + ($scope.tgl_awal.getMonth() + 1)).slice(-2),
      day = ("0" + $scope.tgl_awal.getDate()).slice(-2);
      tgl_awal = [$scope.tgl_awal.getFullYear(), mnth, day].join("-");

      mnth = ("0" + ($scope.tgl_akhir.getMonth() + 1)).slice(-2),
      day = ("0" + $scope.tgl_akhir.getDate()).slice(-2);
      tgl_akhir = [$scope.tgl_akhir.getFullYear(), mnth, day].join("-");
    } else {
      tgl_awal = tgl_akhir = undefined
    }
    console.log(tgl_awal + " - " + tgl_akhir)
    $window.open("/laporan/cetakLaporan/"+$scope.selectRekPenerima + "/" + tgl_awal + "/" + tgl_akhir);
  };

  $scope.laporanInvoiceChange = function () {
    console.log("Pembayaran=" + $scope.ketPembayaran);
    console.log("Invoice=" + $scope.ketInvoice);
    var tgl_awal = null;
    var tgl_akhir = null;
    if ($scope.tgl_awal != undefined && $scope.tgl_akhir != undefined) {
      mnth = ("0" + ($scope.tgl_awal.getMonth() + 1)).slice(-2),
      day = ("0" + $scope.tgl_awal.getDate()).slice(-2);
      tgl_awal = [$scope.tgl_awal.getFullYear(), mnth, day].join("-");

      mnth = ("0" + ($scope.tgl_akhir.getMonth() + 1)).slice(-2),
      day = ("0" + $scope.tgl_akhir.getDate()).slice(-2);
      tgl_akhir = [$scope.tgl_akhir.getFullYear(), mnth, day].join("-");
      $scope.tgl_awal = new Date(tgl_awal);
      $scope.tgl_akhir = new Date(tgl_akhir);
    } 
    if ($scope.ketPembayaran == "") {
      $scope.ketPembayaran = undefined;
    }
    if ($scope.ketInvoice == "") {
      $scope.ketInvoice = undefined;
    }

    $http.get("/laporan/getLapinvoice/" 
      + $scope.ketPembayaran + "/" 
      + $scope.ketInvoice + "/" 
      + tgl_awal+ "/"
      + tgl_akhir).then(function (data) {
      $scope.dataLapInvoice = data.data;
      console.log(data);
    });

    $http.get("/laporan/getLaporanSumInvoice/" + 
      $scope.ketPembayaran + "/" + 
      $scope.ketInvoice + "/" + 
      tgl_awal + "/" + 
      tgl_akhir).then(function (data) {
        $scope.datasLaporanSum = data.data;
        console.log(data);
        $scope.total_invoice = data.data.total_invoice;
        $scope.total_hutang = data.data.total_hutang;
        $scope.total_payment = data.data.total_payment;
        $scope.total_retur = data.data.total_retur;
        $scope.potongan_retur = data.data.potongan_retur;
    });
  };

  $scope.printLaporanInvoice = function () {
    console.log($scope.ketPembayaran);

    if ($scope.tgl_awal && $scope.tgl_akhir != null) {
      mnth = ("0" + ($scope.tgl_awal.getMonth() + 1)).slice(-2),
      day = ("0" + $scope.tgl_awal.getDate()).slice(-2);
      tgl_awal = [$scope.tgl_awal.getFullYear(), mnth, day].join("-");

      mnth = ("0" + ($scope.tgl_akhir.getMonth() + 1)).slice(-2),
      day = ("0" + $scope.tgl_akhir.getDate()).slice(-2);
      tgl_akhir = [$scope.tgl_akhir.getFullYear(), mnth, day].join("-");
    } else {
      tgl_awal = tgl_akhir = undefined
    }
    console.log(tgl_awal + " - " + tgl_akhir)
    $window.open("/laporan/cetakLaporanInvoice/"+$scope.ketPembayaran + "/" + 
      $scope.ketInvoice + "/" + 
      tgl_awal + "/" + 
      tgl_akhir);
  };
});
