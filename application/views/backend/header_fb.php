<html lang="en">
<head>
	<title>PhotoStream</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="<? echo base_url();?>css/bootstrap.css" rel="stylesheet" media="all" type="text/css"/>
	<link href="<? echo base_url();?>css/style.css" rel="stylesheet" media="all" type="text/css"/>
    <link href="<? echo base_url();?>css/bootstrap-responsive.css" rel="stylesheet" media="all" type="text/css">
    
</head>

<body>

<div class="navbar navbar-fixed-top navbar-inverse">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<a class="brand" href="#"><img src="<? echo base_url();?>img/logo-home.png"/></a>
			<div class="nav-collapse">
				<ul class="nav">
					<li class=""><a href="#">Home</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Stream <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="#">Create Stream</a></li>
							<li><a href="#">View Stream</a></li>
						</ul>
					</li>
					<li><a href="#">Friends</a></li>
					<li><a href="#">Search</a></li>
					<li><a href="#">Upload <i class="icon-upload icon-white"></i></a></li>
				</ul>
				<!-- The drop down user menu -->
				<ul class="nav pull-right">
					<li class="divider-vertical"></li>
					<li class="dropdown">
					<a class="dropdown-toggle" href="#" data-toggle="dropdown">
						<? echo $user_profile['name']; ?> <strong class="caret"></strong>
					</a>
						<ul class="dropdown-menu user" style="padding: 2px 2px 3px 2px;">
							<li><a href="#">User Profile</a></li>
							<li><a href="#">User Settings</a></li>
							<li>
								<a class="btn btn-primary" href="<?php echo $logout_url ?>"> Logout </a>
							</li>
						</ul>
					</li>
				</ul>
			</div><!-- /.nav-collapse -->
		</div><!-- /.container -->
	</div><!-- /.navbar-inner -->
</div><!-- /.navbar -->
<div class="body-wrap">
	<div class="container">
		<div class="row-fluid">
			<div class="container wrap-bbg">
	