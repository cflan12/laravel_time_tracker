
(function() {

	'use strict';

	angular
		.module('timeTracker')
		.controller('UserController', UserController);

		function UserController(time, user, comment, $scope) {

			var vm = this;

			vm.activeUsers = {};

			vm.activeComments = {};

			//calculate daily hours
			vm.start = moment().startOf('day');
			console.log(vm.start);
			vm.end = moment().endOf('day');
			console.log(vm.end);

			//function callstack

			calculateHours();

			console.log('active Users');
			console.log(vm.activeUsers);
			console.log('active Comments');
			console.log(vm.activeComments);

			function calculateHours() {

				//get active daily users
				user.getUsers().then(function(result) {
					vm.activeUsers = results;
				}, function(error) {
					console.log(error);
				});

				//get active daily comments
				comment.getComment().then(function(result) {
					vm.activeComments = result;
				}, function(error) {
					console.log(error);
				});
			}

		}
})();