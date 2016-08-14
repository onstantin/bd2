<?php 	
	error_reporting(E_ALL);
	require_once "config.php";
	
	if (isset($_GET['id'])) {	
		$id = $_GET['id'];	
		$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER_NAME, DB_USER_PASSWORD);		
		$sql = <<<SQL
DELETE FROM `tasks` WHERE `id`='$id'
SQL;
		$pdo->query($sql);	
		header("Location: index.php?msg=del");
		die;
	} 	
	header("Location: index.php");	
	die;
	