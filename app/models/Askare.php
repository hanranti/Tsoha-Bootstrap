<?php

class Askare extends BaseModel {
	
	public $id, $name, $info, $deadline, $tarkeysaste, $kayttaja;
	
	public function _construct($attributes) {
		parent::__construct($attributes);
	}
	
	public static function find($id) {
		$query = DB::connection()->prepare('SELECT * FROM Askare WHERE id = :id LIMIT 1');
		$query->execute(array('id' => $id));
		$row = $query->fetch();
		
		if ($row) {
			$askare = new Askare(array(
			                'id' => $row['id'],
			                'name' => $row['name'],
			                'info' => $row['info'],
			                'deadline' => $row['deadline'],
			                'tarkeysaste' => $row['tarkeysaste'],
			                'kayttajaid' => $row['kayttajaid']
			            ));
			
			return $askare;
		}
		
		return NULL;
	}
	
	public static function allByUser($kayttaja) {
		$query = DB::connection()->prepare('SELECT * FROM Askare WHERE kayttajaid = :kayttajaid');
		$query->execute(array('kayttaja' => $kayttaja));
		$rows = $query->fetchAll();
		$askareet = array();
		
		foreach ($rows as $row) {
			$askareet[] = new Askare(array(
			                'id' => $row['id'],
			                'name' => $row['kayttaja'],
			                'info' => $row['info'],
			                'deadline' => $row['deadline'],
			                'tarkeysaste' => $row['tarkeysaste'],
			                'kayttaja' => $row['kayttaja']
			            ));
		}
		
		return $askareet;
	}
	
	public static function all() {
		$query = DB::connection()->prepare('SELECT * FROM Askare');
		$query->execute();
		$rows = $query->fetchAll();
		$askareet = array();
		
		foreach ($rows as $row) {
			$askareet[] = Askare(array(
			                'id' => $row['id'],
			                'name' => $row['kayttaja'],
			                'info' => $row['info'],
			                'deadline' => $row['deadline'],
			                'tarkeysaste' => $row['tarkeysaste'],
			                'kayttajaid' => $row['kayttajaid']
			            ));
		}
		
		return $askareet;
	}
	
	public static function count() {
		$query = DB::connection()->prepare('SELECT COUNT(*) AS maara FROM Askare LIMIT 1');
		$query->execute();
		$row = $query->fetch();

		if ($row) {
			$count = $row['maara'];

			return $count;
		}

		return NULL;
	}
}
