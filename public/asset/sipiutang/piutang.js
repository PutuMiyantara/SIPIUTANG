sipiutang.controller("piutang", function ($scope, $http, $window, $timeout) {
  $scope.setDefault = function () {
    // $scope.error = false;
    // $scope.success = false;
    $scope.formModel = {};
    $scope.files = null;
    console.log('set default');
  };

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
    $window.location.href = "/piutang";
  }

  $scope.addBtn = function () {
    $window.location.href = "/piutang/add";
  };

  $scope.dataCustomer = function () {
    $scope.hideRekRef = false;
    $http.get("/customer/getCustomer").then(function (data) {
      $scope.getCustomer = data.data;
    });
  };

  $scope.dataRekPenerima = function () {
    $scope.hideRekRef = false;
    $http.get("/rekpenerima/getRekPenerima/null").then(function (data) {
      $scope.getRekPenerima = data.data;
    });
  };

  $scope.status_piutang = "0";
  $scope.dataStatusPiutang = function () {
    console.log("data status piutang")
    $scope.getStatusPiutang = [
      { id: "0", status: "Belum Lunas" },
      { id: "1", status: "Lunas"},
    ];
  };

  $scope.changeStatusPiutang = function (id) {
    if (id == 1 || id == '1') {
      $scope.hidetermin = true;
    } else {
      $scope.hidetermin = false;
    }
  };

  $scope.dataStatusEkspedisi = function () {
    console.log('data status ekspedisi');
    $scope.getStatusEkspedisi = [
      { id: "0", status: "Tidak Menggunakan" },
      { id: "1", status: "Menggunakan"},
    ];
  };

  $scope.dataInvoiceEkspedisi = function () {
    $http.get("/invoiceekspedisi/getInvoiceEkspedisi").then(function (data) {
      $scope.getInvoiceEkspedisi = data.data;
    });
  };

  $scope.hideekspedisi = true;
  $scope.changeStatusEkspedisi = function (id) {
    console.log("change"+id)
    if (id == 0 || id == '0') {
      $scope.hideekspedisi = true;
    } else {
      $scope.hideekspedisi = false;
    }
  };

  $scope.formatRupiah = function (angka, prefix){
    console.log('=====');
    // angka = '100000'
    // var number_string = angka,
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split = number_string.split(','),
    sisa = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);
   
    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if(ribuan){
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }
   
    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    $scope.nominal =  prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    // console.log($scope.nominal);
  };

  $scope.searchPiutangChange = function () {
    $scope.getPiutang($scope.searchPiutang);
    console.log($scope.searchPiutang);
  };

  $scope.getPiutang = function (id) {
    $http.get("/piutang/getPiutang/" + id).then(function (data) {
      console.log(data.data);
      $scope.datas = data.data;
      console.log(data);
    });
  };

  $scope.deleteDetailPiutang = function (id, id_customer, id_invoice_ekspedisi) {
    // console.log(id);
    var isconfirm = confirm("Ingin Menghapus Data?");
    if (isconfirm) {
      $http.post("/piutang/deleteDetailPiutang", {
        id: id,
      }).then(
        function successCallback(data) {
          console.log(data);
          $scope.getInvoiceDetail(id_customer, id_invoice_ekspedisi);
          $scope.message = "Data Berhasil Dihapus";
          $scope.success = true;
          $timeout(function () {
            $scope.success = false;
          }, 5000);
        },
        function errorCallback(response) {
          console.log(response);
          $scope.message = "Data Gagal Dihapus";
          $scope.error = true;
          $timeout(function () {
            $scope.error = false;
          }, 5000);
        }
      );
    }
  };

  $scope.getDetailHutang = function (id_customer, nama_usaha, nama_cstmr, telepon, hutang_invoice) {
    $scope.getInvoiceDetail(id_customer);
    $scope.openModal("#detailPiutang");
    $scope.modalTitle = "Detail Piutang";
    $scope.nama_usaha = nama_usaha;
    $scope.nama_cstmr = nama_cstmr;
    $scope.id_customer = id_customer;
    console.log($scope.id_customer);
    $scope.telepon = telepon;
    $scope.hutang_invoice = hutang_invoice;
  };

  $scope.getInvoiceDetail = function (id_customer) {
    console.log(id_customer);
    $http.get("/piutang/getDetailHutang/" + id_customer).then(
      function successCallback(data) {
        console.log(data.data);
        $scope.invoiceDetail = data.data;
      },
      function errorCallback(response) {
        console.log(response);
        alert("error");
      }
    );
  };

  $scope.deleteData = function (id_customer, id_invoice_ekspedisi) {
    // console.log(id);
    var isconfirm = confirm("Ingin Menghapus Data?");
    if (isconfirm) {
      $http.post("/piutang/deleteDetailPiutang", {
        id: id,
      }).then(
        function successCallback(data) {
          console.log(data);
          $scope.getInvoiceDetail(id_customer, id_invoice_ekspedisi);
          $scope.message = "Data Berhasil Dihapus";
          $scope.success = true;
          $timeout(function () {
            $scope.success = false;
          }, 5000);
        },
        function errorCallback(response) {
          console.log(response);
          $scope.message = "Data Gagal Dihapus";
          $scope.error = true;
          $timeout(function () {
            $scope.error = false;
          }, 5000);
        }
      );
    }
  };

  $scope.dataBank = function () {
    console.log('databank')
    $scope.hideRekRef = false;
    console.log("testete");
    $http.get("/bank/getBank/").then(function (data) {
      $scope.getBank = data.data;
    });
  };

  $scope.payment = function (id_customer ,id, nama_usaha, nama_cstmr, hutang_invoice) {
    $scope.setDefault();
    $scope.openModal("#paymentModal");
    $scope.formModel.id_customer = id_customer;
    $scope.formModel.typePayment = 'single';
    $scope.formModel.id = id;
    $scope.formModel.nama_usaha = nama_usaha;
    $scope.formModel.nama_cstmr = nama_cstmr;
    $scope.formModel.hutang_invoice = hutang_invoice;

    $scope.getNoPayment();
  };
  
  $scope.paymentAll = function (id_customer , nama_usaha, nama_cstmr, hutang_invoice) {
    $scope.setDefault();
    console.log(id_customer);
    $scope.openModal("#paymentModal");
    $scope.formModel.id = id_customer;
    $scope.formModel.id_customer = id_customer;
    $scope.formModel.typePayment = 'multiple';
    $scope.formModel.nama_usaha = nama_usaha;
    $scope.formModel.nama_cstmr = nama_cstmr;
    $scope.formModel.hutang_invoice = hutang_invoice;

    $scope.getNoPayment();
  };

  $scope.paymentSubmit = function () {
    console.log($scope.no_payment);
    mnth = ("0" + ($scope.formModel.tgl_pembayaran.getMonth() + 1)).slice(-2),
    day = ("0" + $scope.formModel.tgl_pembayaran.getDate()).slice(-2);
    tgl_pembayaran = [$scope.formModel.tgl_pembayaran.getFullYear(), mnth, day].join("-");
    typePayment = $scope.formModel.typePayment;

    var form_data = new FormData();
    angular.forEach($scope.files, function(file){
      form_data.append('file', file);
    });
    form_data.append('no_payment', $scope.no_payment);
    form_data.append('nominal_payment', $scope.formModel.nominal_payment);
    form_data.append('tgl_pembayaran', tgl_pembayaran);
    form_data.append('nama_bank', $scope.formModel.nama_bank);
    form_data.append('rekening_pembayar', $scope.formModel.rekening_pembayar);
    form_data.append('atas_nama_pembayar', $scope.formModel.atas_nama_pembayar);
    form_data.append('verifikasi', $scope.formModel.verifikasi);
    form_data.append('keterangan', $scope.formModel.keterangan);
    form_data.append('id_rekening_penerima', $scope.formModel.id_rekening_penerima);
    form_data.append('rekening_pembayar', $scope.formModel.rekening_pembayar);
    form_data.append('atas_nama_pembayar', $scope.formModel.atas_nama_pembayar);

    $http.post("/payment/payment/" + $scope.formModel.id + "/" + typePayment, form_data,{
      transformRequest : angular.identity,
      headers : {'Content-Type' : undefined, 'Prosess-Data':false}
    }).then(function(data){
      console.log(data);
      if (data.data.errortext == "") {
        $scope.success = true;
        $scope.message = data.data.message;
        $scope.setDefault();
        $scope.no_payment = undefined;
        if (typePayment == 'single') {
          $('#paymentModal').animate({ scrollTop: 0 }, 'fast');
          $timeout(function () {
            $scope.success = false;
            $scope.closeModal("#paymentModal");
          }, 5000);
          $scope.getInvoiceDetail($scope.id_customer);
        } else{
          $scope.closeModal("#paymentModal");
          $timeout(function () {
            $scope.success = false;
          }, 5000);
        }
        $scope.getPiutang(null);
      } else {
        window.scrollTo(0, 0);
        $scope.error = true;
        $scope.message = data.data.errortext;
        $timeout(function () {
          $scope.error = false;
        }, 5000);
      }
    }, function errorCallback(response){
      $scope.error = true;
      $scope.message = "Gagal Menyimpan data";
      console.log("Gagal Menyimpan Data", response);
    });
  };

  $scope.getNotification = function () {
    $http.get("/piutang/getNotifikasi").then(function (data) {
      $scope.datas = data.data;
      $scope.jml_data = data.data.length;
    });
  };

  $scope.getNoPayment = function () {
    const d = new Date();
    // console.log(d.getTime());
    console.log(d.getMilliseconds().toString());
    $scope.no_payment = d.getFullYear().toString() + (d.getMonth()+1).toString() + d.getDate().toString() + d.getHours().toString() + d.getMinutes().toString() + d.getSeconds().toString() + d.getMilliseconds().toString();
  };

  // $scope.paymentSubmit = function () {
  //   mnth = ("0" + ($scope.formModel.tgl_pembayaran.getMonth() + 1)).slice(-2),
  //   day = ("0" + $scope.formModel.tgl_pembayaran.getDate()).slice(-2);
  //   tgl_pembayaran = [$scope.formModel.tgl_pembayaran.getFullYear(), mnth, day].join("-");
  //   typePayment = $scope.formModel.typePayment;
  //   $http.post("/payment/payment/" + $scope.formModel.id+"/"+typePayment, {
  //       no_payment: $scope.formModel.no_payment,
  //       nominal_payment: $scope.formModel.nominal_payment,
  //       tgl_pembayaran: tgl_pembayaran,
  //       id_bank_pembayar: $scope.formModel.id_bank_pembayar,
  //       rekening_pembayar: $scope.formModel.rekening_pembayar,
  //       atas_nama_pembayar: $scope.formModel.atas_nama_pembayar,
  //       verifikasi: $scope.formModel.verifikasi,
  //       id_rekening_penerima: $scope.formModel.id_rekening_penerima,
  //     })
  //     .then(
  //       function successCallback(data) {
  //         console.log(data.data);
  //         if (data.data.errortext == "") {
  //           $scope.success = true;
  //           $scope.message = data.data.message;
  //           if (typePayment == 'single') {
  //             $('#paymentModal').animate({ scrollTop: 0 }, 'fast');
  //             $timeout(function () {
  //               $scope.success = false;
  //               $scope.closeModal("#paymentModal");
  //             }, 5000);
  //             $scope.getInvoiceDetail($scope.id_customer);
  //           } else{
  //             $scope.closeModal("#paymentModal");
  //             $timeout(function () {
  //               $scope.success = false;
  //             }, 5000);
  //           }
  //           $scope.getPiutang(null);
  //         } else {
  //           window.scrollTo(0, 0);
  //           $scope.error = true;
  //           $scope.message = data.data.errortext;
  //           $timeout(function () {
  //             $scope.error = false;
  //           }, 5000);
  //         }
  //       },
  //       function errorCallback(response) {
  //         $scope.error = true;
  //         $scope.message = "Gagal Menyimpan data";
  //         console.log("Gagal Menyimpan Data", response);
  //       }
  //     );
  // };
});
