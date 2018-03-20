// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
// 'starter.services' is found in services.js
// 'starter.controllers' is found in controllers.js
angular.module('starter', ['ionic', 'starter.controllers', 'starter.services'])

  .run(function($ionicPlatform,$rootScope,pointBox,$timeout,$location,$ionicHistory) {
    $ionicPlatform.ready(function() {
      // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
      // for form inputs)
      if (window.cordova && window.cordova.plugins && window.cordova.plugins.Keyboard) {
        cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
        cordova.plugins.Keyboard.disableScroll(true);

      }
      if (window.StatusBar) {
        // org.apache.cordova.statusbar required
        StatusBar.styleLightContent();
      }

      $rootScope.keyboard_hasShown = false;
      //This event fires when the keyboard will be shown
      window.addEventListener('native.keyboardshow', function () {
        $rootScope.keyboard_hasShown = true;
      });
      //This event fires when the keyboard will hide
      window.addEventListener('native.keyboardhide', function () {
        $timeout(function(){$rootScope.keyboard_hasShown = false;},100)
      });
    });

    var exitFlag = 0;
    function showConfirm() {
      exitFlag ++ ;
      exitFlag == 2 && ionic.Platform.exitApp();
      pointBox.showTip('再按一次退出程序.');
      $timeout(function () {exitFlag = 0}, 2000)
    }
    $ionicPlatform.registerBackButtonAction(function (e) {
      if($rootScope.keyboard_hasShown){
        return false;
      }
      if($location.path() == '/tab/message'){
        showConfirm();
        return false;
      }
    }, 100);
  })

  .config(function($stateProvider, $urlRouterProvider,$ionicConfigProvider) {
    //去除动画并设置tabs在底部
    $ionicConfigProvider.tabs.position('bottom');
    $ionicConfigProvider.tabs.style('standard');
    // Ionic uses AngularUI Router which uses the concept of states
    // Learn more here: https://github.com/angular-ui/ui-router
    // Set up the various states which the app can be in.
    // Each state's controller can be found in controllers.js
    $stateProvider

      // setup an abstract state for the tabs directive

      .state('main', {
        url: '/main',
        templateUrl: 'templates/main.html',
        controller: 'mainCtrl'
      })
      .state('main.home', {
        url: '/home',
        views: {
          'main-content': {
            templateUrl: 'templates/home.html',
            controller: 'homeCtrl'
          }
        }
      })
      .state('main.dishDetail', {
        url: '/dishDetail?index&id&name&count',
        views: {
          'main-content': {
            templateUrl: 'templates/dish-detail.html',
            controller: 'dishDetailCtrl'
          }
        }
      })
      .state('main.shopCart', {
        url: '/shopCart',
        views: {
          'main-content': {
            templateUrl: 'templates/shop-cart.html',
            controller: 'shopCartCtrl'
          }
        }
      })
      .state('main.pay', {
        url: '/pay',
        views: {
          'main-content': {
            templateUrl: 'templates/pay.html',
            controller: 'payCtrl'
          }
        }
      })
      .state('main.order', {
        url: '/order',
        views: {
          'main-content': {
            templateUrl: 'templates/order.html',
            controller: 'orderCtrl'
          }
        }
      })
      .state('main.orderDetail', {
        url: '/orderDetail?id',
        views: {
          'main-content': {
            templateUrl: 'templates/order-detail.html',
            controller: 'orderDetailCtrl'
          }
        }
      });
    // if none of the above states are matched, use this as the fallback
    $urlRouterProvider.otherwise('/main/home');
  });

angular.controllers = angular.module('starter.controllers', ['ionic','ngCordova']);

angular.services = angular.module('starter.services', ['ionic','ngCordova']);
