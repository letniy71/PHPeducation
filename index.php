<?php
require_once 'dbconfig.php';
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
ini_set('display_errors', 'on');


$query = $pdo->query('SELECT *, authors.name as authors_name FROM AuthorMagazine
						INNER JOIN authors ON AuthorMagazine.idAuthor = authors.id
						INNER JOIN magazines ON AuthorMagazine.idMagazine = magazines.id');
$data = $query->fetchAll(); // возвращает массив содержащий строки

$result = '';
// Разбиваем по строкам
	foreach($data as $row){
		$result .= '<tbody><tr>';
		$result .= '<td>' . $row['name'] . '</td>';
		$result .= '<td>' . $row['description'] . '</td>';
		$result .= '<td>' . $row['img'] . '</td>';
		$result .= '<td>' . $row['surname'] . ' ' . $row['authors_name'] .' ' . $row['patronymic'] .'</td>';
		$result .= '<td>' . $row['date'] . '</td>';
		$result .= '</tr></tbody>';
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Каталог</title>

</head>
<body>
	<a href="authors.php">Авторы</a>
	<a href="magazines.php">Журналы</a>
	<table>
		<tr>
			<th>Журнал</th>
			<th>Описание</th>
			<th>Картинка</th>
			<th>Автор</th>
			<th>Дата</th>
		</tr>
			<?=$result;?>
	</table>
</body>
</html>



