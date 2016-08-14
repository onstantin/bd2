<?php 	
	error_reporting(E_ALL);
	require_once "config.php";	
	
	if (isset($_POST['description']) && isset($_POST['description'])!="") {	
		$description = htmlspecialchars($_POST['description']);		
		$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER_NAME, DB_USER_PASSWORD);
		$sql = <<<SQL
INSERT INTO `tasks` (`description`, `date_added`, `is_done`) VALUES ('$description', NOW(), 0)
SQL;
		$pdo->query($sql);		
		header("Location: index.php?msg=add");
		die;
	} 
	header("Location: index.php");	
	die;
	