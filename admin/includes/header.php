<?php
if ($_SESSION['user_id'] < 1) {
	header("Location: ../login.php");
}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	<title>Engine</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="padding: 10px 20px">
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<a class="navbar-brand" href="/admin/">Admin Panel</a>

	<div class="collapse navbar-collapse" id="navbarTogglerDemo03">
		<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
			<?php if (isset($_SESSION['email'])): ?>
				<li class="nav-item <?= $active['index'] ?>">
					<a class="nav-link " href="/admin/">Home <span class="sr-only">(current)</span></a>
				</li>
<!--				<li class="nav-item --><?//= $active['cabinet'] ?><!--">-->
<!--					<a class="nav-link " href="../../cabinet.php">Cabinet <span class="sr-only">(current)</span></a>-->
<!--				</li>-->
				<li class="dropdown">
					<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"> Lists <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="/admin/list-role.php">User Role</a></li>
						<li><a href="/admin/list-status.php">User Status</a></li>
					</ul>
				</li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"> Settings <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/admin/settings-user-role.php">User role Settings</a></li>
                    </ul>
                </li>
			<?php else: ?>
				<li class="nav-item active">
					<a class="nav-link " href="/admin/">Home <span class="sr-only">(current)</span></a>
				</li>
			<?php endif; ?>
		</ul>
		<ul class="form-inline my-2 my-lg-0">
			<?php if (isset($_SESSION['email'])): ?>
				<!--                <li class="nav-item active"><a href="/cabinet.php" class="btn btn-light" style="margin-right: 20px;"><span class=""></span>Personal Settings</a></li>-->
				<li class="nav-item <?= $active['login'] ?>"><a href="../../login.php?exit=1" class="btn btn-primary"><span class=""></span>Logout</a></li>
			<?php else: ?>
				<li class="nav-item <?= $active['registration'] ?>"><a href="../../registration.php" class="btn btn-secondary" style="margin-right: 20px;"><span class=""></span>Sign Up</a></li>
				<li class="nav-item <?= $active['login'] ?>"><a href="../../login.php" class="btn btn-primary"><span class=""></span>Login</a></li>
			<?php endif; ?>
		</ul>
	</div>
</nav>
