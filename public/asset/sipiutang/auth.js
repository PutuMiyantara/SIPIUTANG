sipiutang.controller("auth", function ($scope, $http, $window, $timeout) {
  $scope.setDefault = function () {
    // $scope.error = false;
    // $scope.success = false;
    $scope.formModel = {};
    console.log('set default');
  };

  $scope.login = function () {
    $http.post("/auth/login", {
        username: $scope.username,
        password: $scope.password,
      })
      .then(
        function successCallback(data) {
          if (data.data.dataLogin != "") {
            console.log(data.data);
            $scope.message = data.data.dataLogin;
            $scope.error = true;
          } else {
            if (data.data.checkUser == "admin") {
              $window.location.href = "/dashboard";
              console.log('admin');
            } else if (data.data.checkUser == "user") {
              console.log('admin');
              $window.location.href = "/dashboard";
            }
          }
        },
        function errorCallback(response) {
          $scope.message = "Gagal Melakukan Login";
          $scope.error = true;
          console.log(response);
        }
      );
  };
});
