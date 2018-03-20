/**
 * Created by HJH on 15/5/12.
 */

angular.controllers
    .directive('basisContent', function() {
        return {
            restrict: 'E',
            transclude: true,
            templateUrl: 'templates/basisContent.html',
            priority: 100,
            bindToController: true,
            link: function($scope, element) {
                $scope.pageReload = function () {
                    //tz
                    $scope.dataError = false;
                    $scope.getData&&$scope.getData();
                };

                if(ionic.Platform.isWebView()) {
                    $scope.$on('$ionicView.afterEnter', function () {
                        $scope.showTimeout = true;
                    });
                } else {
                    $scope.showTimeout = true;
                }
            }
        }
    });
