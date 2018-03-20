//菜单
angular.services

  .factory('dish',['testData', function (testData) {
    var dishList = testData.dishList;
    angular.forEach(dishList,function(value){
      value.count = 0;
    });

    var findDish = function (id) {
      var index = null;
      angular.forEach(dishList,function(value,i){
        if(id == value.id){
          index = i;
        }
      });
      return index;
    };
    return {
      dishList:dishList,
      findDish:findDish
    }
  }]);
