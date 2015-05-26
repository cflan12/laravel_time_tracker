
<!doctype html>
<html ng-app="timeTracker">
	<head>
		<title>Time Tracker</title>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.css">
	</head>

	<body ng-controller="TimeEntry as vm">

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
      				<a class="navbar-brand" href="#/">Time Tracker</a>
    			</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
    			<div class="collapse navbar-collapse" collapse="isCollapsed">
      				<ul class="nav navbar-nav navbar-right">
        				<li><a href="#employees">Employees</a></li>
        				<li><a href="#status">Status</a></li>
        				<li><a href="#admin">Admin</a></li>
      				</ul>
    			</div><!-- /.navbar-collapse -->
  			</div><!-- /.container-fluid -->
		</nav>

		<!--Global div wrapper -->
		<div class="container-fluid">
			<h1>Time Tracker App</h1>
			<div ng-view></div>
		</div> <!-- end wrapper -->
	
	</body>

	<!-- Application Dependencies -->
    <script type="text/javascript" src="bower_components/angular/angular.js"></script>
    <script type="text/javascript" src="bower_components/angular-bootstrap/ui-bootstrap-tpls.js"></script>
    <script type="text/javascript" src="bower_components/angular-resource/angular-resource.js"></script>
    <script type="text/javascript" src="bower_components/moment/moment.js"></script>
    <script type="text/javascript" src="bower_components/angular-ui-utils/ui-utils.js"></script>
    <script type="text/javascript" src="bower_components/angular-route/angular-route.js"></script>
    <script type="text/javascript" src="bower_components/angular-ui-router/release/angular-ui-router.min.js"></script>

    <!-- Application Scripts -->
    <script type="text/javascript" src="scripts/app.js"></script>
    <script type="text/javascript" src="scripts/controllers/TimeEntry.js"></script>
    <script type="text/javascript" src="scripts/services/time.js"></script>
    <script type="text/javascript" src="scripts/services/user.js"></script>
    <script type="text/javascript" src="scripts/services/comment.js"></script>
    <script type="text/javascript" src="scripts/services/hours.js"></script>
    <!-- after service calls to intercept $http 
    <script type="text/javascript" src="scripts/services/request-interceptor.js"></script>
     -->
</html>