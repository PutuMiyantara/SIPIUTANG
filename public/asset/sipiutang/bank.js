sipiutang.controller("bank", function ($scope, $http, $window, $timeout) {
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
    $window.location.href = "/bank";
  }

  $scope.addBtn = function () {
    $window.location.href = "/bank/add";
  };

  $scope.getBank = function (message) {
    $http.get("/bank/getBank").then(function (data) {
      $scope.datas = data.data;
      console.log(data);
    });
  };

  $scope.insertData = function () {
    $http.post("/bank/insertData", {
      nama_bank: $scope.formModel.nama_bank,
      alias: $scope.formModel.alias,
    }).then(function(data){
      window.scrollTo(0, 0);
      if (data.data.errortext == "") {
        $scope.success = true;
        $scope.message = data.data.message;
        $timeout(function () {
          $scope.success = false;
        }, 5000);
        $window.location.href = "/bank";
      } else {
        $scope.error = true;
        $scope.message = data.data.errortext;
        $timeout(function () {
          $scope.error = false;
        }, 5000);
      }
    }, function errorCallback(response) {
      console.log(response);
      window.scrollTo(0, 0);
      $scope.error = true;
      $scope.message = "Gagal Menyimpan data";
      console.log("Gagal Menyimpan Data", response);
    });
  };

  $scope.deleteData = function (id) {
    console.log(id);
    var isconfirm = confirm("Ingin Menghapus Data?");
    if (isconfirm) {
      $http.post("/bank/deleteData", {
        id: id,
      }).then(
        function successCallback(data) {
          console.log(data.data);
          window.scrollTo(0, 0);
          $scope.getBank();
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

  $scope.getDetail = function (id) {
    console.log('data detail')
    $http.get("/bank/getDetail/" + id).then(
      function successCallback(data) {
        console.log(data);
        $scope.openModal("#detailBank");
        $scope.modalTitle = "Detail User";
        $scope.setDefault();
        $scope.formModel.id = data.data[0].id;
        $scope.formModel.nama_bank = data.data[0].nama_bank;
        $scope.formModel.alias = data.data[0].alias;

      },
      function errorCallback(response) {
        console.log(response);
        alert("error");
      }
    );
  };

  $scope.updateData = function () {
    $http.post("/bank/updateData/" + $scope.formModel.id, {
      nama_bank: $scope.formModel.nama_bank,
      alias: $scope.formModel.alias,
    }).then(function(data){
      $('#detailBank').animate({ scrollTop: 0 }, 'fast');
      if (data.data.errortext == "") {
        $scope.getDetail($scope.formModel.id);
        $scope.success = true;
        console.log(data);
        $timeout(function () {
          $scope.success = false;
        }, 5000);
        $scope.message = data.data.message;
        $scope.getBank();
        $scope.setDefault();
      } else {
        console.log('update data 111');
        console.log(data);
        $scope.error = true;
        $scope.message = data.data.errortext;
      }
    }, function errorCallback(response) {
      console.log(response);
      $('#detailUser').animate({ scrollTop: 0 }, 'fast');
      $scope.readOnly = false;
      $scope.hide = false;
      console.log("gagalfoto", response);
      $scope.error = true;
      $scope.message = "Gagal Mengubah Data";
    });
  };
});
