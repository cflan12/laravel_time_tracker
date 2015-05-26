//Define the application module, timeTracker, add dependencies

(function() {

	'use strict';

	var timeTracker = angular
						.module('timeTracker', [
								'ngResource',
								'ui.bootstrap',
								'ui.utils',
								'ngRoute',
								'ui.router'
							]);

		//configure our routes
		timeTracker.config(function($routeProvider) {
			$routeProvider

			.when('/', {
				templateUrl : 'templates/home.html',
				//controller : 'TimeEntry'
			})

			//route for employees
			.when('/employees', {
				templateUrl : 'templates/employees.html',
				//controller : 'TimeEntry'
			})

			//route for status
			.when('/status', {
				templateUrl : 'templates/status.html',
				//controller : 'TimeEntry'
			})

			.when('/admin', {
				templateUrl : 'templates/admin.html',
				//controller : 'TimeEntry'
			});
		});
		
		//configure nested view with ui-router
		timeTracker.config(function($stateProvider) {

			$stateProvider

			//nested shift views
			.state("shift", {
				templateUrl: 'templates/partials/admin/shift.html'
			})

		});

		//$http interceptor
		timeTracker.factory('myInterceptor', ['$log', function($log) {
			$log.debug('$log myInterceptor in app module');

			var myInterceptor = {
				//var interceptor = saveHours(data);

			};

			return myInterceptor;

		}]);
		
		//http interceptor for API request
		timeTracker.config(['$httpProvider', function($httpProvider) {
			$httpProvider.interceptors.push('myInterceptor');
		}]);

		//function for bootstrap collapsed menu
		function NavBarCtrl($scope) {
			$scope.isCollapsed = true;
		}

})();