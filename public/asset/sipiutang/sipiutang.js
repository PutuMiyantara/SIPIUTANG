var sipiutang = angular.module("sipiutang", ["datatables", "chart.js"]);

sipiutang.directive("fileInput", function($parse){
  return{
    link: function($scope, element, attrs) {
      element.on("change", function(event){
        var files = event.target.files;
        // console.log(files[0].name);
        $parse(attrs.fileInput).assign($scope, element[0].files);
        $scope.$apply();
      });
    }
  }
});


// sipiutang.directive("fileInput", [
//   "$parse",
//   function ($parse) {
//     return {
//       restrict: "A",
//       link: function (scope, elm, attrs) {
//         elm.bind("change", function () {
//           $parse(attrs.fileInput).assign(scope, elm[0].files);
//           scope.$apply();
//         });
//       },
//     };
//   },
// ]);

// jika mau menggunakan directive select2 bisa menambah atribut select2 dengan dara menambah tulisan select2="" pada dalam tag
sipiutang.directive("select2", function($timeout, $parse) {
  return {
    restrict: 'AC',
    require: 'ngModel',
    link: function(scope, element, attrs) {
      // console.log(attrs);
      $timeout(function() {
        element.select2();
        element.select2Initialized = true;
      });

      var refreshSelect = function() {
        if (!element.select2Initialized) return;
        $timeout(function() {
          element.trigger('change');
        });
      };
      
      var recreateSelect = function () {
        if (!element.select2Initialized) return;
        $timeout(function() {
          element.select2('destroy');
          element.select2();
        });
      };

      scope.$watch(attrs.ngModel, refreshSelect);

      if (attrs.ngOptions) {
        var list = attrs.ngOptions.match(/ in ([^ ]*)/)[1];
        // watch for option list change
        scope.$watch(list, recreateSelect);
      }

      if (attrs.ngDisabled) {
        scope.$watch(attrs.ngDisabled, refreshSelect);
      }
    }
  };
});

sipiutang.directive('numberInput', function($filter) {
  return {
    require: 'ngModel',
    link: function(scope, elem, attrs, ngModelCtrl) {

      ngModelCtrl.$formatters.push(function(modelValue) {
        return setDisplayNumber(modelValue, true);
      });

      // it's best to change the displayed text using elem.val() rather than
      // ngModelCtrl.$setViewValue because the latter will re-trigger the parser
      // and not necessarily in the correct order with the changed value last.
      // see http://radify.io/blog/understanding-ngmodelcontroller-by-example-part-1/
      // for an explanation of how ngModelCtrl works.
      ngModelCtrl.$parsers.push(function(viewValue) {
        setDisplayNumber(viewValue);
        return setModelNumber(viewValue);
      });

      // occasionally the parser chain doesn't run (when the user repeatedly 
      // types the same non-numeric character)
      // for these cases, clean up again half a second later using "keyup"
      // (the parser runs much sooner than keyup, so it's better UX to also do it within parser
      // to give the feeling that the comma is added as they type)
      elem.bind('keyup focus', function() {
        setDisplayNumber(elem.val());
      });

      function setDisplayNumber(val, formatter) {
        var valStr, displayValue;

        if (typeof val === 'undefined') {
          return 0;
        }

        valStr = val.toString();
        displayValue = valStr.replace(/,/g, '').replace(/[A-Za-z]/g, '');
        displayValue = parseFloat(displayValue);
        displayValue = (!isNaN(displayValue)) ? displayValue.toString() : '';

        // handle leading character -/0
        if (valStr.length === 1 && valStr[0] === '-') {
          displayValue = valStr[0];
        } else if (valStr.length === 1 && valStr[0] === '0') {
          displayValue = '';
        } else {
          displayValue = $filter('number')(displayValue);
        }

        // handle decimal
        if (!attrs.integer) {
          if (displayValue.indexOf('.') === -1) {
            if (valStr.slice(-1) === '.') {
              displayValue += '.';
            } else if (valStr.slice(-2) === '.0') {
              displayValue += '.0';
            } else if (valStr.slice(-3) === '.00') {
              displayValue += '.00';
            }
          } // handle last character 0 after decimal and another number
          else {
            if (valStr.slice(-1) === '0') {
              displayValue += '0';
            }
          }
        }

        if (attrs.positive && displayValue[0] === '-') {
          displayValue = displayValue.substring(1);
        }

        if (typeof formatter !== 'undefined') {
          return (displayValue === '') ? 0 : displayValue;
        } else {
          elem.val((displayValue === '0') ? '' : displayValue);
        }
      }

      function setModelNumber(val) {
        var modelNum = val.toString().replace(/,/g, '').replace(/[A-Za-z]/g, '');
        modelNum = parseFloat(modelNum);
        modelNum = (!isNaN(modelNum)) ? modelNum : 0;
        if (modelNum.toString().indexOf('.') !== -1) {
          modelNum = Math.round((modelNum + 0.00001) * 100) / 100;
        }
        if (attrs.positive) {
          modelNum = Math.abs(modelNum);
        }
        return modelNum;
      }
    }
  };
});
