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
						
						time_entries.push(result);
						
							
					}); 

					var shift_length = [];
					var length = time_entries.length;
					var shiftLength = [];
					var clockIn = [];
					var clockOut = [];
					var shiftTime = [];
					var st, et;
					var addTime;
					var userTime = [];


					//array for status and time calculation
					angular.forEach(time_entries, function(result) {
						if(result.comment == 'Clock In' || result.comment == 'Clock Out')
							return shiftLength.push(result);
					});

					angular.forEach(shiftLength, function(result) {
						if(result.comment == 'Clock In') {
							return clockIn.push(result);
						}else {
							return clockOut.push(result);
						}
					});

					angular.forEach(clockIn, function(clockIn) {
						angular.forEach(clockOut, function(clockOut) {
							if(clockIn.user.id == clockOut.user.id) {
								st = clockIn.start_time;
								et = clockOut.start_time;
								addTime = getTimeDiff(st, et);

								
								//return duration object
								shiftTime.push(addTime);
								//concatenates addTime and clockOut with shiftTime array
								userTime = angular.extend(addTime, clockOut);
							}
						});
					});

					return {
						results: results,
						//shift_length: shift_length,
						shiftTime: shiftTime
						//userTime: userTime
					}
					//return results;
					//return shift_length;
				 },function(error) {
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
					totalMilliseconds += key.duration._milliseconds; //key.loggedTime.duration._milliseconds;
				});

				//After 24 hours, the Moment.js duration object
				//reports the next unit up, which is days.
				//Using the asHours method and rounding down with
				//Math.floor instead gives us the total hours
				//console.log(timeentries);
				return {
					//use asHours method from Moment.js for hours unit
					//use Math.floor to round down and minutes method
					hours: Math.floor(moment.duration(totalMilliseconds).asHours()),
					minutes: moment.duration(totalMilliseconds).minutes()
				}
			}

			function userStatus(timeentries) {
				angular.forEach(timeentries, function(result) {
					if(result.comment != 'Lunch' && result.comment !='Clock Out' && result.comment !='Offline' && result.comment !='Sick') {
						result.status = 'Online';
					} else {
						result.status = 'Offline';
					}
				});	
					var index;
					var length = timeentries.length - 1;
					var activeUsers = [];

					console.log(timeentries);
					//sort timeentries array by user.id 
					//var timeentriesSortedId = [];
					//timeentriesSortedId = timeentriesSortedId.sort(timeentries.user.id);
					//console.log("sorted array:");
					//console.log(timeentries_sorted_id);


					//Rewrite as angular.forEach

					for(index = length; index >= 0; --index)
					{	
						activeUsers.push(timeentries[index]);
						//if(timeentries[index] == timeentries[length]) {
						//	activeUsers.push(timeentries[index]);
						//}	else {
						//	(timeentries[index].user.id != timeentries[index + 1].user.id)
						//	activeUsers.push(timeentries[index]);
						//}
					}
					
					return activeUsers;
					
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
				userStatus: userStatus,
				saveTime: saveTime,
				updateTime: updateTime,
				deleteTime: deleteTime
			}
		}

})();