'use strict';

var resumePreviewModule = angular.module('resumePreview', []);
resumePreviewModule.controller('previewController', function($scope, $http) {
    $scope.resume = {};
    $scope.showpreview = function() {
     return http({
            method: 'GET',
            url: '/api/resume/preview?id='+pageData.id,
            data: $.param($scope.resume), /* pass in data as strings*/
            headers: {'Content-Type': 'application/x-www-form-urlencoded'} /* set the headers so angular passing info as form data (not request payload)*/
        })
           .success(function(data) {
            if (!data.success) {
                // if not successful, bind errors to error variables
                $scope.message = data.message;
            } else {
                // if successful, bind success message to message
                $scope.message = data.message;
                //window.location.href = globals.path + 'jobseeker/preview?id='+data.id;
            }
        });
    };
});

