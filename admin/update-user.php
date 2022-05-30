<?php
include_once "../includes/connect.php"; $conn_pdo = PDOPgSQL();

if (isset($_POST['update_id'])) {
	$selectUser = $conn_pdo->prepare("SELECT * FROM users WHERE id = :id");
	$selectUser->execute([":id" => $_POST['update_id']]);

	$response = [];
	while($row = $selectUser->fetch(PDO::FETCH_ASSOC)) {
		$response = $row;
	}
	echo  json_encode($response);
} else {
	$response['status'] = 200;
	$response['message'] = "Invalid or data not found";
}


// update query
if (isset($_POST['hidden_data'])) {

	if ($_POST['update_email'] == '') {
		$_POST['update_email'] = $_POST['email'];
	}
	if ($_POST['update_password'] == '') {

		$_POST['update_password'] = md5($_POST['update_password']);
		$updateUser = $conn_pdo->prepare("UPDATE users SET email = :email WHERE id = :id");
		$updateUser->execute([
			":email" => $_POST['update_email'],
			":id" => $_POST['hidden_data']
		]);
	} else {
		$_POST['update_password'] = md5($_POST['update_password']);
		$updateUser = $conn_pdo->prepare("UPDATE users SET email = :email, password = :password WHERE id = :id");
		$result = $updateUser->execute([
			":email" => $_POST['update_email'],
			":password" => $_POST['update_password'],
			":id" => $_POST['hidden_data']
		]);
	}



}