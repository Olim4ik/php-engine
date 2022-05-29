<?php include_once "includes/connect.php";
$conn_pdo = PDOPgSQL();
if ($_GET['exit'] == 1) {
    session_destroy();
    header("Location: login.php");
}
if (isset($_POST['password'])) {
	$_POST['password'] = md5($_POST['password']);
	$selectUser = $conn_pdo->prepare("SELECT `id` FROM users WHERE email = :email AND password = :password");
	$result = $selectUser->execute([
		":email" => $_POST['email'],
		":password" => $_POST['password']
	]);
	$rows = $selectUser->fetchAll(PDO::FETCH_ASSOC);
	$num_rows = count($rows);
	if ($num_rows > 0) {
		$_SESSION['email'] = $_POST['email'];
		$_SESSION['user_id'] = $rows[0]['id'];
		$success = "You have successfully registered! <a href='index.php'>You can go to the main page</a>";
	} else {
		$error = "Email or password is incorrect";
	}
}

?>
<?php include_once "includes/header.php"?>
<?php include_once "includes/menu.php"?>

<div class="d-flex justify-content-center">
    <div class="col-lg-4" style="margin-top: 100px;    ">
        <h2>Login Form</h2>
	    <?php if (isset($error)) { echo "<div class='alert alert-danger'><strong>Error! </strong> $error</div>"; } ?>
	    <?php if (isset($success)) { echo "<div class='alert alert-success'><strong>Great! </strong> $success</div>"; } ?>
        <form class="form-check" action="" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="email" value="<?= $_POST['email'] ?>" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="something@gmail.com">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" required class="form-control" id="exampleInputPassword1" placeholder="your password">
            </div>
            <button type="submit" class="btn btn-primary">Enter</button>
        </form>
        <p style=" margin-top: 10px; font-size: 14px;">First time here? <a href="registration.php">Register.</a></p>

    </div>
</div>

<?php include_once "includes/footer.php"?>
