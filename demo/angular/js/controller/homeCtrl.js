//首页
angular.controllers
  .controller('homeCtrl', ['$scope','pointBox','shopCart','dish','$state',function($scope,pointBox,shopCart,dish,$state) {
    $scope.shopCart = shopCart;
    $scope.dish = dish;
    //五天的时间列表
    var getDateList = function () {
      var list = [];
      var now = new Date().getTime();
      for(var i = 0;i < 5;i++){
        var day = new Date(now + i*24*3600*1000).getDate();
        list.push(day);
      }
      return list;
    };

    $scope.dateList = getDateList();
    $scope.currentDate = $scope.dateList[0];
    $scope.selectDate = function (date) {
      $scope.currentDate = date;
    };

    //$scope.dishList = testData.dishList;

    $scope.addDish = function (index,id) {
      if(dish.dishList[index].total > dish.dishList[index].count){
        dish.dishList[index].count += 1;
        shopCart.addShop(dish.dishList[index]);
      }else{
        pointBox.showTip('超过今日最大菜数！');
      }
    };

    $scope.minusDish = function (index,id) {
      if(dish.dishList[index].count){
        dish.dishList[index].count -= 1;
        shopCart.removeShop(dish.dishList[index]);
      }
    };

    $scope.dishDetail = function (index,id,name,count) {
      $state.go('main.dishDetail',{index:index,name:name,id:id,count:count})
    };

  }]);
