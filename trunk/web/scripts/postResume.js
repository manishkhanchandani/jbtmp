'use strict';

var resumePostModule = angular.module('postResume', []);
resumePostModule.controller('PostResumeController', function($scope, $http) {
    $scope.resume = {};
    $scope.setFiles = function(element) {
        $scope.$apply(function($scope) {
            console.log('files:', element.files);
            // Turn the FileList object into an Array
            $scope.files = "";
            $scope.files = element.files[0];
            console.log($scope.files);
            $scope.progressVisible = false;
        });
    };
    $scope.submitResume = function() {
        var fd = new FormData();
        fd.append('file', $scope.files);
        angular.forEach($scope.resume, function(value, key) {
            fd.append(key, value);
        });
        $http({
            method: 'POST',
            url: globals.path + 'api/resume/post',
            data: fd, //$.param($scope.resume), /* pass in data as strings*/
            headers: {'Content-Type': undefined}, /* set the headers so angular passing info as form data (not request payload)*/
            transformRequest: angular.identity
        })
           .success(function(data) {
            if (!data.success) {
                // if not successful, bind errors to error variables
                $scope.message = data.message;
            } else {
                // if successful, bind success message to message
                $scope.message = data.message;
                window.location.href = globals.path + 'jobseeker/preview?id='+data.id;
                //window.location.href = globals.path + 'employer/post/confirm';
            }
        });
    };
});
/*
resumePostModule.controller('MyCtrl', function($scope, $upload) {
$scope.onFileSelect = function($files) {
    //$files: an array of files selected, each file has name, size, and type.
    for (var i = 0; i < $files.length; i++) {
      var $file = $files[i];
      $upload.upload({
        url: 'my/upload/url',
        file: $file,
        progress: function(e){}
      }).then(function(data, status, headers, config) {
        // file is uploaded successfully
        console.log(data);
      }); 
    }
  };
  });
*/