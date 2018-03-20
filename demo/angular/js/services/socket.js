//socket通信
angular.services

    .factory('mySocket', function () {
        return io.connect('http://10.8.8.75:8888');
    });
