// define custom submit directive
var rcSubmitDirective = {
    'rcSubmit': ['$http', function ($http) {
        return {
            restrict: 'A',
            link: function(scope, formElement, attributes) {

                formElement.bind('submit', function () {
                    scope.$apply(function() {
                        //we try to submit the form
                        //setting 'attemped' to true to make the errors displayable
                        scope[attributes.name].attempted = true;
                    });
                    // if form is not valid cancel it.
                    if (!scope[attributes.name].$valid) {
                        return false;
                    }

                    //form valid, final submit
                    console.log('valid');
                    scope.$apply(function() {
                        $http({
                            method: 'POST',
                            url: globals.path + 'api/user/login',
                            data: $.param(scope.session), // pass in data as strings
                            headers: {'Content-Type': 'application/x-www-form-urlencoded'}  // set the headers so angular passing info as form data (not request payload)
                        })
                        .success(function(data) {
                            console.log(data);

                            if (!data.success) {
                                // if not successful, bind errors to error variables
                                scope.message = data.message;
                            } else {
                                // if successful, bind success message to message
                                scope.message = data.message;
                            }
                        });
                    });
                });
            }
        };
    }]
};

var shouldDisplayErrorFilter = function(){
    return function(formField, form) {
      if(!form.attempted){
        form.attempted = false;
      }
      return formField.$invalid && (formField.$dirty || form.attempted);
    };
};



// define controller for login
var LoginController = ['$scope',
function ($scope) {
 
    $scope.session = {};
 
    $scope.login = function () {
        // process $scope.session
        alert('logged in!');
    };
}];


// create a module to make it easier to include in the app module
angular.module('rcForm', [])
.directive(rcSubmitDirective)
.filter('shouldDisplayError', shouldDisplayErrorFilter);

// define module for app
angular.module('LoginApp', ['rcForm']);