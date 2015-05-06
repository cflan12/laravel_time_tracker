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
				//$promise.then allows us to intercep the results and modify array in real time
				return Time.query().$promise.then(function(results) {
					angular.forEach(results, function(result) {
						//Add the loggedTime property which calls
						// getTimeDiff to give us duration object result
						//pass in start and end times found in the static data from example JSON
						result.loggedTime = getTimeDiff(result.start_time, result.end_time);
					});

					return results;
				}, function(error) {
					//check for errors
					console.log(error);
				});
			}

			//Use Moment.js to get the duration of the time entry
			//start and end parameters
			function getTimeDiff(start, end) {
				//total time in milliseconds
				var diff = moment(end).diff(moment(start));
				//object of total time spent on task
				var duration = moment.duration(diff);
				//return duration key equal to duration just derived
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