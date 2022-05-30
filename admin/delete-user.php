<?php
include_once "../includes/connect.php"; $conn_pdo = PDOPgSQL();

if (isset($_POST['delete_id'])) {
	$deleteUser = $conn_pdo->prepare("DELETE FROM users WHERE id = :id");
	$result = $deleteUser->execute([
		":id" => $_POST['delete_id']
	]);
}
