<?php 	
	error_reporting(E_ALL);
	require_once "config.php";
	$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER_NAME, DB_USER_PASSWORD);
	
	if (isset($_GET['id'])) {
		$id = $_GET['id'];		
		$sql = <<<SQL
UPDATE `tasks` SET `is_done`=1 WHERE `id`='$id'
SQL;
		$pdo->query($sql);	
		header("Location: index.php?msg=edit");
		die;
	}
	header("Location: index.php");	
	die;
	