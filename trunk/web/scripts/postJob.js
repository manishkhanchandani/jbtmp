'use strict';

var jobPostModule = angular.module('postJob', []);

jobPostModule.controller('PostJobController', function($scope) {
    
    $scope.jobPosition = [{
            "position": "Full-time",
            "id": 1
        }, {
            "position": "Part-time",
            "id": 2
        },{
            "position": "Contract - corp-to-corp",
            "id": 3
        },{
            "position": "Contract - Independent",
            "id": 4
        },{
            "position": "Contract - W2",
            "id": 5
        },{
            "position": "Contract to hire - corp-to-corp",
            "id": 6
        },{
            "position": "Contract to hire - Independent",
            "id": 7
        }];
    
    $scope.job = {};

    $scope.submitJob = function() {
        $http({
            method: 'POST',
            url: globals.path + 'api/employer/post',
            data: $.param($scope.user), /* pass in data as strings*/
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
            }
        });
    };
});