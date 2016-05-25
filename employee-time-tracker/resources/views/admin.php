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
					<a class="navbar-brand" href="#">Time Tracker</a>
				</div>
			</div>

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