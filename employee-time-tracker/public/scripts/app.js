//Define the application module, timeTracker, add dependencies

(function() {

	'use strict';

	var timeTracker = angular
						.module('timeTracker', [
								'ngResource',
								'ui.bootstrap',
								'ui.utils',
								'ngRoute'
							]);

		//configure our routes
		timeTracker.config(function($routeProvider) {
			$routeProvider

			//route for test page
			.when('/testRoute', {
				templateUrl : 'templates/test.html',
				controller : 'TimeEntry'
			})

			//route for employees
			.when('/employees', {
				templateUrl : 'templates/employees.html',
				controller : 'controllers/TimeEntry'
			})

			//route for status
			.when('/status', {
				templateUrl : 'templates/status.html',
				controller : 'controllers/TimeEntry'
			})

			.when('/admin', {
				templateUrl : 'templates/admin.html',
				controller : 'controllers/TimeEntry'
			});
		});


		//function for bootstrap collapsed menu
		function NavBarCtrl($scope) {
			$scope.isCollapsed = true;
		}

})();