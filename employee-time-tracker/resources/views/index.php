
<!doctype html>
<html>
	<head>
		<title>Time Tracker</title>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.css">
	</head>

	<body ng-app="timeTracker" ng-controller="TimeEntry as vm">

		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="/">Team Status</a>
					<a class="navbar-brand" href="/admin">Admin</a>
					<a class="navbar-brand" href="/management">Management</a>
				</div>
			</div>
		</nav>
			
			<div class="container-fluid time-entry">
				<!-- UI Bootstrap timepicker with default parameters -->
				<div class="timepicker">
					<span class="timepicker-title label label-primary">Status</span>
					<timepicker ng-model="vm.clockIn" hour-step="1" minute-step="1" show-meridian="true">
					</timepicker>
				</div>
				<!-- UI Bootstrap timepicker with default parameters -->
				
				<!-- using vm as View Model alias from controller as syntax, can use any alias -->
				<div class="time-entry-comment">
					<form class="navbar-form">
						<select name="user" class="form-control" ng-model="vm.timeEntryUser" ng-options="user.first_name + ' ' + user.last_name for user in vm.users">
							<option value="">-- Select Employee --</option>
						</select>
						<select name="comment" class="form-control" ng-model="vm.timeEntryComment" ng-options="comment.comment for comment in vm.comments">
							<option value="">-- Select Comment --</option>
						</select>
						<!-- logNewTime method -->
						<button class="btn btn-primary" ng-click="vm.logNewTime()">Log Time</button>
					</form>
				</div>
			</div>
		
	
		<div class="container">
			<div class="col-sm-8">
				<!-- using ng.repeat to display time entries -->
				<div class="well vm" ng-repeat="time in vm.timeentries">
					<div class="row">
						<div class="col-sm-8">
							<h4><i class="glyphicon glyphicon-user"></i>
							{{time.user.first_name}} {{time.user.last_name}}</h4>
							<p><i class="glyphicon glyphicon-pencil"></i> {{time.comment}}</p>
							
							<!-- Add switch statement for active users -->
							<p>Chat</p>

							<!-- save as variable names -->
							<p>{{time.start_time}}</p>
						</div>

							</div>
					</div>
				</div>

			</div> 
			
		</div>
	</body>

	<!-- Application Dependencies -->
    <script type="text/javascript" src="bower_components/angular/angular.js"></script>
    <script type="text/javascript" src="bower_components/angular-bootstrap/ui-bootstrap-tpls.js"></script>
    <script type="text/javascript" src="bower_components/angular-resource/angular-resource.js"></script>
    <script type="text/javascript" src="bower_components/moment/moment.js"></script>

    <!-- Application Scripts -->
    <script type="text/javascript" src="scripts/app.js"></script>
    <script type="text/javascript" src="scripts/controllers/TimeEntry.js"></script>
    <script type="text/javascript" src="scripts/services/time.js"></script>
    <script type="text/javascript" src="scripts/services/user.js"></script>
    <script type="text/javascript" src="scripts/services/comment.js"></script>
</html>