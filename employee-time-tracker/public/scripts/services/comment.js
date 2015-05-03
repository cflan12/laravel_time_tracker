//abstract methods for comments data fetching and posting to API

(function() {

	'use strict';

	angular
		.module('timeTracker')
		.factory('comment', comment);

		// function takes ngResource as dependency and returns an empty object
		function comment($resource) {

			var Comment = $resource('api/comments');

			//Query the comments and return the results
			function getComment() {

				return Comment.query().$promise.then(function(results) {
					return results;
				}, function(error) {
					console.log(error);
				});
			}

			return {
				getComment: getComment
			}
		}
})();