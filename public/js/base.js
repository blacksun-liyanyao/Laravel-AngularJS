;(function () {
    'use strict';

    window.his = {
        id:parseInt($('html').attr('user-id'))
    };

    angular.module('blacksun', [
            'ui.router',
            'common',
            'question',
            'user',
            'answer'
    ])
    .config(['$interpolateProvider',
            '$stateProvider',
            '$urlRouterProvider',
            function ($interpolateProvider,
                      $stateProvider,
                      $urlRouterProvider) {
            $interpolateProvider.startSymbol('[:');
            $interpolateProvider.endSymbol(':]');

            $urlRouterProvider.otherwise('/home');

            $stateProvider
                .state('login', {
                    url: '/login',
                    templateUrl: 'tpl/page/login'
                })
                .state('home', {
                    url: '/home',
                    templateUrl: 'tpl/page/home'
                })
                .state('signup', {
                    url: '/signup',
                    templateUrl: 'tpl/page/signup'
                })
                .state('question', {
                    abstract:true,
                    url: '/question',
                    template: '<div ui-view></div>'
                })
                .state('question.add', {
                    url: '/add',
                    templateUrl: 'tpl/page/question_add'
                });

        }])
})();