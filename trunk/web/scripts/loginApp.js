// define custom submit directive
var rcSubmitDirective = {
    'rcSubmit': ['$parse', function ($parse) {
        return {
            restrict: 'A',
            require: ['rcSubmit', '?form'],
            controller: ['$scope', function ($scope) {
                this.attempted = false;
                
                var formController = null;
                
                this.setAttempted = function() {
                    this.attempted = true;
                };
                
                this.setFormController = function(controller) {
                  formController = controller;
                };
                
                this.needsAttention = function (fieldModelController) {
                    if (!formController) return false;
                    
                    if (fieldModelController) {
                        return fieldModelController.$invalid && (fieldModelController.$dirty || this.attempted);
                    } else {
                        return formController && formController.$invalid && (formController.$dirty || this.attempted);
                    }
                };
            }],
            compile: function(cElement, cAttributes, transclude) {
                return {
                    pre: function(scope, formElement, attributes, controllers) {
                      
                        var submitController = controllers[0];
                        var formController = (controllers.length > 1) ? controllers[1] : null;
                        
                        submitController.setFormController(formController);
                        
                        scope.rc = scope.rc || {};
                        scope.rc[attributes.name] = submitController;
                    },
                    post: function(scope, formElement, attributes, controllers) {
                      
                        var submitController = controllers[0];
                        var formController = (controllers.length > 1) ? controllers[1] : null;
                        var fn = $parse(attributes.rcSubmit);
                        
                        formElement.bind('submit', function () {
                            submitController.setAttempted();
                            if (!scope.$$phase) scope.$apply();
                            
                            if (!formController.$valid) return false;
                    
                            scope.$apply(function() {
                                fn(scope, {$event:event});
                            });
                        });
                    }
              };
            }
        };
    }]
};




// define controller for login
var LoginController = ['$scope',
function ($scope) {
 
    $scope.session = {};
 
    $scope.login = function () {
        // process $scope.session
        alert('logged in!');
    };
    $scope.login();
}];


// create a module to make it easier to include in the app module
angular.module('rcForm', [])
.directive(rcSubmitDirective);

// define module for app
angular.module('LoginApp', ['rcForm']);