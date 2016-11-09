;(function () {
    'use strict';
    angular.module('user',[])

        .service('UserService', [
            '$state',
            '$http',
            function ($state,$http) {
                var me = this;
                me.signup_data = {};
                me.login_data = {};
                me.signup = function () {
                    $http.post('/public/api/signup',
                        {username:me.signup_data.username,
                            password:me.signup_data.password})
                        .then(function (r) {
                            if(r.data.status){
                                me.signup_data = {};
                                $state.go('login');
                            }
                        }, function (e) {
                            console.log(e);
                        })
                }
                me.login = function () {
                    $http.post('/public/api/login',me.login_data)
                        .then(function (r) {
                            if(r.data.status){
                                location.href = '/public';
                            }
                            else{
                                me.login_failed = true;
                            }
                        }, function (e) {

                        })
                }

                me.username_exists = function () {
                    $http.post('/public/api/user/exists',
                        {username:me.signup_data.username})
                        .then(function (r) {
                            if(r.data.status && r.data.data.count){
                                me.signup_username_exists = true;
                            }
                            else{
                                me.signup_username_exists = false;
                            }
                        }, function (e) {
                            console.log('e',e);
                        })
                }
            }])

        .controller('SignupController',[
            '$scope',
            'UserService',
            function ($scope,UserService) {
                $scope.User = UserService;

                $scope.$watch(function () {
                    return UserService.signup_data;
                }, function (n,o) {
                    if(n.username != o.username){
                        UserService.username_exists();
                    }
                },true);
            }])

        .controller('LoginController',[
            '$scope',
            'UserService',
            function ($scope,UserService) {
                $scope.User = UserService;
            }])

})();