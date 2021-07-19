<?php
	require_once 'dbconfig.php';
	error_reporting(E_ALL);
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	ini_set('display_errors', 'on');

	$query = $pdo->query('SELECT * FROM authors');
	$data = $query->fetchAll(); // возвращает массив содержащий строки
	$result = '';
	// Разбиваем по строкам
	foreach($data as $row){
		$result .= '<tbody><tr>';
		$result .= '<td>' . $row['surname'] . '</td>';
		$result .= '<td>' . $row['name'] . '</td>';
		$result .= '<td>' . $row['patronymic'] . '</td>';
		$result .= '<td>
				<form method="POST" action="">
					<input type="hidden" name="delete" value="' . $row['id'] . '">
					<input type="submit" value="Удалить">
				</form>
			</td>';
		$result .= '</tr></tbody>';
	}


	// Добавление
	if(!empty($_POST['surname']) && !empty($_POST['name'])){
		$surname = $_POST['surname'];
		$name = $_POST['name'];
		$patronymic = $_POST['patronymic'];

		$sql = "INSERT INTO authors(surname,name,patronymic) VALUES (:surname,:name,:patronymic)";

		$prepare = $pdo->prepare($sql);
		$prepare->execute(['surname'=>$surname, 'name'=>$name, 'patronymic'=>$patronymic]);

		header("Location:/");
	}

	//Удаление

	if(!empty($_POST['delete'])){
		$id = $_POST['delete'];
		$sql = "DELETE FROM authors WHERE id = :id";
		$prepare = $pdo->prepare($sql);
		$prepare->execute(['id'=>$id]);

		header("Location: /");
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Авторы</title>

</head>
<body>
	<table>
		<tr>
			<th>Фамилия</th>
			<th>Имя</th>
			<th>Отчество</th>
			<th>Удалить</th>
		</tr>
			<?=$result;?>
	</table>

	<form method="POST" action=''>
		<span>Фамилия</span><br>
		<input type="text" name="surname"><br>
		<span>Имя</span><br>
		<input type="text" name="name"><br>
		<span>Отчество</span><br>
		<input type="text" name="patronymic"><br>
		<input type="submit" name="submit">
	</form>
</body>
</html>