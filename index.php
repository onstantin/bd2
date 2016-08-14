<?php 	
	session_start();
	error_reporting(E_ALL);
	require_once "config.php";
	require_once "functions.php";
	
	$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER_NAME, DB_USER_PASSWORD);
	
	if (isset($_POST['sort'])) {
		$_SESSION['sort'] = $_POST['sort'];
		$order = $_SESSION['sort'];
	}
	else if (isset($_SESSION['sort'])) {
		$order = $_SESSION['sort'];
	}
	else {
		$order = "date_added";
	}
	
	if ($order=="is_done") {
		$selected = array("", "", "selected");
	} 
	else if ($order=="description") {
		$selected = array("", "selected", "");
	}
	else {
		$selected = array("selected", "", "");
	}

	$sql = <<<SQL
SELECT `id`, `description`, `date_added`, `is_done` FROM `tasks` ORDER BY $order ASC
SQL;

?>

<!DOCTYPE html>
<html>
<head>
	<title>Список дел</title>
	<meta charset="utf-8">
	<link type="text/css" href="style.css" rel="stylesheet" charset="utf-8"> 
</head>
<body> 
	<h1>Список дел</h1>
	
<?php	
	if (isset($_GET['msg'])) {
		echo postMsg($_GET['msg']);
	} 
	else {
		echo postMsg();
	}	
?>
	
	<form action="add.php" method="post">
		<input type="text" name="description" placeholder="Напишите задачу" required>
		<button>Добавить задачу</button>
	</form>
	<form action="" method="post">
		<select name="sort">
            <option value="date_added" <?= $selected['0'] ?> >Дате создания</option>
            <option value="description" <?= $selected['1'] ?> >Описанию</option>				
            <option value="is_done" <?= $selected['2'] ?> >Статусу</option>
		</select>
		<button>Отсортировать</button>
	</form>	
	<table>	
	<tr><th>Задача</th><th>Дата</th><th>Статус</th><th>Действия</th></tr>
<?php	
	foreach ($pdo->query($sql) as $row) 
	{
		$id = $row['id'];
		$date = $row['date_added'];
		$description = $row['description'];
		
		if ($row['is_done']==1) {
			$is_done = "<span>Выполнено</span>";
		} 
		else {
			$is_done = isDoneLink($id);
		}
		
		if (isset($_GET['edit']) && $_GET['edit']==$row['id']) {
			$task = editForm($id, $description);
			$edit = "<span>Изменить</span>";
		} 
		else {
			$task = $description;
			$edit = editLink($id);
		}
?>
		<tr>
			<td><?= $task ?></td>
			<td><?= $date ?></td>
			<td><?= $is_done ?></td>
			<td><?= $edit ?> <?= delLink($id) ?></td>
		</tr>
<?php	}	?>	
	</table>
</body> 	
</html>