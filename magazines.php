<?php
	require_once 'dbconfig.php';
	error_reporting(E_ALL);
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	ini_set('display_errors', 'on');


	$query = $pdo->query('SELECT * FROM magazines');
	$data = $query->fetchAll(); // возвращает массив содержащий строки

	// Разбиваем по строкам'
	$result = '';
	foreach($data as $row){
		$result .= '<tbody><tr>';
		$result .= '<td>' . $row['name'] . '</td>';
		$result .= '<td>' . $row['description'] . '</td>';
		$result .= '<td><img style="width: 10%;" src="' . $row['img'] . '"></td>';
		$result .= '<td>' . $row['date'] . '</td>';
		$result .= '<td>
				<form method="POST" action="">
					<input type="hidden" name="delete" value="' . $row['id'] . '">
					<input type="submit" value="Удалить">
				</form>
			</td>';
		$result .= '</tr></tbody>';
	}






	// Добавление
	if(!empty($_POST['name']) && !empty($_POST['description'])){
		$name = $_POST['name'];
		$description = $_POST['description'];
		$date = $_POST['date'];

			$img = '/img/'.basename($_FILES['uploadfile']['name']);
			// Копируем файл из каталога для временного хранения файлов:
			copy($_FILES['uploadfile']['tmp_name'], $img);		
	

		$sql = "INSERT INTO magazines(name,description,img,date) VALUES (:name,:description,:img,:date)";

		$prepare = $pdo->prepare($sql);
		$prepare->execute(['name'=>$name, 'description'=>$description, 'img' => $img, 'date'=>$date]);

		header("Location:/magazines.php");
	}

	//Удаление

	if(!empty($_POST['delete'])){
		$id = $_POST['delete'];
		$sql = "DELETE FROM magazines WHERE id = :id";
		$prepare = $pdo->prepare($sql);
		$prepare->execute(['id'=>$id]);

		header("Location: /magazines.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Журналы</title>

</head>
<body>
	<table>
		<tr>
			<th>Название</th>
			<th>Описание</th>
			<th>Картинка</th>
			<th>Дата</th>
			<th>Удалить</th>
		</tr>
			<?=$result;?>
	</table>

	<form enctype="multipart/form-data" method="POST" action=''>
		<span>Название</span><br>
		<input type="text" name="name"><br>
		<span>Описание</span><br>
		<input type="text" name="description"><br>
		<span>Картинка</span><br>
		<input type="hidden" name="MAX_FILE_SIZE" value="30000" />
		<input type=file name=uploadfile><br>
		<input type="hidden" name="date" value="<?=date('Y-m-d')?>">
		<input type="submit" name="submit">
	</form>
	<a href="/">Назад</a>
</body>
</html>