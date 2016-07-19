<!doctype html>
<html>
	<head>
		<title>Time Tracker</title>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.css">
	</head>
	
	<!-- Define Controller for view -->
	<body ng-app="timeTracker" ng-controller="UserController as vm">

		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">Manage</a>
				</div>
			</div>
		</nav>

			<div class="container-fluid">
				<div class="row text-center">
					<p>Employee Hours</p>
				
			</div>
		</body>


<!-- Application Dependencies -->
    <script type="text/javascript" src="bower_components/angular/angular.js"></script>
    <script type="text/javascript" src="bower_components/angular-bootstrap/ui-bootstrap-tpls.js"></script>
    <script type="text/javascript" src="bower_components/angular-resource/angular-resource.js"></script>
    <script type="text/javascript" src="bower_components/moment/moment.js"></script>

    <!-- Application Scripts -->
    <script type="text/javascript" src="scripts/app.js"></script>
    <script type="text/javascript" src="scripts/controllers/UserController.js"></script>
    <script type="text/javascript" src="scripts/services/time.js"></script>
    <script type="text/javascript" src="scripts/services/user.js"></script>
    <script type="text/javascript" src="scripts/services/comment.js"></script>
</html>