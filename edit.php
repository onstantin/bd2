<?php 	
	error_reporting(E_ALL);
	require_once "config.php";
	
	if (isset($_GET['id']) && isset($_POST['description']) && $_POST['description']!="") {
		$description = $_POST['description'];
		$id = $_GET['id'];		
		$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER_NAME, DB_USER_PASSWORD);
		$sql = <<<SQL
UPDATE `tasks` SET `description`='$description' WHERE `id`='$id'
SQL;
		$pdo->query($sql);	
		header("Location: index.php?msg=edit");
		die;
	}
	header("Location: index.php");	
	die;
	