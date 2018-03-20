//提示框
angular.services
    .factory('pointBox', ['$ionicPopup', '$ionicLoading', function ($ionicPopup, $ionicLoading) {
        var showTip = function(msg) {
          $ionicPopup.show({
            template: '<div>'+msg+'</div>',
            title: '提示',
            buttons:[
              {
                text:'确定',
                type:'my-box-pointBtn'
              }
            ]
          });
        };

        //提示框，有确定、取消按钮
        var confirm = function(msg,success,confirmText,cancelText){
            $ionicPopup.show({
                template: '<div>'+msg+'</div>',
                title: '提示',
                buttons: [
                    {
                        text: cancelText||'取消'
                    },
                    {
                        text: confirmText||'确定',
                        type:'my-box-pointBtn',
                        onTap: function(e) {
                            success&&success()
                        }
                    }
                ]
            });
        };

        var loading = function () {
            this.show = function () {
                $ionicLoading.show({
                    template: '<ion-spinner></ion-spinner>',
                    noBackdrop:false
                });
            };
            this.hide = function () {
                $ionicLoading.hide();
            }
        };

        return {
            showTip:showTip,
            confirm:confirm,
            loading: new loading()
        }
    }]);
