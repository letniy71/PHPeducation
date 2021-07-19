<?php
require_once 'catalog.php';
class Authors extends Catalog {

	public function insert($name,$surname,$patronymic){

		$sql = "INSERT INTO authors(surname,name,patronymic) VALUES (:surname,:name,:patronymic)";

		$prepare = $this->pdo->prepare($sql);
		$prepare->execute(['surname'=>$surname, 'name'=>$name, 'patronymic'=>$patronymic]);
	}

	public function edit($id,$name,$surname,$patronymic){
		$sql = "UPDATE authors SET surname = :surname, name = :name, 'patronymic' = :patronymic WHERE id = :id";

		$prepare = $this->pdo->prepare($sql);
		$prepare->execute(['surname'=>$surname, 'name'=>$name, 'patronymic'=>$patronymic, 'id' = $id]);
	}

}