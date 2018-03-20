
angular.controllers
  .controller('mainCtrl', ['$scope','$ionicHistory',function($scope,$ionicHistory) {
    $scope.showBack = false;
    $scope.$on('$ionicView.beforeEnter', function () {
      var currentView = $ionicHistory.currentView();
      if(currentView.stateName){
        switch (currentView.stateName){
          case 'main.home':
            $scope.showBack = false;
            break;
          default :
            $scope.showBack = true;
        }
      }
    });
  }]);
