//订单详情
angular.controllers
  .controller('orderDetailCtrl', ['$scope','$stateParams',function($scope,$stateParams) {
    var orderList = [{
      name:'北京烤鸭、糖醋排骨、剁椒鱼头',
      picture:'./img/store.jpg',
      date:1446949313246,
      price:200.00,
      address:'广州市白云区',
      status:0 //0待取 1已取
    },
      {
        name:'北京烤鸭、糖醋排骨、剁椒鱼头',
        picture:'./img/store.jpg',
        date:1446949313246,
        price:200.00,
        address:'广州市白云区',
        status:0 //0待取 1已取
      },
      {
        name:'北京烤鸭、糖醋排骨、剁椒鱼头',
        picture:'./img/store.jpg',
        date:1446949313246,
        price:200.00,
        address:'广州市白云区',
        status:1 //0待取 1已取
      },
      {
        name:'北京烤鸭、糖醋排骨、剁椒鱼头',
        picture:'./img/store.jpg',
        date:1446949313246,
        price:200.00,
        address:'广州市白云区',
        status:1 //0待取 1已取
      }
    ];
    var id = parseInt($stateParams.id);
    $scope.orderDetail = orderList[id];
  }]);
