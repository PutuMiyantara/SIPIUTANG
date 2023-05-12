sipiutang.controller("retur", function ($scope, $http, $window, $timeout) {
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
    $window.location.href = "/retur/add";
  };

  $scope.getRetur = function () {
    $http.get("/retur/getRetur/null").then(function (data) {
      $scope.datas = data.data;
      console.log(data);
    });
  };

  $scope.setTermin = function () {
    $scope.termin = 10;
  };

  $scope.returChange = function(){
    id_retur = $scope.formModel.id_retur;
    console.log($scope.formModel.id_retur);
    $http.get("/retur/getRetur/" + id_retur).then(function (data) {
      if(id_retur != null){
        $scope.formModel.nilai_sisa_retur = data.data[0].nilai_sisa_retur;
      } else {
        $scope.formModel.nilai_sisa_retur = undefined;
      }
    });
    $scope.formModel.id_retur =id_retur;
  };

  $scope.insertData = function () {
    mnth = ("0" + ($scope.tgl_retur.getMonth() + 1)).slice(-2),
    day = ("0" + $scope.tgl_retur.getDate()).slice(-2);
    tgl_retur = [$scope.tgl_retur.getFullYear(), mnth, day].join("-");
    // tgl_invoice = new Date(tgl_invoice);
    $http
      .post("/retur/insertData", {
        no_retur: $scope.no_retur,
        tgl_retur: tgl_retur,
        nilai_retur: $scope.nilai_retur,
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
            $window.location.href = "/retur";
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
      $http.post("/retur/deleteData", {
        id: id,
      }).then(
        function successCallback(data) {
          console.log(data);
          $scope.getRetur();
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
    $http.get("/retur/getDetail/" + id).then(
      function successCallback(data) {
        $scope.setDefault();
        console.log(data.data);
        $scope.openModal("#detailRetur");
        $scope.modalTitle = "Detail Retur";
        // $scope.submitButton = "Update";
        // $scope.actionButton = "Kembali";
        $scope.formModel.id = data.data[0].id;
        $scope.formModel.no_retur = data.data[0].no_retur;
        $scope.formModel.tgl_retur = new Date(data.data[0].tgl_retur);
        $scope.formModel.nilai_retur = data.data[0].nilai_retur;
        $scope.formModel.nilai_sisa_retur = data.data[0].nilai_sisa_retur;
      },
      function errorCallback(response) {
        console.log(response);
        alert("error");
      }
    );
  };

  $scope.updateData = function () {
    mnth = ("0" + ($scope.formModel.tgl_retur.getMonth() + 1)).slice(-2),
    day = ("0" + $scope.formModel.tgl_retur.getDate()).slice(-2);
    tgl_retur = [$scope.formModel.tgl_retur.getFullYear(), mnth, day].join("-");
    $http.post("/retur/updateData/" + $scope.formModel.id, {
      no_retur: $scope.formModel.no_retur,
      tgl_retur: tgl_retur,
    }).then(function successCallback(data) {
      console.log(data.data);
      $('.modal').animate({ scrollTop: 0 }, 'fast');
      if (data.data.errortext == "") {
        $scope.success = true;
        $scope.message = data.data.message;
        $timeout(function () {
          $scope.success = false;
        }, 5000);
        $scope.getDetail($scope.formModel.id);
        $scope.getRetur();
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

  $scope.getNoRetur = function () {
    const d = new Date();
    // console.log(d.getTime());
    console.log(d.getMilliseconds().toString());
    $scope.no_retur = d.getFullYear().toString() + (d.getMonth()+1).toString() + d.getDate().toString() + d.getHours().toString() + d.getMinutes().toString() + d.getSeconds().toString() + d.getMilliseconds().toString();
  };
});
