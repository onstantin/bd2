<?php 	
	function editForm($id, $description) {
		return <<<HTML
	<form action="edit.php?id=$id" method="post" class="editform">
		<input type="text" name="description" value="$description">
		<button>OK</button>
	</form>
HTML;
	}
	
	function editLink($id) {
		return <<<HTML
		<a href="index.php?edit=$id">Изменить</a>
HTML;
	}
	
	function delLink($id) {
		return <<<HTML
		<a href="del.php?id=$id">Удалить</a>
HTML;
	}

	function isDoneLink($id) {
		return <<<HTML
		<a href="is_done.php?id=$id">Выполнить</a>
HTML;
	}	
	
	function postMsg($msg = false) {
		switch ($msg) {
		case "add":
			return "<p class=\"add\">Задача добавлена</p>";
			break;
		case "del":
			return "<p class=\"del\">Задача удалена</p>";
			break;	
		case "edit":
			return "<p class=\"edit\">Задача изменена</p>";
			break;				
		default:
			return "";
			break;	
		}
	}
	