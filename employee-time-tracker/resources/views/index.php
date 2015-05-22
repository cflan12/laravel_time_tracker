
<!doctype html>
<html>
	<head>
		<title>Time Tracker</title>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.css">
	</head>

	<body ng-app="timeTracker" ng-controller="TimeEntry as vm">

		<!--<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">Time Tracker</a>
				</div>
			</div> -->
			
			<!-- New navbar with collapse menu with ui.boostrap -->
		<nav class="navbar navbar-default">
  			<div class="container-fluid">
    	<!-- Brand and toggle get grouped for better mobile display -->
    			<div class="navbar-header">
      				<button type="button" class="navbar-toggle collapsed" ng-click="isCollapsed = !isCollapsed">
        				<span class="sr-only">Toggle navigation</span>
        				<span class="icon-bar"></span>
        				<span class="icon-bar"></span>
        				<span class="icon-bar"></span>
      				</button>
      				<a class="navbar-brand" href="#">Time Tracker</a>
    			</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
    			<div class="collapse navbar-collapse" collapse="isCollapsed">
      				<ul class="nav navbar-nav navbar-right">
      					<li><a href="#testRoute">Test</a></li>
        				<li><a href="#">Employees</a></li>
        				<li><a href="#">Status</a></li>
        				<li><a href="#">Admin</a></li>
      				</ul>
    			</div><!-- /.navbar-collapse -->
  			</div><!-- /.container-fluid -->
		</nav>

		<!--Content injection from routes -->
		<div class="container">
			<div class="row">
				<h1>View injection</h1>
			<div ng-view></div>
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

			<div class="container-fluid time-entry">
				<!-- UI Bootstrap timepicker with default parameters -->
				<div class="timepicker">
					<span class="timepicker-title label label-primary">Time</span>
					<timepicker ng-model="vm.clockIn" hour-step="1" minute-step="1" show-meridian="true">
					</timepicker>
				</div>
				<!-- UI Bootstrap timepicker with default parameters -->
				<!-- <div class="timepicker">
					<span class="timepicker-title label label-primary">Clock Out</span>
					<timepicker ng-model="vm.clockOut" hour-step="1" minute-step="1" show-meridian="true">
					</timepicker>
				</div> -->
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
		</nav>
		
	
		<div class="container">
			<div class="col-sm-8">
				<!-- using ng.repeat to display time entries -->
				<div class="well vm" ng-repeat="time in vm.timeentries.results">
					<div class="row">
						<div class="col-sm-8">
							<h4><i class="glyphicon glyphicon-user"></i>
							{{time.user.first_name}} {{time.user.last_name}}</h4>
							<h4><i class="glyphicon glyphicon-pencil"></i> {{time.comment}}</h4>
							<h4><span class="label label-primary"> {{time.start_time}}</span></h4>
						</div>
						
						<!-- Display for date and time, when calling getTimeDiff
						<div class="col-sm-4 time-numbers">
							<h4><i class="glyphicon glyphicon-calendar"></i>
							{{time.end_time | date:'MM dd, yyyy'}}</h4>
							<h2>
							<! added logic to display minutues and hours, pluralize hours >
								<span class="label label-primary" 
									ng-show="time.loggedTime.duration._data.hours > 0">{{time.loggedTime.duration._data.hours}} hour<span ng-show="time.loggedTime.duration._data.hours > 1">s</span>
								</span></h2>
							<h4><span class="label label-default">
							{{time.loggedTime.duration._data.minutes}} minutes</span></h4>
						</div> -->
						 

						</div>
						<div class="row">
							<div class="col-sm-3">
								<button class="btn btn-primary btn-xs" ng-click="showEditDialog = true">Edit</button>
								<!-- time in vm.timeentries passed as parameter -->
								<button class="btn btn-danger btn-xs" ng-click="vm.deleteTimeEntry(time)">Delete</button>
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
								</div>
							</div>
					</div>
				</div>

			</div> 

			<div class="col-sm-4">
				<div class="well time-numbers">
					<h1>Employee Status</h1>
					<div class="user" ng-repeat="user in vm.userStatus | unique:'user.id'">
					<h1><i class="glyphicon glyphicon-user"></i> {{user.user.first_name}} {{user.user.last_name}}</h1>
					<!--<h1><span class="label label-primary">Employee: {{user.user.first_name}} {{user.user.last_name}}</span></h1> -->
					<h3><span class="label label-default">Status: {{user.status}}</span></h3>
					<!--Add logic for chat -->
					<h5><span class="label label-default">Chat</span></h5>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="well time-numbers">
					<h1><i class="glyphicon glyphicon-time"></i> Total Time</h1>
					<h1><span class="label label-primary">{{vm.totalTime.hours}} hours</span></h1>
					<h3><span class="label label-default">{{vm.totalTime.minutes}} minutes</span></h3>
				</div>
			</div>
		</div>
	</body>

	<!-- Application Dependencies -->
    <script type="text/javascript" src="bower_components/angular/angular.js"></script>
    <script type="text/javascript" src="bower_components/angular-bootstrap/ui-bootstrap-tpls.js"></script>
    <script type="text/javascript" src="bower_components/angular-resource/angular-resource.js"></script>
    <script type="text/javascript" src="bower_components/moment/moment.js"></script>
    <script type="text/javascript" src="bower_components/angular-ui-utils/ui-utils.js"></script>
    <script type="text/javascript" src="bower_components/angular-route/angular-route.js"></script>
    <script type="text/javascript" src="bower_components/angualr-ui-router/release/angular-ui-router.min.js"></script>

    <!-- Application Scripts -->
    <script type="text/javascript" src="scripts/app.js"></script>
    <script type="text/javascript" src="scripts/controllers/TimeEntry.js"></script>
    <script type="text/javascript" src="scripts/services/time.js"></script>
    <script type="text/javascript" src="scripts/services/user.js"></script>
    <script type="text/javascript" src="scripts/services/comment.js"></script>
</html>