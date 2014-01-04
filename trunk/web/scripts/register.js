'use strict';

var appModule = angular.module('App', ['shared']);

appModule.controller('Controller', function($scope, $http) {
    $scope.user = {};

    $scope.submit = function() {
        $http({
            method: 'POST',
            url: globals.path + 'api/user/add',
            data: $.param($scope.user), /* pass in data as strings*/
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}  /* set the headers so angular passing info as form data (not request payload)*/
        }).success(function(data) {
            console.log(data);

            if (!data.success) {
                // if not successful, bind errors to error variables
                $scope.message = data.message;
                $location.path("/login");
            } else {
                // if successful, bind success message to message
                $scope.message = data.message;
            }
        });
    };
});