<?php

	$dsn = 'mysql:host=172.17.0.5;dbname=PHP7_db;charset=utf8;';
	 try {
	$pdo = new PDO($dsn,'root','123');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
	    catch (PDOexception $e){
      echo "Невозможно установить соединение с базой данных";
    }