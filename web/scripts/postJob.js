'use strict';

var jobPostModule = angular.module('postJob', ['shared']);

jobPostModule.factory('userService', function($http) {

    var userInfo = {};

    userInfo.getUserDetails = function() {
        return $http({
            method: 'POST',
            url: globals.path + 'api/user/details',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        });
    };
    return userInfo;
});

jobPostModule.controller('PostJobController', function($scope, $http, userService) {

    $scope.jobPosition = [{
            "position": "Full-time",
            "id": 1
        }, {
            "position": "Part-time",
            "id": 2
        }, {
            "position": "Contract - corp-to-corp",
            "id": 3
        }, {
            "position": "Contract - Independent",
            "id": 4
        }, {
            "position": "Contract - W2",
            "id": 5
        }, {
            "position": "Contract to hire - corp-to-corp",
            "id": 6
        }, {
            "position": "Contract to hire - Independent",
            "id": 7
        }];

    $scope.job = {};
    $scope.job.apply = 'email';
    $scope.userDetails = [];

    userService.getUserDetails().success(function(response) {
        $scope.userDetails = response.data;
    });

    $scope.submitJob = function() {

        if ($scope.jobForm.$valid) {
            $http({
                method: 'POST',
                url: globals.path + 'api/employer/post',
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
                            window.location.href = globals.path + 'employer/post/confirm';
                        }
                    });
        } else {
            $scope.message = "There are required fields to complete";
        }
    };
});



jobPostModule.controller('PopUpController', function($scope, $http, $templateCache) {

    $scope.externalPopopen = function(popupid) {
        console.log("external Controller");
        var templateCacheId = 'example1-template';
        var html = $templateCache.get(templateCacheId);
        if (!html) {
            $http.get('jobPreview.html.php').success(function(html) {
                loadDidComplete(html);
            });
        }
        else {
            loadDidComplete(html);
        }
    };
    $scope.loadDidComplete = function(html) {
        $templateCache.put(templateCacheId, html);
        $scope.$broadcast('open_ngpopup', {id: popupid, template: templateCacheId});
    };

    $scope.internalPopOpen = function(popupid, templateId) {
        $scope.$broadcast('open_ngpopup', {id: popupid, template: templateId});
    };

});
