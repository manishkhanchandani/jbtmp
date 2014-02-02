'use strict';
var _module = angular.module('resumePreview', [
  'myDirective'
]);
angular.module('myDirective', [])
	.factory('myServiceData', ['$http', function($http) {
		var dataFactory = {};
		dataFactory.getRecords = function () {
		  return $http.get(globals.base_path+'api/resume/preview?id='+pageData.id);
		};
		return dataFactory;
	}])
	.directive('myClass', function(myServiceData) {
		return {
		  restrict: 'C',
		  scope: true,
		  link: function(scope, e, a) {
			  myServiceData.getRecords()
				.success(function (returnData) {
					//console.log(returnData);
					scope.data = returnData.data;
					if (returnData.data.embedded_url) {
						//document.getElementById('myresumedata').src = returnData.data.embedded_url;
						jQuery('#myresumedata').attr('src', returnData.data.embedded_url);
					}
					//console.log(scope.data);
				})
				.error(function (error) {
					scope.status = 'Unable to load data';
				});
		  },
		  templateUrl: './preview_template'
		};
	})