'use strict';

var resumePostModule = angular.module('postResume', ['angularFileUpload']);

resumePostModule.controller('PostResumeController', function($scope, $http) {

    $scope.job = {};
    //angular.module('myApp', ['angularFileUpload']);
       
    $scope.submitResume = function() {
        
        $http({
            method: 'POST',
            url: globals.path + 'api/resume/post',
            data: $.param($scope.resume), /* pass in data as strings*/
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
                //window.location.href = globals.path + 'employer/post/confirm';
            }
        });
    };
});
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
