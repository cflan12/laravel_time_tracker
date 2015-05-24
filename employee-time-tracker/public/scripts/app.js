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
		

		//function for bootstrap collapsed menu
		function NavBarCtrl($scope) {
			$scope.isCollapsed = true;
		}

})();