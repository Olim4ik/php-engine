<?php
require_once "includes/connect.php";
$conn_pdo = PDOPgSQL();

if (isset($_POST['email'])) {
	if (strlen($_POST['password']) < 6) {
        $error = "Password must be at least 6 characters";
    } else {
		$_POST['password'] = md5($_POST['password']);
		$insertUser = $conn_pdo->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
		$result = $insertUser->execute([
			":email" => $_POST['email'],
			":password" => $_POST['password']
		]);

		$selectUser = $conn_pdo->prepare("SELECT `id` FROM users WHERE email = :email AND password = :password");
		$result1 = $selectUser->execute([
			":email" => $_POST['email'],
			":password" => $_POST['password']
		]);
		$rows = $selectUser->fetchAll(PDO::FETCH_ASSOC);

        if ($result === false){
            $error = "Email already exists";
        } else {
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['user_id'] = $rows[0]['id'];
	        $_SESSION['role'] = $rows[0]['role'];
	        $success = "You have successfully registered! <a href='/'>You can go to the main page</a>";
        }
	}
}
?>

<?php include_once "includes/header.php" ?>
<?php include_once "includes/menu.php" ?>

<div class="d-flex justify-content-center">
    <div class="col-lg-4" style="margin-top: 100px;    ">
        <h2>Registration Form</h2>
        <?php if (isset($error)) { echo "<div class='alert alert-danger'><strong>Error! </strong> $error</div>"; } ?>
        <?php if (isset($success)) { echo "<div class='alert alert-success'><strong>Great! </strong> $success</div>"; } ?>
        <form class="form-check" action="" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="email" value="<?= $_POST['email'] ?>" required class="form-control" id="exampleInputEmail1"
                       aria-describedby="emailHelp" placeholder="something@gmail.com">
                <!--                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" required class="form-control" id="exampleInputPassword1"
                       placeholder="your password">
            </div>
            <button type="submit" class="btn btn-primary">Enter</button>
        </form>
        <p style=" margin-top: 10px; font-size: 14px;">You have already registered? <a href="login.php">Login.</a></p>
    </div>
</div>

<?php include_once "includes/footer.php" ?>
