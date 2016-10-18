;(function () {
    'use strict';

    angular.module('blacksun', [
            'ui.router'
    ])
    .config(function ($interpolateProvider,
                      $stateProvider,
                      $urlRouterProvider) {
            $interpolateProvider.startSymbol('[:');
            $interpolateProvider.endSymbol(':]');

            $urlRouterProvider.otherwise('/home');

            $stateProvider
                .state('login', {
                    url: '/login',
                    templateUrl: 'login.tpl'
                });
            $stateProvider
                .state('home', {
                    url: '/home',
                    templateUrl: 'home.tpl'
                });
            $stateProvider
                .state('signup', {
                    url: '/signup',
                    templateUrl: 'signup.tpl'
                });

    });

})();