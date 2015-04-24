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
		function TimeEntry(time, user, $scope) {

			//vm is our capture variable, View Model
			var vm = this;

			//array will hold time entry data we grab with ngResource
			vm.timeentries = [];
			//object for totalling each time entry
			vm.totalTime = {};

			vm.users = [];

			//Initalize the clockIn and clockOut times to the current time
			vm.clockIn = moment();
			vm.clockOut = moment();

			//grab all the time entries saved in the DB
			getTimeEntries();

			//Get the users from the DB so we can select
			//who the time entry belongs to
			getUsers();

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
					updateTotalTime(vm.timeentries);
					console.log(vm.timeentries);
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
				if(vm.clockOut < vm.clockIn) {
					alert("You can't clock out before you clockin in");
					return;
				}

				//call to the saveTime method on the time service 
				//to save the new time entry to the database
				time.saveTime({
					"user_id":vm.timeEntryUser.id,
					"start_time":vm.clockIn,
					"end_time":vm.clockOut,
					"comment":vm.comment
				}).then(function(success) {
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

				var id = timeentry.id;

				time.deleteTime(id).then(function(success) {
					getTimeEntries();
					console.log(success);
				}, function(error) {
					console.log(error);
				});
			}
			
		}
})();