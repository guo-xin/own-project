/**
 * Created by tz on 2015/10/14.
 */
angular.services

  .factory('$request', ['$q', '$http', '$localStorage', '$timeout', function ($q, $http, $localStorage, $timeout) {
    var canceler = $q.defer();

    //数据访问路径
    var httpURL = appConf.host;

    angular.services.ssk = $localStorage.getObject('user').ssk||'3654654654674564';

    return {
      jsonp: function (url, obj, success, error, cache) {
        $http.jsonp(httpURL + url + '?callback=JSON_CALLBACK&ssk=' + angular.services.ssk,
          {params: obj, data: obj, timeout: canceler.promise, cache: cache ? true : false}
        )
          .success(
          function (data, status, headers, config, statusText) {
            data.status ? error && error(data, status, headers, config, statusText) : success && $timeout(function(){success(data, status, headers, config, statusText)}, 500);
          }
        ).error(
          function (data, status, headers, config, statusText) {
            data = data || {};
            data.msg = '网络连接失败';
            error && error(data, status, headers, config, statusText);
          }
        )

      },
      post: function (url, obj, success, error) {
        $http({
          method: 'POST',
          url: (obj._host || httpURL) + (url || '') + '&ssk=' + angular.services.ssk,
          data: obj,
          headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
          .success(
          function (data, status, headers, config, statusText) {
            data.status ? error && error(data, status, headers, config, statusText) : success && success(data, status, headers, config, statusText);
          }
        ).error(
          function (data, status, headers, config, statusText) {
            if(canceler.promise.$$state.value){
              $timeout(function(){canceler = $q.defer();}, 100);
              return false;
            }
            data = data || {};
            data.msg = '网络连接失败';
            error && error(data, status, headers, config, statusText);
          }
        )
      },
      cancel: function () {
        canceler.resolve();
      }
    }

  }]);
