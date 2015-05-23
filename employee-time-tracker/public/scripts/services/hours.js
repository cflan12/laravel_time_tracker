
(function() {

	'use strict';

	angular
		.module('timeTracker')
		.factory('hours', hours);

		function hours($resource) {

			var Hours = $resource('api/hours/:id', {} , {
				update: {
					method: 'PUT'
				}
			});

			function saveHours(data) {
				return Hours.save(data).$promise.then(function(success) {
					console.log(success);
				}, function(error) {
					console.log(error);
				});
			}

			return {
				saveHours: saveHours
			}

		}	
})();