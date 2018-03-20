//支付
angular.controllers
  .controller('payCtrl', ['$scope','pointBox',function($scope,pointBox) {
    $scope.pay = function () {
      pointBox.showTip('谢谢使用！');
    }
  }]);
