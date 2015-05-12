//abstract code, ngResource pieces, fetch the data

(function() {

	'use strict';

	angular
		.module('timeTracker')
		.factory('time', time);

		//named function takes ngResource as dependency and return an empty object
		function time($resource) {

			//ngResource call to our static data in a static JSON file time.json
			//use Laravel as RESTFul API for app, return results as JSON
			//switch out the call to the static file for the Restful API
			var Time = $resource('api/time/:id', {}, {
				update: {
					method: 'PUT'
				}
			});

			//method to fetch the data
			//use ngResource to make a query to the static data and return results

			function getTime() {

				var time_entries = [];
				var index, i, splice;
				//$promise.then allows us to intercep the results and modify array in real time
				return Time.query().$promise.then(function(results) {
					angular.forEach(results, function(result) {
						//Add the loggedTime property which calls
						//getTimeDiff to give us duration object result
						//pass in start and end times found DB
						//Add logic to call function when user has Clocked In and Clocked Out 
						//add logic for query day
						
						//angular.forEach can submit each element to array instead of for loop
						//array.push()
						//Client side current data check
						//var format = moment(result.start_time).format('MMMM Do YYYY');
						

						//Insert into array 
						time_entries.push(result);
						//console.log(time_entries);

						//appends logTime to object
						//result.logTime = getTimeDiff(start_time, end_time);
							
					}); // angular.forEach closed
					//sends data back to TimeEntry controller
					
					//result.loggedTime = getTimeDiff(start_time, end_time);
					var shift_length = [];
					var length = time_entries.length;

					for(index = 0; index < time_entries.length; ++index)
					{	
						//return time_entries with user object for user_id
						var employee = time_entries[index].comment;
						//console.log(employee);
						if(employee == 'Clock In' || employee == 'Clock Out') {
							shift_length.push(time_entries[index]);
						}
					}
					console.log("time entries length:");
					console.log(length);
					console.log("shift_entries length:");
					console.log(shift_length.length);
					for(index = 0; index < shift_length.length; ++index)
					{
						var time;
						var start_time, end_time;
						var employee, employee_id, employee_clockout, loggedTime;

						employee = shift_length[index];
						employee_id = shift_length[index].user.id;
						start_time = shift_length[index].start_time;

						//check for double counting of clock in and clock out for same user
						console.log("shift_length object:");
						console.log(shift_length[index]);
	
							for(i = 1; i < shift_length.length; ++i)
							{
								if(shift_length[i].user.id == employee_id);
								{	
									//console.log(employee_id);
									employee_clockout = shift_length[i];
				
									end_time = employee_clockout.start_time;
									//console.log(end_time);

									
									loggedTime = getTimeDiff(start_time, end_time);


									//returned duration object
									console.log("duration:");
									console.log(loggedTime);

									//appends to time entry object, but needs concise first parameter
									//foreach through time_entries or shift_length

									angular.forEach(shift_length, function(result) {

										result.loggedTime = getTimeDiff(start_time, end_time);
									});

									//remove shift_length array element after getTimeDiff
									//to prevent two calls for Clock In and Clock Out elements
									splice = shift_length.indexOf("employee");
									shift_length.splice(splice, 1);

								}
							}
							//calculate time difference from time_entries and shift_length
					}
					console.log("shift_length array returned:");
					console.log(shift_length);
					return results;
					return shift_length;
				}, function(error) {
					console.log(error);
				});
			}



			//Use Moment.js to get the duration of the time entry
			function getTimeDiff(start, end) {
				//total time in milliseconds
				var diff = moment(end).diff(moment(start));
				//object of total time spent on task
				var duration = moment.duration(diff);
				//return duration key equal to duration just derived
				//send duration key back to method for API POST to DB for each day work hours
				return {
					duration: duration
				}
			}

			//Add up the total time for all of our time entries
			//takes time entries array
			function getTotalTime(timeentries) {
				var totalMilliseconds = 0;
				//angular loop, adds all milliseconds
				//return object keys for hours and minutes
				angular.forEach(timeentries, function(key) {
					totalMilliseconds += key.loggedTime.duration._milliseconds;
				});

				//After 24 hours, the Moment.js duration object
				//reports the next unit up, which is days.
				//Using the asHours method and rounding down with
				//Math.floor instead gives us the total hours
				return {
					//use asHours method from Moment.js for hours unit
					//use Math.floor to round down and minutes method
					hours: Math.floor(moment.duration(totalMilliseconds).asHours()),
					minutes: moment.duration(totalMilliseconds).minutes()
				}
			}

			//Grab data passed from the view and send
			//a POST request to the API to save the data
			function saveTime(data) {

				return Time.save(data).$promise.then(function(success) {
					console.log(success);
				}, function(error) {
					console.log(error);
				});
			}

			function updateTime(data) {
				return Time.update({id:data.id}, data).$promise.then(function(success) {
					console.log(success);
				}, function(error) {
					console.log(error);
				});
			}

			// Send a DELETE request for a specific time entry
			function deleteTime(id) {
				return Time.delete({id:id}).$promise.then(function(success) {
					console.log(success);
				}, function(error) {
					console.log(error);
				});
			}

			//object that time service returns includes the method
			return {
				getTime: getTime,
				getTimeDiff: getTimeDiff,
				getTotalTime: getTotalTime,
				saveTime: saveTime,
				updateTime: updateTime,
				deleteTime: deleteTime
			}
		}

})();