
//"use strict";

/* Declare app level module which depends on filters, and services */
var loginModule = angular.module('loginApp', []);


/* Controllers */
loginModule.controller('LoginController', function($scope, $http) {

    $scope.session = {};
    $scope.login = function() {
        //$scope.session.email = 'swathi.paipalle@yahoo.com'

        $http({
            method: 'POST',
            url: globals.path + 'api/user/login',
            data: $.param($scope.session), // pass in data as strings
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}  // set the headers so angular passing info as form data (not request payload)
        }).success(function(data) {
            //console.log(data);

            if (!data.success) {
                // if not successful, bind errors to error variables
                $scope.message = data.message;
            } else {
                // if successful, bind success message to message
                $scope.message = data.message;
                if (data.redirectUrl) {
                    window.location.href = data.redirectUrl;
                }
            }
        });
    };

});