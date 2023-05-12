sipiutang.controller("user", function ($scope, $http, $window, $timeout) {
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

  $scope.dataRole = function () {
    $scope.getRole = [
      { id: "1", role: "Admin" },
      { id: "2", role: "User" },
    ];
  };

  $scope.dataStatus = function () {
    $scope.getStatus = [
      { id: "0", status: "Tidak Aktif" },
      { id: "1", status: "Aktif"},
    ];
  };

  $scope.btnBack = function () {
    $window.location.href = "/user";
  }

  $scope.c = false;
  $scope.check = function () {
    if ($scope.formModel.password != null) {
      $scope.spassword = { border: "solid none" };
      if (
        $scope.formModel.repass != null &&
        angular.equals($scope.formModel.password, $scope.formModel.repass)
      ) {
        $scope.srepass = { border: "solid none" };
        $scope.msg = "";
        $scope.c = true;
      } else if ($scope.formModel.repass == null) {
        if ($scope.formModel.password != "" || $scope.formModel.password == undefined) {
          // $.formModel.srepass = null;
          $scope.msg = "Ulangi Password";
          $scope.srepass = { border: "solid none" };
          $scope.c = false;
        } else {
          $scope.msg = null;
          $scope.srepass = null;
          $scope.c = true;
        }
      } else {
        if ($scope.formModel.password != "" || $scope.formModel.password != undefined) {
          $scope.spassword = { border: "solid red" };
          $scope.srepass = { border: "solid red" };
          $scope.msg = "Password Berbeda";
          $scope.s_msg = { color: "red" };
          $scope.c = false;
        } else {
          $scope.srepass = null;
          $scope.msg = null;
          $scope.c = false;
        }
      }
    } else {
      $scope.spassword = { border: "solid red" };
      $scope.c = false;
    }

    if ($scope.formModel.password == "") {
      $scope.formModel.repass = null;
    }
  };

  $scope.addUserBtn = function () {
    $window.location.href = "/user/add";
  };

  $scope.getUser = function (message) {
    $http.get("/user/getUser").then(function (data) {
      $scope.datas = data.data;
      console.log(data);
    });
  };

  $scope.insertData = function () {
    var form_data = new FormData();
    angular.forEach($scope.files, function(file){
      form_data.append('file', file);
    });
    form_data.append('username', $scope.formModel.username);
    form_data.append('password', $scope.formModel.password);
    form_data.append('repass', $scope.formModel.repass);
    form_data.append('role', $scope.formModel.role);
    form_data.append('status', $scope.formModel.status);
    form_data.append('nama', $scope.formModel.nama);

    $http.post("/user/insertData" ,form_data ,{
      transformRequest : angular.identity,
      headers : {'Content-Type' : undefined, 'Prosess-Data':false}
    }).then(function(data){
      window.scrollTo(0, 0);
      if (data.data.errortext == "") {
        $scope.success = true;
        $scope.message = data.data.message;
        $timeout(function () {
          $scope.success = false;
        }, 5000);
        $window.location.href = "/user";
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
      $http.post("/user/deleteData", {
        id: id,
      }).then(
        function successCallback(data) {
          console.log(data.data);
          window.scrollTo(0, 0);
          $scope.getUser();
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

  $scope.getDetailHeader = function () {
        $scope.openModal("#detailUserHeader");
        $scope.modalTitle = "Detail User";
  };

  $scope.getDetailHeaderData = function (id) {
    console.log('data detail')
    $http.get("/user/getDetail/" + id).then(
      function successCallback(data) {
        console.log(data);
        $scope.modalTitle = "Detail User";
        $scope.setDefault();
        $scope.formModel.id = data.data[0].id;
        $scope.formModel.username = data.data[0].username;
        $scope.formModel.role = data.data[0].role;
        $scope.formModel.status = data.data[0].status;
        $scope.formModel.nama = data.data[0].nama;
        $scope.foto = "/foto/" + data.data[0].foto;

      },
      function errorCallback(response) {
        console.log(response);
        alert("error");
      }
    );
  };

  $scope.getDetail = function (id) {
    console.log('data detail')
    $http.get("/user/getDetail/" + id).then(
      function successCallback(data) {
        console.log(data);
        $scope.openModal("#detailUser");
        $scope.modalTitle = "Detail User";
        // $scope.submitButton = "Update";
        // $scope.actionButton = "Kembali";

        $scope.setDefault();
        $scope.formModel.id = data.data[0].id;
        $scope.formModel.username = data.data[0].username;
        $scope.formModel.role = data.data[0].role;
        $scope.formModel.status = data.data[0].status;
        $scope.formModel.nama = data.data[0].nama;
        $scope.foto = "/foto/" + data.data[0].foto;

      },
      function errorCallback(response) {
        console.log(response);
        alert("error");
      }
    );
  };

  $scope.updateData = function () {
    var form_data = new FormData();
    angular.forEach($scope.files, function(file){
      form_data.append('file', file);
    });
    console.log($scope.formModel.username);
    form_data.append('username', $scope.formModel.username);
    form_data.append('password', $scope.formModel.password);
    form_data.append('repass', $scope.formModel.repass);
    form_data.append('role', $scope.formModel.role);
    form_data.append('status', $scope.formModel.status);
    form_data.append('nama', $scope.formModel.nama);
    form_data.append('fileLama', $scope.foto);

    $http.post("/user/updateData/" + $scope.formModel.id, form_data,{
      transformRequest : angular.identity,
      headers : {'Content-Type' : undefined, 'Prosess-Data':false}
    }). then(function(data){
      $('#detailUser').animate({ scrollTop: 0 }, 'fast');
      if (data.data.errortext == "") {
        $scope.getDetail($scope.formModel.id);
        $scope.success = true;
        console.log(data);
        $timeout(function () {
          $scope.success = false;
        }, 5000);
        $scope.message = data.data.message;
        $scope.getUser();
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
