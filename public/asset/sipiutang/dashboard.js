sipiutang.controller("dashboard", function ($scope, $http, $window, $timeout) {
  $scope.dataHeader = function () {
     
  };

  $scope.getDataBoxDash = function () {
    $http.get("/dashboard/getDataBoxDash").then(function (data) {
      $scope.count_invoice = data.data[0].data_count;
      $scope.sum_nilai_invoice = data.data[0].data_sum;
      
      $scope.count_payment = data.data[1].data_count;
      $scope.sum_nominal_payment = data.data[1].data_sum;

      $scope.count_cstmr = data.data[2].data_count;
      
      $scope.count_sisa_hutang = data.data[3].data_count;
      $scope.sum_sisa_hutang = data.data[3].data_sum;
    });
  };

  $scope.getChartPiutang = function () {
    $http.get("/dashboard/getChartPiutang").then(function (data) {
      var sum_nilai_invoice = data.data.sum_nilai_invoice;
      var hutang_terbayar = data.data.hutang_terbayar;
      var sum_sisa_hutang = data.data.sum_sisa_hutang;
      var sum_potongan_retur = data.data.sum_potongan_retur;
      var range_date = data.data.range_date;
      $scope.label = ["Hutang Terbayar", "Tidak Sisa Hutang", "Retur"];
      $scope.data = [hutang_terbayar, sum_sisa_hutang, sum_potongan_retur];
      $scope.range_date = range_date;
      $scope.sum_nilai_invoice = sum_nilai_invoice;
      $scope.colorchart = [
        {
          backgroundColor: ["rgba(0, 255, 46, 0.25)"],
          pointBackgroundColor: ["rgba(2, 171, 154)"],
          borderColor: ["rgba(159,204,0, 0.2)", "rgba(159,204,0, 0.2)"],
          pointBorderColor: ["rgba(159,204,0, 0.2)", "rgba(159,204,0, 0.2)"],
          pointHoverBorderColor: [
            "rgba(159,204,0, 0.2)",
            "rgba(159,204,0, 0.2)",
          ],
        },
        {
          backgroundColor: ["rgba(255, 0, 0, 0.25)"],
          pointBackgroundColor: ["rgba(255, 0, 0, 1)"],
          borderColor: ["rgba(159,204,0, 0.2)", "rgba(159,204,0, 0.2)"],
          pointBorderColor: ["rgba(159,204,0, 0.2)", "rgba(159,204,0, 0.2)"],
          pointHoverBorderColor: [
            "rgba(159,204,0, 0.2)",
            "rgba(159,204,0, 0.2)",
          ],
        },
        {
          backgroundColor: ["rgba(0, 11, 255, 0.25)"],
          pointBackgroundColor: ["rgba(0, 11, 255, 1.0)"],
          borderColor: ["rgba(159,204,0, 0.2)", "rgba(159,204,0, 0.2)"],
          pointBorderColor: ["rgba(159,204,0, 0.2)", "rgba(159,204,0, 0.2)"],
          pointHoverBorderColor: [
            "rgba(159,204,0, 0.2)",
            "rgba(159,204,0, 0.2)",
          ],
        },
        "rgba(250,109,33,0.5)",
        "#9a9a9a",
        "rgb(233,177,69)",
      ];
    });
  };

  $scope.getChartTransaksi = function () {
    $http.get("/dashboard/getChartTransaksi").then(function (data) {
      // $scope.dataTransaksi = data.data;
      console.log(data.data[3].sum_nilai_invoice);
      var dataTransaksi = [];
      for (let index = 0; index < 12; index++) {
        dataTransaksi.push(data.data[index].sum_nilai_invoice)
      }


      var ctx = document.getElementById("barchart").getContext("2d");
      var data = {
        labels : ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets : [{
          label : "Penjualan Barang",
          // data : [10, 20, 50, 4, 30, 30, 55, 2, 9, 10, 11, 12],
          data : dataTransaksi,
          backgroundColor : [
            '#B03A2E',
            '#633974',
            '#1A5276',
            '#117864',
            '#979193',
            '#196F3D',
            '#D4AC0D',
            '#839192',
            '#2E4053',
            '#5DADE2',
            '#E59866',
            '#D2B4DE',
          ], 
        }]
      };

      var myBarChart = new Chart(ctx, {
        type : 'bar',
        data : data,
        options : {
          legend : {
            display : false
          }, 
          barValueSpacing : 20, 
          scales : {
            yAxes : [{
              ticks : {
                min : 0,
              }
            }],
            xAxes : [{
              gridLines : {
                color : "rgba(0,0,0,0)",
              }
            }]
          }
        },
      })
    });
   
  };
  
  // sudah mau
  // $scope.getChartTransaksi = function () {
  //   var ctx = document.getElementById("barchart").getContext("2d");
  //   var data = {
  //    labels : ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
  //    datasets : [{
  //      label : "Penjualan Barang",
  //      data : [10, 20, 50, 4, 30, 30, 55, 2, 9, 10, 11, 12],
  //      backgroundColor : [
  //        '#B03A2E',
  //        '#633974',
  //        '#1A5276',
  //        '#117864',
  //        '#979193',
  //        '#196F3D',
  //        '#D4AC0D',
  //        '#839192',
  //        '#2E4053',
  //        '#5DADE2',
  //        '#E59866',
  //        '#D2B4DE',
  //      ]
  //    }]
  //   };
 
  //   var myBarChart = new Chart(ctx, {
  //    type : 'bar',
  //    data : data,
  //    options : {
  //      legend : {
  //        display : false
  //      }, 
  //      barValueSpacing : 20, 
  //      scales : {
  //        yAxes : [{
  //          ticks : {
  //            min : 0,
  //          }
  //        }],
  //        xAxes : [{
  //          gridLines : {
  //            color : "rgba(0,0,0,0)",
  //          }
  //        }]
  //      }
  //    },
  //   })
  //  };
});
