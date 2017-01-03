<?php

class Chore extends BaseModel {
	
	public $id, $name, $info, $deadline, $importancedegree, $kayttaja;
	
	public function _construct($attributes) {
		parent::__construct($attributes);
	}
	
	public static function find($id) {
		$query = DB::connection()->prepare('SELECT * FROM Chore WHERE id = :id LIMIT 1');
		$query->execute(array('id' => $id));
		$row = $query->fetch();
		
		if ($row) {
			$Chore = new Chore(array(
																																										                'id' => $row['id'],
																																										                'name' => $row['name'],
																																										                'info' => $row['info'],
																																										                'deadline' => $row['deadline'],
																																										                'importancedegree' => $row['importancedegree'],
																																										                'visitorid' => $row['visitorid']
																																										            ));
			
			return $Chore;
		}
		
		return NULL;
	}
	
	public static function allByUser($visitorid) {
		$query = DB::connection()->prepare('SELECT * FROM Chore WHERE visitorid = :visitorid');
		$query->execute(array('visitorid' => $visitorid));
		$rows = $query->fetchAll();
		$Choreet = array();
		
		foreach ($rows as $row) {
			$Choreet[] = new Chore(array(
																																										                'id' => $row['id'],
																																										                'name' => $row['name'],
																																										                'info' => $row['info'],
																																										                'deadline' => $row['deadline'],
																																										                'importancedegree' => $row['importancedegree'],
																																										                'visitorid' => $row['visitorid']
																																										            ));
		}
		
		return $Choreet;
	}
	
	public static function all() {
		$query = DB::connection()->prepare('SELECT * FROM Chore');
		$query->execute();
		$rows = $query->fetchAll();
		$Choreet = array();
		
		foreach ($rows as $row) {
			$Choreet[] = Chore(array(
																																										                'id' => $row['id'],
																																										                'name' => $row['kayttaja'],
																																										                'info' => $row['info'],
																																										                'deadline' => $row['deadline'],
																																										                'importancedegree' => $row['importancedegree'],
																																										                'visitorid' => $row['visitorid']
																																										            ));
		}
		
		return $Choreet;
	}
	
	public static function count() {
		$query = DB::connection()->prepare('SELECT COUNT(*) AS amount FROM Chore LIMIT 1');
		$query->execute();
		$row = $query->fetch();
		
		if ($row) {
			$count = $row['amount'];
			
			return $count;
		}
		
		return NULL;
	}
	public function save() {
		$query = DB::connection()->prepare(
			'INSERT INTO Chore (name, info, deadline, importancedegree) 
		VALUES (:name, :info, :deadline, :importancedegree) RETURNING id');
		$query->execute(array('name' => $this->name, 'info' => $this->info, 
			'deadline' => $this->deadline,'importancedegree' => $this->importancedegree));
		$row = $query->fetch();
		$this->id = $row['id'];
	}
}
