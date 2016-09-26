<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title><?php echo $app->index(); ?></title>
		<link rel="stylesheet" type="text/css" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
		<style>
			.navbar-right {margin-right: 0px;}
		</style>
	</head>
	<body>
		<div class="container">
			<nav class="navbar navbar-inverse" role="navigation">
				<div class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="#">
							<?php 
							if(isset($_SESSION['user'])){
								echo $_SESSION['user'];
							}else{
								echo 'LOGIN SYSTEM';
							}
							 ?>
						</a>
					</div>
					
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse navbar-ex1-collapse">
						<ul class="nav navbar-nav">
							<li class="active"><a href="index.php">HOME</a></li>
							<li><a href="#">Link</a></li>
						</ul>
						<form class="navbar-form navbar-left" role="search">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Search">
							</div>
							<button type="submit" class="btn btn-default">Submit</button>
						</form>
						<ul class="nav navbar-nav navbar-right">
							<li><a href="#">Link</a></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="#">Action</a></li>
									<li><a href="#">Another action</a></li>
									<li><a href="#">Something else here</a></li>
									<li><a href="config.php?logout">Logout</a></li>
								</ul>
							</li>
						</ul>
						</div><!-- /.navbar-collapse -->
					</div>
				</nav>