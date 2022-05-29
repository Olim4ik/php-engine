<?php
session_start();

//mysql_connect("", "root", "root");
//mysql_select_db("engine.com");

function PDOPgSQL()
{
	static $db_conn;
	try {
		$host = 'localhost';
		$db_name = 'engine.com';
		$db_username = 'root';
		$db_password = 'root';
		$dsn = "mysql:host=$host;dbname=$db_name";
		$db_conn = new PDO($dsn, $db_username, $db_password);
	} catch (PDOException $e) {
		echo "Error!: " . $e->getMessage() . "<br>";
	}
	return $db_conn;
}
$conn_pdo = PDOPgSQL();



//$servername = "localhost";
//$username = "gippobab_user";
//$password = "4E]JLn#4ykp66D";
//$dbname = "gippobab_test";
//$conn = mysqli_connect($servername, $username, $password, $dbname);
//if (!$conn) {
//	die("Connection failed:" . mysqli_connect_error());
//} else {
//	echo "SuccessFull";
//}

//$stepUpdate = "UPDATE step SET step_2 = 5 WHERE chat_id = " . $chat_id;
//$resultStep = $conn->query($stepUpdate);
//
//$selectProfession = "SELECT * FROM professions WHERE status = 1";
//$resultProfession = $conn->query($selectProfession);