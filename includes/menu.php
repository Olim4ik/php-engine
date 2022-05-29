<?php
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if (strpos($actual_link, "registration.php") > 0) {
        $active['registration'] = 'active';
    } elseif (strpos($actual_link, "login.php") > 0) {
        $active['login'] = 'active';
    } elseif (strpos($actual_link, "cabinet.php") > 0) {
        $active['cabinet'] = 'active';
    } elseif (strpos($actual_link, "/") > 0) {
	    $active['index'] = 'active';
    }
//?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="padding: 10px 20px">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="/">Engine</a>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
	        <?php if (isset($_SESSION['email'])): ?>
                <li class="nav-item <?= $active['index'] ?>">
                    <a class="nav-link " href="/">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item <?= $active['cabinet'] ?>">
                    <a class="nav-link " href="/cabinet.php">Cabinet <span class="sr-only">(current)</span></a>
                </li>
	        <?php else: ?>
                <li class="nav-item active">
                    <a class="nav-link " href="/">Home <span class="sr-only">(current)</span></a>
                </li>
	        <?php endif; ?>
        </ul>
        <ul class="form-inline my-2 my-lg-0">
            <?php if (isset($_SESSION['email'])): ?>
<!--                <li class="nav-item active"><a href="/cabinet.php" class="btn btn-light" style="margin-right: 20px;"><span class=""></span>Personal Settings</a></li>-->
                <li class="nav-item <?= $active['login'] ?>"><a href="/login.php?exit=1" class="btn btn-primary"><span class=""></span>Logout</a></li>
            <?php else: ?>
                <li class="nav-item <?= $active['registration'] ?>"><a href="../registration.php" class="btn btn-secondary" style="margin-right: 20px;"><span class=""></span>Sign Up</a></li>
                <li class="nav-item <?= $active['login'] ?>"><a href="../login.php" class="btn btn-primary"><span class=""></span>Login</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
