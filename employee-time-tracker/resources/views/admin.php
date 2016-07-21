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

			<div class="container-fluid">
				<div class="row text-center">
					<btn class="btn btn-primary" ng-click="showUserDialog = true">Show All Employees</btn>
				</div>
			</div>

			<div class="row text-center" ng-show="showUserDialog === true">
				<h4>Employees</h4>
				<div class="time-entry" ng-repeat="employee in vm.users">
					<!-- Loop through the users -->
					<!-- bind user as a reference to the returned object -->
					<p>{{employee.first_name}} {{employee.last_name}}</p>
					<!-- employee parameter from ng-repeat -->
					<button class="btn btn-primary btn-xs" ng-click="showUpdateDialog = true">Update</button>
					<button class="btn btn-danger btn-xs" ng-click="vm.deleteUser(employee)">Delete</button>

					<!--Update Dialog -->
					<div class="row time-entry-edit" ng-show="showUpdateDialog === true">
						<h4>Update Employee</h4>
							<form class="navbar-form">
								<input class="form-control" ng-model="employee.first_name">
								<input class="form-control" ng-model="employee.last_name">
								<input class="form-control" ng-model="employee.email">
								<button class="btn btn-primary" ng-click="vm.updateUser(employee)">Update</button>
								<button class="btn btn-danger" ng-click="showUpdateDialog = false">Close</button>
							</form>
					</div>

				</div>
					<h4>Add New Employee</h4>
						<form class="navbar-form">
							<input class="form-control" ng-model="vm.first_name" placeholder="First Name">
							<input class="form-control" ng-model="vm.last_name" placeholder="Last Name">
							<input class="form-control" ng-model="vm.email" placeholder="Email">
							<button class="btn btn-primary" ng-click="vm.logNewUser()">Add Employee</button>
						</form>
				<button class="btn btn-danger" ng-click="showUserDialog = false">Close</button> 
				
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

						<!--<div class="col-sm-4 time-numbers">
							<h4><i class="glyphicon glyphicon-calendar"></i>
							{{time.end_time | date:'MM dd, yyyy'}}</h4>
							<h2>
							<!-- added logic to display minutues and hours, pluralize hours -->
								<!--<span class="label label-primary" 
									ng-show="time.loggedTime.duration._data.hours > 0">{{time.loggedTime.duration._data.hours}} hour<span ng-show="time.loggedTime.duration._data.hours > 1">s</span>
								</span></h2>
							<h4><span class="label label-default">
							{{time.loggedTime.duration._data.minutes}} minutes</span></h4>
						</div> -->

						<!-- Edit for Admin 
						<div class="row">
							<div class="col-sm-3">
								<button class="btn btn-primary btn-xs" ng-click="showEditDialog = true">Edit</button> -->
								<!-- time in vm.timeentries passed as parameter -->
							<!-- <button class="btn btn-danger btn-xs" ng-click="vm.deleteTimeEntry(time)">Delete</button>
							</div>
						</div>

						<div class="row edit-time-entry" ng-show="showEditDialog === true">
							<h4>Edit Time Entry</h4>
							<div class="time-entry">
								<div class="timepicker">
									<span class="timepicker-title label label-primary">Clock In</span><timepicker ng-model="time.start_time" hour-step="1" minute-step="1" show-meridian="true"></timepicker>
								</div>
								<div class="timepicker">
									<span class="timepicker-title label label-primary">Clock Out</span><timepicker ng-model="time.end_time" hour-step="1" minute-step="1" show-meridian="true"></timepicker>
								</div>
							</div> 

							<div class="col-sm-6">
								<h5>User</h5>
								<select name="user" class="form-control" ng-model="time.user" ng-options="user.first_name + ' ' + user.last_name for user in vm.users track by user.id">
									<option value="user.id"></option>
								</select>

								<div class="col-sm-6">
									<h5>Comment</h5>
									<textarea ng-model="time.comment" class="form-control">{{time.comment}}</textarea>
								</div>

								<div class="edit-controls">
									<button class="btn btn-primary btn-sm" ng-click="vm.updateTimeEntry(time)">Save</button>
									<button class="btn btn-danger btn-sm"  ng-click="showEditDialog = false">Close</button>
								</div> -->
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