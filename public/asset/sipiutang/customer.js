sipiutang.controller("customer", function ($scope, $http, $window, $timeout) {
  $scope.setDefault = function () {
    // $scope.error = false;
    // $scope.success = false;
    $scope.formModel = {};
    console.log('set default');
  };

  $scope.openModal = function (id) {
    console.log('berhasil');
    var modal_popup = angular.element(id);
    modal_popup.modal("show");
  };

  $scope.closeModal = function (id) {
    var modal_popup = angular.element(id);
    modal_popup.modal("hide");
  };

  $scope.btnBack = function () {
    $window.location.href = "/customer";
  }

  $scope.addBtn = function () {
    $window.location.href = "/customer/add";
  };

  $scope.dataBank = function () {
    console.log('databank')
    $scope.hideRekRef = false;
    console.log("testete");
    $http.get("/bank/getBank/").then(function (data) {
      $scope.getBank = data.data;
    });
  };

  $scope.getCustomer = function () {
    $http.get("/customer/getCustomer").then(function (data) {
      $scope.datas = data.data;
      console.log(data);
    });
  };

  $scope.insertData = function () {
    console.log($scope.username);
    $http
      .post("/customer/insertData", {
        nama_cstmr: $scope.formModel.nama_cstmr,
        alamat_cstmr: $scope.formModel.alamat_cstmr,
        id_bank: $scope.formModel.id_bank,
        rekening: $scope.formModel.rekening,
        ktp: $scope.formModel.ktp,
        telepon: $scope.formModel.telepon,
        email: $scope.formModel.email,
        atas_nama: $scope.formModel.atas_nama,
        nama_usaha: $scope.formModel.nama_usaha,
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
            $window.location.href = "/customer";
          } else {
            $scope.error = true;
            $scope.message = data.data.errortext;
            $timeout(function () {
              $scope.success = false;
            }, 5000);
          }
        },
        function errorCallback(response) {
          $scope.error = true;
          $scope.message = "Gagal Menyimpan data";
          console.log("Gagal Menyimpan Data", response);
        }
      );
  };

  $scope.deleteData = function (id) {
    console.log(id);
    var isconfirm = confirm("Ingin Menghapus Data?");
    if (isconfirm) {
      $http.post("/customer/deleteData", {
        id: id,
      }).then(
        function successCallback(data) {
          window.scrollTo(0, 0);
          $scope.getCustomer();
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
  }

  $scope.getDetail = function (id) {
    $scope.setDefault();
    $http.get("/customer/getDetail/" + id).then(
      function successCallback(data) {
        console.log(data);
        $scope.openModal("#detailCustomer");
        $scope.modalTitle = "Detail User";
        // $scope.submitButton = "Update";
        // $scope.actionButton = "Kembali";

        $scope.formModel.id = data.data[0].id;
        $scope.formModel.nama_cstmr = data.data[0].nama_cstmr;
        $scope.formModel.alamat_cstmr = data.data[0].alamat_cstmr;
        $scope.formModel.id_bank = data.data[0].id_bank;
        $scope.formModel.rekening = data.data[0].rekening;
        $scope.formModel.ktp = parseInt(data.data[0].ktp);
        $scope.formModel.telepon = parseInt(data.data[0].telepon);
        $scope.formModel.email = data.data[0].email;
        $scope.formModel.atas_nama = data.data[0].atas_nama;
        $scope.formModel.nama_usaha = data.data[0].nama_usaha;
      },
      function errorCallback(response) {
        console.log(response);
        alert("error");
      }
    );
  };

  $scope.updateData = function () {
    if ($scope.password == null || $scope.password == '' || $scope.password == 'undefined') {
      $scope.password = '';
    }
    $http.post("/customer/updateData/" + $scope.formModel.id, {
      nama_cstmr: $scope.formModel.nama_cstmr,
      alamat_cstmr: $scope.formModel.alamat_cstmr,
      id_bank: $scope.formModel.id_bank,
      rekening: $scope.formModel.rekening,
      ktp: $scope.formModel.ktp,
      telepon: $scope.formModel.telepon,
      email: $scope.formModel.email,
      atas_nama: $scope.formModel.atas_nama,
      nama_usaha: $scope.formModel.nama_usaha,
    }).then(function successCallback(data) {
      $('#detailCustomer').animate({ scrollTop: 0 }, 'fast');
      if (data.data.errortext == "") {
        $scope.getDetail($scope.formModel.id);
        $scope.success = true;
        $timeout(function () {
          $scope.success = false;
        }, 5000);
        $scope.message = data.data.message;
        $scope.getCustomer();
      } else {
        $scope.error = true;
        $timeout(function () {
          $scope.error = false;
        }, 5000);
        $scope.message = data.data.errortext;
      }
    }, function errorCallback(response) {
      $scope.readOnly = false;
      $scope.hide = false;
      $scope.error = true;
      $scope.message = "Gagal Mengubah Data";
      $timeout(function () {
        $scope.error = false;
      }, 5000);
    })
  };
});
