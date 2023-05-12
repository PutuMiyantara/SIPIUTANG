sipiutang.controller("payment", function ($scope, $http, $window, $timeout) {
  $scope.setDefault = function () {
    // $scope.error = false;
    // $scope.success = false;
    $scope.formModel = {};
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
    $window.location.href = "/invoice";
  }
  
  $scope.addBtn = function () {
    $window.location.href = "/invoice/add";
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
  
  $scope.getPayment = function () {
    $http.get("/payment/getPayment/null/null/null").then(function (data) {
      $scope.datas = data.data;
      console.log(data);
    });
  };
  
  $scope.idRekPenerimaChange = function () {
    console.log($scope.formModel.id_rekening_penerima);
    $http.get("/rekpenerima/getRekPenerima/" + $scope.formModel.id_rekening_penerima).then(function (data) {
      console.log(data);
      $scope.formModel.nomor_rekening = data.data[0].nomor_rekening;
    });
  };
  
  $scope.terminChange = function(){
    mnth = $scope.tgl_invoice.getMonth();
    day = parseInt($scope.tgl_invoice.getDate());
    day = day + parseInt($scope.formModel.termin);
    tgl_invoice = [$scope.tgl_invoice.getFullYear(), (mnth+1), day].join("/");
    $scope.formModel.jth_tmpo = new Date(tgl_invoice);
  };
  
  $scope.dataStatusEkspedisi = function () {
    console.log('data status ekspedisi');
    $scope.getStatusEkspedisi = [
      { id: "0", status: "Tidak Menggunakan" },
      { id: "1", status: "Menggunakan"},
    ];
  };
    
  $scope.formatRupiah = function (bilangan){
    var	number_string = bilangan.toString(),
    sisa 	= number_string.length % 3,
    rupiah 	= number_string.substr(0, sisa),
    ribuan 	= number_string.substr(sisa).match(/\d{3}/g);

    if (ribuan) {
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }
    $scope.nominal = rupiah;
  };
  
  $scope.getInvoice = function () {
    $http.get("/invoice/getInvoice").then(function (data) {
      $scope.datas = data.data;
      console.log(data);
    });
  };
  
  $scope.setTermin = function () {
    $scope.termin = 10;
  };
  
  $scope.insertData = function () {
    mnth = ("0" + ($scope.tgl_invoice.getMonth() + 1)).slice(-2),
    day = ("0" + $scope.tgl_invoice.getDate()).slice(-2);
    tgl_invoice = [$scope.tgl_invoice.getFullYear(), mnth, day].join("-");
    // tgl_invoice = new Date(tgl_invoice);
    $http
    .post("/invoice/insertData", {
      no_invoice: $scope.no_invoice,
      nilai_invoice: $scope.nilai_invoice,
      tgl_invoice: tgl_invoice,
      termin: $scope.termin,
      id_customer: $scope.id_customer,
      ket_invoice: $scope.ket_invoice,
    })
    .then(
      function successCallback(data) {
        window.scrollTo(0, 0);
        if (data.data.errortext == "") {
          $scope.success = true;
          $scope.message = data.data.message;
          $timeout(function () {
            $scope.success = false;
          }, 5000);
          $window.location.href = "/invoice";
        } else {
          $scope.success = true;
          $scope.message = data.data.message;
          $timeout(function () {
            $scope.success = false;
          }, 5000);
        }
      },
      function errorCallback(response) {
        window.scrollTo(0, 0);
        $scope.error = true;
        $scope.message = "Gagal Menyimpan data";
        console.log("Gagal Menyimpan Data", response);
      }
      );
    };
    
    $scope.deleteData = function (id) {
      // console.log(id);
      var isconfirm = confirm("Ingin Menghapus Data?");
      if (isconfirm) {
        $http.post("/payment/deleteData", {
          id: id,
        }).then(
          function successCallback(data) {
          console.log(data);
          $scope.getPayment();
          window.scrollTo(0, 0)
          $scope.message = "Data Berhasil Dihapus";
          $scope.success = true;
          $timeout(function () {
            $scope.success = false;
          }, 5000);
        },
        function errorCallback(response) {
          window.scrollTo(0, 0);
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
    
    $scope.verification = function (id) {
      // console.log(id);
      var isconfirm = confirm("Ingin Menghapus Data?");
      if (isconfirm) {
        $http.post("/payment/verification", {
          id: id,
        }).then(
          function successCallback(data) {
            window.scrollTo(0, 0);
            console.log(data);
            $scope.getPayment();
            $scope.message = "Data Berhasil Diverifikasi";
            $scope.success = true;
            $timeout(function () {
              $scope.success = false;
            }, 5000);
          },
          function errorCallback(response) {
            window.scrollTo(0, 0);
            console.log(response);
            $scope.message = "Data Gagal Diverifikasi";
            $scope.error = true;
            $timeout(function () {
              $scope.error = false;
            }, 5000);
          }
          );
        }
      };
      
      $scope.getDetail = function (id, id_rekening_penerima, nama_cstmr, nama_usaha) {
        $scope.getInvoiceDetail(id);
        $http.get("/payment/getDetail/" + id).then(
          function successCallback(data) {
            $scope.setDefault();
            console.log(data.data);
            $scope.openModal("#detailPayment");
            $scope.modalTitle = "Detail Payment";
            // $scope.submitButton = "Update";
            // $scope.actionButton = "Kembali";
            $scope.formModel.id = data.data[0].id;
            $scope.formModel.id_rekening_penerima = id_rekening_penerima;
        // $scope.formModel.nama_rekening = data.data[0].nama_rekening;
        $scope.formModel.nomor_rekening = data.data[0].nomor_rekening;
        $scope.formModel.nominal_payment = data.data[0].nominal_payment;
        $scope.formModel.tgl_pembayaran = new Date(data.data[0].tgl_pembayaran);
        $scope.formModel.nama_cstmr = nama_cstmr;
        $scope.formModel.nama_usaha = nama_usaha;
        $scope.formModel.keterangan_payment = data.data[0].keterangan_payment;
        $scope.formModel.verifikasi = data.data[0].verifikasi;
        $scope.formModel.file_bukti_tf = data.data[0].file_bukti_tf;
      },
      function errorCallback(response) {
        console.log(response);
        alert("error");
      }
      );
    };
    
    $scope.getInvoiceDetail = function (id_payment) {
      console.log(id_payment);
      $http.get("/payment/getInvoiceDetail/" + id_payment).then(
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
      
      $scope.updateData = function () {
        $http.post("/payment/updateData/" + $scope.formModel.id, {
          id_rekening_penerima: $scope.formModel.id_rekening_penerima,
          keterangan_payment: $scope.formModel.keterangan_payment,
          verifikasi: $scope.formModel.verifikasi,
        }).then(function successCallback(data) {
          $('.modal').animate({ scrollTop: 0 }, 'fast');
          if (data.data.errortext == "") {
            $scope.success = true;
            $scope.message = data.data.message;
            $timeout(function () {
              $scope.success = false;
            }, 5000);
            $scope.getDetail($scope.formModel.id, $scope.formModel.id_rekening_penerima, $scope.formModel.keterangan_penerima, $scope.formModel.nama_cstmr);
            $scope.getPayment();
          } else {
            $scope.error = true;
            $scope.message = data.data.errortext;
            $timeout(function () {
              $scope.error = false;
            }, 5000);
            console.log(data);
            $scope.error = true;
          }
        }, function errorCallback(response) {
          $('.modal').animate({ scrollTop: 0 }, 'fast');
          $scope.message = "Gagal Mengubah Data";
          $scope.readOnly = false;
          $scope.hide = false;
          console.log(response);
          $scope.error = true;
          $timeout(function () {
            $scope.error = false;
          }, 5000);
    })
  };

  $scope.selectRekPenerimaChange = function () {
    var tgl_awal = null;
    var tgl_akhir = null;
    console.log($scope.id_rekening_penerima);
    console.log($scope.tgl_awal);
    console.log($scope.tgl_akhir);
    if ($scope.tgl_awal && $scope.tgl_akhir != null) {
      mnth = ("0" + ($scope.tgl_awal.getMonth() + 1)).slice(-2),
      day = ("0" + $scope.tgl_awal.getDate()).slice(-2);
      tgl_awal = [$scope.tgl_awal.getFullYear(), mnth, day].join("-");

      mnth = ("0" + ($scope.tgl_akhir.getMonth() + 1)).slice(-2),
      day = ("0" + $scope.tgl_akhir.getDate()).slice(-2);
      tgl_akhir = [$scope.tgl_akhir.getFullYear(), mnth, day].join("-");
      
      $scope.tgl_awal = new Date(tgl_awal);
      $scope.tgl_akhir = new Date(tgl_akhir);
      
      $http.get("/payment/getPayment/" + $scope.selectRekPenerima + "/" + tgl_awal + "/" + tgl_akhir).then(function (data) {
        $scope.datas = data.data;
        console.log(data);
      });
    } else {
      tgl_awal = tgl_akhir = null;
      
      $http.get("/payment/getPayment/" + $scope.selectRekPenerima + "/" + tgl_awal + "/" + tgl_akhir).then(function (data) {
        $scope.datas = data.data;
        console.log(data);
      });
    }
  };
  
  $scope.printFormVerifikasi = function () {
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
    $window.open("/payment/cetakPayment/"+$scope.selectRekPenerima + "/" + tgl_awal + "/" + tgl_akhir);
  };

  $scope.showBuktiTransaksi = function () {
    console.log("berhasil melihat data");
    $window.open("/payment/buktiPembayaran/" + $scope.formModel.file_bukti_tf);
  }
});
