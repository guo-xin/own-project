//购物车
angular.controllers
  .controller('shopCartCtrl', ['$scope','shopCart','dish','pointBox',function($scope,shopCart,dish,pointBox) {
    $scope.shopCart = shopCart;
    $scope.payUser = {
      name:'13570440715',
      phone:13570440715,
      takeType:1
    };

    $scope.addDish = function (id,index) {
      var i = dish.findDish(id);
      if(dish.dishList[i].total > dish.dishList[i].count){
        dish.dishList[i].count += 1;
        shopCart.addShop(dish.dishList[i]);
      }else{
        pointBox.showTip('超过今日最大菜数！');
      }
    };

    $scope.minusDish = function (id) {
      var i = dish.findDish(id);
      if(dish.dishList[i].count){
        dish.dishList[i].count -= 1;
        shopCart.removeShop(dish.dishList[i]);
      }
    };
  }]);
