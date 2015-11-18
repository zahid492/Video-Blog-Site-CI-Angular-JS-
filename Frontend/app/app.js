var app = angular.module('app', ['ngResource', 'ngRoute','dcbClearInput']).constant('domain', 'http://localhost:81/probaze/api');

app.config([
    '$routeProvider', function ($routeProvider) {
        $routeProvider
         .when('/home',
            { templateUrl: 'app/views/home.html', controller: 'BlogController' })
         .otherwise({
             redirectTo: '/home',
             templateUrl: 'app/views/home.html', controller: 'BlogController'
         });


    }

]);