<?php
	require_once 'dbconfig.php';
	require_once 'classes/authors.php';

	error_reporting(E_ALL);
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	ini_set('display_errors', 'on');

	$author = new Authors($pdo);
	$data = $author->show('authors');
	$result = '';
	// Разбиваем по строкам
	foreach($data as $row){
		$result .= '<tbody><tr>';
		$result .= '<td>' . $row['surname'] . '</td>';
		$result .= '<td>' . $row['name'] . '</td>';
		$result .= '<td>' . $row['patronymic'] . '</td>';
		$result .= '</tr></tbody>';
	}

	if(!empty($_POST['surname']) && !empty($_POST['name'])){
		$surname = $_POST['surname'];
		$name = $_POST['name'];
		$patronymic = $_POST['patronymic'];

		$author->insert($name,$surname,$patronymic);
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
