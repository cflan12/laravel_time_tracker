//declare controller TimeEntry, use capture variable vm(ViewModel)
//with time.js getTime method able to use ngResource to query the data
//TimeEntry controller needs to add the method

(function() {

	'use strict';

	angular
		.module('timeTracker')
		.controller('TimeEntry', TimeEntry);

		//named function that is passed to controller
		//time argument is a dependency we are injecting
		//references time service
		function TimeEntry(time, user, comment, $scope) {

			//vm is our capture variable, View Model
			var vm = this;

			//array will hold time entry data we grab with ngResource
			//vm.timeentries = [];
			vm.timeentires = {};
			//object for totalling each time entry
			vm.totalTime = {};

			vm.users = [];

			vm.comments = [];

			

			//Initalize the clockIn and clockOut times to the current time
			vm.clockIn = moment();
			vm.clockOut = moment();

			//grab all the time entries saved in the DB
			getTimeEntries();

			//Get the users from the DB so we can select
			//who the time entry belongs to
			getUsers();

			// Get comments for the DB for user to select
			getComments();

			function getComments() {
				comment.getComment().then(function(result) {
					vm.comments = result;
				}, function(error) {
					console.log(error);
				});
			}

			function getUsers() {
				user.getUsers().then(function(result) {
					vm.users = result;
				}, function(error) {
					console.log(error);
				});
			}

			//fetches the time entries and puts the results
			//on the vm.timeentries array
			function getTimeEntries() {
				time.getTime().then(function(results) {
					vm.timeentries = results;
					updateTotalTime(vm.timeentries.shift_length);
					console.log("vm.timeentries object:");
					console.log(vm.timeentries);
					console.log("vm.timeentires properties");
					console.log(vm.timeentries.results);
					console.log("vm.timeentires duration");
					console.log(vm.timeentries.shift_length);
					//console.log("vm.duration: ");
					//console.log(vm.duration);
				}, function(error) {
					console.log(error);
				});
			}

			//Updates the value in the total time box by calling
			// getTotalTime method on the time service
			//takes time entries array as argument and updates vm.totalTime object
			//to equal the result of the call to getTotalTime method from Time services
			//getTotalTime method from time service takes array of time entries and loops
			//through to count the total number of milliseconds. 
			function updateTotalTime(timeentries) {
				vm.totalTime = time.getTotalTime(timeentries);
			}

			//submits the time entry that will be called
			//when we click the "Log Time" button
			vm.logNewTime = function() {

				//Make sure that the clock-in time isn't
				//after the clock-out time
				//if(vm.clockOut < vm.clockIn) {
				//	alert("You can't clock out before you clockin in");
				//	return;
				//}

				//call to the saveTime method on the time service 
				//to save the new time entry to the database
				time.saveTime({
					"user_id":vm.timeEntryUser.id,
					"start_time":vm.clockIn,
					// "end_time":'2015-05-06 10:30:10',
					"comment":vm.timeEntryComment.comment
				}).then(function(success) {
					//refresh listing of time entries
					getTimeEntries();
					console.log(success);
				}, function(error) {
					console.log(error);
				});

				getTimeEntries();

				//Reset clockIn and clockOut times to the current time
				vm.clockIn = moment();
				vm.clockOut = moment();

				//Clear the comment field
				vm.comment = "";

				//Deselect the user
				vm.timeEntryUser = "";
			}

			// Function to log new employee when
			// add new employee button submits
			vm.logNewUser = function() {

				//call to saveUser method on user.js
				user.saveUser({
					"first_name":vm.first_name,
					"last_name":vm.last_name,
					"email":vm.email,
					"password":"1234"
				}).then(function(success) {
					//refresh employee list
					getUsers();
					console.log(success);
				}, function(error) {
					console.log(error);
				});

				getUsers();

				vm.first_name = "";
				vm.last_name = "";
				vm.email = "";
			}

			vm.updateTimeEntry = function(timeentry) {

				//Collect the data that will be passed to the updateTime method
				var updatedTimeEntry = {
					"id":timeentry.id,
					"user_id":timeentry.user.id,
					"start_time":timeentry.start_time,
					"end_time":timeentry.end_time,
					"comment":timeentry.comment
				}

				// Update the time entry then refresh the list
				time.updateTime(updatedTimeEntry).then(function(success) {
					getTimeEntries();
					$scope.showEditDialog = false;
					console.log(success);
				}, function(error) {
					console.log(error);
				});
			}

			//Specify the time entry to be deleted and pass it to the
			//deleteTime method on the time service
			vm.deleteTimeEntry = function(timeentry) {

				//get id number from with object notation
				var id = timeentry.id;

				time.deleteTime(id).then(function(success) {
					getTimeEntries();
					console.log(success);
				}, function(error) {
					console.log(error);
				});
			}

			// Specify the user to be deleted and pass vm.users array to
			// deleteUser method on user service
			vm.deleteUser = function(users) {

				var id = users.id;

				user.deleteUser(id).then(function(success) {
					getUsers();
					console.log(success);
				}, function(error) {
					console.log(error);
				});
			}

			// Specify use to be updated and pass vm.users array to
			// updateUser method on user service
			// Users array from initialized array in controller
			vm.updateUser = function(users) {

				var updatedUserEntry = {
					"id":users.id,
					"first_name":users.first_name,
					"last_name":users.last_name,
					"email":users.email
				}

				// Update the user entry then refresh the list
				user.updateUser(updatedUserEntry).then(function(success) {
					getUsers();
					$scope.updateUserDialog = false;
					console.log(success);
				}, function(error) {
					console.log(error);
				});

			}

			
		}


})();