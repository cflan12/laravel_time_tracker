//Define the application module, timeTracker, add dependencies

(function() {

	'use strict';

	angular
		.module('timeTracker', [
			'ngResource',
			'ui.bootstrap',
			'ui.utils'
			]);

		//function for bootstrap collapsed menu
		function NavBarCtrl($scope) {
			$scope.isCollapsed = true;
		}
})();