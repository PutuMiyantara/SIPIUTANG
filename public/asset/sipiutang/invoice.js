sipiutang.controller("invoice", function ($scope, $http, $window, $timeout) {
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
      console.log(data.data);
    });
  };

  $scope.dataRetur = function () {
    $scope.hideRetur = false;
    $http.get("/retur/getRetur/null").then(function (data) {
      $scope.getRetur = data.data;
    });
  };

  $scope.dataStatusEkspedisi = function () {
    console.log('data status ekspedisi');
    $scope.getStatusEkspedisi = [
      { id: "0", status: "Tidak Menggunakan" },
      { id: "1", status: "Menggunakan"},
    ];
  };

  $scope.getNoInvoice = function () {
    const d = new Date();
    // console.log(d.getTime());
    console.log(d.getMilliseconds().toString());
    $scope.no_invoice = d.getFullYear().toString() + (d.getMonth()+1).toString() + d.getDate().toString() + d.getHours().toString() + d.getMinutes().toString() + d.getSeconds().toString() + d.getMilliseconds().toString();
  };

  $scope.changeInvoiceEkspedisi = function (id) {
    $http.get("/invoiceekspedisi/getDetail/" + id).then(
      function successCallback(data) {
        // console.log(data);
        $scope.openModal("#detailInvoice");
        $scope.modalTitle = "Detail Invoice";
        // $scope.submitButton = "Update";
        // $scope.actionButton = "Kembali";
        $scope.nilai_invoice_ekspedisi = data.data[0].nilai_invoice_ekspedisi;
        $scope.tgl_pengiriman = new Date(data.data[0].tgl_pengiriman);
        $scope.nama_ekspedisi = data.data[0].nama_ekspedisi;
        $scope.no_telepon_ekspedisi = data.data[0].no_telepon_ekspedisi;
      },
      function errorCallback(response) {
        console.log(response);
        alert("error");
      }
    );
  }

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

  $scope.returChange = function(){
    id_retur = $scope.id_retur;
    console.log($scope.id_retur);
    $http.get("/retur/getRetur/" + id_retur).then(function (data) {
      if(id_retur != null){
        console.log(data.data[0].nilai_sisa_retur);
        $scope.nilai_sisa_retur = Number(data.data[0].nilai_sisa_retur);
      } else {
        $scope.nilai_sisa_retur = undefined;
      }
    });
    $scope.id_retur =id_retur;
  };

  $scope.insertData = function () {
    console.log($scope.nilai_sisa_retur);
    if ($scope.id_retur == undefined || $scope.id_retur == 'undefined') {
      $scope.id_retur = 'undefined';
      $scope.nilai_sisa_retur = 'undefined';
    }
    // console.log($scope.id_retur);
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
        id_retur: $scope.id_retur,
        nilai_sisa_retur: $scope.nilai_sisa_retur,
      })
      .then(
        function successCallback(data) {
          console.log(data.data);
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

  $scope.deleteData = function (id, id_retur, nilai_dibayar) {
    console.log(nilai_dibayar);
    console.log(id+" "+id_retur);
    var isconfirm = confirm("Ingin Menghapus Data?");
    if (isconfirm) {
      $http.post("/invoice/deleteData", {
        id: id,
        id_retur: id_retur,
        nilai_dibayar: nilai_dibayar,
      }).then(
        function successCallback(data) {
          window.scrollTo(0, 0);
          console.log(data);
          $scope.getInvoice();
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

  $scope.getDetail = function (id) {
    $http.get("/invoice/getDetail/" + id).then(
      function successCallback(data) {
        $scope.setDefault();
        console.log(data.data);
        $scope.openModal("#detailInvoice");
        $scope.modalTitle = "Detail Invoice";
        // $scope.submitButton = "Update";
        // $scope.actionButton = "Kembali";
        $scope.formModel.id = data.data[0].id;
        $scope.formModel.no_invoice = data.data[0].no_invoice;
        $scope.formModel.nilai_invoice = data.data[0].nilai_invoice;
        $scope.tgl_invoice = new Date(data.data[0].tgl_invoice);
        $scope.formModel.termin = data.data[0].termin;
        $scope.formModel.jth_tmpo = new Date(data.data[0].jth_tmpo);
        $scope.formModel.sisa_hutang = data.data[0].sisa_hutang;
        $scope.formModel.id_customer = data.data[0].id_customer;
        $scope.formModel.ket_invoice = data.data[0].ket_invoice;
        if (data.data[0].id_retur != null) {
          $scope.formModel.id_retur = data.data[0].id_retur;
          // $scope.formModel.nilai_sisa_retur = data.data[0].nilai_invoice - data.data[0].;
        }

        // $scope.returChange();
      },
      function errorCallback(response) {
        console.log(response);
        alert("error");
      }
    );
  };

  $scope.updateData = function () {
    mnth = ("0" + ($scope.tgl_invoice.getMonth() + 1)).slice(-2),
    day = ("0" + $scope.tgl_invoice.getDate()).slice(-2);
    tgl_invoice = [$scope.tgl_invoice.getFullYear(), mnth, day].join("-");
    $http.post("/invoice/updateData/" + $scope.formModel.id, {
      no_invoice: $scope.formModel.no_invoice,
      tgl_invoice: tgl_invoice,
      termin: $scope.formModel.termin,
      id_customer: $scope.formModel.id_customer,
      ket_invoice: $scope.formModel.ket_invoice,
    }).then(function successCallback(data) {
      $('.modal').animate({ scrollTop: 0 }, 'fast');
      if (data.data.errortext == "") {
        $scope.success = true;
        $scope.message = data.data.message;
        $timeout(function () {
          $scope.success = false;
        }, 5000);
        $scope.getDetail($scope.formModel.id);
        $scope.getInvoice();
      } else {
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
});
