/*美食详情*/
angular.controllers
  .controller('dishDetailCtrl', ['$scope','$stateParams','pointBox','shopCart','dish','$ionicScrollDelegate','testData',
    function($scope,$stateParams,pointBox,shopCart,dish,$ionicScrollDelegate,testData) {
    $scope.shopCart = shopCart;
    $scope.dishName = $stateParams.name;
    $scope.dishDetail = testData.dishDetail[$stateParams.id];
    $scope.dishDetail.count = parseInt($stateParams.count);
    //评论页数——每页10条

    $scope.commentPage = [];
    for(var i = 0,length = Math.ceil($scope.dishDetail.comment.length/10);i < length;i++){
      if($scope.dishDetail.comment.length > 10&&($scope.dishDetail.comment.length - i*10) > 0){
        $scope.commentPage.push(
          $scope.dishDetail.comment.slice(i*10,(i+1)*10)
        );
      }else{
        $scope.commentPage.push(
          $scope.dishDetail.comment.slice(i*10)
        );
      }
    }

    $scope.commentList = $scope.commentPage[0];
    $scope.selectPage = function (index) {
      $scope.commentList = $scope.commentPage[index];
      $ionicScrollDelegate.resize();
    };

    $scope.addDish = function () {
      if($scope.dishDetail.total > $scope.dishDetail.count){
        $scope.dishDetail.count += 1;
        dish.dishList[$stateParams.index].count += 1;
        shopCart.addShop(dish.dishList[$stateParams.index]);
      }else{
        pointBox.showTip('超过今日最大菜数！');
      }
    };

    $scope.minusDish = function () {
      if($scope.dishDetail.count){
        $scope.dishDetail.count -= 1;
        dish.dishList[$stateParams.index].count -= 1;
        shopCart.removeShop(dish.dishList[$stateParams.index]);
      }
    };
  }]);
