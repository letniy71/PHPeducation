<?php

 class Catalog {
	protected $pdo;
	protected $table;

	public function __construct($pdo){
		$this->pdo = $pdo;
	}

	public function show($table){
		$this->table = $table;
		$query = $this->pdo->query("SELECT * FROM $this->table");
		return $query->fetchAll(); // возвращает массив содержащий строки
	}

	public function delete($id){
		$sql = "DELETE FROM $this->table WHERE id=?";
		$prepare = $this->pdo->prepare($sql);
		$prepare->execute([$id]);
	}

}
