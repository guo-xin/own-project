//我的订单
angular.controllers
  .controller('orderCtrl', ['$scope','$state',function($scope,$state) {
    $scope.toDetail = function(id){
      $state.go('main.orderDetail',{id:id});
    };
    $scope.orderList = [{
      name:'北京烤鸭、糖醋排骨、剁椒鱼头',
      picture:'./img/store.jpg',
      date:1446949313246,
      price:200.00,
      status:0 //0待取 1已取
    },
      {
        name:'北京烤鸭、糖醋排骨、剁椒鱼头',
        picture:'./img/store.jpg',
        date:1446949313246,
        price:200.00,
        status:0 //0待取 1已取
      },
      {
        name:'北京烤鸭、糖醋排骨、剁椒鱼头',
        picture:'./img/store.jpg',
        date:1446949313246,
        price:200.00,
        status:1 //0待取 1已取
      },
      {
        name:'北京烤鸭、糖醋排骨、剁椒鱼头',
        picture:'./img/store.jpg',
        date:1446949313246,
        price:200.00,
        status:1 //0待取 1已取
      }
    ];
  }]);
