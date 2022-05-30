<?php
include_once "../includes/connect.php"; $conn_pdo = PDOPgSQL();

extract($_POST);

if (isset($_POST['email'], $_POST['password'])) {
	if (strlen($_POST['password']) < 6) {
		$status = 'err';
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
			$status = 'err_email_exists';
		} else {
			$status = 'ok';
		}

	}
	echo $status;die;
}
