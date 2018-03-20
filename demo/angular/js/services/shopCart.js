//购物车
angular.services
  .service('shopCart', function () {
    var me = this;
    this.shopList = {
      price:0,
      total:0,
      shop:[]
    };

    this.addShop = function (shop) {
      me.shopList.total += 1;
      me.shopList.price += shop.discount;
      if(me.shopList.shop.length == 0){
        me.shopList.shop.push({
          id:shop.id,
          name:shop.name,
          discount:shop.discount,
          total:1
        });
        return;
      }
      //是否有这道菜
      var hasShop = false;
      angular.forEach(me.shopList.shop,function(value,i){
        if(value.id == shop.id){
          hasShop = true;
          value.total += 1;
        }
      });
      if(!hasShop){
        me.shopList.shop.push({
          id:shop.id,
          name:shop.name,
          discount:shop.discount,
          total:1
        });
      }
    };

    this.removeShop = function (shop) {
      me.shopList.total -= 1;
      me.shopList.price -= shop.discount;
      var id = shop.id;
      angular.forEach(me.shopList.shop,function(value,i){
        if(value.id == id){
          if(value.total){
            value.total -= 1;
          }else{
            me.shopList.shop.splice(i,1);
          }
        }
      });
    };
  });
