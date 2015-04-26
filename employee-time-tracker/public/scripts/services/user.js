
(function() {

	'use strict';

	angular
		.module('timeTracker')
		.factory('user', user);

		function user($resource) {

			//ngResource call to the API for users
			var User = $resource('api/users/:id', {}, {
				update: {
					method: 'PUT'
				}
			});

			//query the users and return the results
			function getUsers() {
				return User.query().$promise.then(function(results) {
					return results;
				}, function(error) {
					console.log(error);
				});
			}

			// Grab data passed from view to send
			// POST request to the API to save the data
			function saveUser(data) {

				return User.save(data).$promise.then(function(success) {
					console.log(success);
				}, function(error) {
					console.log(error);
				});
			}

			// Send delete data from view to 
			// DELETE request on API controller
			function deleteUser(id) {

				return User.delete({id:id}).$promise.then(function(success) {
					console.log(success);
				}, function(error) {
					console.log(error);
				});
			}

			return {
				getUsers: getUsers,
				saveUser: saveUser,
				deleteUser: deleteUser
			}
		}
})();