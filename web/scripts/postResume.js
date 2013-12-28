'use strict';

var jobPostModule = angular.module('postResume', []);

jobPostModule.controller('PostResumeController', function($scope, $http) {

    $scope.submitResume = function() {
        $http({
            method: 'POST',
            url: globals.path + 'api/resume/post',
            data: $.param($scope.job), /* pass in data as strings*/
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}  /* set the headers so angular passing info as form data (not request payload)*/
        })
        .success(function(data) {
            console.log(data);

            if (!data.success) {
                // if not successful, bind errors to error variables
                $scope.message = data.message;
            } else {
                // if successful, bind success message to message
                $scope.message = data.message;
                window.location.href = globals.path + 'employer/post/preview?id=1';
            }
        });
    };
});