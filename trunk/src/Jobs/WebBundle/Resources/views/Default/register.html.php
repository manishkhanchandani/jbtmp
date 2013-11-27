<!-- src/Jobs/WebBundle/Resources/views/Default/index.html.php -->
<?php $view->extend('JobsWebBundle::layout.html.php') ?>

<!-- PROCESS FORM WITH AJAX (NEW) -->
<script>

		// define angular module/app
		var formApp = angular.module('formApp', []);

		// create angular controller and pass in $scope and $http
		function formController($scope, $http) {
            // create a blank object to hold our form information
			// $scope will allow this to pass between controller and view
			$scope.formData = {};
            
            // process the form
			$scope.processForm = function() {
                $http({
                    method  : 'POST',
                    url     : 'register/complete',
                    data    : $.param($scope.formData),  // pass in data as strings
                    headers : { 'Content-Type': 'application/x-www-form-urlencoded' }  // set the headers so angular passing info as form data (not request payload)
                })
                .success(function(data) {
                    console.log(data);

                    if (!data.success) {
                        // if not successful, bind errors to error variables
                        $scope.errorName = data.errors.name;
                        $scope.errorSuperhero = data.errors.superheroAlias;
                    } else {
                        alert(data.message);
                        // if successful, bind success message to message
                        $scope.message = data.message;
                    }
                });
			};
		}

</script>
<!-- apply the module and controller to our body so angular is applied to that -->
<div ng-app="formApp" ng-controller="formController">
    <!-- SHOW ERROR/SUCCESS MESSAGES -->
	<div id="messages" ng-show="message">{{ message }}</div>
    <!-- FORM -->
	<form ng-submit="processForm()">
		<!-- NAME -->
		<div id="name-group" class="form-group" ng-class="{ 'has-error' : errorName }">
			<label>Name</label>
			<input type="text" name="name" class="form-control" placeholder="Enter Your Name" ng-model="formData.name">
			<span class="help-block" ng-show="errorName">{{ errorName }}</span>
		</div>

		<!-- SUPERHERO NAME -->
		<div id="superhero-group" class="form-group" ng-class="{ 'has-error' : errorSuperhero }">
			<label>Superhero Alias</label>
			<input type="text" name="superheroAlias" class="form-control" placeholder="Alias" ng-model="formData.superheroAlias">
			<span class="help-block" ng-show="errorSuperhero">{{ errorSuperhero }}</span>
		</div>

		<!-- SUBMIT BUTTON -->
		<button type="submit" class="btn btn-success btn-lg btn-block">
			<span class="glyphicon glyphicon-flash"></span> Submit!
		</button>
	</form>

	<!-- SHOW DATA FROM INPUTS AS THEY ARE BEING TYPED -->
	<pre>
		{{ formData }}
	</pre>
</div>